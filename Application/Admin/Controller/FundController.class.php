<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Common\Common\CustomPage;

class FundController extends AdminController {
    //众筹项目管理
    public function start(){
		$this->display();
	}
    public function running(){
		$this->assignProjectList(6,"run");
		$this->display("list");
    }
    public function onsell(){
		$this->assignProjectList(6,"sell,vote");
		$this->display("list");
    }
    public function returning(){
		$this->assignProjectList(6,"return");
		$this->display("list");
    }
    public function complete(){
		$this->assignProjectList(6,"complete");
		$this->display("list");
    }
    public function failure(){
		$this->assignProjectList(6,"fail");
		$this->display("list");
    }
    public function buyback(){
		$this->assignProjectList(6,"buyback");
		$this->display("list");
    }
	//众筹运营管理
    public function rule(){
		$this->display("Index/null");
    }
    
    //绑定项目列表
	public function assignProjectList($num,$status){
		$model = D('Project');
        if(!$status){
            $where="";
        }
        else{
            $this->assign("status",$status);
            $where=$model->getWhereWithStatus($status);
        }
		$page = CustomPage::defaultPage($count,$num);
        $count = $model -> where($where) -> count();
        $result = $model -> where($where) -> limit($page->firstRow,$page->listRows) -> selectFormView();
		$this->assign('page',$page->show());
        $this->assign("list",$result);
    }

    public function startVote(){
        $this->assign("project",D('Project') -> where("id=".I("pid")) -> find());
        $this->display("startVote");
    }
}
