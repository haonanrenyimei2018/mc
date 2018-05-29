<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\5\14 0014
 * Time: 21:14
 */

namespace app\admin\controller;


use think\Db;

class Ad extends Base
{

    public function index() {
        $val = input('key');
        $where = [];
        if(isset($val) && !empty($val)) {
            $where['title'] = ['like' , '%'.$val.'%'];
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = Db::name('ad')->where($where)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        if(input('get.page')){
            $lists = Db::name('ad')->where($where)->page($Nowpage, $limits)->select();
            $adTypes = Db::name('adType')->column('id,name');
            $members = Db::name('agency')->column('id,name');
            foreach ($lists as &$val) {
                $val['type_name'] = $adTypes[$val['type']];
                $val['member_name'] = $members[$val['mid']];
            }
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val',$val);
        return $this->fetch();
    }

    /**
     * 测试上传
     */
    public function upload() {
        dump($_SERVER);
        die;
        return $this->fetch();
    }



}