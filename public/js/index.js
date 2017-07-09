$('#myTabs a').click(function(e) {
	e.preventDefault()
	$(this).tab('show')
})
$(function () {
	$('[data-toggle="tooltip"]').tooltip();
})
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
	$('a[href="#download"]').click(function() {
		$('html,body').animate({
			scrollTop:$('#download').offset().top
		}, 600);
		return false;
	});
});

$(function() {
	$('a[href="#join"]').click(function() {
		$('html,body').animate({
			scrollTop:$('#join').offset().top
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




