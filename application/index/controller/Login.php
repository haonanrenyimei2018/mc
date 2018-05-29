<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/23
 * Time: 14:22
 */

namespace app\index\controller;


use app\index\model\AgencyModel;
use app\index\model\AgencyTypeModel;
use think\Controller;

class Login extends Controller
{
    private $agencyModel;
    private $agencyTypeModel;
    public function _initialize() {
        $this->agencyModel = new AgencyModel();
        $this->agencyTypeModel = new AgencyTypeModel();
    }

    /**
     * 登陆
     * @return string
     */
    public function index() {
        return $this->view->fetch();
    }

    /**
     * 登陆事件
     */
    public function doLogin() {

    }
    /**
     * 注销登陆
     */
    public function loginout() {
        session('member',null);
        return $this->fetch('login');
    }
    /**
     * 注册
     */
    public function register() {
        if(request()->isAjax()) {
            return false;
        }
    }
}