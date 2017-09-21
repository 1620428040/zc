<?php if (!defined('THINK_PATH')) exit(); if($_SESSION['admin']){ $username=$_SESSION['admin']; } else{ echo '<script>location.href="'.$loginHref.'";</script>'; } ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<script type="text/javascript" src="/zc/Public/js/jquery-1.8.2.min.js" ></script>
		<link rel="stylesheet" href="/zc/Public/admin/css/index.css" />
		
	<title>会员管理-会员列表</title>
	<link rel="stylesheet" href="/zc/Public/admin/css/toupiao.css" />

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
					
	<p class="pageTitle">待回款中项目列表</p>
	<!--投票中的列表-->
	<div class="list">
		<table class="table"cellpadding="0" cellspacing="0">
			<tr>
				<th><label><input type="checkbox" name="xuanze[]" value=""></label></th>
				<th>ID</th>
				<th>众筹项目名称</th>
				<th>发起人</th>
				<th>目标金额</th>
				<th>已筹资金</th>
				<th>投票金额/出售金额</th>
				<th>发布时间</th>
				<th>最长持有期限</th>
				<th>操作</th>
			</tr>
			<?php if(is_array($list)): foreach($list as $key=>$item): ?><tr>
					<td><label><input type="checkbox" name="xuanze[]" value=""></label></td>
					<td><?php echo ($item["id"]); ?></td>
					<td><?php echo ($item["title"]); ?></td>
					<td><?php echo ($item["username"]); ?></td>
					<td><?php echo ($item["need"]); ?>(元)</td>
					<td><?php echo ($item["had"]); ?>(元)</td>
					<td><?php echo ($item["vote"]); ?>(元)</td>
					<td><?php echo ($item["begin_time"]); ?></td>
					<td><?php echo ($item["timeMax"]); ?>(天)</td>
					<td>
<?php  if($status==="sell,vote"){ echo '<a href="'.U("startVote",["pid"=>$item["id"]]).'">投票</a>'; } elseif($status==="return"){ echo '<a href="'.U("Api/Fund/complete",["pid"=>$item["id"]]).'">回款</a>'; } ?>
						<!--<a href="javaScript:void(0)">编辑</a>-->
						<a href="javaScript:void(0)">删除</a>
					</td>
				</tr><?php endforeach; endif; ?>
		</table>
	</div>

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