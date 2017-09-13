<?php
namespace Common\Model;
use Think\Model;

class VoteModel extends Model {
    protected $_validate = array(
        array('pid','number','项目ID错误'),
        array('money','number','投票金额必须是数字'),
        array('timeLimit','require','投票时间不能为空'),
        array('timeLimit','number','投票时间必须是整数')
	);
    protected function _before_insert(&$data,$options){
        $data["status"]="run";
    }
    public function start($uid){
        $data=$this->create();
        if(!$data){
            return false;
        }
        $this->uid=$uid;

        //关闭之前已经存在的投票
        $old=$this->where("pid=".$data["pid"]." AND `status`='run'")->select();
        if($old){
            foreach($old as $vote){
                $this->stop($vote["id"],$vote["pid"],$uid);
                // $this->save(["id"=>$vote["id"],"status"=>"stop"]);
                // D("Evolve")->log(["pid"=>$vote["pid"],"vid"=>$vote["id"],"uid"=>$vote["uid"],"event"=>"vote_end","content"=>""]);
            }
        }

        $vid = $this->add();
        if($vid){
            D("Evolve")->log(["pid"=>$data["pid"],"vid"=>$vid,"uid"=>$uid,"event"=>"vote_begin","content"=>""]);
        }
        return $vid;
    }
    public function vote($uid,$pid,$vote){
        //检查当前项目能否投票
        if($pid===""){
            $this->error="众筹项目的ID不能为空";
            return false;
        }
        $data=$this->where("`pid`=".$pid." and `status` = 'run'")->find();
        if(!$data){
            $this->error="没有正在进行的投票";
            return false;
        }

        //检查当前用户的投票记录
        $voteUserModel=D("VoteUser");
        $old=$voteUserModel->where("vid=".$data["id"]." and uid=".$uid)->find();
        if($old){
            $this->error="您已经投过票了";
            return false;
        }

        //创建投票记录
        $voteUser=$voteUserModel->create([
            "vid"=>$data["id"],
            "uid"=>$uid,
            "vote"=>$vote
        ]);
        if(!$voteUser){
            $this->error="VoteUser:".$voteUserModel->error;
            return false;
        }
        $result=$voteUserModel->add();
        if($result){
            $res=$this->refresh($data["id"]);
            if(!$res){
                return false;
            }
        }
        else{
            $this->error="VoteUser:".$voteUserModel->error;
            return false;
        }
        return $result;
    }
    public function refresh($vid){
        $view=M("VoteView");
        $vote=$view->where("id=".$vid." and `status`='run'")->find();
        if($vote["support"]*2>$vote["total"]){
            $this->success($vote["id"],$vote["pid"]);
            // $result=$this->save(["id"=>$vid,"status"=>"success"]);
            // if(!$result){
            //     return false;
            // }
            // M("Project")->save(["id"=>$vote["pid"],"status"=>"return"]);
            // D("Evolve")->log(["pid"=>$vote["pid"],"vid"=>$vote["id"],"event"=>"vote_end","content"=>""]);
        }
        return true;
    }
    //投票成功
    public function success($vid,$pid){
        $this->save(["id"=>$vid,"status"=>"success"]);
        M("Project")->save(["id"=>$pid,"status"=>"return"]);
        D("Evolve")->log(["pid"=>$pid,"vid"=>$vid,"event"=>"vote_end","content"=>""]);
    }
    //投票失败
    public function fail($vid,$pid){
        $this->save(["id"=>$vid,"status"=>"fail"]);
        M("Project")->save(["id"=>$pid,"status"=>"sell"]);
        D("Evolve")->log(["pid"=>$pid,"vid"=>$vid,"event"=>"vote_end","content"=>""]);
    }
    //投票终止
    public function stop($vid,$pid,$uid){
        $this->save(["id"=>$vid,"status"=>"stop"]);
        D("Evolve")->log(["pid"=>$pid,"vid"=>$vid,"uid"=>$uid,"event"=>"vote_end","content"=>""]);
    }
    public function autoSubmit(){
        $view=M("VoteView");
        $project=M("Project");
        //定时-7个工作日内未完成交易
        $data=$view->where("`status` like 'success' and date_add(`end_time`, interval 7 day) <= now()")->select();
        foreach($data as $item){
            $project->complete($item["pid"]);
            // $project->save(["id"=>$item["pid"],"status"=>"complete"]);
            // D("Evolve")->log(["pid"=>$item["pid"],"event"=>"complete","content"=>""]);
        }
        //定时-投票期限已到，开始统计投票
        $data=$view->where("`status` like 'run' and date_add(`begin_time`, interval `timeLimit` day) <= now()")->select();
        foreach($data as $vote){
            if($vote["oppose"]*2<$vote["total"]){
                $this->success($vote["id"],$vote["pid"]);
            }
            else{
                $this->fail($vote["id"],$vote["pid"]);
            }
        }
    }
}
?>