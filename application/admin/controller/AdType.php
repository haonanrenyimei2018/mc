<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/14
 * Time: 17:08
 */

namespace app\admin\controller;


use think\Db;
use think\Exception;

class AdType extends Base
{
    /**
     * 广告类型列表
     */
    public function index() {
        $val = input('key');
        $where = [
            'del_flag' => 0
        ];
        if(isset($val) && !empty($val)) {
            $where['name'] = ['like' , '%'.$val.'%'];
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = Db::name('adType')->where($where)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        if(input('get.page')){
            $lists = Db::name('adType')->where($where)->page($Nowpage, $limits)->select();
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val',$val);
        return $this->fetch();
    }

    /**
     * 添加广告类型
     */
    public function add() {
        if($this->request->isAjax()) {
            $params = input('post.');
            $params['date'] = time();
            $params['user'] = $this->user['id'];
            try {
                Db::name('ad_type')->insertGetId($params);
                return json(['code' => 1,'msg' => '添加成功','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }

        }
        return $this->fetch();
    }
    /**
     * 编辑广告类型
     */
    public function edit() {
        if($this->request->isAjax()){
            $params = input('post.');
            try {
                Db::name('ad_type')->where('id',$params['id'])->update($params);
                return json(['code' => 1,'msg' => '操作成功','url' => url('index')]);
            }catch (Exception $e){
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $id = input('id');
        $data = Db::name('ad_type')->where('id',$id)->find();
        $this->assign('data',$data);
        return $this->fetch();
    }
    /**
     * 删除广告类型
     */
    public function del() {
        $id = input('id');
        $data = [
            'del_flag' => 1
        ];
        try {
            Db::name('ad_type')->where('id',$id)->update($data);
            return json(['code' => 1,'msg' => '删除成功','url' => url('index')]);
        }catch (Exception $e) {
            return json(['code' => -99,'msg' => $e->getMessage()]);
        }
    }
}