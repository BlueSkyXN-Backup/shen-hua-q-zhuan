<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$id=$_GET['id'];
$get_my=$_GET['my'];

echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";
$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE userid='".$userid."' and id='".$id."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
if ($zhuangbei){
  if($zhuangbei[shiyong]=="no"){
  if($get_my=="yes"){
    $sql3 = "delete from zhuangbei where id ='".$id."'";
$ok=mysqli_query($db,$sql3);
    if ($ok){
       echo "丢弃成功！<br/><br/>";
}else{
       echo "丢弃失败！<br/><br/>";
    }
  }else{
  echo "你正在丢弃$zhuangbei[name]！<br/><a href='./zb.diuqi?id=".$id."&my=yes'>确定丢弃</a> <br/>";
  }
}else{
  echo "不可以丢弃已穿戴装备！<br/><br/>";
}

}else{
echo"该装备不存在！";
echo "<a href='/map.games'>返回地图</a> <br/><br/>";
exit();//结束
}









echo "<br/><a href='/user.parcel?my=zb'>背包</a> <br/>";

echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";
echo footer();
?>