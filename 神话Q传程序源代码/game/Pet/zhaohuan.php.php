<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$userid=$_SESSION['users'];
$get_shengji=$_GET['shengji'];
$shuxing=$_GET['shuxing'];
$id=$_GET['id'];

$pet= mysqli_query($db,"SELECT * FROM pet WHERE userid='".$userid."' and id='".$id."'");
$pet = mysqli_fetch_array($pet);
if($pet){
    $muban= mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$pet[muban]."'");
$muban= mysqli_fetch_array($muban);
    if($user[dengji]>=$muban[dengji]){
$sql1="update users set chongwu_id='".$id."' where id='".$userid."'";
$ok=mysqli_query($db,$sql1);
echo "召唤师，你成功召唤了你的宠物！";
}else{
    echo"等级不足！你需要等级达到".$muban[dengji]."级才能够携带该宠物进行战斗！";
    
}
}else{
echo "你没有这个宠物，快醒醒！";
}


echo "<br/><a href='/Pet/index.php?id=$zhuangtai_map'>宠物首页</a> <br/>";

echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
?>