<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Cache;
use Think\Cache\Driver\File;

class IndexController extends AdminController {
    public function index(){
		$this->display();
    }
	//TODO:这个地方其实没什么实际效果，原因是scandir函数返回的结果不对，有空再改
	public function clear(){
//		$cache = Cache::getInstance();//另一种方法，但也是没有效果
		$cache = new File();
		$result=$cache->clear();
		$this->display();
	}
}
