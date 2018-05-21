<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 17:09
 */

namespace app\admin\model;


use Think\Exception;
use think\Model;

class MemberInfoModel extends Model
{
    protected $name = 'agency_info';
    protected $autoWriteTimestamp = false;   // 开启自动写入时间戳

    /**
     * 注册
     * @return mixed|void
     */
    public function add_store($id,$score){
        $data = [
            'member' => $id,
            'money' => 0,
            'commission' => 0,
            'performance' => 0,
            'score' => $score,
            'date' => time()
        ];
        try {
            $this->insertGetId($data);
            return true;
        }catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param $id 会员ID
     * @param $model 增加还是减少
     * @param $type 类型
     * @param int $amount 金额
     */
    public function change($id,$model,$type,$amount = 0) {
        $data = $this->where('member_id',$id)->find();
        switch ($type) {
            case 1 :
                //更新可提现金额，和累计佣金
                if($model == 1) {
                    $data['commission'] += $amount;
                    $data['money'] += $amount;
                }else {
                    $data['money'] -= $amount;
                }
                break;
            case 2 :
                //更新业绩
                if($model == 1) {
                    $data['performance'] += $amount;
                }else {
                    $data['performance'] -= $amount;
                }
                break;
            case 3 :
                if($model == 1) {
                    $data['score'] += $amount;
                }else {
                    $data['score'] -= $amount;
                }
                break;
        }
        try {
            $this->where('member_id',$id)->update($data);
            return true;
        }catch (Exception $e) {
            return false;
        }
    }
}