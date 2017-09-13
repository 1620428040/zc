<?php
namespace Common\Model;
use Think\Model;

class FundModel extends Model {
    protected $_validate = array(
	    array('money','number','投标金额必须是数字')
	);
    protected function _before_insert(&$data,$options){
        $view=M("Project");
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
}
?>