<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 10:43
 * 积分商城
 */

namespace app\index\controller;


use app\model\AgencyInfoModel;
use app\model\MProduct;

class Shop extends Base
{
    private $productModel;
    private $agencyInfoModel;
    public function _initialize() {
        parent::_initialize();
        $this->productModel = new MProduct();
        $this->agencyInfoModel = new AgencyInfoModel();
    }
    /**
     * 获取积分商城的产品
     */
    public function index() {
        $pageSize = 15;
        $where = [
            'state' => 1,
            'amount' => ['gt',0]
        ];
        $data = $this->productModel->where($where)->order('date DESC')->page(1,$pageSize)->select();
        $count = $this->productModel->where($where)->count();
        $pageCount = ceil($count/$pageSize);
        $this->assign('datas',$data);
        $this->assign('pageSize',$pageSize);
        $this->assign('pageCount',$pageCount);
        //获取我的积分
        $where = [
            'member' => $this->user['id']
        ];
        $info = $this->agencyInfoModel->where($where)->find();
        $this->assign('score',$info['score']);
        return $this->view->fetch();
    }
    /**
     * 获取下一页
     */
    public function getData() {
        $page = input('page');
        $pageSize = input('pageSize');
        $where = [
            'state' => 1,
            'amount' => ['gt',0]
        ];
        $data = $this->productModel->where($where)->page($page,$pageSize)->order('date DESC')->select();
        return json($data);
    }
    /**
     * 查看详情
     */
    public function detail() {

    }



}