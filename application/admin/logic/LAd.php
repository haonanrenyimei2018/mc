<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/11
 * Time: 15:54
 */

namespace app\admin\logic;


use app\admin\model\ParamsModel;
use think\Db;
use Think\Exception;

class LAd
{
    /**
     * 广告审核
     */
    public static function adCheck($id) {
        //获取配置文件信息
        $user = session('user');
        $params = new ParamsModel();
        $config = $params->_get();
        try {
            Db::startTrans();
            //更新广告状态
            $update = array(
                'status' => 1
            );
            $where = array(
                'id' => $id
            );
            $res1 = Db::name('ad')->where($where)->update($update);
            //增加一个财务记录
            $ad = Db::name('ad')->where('id',$id)->find();
            $commission = round($ad['amount'] * $config['commission'] / 100,2);
            $performance = round($ad['amount'] * $config['performance'] / 100,2);
            $add = array(
                array(
                    'member_id' => $ad['mid'],
                    'type' => 'return_1',
                    'amount' => $commission,
                    'summary' => '广告接单返还',
                    'model' => 1,
                    'date' => time()
                ),
                array(
                    'member_id' => $ad['mid'],
                    'type' => 'return_2',
                    'amount' => $performance,
                    'summary' => '广告接单绩效',
                    'model' => 1,
                    'date' => time()
                )
            );
            $res2 = Db::name('member_moneylog')->insertAll($add);
            //更新会员的总的业绩和佣金，可提现金额
            $info = Db::name('agency_info')->where('member',$ad['mid'])->find();
            $data = array(
                'money' => $info['money'] + $commission,
                'commission' => $info['commission'] + $commission,
                'performance' => $info['performance'] + $performance
            );
            Db::name('agency_info')->where('member',$ad['mid'])->update($data);
            /**
             * 如果当前用户是市总代就不需要，如果不是，就要给自己的市总代一部分提成
             */
            $agency = Db::name('agency')->find($ad['mid']);
            if($agency['type'] != 1){
                $where = array(
                    'type' => 1,
                    'province' => $agency['province'],
                    'city' => $agency['city']
                );
                $member = Db::name('agency')->where($where)->find();
                if(isset($member)){
                    $amount = round($performance * $config['performance_001'] / 100,2);
                    $insert = array(
                        'member_id' => $member['mid'],
                        'type' => 'return_3',
                        'amount' => $amount,
                        'summary' => '广告接单绩效佣金返还',
                        'model' => 1,
                        'date' => time()
                    );
                    $res3 = Db::name('member_moneylog')->insertGetId($insert);
                    $info = Db::name('agency_info')->where('member',$member['id'])->find();
                    $data = array(
                        'money' => $info['money'] + $amount,
                        'commission' => $info['commission'] + $amount,
                    );
                    Db::name('agency_info')->where('member',$member['id'])->update($data);
                }
            }else {
                $res3 = 1;
            }
            //增加积分
            $where = [
                'begin' => ['elt',$ad['amount']],
                'end' => ['egt',$ad['amount']]
            ];
            $c = Db::name('score_money')->where($where)->order('begin ASC')->find();
            if(isset($c)) {
                $addData = [
                    'mid' => $ad['mid'],
                    'type' => 1,
                    'amount' => $c['score'],
                    'user' => $user['id'],
                    'summary' => '',
                    'date' => time()
                ];
                Db::name('sources_info')->insertGetId($addData);
            }


            if($res1 !== false && $res2 !== false && $res3 !== false) {
                Db::commit();
                return ['code' => 1,'msg' => '操作成功'];
            }else {
                Db::rollback();
                return ['code' => -1,'msg' => '操作失败'];
            }
        }catch (Exception $e) {
            Db::rollback();
            return ['code' => -99,'msg' => $e->getMessage()];
        }
    }
}