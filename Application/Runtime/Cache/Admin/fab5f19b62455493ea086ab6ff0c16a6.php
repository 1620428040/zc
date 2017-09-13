<?php if (!defined('THINK_PATH')) exit(); if($_SESSION['admin']){ $username=$_SESSION['admin']; } else{ echo '<script>location.href="'.$loginHref.'";</script>'; } ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<script type="text/javascript" src="/zc/Public/js/jquery-1.8.2.min.js" ></script>
		<link rel="stylesheet" href="/zc/Public/admin/css/index.css" />
		
	<title>会员管理-会员列表</title>
	<link rel="stylesheet" href="/zc/Public/admin/css/manage.css" />
	<link rel="stylesheet" href="/zc/Public/admin/css/system.css" />

	</head>
	<body>
		<div class="container">
			<!--头部-->
			<div class="header">
				<div class="logo">
					<img src="" />
					<span class="logoName">亿资众筹</span>
				</div>
				<div class="headNav">
					<ul><?php if(is_array($menu)): foreach($menu as $key=>$item): ?><li><a href="<?php echo ($item["href"]); ?>" class="noSelected <?php echo ($item["selected"]); ?>"><?php echo ($item["title"]); ?></a></li><?php endforeach; endif; ?></ul>
				</div>
				<div class="headRight">
					<span class="userName"><span ><?php echo ($username); ?></span>&nbsp;您好！</span>
					|
					<a href="<?php echo U('Home/Index/index');?>">返回前台</a>
					|
					<a href="<?php echo U('Admin/logout');?>">退出</a>
				</div>
			</div>
			<!--内容区-->
			<div class="content">
				<!--左边菜单栏-->
				<div class="contentLeft">
					<div class="left"><?php if(is_array($subMenu)): foreach($subMenu as $key=>$menu1): ?><ul class="parentMenu">
							<li class="Menu-li">
								<a><?php echo ($menu1["title"]); ?></a>
							</li>
							<ul class="subMenu"><?php if(is_array($menu1["list"])): foreach($menu1["list"] as $key=>$menu2): ?><li class="<?php echo ($menu2["selected"]); ?>"><a href='<?php echo ($menu2["href"]); ?>' class="a"><?php echo ($menu2["title"]); ?></a></li><?php endforeach; endif; ?></ul>
						</ul><?php endforeach; endif; ?></div>
				</div>
				<!--右边内容区-->
				<div class="contentRight">
					
	<p class="pageTitle">投票设置</p>
	<!--输入input-->
	<form class="input" id="project-form">
        <input type="hidden" name="pid" value="<?php echo ($project["id"]); ?>">
        <p class="name-p">
            <span class="name">项目名称：</span>
            <input name="title" type="text" class="inputName" value="<?php echo ($project["title"]); ?>" disabled/>
        </p>
		<p class="name-p">
			<span class="name">出售金额：</span>
			<input name="money" type="number" class="inputName" value="100000">
			<span class="xing color1">*</span>
		</p>
		<p class="name-p">
			<span class="name">投票时间(天)：</span>
			<input name="timeLimit" type="number" class="inputName" value="10">
			<span class="xing color1">*</span>
		</p>
		<button type="button" class="revise_btn" onclick="startVote();">确定</button>
	</form>
	<script type="text/javascript">
		function startVote(){
			$.post("<?php echo U('Api/Fund/startVote');?>",$("#project-form").serialize(),function(res){
				alert(res.info);
			});
		}
	</script>

				</div>
			</div>
		</div>
	</body>
	<script>

	$(function(){
		$('.content').css({
			height:$(window).height()-80+'px'
		})
	})
	$(function(){
		$('.contentRight').css({
			height:$(window).height()-80+'px'
		})
	})	
	$('.Menu-li').click(function(){
		$(".subMenu").toggle();

	})
	</script>
</html>