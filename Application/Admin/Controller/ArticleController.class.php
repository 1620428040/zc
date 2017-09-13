<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;

class UserController extends AdminController {
	public $defalutAction="listUser";
    public function listUser(){
    	$data=M("User")->select();
		$this->assign("data",$data);
		$this->display();
    }
	public function fundList(){
		$this->display();
	}
	public function popularize(){
		$this->display();
	}
	public function phoneAuth(){
		$this->display();
	}
	public function realnameAuth(){
		$this->display();
	}
	
}
