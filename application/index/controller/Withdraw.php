<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/15
 * Time: 14:59
 */

namespace app\index\controller;


use think\Db;
use Think\Exception;

class Withdraw extends Base
{
    private $pageSize = 15;
    public function index() {
        $where = array(
            'member' => $this->user['id']
        );
        $count = Db::name('withdraw')->where($where)->count();
        $pageCount = ceil($count/$this->pageSize);
        $data = Db::name('withdraw')->where($where)->order('date DESC')->page(1,$this->pageSize)->select();
        $this->assign('pageCount',$pageCount);
        $this->assign('data',$data);
        return $this->fetch();
    }
    /**
     * 查看更多
     */
    public function more() {
        $page = input('page') ? input('page') : 1;
        $where = array(
            'member' => $this->user['id']
        );
        $data = Db::name('withdraw')->where($where)->order('date DESC')->page($page,$this->pageSize)->select();
        return json($data);
    }
    /**
     * 申请提现
     */
    public function add() {
        if(request()->isAjax()){
            $data = input('post.');
            $data['member'] = $this->user['id'];
            $data['status'] = 0;
            $data['date'] = time();
            try {
                Db::startTrans();
                $res = Db::name('withdraw')->insertGetId($data);
                if($res !== false){
                    $where = [
                        'member' => $this->user['id']
                    ];
                    $info = Db::name('agencyInfo')->where($where)->find();
                    $data = array(
                        'money' => $info['money'] - $data['amount']
                    );
                    Db::name('agency_info')->where('member',$this->user['id'])->update($data);
                    Db::commit();
                    return json(['code' => '1','msg' => '操作成功','url' => url('index')]);
                }else {
                    Db::rollback();
                    return json(['code' => -1,'msg' => '操作失败，请联系管理员']);
                }
            }catch (Exception $e) {
                Db::rollback();
                return json(['code' => -999,'msg' => $e->getMessage()]);
            }
        }
        $where = [
            'member' => $this->user['id']
        ];
        $info = Db::name('agencyInfo')->where($where)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }




}