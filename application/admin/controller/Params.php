<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/11
 * Time: 11:52
 */

namespace app\admin\controller;


use think\Db;
use think\Exception;

class Params extends Base
{
    /**
     * 关于佣金的参数
     */
    public function index(){
        if($this->request->isAjax()){
            $params = input('post.');
            try {
                Db::startTrans();
                foreach ($params as $key => $val) {
                    $data = [
                        'value' => $val
                    ];
                    $where = [
                        'key' => $key
                    ];
                    Db::name('params')->where($where)->update($data);
                }
                Db::commit();
                return json(['code' => 1,'msg'=>'操作成功','url' => url('index')]);
            }catch (Exception $e) {
                Db::rollback();
                return json(['code' => -99,'msg'=> $e->getMessage()]);
            }
        }
        $data = Db::name('params')->select();
        $this->assign('data',$data);
        return $this->fetch();
    }
}