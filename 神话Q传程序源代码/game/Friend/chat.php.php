<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$my=$_GET['my'];
$id=$_GET['id'];
$userid=$_SESSION['users'];
$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);

echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/><br/>";



if ($my=="ok"){
$yourid=$_POST['fid'];
$text=$_POST['txt'];  
$data=time();
if($yourid==$userid){
echo "请勿给自己发送信息<br/>";
}else{
if($text==""){
echo "请勿发表空白信息<br/>";
}else{
     if($user[jinyan]>time()){
echo "你正在被禁言中！<br/>";
}else{
$s="insert into haoyou_email(text,userid,yourid,zhuangtai,time) values('".$text."','".$userid."','".$yourid."','0','".$data."')";
$ok=mysqli_query($db,$s);
if ($ok){
echo "信息发送成功！<br/>";
}else{
echo "信息发送失败！<br/>";
}
}
}
}
}
$resep = mysqli_query($db,"SELECT * FROM users WHERE id='".$id."'");
$myp = mysqli_fetch_array($resep);
echo <<<end
你正在与$myp[username]聊天中：<br/>
<form action="./chat.php?my=ok&id=$id" method="post" style='margin:0px'>
输入发送内容：<a href='./chat.php?id=$id'>刷新</a><br/><textarea name="txt" maxlength="500"></textarea><br/>
<input type="hidden" name="fid" value="$id"/>  
<input type="submit" value="发送" class="submit1"/></form>
end;


//聊天信息分页显示
$perNumber=16; 
$page=$_GET['page']; 
$url="./chat.php?";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from haoyou_email where userid IN('".$userid."','".$id."') and yourid IN('".$userid."','".$id."')")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from haoyou_email where userid IN('".$userid."','".$id."') and yourid IN('".$userid."','".$id."') order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "暂无发言!<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$zaixian_time=time();
$zaixian_time-=$row['time'];
$zaixian_time1=timesecond($zaixian_time);
echo user_name($row['userid'])."说：".$row['text']."(".$zaixian_time1."前)<br/>";

}
//设置为消息已经查看
$sql1="update haoyou_email set zhuangtai='1' where userid='".$id."' && yourid='".$userid."'";
$ok=mysqli_query($db,$sql1);
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
echo "暂无发言!<br/>";
}
}

echo "<a href='/map.games?id=$user[map]'>只是路过</a> <br/><br/>";

echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/><br/>";

?>

