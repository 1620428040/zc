<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE >
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
		<meta http-equiv="description" content="This is my page">
		
		<link rel="stylesheet" type="text/css" href="/zc/Public/css/index_main.css">
		<link rel="stylesheet" type="text/css" href="/zc/Public/css/index.css">
		<link rel="stylesheet" type="text/css" href="/zc/Public/css/public.css" />
		<script type="text/javascript" src="/zc/Public/js/jquery-1.8.2.min.js" ></script>
		
	<title>众筹列表</title>
	<link rel="stylesheet" type="text/css" href="/zc/Public/css/invest.css">
	<link rel="stylesheet" type="text/css" href="/zc/Public/css/list.css" />

	</head>

	<body>
		<div class="header">
			<div class="header_top">
				<div class="header_wrap">
					<div class="header_top_main">
						<span>欢迎来到糯米计划，服务热线：40009-06069</span>
<?php
if(session('username')){ ?>
							<ul>
								<li>
									<p>欢迎<?php echo session('username');?></p>
									
								</li>
								<li>|</li>
								<li>
									<a href="<?php echo U('Home/Index/logout');?>">退出</a>
								</li>
							</ul>
<?php
} else{ ?>
							<ul>
								<li>
									<a href="<?php echo U('Home/Index/register');?>">注册</a>
								</li>
								<li>|</li>
								<li>
									<a href="<?php echo U('Home/Index/login');?>">登陆</a>
								</li>
							</ul>
<?php
} ?>
					</div>
				</div>
			</div>
			<div class="header_main">
				<div class="header_wrap">
					<div class="header_conter">
						<img src="/zc/Public/imgs/logo.png">
						<ul id="header_nav">
							<li id="title_c01" <?php if(ACTION_NAME==="index") echo 'class="header_nav"'?>>
								<a href="<?php echo U('Home/Index/index');?>">首页</a>
							</li>
							<li id="title_c02" <?php if(ACTION_NAME==="lists") echo 'class="header_nav"'?>>
								<a href="<?php echo U('Home/Index/lists');?>">众筹列表</a>
							</li>
							<li id="title_c03" <?php if(ACTION_NAME==="xszd") echo 'class="header_nav"'?>>
								<a href="<?php echo U('Home/Index/xszd');?>">新手指导</a>
							</li>
							<li id="title_c04" <?php if(ACTION_NAME==="about") echo 'class="header_nav"'?>>
								<a href="<?php echo U('Home/Index/about');?>">关于我们</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="header_height"></div>

		
	<style type="text/css">
		.active{
			font-weight: bold;
			color: rgb(0, 153, 204) !important;
		}
	</style>
	<div class="wrap">
		<div id="middle">
			<div id="box">
				<div id="tiaojian">
					<div class="type_name">项目进程：</div>
					<ul>
						<li>
							<a href="<?php echo U('Home/Index/lists');?>" <?php if(!$status) echo 'class="active"'?>>全部</a>
						</li>
						<li>
							<a href="<?php echo U('Home/Index/lists','status=run');?>" <?php if($status=='run') echo 'class="active"'?>>众筹中</a>
						</li>
						<li>
							<a href="<?php echo U('Home/Index/lists','status=return');?>" <?php if($status=='return') echo 'class="active"'?>>待回收</a>
						</li>
						<li>
							<a href="<?php echo U('Home/Index/lists','status=sell');?>" <?php if($status=='sell') echo 'class="active"'?>>出售中</a>
						</li>
						<li>
							<a href="<?php echo U('Home/Index/lists','status=complete');?>" <?php if($status=='complete') echo 'class="active"'?>>已回款</a>
						</li>
					</ul>
					<div class="clear"></div>
				</div>
				<div class="clear20"></div>
				<div class="project_list" style="margin-bottom:0;">
					<ul>
						<?php if(is_array($list)): foreach($list as $key=>$item): ?><li>
								<a href="<?php echo U('Home/Index/details',"id=".$item["id"]);?>" target="_blank">
									<img src="/zc/Public/<?php echo ($item["cover"]); ?>" style="width:275px;height:200px;">
								</a>
								<p class="bt">
									<a href="<?php echo U('Home/Index/details',"id=".$item["id"]);?>" target="_blank"><?php echo ($item["title"]); ?></a>
								</p>
								<p class="zijin ico3">众筹金额： <span>￥<?php echo ($item["need"]); ?></span></p>
								<p class="jindu1"><span class="jindu2" style="width:0.0%"></span></p>
								<span class="lb1"><span>￥<?php echo ($item["had"]); ?></span><br>已筹集</span>
								<span class="lb2"><span><?php echo ($item["vote_support"]); ?></span><br>支持人数</span>
								<span class="lb3"><span>已结束 </span><br> 剩余时间</span>
							</li><?php endforeach; endif; ?>
					</ul>
				</div>
				<div class="clear"></div>
				<?php echo ($page); ?>
				<!--<div class="tcdPageCode"><span class="disabled">上一页</span><span class="current">1</span><span class="disabled">下一页</span></div>-->
				<div class="clear"></div>
			</div>
		</div>
		<div class="wrap_footer"></div>
		<input value="" type="hidden" id="status">
		<input value="1" type="hidden" id="totalPage">
		<input value="1" type="hidden" id="currentPage">
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			var totalPage = document.getElementById("totalPage").value;
			var currentPage = document.getElementById("currentPage").value;
//				$(".tcdPageCode").createPage({
//					pageCount: totalPage,
//					current: currentPage,
//					backFn: function(currentPage) {
//						console.log(currentPage);
//						window.location.href = "/tender/totenderList?status=" + status + "&currentPage=" + currentPage;
//					}
//				});
//				$("#title_c02").addClass("header_nav").siblings.removeClass("header_nav");
			})
	</script>

		
		<div class="footer">
			<div class="conter_warp">
				<div class="footer_main">
					<img src="/zc/Public/imgs/logo.png">
					<div class="footer_content">
						<ul>
							<li>
								<a href="">公司简介</a>
							</li>
							<li>|</li>
							<li>
								<a href="">服务与团队</a>
							</li>
							<li>|</li>
							<li>
								<a href="">成功案例</a>
							</li>
							<li>|</li>
							<li>
								<a href="">联系我们</a>
							</li>
						</ul>
						<div class="clear"></div>
						<p>Copyright@2012-2016山东金糯米网络有限公司版权所有鲁ICP备12345678-1</p>
						<p>地址：济南市高新区海信9号</p>
						<p class="footer_phone">电话：0531-88888888</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>