<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 10:43
 * 积分商城
 */

namespace app\index\controller;


use app\model\SourceInfoModel;
use app\model\AgencyInfoModel;
use app\model\MemberProductModel;
use app\model\MProduct;
use think\Db;
use Think\Exception;

class Shop extends Base
{
    private $productModel;
    private $agencyInfoModel;
    private $memberProductModel;
    private $sourceInfoModel;
    private $pageSize = 15;
    public function _initialize() {
        parent::_initialize();
        $this->productModel = new MProduct();
        $this->agencyInfoModel = new AgencyInfoModel();
        $this->memberProductModel = new MemberProductModel();
        $this->sourceInfoModel = new SourceInfoModel();
    }
    /**
     * 获取积分商城的产品
     */
    public function index() {
        $where = [
            'state' => 1,
            'amount' => ['gt',0]
        ];
        $data = $this->productModel->where($where)->order('date DESC')->page(1,$this->pageSize)->select();
        $count = $this->productModel->where($where)->count();
        $pageCount = ceil($count/$this->pageSize);
        $this->assign('datas',$data);
        $this->assign('pageSize',$this->pageSize);
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
        $where = [
            'state' => 1,
            'amount' => ['gt',0]
        ];
        $data = $this->productModel->where($where)->page($page,$this->pageSize)->order('date DESC')->select();
        return json($data);
    }
    /**
     * 查看详情
     */
    public function detail() {
        $id = input('id');
        $info = $this->productModel->where('id',$id)->find();
        $this->assign('info',$info);
        //我的积分
        $where = array(
            'member' => $this->user['id']
        );
        $info = $this->agencyInfoModel->where($where)->find();
        $this->assign('user_score',$info['score']);
        return $this->view->fetch();
    }
    /**
     * 积分兑换产品
     */
    public function buy() {
        $p_id = input('id');
        $product = $this->productModel->find($p_id);
        if($product['amount'] == 0){
            return json(['code' => -2,'msg' => '库存告急!']);
        }
        $where = array(
            'member' => $this->user['id']
        );
        $info = $this->agencyInfoModel->where($where)->find();
        if($info['score'] < $product['sources']) {
            return json(['code' => -2,'msg' => '积分不足!']);
        }
        try {
            Db::startTrans();
            //代理购买记录
            $data = array(
                'member' => $this->user['id'],
                'product' => $p_id,
                'date' => time()
            );
            $this->memberProductModel->insertGetId($data);
            //代理积分记录表
            $data_1 = array(
                'mid' => $this->user['id'],
                'type' => 2,
                'amount' => $product['sources'],
                'summary' => '兑换产品:'.$product['name'],
                'date' => time(),
                'user' => 0
            );
            $this->sourceInfoModel->insertGetId($data_1);
            //修改我的积分
            $data_2 = array(
                'score' => $info['score'] - $product['sources']
            );
            $this->agencyInfoModel->where('member',$this->user['id'])->update($data_2);
            //修改产品的库存量
            $data_3 = array(
                'amount' => $product['amount'] - 1
            );
            $this->productModel->where('id',$p_id)->update($data_3);
            Db::commit();
            return json(['code' => 1,'msg' => '兑换成功,请联系官方客服!','url' => url('index')]);
        }catch (Exception $e) {
            Db::rollback();
            return json(['code' => -99,'msg' => $e->getMessage()]);
        }
    }
    /**
     * 我的兑换记录
     */
    public function my() {
        $where = array(
            'member' => $this->user['id']
        );
        $count = $this->memberProductModel->where($where)->count();
        $pageCount = ceil($count/$this->pageSize);
        $datas = $this->memberProductModel->where($where)->page(1,$this->pageSize)->order('date DESC')->select();
        foreach($datas AS &$val) {
            $val['product'] = $this->productModel->find($val['product']);
        }
        $this->assign('pageCount',$pageCount);
        $this->assign('datas',$datas);
        return $this->view->fetch();
    }
    public function getData_my() {
        $page = input('page');
        $where = [
            'member' => $this->user['id']
        ];
        $data = $this->memberProductModel->where($where)->page($page,$this->pageSize)->order('date DESC')->select();
        foreach($data AS &$val) {
            $val['product'] = $this->productModel->find($val['product']);
        }
        return json($data);
    }
}