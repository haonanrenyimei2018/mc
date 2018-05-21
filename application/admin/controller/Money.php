<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/21
 * Time: 15:44
 */

namespace app\admin\controller;


use app\admin\model\AgencyModel;

class Money extends Base
{
    public $agencyModel;
    public function _initialize() {
        parent::_initialize();
        $this->agencyModel = new AgencyModel();
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

}