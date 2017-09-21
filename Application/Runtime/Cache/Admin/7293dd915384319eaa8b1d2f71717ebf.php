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
					
	<p class="pageTitle">参数配置</p>
	<!--输入input-->
	<form class="input" id="project-form">
		<p class="name-p">
			<span class="name">众筹项目名称：</span>
			<input name="title" type="text" class="inputName" value="众筹项目-">
			<span class="xing color1">*</span>
		</p>
		<p class="name-p">
			<span class="name">目标金额：</span>
			<input name="need" type="number" class="inputName" value="100000">
			<span class="xing color1">*</span>
		</p>
		<p class="name-p">
			<span class="name">封面图片：</span>
			<input name="cover" type="text" class="inputName" value="imgs/2016111810370027.jpg">
			<span class="xing color1">*</span>
		</p>
		<p class="name-p">
			<span class="name">预期收益(百分比)：</span>
			<input name="yield" type="number" class="inputName" value="12">
			<span class="xing color1">*</span>
		</p>
		<p class="name-p">
			<span class="name">开始时间：</span>
			<input name="start_time" type="datetime" class="inputName" value="2017-07-05 07:30:07">
			<span class="xing color1">*</span>
		</p>
		<p class="name-p">
			<span class="name">筹款时间(天)：</span>
			<input name="timeLimit" type="number" class="inputName" value="5">
			<span class="xing color1">*</span>
		</p>
		<p class="name-p">
			<span class="name">最长持有期限(天)：</span>
			<input name="timeMax" type="number" class="inputName" value="40">
			<span class="xing color1">*</span>
		</p>
		<p class="name-p">
			<span class="name">项目详情：</span>
			<textarea name="details" cols="48" rows="3">此处添加项目详情</textarea>
			<span class="xing color1"></span>
		</p>
		<p class="name-p">
			<span class="name">合同：</span>
			<textarea name="contract" cols="48" rows="3">此处添加项目的合同</textarea>
			<span class="xing color1"></span>
		</p>
		<button type="button" class="revise_btn" onclick="startProject(this);">确定</button>
	</form>
    <script type="text/javascript">
		function startProject(){
			$.post("<?php echo U('Api/Fund/start');?>",$("#project-form").serialize(),function(res){
                if(res["status"]===1){
                    alert(res.info);
                    location.href=res.url;
                }
				else{
                    document.write(res);
                }
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