<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}

include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$userid=$_SESSION['users'];
$id=$_GET['id'];
$my_yes=$_GET['my'];

//判断装备id只能为数字
if(!preg_match('/^[0-9]+$/u',$id)) {
echo"你的装备正在别人家仓库中！";
echo "<a href='/map.games'>返回地图</a> <br/><br/>";
exit();//结束
}
$_SESSION['qianghua']=md5(date("Y-m-d H:i:s"));
$ok_qianghua=$_SESSION['qianghua'];
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
if($my[time]!=null){
echo "当前装备非永久装备，强化后装备到期会被系统回收！<br/>";
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
$yongyou_wupin.="拥有幸运符：$tongji_shu[shuliang]个(提高强化+2～+7成功几率到100%)<br/>";

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
$yongyou_wupin.="拥有保装符：$tongji_shu[shuliang]个(保护装备强化+3以上失败不会碎掉)<br/>";
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
$yongyou_wupin.="拥有保底符：$tongji_shu[shuliang]个(保护装备强化+3以上失败等级不会减一)<br/>";



$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$id."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei[yuanshi]."'");
$muban_zhuangbei = mysqli_fetch_array($muban_zhuangbei);
if($muban_zhuangbei[leixing]=="fw"){$fwqh="符文强化不会获得加成属性。";}

switch ($zhuangbei[$qianghua_shuxing]) { 
  case "0":
   $xuyao_21="1";
$chenggong_lv="100";
$baozhuang="no";
$baodi="no";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes&ok=$ok_qianghua'>确认强化</a> <br/><br/>";
    break;  
 case "1":
   $xuyao_21="2";
$chenggong_lv="80";
$baozhuang="no";
$baodi="no";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&ok=$ok_qianghua&my=yes'>确认强化</a> <br/><br/>";
    break;  
  case "2":
   $xuyao_21="4";
$chenggong_lv="60";
$baozhuang="no";
$baodi="no";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes&ok=$ok_qianghua'>确认强化</a> <br/><br/>";
    break;
      case "3":
   $xuyao_21="6";
$chenggong_lv="50";
$baozhuang="yes";
$baodi="yes";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes&ok=$ok_qianghua'>确认强化</a> <br/><br/>";
    break;
      case "4":
   $xuyao_21="8";
$chenggong_lv="40";
$baozhuang="yes";
$baodi="yes";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes&ok=$ok_qianghua'>确认强化</a> <br/><br/>";
    break;
      case "5":
   $xuyao_21="10";
$chenggong_lv="30";
$baozhuang="yes";
$baodi="yes";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes&ok=$ok_qianghua'>确认强化</a> <br/><br/>";
    break;
      case "6":
   $xuyao_21="20";
$chenggong_lv="25";
$baozhuang="yes";
$baodi="yes";
$xingyun="yes";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes&ok=$ok_qianghua'>确认强化</a> <br/><br/>";
    break;
  case "7":
   $xuyao_21="30";
$chenggong_lv="20";
$baozhuang="yes";
$baodi="yes";
$xingyun="yes";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes&ok=$ok_qianghua'>确认强化</a> <br/><br/>";
    break;
      case "8":
   $xuyao_21="80";
$chenggong_lv="10";
$baozhuang="yes";
$baodi="yes";
$xingyun="no";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes&ok=$ok_qianghua'>确认强化</a> <br/><br/>";
    break;
      case "9":
   $xuyao_21="100";
$chenggong_lv="5";
$baozhuang="yes";
$baodi="no";
$xingyun="no";
$qh_linjie="<a href='./Strengthen?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=$bd&my=yes&ok=$ok_qianghua'>确认强化</a> <br/><br/>";
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
$xuyao_21="500";
$chenggong_lv="0";
$baozhuang="no";
$baodi="no";
$xingyun="no";
$qh_linjie="<br/><font s color='red'>强10已经是最高了，不能再继续强化了！</font><br/>";
    break;
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
//判断是否需要保底保装符
if($baozhuang=="yes"){
if($bz>"0"){

$baozhuang_qianghua="已放入";
}else{

$baozhuang_qianghua="<a href='./Operation?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=1&bd=$bd'>放入</a>(警告：你没有放入保装符，强化失败装备会消失。)";
}
}else{
    if($zhuangbei[$qianghua_shuxing]>"7"){
   $baozhuang_qianghua="警告！当前不能保装符，强化失败装备会碎掉！";     
    }else{
$baozhuang_qianghua="当前不需要保装符";
}
}

if($baodi=="yes"){
if($bd>"0"){

$baodi_qianghua="已放入";
}else{

$baodi_qianghua="<a href='./Operation?id=$id&shuxing=$qianghua_shuxing&xy=$xy&bz=$bz&bd=1'>放入</a>(警告：你没有放入保底符，强化失败装备强化等级会减一失。)";
}
}else{
$baodi_qianghua="当前不需要保底符";
}

$xz=$xy+1;
if($xingyun=="no"){
$xy="0";
$xingyun_qianghua="当前不能加入幸运符";
}else{
if($chenggong_lv>="100"){
$xingyun_qianghua="".$xy."張 ";
}else{
$xingyun_qianghua="".$xy."張<a href='./Operation?id=$id&shuxing=$qianghua_shuxing&xy=$xz&bz=$bz&bd=$bd'>放入</a>";}
}



echo"<img src='/img/kz.gif' />$muban_zhuangbei[name]<br/>当前强化".$zhuangbei_leixing.$zhuangbei[$qianghua_shuxing]."<br/><br/>需要强化石*<font s color='blue'>".$xuyao_21."</font>当前成功率：<font s color='blue'>".$chenggong_lv."％</font><br/>当前放入幸运符：".$xingyun_qianghua."<br/>当前放入保装符：".$baozhuang_qianghua."<br/>当前放入保底符：".$baodi_qianghua."<br/>";
echo $qh_linjie;



echo $yongyou_wupin;
echo $fwqh;

echo "<a href='./index?id=$id&wap=1'>选择其他属性</a> ";
?>