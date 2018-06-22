<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\6\19 0019
 * Time: 22:17
 */

namespace app\admin\controller;


use think\Db;
use think\Exception;

class ScoreRoles extends Base
{
    public function index() {
        $where = [
            'is_del' => 0
        ];
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = Db::name('score_roles')->where($where)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        if(input('get.page')) {
            $model = config('model');
            $data = Db::name('score_roles')->where($where)->page($Nowpage,$limits)->order('id ASC')->select();
            foreach ($data as &$val) {
                $val['model_name'] = $model[$val['model']];
            }
            return json($data);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        return $this->fetch();
    }

    public function add() {
        if($this->request->isAjax()) {
            $params = input('post.');
            $params['is_del'] = 0;
            $params['date'] = time();
            try{
                $res = Db::name('score_roles')->insertGetId($params);
                return json(['code' => 1,'msg' => '操作成功','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $this->assign('model',config('model'));
        return $this->view->fetch();
    }
    public function edit() {
        if($this->request->isAjax()) {
            $params = input('post.');
            $params['is_del'] = 0;
            try{
                $res = Db::name('score_roles')->where('id',$params['id'])->update($params);
                return json(['code' => 1,'msg' => '操作成功','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $id = input('id');
        $data = Db::name('score_roles')->find($id);
        $this->assign('data',$data);
        $this->assign('model',config('model'));
        return $this->view->fetch();
    }
    public function del() {
        if($this->request->isAjax()){
            $id = input('id');
            $data =[
                'is_del' => 1
            ];
            try {
                Db::name('score_roles')->where('id',$id)->update($data);
                return json(['code' => 1,'msg' => '删除成功!']);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
    }
    /**
     * 获取规则
     */
    public function getroles() {
        $model = input('model');
        $where = [
            'model' => $model
        ];
        $data = Db::name('score_roles')->where($where)->select();
        return json($data);
    }
}