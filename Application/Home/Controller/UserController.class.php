<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends MainController{
    //登录页面
    public function login(){
        $this->display();
    }
    //注册页面
    public function regist(){
        $this->display();
    }

    //注册操作
    public function goregist(){
        $username = I('username','');
        $login_pswd = I('password','');
        $login_pswd2 = I('repassword','');
        $qq = I('qq','');
        $phonecode = I('phonecode','');
        if ($username == ''){
            $this->ajaxReturn(array('msg'=>'请输入用户名'));
        }
        if ($login_pswd == ''){
            $this->ajaxReturn(array('msg'=>'登录密码不能为空'));
        }
        if ($login_pswd2 == ''){
            $this->ajaxReturn(array('msg'=>'确认密码不能为空'));
        }
        if ($login_pswd != $login_pswd2){
            $this->ajaxReturn(array('msg'=>'密码设置不一致'));
        }
        if ($qq == ''){
            $this->ajaxReturn(array('msg'=>'QQ号码不能为空'));
        }
        if ($phonecode == ''){
            $this->ajaxReturn(array('msg'=>'手机验证码不能为空'));
        }
        $usermod = M('User');
        //手机号是否已被注册
        $res = $usermod->where(array('username'=>$username))->find();
        if ($res){
            $this->ajaxReturn(array('msg'=>'该手机号码已经注册'));
        }
        //验证手机验证码
        $this->checkphone($username,$phonecode);
        $data = array(
            'username' => $username,
            'password' => md5($login_pswd),
            'phone' => $username,
            'qq' => $qq,
            'register_time' => time(),
            'register_ip' => $_SERVER['REMOTE_ADDR'],
        );
        $in = $usermod->data($data)->add();
        if ($in){
            $this->ajaxReturn(array('msg'=>'success'));
        }else{
            $this->ajaxReturn(array('msg'=>'注册失败，请稍后再试'));
        }
    }


    //登录操作
    public function gologin(){
        $username = I('username','');
        $password = I('password','');
        $imgcode = I('imgcode','');
        if ($username == ''){
            $this->ajaxReturn(array('msg'=>'用户名不能为空'));
        }
        if ($password == ''){
            $this->ajaxReturn(array('msg'=>'密码不能为空'));
        }
        if ($imgcode == ''){
            $this->ajaxReturn(array('msg'=>'验证码不能为空'));
        }
        if (!(check_verify($imgcode,'loginCode'))){
            $this->ajaxReturn(array('msg'=>'图片验证码输入有误'));
        }
        $usermod = M('User');
        $res = $usermod->where(array('username'=>$username))->field('id,username,password')->find();
        if ($res){
            if ($res['password'] == md5($password)){
                session('id',$res['id']);
                session('username',$res['username']);
                $this->ajaxReturn(array('msg'=>'success'));
            }
            else{
                $this->ajaxReturn(array('msg'=>'用户名或密码错误'));
            }
        }else{
            $this->ajaxReturn(array('msg'=>'登录账号不存在'));
        }
    }


    //获取手机验证码
    public function get_verify_code(){
        $phone = I('phone','');
        $imgcode = I('imgcode','');
        $action = I('action','');//验证码图片操作类型，登录、注册。。
        if ($phone == ''){
            $this->ajaxReturn(array('msg'=>'缺少手机号码参数'));
        }
        if ($imgcode == ''){
            $this->ajaxReturn(array('msg'=>'缺少图片验证码参数'));
        }
        if ($action == ''){
            $this->ajaxReturn(array('msg'=>'缺少操作类型验证码参数'));
        }
        if (!(check_verify($imgcode,$action))){
            $this->ajaxReturn(array('msg'=>'图片验证码输入错误'));
        }
        if ($this->send_phone_code($phone)){
            $this->ajaxReturn(array('msg'=>'success'));
        }else{
            $this->ajaxReturn(array('msg'=>'手机验证码发送失败'));
        }
    }


    //验证手机验证码
    private function checkphone($phones,$vcodes){
        $vcode = $vcodes;
        $phone = $phones;
        if ($vcode == '' || $phone == ''){
            $this->ajaxReturn(array('msg'=>'缺少必要参数'));
        }
        $vmod = M('Vphone');
        $res = $vmod->where(array('tel'=>$phone))->find();
        if ($res){
            if ($res['exptime']<time()){
                $this->ajaxReturn(array('msg'=>'验证码已过期请重新获取'));
            }
            if ($res['code'] != $vcode){
                $this->ajaxReturn(array('msg'=>'手机验证码错误'));
            }
            //验证码验证通过，删除验证码
            $vmod->where(array('tel'=>$phone))->delete();
        }else{
            $this->ajaxReturn(array('msg'=>'请先获取手机验证码'));
        }
    }


    //发送手机验证码
    private function send_phone_code($iphone = null){
            if ($iphone == null){
                $this->ajaxReturn(array('msg'=>'手机号不可为空'));
            }
            $vcode = mt_rand(100000,999999);
            $reinfo = sendmsg($vcode,$iphone);
            $encodes = json_decode($reinfo[1]);
            $sendrcode = $encodes->resp->respCode;
            if ($sendrcode == '000000'){
                //发送成功
                $vphonemod = M('Vphone');
                $idata = array(
                    'tel' => $iphone,
                    'code' => $vcode,
                    'exptime' => time()+600,
                );
                $res = $vphonemod->where(array('tel'=>$iphone))->find();
                if ($res){
                    $vphonemod->where(array('tel'=>$iphone))->data($idata)->save();
                }else{
                    $vphonemod->data($idata)->add();
                }
                return true;
            }else{
                //var_dump($reinfo);
                return false;
            }


    }

    //生成图片验证码
    public function verify_img(){
        $action = I('action','');
        if ($action == ''){
            $this->ajaxReturn(array('msg'=>'缺少action参数'));
        }else{
            verifyImg($action);
        }
    }
}