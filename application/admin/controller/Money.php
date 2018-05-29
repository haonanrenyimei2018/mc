<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/21
 * Time: 15:44
 */

namespace app\admin\controller;


use app\admin\model\AgencyInfoModel;
use app\admin\model\AgencyModel;
use app\admin\model\MemberMoneyLogModel;
use app\admin\model\ParamsModel;
use think\Db;
use Think\Exception;

class Money extends Base
{
    public $agencyModel;
    public $memberMoneyLogModel;
    public $agencyInfoModel;
    public $param;
    private $type = [
        'return' => '推荐返还',
        'return_1' => '绩效返还',
        'p_add' => '新增绩效',
        'c_add' => '新增佣金',
        'p_reduce' => '减少绩效',
        'c_reduce' => '减少佣金'
    ];
    private $params = [
        1 => '佣金',
        2 => '业绩'
    ];
    private $model = [
        1 => '增加',
        2 => '扣除'
    ];

    public function _initialize() {
        parent::_initialize();
        $this->agencyModel = new AgencyModel();
        $this->memberMoneyLogModel = new MemberMoneyLogModel();
        $this->agencyInfoModel = new AgencyInfoModel();
        $this->param = new ParamsModel();
    }
    public function index() {
        $key = input('key');
        $where = [];
        if(!empty($key)){
            $where['name'] = ['like','%'.$key.'%'];
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = $this->agencyModel->where($where)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        if(input('get.page')){
            $lists = $this->agencyModel->where($where)->page($Nowpage, $limits)->select();
            $agencyType = $this->agencyTypeModel->column('id,name');
            foreach ($lists as &$val) {
                $val['type_name'] = $agencyType[$val['type']];
            }
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val',$key);
        return $this->fetch();
    }
    /**
     * 财务列表
     */
    public function detail() {
        $id = input('id');
        $where = [
            'member_id' => $id
        ];
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = $this->memberMoneyLogModel->where($where)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        if(input('get.page')){
            $lists = $this->memberMoneyLogModel->where($where)->page($Nowpage, $limits)->select();
            foreach ($lists as &$val) {
                $val['date'] = date('Y-m-d H:i:s',$val['date']);
                $val['type_name'] = $this->type[$val['type']];
            }
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('id',$id);
        return $this->fetch();
    }
    /**
     * 添加
     */
    public function add() {
        if($this->request->isAjax()) {
            $params = input('post.');
            $params['date'] = time();
            $params['summary'] = $this->type[$params['type']];
            try {
                Db::startTrans();
                //更新自己的账户
                $memberInfo = $this->agencyInfoModel->where('member',$params['member_id'])->find();
                switch ($params['type']) {
                    case 'p_add' :
                        //增加业绩
                        $data['performance'] = $memberInfo['performance'] + $params['amount'];
                        break;
                    case 'c_add' :
                        $data['money'] = $memberInfo['money'] + $params['amount'];
                        $data['commission'] = $memberInfo['commission'] + $params['amount'];
                        break;
                    case 'p_reduce' :
                        //减少业绩
                        $data['performance'] = $memberInfo['performance'] - $params['amount'];
                        if($data['performance'] < 0) {
                            return json(['code' => -1,'msg' => '业绩不足!']);
                        }
                        break;
                    case 'c_reduce' :
                        $data['money'] = $memberInfo['money'] - $params['amount'];
                        $data['commission'] = $memberInfo['commission'] - $params['amount'];
                        if($data['money'] < 0) {
                            return json(['code' => -1,'msg' => '可提现余额不足!']);
                        }
                        break;
                }
                $this->memberMoneyLogModel->insert($params);
                $this->agencyInfoModel->where('member',$params['member_id'])->update($data);
                //新增绩效要给自己所属的城市总代一部分佣金
                if($params['type'] == 'p_add') {
                    $member = $this->agencyModel->where('id',$params['member_id'])->find();
                    $where = [
                        'province' => $member['province'],
                        'city' => $member['city'],
                        'type' => 1,
                        'id' => ['neq',$params['member_id']]
                    ];
                    $member_1 = $this->agencyModel->where($where)->find();
                    if(isset($member_1)) {
                        $config = $this->param->_get();
                        $amount = round($params['amount'] * $config['performance_001']/100,2);
                        $insert = [
                            'member_id' => $member_1['id'],
                            'type' => 'return_1',
                            'model' => 1,
                            'amount' => $amount,
                            'summary' => '来自代理'.$member['name'].'的业绩返还'
                        ];
                        $this->memberMoneyLogModel->insert($insert);
                        //修改
                        $memberInfo_1 = $this->memberMoneyLogModel->where('member',$member_1['id'])->find();
                        $update = [
                            'money' => $memberInfo_1['money'] + $amount,
                            'commission' => $memberInfo_1['commission'] + $amount
                        ];
                        $this->agencyInfoModel->where('member',$member_1['id'])->update($update);
                    }
                }
                Db::commit();
                return json(['code' => 1,'msg' => '操作成功','url' => url('index')]);
            }catch (Exception $e) {
                Db::rollback();
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $id = input('id');
        $this->assign([
            'type' => $this->type,
            'model' => $this->model,
            'id' => $id
        ]);
        return $this->view->fetch();
    }




}