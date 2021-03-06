<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/24
 * Time: 8:57
 * 广告
 */

namespace app\index\controller;


use app\model\AdModel;
use app\model\AdTypeModel;
use think\Db;
use Think\Exception;

class Ad extends Base
{
    private $adModel;
    private $adTypeModel;
    private $pageSize = 15;
    public function _initialize() {
        parent::_initialize();
        $this->adModel = new AdModel();
        $this->adTypeModel = new AdTypeModel();
    }
    /**
     *
     */
    public function index() {
        //获取我的广告
        $where = [
            'mid' => $this->user['id']
        ];
        $count = $this->adModel->where($where)->order('date DESC')->count();
        $pageCount = ceil($count/$this->pageSize);
        $adData = $this->adModel->where($where)->page(1,$this->pageSize)->order('date DESC')->select();
        $this->assign('pageCount',$pageCount);
        $this->assign('datas',$adData);
        return $this->fetch();
    }
    public function getdata() {
        $page = input('page') ? input('page') : 1;
        $where = [
            'mid' => $this->user['id']
        ];
        $adData = $this->adModel->where($where)->page(1,$this->pageSize)->order('date DESC')->select();
        return json($adData);
    }
    /**
     * 查看详情
     */
    public function detail() {
        $id = input('id');
        $data = $this->adModel->where('id',$id)->find();
        $types = $this->adTypeModel->column('id,name');
        $data['type_name'] = $types[$data['type']];
        $this->assign('data',$data);
        return $this->fetch();
    }
    /**
     * 添加广告
     */
    public function add() {
        if(request()->isAjax()){
            $data = input('post.');
            //检测是否可以接广告
            $where = array(
                'member' => $this->user['id'],
                'type' => $data['type'],
                'date_end' => ['gt',time()]
            );
            $count = Db::name('ad_member')->where($where)->count();
            if($count > 0) {
                return json(['code' => -3,'msg' => '该类型的广告正在合同期,不能发布!']);
            }
            $data['date'] = time();
            $data['mid'] = $this->user['id'];
            $data['status'] = 0;
            try {
                $res = $this->adModel->insertGetId($data);
                if($res !== false){
                    $adMember = array(
                        'member' => $this->user['id'],
                        'ad' => $res,
                        'type' => $data['type'],
                        'date_begin' => time(),
                        'date_end' => time() + $data['months'] * 24 * 60* 60,
                        'date' => time()
                    );
                    Db::name('ad_member')->insert($adMember);
                    return json(['code' => 1,'msg' => '操作成功','url' => url('index')]);
                }else {
                    return json(['code' => -1,'msg' => '操作失败,请联系管理员']);
                }
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $where = [
            'del_flag' => 0
        ];
        $data = $this->adTypeModel->where($where)->column('id,name');
        $this->assign('adType',$data);
        return $this->fetch();
    }
}