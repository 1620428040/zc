<?php
// 本类由系统自动生成，仅供测试用途
namespace Api\Controller;
use Think\Controller;

class FundController extends Controller {
    //获取当前用户的id
    public function getUserId(){
        $uid = I("session.id","");
        if($uid === ''){
            $this->error('请先登录');
        }
        return $uid;
    }
    //创建项目的接口
    public function start(){
        $model = D('Project');
        $uid=$this->getUserId();
        $fundTime=I("start_time","");
        $result=$model->start($uid,$fundTime);
        if ($result){
        	$this->success("添加成功",U("Admin/Fund/running"));
        }else{
        	$this->error($model->getError());
        }
    }
    //创建新的投票的接口
    public function startVote(){
        $model=D("Vote");
        $uid=$this->getUserId();
        $result=$model->start($uid);
        if($result){
            $this->success("创建投票成功",U("Admin/Fund/onsell"));
        }else{
        	$this->error($model->getError());
        }
    }
    //结束项目，用户付款、返回、或到期未完成交易
    public function complete(){
        $model = D('Project');
        $uid=$this->getUserId();
        $pid=I("pid","");

        $project=$model->where("id=".$pid)->find();
        if (!$project) {
            $this->error="找不到该项目";
            return false;
        }
        if($project["status"]!=="return"){
            $this->error="该项目不是待回款的项目";
            return false;
        }

        $result=$model->complete($pid,$uid);
        if($result){
            $this->success("众筹项目成功结束",U("Admin/Fund/complete"));
        }
        else{
            $this->error($model->getError());
        }
    }
    //投标的接口
    public function fund(){
        $model=D("Fund");
        $uid=$this->getUserId();
        $result=$model->fund($uid);
        if($result){
            $this->success("投标成功");
        }else{
        	$this->error($model->getError());
        }
    }
    //投票的接口
    public function vote(){
        $model=D("Vote");
        $uid=$this->getUserId();
        $pid=I("pid","");
        $vote=I("vote","");
        $result=$model->vote($uid,$pid,$vote);
        if($result){
            $this->success("投票成功");
        }
        else{
            $this->error($model->getError());
        }
    }


    //到达指定的时间，自动结算的接口
    public function autoSubmit(){
        D('Project')->autoSubmit();
        D('Vote')->autoSubmit();
        echo "success";
    }
}