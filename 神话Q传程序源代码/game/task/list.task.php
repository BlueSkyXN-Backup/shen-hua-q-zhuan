<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$renwuid=$_GET['id'];
$get_task=$_GET['my'];
//任务介绍页面

$renwu = mysqli_query($db,"SELECT * FROM renwu WHERE id='".$renwuid."'");
$renwu = mysqli_fetch_array($renwu);
switch($get_task){
case"1":
$task="huodong";
$renwuname="活动任务";
break;
case"2":
$task="juqing";
$renwuname="剧情任务";
break;
case"3":
$task="zhixian";
$renwuname="支线任务";
break;
default:
$task="richang";
$renwuname="日常任务";
break;
}
/********************************************
 wap框架头部变量
 *******************************************/
echo $wapwork->title($renwuname);
echo "<a href='/task/list.task'>日常</a>|<a href='/task/list.task?my=1'>活动</a>|<a href='/task/list.task?my=2'>剧情</a>|<a href='/task/list.task?my=3'>支线</a>
<br/>";
//聊天信息分页显示
$perNumber=16; 
$page=$_GET['page']; 
$url="/task/list.task?my=$get_task&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from renwu_my WHERE userid='".$userid."' and leixing='".$task."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from renwu_my  WHERE userid='".$userid."' and leixing='".$task."' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你没有接受任何任务，快去游戏里寻找活动任务吧！<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$resep = mysqli_query($db,"SELECT * FROM renwu WHERE id='".$row['yuanshi']."'");
$myp = mysqli_fetch_array($resep);
if($row[leixing]=="huodong"){
echo "[活动]";
}elseif($row[leixing]=="juqing"){
echo "[剧情]";
}elseif($row[leixing]=="richang"){
echo "[日常]";
}elseif($row[leixing]=="zhixian"){
echo "[支线]";
}
echo "<a href='/task/index.task?id=$row[yuanshi]'>$myp[name]</a><br/>";
}
if ($totalNumber){
echo page($url,$totalPage,$page,'my|'.$get_task);
}else{
	switch($get_task){
case"1":
echo "你没有接受任何活动任务，快去游戏里寻找活动任务吧！<br/>";
break;
case"2":
// $juqing = mysqli_query($db,"SELECT * FROM renwu WHERE juqing_dengji='".$user['juqing']."'");
// $juqing = mysqli_fetch_array($juqing);
// if($juqing){
// $npc = mysqli_query($db,"SELECT * FROM npc WHERE id='".$juqing['npc']."'");
// $npc= mysqli_fetch_array($npc);
// echo "当前剧情任务可寻找<a href='/npc.do?id=$npc[id]'>$npc[name]</a>接受<br/>";
// }else{
// echo "当前没有可接受的剧情任务<br/>";
// }
echo "剧情任务正在更新中<br/>";
break;
case"3":
echo "你没有接受任何支线任务，快去游戏里寻找支线任务吧！<br/>";
break;
default:
echo "1-30级日常任务领取NPC：<a href='/npc.do?id=60'>许仙</a>,<a href='/npc.do?id=72'>神秘的捕蛇人</a>领取！<br/>
31-60级日常任务领取NPC：<a href='/npc.do?id=19'>桃花仙子</a>领取！<br/>
61-80级日常任务领取NPC：<a href='/npc.do?id=59'>美猴王</a>领取！<br/>
81-100级日常任务领取NPC：<a href='/npc.do?id=59'>美猴王</a>领取！<br/>
101-120级日常任务领取NPC：<a href='/npc.do?id=59'>美猴王</a>领取！<br/>
120级以上日常任务领取NPC：<a href='/npc.do?id=59'>美猴王</a>领取！<br/>
tip：完成当天所有(10次)日常任务可获得 心愿水晶*1<br/>";
break;
}
}
}


echo "<a href='/map.games?id=$npc[map]'>只是路过</a> <br/>";

echo "<a href='/map.games?id=$npc[map]'>返回地图</a> <br/><br/>";
?>

