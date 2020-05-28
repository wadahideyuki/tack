<?php header("Content-Type:text/html;charset=shift_jis"); ?>
<?php //error_reporting(E_ALL | E_STRICT);
##-----------------------------------------------------------------------------------------------------------------##
#
#  PHPメールプログラム　フリー版 最終更新日2018/07/27
#　改造や改変は自己責任で行ってください。
#	
#  HP: http://www.php-factory.net/
#
#  重要！！サイトでチェックボックスを使用する場合のみですが。。。
#  チェックボックスを使用する場合はinputタグに記述するname属性の値を必ず配列の形にしてください。
#  例　name="当サイトをしったきっかけ[]"  として下さい。
#  nameの値の最後に[と]を付ける。じゃないと複数の値を取得できません！
#
##-----------------------------------------------------------------------------------------------------------------##
if (version_compare(PHP_VERSION, '5.1.0', '>=')) {//PHP5.1.0以上の場合のみタイムゾーンを定義
	date_default_timezone_set('Asia/Tokyo');//タイムゾーンの設定（日本以外の場合には適宜設定ください）
}
/*-------------------------------------------------------------------------------------------------------------------
* ★以下設定時の注意点　
* ・値（=の後）は数字以外の文字列（一部を除く）はダブルクオーテーション「"」、または「'」で囲んでいます。
* ・これをを外したり削除したりしないでください。後ろのセミコロン「;」も削除しないください。
* ・また先頭に「$」が付いた文字列は変更しないでください。数字の1または0で設定しているものは必ず半角数字で設定下さい。
* ・メールアドレスのname属性の値が「Email」ではない場合、以下必須設定箇所の「$Email」の値も変更下さい。
* ・name属性の値に半角スペースは使用できません。
*以上のことを間違えてしまうとプログラムが動作しなくなりますので注意下さい。
-------------------------------------------------------------------------------------------------------------------*/


//---------------------------　必須設定　必ず設定してください　-----------------------

//サイトのトップページのURL　※デフォルトでは送信完了後に「トップページへ戻る」ボタンが表示されますので
$site_top = "http://tack-ic.jp/";

//管理者のメールアドレス ※メールを受け取るメールアドレス(複数指定する場合は「,」で区切ってください 例 $to = "aa@aa.aa,bb@bb.bb";)
$to = "info@tack-ic.jp";

//自動返信メールの送信元メールアドレス
//必ず実在するメールアドレスでかつ出来る限り設置先サイトのドメインと同じドメインのメールアドレスとすることを強く推奨します
$from = "info@tack-ic.jp";

//フォームのメールアドレス入力箇所のname属性の値（name="○○"　の○○部分）
$Email = "Email";
//---------------------------　必須設定　ここまで　------------------------------------


//---------------------------　セキュリティ、スパム防止のための設定　------------------------------------

//スパム防止のためのリファラチェック（フォーム側とこのファイルが同一ドメインであるかどうかのチェック）(する=1, しない=0)
//※有効にするにはこのファイルとフォームのページが同一ドメイン内にある必要があります
$Referer_check = 0;

//リファラチェックを「する」場合のドメイン ※設置するサイトのドメインを指定して下さい。
//もしこの設定が間違っている場合は送信テストですぐに気付けます。
$Referer_check_domain = "php-factory.net";

/*セッションによるワンタイムトークン（CSRF対策、及びスパム防止）(する=1, しない=0)
※ただし、この機能を使う場合は↓の送信確認画面の表示が必須です。（デフォルトではON（1）になっています）
※【重要】ガラケーは機種によってはクッキーが使えないためガラケーの利用も想定してる場合は「0」（OFF）にして下さい（PC、スマホは問題ないです）*/
$useToken = 1;
//---------------------------　セキュリティ、スパム防止のための設定　ここまで　------------------------------------


//---------------------- 任意設定　以下は必要に応じて設定してください ------------------------


// 管理者宛のメールで差出人を送信者のメールアドレスにする(する=1, しない=0)
// する場合は、メール入力欄のname属性の値を「$Email」で指定した値にしてください。
//メーラーなどで返信する場合に便利なので「する」がおすすめです。
$userMail = 1;

// Bccで送るメールアドレス(複数指定する場合は「,」で区切ってください 例 $BccMail = "aa@aa.aa,bb@bb.bb";)
$BccMail = "";

// 管理者宛に送信されるメールのタイトル（件名）
$subject = "お問い合わせ";

// 送信確認画面の表示(する=1, しない=0)
$confirmDsp = 1;

// 送信完了後に自動的に指定のページ(サンクスページなど)に移動する(する=1, しない=0)
// CV率を解析したい場合などはサンクスページを別途用意し、URLをこの下の項目で指定してください。
// 0にすると、デフォルトの送信完了画面が表示されます。
$jumpPage = 0;

// 送信完了後に表示するページURL（上記で1を設定した場合のみ）※httpから始まるURLで指定ください。（相対パスでも基本的には問題ないです）
$thanksPage = "http://xxx.xxxxxxxxx/thanks.html";

// 必須入力項目を設定する(する=1, しない=0)
$requireCheck = 1;

/* 必須入力項目(入力フォームで指定したname属性の値を指定してください。（上記で1を設定した場合のみ）
値はシングルクォーテーションで囲み、複数の場合はカンマで区切ってください。フォーム側と順番を合わせると良いです。 
配列の形「name="○○[]"」の場合には必ず後ろの[]を取ったものを指定して下さい。*/
$require = array('お名前','フリガナ','〒','住所','Email');


//----------------------------------------------------------------------
//  自動返信メール設定(START)
//----------------------------------------------------------------------

// 差出人に送信内容確認メール（自動返信メール）を送る(送る=1, 送らない=0)
// 送る場合は、フォーム側のメール入力欄のname属性の値が上記「$Email」で指定した値と同じである必要があります
$remail = 1;

//自動返信メールの送信者欄に表示される名前　※あなたの名前や会社名など（もし自動返信メールの送信者名が文字化けする場合ここは空にしてください）
$refrom_name = "";

// 差出人に送信確認メールを送る場合のメールのタイトル（上記で1を設定した場合のみ）
$re_subject = "送信ありがとうございました";

//フォーム側の「名前」箇所のname属性の値　※自動返信メールの「○○様」の表示で使用します。
//指定しない、または存在しない場合は、○○様と表示されないだけです。あえて無効にしてもOK
$dsp_name = 'お名前';

//自動返信メールの冒頭の文言 ※日本語部分のみ変更可
$remail_text = <<< TEXT

お問い合わせ頂き誠にありがとうございました。
以下のように内容が送信されましたのでご確認いただけます様お願い申し上げます。

TEXT;


//自動返信メールに署名（フッター）を表示(する=1, しない=0)※管理者宛にも表示されます。
$mailFooterDsp = 1;

//上記で「1」を選択時に表示する署名（フッター）（FOOTER～FOOTER;の間に記述してください）
$mailSignature = <<< FOOTER

────────────────────────────────────────────
カーペット・椅子ソファクリーニングなら株式会社タック　
〒130-0003　東京都墨田区横川2-17-9タックビル
Tel：03-5819-0961　Fax：03-5819-0964
E-mail：info@tack-ic.jp 
────────────────────────────────────────────

FOOTER;


//----------------------------------------------------------------------
//  自動返信メール設定(END)
//----------------------------------------------------------------------

//メールアドレスの形式チェックを行うかどうか。(する=1, しない=0)
//※デフォルトは「する」。特に理由がなければ変更しないで下さい。メール入力欄のname属性の値が上記「$Email」で指定した値である必要があります。
$mail_check = 1;

//全角英数字→半角変換を行うかどうか。(する=1, しない=0)
$hankaku = 0;

//全角英数字→半角変換を行う項目のname属性の値（name="○○"の「○○」部分）
//※複数の場合にはカンマで区切って下さい。（上記で「1」を指定した場合のみ有効）
//配列の形「name="○○[]"」の場合には必ず後ろの[]を取ったものを指定して下さい。
$hankaku_array = array('電話番号','金額');

//-fオプションによるエンベロープFrom（Return-Path）の設定(する=1, しない=0)　
//※宛先不明（間違いなどで存在しないアドレス）の場合に 管理者宛に「Mail Delivery System」から「Undelivered Mail Returned to Sender」というメールが届きます。
//サーバーによっては稀にこの設定が必須の場合もあります。
//設置サーバーでPHPがセーフモードで動作している場合は使用できませんので送信時にエラーが出たりメールが届かない場合は「0」（OFF）として下さい。
$use_envelope = 0;

//機種依存文字の変換
/*たとえば㈱（かっこ株）や①（丸1）、その他特殊な記号や特殊な漢字などは変換できずに「？」と表示されます。それを回避するための機能です。
確認画面表示時に置換処理されます。「変換前の文字」が「変換後の文字」に変換され、送信メール内でも変換された状態で送信されます。（たとえば「㈱」の場合、「（株）」に変換されます） 
必要に応じて自由に追加して下さい。ただし、変換前の文字と変換後の文字の順番と数は必ず合わせる必要がありますのでご注意下さい。*/

//変換前の文字
$replaceStr['before'] = array();//Shift_JIS版の場合は機種依存文字も使えるため無効
//変換後の文字
$replaceStr['after'] = array();//Shift_JIS版の場合は機種依存文字も使えるため無効

//------------------------------- 任意設定ここまで ---------------------------------------------


// 以下の変更は知識のある方のみ自己責任でお願いします。

//----------------------------------------------------------------------
//  関数実行、変数初期化
//----------------------------------------------------------------------
//トークンチェック用のセッションスタート
if($useToken == 1 && $confirmDsp == 1){
	session_name('PHPMAILFORMSYSTEM');
	session_start();
}
$encode = "SJIS";//このファイルの文字コード定義（変更不可）
if(isset($_GET)) $_GET = sanitize($_GET);//NULLバイト除去//
if(isset($_POST)) $_POST = sanitize($_POST);//NULLバイト除去//
if(isset($_COOKIE)) $_COOKIE = sanitize($_COOKIE);//NULLバイト除去//
if($encode == 'SJIS') $_POST = sjisReplace($_POST,$encode);//Shift-JISの場合に誤変換文字の置換実行
$funcRefererCheck = refererCheck($Referer_check,$Referer_check_domain);//リファラチェック実行

//変数初期化
$sendmail = 0;
$empty_flag = 0;
$post_mail = '';
$errm ='';
$header ='';

if($requireCheck == 1) {
	$requireResArray = requireCheck($require);//必須チェック実行し返り値を受け取る
	$errm = $requireResArray['errm'];
	$empty_flag = $requireResArray['empty_flag'];
}
//メールアドレスチェック
if(empty($errm)){
	foreach($_POST as $key=>$val) {
		if($val == "confirm_submit") $sendmail = 1;
		if($key == $Email) $post_mail = h($val);
		if($key == $Email && $mail_check == 1 && !empty($val)){
			if(!checkMail($val)){
				$errm .= "<p class=\"error_messe\">【".$key."】はメールアドレスの形式が正しくありません。</p>\n";
				$empty_flag = 1;
			}
		}
	}
}
  
if(($confirmDsp == 0 || $sendmail == 1) && $empty_flag != 1){
	
	//トークンチェック（CSRF対策）※確認画面がONの場合のみ実施
	if($useToken == 1 && $confirmDsp == 1){
		if(empty($_SESSION['mailform_token']) || ($_SESSION['mailform_token'] !== $_POST['mailform_token'])){
			exit('ページ遷移が不正です');
		}
		if(isset($_SESSION['mailform_token'])) unset($_SESSION['mailform_token']);//トークン破棄
		if(isset($_POST['mailform_token'])) unset($_POST['mailform_token']);//トークン破棄
	}
	
	//差出人に届くメールをセット
	if($remail == 1) {
		$userBody = mailToUser($_POST,$dsp_name,$remail_text,$mailFooterDsp,$mailSignature,$encode);
		$reheader = userHeader($refrom_name,$from,$encode);
		$re_subject = "=?iso-2022-jp?B?".base64_encode(mb_convert_encoding($re_subject,"JIS",$encode))."?=";
	}
	//管理者宛に届くメールをセット
	$adminBody = mailToAdmin($_POST,$subject,$mailFooterDsp,$mailSignature,$encode,$confirmDsp);
	$header = adminHeader($userMail,$post_mail,$BccMail,$to);
	$subject = "=?iso-2022-jp?B?".base64_encode(mb_convert_encoding($subject,"JIS",$encode))."?=";
	
	//-fオプションによるエンベロープFrom（Return-Path）の設定(safe_modeがOFFの場合かつ上記設定がONの場合のみ実施)
	if($use_envelope == 0){
		mail($to,$subject,$adminBody,$header);
		if($remail == 1 && !empty($post_mail)) mail($post_mail,$re_subject,$userBody,$reheader);
	}else{
		mail($to,$subject,$adminBody,$header,'-f'.$from);
		if($remail == 1 && !empty($post_mail)) mail($post_mail,$re_subject,$userBody,$reheader,'-f'.$from);
	}
}
else if($confirmDsp == 1){ 

/*　▼▼▼送信確認画面のレイアウト※編集可　オリジナルのデザインも適用可能▼▼▼　*/
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift_jis">
    <title>椅子やソファークリーニングのお問合せ・お見積り</title>
    <meta name="keywords" content="椅子,ソファー,クリーニング,お問合せ,お見積,価格,電話,インターネット">
    <meta name="description" content="椅子やソファーのクリーニングのお見積りはこちら。お気軽にお問い合わせください">
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="../common/js/common.js"></script>
    <link rel="canonical" href="http://www.tack-ic.jp/info/inquiry.html"/>
    <link rel="stylesheet" href="../common/css/reset2.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../common/css/common.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--[if IE 6]>
<script type="text/javascript" src="/common/js/DD_belatedPNG_0.0.8a-min.js"></script>
<script>
DD_belatedPNG.fix('img, .png_bg');
</script>
<![endif]-->
  </head>
  <body id="company">
    <div id="wrapper">	

      <!--head-->

      <a name="pagetop" id="pagetop"></a>
      <div id="header">
        <p class="summary">椅子やソファーのクリーニングは タックにお任せ下さい！</p>
        <a href="http://www.tack-ic.jp/"><img src="http://www.tack-ic.jp/common/img/logo.jpg" alt="椅子・ソファークリーニングのタック" width="176" height="94"></a>
        <img src="http://www.tack-ic.jp/common/img/head_tel.jpg" alt="TEL03-5819-0961" width="420" height="46" class="tel">
        <ul id="navi">
          <li class="feature"><a href="http://www.tack-ic.jp/point/point1/">Tackの特徴</a></li>
          <li class="service"><a href="http://www.tack-ic.jp/service/">サービス一覧</a></li>
          <li class="flow"><a href="http://www.tack-ic.jp/info/flow.html">お仕事の流れ</a></li>
          <li class="voice"><a href="http://www.tack-ic.jp/voice/voice1/">お客様の声</a></li>
          <li class="qa"><a href="http://www.tack-ic.jp/info/faq.html">よくある質問</a></li>
          <li class="company"><a href="http://www.tack-ic.jp/info/company.html">会社概要</a></li>
        </ul>
      </div>
      <!--//head-->

      <!--PNKZ-->
      <div id="pankuz"><a href="http://www.tack-ic.jp/">椅子やソファーのクリーニングはタック HOME</a> >お問い合わせ・お見積り</div>
      <!--//PNKZ-->
      <div id="contentWrap" class="clearfix">


        <!--sideNavi-->

        <div id="sideNavi">
          <div class="sideBox">
            <h2 class="sMenu"><img src="http://www.tack-ic.jp/common/img/side_ttl_01.png" width="108" height="38"></h2>
            <ul>
              <li class="chair"><a href="http://www.tack-ic.jp/service/chair/">椅子クリーニング</a>
                <span class="second">∟<a href="http://www.tack-ic.jp/service/chair/flow.html">椅子クリーニング作業の流れ</a></span>
                <span class="second">∟<a href="http://www.tack-ic.jp/service/chair/ex.html">椅子クリーニング施工実績</a></span>
              </li>
              <li class="sofa"><a href="http://www.tack-ic.jp/service/sofa/"> ソファークリーニング</a></li>
              <li class="carpet"><a href="http://www.tack-ic.jp/service/carpet/"> カーペットクリーニング</a></li>
              <li class="braind"><a href="http://www.tack-ic.jp/service/braind/"> ブラインドクリーニング</a></li>
              <li class="air"><a href="http://www.tack-ic.jp/service/air/"> エアコンクリーニング</a></li>
              <li class="other"><a href="http://www.tack-ic.jp/service/other/"> その他クリーニング</a></li>
              <li class="re_chair"><a href="http://www.tack-ic.jp/service/re_chair/"> 椅子ソファー張替え</a>
                <span class="second">∟<a href="http://www.tack-ic.jp/service/re_chair/flow.html">椅子張替え依頼フロー</a></span>
                <span class="second">∟<a href="http://www.tack-ic.jp/service/re_chair/ex.html">椅子ソファー張替え施工実績</a></span></li>
              <li class="re_carpet"><a href="http://www.tack-ic.jp/service/re_carpet/">カーペット再染色サービス</a></li>
            </ul>
          </div>
          <div class="sideBox sideBox2">
            <h2 class="sArea"><img src="http://www.tack-ic.jp/common/img/side_ttl_02.png" width="87" height="18"></h2>
            <img src="http://www.tack-ic.jp/common/img/side_img.png" width="195" height="97">
            <p>タックでは東京、埼玉、千葉、神奈川の１都3県を中心にサービスを提供させて頂いています。現地にお伺いして作業をするパターン、椅子ソファーを持ち帰って作業をするパターンの両方に対応しております。</p>
            <div class="sideBtn"><a href="http://www.tack-ic.jp/info/inquiry.html"><img src="http://www.tack-ic.jp/common/img/side_btn.png" width="174" height="45" class="hover"></a></div>
          </div>
        </div>	
        <!--//sideNavi-->

        <!--contentsInner-->
        <div id="contents">
          <div id="contentsInner">






            <!--//content-->
<!-- ▲ Headerやその他コンテンツなど　※自由に編集可 ▲-->

<!-- ▼************ 送信内容表示部　※編集は自己責任で ************ ▼-->
<div id="formWrap">
<?php if($empty_flag == 1){ ?>
<div align="center">
  <h1>お問い合わせエラー</h1>
  <p>以下のエラーが発生しました。 確認の上再入力してください。</p>
<?php echo $errm; ?><br /><br /><input type="button" value=" 前画面に戻る " onClick="history.back()">
</div>
<?php }else{ ?>
  <h1>作業内容や価格についてはお気軽にお問合せください</h1>
  <p>以下の項目に間違いがなければ、送信ボタンを押してください。<br><br></p>
  <div class="alignC">
<form action="<?php echo h($_SERVER['SCRIPT_NAME']); ?>" method="POST">
  <table class="mail-form">
<?php echo confirmOutput($_POST);//入力内容を表示?>
</table>
<p align="center"><input type="hidden" name="mail_set" value="confirm_submit">
<input type="hidden" name="httpReferer" value="<?php echo h($_SERVER['HTTP_REFERER']);?>">
  <input type="submit" value="  送  信　">
  <input type="button" value="  戻  る  " onClick="history.back()"></p>
</form>
  </div>
<?php } ?>
</div><!-- /formWrap -->
<!-- ▲ *********** 送信内容確認部　※編集は自己責任で ************ ▲-->

<!-- ▼ Footerその他コンテンツなど　※編集可 ▼-->
          </div></div></div>	
      <!--contact-->	
    </div>	
    <!-- ▽フッタ -->	
    <div id="footer">	
      <div class="footInner">	
        <p>カーペット・椅子ソファークリーニングなら株式会社タック 〒130-0003　東京都墨田区横川2-17-9 タックビル 　E-mail：<a href="mailto:info@tack-ic.jp" style="color:#FFF;">info@tack-ic.jp</a></p>	
      </div>	
    </div>	
    <div id="sitemap">	
      <div id="sitemapInner" class="clearfix" style="position:relative;">	
        <ul class="ttl">	
          <li class="PB10"><img src="http://www.tack-ic.jp/common/img/foot_logo.gif" width="126" height="71"></li>	
          <li><a href="http://www.tack-ic.jp/" class="cate">椅子やソファーのクリーニングはタックHOME</a></li>	
        </ul>	
        <ul>	
          <li><a href="http://www.tack-ic.jp/service/" class="cate">サービス一覧</a></li>	
          <li><a href="http://www.tack-ic.jp/service/chair/" >椅子クリーニング</a></li>	
          <li><a href="http://www.tack-ic.jp/service/sofa/" >ソファークリーニング</a></li>	
          <li><a href="http://www.tack-ic.jp/service/carpet/" >カーペットクリーニング</a></li>	
          <li><a href="http://www.tack-ic.jp/service/air/" >エアコンクリーニング</a></li>	
          <li><a href="http://www.tack-ic.jp/service/braind/" >ブラインドクリーニング</a></li>	
          <li><a href="http://www.tack-ic.jp/service/other/" >その他クリーニング</a></li>	
          <li><a href="http://www.tack-ic.jp/service/re_chair/" >椅子・ソファー張替え</a></li>	
          <li><a href="http://www.tack-ic.jp/service/re_carpet/" >カーペット再染色サービス</a></li>	
        </ul>	
        <ul>	
          <li><a href="http://www.tack-ic.jp/point/point1/" class="cate">Tackの特徴</a></li>	
          <li><a href="http://www.tack-ic.jp/point/point1/" >椅子ソファークリーニングの専門家</a></li>	
          <li><a href="http://www.tack-ic.jp/point/point2/" >洗剤と最新マシン</a></li>	
          <li class="PB15"><a href="http://www.tack-ic.jp/point/point3/" >価格</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice1/" class="cate">お客様の声</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice1/" >エルセルモ</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice2/" >ラン・トラスト</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice3/" >レストランTR</a></li>	
        </ul>	
        <ul class="lineH">	
          <li><a href="http://www.tack-ic.jp/info/inquiry.html" class="cate">お問い合わせ・お見積り</a></li>	
          <li><a href="http://www.tack-ic.jp/info/flow.html" class="cate">ご利用の流れ</a></li>	
          <li><a href="http://www.tack-ic.jp/info/faq.html" class="cate">よくある質問</a></li>	
          <li><a href="http://www.tack-ic.jp/info/demo.html" class="cate">無料椅子クリーニングデモ</a></li>	
          <li><a href="http://www.tack-ic.jp/info/advice.html" class="cate">お掃除アドバイス</a></li>	
        </ul>	
        <ul class="lineH">	
          <li><a href="http://www.tack-ic.jp/info/company.html" class="cate">会社概要</a></li>	
          <li><a href="http://www.tack-ic.jp/info/access.html" class="cate">アクセスマップ</a></li>	
          <li><a href="http://www.tack-ic.jp/info/link.html" class="cate">	リンクについて</a></li>	
          <li><a href="http://www.tack-ic.jp/info/privacy.html" class="cate"> プライバシーポリシー</a></li>	
          <li><a href="http://www.tack-ic.jp/info/sitemap.html" class="cate">サイトマップ</a></li>	
        </ul>	
      </div>	
    </div>	
    <a href="#pagetop" class="totop scl"><img src="http://www.tack-ic.jp/common/img/totop.gif" width="69" height="69"></a>	
    <script type="text/javascript">	
      var _gaq = _gaq || [];	
      _gaq.push(['_setAccount', 'UA-41622988-1']);	
      _gaq.push(['_trackPageview']);	
      (function() {	
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;	
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';	
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);	
      })();	
    </script>
</body>
</html>
<?php
/* ▲▲▲送信確認画面のレイアウト　※オリジナルのデザインも適用可能▲▲▲　*/
}

if(($jumpPage == 0 && $sendmail == 1) || ($jumpPage == 0 && ($confirmDsp == 0 && $sendmail == 0))) { 

/* ▼▼▼送信完了画面のレイアウト　編集可 ※送信完了後に指定のページに移動しない場合のみ表示▼▼▼　*/
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift_jis">
    <title>椅子やソファークリーニングのお問合せ・お見積り</title>
    <meta name="keywords" content="椅子,ソファー,クリーニング,お問合せ,お見積,価格,電話,インターネット">
    <meta name="description" content="椅子やソファーのクリーニングのお見積りはこちら。お気軽にお問い合わせください">
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="../common/js/common.js"></script>
    <link rel="canonical" href="http://www.tack-ic.jp/info/inquiry.html"/>
    <link rel="stylesheet" href="../common/css/reset2.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../common/css/common.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--[if IE 6]>
<script type="text/javascript" src="/common/js/DD_belatedPNG_0.0.8a-min.js"></script>
<script>
DD_belatedPNG.fix('img, .png_bg');
</script>
<![endif]-->
  </head>
  <body id="company">
    <div id="wrapper">	

      <!--head-->

      <a name="pagetop" id="pagetop"></a>
      <div id="header">
        <p class="summary">椅子やソファーのクリーニングは タックにお任せ下さい！</p>
        <a href="http://www.tack-ic.jp/"><img src="http://www.tack-ic.jp/common/img/logo.jpg" alt="椅子・ソファークリーニングのタック" width="176" height="94"></a>
        <img src="http://www.tack-ic.jp/common/img/head_tel.jpg" alt="TEL03-5819-0961" width="420" height="46" class="tel">
        <ul id="navi">
          <li class="feature"><a href="http://www.tack-ic.jp/point/point1/">Tackの特徴</a></li>
          <li class="service"><a href="http://www.tack-ic.jp/service/">サービス一覧</a></li>
          <li class="flow"><a href="http://www.tack-ic.jp/info/flow.html">お仕事の流れ</a></li>
          <li class="voice"><a href="http://www.tack-ic.jp/voice/voice1/">お客様の声</a></li>
          <li class="qa"><a href="http://www.tack-ic.jp/info/faq.html">よくある質問</a></li>
          <li class="company"><a href="http://www.tack-ic.jp/info/company.html">会社概要</a></li>
        </ul>
      </div>
      <!--//head-->

      <!--PNKZ-->
      <div id="pankuz"><a href="http://www.tack-ic.jp/">椅子やソファーのクリーニングはタック HOME</a> >お問い合わせ・お見積り</div>
      <!--//PNKZ-->
      <div id="contentWrap" class="clearfix">


        <!--sideNavi-->

        <div id="sideNavi">
          <div class="sideBox">
            <h2 class="sMenu"><img src="http://www.tack-ic.jp/common/img/side_ttl_01.png" width="108" height="38"></h2>
            <ul>
              <li class="chair"><a href="http://www.tack-ic.jp/service/chair/">椅子クリーニング</a>
                <span class="second">∟<a href="http://www.tack-ic.jp/service/chair/flow.html">椅子クリーニング作業の流れ</a></span>
                <span class="second">∟<a href="http://www.tack-ic.jp/service/chair/ex.html">椅子クリーニング施工実績</a></span>
              </li>
              <li class="sofa"><a href="http://www.tack-ic.jp/service/sofa/"> ソファークリーニング</a></li>
              <li class="carpet"><a href="http://www.tack-ic.jp/service/carpet/"> カーペットクリーニング</a></li>
              <li class="braind"><a href="http://www.tack-ic.jp/service/braind/"> ブラインドクリーニング</a></li>
              <li class="air"><a href="http://www.tack-ic.jp/service/air/"> エアコンクリーニング</a></li>
              <li class="other"><a href="http://www.tack-ic.jp/service/other/"> その他クリーニング</a></li>
              <li class="re_chair"><a href="http://www.tack-ic.jp/service/re_chair/"> 椅子ソファー張替え</a>
                <span class="second">∟<a href="http://www.tack-ic.jp/service/re_chair/flow.html">椅子張替え依頼フロー</a></span>
                <span class="second">∟<a href="http://www.tack-ic.jp/service/re_chair/ex.html">椅子ソファー張替え施工実績</a></span></li>
              <li class="re_carpet"><a href="http://www.tack-ic.jp/service/re_carpet/">カーペット再染色サービス</a></li>
            </ul>
          </div>
          <div class="sideBox sideBox2">
            <h2 class="sArea"><img src="http://www.tack-ic.jp/common/img/side_ttl_02.png" width="87" height="18"></h2>
            <img src="http://www.tack-ic.jp/common/img/side_img.png" width="195" height="97">
            <p>タックでは東京、埼玉、千葉、神奈川の１都3県を中心にサービスを提供させて頂いています。現地にお伺いして作業をするパターン、椅子ソファーを持ち帰って作業をするパターンの両方に対応しております。</p>
            <div class="sideBtn"><a href="http://www.tack-ic.jp/info/inquiry.html"><img src="http://www.tack-ic.jp/common/img/side_btn.png" width="174" height="45" class="hover"></a></div>
          </div>
        </div>	
        <!--//sideNavi-->

        <!--contentsInner-->
        <div id="contents">
          <div id="contentsInner">






            <!--//content-->
<!-- ▲ Headerやその他コンテンツなど　※自由に編集可 ▲-->

<?php if($empty_flag == 1){ ?>
  <h1>以下のエラーが発生しました。 確認の上再入力してください。。</h1>
<div style="color:red"><?php echo $errm; ?></div>
<br /><br /><input type="button" value=" 前画面に戻る " onClick="history.back()">
</div>
</body>
</html>
<?php }else{ ?>
<p style="text-align:center">送信ありがとうございました。<br />
送信は正常に完了しました。<br /><br /></p>

<p style="text-align:center"><a href="<?php echo $site_top ;?>">トップページへ戻る&raquo;</a></p>

<!-- ▼ Footerその他コンテンツなど　※編集可 ▼-->
          </div></div></div>	
      <!--contact-->	
    </div>	
    <!-- ▽フッタ -->	
    <div id="footer">	
      <div class="footInner">	
        <p>カーペット・椅子ソファークリーニングなら株式会社タック 〒130-0003　東京都墨田区横川2-17-9 タックビル 　E-mail：<a href="mailto:info@tack-ic.jp" style="color:#FFF;">info@tack-ic.jp</a></p>	
      </div>	
    </div>	
    <div id="sitemap">	
      <div id="sitemapInner" class="clearfix" style="position:relative;">	
        <ul class="ttl">	
          <li class="PB10"><img src="http://www.tack-ic.jp/common/img/foot_logo.gif" width="126" height="71"></li>	
          <li><a href="http://www.tack-ic.jp/" class="cate">椅子やソファーのクリーニングはタックHOME</a></li>	
        </ul>	
        <ul>	
          <li><a href="http://www.tack-ic.jp/service/" class="cate">サービス一覧</a></li>	
          <li><a href="http://www.tack-ic.jp/service/chair/" >椅子クリーニング</a></li>	
          <li><a href="http://www.tack-ic.jp/service/sofa/" >ソファークリーニング</a></li>	
          <li><a href="http://www.tack-ic.jp/service/carpet/" >カーペットクリーニング</a></li>	
          <li><a href="http://www.tack-ic.jp/service/air/" >エアコンクリーニング</a></li>	
          <li><a href="http://www.tack-ic.jp/service/braind/" >ブラインドクリーニング</a></li>	
          <li><a href="http://www.tack-ic.jp/service/other/" >その他クリーニング</a></li>	
          <li><a href="http://www.tack-ic.jp/service/re_chair/" >椅子・ソファー張替え</a></li>	
          <li><a href="http://www.tack-ic.jp/service/re_carpet/" >カーペット再染色サービス</a></li>	
        </ul>	
        <ul>	
          <li><a href="http://www.tack-ic.jp/point/point1/" class="cate">Tackの特徴</a></li>	
          <li><a href="http://www.tack-ic.jp/point/point1/" >椅子ソファークリーニングの専門家</a></li>	
          <li><a href="http://www.tack-ic.jp/point/point2/" >洗剤と最新マシン</a></li>	
          <li class="PB15"><a href="http://www.tack-ic.jp/point/point3/" >価格</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice1/" class="cate">お客様の声</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice1/" >エルセルモ</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice2/" >ラン・トラスト</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice3/" >レストランTR</a></li>	
        </ul>	
        <ul class="lineH">	
          <li><a href="http://www.tack-ic.jp/info/inquiry.html" class="cate">お問い合わせ・お見積り</a></li>	
          <li><a href="http://www.tack-ic.jp/info/flow.html" class="cate">ご利用の流れ</a></li>	
          <li><a href="http://www.tack-ic.jp/info/faq.html" class="cate">よくある質問</a></li>	
          <li><a href="http://www.tack-ic.jp/info/demo.html" class="cate">無料椅子クリーニングデモ</a></li>	
          <li><a href="http://www.tack-ic.jp/info/advice.html" class="cate">お掃除アドバイス</a></li>	
        </ul>	
        <ul class="lineH">	
          <li><a href="http://www.tack-ic.jp/info/company.html" class="cate">会社概要</a></li>	
          <li><a href="http://www.tack-ic.jp/info/access.html" class="cate">アクセスマップ</a></li>	
          <li><a href="http://www.tack-ic.jp/info/link.html" class="cate">	リンクについて</a></li>	
          <li><a href="http://www.tack-ic.jp/info/privacy.html" class="cate"> プライバシーポリシー</a></li>	
          <li><a href="http://www.tack-ic.jp/info/sitemap.html" class="cate">サイトマップ</a></li>	
        </ul>	
      </div>	
    </div>	
    <a href="#pagetop" class="totop scl"><img src="http://www.tack-ic.jp/common/img/totop.gif" width="69" height="69"></a>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-41622988-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- Google Code for &#12362;&#35211;&#31309;&#12418;&#12426; Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1039293290;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "P_2ECNS-rAcQ6rbJ7wM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1039293290/?value=0&amp;label=P_2ECNS-rAcQ6rbJ7wM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
</body>
</html>
<?php 
/* ▲▲▲送信完了画面のレイアウト 編集可 ※送信完了後に指定のページに移動しない場合のみ表示▲▲▲　*/
  }
}
//確認画面無しの場合の表示、指定のページに移動する設定の場合、エラーチェックで問題が無ければ指定ページヘリダイレクト
else if(($jumpPage == 1 && $sendmail == 1) || $confirmDsp == 0) { 
	if($empty_flag == 1){ ?>
<div align="center"><h4>入力にエラーがあります。下記をご確認の上「戻る」ボタンにて修正をお願い致します。</h4><div style="color:red"><?php echo $errm; ?></div><br /><br /><input type="button" value=" 前画面に戻る " onClick="history.back()"></div>
<?php 
	}else{ header("Location: ".$thanksPage); }
}

// 以下の変更は知識のある方のみ自己責任でお願いします。

//----------------------------------------------------------------------
//  関数定義(START)
//----------------------------------------------------------------------
function checkMail($str){
	$mailaddress_array = explode('@',$str);
	if(preg_match("/^[\.!#%&\-_0-9a-zA-Z\?\/\+]+\@[!#%&\-_0-9a-zA-Z]+(\.[!#%&\-_0-9a-zA-Z]+)+$/", "$str") && count($mailaddress_array) ==2){
		return true;
	}else{
		return false;
	}
}
function h($string) {
	global $encode;
	return htmlspecialchars($string, ENT_QUOTES,$encode);
}
function sanitize($arr){
	if(is_array($arr)){
		return array_map('sanitize',$arr);
	}
	return str_replace("\0","",$arr);
}
//Shift-JISの場合に誤変換文字の置換関数
function sjisReplace($arr,$encode){
	foreach($arr as $key => $val){
		$key = str_replace('＼','ー',$key);
		$resArray[$key] = $val;
	}
	return $resArray;
}
//送信メールにPOSTデータをセットする関数
function postToMail($arr){
	global $hankaku,$hankaku_array;
	$resArray = '';
	foreach($arr as $key => $val) {
		$out = '';
		if(is_array($val)){
			foreach($val as $key02 => $item){ 
				//連結項目の処理
				if(is_array($item)){
					$out .= connect2val($item);
				}else{
					$out .= $item . ', ';
				}
			}
			$out = rtrim($out,', ');
			
		}else{ $out = $val; }//チェックボックス（配列）追記ここまで
		if(get_magic_quotes_gpc()) { $out = stripslashes($out); }
		
		//全角→半角変換
		if($hankaku == 1){
			$out = zenkaku2hankaku($key,$out,$hankaku_array);
		}
		if($out != "confirm_submit" && $key != "httpReferer") {
			$resArray .= "【 ".h($key)." 】 ".h($out)."\n";
		}
	}
	return $resArray;
}
//確認画面の入力内容出力用関数
function confirmOutput($arr){
	global $hankaku,$hankaku_array,$useToken,$confirmDsp,$replaceStr;
	$html = '';
	foreach($arr as $key => $val) {
		$out = '';
		if(is_array($val)){
			foreach($val as $key02 => $item){ 
				//連結項目の処理
				if(is_array($item)){
					$out .= connect2val($item);
				}else{
					$out .= $item . ', ';
				}
			}
			$out = rtrim($out,', ');
			
		}else{ $out = $val; }//チェックボックス（配列）追記ここまで
		if(get_magic_quotes_gpc()) { $out = stripslashes($out); }
		$out = nl2br(h($out));//※追記 改行コードを<br>タグに変換
		$key = h($key);
		$out = str_replace($replaceStr['before'], $replaceStr['after'], $out);//機種依存文字の置換処理
		
		//全角→半角変換
		if($hankaku == 1){
			$out = zenkaku2hankaku($key,$out,$hankaku_array);
		}
		
		$html .= "<tr><th>".$key."</th><td>".$out;
		$html .= '<input type="hidden" name="'.$key.'" value="'.str_replace(array("<br />","<br>"),"",$out).'" />';
		$html .= "</td></tr>\n";
	}
	//トークンをセット
	if($useToken == 1 && $confirmDsp == 1){
		$token = sha1(uniqid(mt_rand(), true));
		$_SESSION['mailform_token'] = $token;
		$html .= '<input type="hidden" name="mailform_token" value="'.$token.'" />';
	}
	
	return $html;
}

//全角→半角変換
function zenkaku2hankaku($key,$out,$hankaku_array){
	global $encode;
	if(is_array($hankaku_array) && function_exists('mb_convert_kana')){
		foreach($hankaku_array as $hankaku_array_val){
			if($key == $hankaku_array_val){
				$out = mb_convert_kana($out,'a',$encode);
			}
		}
	}
	return $out;
}
//配列連結の処理
function connect2val($arr){
	$out = '';
	foreach($arr as $key => $val){
		if($key === 0 || $val == ''){//配列が未記入（0）、または内容が空のの場合には連結文字を付加しない（型まで調べる必要あり）
			$key = '';
		}elseif(strpos($key,"円") !== false && $val != '' && preg_match("/^[0-9]+$/",$val)){
			$val = number_format($val);//金額の場合には3桁ごとにカンマを追加
		}
		$out .= $val . $key;
	}
	return $out;
}

//管理者宛送信メールヘッダ
function adminHeader($userMail,$post_mail,$BccMail,$to){
	$header = '';
	if($userMail == 1 && !empty($post_mail)) {
		$header="From: $post_mail\n";
		if($BccMail != '') {
		  $header.="Bcc: $BccMail\n";
		}
		$header.="Reply-To: ".$post_mail."\n";
	}else {
		if($BccMail != '') {
		  $header="Bcc: $BccMail\n";
		}
		$header.="Reply-To: ".$to."\n";
	}
		$header.="Content-Type:text/plain;charset=iso-2022-jp\nX-Mailer: PHP/".phpversion();
		return $header;
}
//管理者宛送信メールボディ
function mailToAdmin($arr,$subject,$mailFooterDsp,$mailSignature,$encode,$confirmDsp){
  $adminBody="下記の内容でお問い合わせがありました。\n\n";
	$adminBody .="＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
	$adminBody.= postToMail($arr);//POSTデータを関数からセット
	$adminBody.="\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n";
	$adminBody.="送信された日時：".date( "Y/m/d (D) H:i:s", time() )."\n";
	$adminBody.="送信者のIPアドレス：".@$_SERVER["REMOTE_ADDR"]."\n";
	$adminBody.="送信者のホスト名：".getHostByAddr(getenv('REMOTE_ADDR'))."\n";
	if($confirmDsp != 1){
		$adminBody.="問い合わせのページURL：".@$_SERVER['HTTP_REFERER']."\n";
	}else{
		$adminBody.="問い合わせのページURL：".@$arr['httpReferer']."\n";
	}
	if($mailFooterDsp == 1) $adminBody.= $mailSignature;
	return mb_convert_encoding($adminBody,"JIS",$encode);
}

//ユーザ宛送信メールヘッダ
function userHeader($refrom_name,$to,$encode){
	$reheader = "From: ";
	if(!empty($refrom_name)){
		$default_internal_encode = mb_internal_encoding();
		if($default_internal_encode != $encode){
			mb_internal_encoding($encode);
		}
		$reheader .= mb_encode_mimeheader($refrom_name)." <".$to.">\nReply-To: ".$to;
	}else{
		$reheader .= "$to\nReply-To: ".$to;
	}
	$reheader .= "\nContent-Type: text/plain;charset=iso-2022-jp\nX-Mailer: PHP/".phpversion();
	return $reheader;
}
//ユーザ宛送信メールボディ
function mailToUser($arr,$dsp_name,$remail_text,$mailFooterDsp,$mailSignature,$encode){
	$userBody = '';
	if(isset($arr[$dsp_name])) $userBody = h($arr[$dsp_name]). " 様\n";
	$userBody.= $remail_text;
	$userBody.="\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
	$userBody.= postToMail($arr);//POSTデータを関数からセット
	$userBody.="\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝\n\n";
	$userBody.="送信日時：".date( "Y/m/d (D) H:i:s", time() )."\n";
	if($mailFooterDsp == 1) $userBody.= $mailSignature;
	return mb_convert_encoding($userBody,"JIS",$encode);
}
//必須チェック関数
function requireCheck($require){
	$res['errm'] = '';
	$res['empty_flag'] = 0;
	foreach($require as $requireVal){
		$existsFalg = '';
		foreach($_POST as $key => $val) {
			if($key == $requireVal) {
				
				//連結指定の項目（配列）のための必須チェック
				if(is_array($val)){
					$connectEmpty = 0;
					foreach($val as $kk => $vv){
						if(is_array($vv)){
							foreach($vv as $kk02 => $vv02){
								if($vv02 == ''){
									$connectEmpty++;
								}
							}
						}
						
					}
					if($connectEmpty > 0){
                      $res['errm'] .= "<p class=\"error_messe\">【".h($key)."】の項目が未入力です。</p>\n";
						$res['empty_flag'] = 1;
					}
				}
				//デフォルト必須チェック
				elseif($val == ''){
                  $res['errm'] .= "<p class=\"error_messe\">【".h($key)."】の項目が未入力です。</p>\n";
					$res['empty_flag'] = 1;
				}
				
				$existsFalg = 1;
				break;
			}
			
		}
		if($existsFalg != 1){
				$res['errm'] .= "<p class=\"error_messe\">【".$requireVal."】の項目が未入力です。</p>\n";
				$res['empty_flag'] = 1;
		}
	}
	
	return $res;
}
//リファラチェック
function refererCheck($Referer_check,$Referer_check_domain){
	if($Referer_check == 1 && !empty($Referer_check_domain)){
		if(strpos($_SERVER['HTTP_REFERER'],$Referer_check_domain) === false){
			return exit('<p align="center">リファラチェックエラー。フォームページのドメインとこのファイルのドメインが一致しません</p>');
		}
	}
}
function copyright(){
	echo '<a style="display:block;text-align:center;margin:15px 0;font-size:11px;color:#aaa;text-decoration:none" href="http://www.php-factory.net/" target="_blank">- PHP工房 -</a>';
}
//----------------------------------------------------------------------
//  関数定義(END)
//----------------------------------------------------------------------
?>