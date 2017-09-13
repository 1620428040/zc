<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;

class AdminController extends Controller {
	function _initialize(){
		$controller = CONTROLLER_NAME ?  CONTROLLER_NAME : "Index";
		$action = ACTION_NAME === "index"? $this->defalutAction : ACTION_NAME;
		
		//列出所有一级目录$menu0
		$menu0=M("Menu")->where("pid=0")->select();
		foreach($menu0 as $key0=>$value0){
			//列出当前一级目录下的二级目录$menu1
			$menu1=M("Menu")->where("pid=".$value0["id"])->select();
			foreach($menu1 as $key1=>$value1){
				//列出当前二级目录下的三级目录$menu2
				$menu2=M("Menu")->where("pid=".$value1["id"])->select();
				foreach($menu2 as $key2=>$value2){
					//如果三级目录的name和当前action相符，则选中此目录
					if($action === strtolower($value2["name"])){
						$menu1[$key1]["selected"] = 'Menu-li';
						$menu2[$key2]["selected"] = 'sele-li';
					}
					//生成三级目录对应的页面
					$menu2[$key2]["href"] = U($value0["name"]."/".$value2["name"]);
				}
				//将三级目录挂到二级目录上
				$menu1[$key1]["list"]=$menu2;
			}
			//如果一级目录的name和当前控制器相符，则选中此目录，并且将数据放到$subMenu中
			if($controller === $value0["name"]){
				$menu0[$key0]["selected"] = 'selected';
				$subMenu=$menu1;
			}
			$menu0[$key0]["href"] = $menu1[0]["list"][0]["href"];
		}
		$this->assign("menu",$menu0);
		$this->assign("subMenu",$subMenu);
		
		$this->assign("loginHref",U("Admin/login"));
	}
	//登录页面
	public function login(){
		$this->display();
	}
	//登录操作
    public function gologin(){
        $username = I('username','');
        $password = I('password','');
        $imgcode = I('imgcode','');
        if ($username == ''){
            $this->ajaxReturn(array('msg'=>'用户名不能为空'));
        }
        if ($password == ''){
            $this->ajaxReturn(array('msg'=>'密码不能为空'));
        }
        if ($imgcode == ''){
            $this->ajaxReturn(array('msg'=>'验证码不能为空'));
        }
        if (!(check_verify($imgcode,'loginCode'))){
            $this->ajaxReturn(array('msg'=>'图片验证码输入有误'));
        }
        $usermod = M('Admin');
        $res = $usermod->where(array('username'=>$username))->field('id,username,password')->find();
		
        if ($res){
            if ($res['password'] == md5($password)){
                session('id',$res['id']);
                session('admin',$res['username']);
                $this->ajaxReturn(array('msg'=>'success'));
            }
            else{
                $this->ajaxReturn(array('msg'=>'用户名或密码错误'));
            }
        }else{
            $this->ajaxReturn(array('msg'=>'登录账号不存在'));
        }
    }
	public function logout(){
		session('id',null);
        session('admin',null);
		$this->display("login");
	}
}