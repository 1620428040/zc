<?php
namespace Common\Model;
use Think\Model;

class EvolveModel extends Model {
    public $defaultContent=[
        "register"=>"项目注册成功",
        "fund_begin"=>"众筹开始",
        "fund_end"=>"众筹结束",
        "fund_fail"=>"众筹失败",
        "vote_begin"=>"投票开始",
        "vote_end"=>"投票结束",
        "vote_stop"=>"投票终止",
        "complete"=>"项目结束",
        "buyback"=>"平台溢价回购"
    ];
    public function log($data){
        $default=[
            "pid"=>0,
            "vid"=>0,
            "uid"=>0,
            "event"=>"",
            "content"=>"",
            "time"=>date("Y-m-d H:i:s")
        ];
        $data=array_merge($default,$data);
        $res=$this->create($data);
        return $this->add();
    }
    protected function _after_select(&$resultSet,$options){
        foreach($resultSet as &$result){
            if($result["content"]===""){
                $content=$this->defaultContent[$result["event"]];
                if(!$content) $content=$result["event"];
                $result["content"]=$content;
            }
        }
    }
    //显示整个网站中，最新的事件
    function showSiteEvolve(){
        $project=$this->tablePrefix."project";
        $data=$this
            ->field('`e`.*,`p`.`title`')
            ->alias('e')
            ->join("`$project` AS `p` ON `p`.`id`=`e`.`pid`")
            ->limit(7)
            ->select();
        //print_r($data);exit;
        return $data;
    }
}
?>