<?php
namespace Home\Controller;
use Think\Controller;
class MainController extends Controller {

    public function _initialize()
    {
        $status = $this->check_login();
        if (!$status){
            $this->display("Index:login");
            exit;
        }
    }


    /*
     * 登录验证
     */
    private function check_login(){
        $controller = CONTROLLER_NAME;
        $action = ACTION_NAME;
        $access = array(
            'index',//网站首页
            'login',//登录页面
            'regist',//注册页面
            'goregist',//注册操作
            'gologin',//登录操作
            'get_verify_code',//获取手机验证码
            'verify_img',//生成图片验证码
        );
        if (in_array($action,$access)){
            return true;
        }else{
            $acid = session('id');
            $acusername = session("username");
            if ($acid && $acusername){
                return true;
            }else{
                return false;
            }
        }
    }


}