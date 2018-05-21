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
use app\admin\model\AgencyTypeModel;
use app\admin\model\SourceInfoModel;
use think\Db;
use think\Exception;

class Score extends Base
{
    public $agencyModel;
    public $scoreInfoModel;
    public $agencyTypeModel;
    public $agencyInfoModel;
    public function _initialize() {
        parent::_initialize();
        $this->agencyModel = new AgencyModel();
        $this->scoreInfoModel = new SourceInfoModel();
        $this->agencyTypeModel = new AgencyTypeModel();
        $this->agencyInfoModel = new AgencyInfoModel();
    }
    /**
     * 检索所有的客户已审核
     */
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
     * 查看详情
     */
    public function detail() {
        $id = input('id');
        $where = [
            'mid' => $id
        ];
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = $this->scoreInfoModel->where($where)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        if(input('get.page')){
            $lists = $this->scoreInfoModel->where($where)->page($Nowpage, $limits)->select();
            foreach ($lists as &$val) {
                $val['date'] = date('Y-m-d H:i:s',$val['date']);
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
            $params['user'] = $this->user['id'];
            $params['date'] = time();
            try {
                $where = [
                    'member' => $params['mid']
                ];
                $agencyInfo = $this->agencyInfoModel->where($where)->find();
                if($agencyInfo['score'] < $params['amount']) {
                    return json(['code' => -3,'msg' => '积分不足!']);
                }
                if($params['type'] == 1) {
                    $agencyInfo['score'] += $params['amount'];
                }else {
                    $agencyInfo['score'] -= $params['amount'];
                }
                $data = [
                    'score' => $agencyInfo['score']
                ];
                $this->agencyInfoModel->where($where)->update($data);
                $this->scoreInfoModel->_add($params);
                return json(['code' => 1,'msg' => '操作成功!','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $id = input('id');
        $this->assign('id',$id);
        return $this->view->fetch();
    }






}