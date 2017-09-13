<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
use Common\Common\CustomPage;

class IndexController extends Controller {
    public function index(){
        $model = D('Project');
        $where=$model->getWhereWithStatus("prepare");
        $result = $model -> where($where) -> limit($page->firstRow,$page->listRows) -> select();
        $this->assign("prepare",$result);

		A("Admin/Fund")->assignProjectList(6,I("status"));
		$this->display();
    }
    
    //about
	public function about(){
		$this->display();
	}
	public function details(){
		$this->assign("project",D('Project') -> where("id=".I("id")) -> find());
		$this->display();
	}
	public function lists(){
        A("Admin/Fund")->assignProjectList(6,I("status"));
		$this->display();
	}
	public function login(){
		$this->display();
	}
	public function logout(){
		session('id',null);
        session('username',null);
		$this->display("login");
	}
	public function register(){
		$this->display();
	}
	public function xszd(){
		$this->display();
	}
}
