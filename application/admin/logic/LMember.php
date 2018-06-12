<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 8:49
 */
namespace app\admin\logic;

use app\admin\model\AgencyModel;
use app\admin\model\AgencyTypeModel;
use app\admin\model\MemberMoneyLogModel;
use app\admin\model\ParamsModel;
use think\Db;

class LMember
{
    private $agencyModel;
    private $atModel;
    private $paramsModel;
    private $memberMoneylogModel;

    public function __construct()
    {
        $this->agencyModel = new AgencyModel();
        $this->atModel = new AgencyTypeModel();
        $this->paramsModel = new ParamsModel();
        $this->memberMoneylogModel = new MemberMoneyLogModel();
    }
    /**
     * 审核
     * 没有推荐人，就把当前代理所在区县的市总代理10%的提成
     * 有推荐人，根据设置的规则，返还给推荐人所在市的总代相应的百分比
     */
    public function check($id) {
        $member = $this->agencyModel->where('id',$id)->find();
        $type = $this->atModel->where('id',$member['type'])->find();
        $params = $this->paramsModel->_get();
        //根据当前客户类型设置返还的基数
        $amount = $type['money'];
        switch ($member['type']) {
            case 1 :
                $money = $amount * $params['return_001'] / 100;
                break;
            case 2 :
                $money = $amount * $params['return_002'] / 100;
                break;
            case 3 :
                $money = $amount * $params['return_003'] / 100;
                break;
            case 4 :
                $money = $amount * $params['return_004'] / 100;
                break;
        }
        $money = round($money,2);
        $last_money = round($amount * $params['return_all'] / 100 - $money,2);
        $insert = [
            'member_id' => $id,
            'type' => 'return',
            'model' => '1',
            'amount' => $money,
            'summary' => '代理返还',
            'date' => time()
        ];
        $this->memberMoneylogModel->insertGetId($insert);
        $update = [
            'money' => $money,
            'commission' => $money
        ];
        Db::name('agency_info')->where('member',$id)->update($update);
        //增加可提现金额和总的佣金
        if(empty($member['is_pid'])) {
            $where = [
                'type' => 1,
                'province' => $member['province'],
                'city' => $member['city'],
                'status' => 1,
                'date_end' => ['gt',time()]
            ];
            $member_1 = $this->agencyModel->where($where)->find();
            if(isset($member_1)) {
                //总代存在
                $data = [
                    'member_id' => $member_1['id'],
                    'type' => 'return',
                    'model' => '1',
                    'amount' => $last_money,
                    'summary' => '代理返还,来自代理'.$member['name'],
                    'date' => time()
                ];
                $this->memberMoneylogModel->insertGetId($data);

                $info = Db::name('agency_info')->where('member',$member_1['id'])->find();
                $update = [
                    'money' => $info['money'] + $money,
                    'commission' => $info['commission'] + $money
                ];
                Db::name('agency_info')->where('member',$member_1['id'])->update($update);
            }
        }else {
            //推荐人
            $member_2 = $this->agencyModel->where('id',$member['pid'])->find();
            $where = [
                'type' => 1,
                'province' => $member_2['province'],
                'city' => $member_2['city'],
                'status' => 1,
                'date_end' => ['gt',time()]
            ];
            $member_1 = $this->agencyModel->where($where)->find();
            if(isset($member_1)) {
                //总代存在
                $data = [
                    'member_id' => $member_1['id'],
                    'type' => 'return',
                    'model' => '1',
                    'amount' => $last_money,
                    'summary' => '代理返还,来自代理'.$member['name'],
                    'date' => time()
                ];
                $this->memberMoneylogModel->insertGetId($data);
                $info = Db::name('agency_info')->where('member',$member_1['id'])->find();
                $update = [
                    'money' => $info['money'] + $money,
                    'commission' => $info['commission'] + $money
                ];
                Db::name('agency_info')->where('member',$member_1['id'])->update($update);
            }
        }
    }
}