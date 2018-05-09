<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class MemberModel extends Model
{
    protected $name = 'member';  
    protected $autoWriteTimestamp = true;   // 开启自动写入时间戳


    public function getMembersByCondition($where,$Nowpage, $limits){
        $data = $this->where($where)->page($Nowpage,$limits)->select();
        return $data;
    }




}