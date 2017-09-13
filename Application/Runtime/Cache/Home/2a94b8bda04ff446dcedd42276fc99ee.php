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
		
	<title>首页</title>
	<link rel="stylesheet" href="/zc/Public/css/banner.css" />

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

		
	<div class="conter">
		<!--banner图-->
		<div class="demo banner">
			<a class="control prev"></a><a class="control next abs"></a>
			<div class="slider">
				<ul>
					<li><a href=""><img src="/zc/Public/imgs/banner2.png" alt="" /></a></li>
					<li><a href=""><img src="/zc/Public/imgs/banner3.png" alt="" /></a></li>
					<li><a href=""><img src="/zc/Public/imgs/banner4.png" alt="" /></a></li>
					<li><a href=""><img src="/zc/Public/imgs/banner1.png" alt="" /></a></li>
					
				</ul>
			</div>
		</div>
		<div class="conter_warp">
			<!--数据展示-->
			<div class="shuju">

				<div class="biaoti">项目报告</div>
				<ul>
					<li style="margin-left: 0px;">
						<img src="/zc/Public/imgs/chengjiaojine.png">
						<div class="shuju_main">
							<p><span>￥0.0</span></p>
							<p>累计成交金额（￥）</p>
						</div>
					</li>
					<li>
						<img src="/zc/Public/imgs/fenhongjine.png">
						<div class="shuju_main">
							<p><span>10.0%</span></p>
							<p>平均年利率</p>
						</div>
					</li>
					<li>
						<img src="/zc/Public/imgs/yihuikuanjine.png">
						<div class="shuju_main">
							<p><span>￥0.0</span></p>
							<p>已回款金额（￥）</p>
						</div>
					</li>
					<li>
						<img src="/zc/Public/imgs/zhucerenshu.png">
						<div class="shuju_main">
							<p><span>8</span></p>
							<p>注册用户</p>
						</div>
					</li>
				</ul>
			</div>
			<!--众筹预告-->
			<div class="yugao">
				<div class="biaoti">众筹预告</div>
                <div class="clear"></div>
				<div class="biao_main" style="display: block;">
					<?php if(is_array($prepare)): foreach($prepare as $key=>$item): ?><div class="xiangmu">
							<div class="biao_zht">
								<!--<img src="/zc/Public/imgs/ico_ywc.png">-->
							</div>
							<img src="/zc/Public/<?php echo ($item["cover"]); ?>">
							<div class="biao_conent">
								<div class="myStat2 circliful" data-dimension="110" data-text="<?php echo ($item["progress"]); ?>%" data-info="New Clients" data-width="9" data-fontsize="14" data-percent="0.0" data-fgcolor="#fdb63f" data-bgcolor="#eee" style="width: 110px;">
									<span class="circle-text" style="line-height: 110px; font-size: 14px;"><?php echo ($item["progress"]); ?>%</span>
									<canvas width="110" height="110"></canvas>
								</div>
								<div class="biao_conent_title">
									<h3><?php echo ($item["title"]); ?></h3>
									<p>预计年化收益率<span><?php echo ($item["yield"]); ?>%</span></p>
								</div>
								<div class="clear"></div>
								<div class="hengxian_xu"></div>
								<div class="biao_show">
									<div class="biao_show_left">
										<p>投资金额：<span>￥<?php echo ($item["need"]); ?></span></p>
										<p>已筹金额：<span>￥<?php echo ($item["had"]); ?></span></p>
										<p>支持人数：<span><?php echo ($item["vote_support"]); ?>人</span></p>
									</div>
									<div class="biao_show_right">
										<p>剩余时间</p>
										<p>已结束</p>
									</div>
									<div class="clear"></div>
									<a class="yincang_btn" href="<?php echo U('Home/Index/details',"id=".$item["id"]);?>">查看详情</a>
								</div>
							</div>
						</div><?php endforeach; endif; ?>
				</div>
			</div>
			<!--众筹列表-->
			<div class="clear"></div>
			<div class="biao" id="list">
				<div class="biaoti">众筹列表</div>
				<div class="biao_title">
					<ul>
						<a href="<?php echo U('Home/Index/index#list');?>"><li <?php if(!$status) echo 'class="biao_select"'?>>全部项目</li></a>
						<a href="<?php echo U('Home/Index/index#list','status=run');?>"><li <?php if($status=='run') echo 'class="biao_select"'?>>众筹中</li></a>
						<a href="<?php echo U('Home/Index/index#list','status=sell');?>"><li <?php if($status=='sell') echo 'class="biao_select"'?>>出售中</li></a>
						<a href="<?php echo U('Home/Index/index#list','status=complete');?>"><li <?php if($status=='complete') echo 'class="biao_select"'?>>已出售</li></a>
					</ul>
				</div>
				<div class="clear"></div>
				<div class="biao_main" style="display: block;">
					<?php if(is_array($list)): foreach($list as $key=>$item): ?><div class="xiangmu">
							<div class="biao_zht">
								<!--<img src="/zc/Public/imgs/ico_ywc.png">-->
							</div>
							<img src="/zc/Public/<?php echo ($item["cover"]); ?>">
							<div class="biao_conent">
								<div class="myStat2 circliful" data-dimension="110" data-text="<?php echo ($item["progress"]); ?>%" data-info="New Clients" data-width="9" data-fontsize="14" data-percent="0.0" data-fgcolor="#fdb63f" data-bgcolor="#eee" style="width: 110px;">
									<span class="circle-text" style="line-height: 110px; font-size: 14px;"><?php echo ($item["progress"]); ?>%</span>
									<canvas width="110" height="110"></canvas>
								</div>
								<div class="biao_conent_title">
									<h3><?php echo ($item["title"]); ?></h3>
									<p>预计年化收益率<span><?php echo ($item["yield"]); ?>%</span></p>
								</div>
								<div class="clear"></div>
								<div class="hengxian_xu"></div>
								<div class="biao_show">
									<div class="biao_show_left">
										<p>投资金额：<span>￥<?php echo ($item["need"]); ?></span></p>
										<p>已筹金额：<span>￥<?php echo ($item["had"]); ?></span></p>
										<p>支持人数：<span><?php echo ($item["vote_support"]); ?>人</span></p>
									</div>
									<div class="biao_show_right">
										<p>剩余时间</p>
										<p>已结束</p>
									</div>
									<div class="clear"></div>
									<a class="yincang_btn" href="<?php echo U('Home/Index/details',"id=".$item["id"]);?>">查看详情</a>
								</div>
							</div>
						</div><?php endforeach; endif; ?>
				</div>
			</div>
			<!--新闻排行榜-->
			<div class="xinwen">
				<div class="xinwen_title">
					<span class="xmdt">项目动态</span>
					<a href="/news/new?flag=trailer">更多&gt;&gt;</a>
				</div>
				<div class="clear"></div>
				<div class="xinwen_main">
					<div class="hengxian_shi"></div>
					<ul>

					</ul>
				</div>
			</div>
			<div class="xinwen" style="margin-left: 10px;">
				<div class="xinwen_title">
					<span class="xmdt">网站公告</span>
					<a href="/news/new?flag=notice">更多&gt;&gt;</a>
				</div>
				<div class="clear"></div>
				<div class="xinwen_main">
					<div class="hengxian_shi"></div>
					<ul>

						<li>
							<a href="/news/newdetail?newsId=43">网站公告1</a>
							<span>01-18</span>
						</li>

					</ul>
				</div>
			</div>
			<div class="paihang">
				<div class="paihang_title">
					<span class="xmdt">投资排行榜</span>
					<ul>
						<li class="ph_select">年</li>
						<li>月</li>
						<li>日</li>
					</ul>
				</div>
				<div class="clear"></div>
				<div class="paihang_main">
					<div class="hengxian_shi"></div>
					<bdi class="ph_hiden" style="display: block;">
				<ul>
				
				</ul>
				</bdi>
					<bdi class="ph_hiden">
				<ul>
				
				</ul>
				</bdi>
					<bdi class="ph_hiden">
				<ul>
				
				</ul>
				</bdi>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<!--合作伙伴-->
		<div class="hzhb">
			<div class="conter_warp">
				<div class="hzhb_title">合作伙伴</div>
				<div class="hzhb_main">
					<ul>
						<li>
							<a target="_blank" href="http://www.autohome.com.cn/beijing/" title="汽车之家">
								<img src="/zc/Public/imgs/h1.png"></a>
						</li>

						<li>
							<a target="_blank" href="http://www.wddby.com/" title="网贷大本营">
								<img src="/zc/Public/imgs/h2.png"></a>
						</li>
						<li>
							<a target="_blank" href="http://www.p2peye.com/" title="网贷天眼">
								<img src="/zc/Public/imgs/h3.png"></a>
						</li>
						<li>
							<a target="_blank" href="http://www.wangdaitan.com/" title="网贷谈">
								<img src="/zc/Public/imgs/h8.png"></a>
						</li>
						<li>
							<a target="_blank" href="http://www.wdzj.com/" title="网贷之家">
								<img src="/zc/Public/imgs/h4.png"></a>
						</li>
						<li>
							<a target="_blank" href="http://www.58jr.cn/" title="网投春秋">
								<img src="/zc/Public/imgs/h5.png"></a>
						</li>
						<li>
							<a target="_blank" href="http://www.wuchouzhijia.com/" title="物筹之家">
								<img src="/zc/Public/imgs/h6.png"></a>
						</li>
						<li>
							<a target="_blank" href="http://www.chedby.com/" title="车筹大本营">
								<img src="/zc/Public/imgs/h7.png"></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="/zc/Public/js/banner.js" ></script>
	<script>
		$(".slider").YuxiSlider({
			width:100+'%', //容器宽度
			height:450, //容器高度
			control:$('.control'), //绑定控制按钮
			during:2000, //间隔4秒自动滑动
			speed:800, //移动速度0.8秒
			mousewheel:true, //是否开启鼠标滚轮控制
			direkey:true //是否开启左右箭头方向控制
		});
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