<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/11
 * Time: 11:58
 * 培训课程
 */

namespace app\admin\controller;


use think\Db;
use think\Exception;

class Course extends Base
{
    /**
     * 培训课程
     */
    public function index() {
        $val = input('key');
        $where = [];
        if(isset($val) && !empty($val)) {
            $where['title|content'] = ['like' , '%'.$val.'%'];
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = Db::name('course')->where($where)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        if(input('get.page')){
            $lists = Db::name('course')->where($where)->page($Nowpage, $limits)->select();
            //教育培训类别
            $types = Db::name('course_cate')->column('id,name');
            //去向
            $target = config('target');
            foreach ($lists as &$val) {
                $val['type_name'] = $types[$val['type']];
                $arr = explode(',',$val['target']);
                $targets = '';
                for ($i=0;$i<count($arr);++$i){
                    $targets .= $target[$arr[$i]].',';
                }
                $val['target'] = $targets;
            }
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val',$val);
        return $this->fetch();
    }
    /**
     * 添加
     */
    public function add() {
        if($this->request->isAjax()){
            $params = input('post.');
            $params['times'] = 0;
            $params['date'] = time();
            $params['user'] = $this->user['id'];
            $params['target'] = implode(',',$params['target']);
            try {
                if($params['model'] == 2){

                }
                $id = Db::name('course')->insertGetId($params);



                $members = Db::name('agency')->where('status',1)->column('id,name');
                $datas = [];
                foreach ($members as $key => $val) {
                    $datas[] = [
                        'cid' => $id,
                        'mid' => $key,
                        'state' => 0,
                        'date' => time()
                    ];
                }
                Db::name('course_member')->insertAll($datas);
                return json(['code' => 1,'msg' => '添加成功!','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        //教育培训类别
        $types = Db::name('course_cate')->column('id,name');
        //去向
        $target = config('target');
        $this->assign([
            'types' => $types,
            'target' => $target
        ]);
        return $this->fetch();
    }
    /**
     * 编辑
     */
    public function edit() {
        if($this->request->isAjax()){
            $params = input('post.');
            $params['date'] = time();
            $params['target'] = implode(',',$params['target']);
            try {
                Db::name('course')->where('id',$params['id'])->update($params);
                return json(['code' => 1,'msg' => '修改成功!','url' => url('index')]);
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $id = input('id');
        $data = Db::name('course')->where('id',$id)->find();
        $this->assign('data',$data);
        //教育培训类别
        $types = Db::name('course_cate')->column('id,name');
        //去向
        $target = config('target');
        $this->assign([
            'types' => $types,
            'target' => $target
        ]);

        return $this->view->fetch();
    }
    /**
     * 删除
     */
    public function del() {
        $id = input('id');
        try {
            Db::name('course')->where('id',$id)->delete();
            return json(['code' => 1,'msg' => '删除成功']);
        }catch (Exception $e) {
            return json(['code' => -99,'msg' => $e->getMessage()]);
        }
    }
    //培训课程分类
    /**
     * 列表
     */
    public function index_cat() {
        $val = input('key');
        $where = [];
        if(isset($val) && !empty($val)) {
            $where['name'] = ['like' , '%'.$val.'%'];
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = Db::name('course_cate')->where($where)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        if(input('get.page')){
            $lists = Db::name('course_cate')->where($where)->page($Nowpage, $limits)->select();
            return json($lists);
        }
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('val',$val);
        return $this->fetch();
    }
    /**
     * 添加
     */
    public function add_cat() {
        if($this->request->isAjax()) {
            $data = input('post.');
            $data['date'] = time();
            $data['status'] = 1;
            try {
                $res = Db::name('course_cate')->insertGetId($data);
                if($res !== false) {
                    return json(['code' => 1,'msg' => '操作成功!','url' => url('index_cat')]);
                }else {
                    return json(['code' => -1,'msg' => '操作失败!请联系管理员']);
                }
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        return $this->fetch();
    }
    /**
     * 编辑
     */
    public function edit_cat() {
        if($this->request->isAjax()) {
            $data = input('post.');
            try {
                $res = Db::name('course_cate')->where('id',$data['id'])->update($data);
                if($res !== false) {
                    return json(['code' => 1,'msg' => '操作成功!','url' => url('index_cat')]);
                }else {
                    return json(['code' => -1,'msg' => '操作失败!请联系管理员']);
                }
            }catch (Exception $e) {
                return json(['code' => -99,'msg' => $e->getMessage()]);
            }
        }
        $id = input('id');
        $data = Db::name('course_cate')->find($id);
        $this->assign('data',$data);
        return $this->fetch();

    }
    /**
     * 删除
     */
    public function del_cat() {
        $id = input('id');
        try {
            $res = Db::name('course_cate')->delete($id);
            return json(['code' => 1,'msg' => '删除成功','url' => url('index_cat')]);
        }catch (Exception $e) {
            return json(['code' => -99,'msg' => $e->getMessage()]);
        }
    }
}