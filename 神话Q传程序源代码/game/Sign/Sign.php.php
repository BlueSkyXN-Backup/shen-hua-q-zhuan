<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$my=$_GET['my'];
echo"
<a href='/map.games?id=$user[map]'>返回地图</a><br/>";
//签到奖励|<a href='/Mall/shsj?my=jiben'>充值奖励兑换</a><br/>
switch ($my) {
	case "index":
      $stop="999";
     break;
	case "sign_time":
       $jingli="wp,19|wp,1|wp,2|wp,21";
     $jingli_shu="1,1|10,10|10,10|1,1|200,300";
      $jingli_jilv="10000|10000|10000|10000";
     break;
   case "sign_time_one":
     $jingli="wp,68|wp,231|wp,23";
     $jingli_shu="1,1|1,1|5,5";
      $jingli_jilv="10000|10000|10000";
      $zx_time="3600";
     break;
   case "sign_time_two":
       $jingli="wp,464|wp,208|wp,24";
     $jingli_shu="1,1|1,1|5,5";
      $jingli_jilv="10000|10000|10000";
      $zx_time="7200";
     break;
   case "sign_time_three":
       $jingli="wp,465|wp,15";
     $jingli_shu="1,1|1,1";
      $jingli_jilv="10000|10000";
      $zx_time="10800";
     break;
     case "sign_time_four":
      $jingli="wp,466|wp,35";
     $jingli_shu="1,1|1,1";
      $jingli_jilv="10000|10000";
      $zx_time="14400";
     break;
      case "sign_qinglv":
      $jingli="wp,39|wp,208";
     $jingli_shu="1,10|1,1";
      $jingli_jilv="10000|10000";
     
     break;
      case "sign_bangpai":
      $jingli="wp,15";
     $jingli_shu="1,1";
      $jingli_jilv="10000";
     
     break;
     
   default:
     //echo "警告！异常故障，不要利用bug。";
}

//获取用户上次签到时间day
$time_user=$user[sign_time];

//获取当天时间day
$time=time();
$time1=date("Y-m-d",$time);
$time+="28800";
$time/=86400;
$time_day=intval($time);
//获取在线时间
$zaixianshijian=time()-$_SESSION['time'];
if($userid=="1"){
	$zaixianshijian="99999999999";
}
//每日签到奖励
if($stop){}else{
if($my){
if($user[$my]=='0'){
	if($my=='sign_time'){
$user[sign_days]+="1";
$sql2="update users set sign_days='".$user[sign_days]."' where id='".$userid."'";
$ok1=mysqli_query($db,$sql2);
}elseif($my=='sign_qinglv'){
	$qinglv=mysqli_fetch_array(mysqli_query($db,"select * from qinglv where nan IN('".$userid."') or nv IN('".$userid."')"));
	 if(!$qinglv){
	 	echo"你没有情侣，不能领取奖励！<br/><a href='Sign.php?my=index'>返回领奖</a>";
	 	exit('');
	 }
	 }elseif($my=='sign_bangpai'){
$bangpai_user = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM bangpai_user WHERE userid='".$userid."'"));
	 if(!$bangpai_user){
	 	echo"你没有加入帮派，不能领取奖励！<br/><a href='Sign.php?my=index'>返回领奖</a>";
	 	exit('');
	 }
	 }else{
	 if($zaixianshijian<$zx_time){
	 	echo"在线时间不够<br/><a href='Sign.php?my=index'>返回领奖</a>";
	 	exit('');
	 }
	
}//统计总签到天数

$sql2="update users set $my='1' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
if($ok){
echo "恭喜你获得：<font color='red'>";
echo $xyz->beibao($jingli,$jingli_shu,$jingli_jilv,"100",$userid,"","");
echo "</font><br/>";
}
//更新签到天数

}else{
	echo"不要重复领取奖励哦~<br/>";
}
}
}

if($user[sign_time]=="0"){
    $tan1="<img src='/img/tan.gif'  alt='$row[name]' />";
}
if($user[sign_time_one]=="0" and $zaixianshijian>"3600"){
    $tan2="<img src='/img/tan.gif'  alt='$row[name]' />";
}
if($user[sign_time_two]=="0" and $zaixianshijian>"7200"){
    $tan3="<img src='/img/tan.gif'  alt='$row[name]' />";
}
if($user[sign_time_three]=="0" and $zaixianshijian>"10800"){
    $tan4="<img src='/img/tan.gif'  alt='$row[name]' />";
}
if($user[sign_time_four]=="0" and $zaixianshijian>"14400"){
    $tan5="<img src='/img/tan.gif'  alt='$row[name]' />";
}
$qinglv_si=mysqli_fetch_array(mysqli_query($db,"select * from qinglv where nan IN('".$userid."') or nv IN('".$userid."')"));
if($user[sign_qinglv]=="0" and $qinglv_si){
    $tan6="<img src='/img/tan.gif'  alt='$row[name]' />";
}
$bangpai_si = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM bangpai_user WHERE userid='".$userid."'"));

if($user[sign_bangpai]=="0" and $bangpai_si){
    $tan7="<img src='/img/tan.gif'  alt='$row[name]' />";
}
$html=<<<HTML

------------<br/>
每日登录奖励
<a href='./Sign.php?my=sign_time'>$tan1 领取</a><br/>
当日在线1小时奖励
<a href='./Sign.php?my=sign_time_one'>$tan2 领取</a><br/>
当日在线2小时奖励
<a href='./Sign.php?my=sign_time_two'>$tan3 领取</a><br/>
当日在线3小时奖励
<a href='./Sign.php?my=sign_time_three'>$tan4 领取</a><br/>
当日在线4小时奖励
<a href='./Sign.php?my=sign_time_four'>$tan5 领取</a><br/>
已在线：$zaixianshijian 秒  提示：切换角色或退出游戏将清空在线时长。<br/>
------------<br/>
情侣每日礼包<br/>
<a href='Sign.php?my=sign_qinglv'>$tan6 领取情侣每日礼包</a>（随机获得1~10朵红玫瑰+摇奖盒*1 )
<br/>
------------<br/>

<a href='/map.games'>返回地图</a>
HTML;

//帮派每日礼包<br/>
//<a href='Sign.php?my=sign_bangpai'>$tan7 领取帮派每日礼包</a><br/>
echo $html;