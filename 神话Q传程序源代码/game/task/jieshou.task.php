<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$renwuid=$_GET['id'];


//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
mysqli_query($db,"select * from renwu_my where userid='".$userid."' for update");//锁定该用户的所有任务
mysqli_query($db,"select * from renwu_guaiwu where userid='".$userid."' for update");//锁定该用户的所有任务怪物
mysqli_query($db,"select * from users where id='".$userid."' for update");//锁定该用户资料
$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);
//调用用户数据
//接受任务或者放弃任务
$renwu = mysqli_query($db,"SELECT * FROM renwu WHERE id='".$renwuid."'");
$renwu = mysqli_fetch_array($renwu);
//判断等级是否达到要求
if($renwu[dengji]<=$user[dengji]){
}else{
echo "接受该任务需要等级达到".$renwu[dengji]."";
echo "<a href='/map.games?id=$zhuangtai_map'>只是路过</a> <br/>";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
echo footer();
exit();
}
//判断是否是剧情任务
if($renwu[leixing]=="juqing"){
if($renwu[juqing_dengji]==$user[juqing]){
//符合剧情任务进度
}else{
//不符合剧情任务进度
echo "你不能接受该剧情任务";
echo "<a href='/map.games?id=$zhuangtai_map'>只是路过</a> <br/>";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
echo footer();
exit();
}
}


//pa那段是否是支线任务
//判断是否是支线任务
if($renwu[leixing]=="zhixian"){
    $user_zhixian = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM users_zhixian WHERE zhixian_id='".$renwu[zhixian_id]."' and userid='".$userid."'"));
if($renwu[juqing_dengji]==$user_zhixian[zhixianjindu]){
//符合剧情任务进度
}else{
//不符合剧情任务进度
echo "你不能接受该支线任务";
echo "<a href='/map.games?id=$zhuangtai_map'>只是路过</a> <br/>";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
echo footer();
exit();
}
}


//判断是否是日常任务
if($renwu[leixing]=="richang"){
if($renwu[dengji]<=$user[dengji] && $renwu[dengji_max]>=$user[dengji]){
//符合剧情任务进度
//判断日常
$resultl = mysqli_query($db,"SELECT * FROM renwu_one WHERE leibie='richang' and userid='".$userid."'");
$rc = mysqli_fetch_array($resultl);
if($rc[shuliang]>="10"){
echo "你已经超过今日可接受日常任务数量，明天再来吧！";
echo "<a href='/npc.do?id=$renwu[npc]'>返回NPC</a><br/>";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
echo footer();
exit();	
}
}else{
//不符合剧任务进度
echo "你不能接受该日常任务";
echo "<a href='/npc.do?id=$renwu[npc]'>返回NPC</a><br/>";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
echo footer();
exit();
}
}


//判断是否是日常任务
if($renwu[leixing]=="huodong"){
if($renwu[dengji]<=$user[dengji] && $renwu[dengji_max]>=$user[dengji]){

//判断日常
$resultl = mysqli_query($db,"SELECT * FROM renwu_one WHERE leibie='huodong' and renwuid='".$renwu[id]."' and userid='".$userid."'");
$rc = mysqli_fetch_array($resultl);
if($rc[shuliang]>=$renwu[cishu]){
echo "该任务明天只能完成".$renwu[cishu]."次，明天再来继续吧！";
echo "<a href='/npc.do?id=$renwu[npc]'>返回NPC</a><br/>";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
echo footer();
exit();	
}
}else{
//不符合剧任务进度
echo "你不能接受该活动任务";
echo "<a href='/npc.do?id=$renwu[npc]'>返回NPC</a><br/>";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
echo footer();
exit();
}
}


//判断是否存在任务
$resultl = mysqli_query($db,"SELECT * FROM renwu WHERE id='".$renwuid."'");
$my = mysqli_fetch_array($resultl);
if($my){
}else{
echo "该任务不存在！！";
echo "<a href='/map.games?id=$zhuangtai_map'>只是路过</a> <br/>";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
echo footer();
exit();
}

$resultl = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$renwuid."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){
echo"你已接受该任务";
echo "<a href='/map.games?id=$zhuangtai_map'>只是路过</a> <br/>";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";

exit();//结束
}

if ($renwu[leibie]=="shouji"){
//写入我的任务系统
$s="insert into renwu_my(userid,yuanshi,leixing) values('".$userid."','".$renwu[id]."','".$renwu[leixing]."')";
$ok=mysqli_query($db,$s);
  if($ok){

mysqli_query($db,"COMMIT");
echo"接受任务成功！";
echo "<br/><a href='/task/index.task?id=$renwuid'>查看任务要求</a> <br/>";
}else{
mysqli_query($db,"ROLLBACK");
echo"接受任务失败！";
}

}
//纯对话
if ($renwu[leibie]=="duihua"){
//写入我的任务系统
$s="insert into renwu_my(userid,yuanshi,leixing) values('".$userid."','".$renwu[id]."','".$renwu[leixing]."')";
$ok=mysqli_query($db,$s);
  if($ok){
mysqli_query($db,"COMMIT");
echo"接受任务成功！";
echo "<br/><a href='/task/index.task?id=$renwuid'>查看任务要求</a> <br/>";
}else{
mysqli_query($db,"ROLLBACK");
echo"接受任务失败！";
}

}



//判断是否是击杀怪物任务
if ($renwu[leibie]=="jisha"){
//写入我的任务系统
$s="insert into renwu_my(userid,yuanshi,leixing) values('".$userid."','".$renwu[id]."','".$renwu[leixing]."')";
$ok=mysqli_query($db,$s);
	$jiasha_id = explode("|", $renwu[jisha_guaiwu]); 
$jisha_shuliang= explode("|", $renwu[jisha_shu]); 
for($j=0;$j<count($jiasha_id);$j++)
{
	$s="insert into renwu_guaiwu(userid,guaiwuid,renwuid,shuliang) values('".$userid."','".$jiasha_id[$j]."','".$renwuid."','".$jisha_shuliang[$j]."')";
$ok1=mysqli_query($db,$s);
if(!$ok1){
	$if_jisha="1122";
}
}

        
  if($ok && !$if_jisha){
  	 	//日常任务

mysqli_query($db,"COMMIT");
echo"接受任务成功！";
echo "<br/><a href='/task/index.task?id=$renwuid'>查看任务要求</a> <br/>";
}else{
mysqli_query($db,"ROLLBACK");
echo"接受任务失败！";
}

    }
 mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");

echo "<br/><a href='/npc.do?id=$renwu[npc]'>返回NPC</a> <br/>";

echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";

echo footer();?>
