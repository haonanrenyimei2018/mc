<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 10:47
 */

namespace app\index\controller;


use app\model\AgencyInfoModel;

class Finance extends Base
{
    private $agencyInfoModel;
    public function _initialize() {
        parent::_initialize();
        $this->agencyInfoModel = new AgencyInfoModel();
    }

    public function index(){

        $where = array(
            'member' => $this->user['id']
        );

        $info = $this->agencyInfoModel->where($where)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }



}