<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/11
 * Time: 11:53
 * 公司公告
 */

namespace app\admin\controller;


use think\Db;
use think\Exception;

class Notice extends Base
{
    /**
     * 列表
     */
    public function index(){
        $val = input('key');
        $where = [];
        if(isset($val) && !empty($val)) {
            $where['title|content'] = ['like' , '%'.$val.'%'];
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = Db::name('notice')->where($where)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        if(input('get.page')){
            $lists = Db::name('notice')->where($where)->page($Nowpage, $limits)->select();
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val',$val);
        return $this->fetch();
    }
    /**
     * 添加
     */
    public function add() {
        if($this->request->isAjax()){
            $params = input('post.');
            $params['times'] = 0;
            $params['date'] = time();
            $params['user'] = $this->user['id'];
            try {
                Db::name('notice')->insertGetId($params);
                return json(['code' => 1,'msg' => '添加成功!','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function edit() {
        if($this->request->isAjax()){
            $params = input('post.');
            $params['date'] = time();
            try {
                Db::name('notice')->where('id',$params['id'])->update($params);
                return json(['code' => 1,'msg' => '修改成功!','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $id = input('id');
        $data = Db::name('notice')->where('id',$id)->find();
        $this->assign('data',$data);
        return $this->view->fetch();
    }
    /**
     * 删除
     */
    public function del() {
        $id = input('id');
        try {
            Db::name('notice')->where('id',$id)->delete();
            return json(['code' => 1,'msg' => '删除成功']);
        }catch (Exception $e) {
            return json(['code' => -99,'msg' => $e->getMessage()]);
        }
    }

}