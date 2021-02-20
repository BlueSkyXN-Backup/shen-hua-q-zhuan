<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}

include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$userid=$_SESSION['users'];
$id=$_GET['id'];
$my_yes=$_GET['my'];
$ok_yes=$_GET['ok'];


if($ok_yes!=$_SESSION['qianghua']){
echo"请不要刷强化！";
echo "<a href='/map.games'>返回地图</a> <br/><br/>";
exit();//结束
}


//判断装备id只能为数字
if(!preg_match('/^[0-9]+$/u',$id)) {
echo"你的装备正在别人家仓库中！";
echo "<a href='/map.games'>返回地图</a> <br/><br/>";
exit();//结束
}
$qianghua_shuxing=$_GET['shuxing'];
//获取装备强化类型
switch($qianghua_shuxing){
      case "qh1":
    $zhuangbei_leixing= "气血";
    break;  
  case "qh2":
    $zhuangbei_leixing= "法力";
    break;
      case "qh3":
    $zhuangbei_leixing= "防御";
    break;
      case "qh4":
    $zhuangbei_leixing= "法攻";
    break;
      case "qh5":
    $zhuangbei_leixing= "物攻";
    break;
      case "qh6":
    $zhuangbei_leixing= "速度";
    break;
  default:
    echo "你只能选择6种属性之内进行强化。";
exit();
    break;
}
$resultl = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$id."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if (!$my){
echo"你未拥有该装备，不能强化！";
echo "<a href='/map.games'>返回地图</a> <br/><br/>";
exit();//结束
}

$xy=$_GET['xy'];//幸运符数量
//判断幸运符只能为数字
if(!$xy){
$xy="0";
}else{
if(!preg_match('/^[0-9]+$/u',$xy)) {
echo"你的幸运符跑掉了！";
echo "<a href='/map.games'>返回地图</a> <br/><br/>";
exit();//结束
}
}
$bz=$_GET['bz'];//保装符数量
//判断幸运符只能为数字
if(!$bz){
$bz="0";
}else{
if(!preg_match('/^[0-9]+$/u',$bz)) {
echo"你的保装符跑掉了！";
echo "<a href='/map.games'>返回地图</a> <br/><br/>";
exit();//结束
}
}
$bd=$_GET['bd'];//保底符数量
//判断幸运符只能为数字
if(!$bd){
$bd="0";
}else{
if(!preg_match('/^[0-9]+$/u',$bd)) {
echo"你的保底符跑掉了！";
echo "<a href='/map.games'>返回地图</a> <br/><br/>";
exit();//结束
}
}

echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";
//统计幸运符数量
$tongji_shu=mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='22' and userid='".$userid."'");
$tongji_shu=mysqli_fetch_array($tongji_shu);
if(!$tongji_shu[shuliang]){
$tongji_shu[shuliang]="0";
}
if($xy>$tongji_shu[shuliang]){
echo"幸运符不够<br/>";
echo "<a href='/map.games'>返回地图</a> <br/>";
exit();//结束
}
$yongyou_wupin.="拥有幸运符：$tongji_shu[shuliang]个<br/>";

$tongji_shu=mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='23' and userid='".$userid."'");
$tongji_shu=mysqli_fetch_array($tongji_shu);
if(!$tongji_shu[shuliang]){
$tongji_shu[shuliang]="0";
}
if($bz>$tongji_shu[shuliang]){
echo"包装符不够<br/>";
echo "<a href='/map.games'>返回地图</a> <br/>";
exit();//结束
}
$yongyou_wupin.="拥有保装符：$tongji_shu[shuliang]个(如果装备强化失败将自动使用)<br/>";
$tongji_shu=mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='24' and userid='".$userid."'");
$tongji_shu=mysqli_fetch_array($tongji_shu);
if(!$tongji_shu[shuliang]){
$tongji_shu[shuliang]="0";
}
if($bd>$tongji_shu[shuliang]){
echo"保底符不够<br/>";
echo "<a href='/map.games'>返回地图</a> <br/>";
exit();//结束
}
$yongyou_wupin.="拥有保底符：$tongji_shu[shuliang]个(如果装备强化失败将自动使用)<br/>";



$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$id."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei[yuanshi]."'");
$muban_zhuangbei = mysqli_fetch_array($muban_zhuangbei);


switch ($zhuangbei[$qianghua_shuxing]) { 
  case "0":
   $xuyao_21="1";
$chenggong_lv="100";
$baozhuang="no";
$baodi="no";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes'>确认强化</a> <br/><br/>";
    break;  
 case "1":
   $xuyao_21="2";
$chenggong_lv="80";
$baozhuang="no";
$baodi="no";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes'>确认强化</a> <br/><br/>";
    break;  
  case "2":
   $xuyao_21="4";
$chenggong_lv="60";
$baozhuang="no";
$baodi="no";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes'>确认强化</a> <br/><br/>";
    break;
      case "3":
   $xuyao_21="6";
$chenggong_lv="50";
$baozhuang="yes";
$baodi="yes";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes'>确认强化</a> <br/><br/>";
    break;
      case "4":
   $xuyao_21="8";
$chenggong_lv="40";
$baozhuang="yes";
$baodi="yes";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes'>确认强化</a> <br/><br/>";
    break;
      case "5":
   $xuyao_21="10";
$chenggong_lv="30";
$baozhuang="yes";
$baodi="yes";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes'>确认强化</a> <br/><br/>";
    break;
      case "6":
   $xuyao_21="20";
$chenggong_lv="25";
$baozhuang="yes";
$baodi="yes";
$xingyun="yes";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes'>确认强化</a> <br/><br/>";
    break;
  case "7":
   $xuyao_21="30";
$chenggong_lv="20";
$baozhuang="yes";
$baodi="yes";
$xingyun="yes";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes'>确认强化</a> <br/><br/>";
    break;
      case "8":
   $xuyao_21="80";
$chenggong_lv="5";
$baozhuang="yes";
$baodi="yes";
$xingyun="no";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes'>确认强化</a> <br/><br/>";
    break;
      case "9":
   $xuyao_21="100";
$chenggong_lv="2";
$baozhuang="yes";
$baodi="no";
$xingyun="no";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes'>确认强化</a> <br/><br/>";
    break;
      case "10":
  $xuyao_21="500";
$chenggong_lv="5";
$baozhuang="yes";
$baodi="no";
$xingyun="no";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes&ok=$ok_qianghua'>确认强化</a> <br/><br/>";
    break;
       case "11":
 $xuyao_21="1000";
$chenggong_lv="5";
$baozhuang="no";
$baodi="no";
$xingyun="no";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes&ok=$ok_qianghua'>确认强化</a> <br/><br/>";
    break;
  default:
$qh_linjie="强12已经是最高了，不能再继续强化了！";
    break;
}
if($xingyun=="no"){
$xy="0";
}
//获取拥有强化石数量
$tongji_shu=mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='21' and userid='".$userid."'");
$tongji_shu=mysqli_fetch_array($tongji_shu);
if(!$tongji_shu[shuliang]){
$tongji_shu[shuliang]="0";
}
$my_qianghua=$tongji_shu[shuliang];


$xingyunzhi=$xy;
$xingyunzhi*=10;
$chenggong_lv+=$xingyunzhi;


//强化提交
if($my_yes=="yes"){
//扣除强化石
if($my_qianghua<$xuyao_21){
echo"强化石不够！";
echo "<a href='/map.games'>返回地图</a> <br/><br/>";
exit();//结束
}
$my_qianghua-=$xuyao_21;
if($my_qianghua<"1"){
$sql3 = "delete from beibao where userid='".$userid."' and wupin_id='21'";
$ok=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$my_qianghua."' where userid='".$userid."' and wupin_id='21'";
$ok=mysqli_query($db,$sql2);
}
//扣除强化石结束
//统计幸运符数量
$tongji_shu=mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='22' and userid='".$userid."'");
$tongji_shu=mysqli_fetch_array($tongji_shu);
if(!$tongji_shu[shuliang]){
$tongji_shu[shuliang]="0";
}
//扣除幸运符
$tongji_shu[shuliang]-=$xy;
if($tongji_shu[shuliang]<"1"){
$sql3 = "delete from beibao where userid='".$userid."' and wupin_id='22'";
$ok=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$tongji_shu[shuliang]."' where userid='".$userid."' and wupin_id='22'";
$ok=mysqli_query($db,$sql2);
}


$chenggong=mt_rand(1,100);
if($chenggong_lv>=$chenggong){
echo"恭喜你强化成功！<br/>";
$zhuangbei[$qianghua_shuxing]+="1";
$sql1="update zhuangbei set  $qianghua_shuxing='".$zhuangbei[$qianghua_shuxing]."' where id='".$id."'";
$ok=mysqli_query($db,$sql1);
//扣除保装保底
if($baozhuang=="yes"){
if($bz>"0"){
$my = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and wupin_id='23'");
$wupin_shu= mysqli_fetch_array($my);
if ($wupin_shu){
$wupin_shu[shuliang]-="1";
if($wupin_shu[shuliang]<"1"){

$sql3 = "delete from beibao where userid='".$userid."' and wupin_id='23'";
$ok=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$wupin_shu[shuliang]."' where userid='".$userid."' and wupin_id='23'";
$ok=mysqli_query($db,$sql2);
}}}}
if($baodi=="yes"){
if($bd>"0"){
$my = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and wupin_id='24'");
$wupin_shu= mysqli_fetch_array($my);
if ($wupin_shu){
$wupin_shu[shuliang]-="1";
if($wupin_shu[shuliang]<"1"){

$sql3 = "delete from beibao where userid='".$userid."' and wupin_id='24'";
$ok=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$wupin_shu[shuliang]."' where userid='".$userid."' and wupin_id='24'";
$ok=mysqli_query($db,$sql2);
}}}}
}else{
echo"强化失敗";
//消耗保装符
  if($zhuangbei[$qianghua_shuxing]>"10"){
  echo "<br/>非常遗憾！晋升失败，装备碎掉了！<br/>";
$s="insert into news(text,time,userid) values('晋升失败".$muban_zhuangbei[name]."碎掉了！".$huode_html."','".$pass."','$userid')";
$ok=mysqli_query($db,$s);   
$sql3 = "delete from zhuangbei where id='".$id."' and userid='".$userid."'";
$ok=mysqli_query($db,$sql3);
    }else{
if($baozhuang=="yes"){
if($bz>"0"){
$my = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and wupin_id='23'");
$wupin_shu= mysqli_fetch_array($my);
if ($wupin_shu){
$wupin_shu[shuliang]-="1";
if($wupin_shu[shuliang]<"1"){

$sql3 = "delete from beibao where userid='".$userid."' and wupin_id='23'";
$ok=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$wupin_shu[shuliang]."' where userid='".$userid."' and wupin_id='23'";
$ok=mysqli_query($db,$sql2);
}
}else{
echo "<br/>没有加入保装符装备碎掉了！！！<br/>";
$s="insert into news(text,time,userid) values('强化失败".$muban_zhuangbei[name]."碎掉了！".$huode_html."','".$pass."','$userid')";
$ok=mysqli_query($db,$s);
//没有加入包装符
if($zhuangbei[shiyong]=="yes"){
$sql2="update users set $zhuangbei[leixing]='0' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
}
$ok=mysqli_query($db,$sql1);
$sql3 = "delete from zhuangbei where id='".$id."'";
$ok=mysqli_query($db,$sql3);
}
}else{
//没有保装符执行代码
echo "<br/>没有保装符装备碎掉了！！！<br/>";
$s="insert into news(text,time,userid) values('强化失败".$muban_zhuangbei[name]."碎掉了！".$huode_html."','".$pass."','$userid')";
$ok=mysqli_query($db,$s);

$ok=mysqli_query($db,$sql1);
$sql3 = "delete from zhuangbei where id='".$id."'";
$ok=mysqli_query($db,$sql3);

}
}
//消耗包装符结束
//消耗保底符
if($baodi=="yes"){
if($bd>"0"){
$my = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and wupin_id='24'");
$wupin_shu= mysqli_fetch_array($my);
if ($wupin_shu){
$wupin_shu[shuliang]-="1";
if($wupin_shu[shuliang]<"1"){

$sql3 = "delete from beibao where userid='".$userid."' and wupin_id='24'";
$ok=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$wupin_shu[shuliang]."' where userid='".$userid."' and wupin_id='24'";
$ok=mysqli_query($db,$sql2);
}
}else{
//没有放入保底符
echo "<br/>没有加入保底符装备强化等级减一！！！<br/>";
$zhuangbei[$qianghua_shuxing]-="1";
$sql1="update zhuangbei set  $qianghua_shuxing='".$zhuangbei[$qianghua_shuxing]."' where id='".$id."'";
$ok=mysqli_query($db,$sql1);
}
}else{
//没有保低符执行代码
echo "<br/>没有保底符装备强化等级减一！！！<br/>";
$zhuangbei[$qianghua_shuxing]-="1";
$sql1="update zhuangbei set  $qianghua_shuxing='".$zhuangbei[$qianghua_shuxing]."' where id='".$id."'";
$ok=mysqli_query($db,$sql1);

}
}
//消耗保底符结束

}
}
}

echo "<br/><a href='./Operation?id=$id&shuxing=$qianghua_shuxing&xy=0&bz=0&bd=0'>继续强化</a> <br/>";


$_SESSION['qianghua']=md5(date("Y-m-d H:i:s"));
