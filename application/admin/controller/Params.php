<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/11
 * Time: 11:52
 */

namespace app\admin\controller;


use think\Db;

class Params extends Base
{
    /**
     * 关于佣金的参数
     */
    public function index(){
        $data = Db::name('params')->select();
        $this->assign('data',$data);
        return $this->fetch();
    }
}