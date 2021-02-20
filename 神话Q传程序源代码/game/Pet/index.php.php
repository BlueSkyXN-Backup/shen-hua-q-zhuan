<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
$userid=$_SESSION['users'];
$chongwuid=$_GET['id'];
$page=$_GET['page']; 

include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
$perNumber=8;
$url="./index.php?";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from pet WHERE userid='".$userid."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from pet WHERE userid='".$userid."' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你没有宠物<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
  echo "<br/><a href='./pet.php?id=$row[id]'>$row[username]</a>($row[dengji]级)<br/>";
if($row[id]==$user[chongwu_id]){
echo "出战中";
echo "|<a href='./xiuxi.php?id=$row[id]'>休息</a>";

}else{
echo "<a href='./zhaohuan.php?id=$row[id]'>召唤</a>";
echo "|<a href='./fangsheng.php?id=$row[id]'>放生</a>";
}
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
echo "你没有宠物，赶快去野外捕捉心仪的宠物吧！<br/>";
}
}
//计算背包容量

 $chongwu = mysqli_query($db,"SELECT * FROM pet WHERE userid='".$userid."'");
$chongwushu= mysqli_num_rows($chongwu);


$user[chongwu_rongliang]=$chongwushu;
$sql2="update users set chongwu_rongliang='".$user[chongwu_rongliang]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
echo "<br/>----------------<br/>宠物容量：".$user[chongwu_rongliang]."/".$user[chongwu_rongliangmax];


echo "<br/><a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";




?>