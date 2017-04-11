$(function(){
	
	//ページ内のオーバー
	$("img.hover").hover(function(){
	 $(this).fadeTo(100,0.7);
	},function(){
	 $(this).fadeTo(100,1);
	});
	
	$(".menuBtn").click(function(){
		$("#navi").slideToggle();
		
	});

	$(window).scroll(function(){
		var sclNum = $(window).scrollTop();
		if(sclNum > 100){
			$(".totop").show();
		}else{
			$(".totop").hide();		
		}
	});
	
<<<<<<< HEAD

=======
>>>>>>> c1d09d48e16c433b206e9c9029284bb6a134e8e4

	//スクロール
	$(".scl").click(function(){
		var speed = 400;// ミリ秒
		var href= $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top;
		$($.browser.safari ? 'body' : 'html').animate({scrollTop:position}, speed, 'swing');
	});
	
<<<<<<< HEAD
})
=======
	
	
});
>>>>>>> c1d09d48e16c433b206e9c9029284bb6a134e8e4
