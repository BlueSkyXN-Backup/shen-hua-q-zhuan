<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";


$id=$_GET['id'];
$chongwuid=$_GET['chongwuid'];
$leixing=$_GET['leixing'];
$my=$_GET['my'];

$chongwu = mysqli_query($db,"SELECT * FROM pet WHERE userid='".$userid."' and id='".$chongwuid."'");
$chongwu = mysqli_fetch_array($chongwu);
if(preg_match('/^[0-9]+$/u',$id)) {
if(preg_match('/^[A-Za-z0-9]+$/u',$leixing)) {
if(preg_match('/^[A-Za-z0-9]+$/u',$my)) {
//这里判断是否数量低于1
}else{
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(只能是数字);//结束

}
}else{
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(只能是数字);//结束

}
}else{
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(只能是数字);//结束

}
$userid=$_SESSION['users'];
$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$id."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);

echo $chongwu[dengji];
$yuanshi= mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei[yuanshi]."'");
$yuanshi = mysqli_fetch_array($yuanshi);
//装备装备
if($my=="zhuangbei"){
if($zhuangbei[userid]==$userid){
if($yuanshi[dengji]<=$chongwu[dengji]){
if($chongwu[$leixing]<"1"){



$sql2="update pet set $leixing='".$id."' where id='".$chongwuid."'";
$ok=mysqli_query($db,$sql2);
if ($ok){
echo "<b>装备成功!<br/></b><br/>";
$sql2="update zhuangbei set shiyong='yes',jiyu='".$yuanshi[jiyu]."' where id='".$id."'";
$ok=mysqli_query($db,$sql2);
}else{
echo "<b>抱歉，装备失败！！<br/><a href='/my.php'>返回状态</a></b><br/>";
}
}else{
echo"请先脱下你身上的装备再装备新的装备！";}
}else{
echo"等级不够，无法装备！请赶快升级吧！";
}
}else{
echo"你没有这件装备！";
}
}

//卸下装备
if($my=="xiexia"){
if($zhuangbei[userid]==$userid){
if($chongwu[$leixing]>"0"){


$sql2="update pet set $leixing='0' where id='".$chongwuid."'";
$ok=mysqli_query($db,$sql2);
if ($ok){
echo "<b>卸下成功！已放入背包。<br/></b><br/>";
$sql2="update zhuangbei set shiyong='no' where id='".$id."'";
$ok=mysqli_query($db,$sql2);
}else{
echo "<b>抱歉，卸下失败！！<br/><a href='/my.php'>返回状态</a></b><br/>";
}
}else{
echo"亲，你身上没有装备可以卸下哦！";}
}else{
echo"你没有这件装备！";
}
}

//计算属性
shuxing($chongwuid,pet);

echo "<br/><a href='./pet.php?id=".$chongwuid."'>我的宠物</a> <br/>";

echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";

