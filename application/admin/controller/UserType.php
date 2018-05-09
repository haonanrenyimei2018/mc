<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\5\9 0009
 * Time: 21:20
 */

namespace app\admin\controller;


use think\Db;

class UserType extends Base
{
    /**
     * 获取所有的代理类型
     * 因为数据量比较少，所以就不分页了
     */
    public function index() {
        $where = [];
        $data = Db::name('userType')->where($where)->order()->select();




    }

    /**
     * 添加
     */
    public function add() {



    }
    /**
     * 编辑
     */
    public function edit() {



    }

    public function del() {

    }



}