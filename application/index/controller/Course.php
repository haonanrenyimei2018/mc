<?php
/**
 * 培训
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 10:42
 */

namespace app\index\controller;


use app\model\AdminModel;
use app\model\CourseMemberModel;
use app\model\CourseModel;
use think\Db;

class Course extends Base
{
    private $pageSize =15;
    private $courseModel;
    private $courseMemberModel;
    private $adminModel;
    public function _initialize() {
        parent::_initialize();
        $this->courseModel = new CourseModel();
        $this->courseMemberModel = new CourseMemberModel();
        $this->adminModel = new AdminModel();
    }

    public function index() {
        $SQL = '';
        $where = array(
            'mid' => $this->user['id']
        );
        $count = $this->courseMemberModel->where($where)->count();
        $pageCount = ceil($count/$this->pageSize);
        //获取未读的培训课程
        $where = array(
            'state' => 0,
            'mid' => $this->user['id']
        );
        $data_no = $this->courseMemberModel->where($where)->column('cid');

        if(count($data_no) > 0) {
            $str_no = implode(',',$data_no);
        }
        if(!empty($str_no)) {
            $SQL .= "SELECT *,1 AS type from mc_course where id in (".$str_no.") ";
        }
        $where = array(
            'state' => 1,
            'mid' => $this->user['id']
        );
        $data_yes = $this->courseMemberModel->where($where)->column('cid');
        if(count($data_yes) > 0) {
            $str_read = implode(',',$data_yes);
            if(!empty($str_no) && !empty($str_read)) {
                $SQL .= ' UNION ';
            }
            $SQL .= " SELECT *,2 AS type from mc_course where id in (".$str_read.") ";
        }
        $SQL .= ' order by type ASC,date desc limit '.$this->pageSize;
        $datas = Db::query($SQL);
        $this->assign('data',$datas);
        $this->assign('pageCount',$pageCount);
        return $this->view->fetch();
    }
    /**
     * 获取更多
     */
    public function more() {
        $page = input('page') ? input('page') : 1;
        //获取未读的培训课程
        $where = array(
            'state' => 0,
            'mid' => $this->user['id']
        );
        $data_no = $this->courseMemberModel->where($where)->column('cid');

        if(count($data_no) > 0) {
            $str_no = implode(',',$data_no);
        }
        if(!empty($str_no)) {
            $SQL = "SELECT *,1 AS type from mc_course where id in (".$str_no.") ";
        }
        $where = array(
            'state' => 1,
            'mid' => $this->user['id']
        );
        $data_yes = $this->courseMemberModel->where($where)->column('cid');
        if(count($data_yes) > 0) {
            $str_read = implode(',',$data_yes);
            if(!empty($str_no) && !empty($str_read)) {
                $SQL .= ' UNION ';
            }
            $SQL .= " SELECT *,2 AS type from mc_course where id in (".$str_read.") ";
        }
        $offset = ($page - 1) * $this->pageSize;
        $SQL .= ' order by type ASC,date desc limit '.$offset.','.$this->pageSize;
        $datas = Db::query($SQL);
        return json($datas);
    }
    /**
     * 查看详情
     */
    public function detail() {
        $id = input('id');
        $info = $this->courseModel->where('id',$id)->find();
        //更新查看次数
        $update = array(
            'times' => $info['times'] + 1
        );
        $this->courseModel->where('id',$id)->update($update);
        //更新未读记录
        $where = array(
            'mid' => $this->user['id'],
            'cid' => $id
        );
        $update = array(
            'state' => 1,
            'date' => time()
        );
        $this->courseMemberModel->where($where)->update($update);
        $members = $this->adminModel->column('id,real_name');
        $this->assign('info',$info);
        $this->assign('members',$members);
        return $this->fetch();
    }
}