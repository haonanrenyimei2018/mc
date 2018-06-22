<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\6\22 0022
 * Time: 0:45
 */

namespace app\index\controller;


use think\Db;
use think\Exception;

class Addr extends Base
{
    public function index() {
        if($this->request->isAjax()) {
            $params = input('post.');
            $params['member'] = $this->user['id'];
            $params['date'] = time();
            try {
                if($params['id'] > 0){
                    Db::name('member_addr')->where('id',$params['id'])->update($params);
                }else {
                    Db::name('member_addr')->insertGetId($params);
                }
                return json(['code' => 1,'msg' => '操作成功','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $where = [
            'member' => $this->user['id']
        ];
        $data = Db::name('member_addr')->where($where)->find();
        if(!isset($data)) {
            $data = [];
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
}