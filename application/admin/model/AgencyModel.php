<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 9:01
 */

namespace app\admin\model;


use think\Model;

class AgencyModel extends Model
{
    protected $name = 'agency';
    protected $autoWriteTimestamp = false;   // 开启自动写入时间戳

}