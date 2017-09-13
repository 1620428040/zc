<?php
namespace Common\Model;
use Think\Model;

class EvolveModel extends Model {
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
}
?>