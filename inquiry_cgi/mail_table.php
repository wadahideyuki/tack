<?php header("Content-Type:text/html;charset=shift_jis"); ?>
<?php //error_reporting(E_ALL | E_STRICT);
##-----------------------------------------------------------------------------------------------------------------##
#
#  PHP���[���v���O�����@�t���[�� �ŏI�X�V��2018/07/27
#�@��������ς͎��ȐӔC�ōs���Ă��������B
#	
#  HP: http://www.php-factory.net/
#
#  �d�v�I�I�T�C�g�Ń`�F�b�N�{�b�N�X���g�p����ꍇ�݂̂ł����B�B�B
#  �`�F�b�N�{�b�N�X���g�p����ꍇ��input�^�O�ɋL�q����name�����̒l��K���z��̌`�ɂ��Ă��������B
#  ��@name="���T�C�g����������������[]"  �Ƃ��ĉ������B
#  name�̒l�̍Ō��[��]��t����B����Ȃ��ƕ����̒l���擾�ł��܂���I
#
##-----------------------------------------------------------------------------------------------------------------##
if (version_compare(PHP_VERSION, '5.1.0', '>=')) {//PHP5.1.0�ȏ�̏ꍇ�̂݃^�C���]�[�����`
	date_default_timezone_set('Asia/Tokyo');//�^�C���]�[���̐ݒ�i���{�ȊO�̏ꍇ�ɂ͓K�X�ݒ肭�������j
}
/*-------------------------------------------------------------------------------------------------------------------
* ���ȉ��ݒ莞�̒��ӓ_�@
* �E�l�i=�̌�j�͐����ȊO�̕�����i�ꕔ�������j�̓_�u���N�I�[�e�[�V�����u"�v�A�܂��́u'�v�ň͂�ł��܂��B
* �E��������O������폜�����肵�Ȃ��ł��������B���̃Z�~�R�����u;�v���폜���Ȃ����������B
* �E�܂��擪�Ɂu$�v���t����������͕ύX���Ȃ��ł��������B������1�܂���0�Őݒ肵�Ă�����͕̂K�����p�����Őݒ艺�����B
* �E���[���A�h���X��name�����̒l���uEmail�v�ł͂Ȃ��ꍇ�A�ȉ��K�{�ݒ�ӏ��́u$Email�v�̒l���ύX�������B
* �Ename�����̒l�ɔ��p�X�y�[�X�͎g�p�ł��܂���B
*�ȏ�̂��Ƃ��ԈႦ�Ă��܂��ƃv���O���������삵�Ȃ��Ȃ�܂��̂Œ��Ӊ������B
-------------------------------------------------------------------------------------------------------------------*/


//---------------------------�@�K�{�ݒ�@�K���ݒ肵�Ă��������@-----------------------

//�T�C�g�̃g�b�v�y�[�W��URL�@���f�t�H���g�ł͑��M������Ɂu�g�b�v�y�[�W�֖߂�v�{�^�����\������܂��̂�
$site_top = "http://tack-ic.jp/";

//�Ǘ��҂̃��[���A�h���X �����[�����󂯎�郁�[���A�h���X(�����w�肷��ꍇ�́u,�v�ŋ�؂��Ă������� �� $to = "aa@aa.aa,bb@bb.bb";)
$to = "info@tack-ic.jp";

//�����ԐM���[���̑��M�����[���A�h���X
//�K�����݂��郁�[���A�h���X�ł��o�������ݒu��T�C�g�̃h���C���Ɠ����h���C���̃��[���A�h���X�Ƃ��邱�Ƃ������������܂�
$from = "info@tack-ic.jp";

//�t�H�[���̃��[���A�h���X���͉ӏ���name�����̒l�iname="����"�@�́��������j
$Email = "Email";
//---------------------------�@�K�{�ݒ�@�����܂Ł@------------------------------------


//---------------------------�@�Z�L�����e�B�A�X�p���h�~�̂��߂̐ݒ�@------------------------------------

//�X�p���h�~�̂��߂̃��t�@���`�F�b�N�i�t�H�[�����Ƃ��̃t�@�C��������h���C���ł��邩�ǂ����̃`�F�b�N�j(����=1, ���Ȃ�=0)
//���L���ɂ���ɂ͂��̃t�@�C���ƃt�H�[���̃y�[�W������h���C�����ɂ���K�v������܂�
$Referer_check = 0;

//���t�@���`�F�b�N���u����v�ꍇ�̃h���C�� ���ݒu����T�C�g�̃h���C�����w�肵�ĉ������B
//�������̐ݒ肪�Ԉ���Ă���ꍇ�͑��M�e�X�g�ł����ɋC�t���܂��B
$Referer_check_domain = "php-factory.net";

/*�Z�b�V�����ɂ�郏���^�C���g�[�N���iCSRF�΍�A�y�уX�p���h�~�j(����=1, ���Ȃ�=0)
���������A���̋@�\���g���ꍇ�́��̑��M�m�F��ʂ̕\�����K�{�ł��B�i�f�t�H���g�ł�ON�i1�j�ɂȂ��Ă��܂��j
���y�d�v�z�K���P�[�͋@��ɂ���Ă̓N�b�L�[���g���Ȃ����߃K���P�[�̗��p���z�肵�Ă�ꍇ�́u0�v�iOFF�j�ɂ��ĉ������iPC�A�X�}�z�͖��Ȃ��ł��j*/
$useToken = 1;
//---------------------------�@�Z�L�����e�B�A�X�p���h�~�̂��߂̐ݒ�@�����܂Ł@------------------------------------


//---------------------- �C�Ӑݒ�@�ȉ��͕K�v�ɉ����Đݒ肵�Ă������� ------------------------


// �Ǘ��҈��̃��[���ō��o�l�𑗐M�҂̃��[���A�h���X�ɂ���(����=1, ���Ȃ�=0)
// ����ꍇ�́A���[�����͗���name�����̒l���u$Email�v�Ŏw�肵���l�ɂ��Ă��������B
//���[���[�ȂǂŕԐM����ꍇ�ɕ֗��Ȃ̂Łu����v���������߂ł��B
$userMail = 1;

// Bcc�ő��郁�[���A�h���X(�����w�肷��ꍇ�́u,�v�ŋ�؂��Ă������� �� $BccMail = "aa@aa.aa,bb@bb.bb";)
$BccMail = "";

// �Ǘ��҈��ɑ��M����郁�[���̃^�C�g���i�����j
$subject = "���₢���킹";

// ���M�m�F��ʂ̕\��(����=1, ���Ȃ�=0)
$confirmDsp = 1;

// ���M������Ɏ����I�Ɏw��̃y�[�W(�T���N�X�y�[�W�Ȃ�)�Ɉړ�����(����=1, ���Ȃ�=0)
// CV������͂������ꍇ�Ȃǂ̓T���N�X�y�[�W��ʓr�p�ӂ��AURL�����̉��̍��ڂŎw�肵�Ă��������B
// 0�ɂ���ƁA�f�t�H���g�̑��M������ʂ��\������܂��B
$jumpPage = 0;

// ���M������ɕ\������y�[�WURL�i��L��1��ݒ肵���ꍇ�̂݁j��http����n�܂�URL�Ŏw�肭�������B�i���΃p�X�ł���{�I�ɂ͖��Ȃ��ł��j
$thanksPage = "http://xxx.xxxxxxxxx/thanks.html";

// �K�{���͍��ڂ�ݒ肷��(����=1, ���Ȃ�=0)
$requireCheck = 1;

/* �K�{���͍���(���̓t�H�[���Ŏw�肵��name�����̒l���w�肵�Ă��������B�i��L��1��ݒ肵���ꍇ�̂݁j
�l�̓V���O���N�H�[�e�[�V�����ň͂݁A�����̏ꍇ�̓J���}�ŋ�؂��Ă��������B�t�H�[�����Ə��Ԃ����킹��Ɨǂ��ł��B 
�z��̌`�uname="����[]"�v�̏ꍇ�ɂ͕K������[]����������̂��w�肵�ĉ������B*/
$require = array('�����O','�t���K�i','��','�Z��','Email');


//----------------------------------------------------------------------
//  �����ԐM���[���ݒ�(START)
//----------------------------------------------------------------------

// ���o�l�ɑ��M���e�m�F���[���i�����ԐM���[���j�𑗂�(����=1, ����Ȃ�=0)
// ����ꍇ�́A�t�H�[�����̃��[�����͗���name�����̒l����L�u$Email�v�Ŏw�肵���l�Ɠ����ł���K�v������܂�
$remail = 1;

//�����ԐM���[���̑��M�җ��ɕ\������閼�O�@�����Ȃ��̖��O���Ж��Ȃǁi���������ԐM���[���̑��M�Җ���������������ꍇ�����͋�ɂ��Ă��������j
$refrom_name = "";

// ���o�l�ɑ��M�m�F���[���𑗂�ꍇ�̃��[���̃^�C�g���i��L��1��ݒ肵���ꍇ�̂݁j
$re_subject = "���M���肪�Ƃ��������܂���";

//�t�H�[�����́u���O�v�ӏ���name�����̒l�@�������ԐM���[���́u�����l�v�̕\���Ŏg�p���܂��B
//�w�肵�Ȃ��A�܂��͑��݂��Ȃ��ꍇ�́A�����l�ƕ\������Ȃ������ł��B�����Ė����ɂ��Ă�OK
$dsp_name = '�����O';

//�����ԐM���[���̖`���̕��� �����{�ꕔ���̂ݕύX��
$remail_text = <<< TEXT

���₢���킹�������ɂ��肪�Ƃ��������܂����B
�ȉ��̂悤�ɓ��e�����M����܂����̂ł��m�F���������܂��l���肢�\���グ�܂��B

TEXT;


//�����ԐM���[���ɏ����i�t�b�^�[�j��\��(����=1, ���Ȃ�=0)���Ǘ��҈��ɂ��\������܂��B
$mailFooterDsp = 1;

//��L�Łu1�v��I�����ɕ\�����鏐���i�t�b�^�[�j�iFOOTER�`FOOTER;�̊ԂɋL�q���Ă��������j
$mailSignature = <<< FOOTER

����������������������������������������������������������������������������������������
�J�[�y�b�g�E�֎q�\�t�@�N���[�j���O�Ȃ犔����Ѓ^�b�N�@
��130-0003�@�����s�n�c�扡��2-17-9�^�b�N�r��
Tel�F03-5819-0961�@Fax�F03-5819-0964
E-mail�Finfo@tack-ic.jp 
����������������������������������������������������������������������������������������

FOOTER;


//----------------------------------------------------------------------
//  �����ԐM���[���ݒ�(END)
//----------------------------------------------------------------------

//���[���A�h���X�̌`���`�F�b�N���s�����ǂ����B(����=1, ���Ȃ�=0)
//���f�t�H���g�́u����v�B���ɗ��R���Ȃ���ΕύX���Ȃ��ŉ������B���[�����͗���name�����̒l����L�u$Email�v�Ŏw�肵���l�ł���K�v������܂��B
$mail_check = 1;

//�S�p�p���������p�ϊ����s�����ǂ����B(����=1, ���Ȃ�=0)
$hankaku = 0;

//�S�p�p���������p�ϊ����s�����ڂ�name�����̒l�iname="����"�́u�����v�����j
//�������̏ꍇ�ɂ̓J���}�ŋ�؂��ĉ������B�i��L�Łu1�v���w�肵���ꍇ�̂ݗL���j
//�z��̌`�uname="����[]"�v�̏ꍇ�ɂ͕K������[]����������̂��w�肵�ĉ������B
$hankaku_array = array('�d�b�ԍ�','���z');

//-f�I�v�V�����ɂ��G���x���[�vFrom�iReturn-Path�j�̐ݒ�(����=1, ���Ȃ�=0)�@
//������s���i�ԈႢ�Ȃǂő��݂��Ȃ��A�h���X�j�̏ꍇ�� �Ǘ��҈��ɁuMail Delivery System�v����uUndelivered Mail Returned to Sender�v�Ƃ������[�����͂��܂��B
//�T�[�o�[�ɂ���Ă͋H�ɂ��̐ݒ肪�K�{�̏ꍇ������܂��B
//�ݒu�T�[�o�[��PHP���Z�[�t���[�h�œ��삵�Ă���ꍇ�͎g�p�ł��܂���̂ő��M���ɃG���[���o���胁�[�����͂��Ȃ��ꍇ�́u0�v�iOFF�j�Ƃ��ĉ������B
$use_envelope = 0;

//�@��ˑ������̕ϊ�
/*���Ƃ��·��i���������j��@�i��1�j�A���̑�����ȋL�������Ȋ����Ȃǂ͕ϊ��ł����Ɂu�H�v�ƕ\������܂��B�����������邽�߂̋@�\�ł��B
�m�F��ʕ\�����ɒu����������܂��B�u�ϊ��O�̕����v���u�ϊ���̕����v�ɕϊ�����A���M���[�����ł��ϊ����ꂽ��Ԃő��M����܂��B�i���Ƃ��΁u���v�̏ꍇ�A�u�i���j�v�ɕϊ�����܂��j 
�K�v�ɉ����Ď��R�ɒǉ����ĉ������B�������A�ϊ��O�̕����ƕϊ���̕����̏��ԂƐ��͕K�����킹��K�v������܂��̂ł����Ӊ������B*/

//�ϊ��O�̕���
$replaceStr['before'] = array();//Shift_JIS�ł̏ꍇ�͋@��ˑ��������g���邽�ߖ���
//�ϊ���̕���
$replaceStr['after'] = array();//Shift_JIS�ł̏ꍇ�͋@��ˑ��������g���邽�ߖ���

//------------------------------- �C�Ӑݒ肱���܂� ---------------------------------------------


// �ȉ��̕ύX�͒m���̂�����̂ݎ��ȐӔC�ł��肢���܂��B

//----------------------------------------------------------------------
//  �֐����s�A�ϐ�������
//----------------------------------------------------------------------
//�g�[�N���`�F�b�N�p�̃Z�b�V�����X�^�[�g
if($useToken == 1 && $confirmDsp == 1){
	session_name('PHPMAILFORMSYSTEM');
	session_start();
}
$encode = "SJIS";//���̃t�@�C���̕����R�[�h��`�i�ύX�s�j
if(isset($_GET)) $_GET = sanitize($_GET);//NULL�o�C�g����//
if(isset($_POST)) $_POST = sanitize($_POST);//NULL�o�C�g����//
if(isset($_COOKIE)) $_COOKIE = sanitize($_COOKIE);//NULL�o�C�g����//
if($encode == 'SJIS') $_POST = sjisReplace($_POST,$encode);//Shift-JIS�̏ꍇ�Ɍ�ϊ������̒u�����s
$funcRefererCheck = refererCheck($Referer_check,$Referer_check_domain);//���t�@���`�F�b�N���s

//�ϐ�������
$sendmail = 0;
$empty_flag = 0;
$post_mail = '';
$errm ='';
$header ='';

if($requireCheck == 1) {
	$requireResArray = requireCheck($require);//�K�{�`�F�b�N���s���Ԃ�l���󂯎��
	$errm = $requireResArray['errm'];
	$empty_flag = $requireResArray['empty_flag'];
}
//���[���A�h���X�`�F�b�N
if(empty($errm)){
	foreach($_POST as $key=>$val) {
		if($val == "confirm_submit") $sendmail = 1;
		if($key == $Email) $post_mail = h($val);
		if($key == $Email && $mail_check == 1 && !empty($val)){
			if(!checkMail($val)){
				$errm .= "<p class=\"error_messe\">�y".$key."�z�̓��[���A�h���X�̌`��������������܂���B</p>\n";
				$empty_flag = 1;
			}
		}
	}
}
  
if(($confirmDsp == 0 || $sendmail == 1) && $empty_flag != 1){
	
	//�g�[�N���`�F�b�N�iCSRF�΍�j���m�F��ʂ�ON�̏ꍇ�̂ݎ��{
	if($useToken == 1 && $confirmDsp == 1){
		if(empty($_SESSION['mailform_token']) || ($_SESSION['mailform_token'] !== $_POST['mailform_token'])){
			exit('�y�[�W�J�ڂ��s���ł�');
		}
		if(isset($_SESSION['mailform_token'])) unset($_SESSION['mailform_token']);//�g�[�N���j��
		if(isset($_POST['mailform_token'])) unset($_POST['mailform_token']);//�g�[�N���j��
	}
	
	//���o�l�ɓ͂����[�����Z�b�g
	if($remail == 1) {
		$userBody = mailToUser($_POST,$dsp_name,$remail_text,$mailFooterDsp,$mailSignature,$encode);
		$reheader = userHeader($refrom_name,$from,$encode);
		$re_subject = "=?iso-2022-jp?B?".base64_encode(mb_convert_encoding($re_subject,"JIS",$encode))."?=";
	}
	//�Ǘ��҈��ɓ͂����[�����Z�b�g
	$adminBody = mailToAdmin($_POST,$subject,$mailFooterDsp,$mailSignature,$encode,$confirmDsp);
	$header = adminHeader($userMail,$post_mail,$BccMail,$to);
	$subject = "=?iso-2022-jp?B?".base64_encode(mb_convert_encoding($subject,"JIS",$encode))."?=";
	
	//-f�I�v�V�����ɂ��G���x���[�vFrom�iReturn-Path�j�̐ݒ�(safe_mode��OFF�̏ꍇ����L�ݒ肪ON�̏ꍇ�̂ݎ��{)
	if($use_envelope == 0){
		mail($to,$subject,$adminBody,$header);
		if($remail == 1 && !empty($post_mail)) mail($post_mail,$re_subject,$userBody,$reheader);
	}else{
		mail($to,$subject,$adminBody,$header,'-f'.$from);
		if($remail == 1 && !empty($post_mail)) mail($post_mail,$re_subject,$userBody,$reheader,'-f'.$from);
	}
}
else if($confirmDsp == 1){ 

/*�@���������M�m�F��ʂ̃��C�A�E�g���ҏW�@�I���W�i���̃f�U�C�����K�p�\�������@*/
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift_jis">
    <title>�֎q��\�t�@�[�N���[�j���O�̂��⍇���E�����ς�</title>
    <meta name="keywords" content="�֎q,�\�t�@�[,�N���[�j���O,���⍇��,������,���i,�d�b,�C���^�[�l�b�g">
    <meta name="description" content="�֎q��\�t�@�[�̃N���[�j���O�̂����ς�͂�����B���C�y�ɂ��₢���킹��������">
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
        <p class="summary">�֎q��\�t�@�[�̃N���[�j���O�� �^�b�N�ɂ��C���������I</p>
        <a href="http://www.tack-ic.jp/"><img src="http://www.tack-ic.jp/common/img/logo.jpg" alt="�֎q�E�\�t�@�[�N���[�j���O�̃^�b�N" width="176" height="94"></a>
        <img src="http://www.tack-ic.jp/common/img/head_tel.jpg" alt="TEL03-5819-0961" width="420" height="46" class="tel">
        <ul id="navi">
          <li class="feature"><a href="http://www.tack-ic.jp/point/point1/">Tack�̓���</a></li>
          <li class="service"><a href="http://www.tack-ic.jp/service/">�T�[�r�X�ꗗ</a></li>
          <li class="flow"><a href="http://www.tack-ic.jp/info/flow.html">���d���̗���</a></li>
          <li class="voice"><a href="http://www.tack-ic.jp/voice/voice1/">���q�l�̐�</a></li>
          <li class="qa"><a href="http://www.tack-ic.jp/info/faq.html">�悭���鎿��</a></li>
          <li class="company"><a href="http://www.tack-ic.jp/info/company.html">��ЊT�v</a></li>
        </ul>
      </div>
      <!--//head-->

      <!--PNKZ-->
      <div id="pankuz"><a href="http://www.tack-ic.jp/">�֎q��\�t�@�[�̃N���[�j���O�̓^�b�N HOME</a> >���₢���킹�E�����ς�</div>
      <!--//PNKZ-->
      <div id="contentWrap" class="clearfix">


        <!--sideNavi-->

        <div id="sideNavi">
          <div class="sideBox">
            <h2 class="sMenu"><img src="http://www.tack-ic.jp/common/img/side_ttl_01.png" width="108" height="38"></h2>
            <ul>
              <li class="chair"><a href="http://www.tack-ic.jp/service/chair/">�֎q�N���[�j���O</a>
                <span class="second">��<a href="http://www.tack-ic.jp/service/chair/flow.html">�֎q�N���[�j���O��Ƃ̗���</a></span>
                <span class="second">��<a href="http://www.tack-ic.jp/service/chair/ex.html">�֎q�N���[�j���O�{�H����</a></span>
              </li>
              <li class="sofa"><a href="http://www.tack-ic.jp/service/sofa/"> �\�t�@�[�N���[�j���O</a></li>
              <li class="carpet"><a href="http://www.tack-ic.jp/service/carpet/"> �J�[�y�b�g�N���[�j���O</a></li>
              <li class="braind"><a href="http://www.tack-ic.jp/service/braind/"> �u���C���h�N���[�j���O</a></li>
              <li class="air"><a href="http://www.tack-ic.jp/service/air/"> �G�A�R���N���[�j���O</a></li>
              <li class="other"><a href="http://www.tack-ic.jp/service/other/"> ���̑��N���[�j���O</a></li>
              <li class="re_chair"><a href="http://www.tack-ic.jp/service/re_chair/"> �֎q�\�t�@�[���ւ�</a>
                <span class="second">��<a href="http://www.tack-ic.jp/service/re_chair/flow.html">�֎q���ւ��˗��t���[</a></span>
                <span class="second">��<a href="http://www.tack-ic.jp/service/re_chair/ex.html">�֎q�\�t�@�[���ւ��{�H����</a></span></li>
              <li class="re_carpet"><a href="http://www.tack-ic.jp/service/re_carpet/">�J�[�y�b�g�Đ��F�T�[�r�X</a></li>
            </ul>
          </div>
          <div class="sideBox sideBox2">
            <h2 class="sArea"><img src="http://www.tack-ic.jp/common/img/side_ttl_02.png" width="87" height="18"></h2>
            <img src="http://www.tack-ic.jp/common/img/side_img.png" width="195" height="97">
            <p>�^�b�N�ł͓����A��ʁA��t�A�_�ސ�̂P�s3���𒆐S�ɃT�[�r�X��񋟂����Ē����Ă��܂��B���n�ɂ��f�����č�Ƃ�����p�^�[���A�֎q�\�t�@�[�������A���č�Ƃ�����p�^�[���̗����ɑΉ����Ă���܂��B</p>
            <div class="sideBtn"><a href="http://www.tack-ic.jp/info/inquiry.html"><img src="http://www.tack-ic.jp/common/img/side_btn.png" width="174" height="45" class="hover"></a></div>
          </div>
        </div>	
        <!--//sideNavi-->

        <!--contentsInner-->
        <div id="contents">
          <div id="contentsInner">






            <!--//content-->
<!-- �� Header�₻�̑��R���e���c�Ȃǁ@�����R�ɕҏW�� ��-->

<!-- ��************ ���M���e�\�����@���ҏW�͎��ȐӔC�� ************ ��-->
<div id="formWrap">
<?php if($empty_flag == 1){ ?>
<div align="center">
  <h1>���₢���킹�G���[</h1>
  <p>�ȉ��̃G���[���������܂����B �m�F�̏�ē��͂��Ă��������B</p>
<?php echo $errm; ?><br /><br /><input type="button" value=" �O��ʂɖ߂� " onClick="history.back()">
</div>
<?php }else{ ?>
  <h1>��Ɠ��e�≿�i�ɂ��Ă͂��C�y�ɂ��⍇����������</h1>
  <p>�ȉ��̍��ڂɊԈႢ���Ȃ���΁A���M�{�^���������Ă��������B<br><br></p>
  <div class="alignC">
<form action="<?php echo h($_SERVER['SCRIPT_NAME']); ?>" method="POST">
  <table class="mail-form">
<?php echo confirmOutput($_POST);//���͓��e��\��?>
</table>
<p align="center"><input type="hidden" name="mail_set" value="confirm_submit">
<input type="hidden" name="httpReferer" value="<?php echo h($_SERVER['HTTP_REFERER']);?>">
  <input type="submit" value="  ��  �M�@">
  <input type="button" value="  ��  ��  " onClick="history.back()"></p>
</form>
  </div>
<?php } ?>
</div><!-- /formWrap -->
<!-- �� *********** ���M���e�m�F���@���ҏW�͎��ȐӔC�� ************ ��-->

<!-- �� Footer���̑��R���e���c�Ȃǁ@���ҏW�� ��-->
          </div></div></div>	
      <!--contact-->	
    </div>	
    <!-- ���t�b�^ -->	
    <div id="footer">	
      <div class="footInner">	
        <p>�J�[�y�b�g�E�֎q�\�t�@�[�N���[�j���O�Ȃ犔����Ѓ^�b�N ��130-0003�@�����s�n�c�扡��2-17-9 �^�b�N�r�� �@E-mail�F<a href="mailto:info@tack-ic.jp" style="color:#FFF;">info@tack-ic.jp</a></p>	
      </div>	
    </div>	
    <div id="sitemap">	
      <div id="sitemapInner" class="clearfix" style="position:relative;">	
        <ul class="ttl">	
          <li class="PB10"><img src="http://www.tack-ic.jp/common/img/foot_logo.gif" width="126" height="71"></li>	
          <li><a href="http://www.tack-ic.jp/" class="cate">�֎q��\�t�@�[�̃N���[�j���O�̓^�b�NHOME</a></li>	
        </ul>	
        <ul>	
          <li><a href="http://www.tack-ic.jp/service/" class="cate">�T�[�r�X�ꗗ</a></li>	
          <li><a href="http://www.tack-ic.jp/service/chair/" >�֎q�N���[�j���O</a></li>	
          <li><a href="http://www.tack-ic.jp/service/sofa/" >�\�t�@�[�N���[�j���O</a></li>	
          <li><a href="http://www.tack-ic.jp/service/carpet/" >�J�[�y�b�g�N���[�j���O</a></li>	
          <li><a href="http://www.tack-ic.jp/service/air/" >�G�A�R���N���[�j���O</a></li>	
          <li><a href="http://www.tack-ic.jp/service/braind/" >�u���C���h�N���[�j���O</a></li>	
          <li><a href="http://www.tack-ic.jp/service/other/" >���̑��N���[�j���O</a></li>	
          <li><a href="http://www.tack-ic.jp/service/re_chair/" >�֎q�E�\�t�@�[���ւ�</a></li>	
          <li><a href="http://www.tack-ic.jp/service/re_carpet/" >�J�[�y�b�g�Đ��F�T�[�r�X</a></li>	
        </ul>	
        <ul>	
          <li><a href="http://www.tack-ic.jp/point/point1/" class="cate">Tack�̓���</a></li>	
          <li><a href="http://www.tack-ic.jp/point/point1/" >�֎q�\�t�@�[�N���[�j���O�̐���</a></li>	
          <li><a href="http://www.tack-ic.jp/point/point2/" >��܂ƍŐV�}�V��</a></li>	
          <li class="PB15"><a href="http://www.tack-ic.jp/point/point3/" >���i</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice1/" class="cate">���q�l�̐�</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice1/" >�G���Z����</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice2/" >�����E�g���X�g</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice3/" >���X�g����TR</a></li>	
        </ul>	
        <ul class="lineH">	
          <li><a href="http://www.tack-ic.jp/info/inquiry.html" class="cate">���₢���킹�E�����ς�</a></li>	
          <li><a href="http://www.tack-ic.jp/info/flow.html" class="cate">�����p�̗���</a></li>	
          <li><a href="http://www.tack-ic.jp/info/faq.html" class="cate">�悭���鎿��</a></li>	
          <li><a href="http://www.tack-ic.jp/info/demo.html" class="cate">�����֎q�N���[�j���O�f��</a></li>	
          <li><a href="http://www.tack-ic.jp/info/advice.html" class="cate">���|���A�h�o�C�X</a></li>	
        </ul>	
        <ul class="lineH">	
          <li><a href="http://www.tack-ic.jp/info/company.html" class="cate">��ЊT�v</a></li>	
          <li><a href="http://www.tack-ic.jp/info/access.html" class="cate">�A�N�Z�X�}�b�v</a></li>	
          <li><a href="http://www.tack-ic.jp/info/link.html" class="cate">	�����N�ɂ���</a></li>	
          <li><a href="http://www.tack-ic.jp/info/privacy.html" class="cate"> �v���C�o�V�[�|���V�[</a></li>	
          <li><a href="http://www.tack-ic.jp/info/sitemap.html" class="cate">�T�C�g�}�b�v</a></li>	
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
/* ���������M�m�F��ʂ̃��C�A�E�g�@���I���W�i���̃f�U�C�����K�p�\�������@*/
}

if(($jumpPage == 0 && $sendmail == 1) || ($jumpPage == 0 && ($confirmDsp == 0 && $sendmail == 0))) { 

/* ���������M������ʂ̃��C�A�E�g�@�ҏW�� �����M������Ɏw��̃y�[�W�Ɉړ����Ȃ��ꍇ�̂ݕ\���������@*/
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift_jis">
    <title>�֎q��\�t�@�[�N���[�j���O�̂��⍇���E�����ς�</title>
    <meta name="keywords" content="�֎q,�\�t�@�[,�N���[�j���O,���⍇��,������,���i,�d�b,�C���^�[�l�b�g">
    <meta name="description" content="�֎q��\�t�@�[�̃N���[�j���O�̂����ς�͂�����B���C�y�ɂ��₢���킹��������">
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
        <p class="summary">�֎q��\�t�@�[�̃N���[�j���O�� �^�b�N�ɂ��C���������I</p>
        <a href="http://www.tack-ic.jp/"><img src="http://www.tack-ic.jp/common/img/logo.jpg" alt="�֎q�E�\�t�@�[�N���[�j���O�̃^�b�N" width="176" height="94"></a>
        <img src="http://www.tack-ic.jp/common/img/head_tel.jpg" alt="TEL03-5819-0961" width="420" height="46" class="tel">
        <ul id="navi">
          <li class="feature"><a href="http://www.tack-ic.jp/point/point1/">Tack�̓���</a></li>
          <li class="service"><a href="http://www.tack-ic.jp/service/">�T�[�r�X�ꗗ</a></li>
          <li class="flow"><a href="http://www.tack-ic.jp/info/flow.html">���d���̗���</a></li>
          <li class="voice"><a href="http://www.tack-ic.jp/voice/voice1/">���q�l�̐�</a></li>
          <li class="qa"><a href="http://www.tack-ic.jp/info/faq.html">�悭���鎿��</a></li>
          <li class="company"><a href="http://www.tack-ic.jp/info/company.html">��ЊT�v</a></li>
        </ul>
      </div>
      <!--//head-->

      <!--PNKZ-->
      <div id="pankuz"><a href="http://www.tack-ic.jp/">�֎q��\�t�@�[�̃N���[�j���O�̓^�b�N HOME</a> >���₢���킹�E�����ς�</div>
      <!--//PNKZ-->
      <div id="contentWrap" class="clearfix">


        <!--sideNavi-->

        <div id="sideNavi">
          <div class="sideBox">
            <h2 class="sMenu"><img src="http://www.tack-ic.jp/common/img/side_ttl_01.png" width="108" height="38"></h2>
            <ul>
              <li class="chair"><a href="http://www.tack-ic.jp/service/chair/">�֎q�N���[�j���O</a>
                <span class="second">��<a href="http://www.tack-ic.jp/service/chair/flow.html">�֎q�N���[�j���O��Ƃ̗���</a></span>
                <span class="second">��<a href="http://www.tack-ic.jp/service/chair/ex.html">�֎q�N���[�j���O�{�H����</a></span>
              </li>
              <li class="sofa"><a href="http://www.tack-ic.jp/service/sofa/"> �\�t�@�[�N���[�j���O</a></li>
              <li class="carpet"><a href="http://www.tack-ic.jp/service/carpet/"> �J�[�y�b�g�N���[�j���O</a></li>
              <li class="braind"><a href="http://www.tack-ic.jp/service/braind/"> �u���C���h�N���[�j���O</a></li>
              <li class="air"><a href="http://www.tack-ic.jp/service/air/"> �G�A�R���N���[�j���O</a></li>
              <li class="other"><a href="http://www.tack-ic.jp/service/other/"> ���̑��N���[�j���O</a></li>
              <li class="re_chair"><a href="http://www.tack-ic.jp/service/re_chair/"> �֎q�\�t�@�[���ւ�</a>
                <span class="second">��<a href="http://www.tack-ic.jp/service/re_chair/flow.html">�֎q���ւ��˗��t���[</a></span>
                <span class="second">��<a href="http://www.tack-ic.jp/service/re_chair/ex.html">�֎q�\�t�@�[���ւ��{�H����</a></span></li>
              <li class="re_carpet"><a href="http://www.tack-ic.jp/service/re_carpet/">�J�[�y�b�g�Đ��F�T�[�r�X</a></li>
            </ul>
          </div>
          <div class="sideBox sideBox2">
            <h2 class="sArea"><img src="http://www.tack-ic.jp/common/img/side_ttl_02.png" width="87" height="18"></h2>
            <img src="http://www.tack-ic.jp/common/img/side_img.png" width="195" height="97">
            <p>�^�b�N�ł͓����A��ʁA��t�A�_�ސ�̂P�s3���𒆐S�ɃT�[�r�X��񋟂����Ē����Ă��܂��B���n�ɂ��f�����č�Ƃ�����p�^�[���A�֎q�\�t�@�[�������A���č�Ƃ�����p�^�[���̗����ɑΉ����Ă���܂��B</p>
            <div class="sideBtn"><a href="http://www.tack-ic.jp/info/inquiry.html"><img src="http://www.tack-ic.jp/common/img/side_btn.png" width="174" height="45" class="hover"></a></div>
          </div>
        </div>	
        <!--//sideNavi-->

        <!--contentsInner-->
        <div id="contents">
          <div id="contentsInner">






            <!--//content-->
<!-- �� Header�₻�̑��R���e���c�Ȃǁ@�����R�ɕҏW�� ��-->

<?php if($empty_flag == 1){ ?>
  <h1>�ȉ��̃G���[���������܂����B �m�F�̏�ē��͂��Ă��������B�B</h1>
<div style="color:red"><?php echo $errm; ?></div>
<br /><br /><input type="button" value=" �O��ʂɖ߂� " onClick="history.back()">
</div>
</body>
</html>
<?php }else{ ?>
<p style="text-align:center">���M���肪�Ƃ��������܂����B<br />
���M�͐���Ɋ������܂����B<br /><br /></p>

<p style="text-align:center"><a href="<?php echo $site_top ;?>">�g�b�v�y�[�W�֖߂�&raquo;</a></p>

<!-- �� Footer���̑��R���e���c�Ȃǁ@���ҏW�� ��-->
          </div></div></div>	
      <!--contact-->	
    </div>	
    <!-- ���t�b�^ -->	
    <div id="footer">	
      <div class="footInner">	
        <p>�J�[�y�b�g�E�֎q�\�t�@�[�N���[�j���O�Ȃ犔����Ѓ^�b�N ��130-0003�@�����s�n�c�扡��2-17-9 �^�b�N�r�� �@E-mail�F<a href="mailto:info@tack-ic.jp" style="color:#FFF;">info@tack-ic.jp</a></p>	
      </div>	
    </div>	
    <div id="sitemap">	
      <div id="sitemapInner" class="clearfix" style="position:relative;">	
        <ul class="ttl">	
          <li class="PB10"><img src="http://www.tack-ic.jp/common/img/foot_logo.gif" width="126" height="71"></li>	
          <li><a href="http://www.tack-ic.jp/" class="cate">�֎q��\�t�@�[�̃N���[�j���O�̓^�b�NHOME</a></li>	
        </ul>	
        <ul>	
          <li><a href="http://www.tack-ic.jp/service/" class="cate">�T�[�r�X�ꗗ</a></li>	
          <li><a href="http://www.tack-ic.jp/service/chair/" >�֎q�N���[�j���O</a></li>	
          <li><a href="http://www.tack-ic.jp/service/sofa/" >�\�t�@�[�N���[�j���O</a></li>	
          <li><a href="http://www.tack-ic.jp/service/carpet/" >�J�[�y�b�g�N���[�j���O</a></li>	
          <li><a href="http://www.tack-ic.jp/service/air/" >�G�A�R���N���[�j���O</a></li>	
          <li><a href="http://www.tack-ic.jp/service/braind/" >�u���C���h�N���[�j���O</a></li>	
          <li><a href="http://www.tack-ic.jp/service/other/" >���̑��N���[�j���O</a></li>	
          <li><a href="http://www.tack-ic.jp/service/re_chair/" >�֎q�E�\�t�@�[���ւ�</a></li>	
          <li><a href="http://www.tack-ic.jp/service/re_carpet/" >�J�[�y�b�g�Đ��F�T�[�r�X</a></li>	
        </ul>	
        <ul>	
          <li><a href="http://www.tack-ic.jp/point/point1/" class="cate">Tack�̓���</a></li>	
          <li><a href="http://www.tack-ic.jp/point/point1/" >�֎q�\�t�@�[�N���[�j���O�̐���</a></li>	
          <li><a href="http://www.tack-ic.jp/point/point2/" >��܂ƍŐV�}�V��</a></li>	
          <li class="PB15"><a href="http://www.tack-ic.jp/point/point3/" >���i</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice1/" class="cate">���q�l�̐�</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice1/" >�G���Z����</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice2/" >�����E�g���X�g</a></li>	
          <li><a href="http://www.tack-ic.jp/voice/voice3/" >���X�g����TR</a></li>	
        </ul>	
        <ul class="lineH">	
          <li><a href="http://www.tack-ic.jp/info/inquiry.html" class="cate">���₢���킹�E�����ς�</a></li>	
          <li><a href="http://www.tack-ic.jp/info/flow.html" class="cate">�����p�̗���</a></li>	
          <li><a href="http://www.tack-ic.jp/info/faq.html" class="cate">�悭���鎿��</a></li>	
          <li><a href="http://www.tack-ic.jp/info/demo.html" class="cate">�����֎q�N���[�j���O�f��</a></li>	
          <li><a href="http://www.tack-ic.jp/info/advice.html" class="cate">���|���A�h�o�C�X</a></li>	
        </ul>	
        <ul class="lineH">	
          <li><a href="http://www.tack-ic.jp/info/company.html" class="cate">��ЊT�v</a></li>	
          <li><a href="http://www.tack-ic.jp/info/access.html" class="cate">�A�N�Z�X�}�b�v</a></li>	
          <li><a href="http://www.tack-ic.jp/info/link.html" class="cate">	�����N�ɂ���</a></li>	
          <li><a href="http://www.tack-ic.jp/info/privacy.html" class="cate"> �v���C�o�V�[�|���V�[</a></li>	
          <li><a href="http://www.tack-ic.jp/info/sitemap.html" class="cate">�T�C�g�}�b�v</a></li>	
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
/* ���������M������ʂ̃��C�A�E�g �ҏW�� �����M������Ɏw��̃y�[�W�Ɉړ����Ȃ��ꍇ�̂ݕ\���������@*/
  }
}
//�m�F��ʖ����̏ꍇ�̕\���A�w��̃y�[�W�Ɉړ�����ݒ�̏ꍇ�A�G���[�`�F�b�N�Ŗ�肪������Ύw��y�[�W�w���_�C���N�g
else if(($jumpPage == 1 && $sendmail == 1) || $confirmDsp == 0) { 
	if($empty_flag == 1){ ?>
<div align="center"><h4>���͂ɃG���[������܂��B���L�����m�F�̏�u�߂�v�{�^���ɂďC�������肢�v���܂��B</h4><div style="color:red"><?php echo $errm; ?></div><br /><br /><input type="button" value=" �O��ʂɖ߂� " onClick="history.back()"></div>
<?php 
	}else{ header("Location: ".$thanksPage); }
}

// �ȉ��̕ύX�͒m���̂�����̂ݎ��ȐӔC�ł��肢���܂��B

//----------------------------------------------------------------------
//  �֐���`(START)
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
//Shift-JIS�̏ꍇ�Ɍ�ϊ������̒u���֐�
function sjisReplace($arr,$encode){
	foreach($arr as $key => $val){
		$key = str_replace('�_','�[',$key);
		$resArray[$key] = $val;
	}
	return $resArray;
}
//���M���[����POST�f�[�^���Z�b�g����֐�
function postToMail($arr){
	global $hankaku,$hankaku_array;
	$resArray = '';
	foreach($arr as $key => $val) {
		$out = '';
		if(is_array($val)){
			foreach($val as $key02 => $item){ 
				//�A�����ڂ̏���
				if(is_array($item)){
					$out .= connect2val($item);
				}else{
					$out .= $item . ', ';
				}
			}
			$out = rtrim($out,', ');
			
		}else{ $out = $val; }//�`�F�b�N�{�b�N�X�i�z��j�ǋL�����܂�
		if(get_magic_quotes_gpc()) { $out = stripslashes($out); }
		
		//�S�p�����p�ϊ�
		if($hankaku == 1){
			$out = zenkaku2hankaku($key,$out,$hankaku_array);
		}
		if($out != "confirm_submit" && $key != "httpReferer") {
			$resArray .= "�y ".h($key)." �z ".h($out)."\n";
		}
	}
	return $resArray;
}
//�m�F��ʂ̓��͓��e�o�͗p�֐�
function confirmOutput($arr){
	global $hankaku,$hankaku_array,$useToken,$confirmDsp,$replaceStr;
	$html = '';
	foreach($arr as $key => $val) {
		$out = '';
		if(is_array($val)){
			foreach($val as $key02 => $item){ 
				//�A�����ڂ̏���
				if(is_array($item)){
					$out .= connect2val($item);
				}else{
					$out .= $item . ', ';
				}
			}
			$out = rtrim($out,', ');
			
		}else{ $out = $val; }//�`�F�b�N�{�b�N�X�i�z��j�ǋL�����܂�
		if(get_magic_quotes_gpc()) { $out = stripslashes($out); }
		$out = nl2br(h($out));//���ǋL ���s�R�[�h��<br>�^�O�ɕϊ�
		$key = h($key);
		$out = str_replace($replaceStr['before'], $replaceStr['after'], $out);//�@��ˑ������̒u������
		
		//�S�p�����p�ϊ�
		if($hankaku == 1){
			$out = zenkaku2hankaku($key,$out,$hankaku_array);
		}
		
		$html .= "<tr><th>".$key."</th><td>".$out;
		$html .= '<input type="hidden" name="'.$key.'" value="'.str_replace(array("<br />","<br>"),"",$out).'" />';
		$html .= "</td></tr>\n";
	}
	//�g�[�N�����Z�b�g
	if($useToken == 1 && $confirmDsp == 1){
		$token = sha1(uniqid(mt_rand(), true));
		$_SESSION['mailform_token'] = $token;
		$html .= '<input type="hidden" name="mailform_token" value="'.$token.'" />';
	}
	
	return $html;
}

//�S�p�����p�ϊ�
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
//�z��A���̏���
function connect2val($arr){
	$out = '';
	foreach($arr as $key => $val){
		if($key === 0 || $val == ''){//�z�񂪖��L���i0�j�A�܂��͓��e����̂̏ꍇ�ɂ͘A��������t�����Ȃ��i�^�܂Œ��ׂ�K�v����j
			$key = '';
		}elseif(strpos($key,"�~") !== false && $val != '' && preg_match("/^[0-9]+$/",$val)){
			$val = number_format($val);//���z�̏ꍇ�ɂ�3�����ƂɃJ���}��ǉ�
		}
		$out .= $val . $key;
	}
	return $out;
}

//�Ǘ��҈����M���[���w�b�_
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
//�Ǘ��҈����M���[���{�f�B
function mailToAdmin($arr,$subject,$mailFooterDsp,$mailSignature,$encode,$confirmDsp){
  $adminBody="���L�̓��e�ł��₢���킹������܂����B\n\n";
	$adminBody .="������������������������������������������������������\n\n";
	$adminBody.= postToMail($arr);//POST�f�[�^���֐�����Z�b�g
	$adminBody.="\n������������������������������������������������������\n";
	$adminBody.="���M���ꂽ�����F".date( "Y/m/d (D) H:i:s", time() )."\n";
	$adminBody.="���M�҂�IP�A�h���X�F".@$_SERVER["REMOTE_ADDR"]."\n";
	$adminBody.="���M�҂̃z�X�g���F".getHostByAddr(getenv('REMOTE_ADDR'))."\n";
	if($confirmDsp != 1){
		$adminBody.="�₢���킹�̃y�[�WURL�F".@$_SERVER['HTTP_REFERER']."\n";
	}else{
		$adminBody.="�₢���킹�̃y�[�WURL�F".@$arr['httpReferer']."\n";
	}
	if($mailFooterDsp == 1) $adminBody.= $mailSignature;
	return mb_convert_encoding($adminBody,"JIS",$encode);
}

//���[�U�����M���[���w�b�_
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
//���[�U�����M���[���{�f�B
function mailToUser($arr,$dsp_name,$remail_text,$mailFooterDsp,$mailSignature,$encode){
	$userBody = '';
	if(isset($arr[$dsp_name])) $userBody = h($arr[$dsp_name]). " �l\n";
	$userBody.= $remail_text;
	$userBody.="\n������������������������������������������������������\n\n";
	$userBody.= postToMail($arr);//POST�f�[�^���֐�����Z�b�g
	$userBody.="\n������������������������������������������������������\n\n";
	$userBody.="���M�����F".date( "Y/m/d (D) H:i:s", time() )."\n";
	if($mailFooterDsp == 1) $userBody.= $mailSignature;
	return mb_convert_encoding($userBody,"JIS",$encode);
}
//�K�{�`�F�b�N�֐�
function requireCheck($require){
	$res['errm'] = '';
	$res['empty_flag'] = 0;
	foreach($require as $requireVal){
		$existsFalg = '';
		foreach($_POST as $key => $val) {
			if($key == $requireVal) {
				
				//�A���w��̍��ځi�z��j�̂��߂̕K�{�`�F�b�N
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
                      $res['errm'] .= "<p class=\"error_messe\">�y".h($key)."�z�̍��ڂ������͂ł��B</p>\n";
						$res['empty_flag'] = 1;
					}
				}
				//�f�t�H���g�K�{�`�F�b�N
				elseif($val == ''){
                  $res['errm'] .= "<p class=\"error_messe\">�y".h($key)."�z�̍��ڂ������͂ł��B</p>\n";
					$res['empty_flag'] = 1;
				}
				
				$existsFalg = 1;
				break;
			}
			
		}
		if($existsFalg != 1){
				$res['errm'] .= "<p class=\"error_messe\">�y".$requireVal."�z�̍��ڂ������͂ł��B</p>\n";
				$res['empty_flag'] = 1;
		}
	}
	
	return $res;
}
//���t�@���`�F�b�N
function refererCheck($Referer_check,$Referer_check_domain){
	if($Referer_check == 1 && !empty($Referer_check_domain)){
		if(strpos($_SERVER['HTTP_REFERER'],$Referer_check_domain) === false){
			return exit('<p align="center">���t�@���`�F�b�N�G���[�B�t�H�[���y�[�W�̃h���C���Ƃ��̃t�@�C���̃h���C������v���܂���</p>');
		}
	}
}
function copyright(){
	echo '<a style="display:block;text-align:center;margin:15px 0;font-size:11px;color:#aaa;text-decoration:none" href="http://www.php-factory.net/" target="_blank">- PHP�H�[ -</a>';
}
//----------------------------------------------------------------------
//  �֐���`(END)
//----------------------------------------------------------------------
?>