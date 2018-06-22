<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/23
 * Time: 14:21
 */
namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    public $user;
    public function _initialize() {
        $this->user = session('member');
        if(is_null(session('member'))) {
            $this->redirect(url('login/index'));
        }
        $this->assign([
            'type' => $this->user['type']
        ]);
    }




}