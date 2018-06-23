<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/23
 * Time: 10:55
 */

namespace app\admin\controller;


use think\Db;

class InviteCode extends Base
{
    public function index() {

        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = Db::name('invite_code')->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        if(input('get.page')){
            $lists = Db::name('invite_code')->page($Nowpage, $limits)->order('field(status,0,1),date DESC')->select();
            foreach ($lists as &$val) {
                $val['date'] = date('Y-m-d H:i',$val['date']);
            }
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        return $this->fetch();
    }
    /**
     * 生成
     */
    public function create() {
        $source_string = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = rand(10000000,99999999);
        $code = '';
        while($num) {
            $mod = $num % 36;
            $num = ($num - $mod) / 36;
            $code = $source_string[$mod].$code;
        }
        //保存到数据库中
        $data = [
            'code' => $code,
            'status' => 0,
            'date' => time()
        ];
        Db::name('invite_code')->insertGetId($data);
        return json(['code' => 1,'msg' => $code,'url' => url('index')]);
    }
}