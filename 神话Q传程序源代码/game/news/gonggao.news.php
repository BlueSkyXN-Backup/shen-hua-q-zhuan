<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$id=$_GET['id'];
$gonggao = mysqli_query($db,"SELECT * FROM gonggao WHERE id='".$id."'");
$gonggao = mysqli_fetch_array($gonggao);
/********************************************
 wap框架头部变量
 *******************************************/
echo $wapwork->title($gonggao[name]);
if ($gonggao){
if($gonggao[zhuangtai]=="1"){
$zhuangtai="进行中";
}else{
$zhuangtai="已结束";
}
echo "<br/><a href='/map.games?id=$user[map]'>返回地图</a> <br/>";
echo "$gonggao[name]($zhuangtai)<br/>时间:$gonggao[date]<br/>-------------------<br/>$gonggao[text]";
  
}
$gonggao_shang = mysqli_query($db,"SELECT * FROM gonggao WHERE id <'".$id."' ORDER BY id DESC LIMIT 1");
$gonggao_shang =mysqli_fetch_array($gonggao_shang);
if($gonggao_shang){
echo "<br/><a href='gonggao.news?id=$gonggao_shang[id]'>《《$gonggao_shang[name]</a>";
}

$gonggao_xia = mysqli_query($db,"SELECT * FROM gonggao WHERE id >'".$id."' ORDER BY id ASC LIMIT 1");
$gonggao_xia =mysqli_fetch_array($gonggao_xia);
if($gonggao_xia){
echo "<br/><a href='gonggao.news?id=$gonggao_xia[id]'>$gonggao_xia[name]》》</a>";
}








echo "<br/>客服：微信公众号wap_xyz<br/><a href='/map.games?id=$user[map]'>返回地图</a> <br/>";