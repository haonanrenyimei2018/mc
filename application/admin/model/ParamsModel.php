<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 9:24
 */

namespace app\admin\model;


use think\Model;

class ParamsModel extends Model
{
    protected $name = "params";
    protected $autoWriteTimestamp = false;


    public function _get() {
        $data = $this->column('key,value');
        return $data;
    }
}