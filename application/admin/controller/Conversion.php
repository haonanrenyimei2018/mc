<?php
/**
 * 积分兑换
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/11
 * Time: 18:01
 */

namespace app\admin\controller;


use think\Db;
use Think\Exception;

class Conversion extends Base
{
    private $pageSize = 15;
    public function _initialize() {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    public function index() {
        $Nowpage = input('get.page') ? input('get.page'):1;
        $where = [];
        $count = Db::name('member_product')->where($where)->count();
        $pageCount = ceil($count/$this->pageSize);
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $pageCount); //总页数
        if(input('get.page')){
            $data_product = Db::name('product')->column('id,name');
            $data_a = Db::name('agency')->column('id,nick_name');
            $lists = Db::name('member_product')->where($where)->order('field(state,0,1),date desc')->page($Nowpage,$this->pageSize)->select();
            foreach ($lists as &$val){
                $val['product'] = $data_product[$val['product']];
                $val['member'] = $data_a[$val['member']];
                $val['date'] = date('Y-m-d H:i',$val['date']);
            }
            return json($lists);
        }
        return $this->fetch();
    }

    /**
     * 改变状态
     */
    public function deal() {
        if($this->request->isAjax()) {
            $data = input('post.');
            $where = [
                'id' => $data['id']
            ];
            $update = [
                'state' => 1,
                'date' => time()
            ];
            try {
                $res = Db::name('member_product')->where($where)->update($update);
                if($res !== false) {
                    return json(['code' => 1,'msg' => '操作成功','url' => url('index')]);
                }else {
                    return json(['code' => -1,'msg' => '操作失败,请联系管理员']);
                }
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
    }
}