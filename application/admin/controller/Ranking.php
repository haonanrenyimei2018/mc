<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/26
 * Time: 9:18
 */

namespace app\admin\controller;


use think\Db;

class Ranking extends Base
{

    public function index() {
        $members = Db::name('agency')->column('id,name');
        $type = input('type');
        if(!empty($type)) {

        }
        return $this->fetch();
    }

}