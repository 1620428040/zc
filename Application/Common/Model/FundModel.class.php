<?php
namespace Common\Model;
use Think\Model;

class FundModel extends Model {
    protected $_validate = array(
	    array('money','number','投标金额必须是数字')
	);
    protected function _before_insert(&$data,$options){
        $view=M("Project");
        $data["time"]=date("Y-m-d H:i:s");
        $project=$view->where("id=".$data["pid"]." and `status`='run'")->find();

        if(!$project){
            $this->error='项目不存在或已结束投标';
            return false;
        }
    }
    public function fund($uid){
        $data=$this->create();
        $this -> uid = $uid;
        
        $projectModel=D("Project");
        $project=$projectModel->where("id=".$data["pid"]." and `status`='run'")->find();

        if(!$project){
            $this->error='项目不存在或已结束投标';
            return false;
        }
        $result=$this->add();
        if($result){
            $res=$projectModel->refresh($data["pid"]);
            if(!$res){
                $this->error='Project:'.$projectModel->error;
                return false;
            }
        }
        return $result;
    }
    //显示整个网站中的投资排行榜
    public function showSiteRanking(){
        $user=$this->tablePrefix."user";
        $data=$this
            ->field('`f`.`uid`,sum(`f`.`money`) AS `money`,`u`.`username`')
            ->alias('f')
            ->group('uid')
            ->join("`$user` AS `u` ON `u`.`id`=`f`.`uid`")
            ->order('`money`')
            ->limit(7)
            ->select();
        return $data;
        // $data=$this
        // ->field('`e`.*,`p`.`title`')
        // ->alias('e')
        // ->join("`$project` AS `p` ON `p`.`id`=`e`.`pid`")
        // ->limit(7)
        // ->select();
    }
}
?>