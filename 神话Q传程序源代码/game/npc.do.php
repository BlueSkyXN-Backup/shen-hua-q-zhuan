<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$userid=$_SESSION['users'];

$npcid=$_GET['id'];
$npc = mysqli_query($db,"SELECT * FROM npc WHERE id='".$npcid."'");
$npc = mysqli_fetch_array($npc);
$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);


//定义用户师门学习技能
//妖
if($npcid=="33" && $user[zhongzu]=="1"){
   $jinen="<img src='/img/tan.gif'  alt='$row[name]' /><a href='/jineng/index'>学习门派技能</a><br/>";
}
//人
if($npcid=="37" && $user[zhongzu]=="2"){
   $jinen="<img src='/img/tan.gif'  alt='$row[name]' /><a href='/jineng/index'>学习门派技能</a><br/>";
}

//鬼
if($npcid=="34" && $user[zhongzu]=="3"){
   $jinen="<img src='/img/tan.gif'  alt='$row[name]' /><a href='/jineng/index'>学习门派技能</a><br/>";
}
//佛
if($npcid=="35" && $user[zhongzu]=="4"){
  $jinen="<img src='/img/tan.gif'  alt='$row[name]' /><a href='/jineng/index'>学习门派技能</a><br/>";
}
//仙
if($npcid=="36" && $user[zhongzu]=="5"){
   $jinen="<img src='/img/tan.gif'  alt='$row[name]' /><a href='/jineng/index'>学习门派技能</a><br/>";
}
//定义商人NPC
//
if($npcid=="39"){
   $jinen="<img src='/img/tan.gif'  alt='$row[name]' /><a href='Mall/npc.php?my=jiben'>买东西</a><br/><img src='/img/tan.gif'  alt='$row[name]' /><a href='Mall/npc_mai.php'>卖东西</a><br/>";
}
if($npcid=="81"){
   $jinen="<img src='/img/tan.gif'  alt='$row[name]' /><a href='Mall/fuben.php?my=jiben'>买东西</a><br/>";
}
if($npcid=="31"){
   $jinen="<img src='/img/tan.gif'  alt='$row[name]' /><a href='/qinglv/index.php'>我要征婚</a><br/>";
}




echo "<a href='/map.games?id=$npc[map]'>返回地图</a> <br/><br/>";
echo "<b>$npc[name]</b><br/><br/><br/>";
if($npc[img]=="0"){
}else{
echo"<img src='/img/$npc[img]'   width='90' height='100' alt='$npc[name]' /><br/>";
}

echo "$npc[text]<br/>";
echo $jinen;
//获取当前地图NPC已接受的任务
$result = mysqli_query($db,"SELECT * FROM renwu WHERE npc_wancheng='".$npcid."'");
while($row = mysqli_fetch_array($result))
  {
switch($row[leixing]){
case"huodong":
//活动任务

//判断是否已经接受
$resultl = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$row[id]."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){  
echo $class_renwu->wen($row[id],$userid)."<a href='/task/Obtain.task?id=$row[id]'>$row[name]</a>[活动]<br/>";
}else{
}



break;

case"richang":
//日常任务
//符合剧情任务进度
//判断是否已经接受
$resultl = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$row[id]."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){  
echo $class_renwu->wen($row[id],$userid)."<a href='/task/Obtain.task?id=$row[id]'>$row[name]</a>[日常]<br/>";
}else{
}


break;

case"zhixian":
    //获取用户

$user_zhixian = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM users_zhixian WHERE zhixian_id='".$row[zhixian_id]."' and userid='".$userid."'"));
if(!$user_zhixian){
    $s="insert into users_zhixian(zhixian_id,userid,zhixianjindu) values('".$row[zhixian_id]."','".$userid."','1')";
$ko=mysqli_query($db,$s);
$user_zhixian = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM renwu_my WHERE zhixian_id='".$row[zhixian_id]."' and userid='".$userid."'"));
}
if($row[juqing_dengji]==$user_zhixian[zhixianjindu]){
//符合剧情任务进度
//判断是否已经接受
$resultl = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$row[id]."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){  
echo $class_renwu->wen($row[id],$userid)."<a href='/task/Obtain.task?id=$row[id]'>$row[name]</a>[支线]<br/>";
}else{
  }

}else{
//不符合剧情任务进度
}

    
break;
case"juqing":
if($row[juqing_dengji]==$user[juqing]){
//符合剧情任务进度
//判断是否已经接受
$resultl = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$row[id]."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){  
echo $class_renwu->wen($row[id],$userid)."<a href='/task/Obtain.task?id=$row[id]'>$row[name]</a>[剧情]<br/>";
}else{
}

}else{
//不符合剧情任务进度
}

break;
default:

break;
}
 }


//获取当前地图NPC未接受的任务
$result = mysqli_query($db,"SELECT * FROM renwu WHERE npc='".$npcid."'");
while($row = mysqli_fetch_array($result))
  {
switch($row[leixing]){
case"huodong":
//活动任务
if($row[dengji]<=$user[dengji] && $row[dengji_max]>=$user[dengji]){
//符合剧情任务进度
//判断是否已经接受
$resultl = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$row[id]."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){  

}else{
  echo "<img src='/img/tan.gif'  alt='$row[name]' /><a href='/task/index.task?id=$row[id]&my=1'>$row[name]</a>[活动]<br/>";
}

}else{
//不符合任务等级
}

break;

case"richang":
//日常任务
if($row[dengji]<=$user[dengji] && $row[dengji_max]>=$user[dengji]){
//符合剧情任务进度
//判断是否已经接受
$resultl = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$row[id]."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){  

}else{
  echo "<img src='/img/tan.gif'  alt='$row[name]' /><a href='/task/index.task?id=$row[id]&my=1'>$row[name]</a>[日常]<br/>";
}

}else{
//不符合任务等级
}

break;

case"zhixian":
//获取用户

$user_zhixian = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM users_zhixian WHERE zhixian_id='".$row[zhixian_id]."' and userid='".$userid."'"));
if(!$user_zhixian){
    $s="insert into users_zhixian(zhixian_id,userid,zhixianjindu) values('".$row[zhixian_id]."','".$userid."','1')";
$ko=mysqli_query($db,$s);
$user_zhixian = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM renwu_my WHERE zhixian_id='".$row[zhixian_id]."' and userid='".$userid."'"));
}
if($row[juqing_dengji]==$user_zhixian[zhixianjindu]){
//符合剧情任务进度
//判断是否已经接受
$resultl = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$row[id]."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){  

}else{
  echo "<img src='/img/tan.gif'  alt='$row[name]' /><a href='/task/index.task?id=$row[id]&my=1'>$row[name]</a>[支线]<br/>";
}

}else{
//不符合剧情任务进度
}

    
break;
case"juqing":
if($row[juqing_dengji]==$user[juqing]){
//符合剧情任务进度
//判断是否已经接受
$resultl = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$row[id]."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){  

}else{
  echo "<img src='/img/tan.gif'  alt='$row[name]' /><a href='/task/index.task?id=$row[id]&my=1'>$row[name]</a>[剧情]<br/>";
}

}else{
//不符合剧情任务进度
}

break;
default:

break;
}
 }


$sql2="update users set map='".$npc[map]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);

echo "<a href='/map.games?id=$npc[map]'>只是路过</a> <br/>";

echo "<a href='/map.games?id=$npc[map]'>返回地图</a> <br/><br/>";
?>