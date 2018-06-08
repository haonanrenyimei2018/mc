<?php
/**
 * 培训
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 10:42
 */

namespace app\index\controller;


use app\model\CourseMemberModel;
use app\model\CourseModel;
use think\Db;

class Course extends Base
{
    private $pageSize =15;
    private $courseModel;
    private $courseMemberModel;
    public function _initialize() {
        parent::_initialize();
        $this->courseModel = new CourseModel();
        $this->courseMemberModel = new CourseMemberModel();
    }

    public function index() {
        $where = array(
            'mid' => $this->user['id']
        );
        $count = $this->courseMemberModel->where($where)->count();
        $pageCunt = celi($count/$this->pageSize);
        //获取未读的培训课程
        $where = array(
            'state' => 0,
            'mid' => $this->user['id']
        );
        $data_no = $this->courseMemberModel->where($where)->column('cid');

        if(count($data_no) > 0) {
            $str_no = implode(',',$data_no);
        }
        $SQL = "SELECT *,1 AS type from mc_course where id in (".$str_no.") ";
        $where = array(
            'state' => 1,
            'mid' => $this->user['id']
        );
        $data_yes = $this->courseMemberModel->where($where)->column('cid');
        if(count($data_yes) > 0) {
            $str_read = implode(',',$data_yes);
//            $datas = $datas->union("select * from mc_course where id in ('".$str_read."')");
            $SQL .= " UNION SELECT *,2 AS type from mc_course where id in (".$str_read.") ";
        }
        $SQL .= ' order by type ASC,date desc limit '.$this->pageSize;
        $datas = Db::query($SQL);



    }





}