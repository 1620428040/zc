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
		
	<title>详情-<?php echo ($project["title"]); ?></title>
	<link rel="stylesheet" type="text/css" href="/zc/Public/css/details.css">
	<link rel="stylesheet" type="text/css" href="/zc/Public/css/details_sub.css" />
	<link rel="stylesheet" type="text/css" href="/zc/Public/css/invest.css">

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
				<script type="text/javascript">
					//倒计时的插件
					$.fn.extend({
						oaoTime: function() {
							this.each(function() {
								var dateStr = $(this).attr("end-date");
								var dateNowStr = $(this).attr("now-date");
								var t = new Date(dateStr.replace(/-/g, "/")), //取得指定时间的总毫秒数 
									n = new Date(dateNowStr.replace(/-/g, "/")).getTime(), //取得当前毫秒数
									c = t - n; //得到时间差
								//if(c<0){ alert("时间过期了");return; }
								if(c < 0) { $(this).html('<font>已结束</font>'); return; }
								$.oaoTime.timers.push({ tms: c, content: $(this) });
								$.oaoTime.start();
							});
						}
					});
					//倒计时的插件
					$.oaoTime = {
						//倒计时容器，所有需要倒计时的时间都需要注册到这个容器中，容器中放的是一个object，object描述了倒计时的结束时间，以及显示时间的jquery对象(例如div)
						timers: [],
						//全局的一个倒计时状态，init表示初始化状态，start表示运行中状态，stop表示停止状态
						status: 'init',
						//计算时间并定时刷新时间的方法，本插件的核心代码
						takeCount: function() {
							//如果定时器没有启动不执行
							if(this.status != 'start') return;
							setTimeout("$.oaoTime.takeCount()", 1000);
							var timers = this.timers;
							for(var i = 0, j = timers.length; i < j; i++) {
								//计数减一
								timers[i].tms -= 1000;
								//console.info(timers[i].tms);
								//计算时分秒
								var days = Math.floor(timers[i].tms / (1000 * 60 * 60 * 24));
								var hours = Math.floor(timers[i].tms / (1000 * 60 * 60)) % 24;
								var minutes = Math.floor(timers[i].tms / (1000 * 60)) % 60;
								var seconds = Math.floor(timers[i].tms / 1000) % 60;
								if(days < 0) { days = 0; }
								if(hours < 0) { hours = 0; }
								if(minutes < 0) { minutes = 0; }
								if(seconds < 0) { seconds = 0; }

								var newTimeText = "<em>" + days + "</em>天 <em>" + hours + "</em>时 <em>" + minutes + "</em>分 <em>" + seconds + "</em>秒";
								timers[i].content.html(newTimeText);
								if(days == 0 && hours == 0 && minutes == 0 && seconds == 0) {
									location.reload();
								}
								//console.info(newTimeText);
							}
						},
						//启动倒计时
						start: function() {
							if(this.status == 'init') {
								this.status = 'start';
								this.takeCount();
							}
						},
						//停止倒计时
						stop: function() {
							this.status = 'stop';
						}
					};
				</script>
				<div class="project_title">
					<h1><?php echo ($project["title"]); ?></h1>
				</div>
				<div class="project_right">
					<div class="project_b">
						<form action="" method="post" onsubmit="getElementById('invest_bt').disabled=true;return true;">
							<p>
								已筹资金:<span>￥<?php echo ($project["had"]); ?></span>
							</p>
							<div class="zijin">
								<span>达成：<strong id="jindu_2_2">0%</strong></span> 目标金额：
								<strong> ￥<?php echo ($project["need"]); ?></strong>
							</div>
							<div class="jindu1" id="probar">
								<div class="jindu2" id="jindu2" w="<?php echo ($project["progress"]); ?>" style="width: 0%;"></div>
							</div>
							<div class="time">
                                <span class="rs">支持人数：<em><?php echo ($project["support"]); ?></em></span> 
                                剩余时间：
                                <span id="timer1" end-date="<?php echo ($project["endTime"]); ?>" now-date="<?php echo ($project["nowTime"]); ?>">
                                    <font>已结束</font>
                                </span>
								<script>
									$("#timer1").oaoTime();
								</script>
							</div>
							<p id="tbinput">
								金额：<input name="money" id="money" maxlength="6" type="text" onkeyup="value=value.replace(/[^0-9]/g,'')"> 元
							</p>
							<p class="ysmoney">
								<a href="javascript:void(0)" onclick="Addmoney('1000')">1千</a>
								<a href="javascript:void(0)" onclick="Addmoney('5000')">5千</a>
								<a href="javascript:void(0)" onclick="Addmoney('10000')">1万</a>
								<a href="javascript:void(0)" onclick="Addmoney('20000')">2万</a>
								<a href="javascript:void(0)" onclick="Addmoney('30000')">3万</a>
								<a href="javascript:void(0)" onclick="Addmoney('50000')">5万</a>
							</p>
							<p style="margin:0;">
								账户余额：
								<a href="<?php echo U('Home/Index/login');?>">登录可见</a>
							</p>
							<p id="tbinput" style="margin-top:0;">
								<span style="font-size:14px; color:#666; float:left">验证码：</span>
								<input name="verify_code" id="verify_code" maxlength="6" style="width:90px; margin-top:5px; float:left;" type="text">
								<script>
									var url = "<?php echo U('Home/User/verify_img').'?action=1&r=';?>" + Math.random();
								</script>
								<a href="javascript:void(0)" onclick="changeimg(url)"><img src="<?php echo U('Home/User/verify_img').'?action=1';?>" id="code" style="float:right;width:100px;height:30px;" alt="请点击刷新验证码" align="absmiddle" border="0"></a>
							</p>
							<p id="tbinput" style="margin-top:0;">
								<span style="font-size:14px; color:#666; float:left">安全密码：</span><input name="paypwd" maxlength="16" style="width:90px; margin-top:5px; float:left;" type="password">
							</p>
							<p style="margin:0;">
<?php
if($project["status"]==="run"){ if(strtotime($project["begin_time"])<=time()){ echo '<input class="invest_bt" value="确认" style=" background:#F15315;" type="button" onclick="submit_toubiao();"/>'; } else{ echo '<input class="invest_bt" value="众筹尚未开始" style=" background:#ddd;" disabled="disabled" type="button">'; } } else{ echo '<input class="invest_bt" value="已结束众筹" style=" background:#ddd;" disabled="disabled" type="button">'; } ?>
								<!-- <input onclick="window.location.href='/crowdfunding/reservation?status=3'" id="invest_bt" class="invest_bt" value="我要预约" type="button" style="float:right;width:130px;border-radius:3px;background:#D90023;"/> -->
							</p>
						</form>
					</div>
					<div class="clear20"></div>
					<div class="project_b">
						<h3>投票详情</h3>
						<div class="diggnr">
                        <?php
 if($vote){ if($vote["status"]==="success"){ $notic="投票已结束"; } else{ $notic="正在投票"; } } else{ $notic="未开始投票"; } echo $notic; ?>
						</div>
						<div class="digglist" id="vote_support">
							<a href="javascript:void(0);" onclick="digg('support');" class="a1">支持</a>
							<div class="d1">
								<div class="d2" style="width:<?php echo ($vote["support_rate"]); ?>%"></div><span><?php echo ($vote["support_rate"]); ?>%</span></div>
						</div>

						<div class="digglist" id="vote_against">
							<a href="javascript:void(0);" onclick="digg('oppose');" class="a2">反对</a>
							<div class="d1">
								<div class="d3" style="width:<?php echo ($vote["oppose_rate"]); ?>%"></div><span><?php echo ($vote["oppose_rate"]); ?>%</span></div>
						</div>

						<div class="diggnr">注：如规定时间内您未参与投票，系统将默认您为支持者</div>
					</div>
				</div>
				<div class="project_left">
					<div style="border:#e5e5e5 1px solid; padding:20px; background:#FFF">
						<img src="/zc/Public/<?php echo ($project["cover"]); ?>" style="width:890px;height:405px;">
					</div>
					<div class="clear20"></div>
					<ul class="tab" id="tab">
						<li class="tab-on" id="details_0">项目详情</li>
						<li>项目动态</li>
						<li id="jilu_0">投资记录（<?php echo ($fundCount); ?>）</li>
						<li>合同服务</li>
					</ul>
					<div class="nr">
						<div class="tab2" style="display: block;" id="details">
							<?php echo ($project["details"]); ?>
						</div>
						<div class="tab2">
                            <div class="timeline-date">
                                <ul>
                                    <h2 class="second" style="position: relative;"></h2>
                                    <?php if(is_array($evolve)): foreach($evolve as $key=>$item): ?><li>
                                            <h3><?php echo ($item["time"]); ?></h3>
                                            <dl class="right"><span><?php echo ($item["content"]); ?></span></dl>
                                        </li><?php endforeach; endif; ?>
                                </ul>
							</div>
						</div>
						<div class="tab2" id="jilu" style="display: none;">
							<table class="jilu" style="text-align: center;">
								<thead>
									<th class="one">序号</th>
									<th>投资者</th>
									<th>金额</th>
									<th>日期</th>
								</thead>
								<tbody>
									<?php if(is_array($fund)): foreach($fund as $i=>$item): ?><tr>
										<td><?php echo ($i+1); ?></td>
										<td><?php echo ($item["uid"]); ?></td>
										<td><?php echo ($item["money"]); ?></td>
										<td><?php echo ($item["time"]); ?></td>
									</tr><?php endforeach; endif; ?>
								</tbody>
							</table>
							<div class="clear"></div>
							<div class="tcdPageCode"><span class="disabled">上一页</span><span class="disabled">下一页</span></div>
							<div class="clear"></div>
						</div>
						<div class="tab2">
                            <?php echo ($project["contract"]); ?>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
			<input value="4" type="hidden" id="lssuingId">
			<input value="" type="hidden" id="state_t">
			<input value="0" type="hidden" id="totalPage">
			<input value="1" type="hidden" id="currentPage">
		</div>
		<script language="javascript">
			function submit_toubiao() {
				var money = document.getElementById("money").value;
				var reg = /^[1-9]\d*$/; // 注意：故意限制了 0321 这种格式，如不需要，直接reg=/^\d+$/;
				if(reg.test(money) == false) {
					alert("投标金额必须是数字。");
					return false;
				}

				if(money > 10000) {
					alert("单笔投标金额不能大于 10000 元。");
					return false;
				}
                $.post("<?php echo U('Api/Fund/fund');?>",{
                    "pid":'<?php echo ($project["id"]); ?>',
                    "money":$("#money").val()
                },function(res){
                    alert(res.info);
                    console.log(res);
                })
			}

			
			function processerbar(time) {
				$("#jindu2").each(function(i, item) {
					var a = parseInt($(item).attr("w"));
					$(item).animate({
						width: a + "%"
					}, time);

				});

				var si = window.setInterval(
					function() {
						a = $("#jindu2").width();
						b = (a / 280 * 100).toFixed(0);
						document.getElementById('jindu_2_2').innerHTML = b + "%";

					},
					10);
			};
			processerbar(1500);
			function digg(vote) {
                $.post("<?php echo U('Api/Fund/vote');?>",{
                    "pid":'<?php echo ($project["id"]); ?>',
                    "vote":vote
                    },function(res){
                    alert(res.info);
                })
				//window.location.href = "/crowdfunding/toVote?vote=" + vote + "&lssuingId=" + lssuingId;
			}
		</script>
		<div class="wrap_footer"></div>
	</div>
	<script type="text/javascript" src="/zc/Public/js/details.js"></script>

		
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