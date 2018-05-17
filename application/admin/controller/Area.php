<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/10
 * Time: 15:30
 */

namespace app\admin\controller;


use think\Db;
use think\Exception;

class Area extends Base
{
    /**
     *
     */
    public function index() {
        $province = input('province');
        $city = input('city');
        $county = input('county');
        $where = [];
        if(isset($province) && $province > 0){
            $where['provinceCode'] = $province;
        }else {
            $where['provinceCode'] = 0;
        }
        if(isset($city) && $city > 0){
            $where['cityCode'] = $city;
        }else {
            $where['cityCode'] = 0;
        }
        if(isset($county) && $county > 0) {
            $where['areaCode'] = $county;
        }else {
            $where['areaCode'] = 0;
        }
        $data = Db::name('area')->where($where)->order('code ASC')->select();
        $this->assign('datas',$data);
        $this->assign('province',$province);
        $this->assign('city',$city);
        $this->assign('area',$county);
        return $this->view->fetch();
    }
    /*
     * 添加行政区域
     */
    public function add() {
        if($this->request->isAjax()) {
            $params = input('post.');
            $where = [
                'code' => $params['code']
            ];
            $count = Db::name('area')->where($where)->count();
            if($count > 0){
                return json(['code' => -2,'msg' => '编码已经存在']);
            }
            try {
                $res = Db::name('area')->insertGetId($params);
                return json(['code' => 1,'msg' => '操作成功','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $province = input('province');
        $city = input('city');
        $county = input('county');
        $where = [
            'provinceCode' => 0
        ];
        $provinceData = Db::name('area')->where($where)->column('code,name');
        $this->assign([
            'province' => $province,
            'city' => $city,
            'county' => $county,
            'provinceData' => $provinceData
        ]);
        return $this->view->fetch();
    }
    /**
     * 编辑行政区域
     */
    public function edit() {

    }
    public function getRegion() {
        $province = input('province');
        $city = input('city');
        $county = input('county');
        $where = [];
        if(isset($province)) {
            $where['provinceCode'] = $province;
        }
        if(isset($city)) {
            $where['cityCode'] = $city;
        }
        if(isset($county)) {
            $where['areaCode'] = $county;
        }
        $data = Db::name('area')->where($where)->column('code,name');
        return json($data);
    }




}