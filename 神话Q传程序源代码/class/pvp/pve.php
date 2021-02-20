	<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
//扣除活力
	if($user[huoli]>"0"){
		$user[huoli]-="1";
	}else{
	    echo "<br/>你没有活力值(体力)，无法战斗了！<br/>";
echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/>";
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
shuxing($userid,users);
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
shuxing($chongwu[id],pet);
}}
//结束宠物判断

////////////////////////////////////////
////////////////////////////////////////
///////////以上处理函数//////////////////////////////////////////
//////////////////////////////////////////