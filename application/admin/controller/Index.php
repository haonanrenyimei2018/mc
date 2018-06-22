<?php

namespace app\admin\controller;

use think\Db;

class Index extends Base
{
    public function index()
    {
        return $this->fetch('/index');
    }
    /**
     * [indexPage 后台首页]
     * @return [type] [description]
     * @author [OUTENG欧腾]
     */
    public function indexPage()
    {
        $info = array(
            'web_server' => $_SERVER['SERVER_SOFTWARE'],
            'onload'     => ini_get('upload_max_filesize'),
            'think_v'    => THINK_VERSION,
            'phpversion' => phpversion(),
        );
        $this->assign('info',$info);
        //未申广告数量
        $where = [
            'status' => 0
        ];
        $ad_count = Db::name('ad')->where($where)->count();
        $where = [
            'status' => 1
        ];
        $amount = Db::name('ad')->where($where)->sum('amount');
        //未申代理的数量
        $where = [
            'status' => 0
        ];
        $ag_count = Db::name('agency')->where($where)->count();

        $this->assign([
            'ad_count' => $ad_count,
            'ag_count' => $ag_count,
            'amount' => $amount,
            'article_list' => [],
            'log_list' => []
        ]);
        return $this->fetch('index');
    }
    /**
     * 清除缓存
     */
    public function clear() {
        if (delete_dir_file(CACHE_PATH) || delete_dir_file(TEMP_PATH)) {
            return json(['code' => 1, 'msg' => '清除缓存成功']);
        } else {
            return json(['code' => 0, 'msg' => '清除缓存失败']);
        }
    }

}
