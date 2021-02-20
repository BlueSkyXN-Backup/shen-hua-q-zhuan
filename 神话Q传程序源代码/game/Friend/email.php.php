<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$cid=$_POST['jid'];
$my=$_GET['my'];
//获取是否有未读消息
$resultl = mysqli_query($db,"SELECT * FROM email WHERE zhuangtai='0' and userid='".$userid."'");
$email= mysqli_fetch_array($resultl);
if ($email){
$email_tip="<img src='/img/message.gif'  alt='新消息' />";
}

/********************************************
 wap框架头部变量
 ******************************************/
echo $wapwork->title(消息);

echo "<a href='/Friend/email.php?my=0'>基本</a>|<a href='/Friend/email.php?my=1'>系统".$email_tip."</a>|<a href='/Friend/email.php?my=2'>好友</a> <br/>";

if ($my=="0"){
  //获取用户双倍经验时间
  if($user[buff_jingyan]>time()){
$user[buff_jingyan]-=time();
$jingyan_time=timesecond($user[buff_jingyan]);}else{
  $jingyan_time="双倍经验已过期";
  }
  //获取用户双倍金币时间
  if($user[buff_gold]>time()){
$user[buff_gold]-=time();
$gold_time=timesecond($user[buff_gold]);
  }else{
  $gold_time="双倍金币已过期";
  }
echo "双倍经验时长：$jingyan_time<br/>双倍金币时长：$gold_time";
echo"<br/>人物自动回血：$user[zd_qx1]<br/>人物自动回法：$user[zd_fl1]<br/>宠物自动回血：$user[zd_qx2]<br/>宠物自动回法：$user[zd_fl2]<br/>";
}
if ($my=="1"){

//聊天信息分页显示

$perNumber=10; 
$page=$_GET['page']; 
$url="../Friend/email.php?my=1&amp;";

$total=mysqli_num_rows(mysqli_query($db,"SELECT * FROM email WHERE userid='".$userid."' and leibie='1'")); 
echo $total[0];
$totalNumber=$total; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="SELECT * FROM email WHERE userid='".$userid."' and leibie='1' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "暂无发言!<br/>";
}else{


while($arr=mysqli_fetch_array($result)){ 
echo "[系统]$arr[text]<br/>";
$sql1="update email set  zhuangtai='1' where userid='".$userid."' and leibie='1'";
$ok=mysqli_query($db,$sql1);
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
echo "暂无系统消息!<br/>";
}
}
}


echo "<a href='/Friend/index.php'>好友列表</a> <br/>";

echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
