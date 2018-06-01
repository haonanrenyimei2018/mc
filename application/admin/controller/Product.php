<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/14
 * Time: 14:41
 */

namespace app\admin\controller;


use think\Db;
use think\Exception;

class Product extends Base
{
    /**
     * 产品列表
     */
    public function index() {
        $val = input('key');
        $where = [];
        if(isset($val) && !empty($val)) {
            $where['title|content|intro'] = ['like' , '%'.$val.'%'];
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = Db::name('product')->where($where)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        if(input('get.page')){
            $lists = Db::name('product')->where($where)->page($Nowpage, $limits)->select();
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val',$val);
        return $this->fetch();
    }
    /**
     * 添加产品
     */
    public function add() {
        if($this->request->isAjax()) {
            $params = input('post.');
            $params['state'] = 1;
            $params['date'] = time();
            $params['user'] = $this->user['id'];
            unset($params['file']);
            try {
                Db::name('product')->insertGetId($params);
                return json(['code' => 1,'msg' => '添加成功','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        return $this->fetch();
    }

    /**
     * 编辑产品
     */
    public function edit() {
        if($this->request->isAjax()){
            $params = input('post.');
            $params['date'] = time();
            unset($params['file']);
            if(!isset($params['state'])){
                $params['state'] = 1;
            }
            try {
                Db::name('product')->where('id',$params['id'])->update($params);
                return json(['code' => 1,'msg' => '操作成功','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $id = input('id');
        $data = Db::name('product')->where('id',$id)->find();
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 删除产品
     */
    public function del() {
        $id = input('id');
        try {
            Db::name('product')->where('id',$id)->delete();
            return json(['code' => 1,'msg' => '删除成功']);
        }catch (Exception $e) {
            return json(['code' => -99,'msg' => $e->getMessage()]);
        }
    }


}