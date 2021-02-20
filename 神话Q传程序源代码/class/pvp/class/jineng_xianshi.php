<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}

$jn=$_GET['jn'];
$jnsss=$jn;
$pvp=$_GET['pk'];

//设置必须要有pk变量
if(!isset($_SESSION['pvp'])){//判断是否存在打怪变量
$_SESSION['pvp']=md5(date("Y-m-d H:i:s"));
}
$pvp_md5=$_SESSION['pvp'];
$pk[id]=$_SESSION['pvp'];
if ($pvp==$pvp_md5){
}else{
if ($pvp=="" ){

}else{
echo "<br/>不合理的请求!<br/>";
echo "<a href='/map.php?id=".$zhuangtai_map."'>返回地图</a> <br/>";
exit();//结束
}
}

if ($pvp==""){
//开始人物判断
	//扣除活力
	if($user[huoli]>"0"){
		$user[huoli]-="1";
	}else{
	    echo "<br/>你没有活力值(体力)，无法战斗了！<br/>";
echo "<a href='/map.php?id=".$zhuangtai_map."'>返回地图</a> <br/>";
		exit();//结束
	}
//扣除装备耐久
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
      case "13":
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
$zhuangbeileixing=$user[$zhuangbei_leixing];
if($zhuangbeileixing!="0"){
$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$zhuangbeileixing."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$zhuangbei[naijiu]-="1";
//最后将耐久写入数据库
$sql2="update zhuangbei set naijiu='".$zhuangbei[naijiu]."' where id='".$zhuangbeileixing."'";
$ok=mysqli_query($db,$sql2);
}
$sql2="update users set huoli='".$user[huoli]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
//计算属性
zhuangtai_shuxing($userid);
}
//开始宠物判断
if($user[chongwu_id]!="0"){
$chongwu= mysqli_query($db,"SELECT * FROM pet WHERE userid='".$userid."' and id='".$user[chongwu_id]."'");
$chongwu= mysqli_fetch_array($chongwu);
	//扣除活力
	if($chongwu[zhongcheng]>"0"){
		$chongwu[zhongcheng]-="1";
	}else{
	    echo "<br/>你的宠物处于饥饿状态，无法战斗了！已经强制休息。<br/>";
	    $sql2="update users set chongwu_id='0' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
	}
//扣除装备耐久
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
      case "13":
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
$zhuangbeileixing=$chongwu[$zhuangbei_leixing];
if($zhuangbeileixing!="0"){
$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$zhuangbeileixing."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$zhuangbei[naijiu]-="1";
//最后将耐久写入数据库
$sql2="update zhuangbei set naijiu='".$zhuangbei[naijiu]."' where id='".$zhuangbeileixing."'";
$ok=mysqli_query($db,$sql2);
}
$sql2="update pet set zhongcheng='".$chongwu[zhongcheng]."' where id='".$chongwu[id]."'";
$ok=mysqli_query($db,$sql2);
//计算属性
chongwu_shuxing($chongwu[id]);
}}
//结束宠物判断
}
////////////////////////////////////////
////////////////////////////////////////
///////////以上处理函数//////////////////////////////////////////
//////////////////////////////////////////
///////////////////////////////////////
//是否学习技能，否则转换为普通攻击
switch($jn){
case"1":
if($user[jineng1]==0){
$jn+="1000";
}
$user_caozuo="gongji";
break;
case "2":
if($user[jineng2]==0){
$jn+="1000";
}
$user_caozuo="gongji";
break;
case"3":
if($user[jineng3]==0){
$jn+="1000";
}
$user_caozuo="gongji";
break;
case"4":
if($user[jineng4]==0){
$jn+="1000";
}
$user_caozuo="gongji";
break;
case"5":
if($user[jineng5]==0){
$jn+="1000";
}
$user_caozuo="gongji";
break;
case"99":
$user_caozuo="buzhuo";
break;
case $jn<"11" && $jn>"5":
//吃药
$chiyao_jn=$jn-="5";
$user_caozuo="chiyao";
break;
case"11":
$user_caozuo="taopao";

break;
default:
//防止使用其它种族技能
$user_caozuo="gongji";
$jn="999";
break;
}


switch($user[zhongzu]){
case"4":
$jn+="5";
//佛
$jineng1="狂煞";
$jineng2="横扫千军";
$jineng3="连环破斩";
$jineng4="作茧自缚";
$jineng5="天罗地网";
break;

case "1":
$jn+="10";
//妖
$jineng1="魅惑";
$jineng2="情意绵绵";
$jineng3="五蛟灭世";
$jineng4="情投意合";
$jineng5="借刀杀人";
break;

case"2":
$jn+="15";
//人
$jineng1="浩然正气";
$jineng2="凝神归元";
$jineng3="妙手回春";
$jineng4="起死回生";
$jineng5="福星高照";
break;

case"5":
$jn+="20";
//仙
$jineng1="天剑";
$jineng3="万剑归宗";
$jineng2="冰心咒";
$jineng4="三昧真火";
$jineng5="天诛地灭";
break;
default:
//鬼
$jineng1="摄魂";
$jineng2="消魂蚀骨";
$jineng3="尸毒";
$jineng4="魂飞魄散";
$jineng5="万毒攻心";
break;
}
if($user[jineng1]==0){
$jineng1="普攻";
}
if($user[jineng2]==0){
$jineng2="普攻";
}
if($user[jineng3]==0){
$jineng3="普攻";
}
if($user[jineng4]==0){
$jineng4="普攻";
}
if($user[jineng5]==0){
$jineng5="普攻";
}