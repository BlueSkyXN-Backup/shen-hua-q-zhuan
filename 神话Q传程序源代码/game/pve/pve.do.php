<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
//让用户进入打怪的状态

include $_SERVER['DOCUMENT_ROOT']."/class/pvp/pve.php";
switch ($_GET[GO]) {

   case "boss":
  $result = mysqli_query($db,"SELECT * FROM guaiwu WHERE leixing='boss' and map='".$user[map]."'");
$row = mysqli_fetch_array($result);
if(!$row){
    header("location:../map.games");//跳转地址
}else{
    $boss_shuju= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM boss_time WHERE map='".$user[map]."'"));
    if($user[dengji]<$boss_shuju[dengji]){
        echo"等级低于".$boss_shuju[dengji]."级，不能参与击杀。";
    }else{
         if($user[dengji]>$boss_shuju[dengji_max]){
        echo"等级大于".$boss_shuju[dengji_max]."级，不能参与击杀。";
    }else{
        //检测boss击杀
        $rc_cishu = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM boss_cishu WHERE boss='".$boss_shuju[id]."' and userid='".$userid."'"));
        if(!$rc_cishu){
$rc_cishu[cishu]="0";
}
  if($rc_cishu[cishu]>$boss_shuju[cishu]){
        echo"你击杀频繁了，明天再来继续吧~";
    }else{
    //获取BOSS数据
    $boss_go1= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM boss_go WHERE map='".$user[map]."' and userid='".$userid."'"));
if(!$boss_go1){
    $s99="insert into boss_go(userid,map) values('".$userid."','".$user[map]."')";
$ok999=mysqli_query($db,$s99);
}
    	//设置进入打怪状态
mysqli_query($db,"update users set mys='boss' where id='".$userid."'");
	header("location:../pve/boss.do");
    }
    }
    }
}
     break;
     case "fuben":
  	//设置进入打怪状态
$ok=mysqli_query($db,"update users set mys='fuben' where id='".$userid."'");
if($ok){	
	//生成怪物
include $_SERVER['DOCUMENT_ROOT']."/class/pve/shengcheng_fuben.php";
	header("location:../pve/fuben.do");
	
}else{	header("location:../map.games");}

     break;
       case "maoxian":
  	//设置进入打怪状态
$ok=mysqli_query($db,"update users set mys='maoxian' where id='".$userid."'");
if($ok){	
	//生成怪物
include $_SERVER['DOCUMENT_ROOT']."/class/pve/shengcheng_maoxian.php";
	header("location:../pve/maoxian.do");
	
}else{	header("location:../map.games");}

     break;
   default:
$map = mysqli_query($db,"SELECT * FROM map WHERE id='".$user['map']."'");
$map = mysqli_fetch_array($map);
if($map['guaiwu']=NULL){//不存在怪物返回地图
	header("location:../map.games");//跳转地址
}else{
		//设置进入打怪状态
$ok=mysqli_query($db,"update users set mys='pve' where id='".$userid."'");
if($ok){	
	//生成怪物
include $_SERVER['DOCUMENT_ROOT']."/class/pve/shengcheng.php";
	header("location:../pve/pvp.do");
	
}else{	header("location:../map.games");}

}
}

echo "<br/><a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/>";
