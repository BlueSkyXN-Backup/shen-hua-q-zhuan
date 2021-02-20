<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$id=$_GET['id'];
$mys=$_GET['my'];

echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";

$duiwu = mysqli_query($db,"SELECT * FROM duiwu WHERE id='".$user[duiwu_id]."' and duizhang='".$userid."'");
$duiwu = mysqli_fetch_array($duiwu);
	//是否在副本
	$map = mysqli_query($db,"SELECT * FROM fuben WHERE duiwuid='".$user[duiwu_id]."'");
$map = mysqli_fetch_array($map);
if($map){
	echo"你正在副本中不能进行。";
}else{
  if($duiwu){
    $result = mysqli_query($db,"SELECT * FROM users WHERE duiwu_id='".$user[duiwu_id]."'");
while($row = mysqli_fetch_array($result)){
      $sql1="update users set  duiwu_id=NULL where id='".$row[id]."'";
$ok=mysqli_query($db,$sql1);
}
    $sql3 = "delete from duiwu where id ='".$user[duiwu_id]."'";
$ok=mysqli_query($db,$sql3);
    echo"解散成功";
  }else{
echo"退出成功";
        $sql1="update users set  duiwu_id=NULL where id='".$userid."'";
$ok=mysqli_query($db,$sql1);
  }

}









echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";
?>