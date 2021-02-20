<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$userid=$_SESSION['users'];
$id=$_GET['id'];
$wap=$_GET['wap'];
$page=$_GET['page']; 
$chat=$_GET['chat'];
$tiren=$_GET['tiren'];
 $bangpai_user = mysqli_query($db,"SELECT * FROM bangpai_user WHERE userid='".$userid."'");
$bangpai_user = mysqli_fetch_array($bangpai_user);
$resultl = mysqli_query($db,"SELECT * FROM bangpai WHERE id='".$bangpai_user[bangpaiid]."'");
$my = mysqli_fetch_array($resultl);
if ($my){
}else{
echo"你没有加入帮派！";
echo "<a href='/map.games?id=$npc[map]'>返回地图</a> <br/><br/>";
exit();//结束
}
if(!$chat){
  
  
echo "<a href='/map.games'>返回地图</a><br/>";

//打印成员
//显示基本物品
$perNumber=8;
$page=$_GET['page'];     
$url="chengyuan.php?";
$total=mysqli_num_rows(mysqli_query($db,"select * from bangpai_user WHERE bangpaiid='".$bangpai_user[bangpaiid]."'")); 
$totalNumber=$total; 
//更新帮派人员
  $sql1="update bangpai set shuliang='".$total."' where id='".$bangpai_user[bangpaiid]."'";
$ok1=mysqli_query($db,$sql1);

$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from bangpai_user WHERE bangpaiid='".$bangpai_user[bangpaiid]."' order by time desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你背包里没有物品！<br/>";
}else{
	$bangpai = mysqli_query($db,"SELECT * FROM bangpai WHERE id='".$bangpai_user[bangpaiid]."'");
$bangpai = mysqli_fetch_array($bangpai);
while($row=mysqli_fetch_array($result)){ 
  echo user_name($row[userid]);
  if($row[id]==$bangpai[bangzhu]){
  	echo "(帮主)<br/>";
  }elseif($row[id]==$bangpai[fubangzhu]){
  	echo "(副帮主)";
  }else{
  	echo "(帮众)<br/>";
  }
}

 echo "<br/><br/>";


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
echo "你背包里没有物品！<br/>";
}
}





}else{


	echo head();
echo "<a href='/email/chat'>公聊</a>|<a href='/bangpai/chengyuan.php?chat=43'>帮聊</a>";

  $my=$_GET['my'];  
if ($my=="ok"){

$text=$_POST['txt'];  
if($text==""){
echo "请勿发表空白信息<br/>";
}else{
$text=strip_tags($text);
 $s0="insert into bangpai_email(text,userid,leixing,bangpaiid) values('".$text."','".$userid."','1','".$bangpai_user[bangpaiid]."')";
$ok=mysqli_query($db,$s0);
if ($ok){
echo "信息发送成功！<br/>";
}else{
echo "信息发送失败！<br/>";
}
}
}
echo <<<end
<form action="chengyuan.php?chat=ok&my=ok" method="post" style='margin:0px'>
输入发送内容：<a href='chengyuan.php?chat=o'>刷新</a><br/><textarea name="txt" maxlength="500"></textarea><br/> 
<input type="submit" value="发送信息" class="link"/></form>
end;


//聊天信息分页显示
$perNumber=16; 
$page=$_GET['page']; 
$url="chengyuan.php?chat=o&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from bangpai_email WHERE bangpaiid='".$bangpai_user[bangpaiid]."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from bangpai_email WHERE bangpaiid='".$bangpai_user[bangpaiid]."' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "暂无发言!<br/>";
}else{
	$bangpai = mysqli_query($db,"SELECT * FROM bangpai WHERE id='".$bangpai_user[bangpaiid]."'");
$bangpai = mysqli_fetch_array($bangpai);
while($row=mysqli_fetch_array($result)){ 
$resep = mysqli_query($db,"SELECT * FROM users WHERE id='".$row['userid']."'");
$myp = mysqli_fetch_array($resep);
  if($myp[id]==$bangpai[bangzhu]){
  	echo "(帮主)";
  }elseif($myp[id]==$bangpai[fubangzhu]){
  	echo "(副帮主)";
  }else{
  	echo "(帮众)";
  }
echo user_name($row[userid])."：".$row['text']."<br/>";
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
echo "暂无发言!<br/>";
}
}
}
echo "<br/><a href='index.php'>返回帮派</a> <br/><a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";





echo footer()?>