<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;

class UserController extends AdminController {
	//会员管理
    public function listUser(){
    	$data=M("User")->select();
		$this->assign("data",$data);
		$this->display();
    }
	//推荐人管理
	public function fundList(){
		$this->display();
	}
	public function popularize(){
		$this->display();
	}
	//认证及申请管理
	public function phoneAuth(){
		$this->display();
	}
	public function realnameAuth(){
		$this->display();
	}
	
}
