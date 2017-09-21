<?php
namespace Common\Model;
use Think\Model;

class ProjectModel extends Model {
	protected $_validate = array(
	    array('title','require','众筹项目名称不能为空'), 
	    array('need','number','金额必须是数字'), 
	    array('cover','require','不能为空'), 
	    array('yield','is_numeric','预期收益必须是数字',0,'function'), 
	    array('start_time','require','不能为空')
    );
    protected $_auto = array (
        array('status','run')
    );
    public $statusDescription=[
        "prepare"=>"众筹预告",
        "fund"=>"众筹中",
        "run"=>"运营中",//众筹预告或众筹中
        "fail"=>"众筹失败",
        "sell"=>"出售中",
        "vote"=>"投票中",
        "buyback"=>"溢价回购",
        "return"=>"待回款",
        "complete"=>"已售出"
    ];
    public function select($options=array()){
        $options["table"]=$this->getTableName()."_view";
        $result = parent::select($options);
        foreach($result as &$item){
            $item["progress"]=round($item["had"]/$item["need"]*100,2);
            $item["statusDesc"]=$this->statusDescription[$item["status"]];

            $residue="已结束";
            if(!$item["end_time"]){
                $time=strtotime($item["begin_time"]." +".$item["timeLimit"]." day") - time();
                if($time>0){
                    $hour= $time / 3600 % 24;
                    $day = floor($time/(3600*24));
                    $residue = "$day 天 $hour 小时";
                }
            }
            $item["residue"]=$residue;
		}
        return $result;
    }
    public function find($options=array()){
        $options["table"]=$this->getTableName()."_view";
        $result = parent::find($options);
        $result["progress"]=round($result["had"]/$result["need"]*100,2);
        if($result["end_time"]){
            $endTime=strtotime($result["end_time"]);
        }
        else{
            $endTime=strtotime($result["begin_time"]." +".$result["timeLimit"]." day");
        }
        $result["endTime"]=date("Y/m/d H:i:s",$endTime);
        $result["nowTime"]=date("Y/m/d H:i:s");
        return $result;
    }

    public function selectFormView(){
        $view = $this->getTableName()."_view";
        $result = $this->select(["table"=>$view]);
        foreach($result as &$item){
			$item["progress"]=round($item["had"]/$item["need"]*100,2);
		}
		return $result;
    }
    public function findFormView(){
        $view = $this->getTableName()."_view";
        return $this->find(["table"=>$view]);
    }
    //获取status字段相关的where查询条件条件
    public function getWhereWithStatus($status){
        switch ($status) {
            case "prepare":
                $where="`status` like 'run' and `begin_time` >= now()";
                break;
            case "fund":
                $where="`status` like 'run' and `begin_time` < now()";
                break;
            default:
                $status= "'" . str_replace( "," , "','" , $status) . "'" ;//允许查找多个状态
                $where="`status` in (".$status.")";
                break;
        }
        return $where;
    }
    public function start($uid,$fundTime){
        if(!strtotime($fundTime)){
            $this->error="众筹开始时间不正确";
            return false;
        }

        $data=$this->create();
        if(!$data){
            return false;
        }
        $this -> uid = $uid;
        $pid=$this->add();
        if(!$pid){
            return false;
        }

        //创建记录
        $record=D("Evolve");
        $record->log(["pid"=>$pid,"uid"=>$uid,"event"=>"register","content"=>""]);
        $record->log(["pid"=>$pid,"uid"=>$uid,"event"=>"fund_begin","content"=>"","time"=>$fundTime]);
        return $pid;
    }
    //有新的用户投标后，检查是否达到筹款目标
    public function refresh($pid){
        //$view=M("ProjectView");
        $project=$this->where("id=".$pid." and `status`='run'")->findFormView();
        if($project["had"]>=$project["need"]){
            $this->sell($project["id"]);
        }
        return true;
    }
    //结束项目
    public function complete($pid,$uid = 0){
        $result=$this->save(["id"=>$pid,"status"=>"complete"]);
        D("Evolve")->log(["pid"=>$pid,"uid"=>$uid,"event"=>"complete","content"=>""]);
        return $result;
    }
    //开始出售
    public function sell($pid){
        $this->save(["id"=>$pid,"status"=>"sell"]);
        D("Evolve")->log(["pid"=>$pid,"event"=>"fund_end","content"=>""]);
    }
    //众筹失败
    public function fail($pid){
        $this->save(["id"=>$pid,"status"=>"fail"]);
        D("Evolve")->log(["pid"=>$pid,"event"=>"fund_fail","content"=>""]);
    }
    //回购
    public function buyback($pid){
        $this->save(["id"=>$pid,"status"=>"buyback"]);
        D("Evolve")->log(["pid"=>$pid,"event"=>"buyback","content"=>""]);
    }
    //到达指定的时间，自动结算
    public function autoSubmit(){
        //定时-未达到所需金额
        $data=$this->where("`status` like 'run' and date_add(`begin_time`, interval `timeLimit` day) <= now()")->selectFormView();
        foreach($data as $kay => $item){
            $this->fail($item["id"]);
        }
        //定时-60日未出售
        $data=$this->where("`status` like 'sell' and date_add(`end_time`, interval `timeMax` day) <= now()")->selectFormView();
        foreach($data as $kay => $item){
            $this->buyback($item["id"]);
        }
    }
}
?>