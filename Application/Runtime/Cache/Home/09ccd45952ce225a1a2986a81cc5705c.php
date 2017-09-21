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
		
	<title>关于我们</title>
	<link rel="stylesheet" type="text/css" href="/zc/Public/css/about.css">
	<link rel="stylesheet" type="text/css" href="/zc/Public/css/about_sub.css" />

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

		
	<div class="wrap">
		<div id="middle">
			<div id="box">
				<div class="m_left">
					<div class="subNav">
						<ul>
							<li>
								<a href="">公司简介</a>
							</li>

							<li>
								<a href="">公司资质</a>
							</li>

							<li>
								<a href="">团队风采</a>
							</li>

							<li>
								<a href="">办公环境</a>
							</li>

							<li>
								<a href="">管理团队</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="m_right">
					<div class="onebox">
						<h1>公司简介</h1> 1111111111
					</div>
				</div>
			</div>
		</div>
		<div class="wrap_footer"></div>
	</div>
	<script type="text/javascript">
//			$(document).ready(function() {
//				$("#title_c04").addClass("header_nav").siblings.removeClass("header_nav");
//			});
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