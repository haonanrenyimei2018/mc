<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\5\4 0004
 * Time: 21:49
 */

namespace app\admin\controller;


use think\Db;
use think\Exception;

class Personal extends Base
{
    public function index() {
        if(request()->isAjax()) {
            $params = input('post.');
            $where = [
                'id' => $params['id']
            ];
            $data = [
                'real_name' => $params['real_name'],
                'portrait' => $params['portrait']
            ];
            if(!empty($params['password'])) {
                $data['password'] = md5(md5($params['password']).config('auth_key'));
            }
            try {
                $res = Db::name('admin')->where($where)->update($data);
                if($res !== false) {
                    $admin = Db::name('admin')->where($where)->find();
                    session('user',$admin);
                    return json(['code' => 1,'msg' => '操作成功!','url' => url('index')]);
                }else {
                    return json(['code' => -1,'msg' => '操作失败!']);
                }
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }

        }
        $id = $this->user['id'];
        $user = Db::name('admin')->where('id',$id)->find();
        $this->assign('user',$user);
        return $this->view->fetch();
    }

}