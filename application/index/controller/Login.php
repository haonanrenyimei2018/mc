<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/23
 * Time: 14:22
 */

namespace app\index\controller;


use app\index\model\AgencyModel;
use app\index\model\AgencyTypeModel;
use think\Controller;
use Think\Exception;

class Login extends Controller
{
    private $agencyModel;
    private $agencyTypeModel;
    public function _initialize() {
        $this->agencyModel = new AgencyModel();
        $this->agencyTypeModel = new AgencyTypeModel();
    }

    /**
     * 登陆
     * @return string
     */
    public function index() {
        return $this->view->fetch();
    }
    /**
     * 登陆
     */
    public function login() {
        return $this->fetch();
    }
    /**
     * 登陆事件
     */
    public function doLogin() {
        if(request()->isAjax()){
            $data = input('post.');
            $where = [
                'username' => $data['username'],
                'password' => md5($data['userPwd'])
            ];
            $agency = $this->agencyModel->where($where)->find();
            if(isset($agency)) {
                if($agency['status'] !== 1) {
                    return json(['code' => -2,'msg' => '代理账号异常!']);
                }
                if(time() > $agency['date_end']) {
                    return json(['code' => -3,'msg' => '代理有效期已到，请联系官方!']);
                }
                return json(['code' => '1','msg' => '登陆成功!','url' => url('/index/index/index')]);
            }else {
                return json(['code' => -1,'msg' => '用户名或密码不正确']);
            }
        }
    }
    /**
     * 注销登陆
     */
    public function loginout() {
        session('member',null);
        return $this->fetch('login');
    }
    /**
     * 注册
     */
    public function register() {
        //代理类型
        $agencyTypes = $this->agencyTypeModel->select();
        $this->assign('types',$agencyTypes);
        return $this->fetch();
    }
    /**
     * 注册第二步，同意协议
     */
    public function register_1() {
        $data = $_GET;
        $type = $data['type'];
        $types = $this->agencyTypeModel->where('id',$type)->find();
        $this->assign('type',$types);
        return $this->view->fetch();
    }
    /**
     * 注册第三步
     */
    public function register_2() {
        if(request()->isAjax()) {
            $data = input('post.');
            $data['status'] = 0;
            $data['date'] = time();
            $data['password'] = md5($data['password']);
            //检测用户名是否存在
            $where = [
                'username' => $data['username']
            ];
            $count = $this->agencyModel->where($where)->count();
            if($count > 0) {
                return json(['code' => -2,'msg' => '用户名重复']);
            }
            try{
                $this->agencyModel->insertGetId($data);
                return json(['code' => 1,'msg' => '添加成功','url' => url('login')]);
            }catch (Exception $e) {
                return json(['code' => -999,'msg' => $e->getMessage()]);
            }
        }
        $type = input('type');
        $this->assign('type',$type);
        return $this->view->fetch();
    }



}