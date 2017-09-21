<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
use Common\Common\CustomPage;

class IndexController extends Controller {
    public function index(){
        $model = D('Project');

        //全部项目
        $project = $model -> limit(6) -> select();
        $this->assign("project",$project);

        //众筹预告
        $where=$model->getWhereWithStatus("prepare");
        $prepare = $model -> where($where) -> limit(6) -> select();
        $this->assign("prepare",$prepare);

        //众筹中
        $where=$model->getWhereWithStatus("fund");
        $fund = $model -> where($where) -> limit(6) -> select();
        $this->assign("fund",$fund);

        //出售中
        $sell = $model -> where("`status` = 'sell'") -> limit(6) -> select();
        $this->assign("sell",$sell);

        //已出售
        $complete = $model -> where("`status` = 'complete'") -> limit(6) -> select();
        $this->assign("complete",$complete);

        //项目动态(全站)
        $evolve = D("Evolve") -> showSiteEvolve();
        $this->assign("evolve",$evolve);

        $fund = D("Fund") -> showSiteRanking();
        $this->assign("fund",$fund);

		$this->display();
    }
    
    //about
	public function about(){
		$this->display();
	}
	public function details(){
        $pid=I("id","");
        if($pid===""){
            $this->error("项目不存在！");
        }

        $project = D('Project') -> where("id=$pid") -> find();
        $this->assign("project",$project);
        
        $vote = D('Vote') -> where("pid=$pid AND `status` in('run','success')") -> find();
        $this->assign("vote",$vote);

        $model=D('Fund');
        $where="pid=$pid";
        $fundCount= $model -> where($where) -> count();
        $fund = $model -> where($where) -> select();
        $this->assign("fundCount",$fundCount);
        $this->assign("fund",$fund);

        $evolve=D("Evolve")->where("pid=$pid")->select();
        $this->assign("evolve",$evolve);

        // print_r($evolve);
        // print_r($project);
        // print_r($vote);
        // print_r($fundCount);
        // print_r($fund);
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
