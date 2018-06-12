<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/24
 * Time: 8:56
 * 首页
 */

namespace app\index\controller;


use app\model\MSilderModel;

class Index extends Base
{
    public $silderModel;
    public function _initialize() {
        parent::_initialize();
        $this->silderModel = new MSilderModel();
    }
    /**
     * 首页
     */
    public function index() {
        //获取幻灯
        $where = [
//            'date_end' => ['egt',time()]
        ];
        $silders = $this->silderModel->where($where)->select();
        $this->assign('silders',$silders);
        $this->assign('count',count($silders) - 1);
        return $this->view->fetch();
    }
    /**
     * 登陆
     */
    public function login() {
        if(request()->isAjax()) {

        }
        return $this->fetch();
    }
    /**
     * 注册
     */
    public function register() {
        if(request()->isAjax()){

        }
        return $this->fetch();
    }
}