<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$id=$_GET['id'];
$mys=$_GET['my'];



$resultl = mysqli_query($db,"SELECT * FROM duiwu_yaoqing WHERE id='".$id."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){
}else{
echo"没有该邀请！";
echo "<a href='/map.games'>返回地图</a> <br/><br/>";
exit();//结束
}
echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";

$duiwu = mysqli_query($db,"SELECT * FROM duiwu_yaoqing WHERE id='".$id."' and userid='".$userid."'");
$duiwu = mysqli_fetch_array($duiwu);


if($mys=="yes"){
  //同意加入队伍
if($duiwu[zhuangtai]=="0"){
  //执行加入队伍代码
//查看是否已经有队伍
  if($user[duiwu_id]==NULL){
    //没有队伍，查看队伍是否人数满了

 $resultl = mysqli_query($db,"SELECT * FROM users WHERE duiwu_id='".$duiwu[duiwuid]."'");
$duiwushu= mysqli_num_rows($resultl);
    if($duiwushu>="5"){
       echo"队伍人数已满！";
    }else{
    		$map2 = mysqli_query($db,"SELECT * FROM fuben WHERE duiwuid='".$duiwu[duiwuid]."'");
$map2 = mysqli_fetch_array($map2);
	$map3 = mysqli_query($db,"SELECT * FROM maoxian WHERE duiwuid='".$duiwu[duiwuid]."'");
$map3 = mysqli_fetch_array($map3);
if(!$map2 and !$map3){
//加入队伍
      $sql1="update users set  duiwu_id='".$duiwu[duiwuid]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql1);
        //清楚所有队伍邀请
    $sql1="update duiwu_yaoqing set  zhuangtai='1' where userid='".$userid."'";
$ok=mysqli_query($db,$sql1);
        echo"加入成功";
}else{
	echo"加入失败，不能加入正在副本/冒险中的队伍。";
}
    }
  }else{
 echo"你已经拥有队伍了！";
  }
}else{
//该邀请已经处理
   echo"该队伍邀请已经过期！";
}


}else{
//拒绝加入队伍
   //清楚当前队伍邀请
    $sql1="update duiwu_yaoqing set  zhuangtai='1' where userid='".$userid."' and id='".$id."'";
$ok=mysqli_query($db,$sql1);
  echo"拒绝成功";
}







echo "<br/><a href='index.php'>我的队伍</a> <br/>";

echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";
?>