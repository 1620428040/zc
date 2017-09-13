<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;

class WidgetController extends Controller {
    public function table(){
    	$data=M("User")->select();
		$fields=array(
			"id"=>"ID",
			"username"=>"用户名",
			"password"=>"密码",
			"pay_password"=>"安全密码",
			"phone"=>"手机号",
			"qq"=>"QQ号",
			"register_time"=>"注册时间",
			"register_ip"=>"注册IP",
			"money"=>"余额"
		);
		$this->assign("data",$data);
		$this->assign("fields",$fields);
		echo $this->fetch();
    }
}
