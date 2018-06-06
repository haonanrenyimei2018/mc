<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 10:41
 * 公司公告
 */

namespace app\index\controller;


use app\model\AdminModel;
use app\model\AgencyModel;
use app\model\MNoticeModel;

class Notice extends Base
{
    private $agencyModel;
    private $noticeModel;
    private $adminModel;
    private $pageSize = 15;
    public function _initialize() {
        parent::_initialize();
        $this->agencyModel = new AgencyModel();
        $this->noticeModel = new MNoticeModel();
        $this->adminModel = new AdminModel();
    }
    public function index() {
        $where = [];
        $count = $this->noticeModel->where($where)->count();
        $page = input('page') ? input('page') : 1;
        $pageCount = ceil($count/$this->pageSize);
        $data = $this->noticeModel->where($where)->order('date DESC')->page($page,$this->pageSize)->select();
        $this->assign('pageCount',$pageCount);
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 获取数据
     * @return mixed
     */
    public function getdata() {
        $where = [];
        $page = input('page') ? input('page') : 1;
        $data = $this->noticeModel->where($where)->order('date DESC')->page($page,$this->pageSize)->select();
        return json($data);
    }
    /*
     * 查看详情
     */
    public function detail() {
        $id = input('id');
        $where = [
            'id' => $id
        ];
        $data = $this->noticeModel->where($where)->find();
        $where = [
            'id' => $id
        ];
        $update = [
            'times' => $data['times'] + 1
        ];
        $members = $this->adminModel->column('id,real_name');
        $this->noticeModel->where($where)->update($update);
        $this->assign('members',$members);
        $this->assign('data',$data);
        return $this->fetch();
    }




}