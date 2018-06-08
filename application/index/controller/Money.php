<?php
/**
 * 资金记录
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 10:45
 *
 */

namespace app\index\controller;


use app\model\MemberMoneyLogModel;

class Money extends Base
{
    private $pageSize = 15;
    private $memberMoneyLogModel;
    public function _initialize() {
        parent::_initialize();
        $this->memberMoneyLogModel = new MemberMoneyLogModel();
    }
    /**
     *
     */
    public function index() {
        $page = 1;
        $where = array(
            'member_id' => $this->user['id']
        );
        $count = $this->memberMoneyLogModel->where($where)->count();
        $pageCount = ceil($count/$this->pageSize);
        $data = $this->memberMoneyLogModel->where($where)->order('date DESC')->page($page,$this->pageSize)->select();
        $this->assign('pageCount',$pageCount);
        $this->assign('pageSize',$this->pageSize);
        $this->assign('data',$data);
        $this->assign('return_type',config('return_type'));
        return $this->view->fetch();
    }
    /**
     * 获取分页
     */
    public function getdata() {
        $page = input('page') ? input('page') : 1;
        $where = array(
            'member_id' => $this->user['id']
        );
        $data = $this->memberMoneyLogModel->where($where)->order('date DESC')->page($page,$this->pageSize)->select();
        foreach ($data as &$val) {
            $val['date'] = date('Y-m-d H:i',$val['date']);
        }
        return json(['data' => $data,'return_type' => config('return_type')]);
    }
}