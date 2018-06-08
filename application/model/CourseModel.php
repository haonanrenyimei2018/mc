<?php
/**
 * 培训课程
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/8
 * Time: 10:52
 */

namespace app\model;


use think\Model;

class CourseModel extends Model
{
    protected $name = 'course';
    protected $autoWriteTimestamp = false;
}