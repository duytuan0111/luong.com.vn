<?
require_once('../functions/functions.php');
ob_start();
require_once("../functions/function_rewrite.php");
require_once("../functions/array_front_end.php");
require_once("../cache_file/top-cache.php");
require_once("../classes/database.php");
require_once("../functions/pagebreak.php");
require_once("../classes/class.phpmailer.php");
require_once("../classes/class.pop3.php");
require_once("../classes/class.smtp.php");
require_once("../classes/PHPMailerAutoload.php");
require_once("../classes/Mobile_Detect.php");
if($_SERVER['SERVER_NAME'] == 'localhost'){
	$domain = "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'];
}
else if($_SERVER['SERVER_NAME'] == 'timviec365.com.vn'){
	$domain = "https://".$_SERVER['SERVER_NAME'];
}
else{
	$domain = "http://".$_SERVER['SERVER_NAME'];
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
$version = 136;


?>