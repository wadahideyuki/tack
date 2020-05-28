<img src="/sp/common/img/area.png" width="100%" alt=""/>
<!--insta-->	
  <div class="instaBlock">
  <h2>
    <img src="/sp/img/main_insta.png" alt="">
  </h2>
	<ul id="instafeed"></ul>
  </div>
  <script>

    $(function(){
	$.ajax({
		type: 'GET',
		url: 'https://graph.facebook.com/v3.0/17841433755873097?fields=name%2Cmedia.limit(10)%7Bcaption%2Clike_count%2Cmedia_url%2Cmedia_type%2Cthumbnail_url%2Cpermalink%2Ctimestamp%2Cusername%7D&access_token=EAAIg4gAnwZCoBAA4KuVgkmhJU2wFajoXqGGVm8DcuMWpBz5XbPbAyS8SA91K2WpxqRMeJfy59seHGiMxxm1veZB9vuWJiVP0a92unxrQNx4VhSj1owJCO1TrY1mZBshHDZBkvw2kZAeOEhMin8edAKK0XCq4RuvKbSZB3KLFwERkhTzZAGhv0ht8u5E1FaUm68ZD',
		dataType: 'json',
		success: function(json) {
		    	
		    var html = '';
		    var insta = json.media.data;
		    for (var i = 0; i < insta.length; i++) {
		    var media_type = insta[i].media_type;
                if ( insta[i].media_type == "IMAGE" || insta[i].media_type == "CAROUSEL_ALBUM" ) {
		    	html += '<li><a href="' + insta[i].permalink + '" target="_blank" rel="noopener noreferrer"><span class="square-content"><img src="' + insta[i].media_url + '"></span></a></li>';                
                } else if (media_type == "VIDEO" ) {
		    	html += '<li><a href="' + insta[i].permalink + '" target="_blank" rel="noopener noreferrer"><span class="square-content"><img src="' + insta[i].thumbnail_url + '"></span></a></li>';           
		    var media_type = '';                    
                }       
		    }
		      $("#instafeed").append(html);			
		},
		error: function() {
 
		//エラー時の処理
		}
	});
});	
</script>
<!--insta-->
<div id="footer">
		<div class="footInner"> 
			<p>カーペット・椅子ソファークリーニングなら株式会社タック <br>
〒130-0003　東京都墨田区横川2-17-9 タックビル</p>
		</div>
	</div>

<!--
<a href="#pagetop" class="totop scl"><img src="/common/img/totop.gif" width="69" height="69"></a>
-->


<ul class="fixBtn">
 <li><a href="tel:0358190961"><img src="/sp/common/img/btn_tel.png" alt=""/></a></li>
 <li><a href="/sp/info/inquiry.html"><img src="/sp/common/img/btn_estimate.png"  alt="" border="0"/></a></li>
</ul>