<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/10
 * Time: 10:23
 */

namespace app\admin\controller;


use think\Db;
use think\Exception;

class AgencyType extends Base
{
    /**
     * 代理类型列表
     */
    public function index() {
        $where = [];
        $data = Db::name('agencyType')->where($where)->select();
        $this->assign('datas',$data);
        return $this->view->fetch();
    }
    /**
     * 添加
     */
    public function add() {
        if($this->request->isAjax()) {
            $params = input('post.');
            $params['date'] = time();
            $params['user'] = $this->user['id'];
            try {
                $res = Db::name('agencyType')->insertGetId($params);
                return json(['code' => 1,'msg' => '添加成功!','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        return $this->view->fetch();
    }
    /**
     * 编辑
     */
    public function edit() {
        if($this->request->isAjax()){
            $params = input('post.');
            $params['date'] = time();
            $params['user'] = $this->user['id'];
            if(!isset($params['status'])) {
                $params['status'] = 0;
            }
            try {
                $where = [
                    'id' => $params['id']
                ];
                $res = Db::name('agencyType')->where($where)->update($params);
                return json(['code' => 1,'msg' => '添加成功!','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $id = input('id');
        $where = [
            'id' => $id
        ];
        $data = Db::name('agencyType')->where($where)->find();
        $this->assign('data',$data);
        return $this->view->fetch();
    }

}