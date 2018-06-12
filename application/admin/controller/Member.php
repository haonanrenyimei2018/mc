<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\5\14 0014
 * Time: 22:30
 */

namespace app\admin\controller;


use app\admin\logic\LMember;
use app\admin\model\MemberInfoModel;
use app\wap\logic\LMembers;
use think\Db;
use Think\Exception;

class Member extends Base
{
    /**
     * 全部的会员
     */
    public function index() {
        $key = input('key');
        $where = [];
        if(!empty($key)){
            $where['name'] = ['like','%'.$key.'%'];
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = Db::name('agency')->where($where)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        if(input('get.page')){
            $lists = Db::name('agency')->where($where)->page($Nowpage, $limits)->select();
            $agencyType = Db::name('agencyType')->column('id,name');
            foreach ($lists as &$val) {
                $val['type_name'] = $agencyType[$val['type']];
            }
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val',$key);
        return $this->fetch();
    }
    /**
     * 待审核的会员
     */
    public function uncheck() {
        $key = input('key');
        $where = [
            'status' => 0
        ];
        if(!empty($key)){
            $where['name'] = ['like','%'.$key.'%'];
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = Db::name('agency')->where($where)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        if(input('get.page')){
            $lists = Db::name('agency')->where($where)->page($Nowpage, $limits)->select();
            $agencyType = Db::name('agencyType')->column('id,name');
            foreach ($lists as &$val) {
                $val['type_name'] = $agencyType[$val['type']];
            }
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val',$key);
        return $this->fetch();
    }
    /**
     * 审核会员
     */
    public function check() {
        if($this->request->isAjax()) {
            $params = input('post.');
            try {
                Db::startTrans();
                //如果当前客户选的是市总代理，首先要检测当前城市是否已经有市总代了
                if($params['type'] == 1){
                    $where = [
                        'type' => 1,
                        'province' => $params['province'],
                        'city' => $params['city'],
                        'date_end' => ['gt',time()],
                        'status' => 1
                    ];
                    $count = Db::name('agency')->where($where)->count();
                    if($count > 0) {
                        return json(['code' => '-2','msg' => '市总代理已经存在!']);
                    }
                }
                $score = $params['score'];
                unset($params['score']);
                $memberInfo = new MemberInfoModel();
                $memberInfo->add_store($params['id'],$score);
                $lm = new LMember();
                $lm->check($params['id']);
                //最后修改代理的状态
                $params['status'] = 1;
                $params['date_end'] = strtotime("+1 year");
                Db::name('agency')->where('id',$params['id'])->update($params);
                Db::commit();
                return json(['code' => 1,'msg' => '操作成功!','url' => url('uncheck')]);
            }catch (Exception $e) {
                Db::rollback();
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $id = input('id');
        $member = Db::name('agency')->where('id',$id)->find();
        $where = [
            'provinceCode' => 0
        ];
        $provinceData = Db::name('area')->where($where)->column('code,name');
        $cityData = [];
        if(!empty($member['province'])) {
            $where =[
                'provinceCode' => $member['province'],
                'cityCode' => 0
            ];
            $cityData = Db::name('area')->where($where)->column('code,name');
        }
        $countyData = [];
        if(!empty($member['city'])) {
            $where =[
                'provinceCode' => $member['province'],
                'cityCode' => $member['city']
            ];
            $countyData = Db::name('area')->where($where)->column('code,name');
        }
        $areaData = [];
        if(!empty($member['city'])) {
            $where =[
                'provinceCode' => $member['province'],
                'cityCode' => $member['city'],
                'areaCode' => $member['county']
            ];
            $areaData = Db::name('area')->where($where)->column('code,name');
        }
        $agencyType = Db::name('agencyType')->column('id,name');
        //所有已审核过的代理
        $members = Db::name('agency')->where('status',1)->column('id,name');
        $this->assign([
            'member' => $member,
            'provinceData' => $provinceData,
            'cityData' => $cityData,
            'countyData' => $countyData,
            'areaData' => $areaData,
            'agencyType' => $agencyType,
            'members' => $members
        ]);
        return $this->fetch();
    }
    public function edit() {
        if($this->request->isAjax()) {
            $params = input('post.');
            try {
                Db::name('agency')->where('id',$params['id'])->update($params);
                return json(['code' => 1,'msg' => '操作成功!','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $id = input('id');
        $member = Db::name('agency')->where('id',$id)->find();
        $where = [
            'provinceCode' => 0
        ];
        $provinceData = Db::name('area')->where($where)->column('code,name');
        $cityData = [];
        if(!empty($member['province'])) {
            $where =[
                'provinceCode' => $member['province'],
                'cityCode' => 0
            ];
            $cityData = Db::name('area')->where($where)->column('code,name');
        }
        $countyData = [];
        if(!empty($member['city'])) {
            $where =[
                'provinceCode' => $member['province'],
                'cityCode' => $member['city']
            ];
            $countyData = Db::name('area')->where($where)->column('code,name');
        }
        $areaData = [];
        if(!empty($member['city'])) {
            $where =[
                'provinceCode' => $member['province'],
                'cityCode' => $member['city'],
                'areaCode' => $member['county']
            ];
            $areaData = Db::name('area')->where($where)->column('code,name');
        }

        $agencyType = Db::name('agencyType')->column('id,name');
        $this->assign([
            'member' => $member,
            'provinceData' => $provinceData,
            'cityData' => $cityData,
            'countyData' => $countyData,
            'areaData' => $areaData,
            'agencyType' => $agencyType
        ]);
        return $this->fetch();
    }
    //
    public function aa() {
        $res = date('Y-m-d H:i:s',strtotime("+1 year"));
        dump($res);

    }



}