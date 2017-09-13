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
	protected function _after_select(&$resultSet,$options){
		foreach($result as $key=>$value){
			$result[$key]["progress"]=round($result[$key]["had"]/$result[$key]["need"]*100,2);
		}
		return $result;
	}
	protected function _after_find(&$result,$options){
		// $vote=$result["vote_support"]+$result["vote_oppose"];
		// $result["rate_support"]=round($result["vote_support"]/$vote*100,2);
		// $result["rate_oppose"]=round($result["vote_oppose"]/$vote*100,2);
//		$result["surplus_time"]=date_create_from_format("Y-m-d H:i:s",$result["finish_time"])->getTimestamp() - time();
		$result["progress"]=round($result["had"]/$result["need"]*100,2);
		$result["funds"]=M("Funds")->where("pid=".$result["id"])->select();
		$result["funds_count"]=M("Funds")->where("pid=".$result["id"])->count();
//		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		return $result;
    }
    //获取status字段相关的where查询条件条件
    public function getWhereWithStatus($status){
        switch ($status) {
            case "prepare":
                $where="`status` like 'run' and `start_time` >= now()";
                break;
            case "fund":
                $where="`status` like 'run' and `start_time` < now()";
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
        $view=M("ProjectView");
        $project=$view->where("id=".$pid." and `status`='run'")->find();

        if($project["had"]>=$project["need"]){
            $this->sell($project["id"]);
            // $result=$this->save(["id"=>$project["id"],"status"=>"sell"]);
            // if(!$result){
            //     return false;
            // }
            // D("Evolve")->log(["pid"=>$pid,"event"=>"fund_end","content"=>""]);
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
        $view=M("ProjectView");
        //定时-未达到所需金额
        $data=$view->where("`status` like 'run' and date_add(`begin_time`, interval `timeLimit` day) <= now()")->select();
        foreach($data as $kay => $item){
            $this->fail($item["id"]);
            // $this->save(["id"=>$item["id"],"status"=>"fail"]);
            // D("Evolve")->log(["pid"=>$item["id"],"event"=>"fund_fail","content"=>""]);
        }
        //定时-60日未出售
        $data=$view->where("`status` like 'sell' and date_add(`end_time`, interval `timeMax` day) <= now()")->select();
        foreach($data as $kay => $item){
            $this->buyback($item["id"]);
            // $this->save(["id"=>$item["id"],"status"=>"buyback"]);
            // D("Evolve")->log(["pid"=>$item["id"],"event"=>"buyback","content"=>""]);
        }
    }
}
?>