<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$cid=$_GET['jid'];
$my=$_GET['my'];
$data=time();


if ($my=="ok"){
if($userid!=$cid){
$zone=mysqli_query($db,"SELECT * FROM users WHERE id=$cid");
$zone=mysqli_fetch_array($zone);
if ($zone){
$row=mysqli_query($db,"SELECT * FROM haoyou WHERE userid='".$userid."' and cid='".$cid."'");
$row=mysqli_fetch_array($row);
if ($row){
echo "你们已经是好友了！<br/>";
}else{
$s="insert into haoyou(userid,cid) values('".$userid."','".$cid."')";
$ok=mysqli_query($db,$s);
if ($ok){
echo "添加成功!<br/>";
$s="insert into haoyou_email(text,userid,yourid,zhuangtai,time) values('我把你添加为好友了，快来和我一起玩耍吧！','".$userid."','".$cid."','0','".$data."')";
$ok=mysqli_query($db,$s);
}else{
echo "添加失败!<br/>";
}
}
}else{
echo "id号好像写错了哦！<br/>";
}
}else{
echo "不能添加自己！<br/>";
}
}


echo"【我的信息】<br/>";
$perNumber=10; 
$page=$_GET['page']; 
$url="../Friend/index.php?sid=$sid&amp;";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from haoyou_email WHERE zhuangtai='0' && yourid='".$userid."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from haoyou_email WHERE zhuangtai='0' && yourid='".$userid."' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "暂无好友!<br/>";
}else{
while($arr=mysqli_fetch_array($result)){ 
echo "来自".user_name($arr['userid'])."未读消息<a href='/Friend/chat.php?id=$arr[userid]'>查看</a><br/>";
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
echo "暂无新消息<br/>";
}
}


echo"【好友列表】<br/>";
$perNumber=10; 
$page=$_GET['pages']; 
$url="../Friend/index.php?sid=$sid&amp;";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from haoyou WHERE userid=$userid")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from haoyou WHERE userid=$userid order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "暂无好友!<br/>";
}else{
while($arr=mysqli_fetch_array($result)){ 
$zaixian=time()-$myp[time];
if($zaixian<360){
$zaixian="在线";
}else{
$zaixian="离线";
}
echo user_name($arr['cid'])."<a href='/Friend/chat.php?id=$arr[cid]'>发消息</a><br/>";
}
$qq=$page-1;
if ($page != 1) { 
echo "<a href='".$url."pages=".$qq."'>上一页</a>";
} 
if ($page<$totalPage) { 
$qqw=$page+1;
echo "<a href='".$url."pages=".$qqw."'>下一页</a> ";
}
if ($totalNumber){
echo "第".$page."页/共".$totalPage."页<br/>";
}else{
echo "暂无好友!<br/>";
}
}


echo "<a href='/Friend/index.php'>好友列表</a> <br/>";

echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
?>