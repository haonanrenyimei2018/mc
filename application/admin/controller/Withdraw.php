<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\6\16 0016
 * Time: 1:25
 */

namespace app\admin\controller;


use think\Db;
use think\Exception;

class Withdraw extends Base
{
    private $pageSize = 15;

    public function index() {
        $where = [];
        $Nowpage = input('get.page') ? input('get.page'):1;
        $count = Db::name('withdraw')->where($where)->count();//计算总页面
        $allpage = intval(ceil($count / $this->pageSize));
        if(input('get.page')){
            $members = Db::name('agency')->column('id,name');
            $lists = Db::name('withdraw')->where($where)->page($Nowpage, $this->pageSize)->order('date DESC')->select();
            foreach ($lists as &$val) {
                $val['member'] = $members[$val['member']];
                $val['date'] = date('Y-m-d H:i',$val['date']);

            }
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        return $this->fetch();
    }

    public function deal(){
        if(request()->isAjax()){
            $id = input('id');
            $where = [
                'id' => $id
            ];
            $data = [
                'status' => 1
            ];
            try {
                Db::startTrans();
                $res = Db::name('withdraw')->where($where)->update($data);
                if($res !== false){
                    //增加一个财务记录
                    $info = Db::name('withdraw')->where('id',$id)->find();
                    $add = [
                        'member_id' => $info['member'],
                        'type' => 'withdraw',
                        'model' => 2,
                        'amount' => $info['amount'],
                        'summary' => '代理提现',
                        'date' => time()
                    ];
                    Db::name('member_moneylog')->insert($add);
                    Db::commit();
                    return json(['code' => 1,'msg' => '操作成功','url' => url('index')]);
                }else {
                    Db::rollback();
                    return json(['code' => -1,'msg' => '操作失败,请联系管理员']);
                }
            }catch (Exception $e) {
                Db::rollback();
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
    }


}