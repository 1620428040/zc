<?php if (!defined('THINK_PATH')) exit(); if($_SESSION['admin']){ $username=$_SESSION['admin']; } else{ echo '<script>location.href="'.$loginHref.'";</script>'; } ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<script type="text/javascript" src="/zc/Public/js/jquery-1.8.2.min.js" ></script>
		<link rel="stylesheet" href="/zc/Public/admin/css/index.css" />
		
	<title>会员管理-会员列表</title>
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
					
	<p class="pageTitle">会员实名认证管理</p>
	<div class="title">
		<div class="btn">
			<button class="searchShow">搜索会员身份证</button>
			<button >已认证</button>
			<button >待认证</button>
			<button >将当前条件下数据导出Excel</button>
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
			<p class="input-p">
				<label><span class="vipname">真实姓名：</span><input type="text" value=""><span class="tiaojian">不限则不填</span></label>
			</p>
			<p class="input-p">
				<label><span class="vipname">身份证号：</span><input type="text" value=""><span class="tiaojian">不限则不填</span></label>
			</p>
			<p class="input-p">
				<label><span class="vipname">申请时间(开始)：</span><input type="text" value=""><span class="msg">只选开始时间则查询从开始时间往后所有</span></label>
			</p>
			<p class="input-p">
				<label><span class="vipname">申请时间(结束)：</span><input type="text" value=""><span class="msg">只选结束时间则查询从结束时间往前所有</span></label>
			</p>
			<p class="input-p">
				<span class="vipname">申请状态：</span>
				<select>
					<option value="">--请选择--</option>
					<option value="">--已认证--</option>
					<option value="">--待认证--</option>
				</select>
				<span class="tiaojian">不限则不填</span>
			</p>
			<button class="submit">确定</button>
		</div>
	</div>
	<!--投票中的列表-->
	<div class="list ">
		<table class="table"cellpadding="0" cellspacing="0">
			<tr>
				<th><label><input type="checkbox" name="xuanze[]" value=""></label></th>
				<th>ID</th>
				<th>会员名</th>
				<th>真实姓名</th>
				<th>身份证号</th>
				<th>上传时间</th>
				<th>审核状态</th>
				<th>操作</th>
			</tr>
			<tr>
				<td><label><input type="checkbox" name="xuanze[]" value=""></label></td>
				<td>123456</td>
				<td>张三</td>
				<td>185999@163.com</td>
				<td>未关联</td>
				<td>李四</td>
				<td class="status1">已认证</td>
				<td>
					<a href="#">----</a>
				</td>
			</tr>
			<tr>
				<td><label><input type="checkbox" name="xuanze[]" value=""></label></td>
				<td>123456</td>
				<td>张三</td>
				<td>185999@163.com</td>
				<td>未关联</td>
				<td>李四</td>
				<td class="status1">待审核</td>
				<td>
					<a href="#">审核</a>
				</td>
			</tr>
		</table>
	</div>
	
	<div class="title">
		<div class="btn">
			<button class="searchShow showBottom" onclick="search();">搜素/筛选会员</button>
			<button >已认证</button>
			<button >待认证</button>
			<button >将当前条件下数据导出Excel</button>
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
			}else{
				$('.search').hide();
				$('.showBottom').text('搜素/筛选会员');
	
			}
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