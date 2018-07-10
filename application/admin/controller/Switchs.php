<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/10
 * Time: 15:54
 */

namespace app\admin\controller;


use think\Db;

class Switchs extends Base
{
    public function index() {
        if($this->request->isAjax()) {
            $params = input('post.');
            if(!isset($params['yaoqing'])) {
                $params['yaoqing'] = 0;
            }
            Db::name('switchs')->delete();
            $data = [];
            foreach ($params as $key => $val) {
                $data[] = [
                    'name' => $key,
                    'values' => $val,
                    'date' => time()
                ];
            }
            Db::name('switchs')->insertAll($data);
            return json(['code' => 1,'msg' => '编辑成功']);
        }
        return $this->fetch();
    }

}