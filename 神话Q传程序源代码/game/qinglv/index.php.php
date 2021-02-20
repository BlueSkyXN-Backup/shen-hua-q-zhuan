<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";


$my=$_GET['my'];
$sex=$_GET['sex'];
$yq=$_GET['yq'];
$userid=$_SESSION['users'];

$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);

echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/><br/>";



if ($my=="ok"){
$qinglvko=mysqli_fetch_array(mysqli_query($db,"select * from qinglv where nan IN('".$userid."') or nv IN('".$userid."')"));
if($qinglvko){
echo"你已经有情侣了！不要在外面扎花惹草了。<br/>";
}else{
$zhenghun = mysqli_query($db,"SELECT * FROM qinglv_zhenghun WHERE userid='".$userid."'");
$zhenghun= mysqli_fetch_array($zhenghun);
if($zhenghun){
echo "请不要重复发布！<br/>";
}else{
$s="insert into qinglv_zhenghun(userid,time,sex) values('".$userid."','".time()."','".$user[sex]."')";
$ok=mysqli_query($db,$s);
if ($ok){
echo "发布成功！<br/>";
}else{
echo "发布失败！<br/>";
}
}
}
}
//征婚启事
if ($yq){
$qinglvko=mysqli_fetch_array(mysqli_query($db,"select * from qinglv where nan IN('".$userid."') or nv IN('".$userid."')"));
if($qinglvko){
echo"你已经有情侣了！不要在外面扎花惹草了。<br/>";
}else{
$zhenghun = mysqli_query($db,"SELECT * FROM qinglv_zhenghun WHERE id='".$yq."'");
$zhenghun_ziliao= mysqli_fetch_array($zhenghun);
if($zhenghun_ziliao[sex]==$user[sex]){
echo"你不能向同性示爱！<br/>";
}else{
$zhenghun = mysqli_query($db,"SELECT * FROM qinglv_yaoqing WHERE npcid='".$zhenghun_ziliao[userid]."' and userid='".$userid."'");
$zhenghun_yaoqing= mysqli_fetch_array($zhenghun);
if($zhenghun_yaoqing){
echo "你已经对TA表达过爱意了！<br/>";
}else{
$s="insert into qinglv_yaoqing(userid,npcid,shuliang) values('".$userid."','".$zhenghun_ziliao[userid]."','0')";
$ok=mysqli_query($db,$s);
if ($ok){
echo "你的示爱已经发送了！<br/>";
}else{
echo "示爱失败！<br/>";
}
}
}
}
}

echo "<a href='index.php?my=ok'>我要发布征友</a><br/>";
if($sex=="1"){
$sex="1";
}else{
$sex="0";
}
//0女 1男
echo "<a href='index.php?sex=0'>女</a>| <a href='index.php?sex=1'>男</a> <br/>";
//聊天信息分页显示
$perNumber=16; 
$page=$_GET['page']; 
$url="./index.php?";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from qinglv_zhenghun where sex='".$sex."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from qinglv_zhenghun where sex='".$sex."' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "暂无征友公告!<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$resep = mysqli_query($db,"SELECT * FROM users WHERE id='".$row['userid']."'");
$myp = mysqli_fetch_array($resep);
echo "<a href='/user.php?id=$row[userid]'>$myp[username]</a>发布了征友公告！<a href='index.php?yq=$row[id]'>对Ta有好感</a><br/>";

}
$qq=$page-1;
if ($page != 1) { 
echo "<a href='".$url."page=".$qq."'>上一页</a>";
} 
if ($page<$totalPage) { 
$qqw=$page+1;
echo "<a href='".$url."page=".$qqw."'>下一页</a> ";
}
if ($totalNumber){
echo "第".$page."页/共".$totalPage."页<br/>";
}else{
echo "暂无征友玩家。<br/>";
}
}
echo "<a href='email.php'>查看对我有意的TA</a> <br/>";
echo "<a href='/npc.do?id=31'>红娘</a> <br/>";

echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/><br/>";


?>

