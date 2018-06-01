<?php
/**
 * Created by hhzb.
 * User: zwc
 * Date: 2018/2/27
 * Time: 15:01
 */

namespace app\admin\controller;


use think\Db;
use think\Exception;

class Silder extends Base
{
    /**
     * 列表
     */
    public function index() {
        if(request()->isAjax()){
            $data = input('post.');
            unset($data['file']);
            $arr = explode(' ~ ',$data['date']);
            $data['date_start'] = strtotime($arr[0].' 00:00:00');
            $data['date_end'] = strtotime($arr[1].' 23:59:59');
            $data['user'] = $this->user['id'];
            $data['date'] = time();
            try {
                $res = Db::name('silder')->insertGetId($data);
                if($res !== false){
                    return json(['code' => 1,'msg' => '操作成功','url' => url('index')]);
                }else {
                    return json(['code' => -1,'msg' => '操作成功']);
                }
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $where = [];
        $lists = Db::name('silder')->where($where)->order('date DESC')->select();
        foreach ($lists as &$v) {
            $date_start = date('Y-m-d',$v['date_start']);
            $date_end = date('Y-m-d',$v['date_end']);
            $str = '有效期:'.$date_start.' ~ '.$date_end;
            $v['intro'] = $str;
            $v['title'] = msubstr($v['title'],0,30);
        }
        $this->assign('lists',$lists);
        return $this->fetch();
    }
    /**
     * 删除
     */
    public function del(){
        if(request()->isAjax()){
            $id = input('id');
            $where = [
                'id' => $id
            ];
            try {
                $res = Db::name('silder')->where($where)->delete();
                if($res !== false){
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