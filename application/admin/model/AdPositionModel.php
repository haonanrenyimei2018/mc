<?php

namespace app\admin\model;
use think\Model;
use think\Db;

class AdPositionModel extends Model
{
    protected $name = 'ad_position';

    // 开启自动写入时间戳
    protected $autoWriteTimestamp = false;
}