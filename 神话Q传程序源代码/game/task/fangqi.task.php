<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
//任务接受
$userid=$_SESSION['users'];
$renwuid=$_GET['id'];
$jieshou=$_GET['jieshou'];
$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);
//调用用户数据
//接受任务或者放弃任务
$renwu = mysqli_query($db,"SELECT * FROM renwu WHERE id='".$renwuid."'");
$renwu = mysqli_fetch_array($renwu);


  //开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
mysqli_query($db,"select * from beibao where userid='".$userid."' for update");//锁定该用户的所有物品
mysqli_query($db,"select * from zhuangbei where userid='".$userid."' for update");//锁定该用户的所有装备
mysqli_query($db,"select * from users where id='".$userid."' for update");//锁定该用户资料
//判断是否存在任务
$resultl = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$renwuid."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if($my){
}else{
echo "你没有接受该任务！";
echo "<a href='/map.games?id=$zhuangtai_map'>只是路过</a> <br/>";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";

exit();
}
      //放弃任务
      //这里写入删除任务表代码
$sql3 = "delete from renwu_my where yuanshi='".$renwuid."' and userid='".$userid."'";
$okrenwu=mysqli_query($db,$sql3);
      //查看是否是击杀怪物任务
     
if ($renwu[leibie]="jisha"){
$resultl = mysqli_query($db,"SELECT * FROM renwu_guaiwu WHERE guaiwuid='".$renwu[jisha_guaiwu]."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){
    //存在打怪任务数据库，删除数据表
    //这里这里这里写入删除打怪任务数据表代码
$sql3 = "delete from renwu_guaiwu where renwuid ='".$renwuid."' and userid='".$userid."'";
$ok=mysqli_query($db,$sql3);
}else{
    //不存在打怪数据库
}
}else{
    //不是击杀怪物数据库不执行代码
}
      

    
    if($okrenwu){
mysqli_query($db,"COMMIT");
echo"放弃任务成功！";
}else{
mysqli_query($db,"ROLLBACK");
echo"失败！";
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");

echo "<br/><a href='/npc.do?id=$renwu[npc]'>返回NPC</a> <br/>";

echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
?>
