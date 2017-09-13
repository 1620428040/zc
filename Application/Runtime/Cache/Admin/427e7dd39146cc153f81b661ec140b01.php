<?php if (!defined('THINK_PATH')) exit(); if($_SESSION['admin']){ $username=$_SESSION['admin']; } else{ echo '<script>location.href="'.$loginHref.'";</script>'; } ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<script type="text/javascript" src="/zc/Public/js/jquery-1.8.2.min.js" ></script>
		<link rel="stylesheet" href="/zc/Public/admin/css/index.css" />
		
	<title>会员管理-推广记录</title>
	<link rel="stylesheet" href="/zc/Public/admin/css/toupiao.css" /> 
	<link rel="stylesheet" href="/zc/Public/admin/css/vipAccount.css" />
	<link rel="stylesheet" href="/zc/Public/admin/css/VIP.css" />

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
					
	<p class="pageTitle">推广人列表</p>
	<div class="title">
		<div class="btn">
			<button class="searchShow">搜素/筛选会员</button>
			<button >建立关联</button>
			<button >推广人列表</button>
			<button >推广记录</button>
		</div>
		<div class="pagenum">
			<span>上一页</span>
			<span>1</span>
			<span>2</span>
			<span>3</span>
			<span>上一页</span>
		</div>
	</div>
	<div class="search">
		<p class="searchTitle">搜索/筛选会员&nbsp;<span class="hide">[隐藏]</span></p>
		<div class="search-input">
			<p class="input-p">
				<label><span class="vipname">会员名：</span><input type="text" value=""><span class="tiaojian">不限则不填</span></label>
			</p>
			
			<button class="submit">确定</button>
		</div>
	</div>
	<!--投票中的列表-->
	<div class="list ">
		<table class="table"cellpadding="0" cellspacing="0">
			<tr>
				<th><label><input type="checkbox" name="xuanze[]" value=""></label></th>
				<th>推广人ID</th>
				<th>推广人</th>
				<th>推广客户</th>
				<th>推广类型</th>
				<th>影响金额</th>
				<th>发生时间</th>
				<th>备注</th>
			</tr>
			<tr>
				<td><label><input type="checkbox" name="xuanze[]" value=""></label></td>
				<td>123456</td>
				<td>张三</td>
				<td>185999@163.com</td>
				<td>未关联</td>
				<td>李四</td>
				<td>2017年8月9日</td>
				<td>这是备注信息</td>
				
			</tr>
		
		</table>
	</div>
	
	<div class="title">
		<div class="btn">
			<button class="searchShow showBottom" onclick="search();">搜素/筛选会员</button>
			
		</div>
		<div class="pagenum">
			<span>上一页</span>
			<span>1</span>
			<span>2</span>
			<span>3</span>
			<span>上一页</span>
		</div>
	</div>
	<!--关联用户的对话框-->
	<div class="balance balance_width">
		<p class="balanceTitle">
			关联用户
			<span class="close" >×</span>
		</p>
		<p class="balance_tit">关联用户</p>
		<p class="user_name padding"><span class="user_text">关联用户：</span><span>18500944312</span><span>(苗粉粉)</span></p>
		<p class="user_name padding"><span class="user_text">关联用户名：</span><input type="text"></p>
		<p class="user_name padding"><button class="submit">提交</button></p>
	</div>
	<script>
		$('.searchShow').click(function(){
			$('.search').show();
		})
		$('.hide').click(function(){
			$('.search').hide();
		})
		function search(){
			if($('.search').css("display")=='none'){
				$('.search').show();
				$('.showBottom').text('搜索完毕');
				//alert(111)
			}else{
				$('.search').hide();
				$('.showBottom').text('搜素/筛选会员');
				//alert($222)
			}
		}
		/*关联用户*/
		$('.correlation').click(function(){
			$('.balance').show();
		})
		/*点击错号  关闭*/
		$('.close').click(function(){
			$('.balance').hide();
		})
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