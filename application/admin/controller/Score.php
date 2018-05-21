<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/21
 * Time: 15:44
 */

namespace app\admin\controller;


use app\admin\model\AgencyModel;
use app\admin\model\AgencyTypeModel;
use app\admin\model\SourceInfoModel;
use think\Db;

class Score extends Base
{
    private $agencyModel;
    private $scoreInfoModel;
    private $agencyTypeModel;
    public function _initialize() {
        parent::_initialize();
        $this->agencyModel = new AgencyModel();
        $this->scoreInfoModel = new SourceInfoModel();
        $this->agencyTypeModel = new AgencyTypeModel();
    }
    /**
     * 检索所有的客户已审核
     */
    public function index() {
        $key = input('key');
        $where = [];
        if(!empty($key)){
            $where['name'] = ['like','%'.$key.'%'];
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = $this->agencyModel->where($where)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        if(input('get.page')){
            $lists = $this->agencyModel->where($where)->page($Nowpage, $limits)->select();
            $agencyType = $this->agencyTypeModel->column('id,name');
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
     * 查看详情
     */
    public function detail() {
        $id = input('id');
        $where = [
            'mid' => $id
        ];
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = $this->scoreInfoModel->where($where)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        if(input('get.page')){
            $lists = $this->scoreInfoModel->where($where)->page($Nowpage, $limits)->select();
            foreach ($lists as &$val) {
                $val['date'] = date($val['date'],'Y-m-d H:i:s');
            }
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        return $this->fetch();
    }




}