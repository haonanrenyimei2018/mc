<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\6\20 0020
 * Time: 23:44
 */

namespace app\admin\controller;


use think\Db;
use think\Exception;

class AdScore extends Base
{
    public function index(){
        $where = [];
        $data = Db::name('score_money')->where($where)->order('begin ASC')->select();
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 添加
     * @return string|\think\response\Json
     */
    public function add(){
        if($this->request->isAjax()) {
            $params = input('post.');
            $params['date'] = time();
            try {
                Db::name('score_money')->insertGetId($params);
                return json(['code' => 1,'msg' => '操作成功','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' =>  $e->getMessage()]);
            }
        }
        return $this->view->fetch();
    }

    /**
     * 编辑
     */
    public function edit() {
        if($this->request->isAjax()){
            $params = input('post.');
            $params['date'] = time();
            try {
                Db::name('score_money')->where('id',$params['id'])->update($params);
                return json(['code' => 1,'msg' => '操作成功','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' =>  $e->getMessage()]);
            }
        }
        $id = input('id');
        $data = Db::name('score_money')->find($id);
        $this->assign('data',$data);
        return $this->fetch();
    }
    /**
     * 删除
     */
    public function del() {



    }






}