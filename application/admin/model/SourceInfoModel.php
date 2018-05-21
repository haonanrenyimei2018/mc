<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/21
 * Time: 17:04
 */

namespace app\admin\model;


use think\Model;

class SourceInfoModel extends Model
{
    protected $name = "sources_info";
    protected $autoWriteTimestamp = false;

    public function _add($data) {
        $this->insertGetId($data);
    }
}