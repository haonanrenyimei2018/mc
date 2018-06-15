<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/14
 * Time: 10:42
 */

namespace app\index\controller;


use think\Db;
use Think\Exception;

class Personal extends Base
{
    /**
     * 个人中心
     */
    public function index() {
        $this->assign('user',$this->user);
        return $this->fetch();
    }
    /**
     * 修改个人信息
     */
    public function info() {
        if(request()->isAjax()){
            $data = input('post.');
            if(!empty($data['password'])){
                $data['password'] = md5($data['password']);
            }else {
                unset($data['password']);
            }
            try {
                Db::name('agency')->where('id',$data['id'])->update($data);
                $agency = Db::name('agency')->where('id',$data['id'])->find();
                session('member',$agency);
                return json(['code' => 1,'msg' => '操作成功','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $user = Db::name('agency')->where('id',$this->user['id'])->find();
        $this->assign('user',$user);
        return $this->fetch();
    }




}