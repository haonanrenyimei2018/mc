<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/24
 * Time: 8:56
 */

namespace app\index\controller;


class Index extends Base
{
    /**
     * 首页
     */
    public function index() {
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