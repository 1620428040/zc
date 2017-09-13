/*点击更换验证码*/
function changeimg(url) {
	var myimg = document.getElementById("code");
	var now = new Date().getTime();
	myimg.src = url;
}
/*点击将金额添加*/
function Addmoney(shuzi) {
	document.getElementById("money").value = shuzi;
}

/*选项卡*/
$(document).ready(function() {
	$(".tab li").click(function() {
		$(".tab li").eq($(this).index()).addClass("tab-on").siblings().removeClass('tab-on');
		$(".tab2").hide().eq($(this).index()).show();
		//另一种方法: $("div").eq($(".tab li").index(this)).addClass("on").siblings().removeClass('on'); 
	});
//	var totalPage = document.getElementById("totalPage").value;
//	var currentPage = document.getElementById("currentPage").value;
//	var lssuingId = document.getElementById("lssuingId").value;
	//					$(".tcdPageCode").createPage({
	//						pageCount: totalPage,
	//						current: currentPage,
	//						backFn: function(currentPage) {
	//							console.log(currentPage);
	//							window.location.href = "/tender/totender?lssuingId=" + lssuingId + "&currentPage=" + currentPage + "&state_t=state_t";
	//						}
	//					});
	var state_t = document.getElementById("state_t").value;
	if(state_t != null && 　state_t != "") {
		$("#jilu_0").addClass("tab-on").siblings().removeClass("tab-on");
		document.getElementById("jilu").style.display = "block";
		document.getElementById("details").style.display = "none";
	} else {
		document.getElementById("details").style.display = "block";
		document.getElementById("jilu").style.display = "none";
	}
});