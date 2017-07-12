//慢速滑動回網頁頂端
$(function(){ 
	$('a.top').click(function(){
		var $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
		$body.animate({
			scrollTop: 0
		}, 600);

		return false;
	});
});
//慢速滑動至錨點位置 
$(function() {
	$('a[href="#announcement"]').click(function() {
		$('html,body').animate({
			scrollTop:$('#announcement').offset().top
		}, 600);
		return false;
	});
});

$(function() {
	$('a[href="#cooperation"]').click(function() {
		$('html,body').animate({
			scrollTop:$('#cooperation').offset().top
		}, 600);
		return false;
	});
});


$(function() {
	$('a[href="#job"]').click(function() {
		$('html,body').animate({
			scrollTop:$('#job').offset().top
		}, 600);
		return false;
	});
});

$(function() {
	$('a[href="#resume"]').click(function() {
		$('html,body').animate({
			scrollTop:$('#resume').offset().top
		}, 600);
		return false;
	});
});
$(function() {
	$('a[href="#report"]').click(function() {
		$('html,body').animate({
			scrollTop:$('#report').offset().top
		}, 600);
		return false;
	});
});

$(function() {
	$('a[href="#score"]').click(function() {
		$('html,body').animate({
			scrollTop:$('#score').offset().top
		}, 600);
		return false;
	});
});

$(function() {
	$('a[href="#download"]').click(function() {
		$('html,body').animate({
			scrollTop:$('#download').offset().top
		}, 600);
		return false;
	});
});

$(function() {
	$('a[href="#contact"]').click(function() {
		$('html,body').animate({
			scrollTop:$('#contact').offset().top
		}, 600);
		return false;
	});
});
// 無縫輪播
var Marquee = function(id){
	try{document.execCommand("BackgroundImageCache", false, true);}catch(e){};
	var container = document.getElementById(id),
	original = container.getElementsByTagName("dt")[0],
	clone = container.getElementsByTagName("dd")[0],
	speed = arguments[1] || 10;
	clone.innerHTML=original.innerHTML;
	var rolling = function(){
		if(container.scrollLeft == clone.offsetLeft){      
			container.scrollLeft = 0;
		}else{
			container.scrollLeft++;
		}
	}
  var timer = setInterval(rolling,speed)//設置定時器
  container.onmouseover=function() {clearInterval(timer)}//游標移到marquee上時，清除定時器，停止滚動
  container.onmouseout=function() {timer=setInterval(rolling,speed)}//游標移開時重設定時器
}
window.onload = function(){
	Marquee("marquee");
}



