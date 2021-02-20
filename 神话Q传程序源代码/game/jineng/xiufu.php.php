<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$userid=$_SESSION['users'];
$id=$_GET['id'];
$my_yes=$_GET['my'];
if($user[chongwu_id]!="0"){
$user_chongwu = mysqli_query($db,"SELECT * FROM pet WHERE userid='".$userid."' and id='".$user[chongwu_id]."'");
$user_chongwu = mysqli_fetch_array($user_chongwu);
}

echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/>";
echo "<a href='index'>门派技能</a>|<a href='xiufu.php'>装备修复</a>|<a href='hecheng'>宝石合成</a>|<a href='/fuzhi/index'>副职技能</a><br/>-------------------------<br/>";
for($i=1;$i<=18;$i++){
switch ($i) {
  case "1":
    $zhuangbei_leixing="maozi";
    break;
  case "2":
    $zhuangbei_leixing="xianglian";
    break;
  case "3":
    $zhuangbei_leixing="yifu";
    break;
  case "4":
    $zhuangbei_leixing="wuqi";
    break;
  case "5":
    $zhuangbei_leixing="xiezi";
    break;
      case "6":
    $zhuangbei_leixing= "ps1";
    break;  
  case "7":
    $zhuangbei_leixing= "ps2";
    break;
      case "8":
    $zhuangbei_leixing= "ps3";
    break;
      case "9":
    $zhuangbei_leixing= "ps4";
    break;
      case "10":
    $zhuangbei_leixing= "ps5";
    break;
      case "11":
    $zhuangbei_leixing= "ps6";
    break;
      case "12":
    $zhuangbei_leixing= "ps7";
    break;
      case"13":
    $zhuangbei_leixing= "ps8";
    break;
      case "14":
    $zhuangbei_leixing= "sz1";
    break;  
  case "15":
    $zhuangbei_leixing= "sz2";
    break;
      case "16":
    $zhuangbei_leixing= "sz3";
    break;
      case "17":
    $zhuangbei_leixing= "sz4";
    break;
      case "18":
    $zhuangbei_leixing= "sz5";
    break;
  default:
    echo "系统错误";
exit();
    break;
}
//
if($user[chongwu_id]!="0"){
if($user[$zhuangbei_leixing]!="0"){
	//获取装备耐久
	$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$user[$zhuangbei_leixing]."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei[yuanshi]."'");
$muban_zhuangbei = mysqli_fetch_array($muban_zhuangbei);
$naijiu+=$muban_zhuangbei[naijiu_max]-$zhuangbei[naijiu];
}
}
$naijiu_gold=$naijiu*1.69;
$naijiu_gold=ceil($naijiu_gold);
//chongwu
for($i=1;$i<=18;$i++){
switch ($i) {
  case "1":
    $zhuangbei_leixing="maozi";
    break;
  case "2":
    $zhuangbei_leixing="xianglian";
    break;
  case "3":
    $zhuangbei_leixing="yifu";
    break;
  case "4":
    $zhuangbei_leixing="wuqi";
    break;
  case "5":
    $zhuangbei_leixing="xiezi";
    break;
      case "6":
    $zhuangbei_leixing= "ps1";
    break;  
  case "7":
    $zhuangbei_leixing= "ps2";
    break;
      case "8":
    $zhuangbei_leixing= "ps3";
    break;
      case "9":
    $zhuangbei_leixing= "ps4";
    break;
      case "10":
    $zhuangbei_leixing= "ps5";
    break;
      case "11":
    $zhuangbei_leixing= "ps6";
    break;
      case "12":
    $zhuangbei_leixing= "ps7";
    break;
      case"13":
    $zhuangbei_leixing= "ps8";
    break;
      case "14":
    $zhuangbei_leixing= "sz1";
    break;  
  case "15":
    $zhuangbei_leixing= "sz2";
    break;
      case "16":
    $zhuangbei_leixing= "sz3";
    break;
      case "17":
    $zhuangbei_leixing= "sz4";
    break;
      case "18":
    $zhuangbei_leixing= "sz5";
    break;
  default:
    echo "系统错误";
exit();
    break;
}
//
if($user_chongwu[$zhuangbei_leixing]!="0"){
	//获取装备耐久
	$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$user_chongwu[$zhuangbei_leixing]."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei[yuanshi]."'");
$muban_zhuangbei = mysqli_fetch_array($muban_zhuangbei);
$naijiu2+=$muban_zhuangbei[naijiu_max]-$zhuangbei[naijiu];
}
}
$naijiu_gold2=$naijiu2*1.69;
$naijiu_gold2=ceil($naijiu_gold2);
}
if(!$naijiu){
		$naijiu=0;
	}

$html=<<<HTML

你有$naijiu 点装备耐久可以一键修复<br/>

修复需要金币：$naijiu_gold
<br/>拥有金币：$user[gold]
<a href='xiufu.php?my=yes'>确认修复</a> 

HTML;
if($user[chongwu_id]!="0"){
	if(!$naijiu2){
		$naijiu2=0;
	}
	$html.=<<<HTML
	<br/>-------------------------------<br/>
你的宠物装备有$naijiu2 点耐久可以一键修复<br/>

修复需要金币：$naijiu_gold2
<br/>拥有金币：$user[gold]
<a href='xiufu.php?my=chongwu'>确认修复</a> 
HTML;
}
//修复代码
//开始执行修复代码
if($my_yes=="yes"){
if($user[gold]<$naijiu_gold){
echo"对不起，金币不足！";
}else{
$user[gold]-=$naijiu_gold;
$sql1="update users set  gold='".$user[gold]."' where id='".$userid."'";
$ok1=mysqli_query($db,$sql1);
if($ok1){
	//循环写入新耐久
	for($i=1;$i<=18;$i++){
switch ($i) {
  case "1":
    $zhuangbei_leixing="maozi";
    break;
  case "2":
    $zhuangbei_leixing="xianglian";
    break;
  case "3":
    $zhuangbei_leixing="yifu";
    break;
  case "4":
    $zhuangbei_leixing="wuqi";
    break;
  case "5":
    $zhuangbei_leixing="xiezi";
    break;
      case "6":
    $zhuangbei_leixing= "ps1";
    break;  
  case "7":
    $zhuangbei_leixing= "ps2";
    break;
      case "8":
    $zhuangbei_leixing= "ps3";
    break;
      case "9":
    $zhuangbei_leixing= "ps4";
    break;
      case "10":
    $zhuangbei_leixing= "ps5";
    break;
      case "11":
    $zhuangbei_leixing= "ps6";
    break;
      case "12":
    $zhuangbei_leixing= "ps7";
    break;
      case"13":
    $zhuangbei_leixing= "ps8";
    break;
        case "14":
    $zhuangbei_leixing= "sz1";
    break;  
  case "15":
    $zhuangbei_leixing= "sz2";
    break;
      case "16":
    $zhuangbei_leixing= "sz3";
    break;
      case "17":
    $zhuangbei_leixing= "sz4";
    break;
      case "18":
    $zhuangbei_leixing= "sz5";
    break;
  default:
    echo "系统错误";
exit();
    break;
}
//
if($user[$zhuangbei_leixing]!="0"){
$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$user[$zhuangbei_leixing]."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei[yuanshi]."'");
$muban_zhuangbei = mysqli_fetch_array($muban_zhuangbei);
$sql1="update zhuangbei set  naijiu='".$muban_zhuangbei[naijiu_max]."' where id='".$user[$zhuangbei_leixing]."'";
$ok2=mysqli_query($db,$sql1);
}
}
//耐久写入结束
	

if($ok2){
echo "修复成功！<br/>";
}else{
echo "修复失败！<br/>";
}
}else{
echo "修复失败！<br/>";
}
}


}
//chongwu
if($my_yes=="chongwu"){
if($user[gold]<$naijiu_gold2){
echo"对不起，金币不足！";
}else{
$user[gold]-=$naijiu_gold2;
$sql1="update users set  gold='".$user[gold]."' where id='".$userid."'";
$ok1=mysqli_query($db,$sql1);
if($ok1){
	//循环写入新耐久
	for($i=1;$i<=18;$i++){
switch ($i) {
  case "1":
    $zhuangbei_leixing="maozi";
    break;
  case "2":
    $zhuangbei_leixing="xianglian";
    break;
  case "3":
    $zhuangbei_leixing="yifu";
    break;
  case "4":
    $zhuangbei_leixing="wuqi";
    break;
  case "5":
    $zhuangbei_leixing="xiezi";
    break;
      case "6":
    $zhuangbei_leixing= "ps1";
    break;  
  case "7":
    $zhuangbei_leixing= "ps2";
    break;
      case "8":
    $zhuangbei_leixing= "ps3";
    break;
      case "9":
    $zhuangbei_leixing= "ps4";
    break;
      case "10":
    $zhuangbei_leixing= "ps5";
    break;
      case "11":
    $zhuangbei_leixing= "ps6";
    break;
      case "12":
    $zhuangbei_leixing= "ps7";
    break;
      case"13":
    $zhuangbei_leixing= "ps8";
    break;
        case "14":
    $zhuangbei_leixing= "sz1";
    break;  
  case "15":
    $zhuangbei_leixing= "sz2";
    break;
      case "16":
    $zhuangbei_leixing= "sz3";
    break;
      case "17":
    $zhuangbei_leixing= "sz4";
    break;
      case "18":
    $zhuangbei_leixing= "sz5";
    break;
  default:
    echo "系统错误";
exit();
    break;
}
//
if($user_chongwu[$zhuangbei_leixing]!="0"){
$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$user_chongwu[$zhuangbei_leixing]."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei[yuanshi]."'");
$muban_zhuangbei = mysqli_fetch_array($muban_zhuangbei);
$sql1="update zhuangbei set  naijiu='".$muban_zhuangbei[naijiu_max]."' where id='".$user_chongwu[$zhuangbei_leixing]."'";
$ok2=mysqli_query($db,$sql1);
}
}
//耐久写入结束
	

if($ok2){
echo "修复成功！<br/>";
}else{
echo "修复失败！<br/>";
}
}else{
echo "修复失败！<br/>";
}
}


}

echo $html;

echo "<br/>-------------------<br/>提示:此处为一键修复已穿戴装备，未穿戴装备请在装备属性页单件修复。<br/><a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/>";
?>