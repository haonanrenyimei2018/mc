<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/26
 * Time: 9:18
 */

namespace app\admin\controller;


use think\Db;

class Ranking extends Base
{
    public function index() {
        $members = Db::name('agency')->column('id,name');
        $data = [];
        $limits = input('limits') ? input('limits') : 10;
        $startTime = input('satrt_time') ? input('satrt_time') : '';
        $endTime = input('end_time') ? input('end_time') : '';
        $isQuery = 0;
        $params = input();
        if($this->request->isPost()) {
            $params = input('post.');
            $startTime = strtotime($params['start_time']);
            $endTime = strtotime($params['end_time']);
            $SQL = 'select sum(amount) as amount,member_id from mc_member_moneylog where date between '.
                    $startTime . ' and '. $endTime . ' group by member_id order by amount DESC limit '.$limits;

            $data = Db::query($SQL);
            foreach ($data AS &$val) {
                $val['member'] = $members[$val['member_id']];
            }
            $isQuery = 1;
        }else {
            $params['start_time'] = '';
            $params['end_time'] = '';
        }
        $this->assign('isQuery',$isQuery);
        $this->assign('startTime',$params['start_time']);
        $this->assign('endTime',$params['end_time']);
        $this->assign('limits',$limits);
        $this->assign('data',$data);
        return $this->fetch();
    }

}