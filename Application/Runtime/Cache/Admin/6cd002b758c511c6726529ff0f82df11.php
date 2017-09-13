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
					
	<p class="pageTitle">会员列表</p>
	<div class="title">
		<div class="btn">
			<button class="searchShow">搜素/筛选会员</button>
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
				<label><span class="vipname">是否VIP：</span><input type="radio" value="" name="vip">是<input type="radio" value="" name="vip">否<span class="tiaojian">不限则不填</span></label>
			</p>
			<p class="input-p">
				<label><span class="vipname">会员名：</span><input type="text" value=""><span class="tiaojian">不限则不填</span></label>
			</p>
			<p class="input-p">
				<label><span class="vipname">真实姓名：</span><input type="text" value=""><span class="tiaojian">不限则不填</span></label>
			</p>
			<p class="input-p">
				<label><span class="vipname">所属客服：</span><input type="text" value=""><span class="tiaojian">不限则不填</span></label>
			</p>
			<p class="input-p">
				<label><span class="vipname">余额：</span>
					<select>
						<option value="">--请选择--</option>
						<option value="">可用余额</option>
						<option value="">冻结余额</option>
						<option value="">待收金额</option>
					</select>
					<select>
						<option value="">--请选择--</option>
						<option value="">大于</option>
						<option value="">等于</option>
						<option value="">小于</option>
					</select>
					<input type="text" value="" />
					<span class="tiaojian">不限则不填</span>
				</label>
			</p>
			<p class="input-p">
				<label><span class="vipname">注册时间（开始时间）：</span><input type="text" value="" class="start-time"><span class="tiaojian color">不只选开始时间则查询从开始时间往后所有</span></label>
			</p>
			<p class="input-p">
				<label><span class="vipname">注册时间（结束时间）：</span><input type="text" value="" class="start-time"><span class="tiaojian color">不只选开始时间则查询从开始时间往后所有</span></label>
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
				<th>用户名</th>
				<th>手机号</th>
				<th>QQ号</th>
				<th>注册时间</th>
				<th>注册IP</th>
				<th>可用余额</th>
				<th>操作</th>
			</tr>
			<?php if(is_array($data)): foreach($data as $key=>$item): ?><tr>
					<td><label><input type="checkbox" name="xuanze[]" value=""></label></td>
					<td><?php echo ($item["id"]); ?></td>
					<td><?php echo ($item["username"]); ?></td>
					<td><?php echo ($item["phone"]); ?></td>
					<td><?php echo ($item["qq"]); ?></td>
					<td><?php echo ($item["register_time"]); ?></td>
					<td><?php echo ($item["register_ip"]); ?></td>
					<td><?php echo ($item["money"]); ?>元</td>
					<td>
						<a href="#" class="balance_click">[调整余额]</a>
						<a href="revise.html">[修改信息]</a>
						<a href="idCard_info.html">[身份证代传]</a>
						<a href="vip_zj.html">[资金记录]</a>
					</td>
				</tr><?php endforeach; endif; ?>
		</table>
		<!--<table class="table"cellpadding="0" cellspacing="0">
			<tr>
				<th><label><input type="checkbox" name="xuanze[]" value=""></label></th>
				<th>ID</th>
				<th>发标身份</th>
				<th>用户名</th>
				<th>真实姓名</th>
				<th>手机号</th>
				<th>推荐人</th>
				<th>会员类型</th>
				<th>可用余额</th>
				<th>冻结资金</th>
				<th>注册时间</th>
				<th>操作</th>
			</tr>
			<tr>
				<td><label><input type="checkbox" name="xuanze[]" value=""></label></td>
				<td>123456</td>
				<td>张三</td>
				<td>100000</td>
				<td>10000</td>
				<td>2017年8月9日</td>
				<td>10天</td>
				<td>10000元</td>
				<td>200000元</td>
				<td>200000元</td>
				<td>200000元</td>
				<td>
					<a href="#" class="balance_click">[调整余额]</a>
					<a href="revise.html">[修改信息]</a>
					<a href="idCard_info.html">[身份证代传]</a>
					<a href="vip_zj.html">[资金记录]</a>
				</td>
			</tr>
		</table>-->
	</div>
	<div class="title">
		<div class="btn">
			<button class="searchShow showBottom" onclick="search();">搜素/筛选会员</button>
			<button>将当前条件下数据导出Excel</button>
		</div>
		<div class="pagenum">
			<span>上一页</span>
			<span>1</span>
			<span>2</span>
			<span>3</span>
			<span>上一页</span>
		</div>
	</div>
	<div class="balance">
		<p class="balanceTitle">
			调整余额
			<span class="close" >×</span>
		</p>
		<p class="balance_tit">调整余额</p>
		<p class="user_name"><span class="user_text">用户名：</span><span>18500944312</span><span>(苗粉粉)</span></p>
		<p class="user_name"><span class="user_text">可用余额：</span><input type="text"><span class="msg">如果是减少余额，请填负数，如'-1000'</span></p>
		<p class="user_name"><span class="user_text">冻结金额：</span><input type="text"><span class="msg">如果是减少余额，请填负数，如'-1000'</span></p>
		<p class="user_name"><span class="user_text">变动原因：</span><input type="text"><span class="msg">*</span></p>
		<button class="confirm">确定</button>
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
		/*点击调整余额*/
		$('.balance_click').click(function(){
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