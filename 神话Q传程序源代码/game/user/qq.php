<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$my=$_GET[my];
if($my){
$juese= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM juese WHERE id='".$my."' and userid='".$userid."'"));
if($juese){
 $sql1="update users set juese='".$juese[id]."' where id='".$userid."'";
$ok1=mysqli_query($db,$sql1);
if($ok1){
    echo"更换成功。<br/>";
}
}
}
$perNumber=8;
$page=$_GET['page'];     
$url="qq?task=".$searchs."&my=cl&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from juese WHERE userid='".$userid."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from juese WHERE userid='".$userid."' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你未拥有任何角色！<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$wupin = mysqli_query($db,"SELECT * FROM muban_juese WHERE id='".$row[muban]."'");
$wupin = mysqli_fetch_array($wupin);
if($row[time]==null){
    $zhuangtai="(永久)";
}else{
  $row[time]-=time();
   $row[time]/=86400;
    $zhuangtai=ceil($row[time]);
    $zhuangtai="(".$zhuangtai."天)";
}
echo"<img src='/img/juese/$wupin[img]'  height='100'/>";
  echo "<br/>$wupin[name].$zhuangtai";

echo"<a href='qq?my=$row[id]'>更换</a>";
 echo "<br/>------------------------<br/>";
}

 echo "<br/>";


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

echo "<br/><a href='/user/my?'>我的资料</a> <br/>";
echo footer();