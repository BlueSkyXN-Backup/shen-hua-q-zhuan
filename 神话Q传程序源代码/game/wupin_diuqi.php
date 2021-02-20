<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
//
$id=$_GET['id'];
$my=$_GET['my'];
$shuliang=$_POST['shuliang'];
$muban = mysqli_query($db,"SELECT * FROM beibao WHERE id='".$id."' and userid='".$userid."' ");
$muban = mysqli_fetch_array($muban);
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$muban[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);

if($my){
  if($muban[shuliang]<$shuliang){
    echo"你没有这么多物品！";
  }else{
  //减去物品
$muban[shuliang]-=$shuliang;
if($muban[shuliang]<"1"){
$sql3 = "delete from beibao where id ='".$id."'";
$ok=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$muban[shuliang]."' where id='".$id."'";
$ok=mysqli_query($db,$sql2);
}  
  if($ok){
    echo "丢弃成功！<br/>";
  }
  
  
  }

}



echo "".$wupin[name]."<br/>----------<br/><br/>".$wupin[text]."<br/>拥有数量：".$muban[shuliang]."<br/>----------<br/>";
echo "<form action='wupin_diuqi?id=$muban[id]&my=yes' method='post'>";
echo "丢弃数量:<br/>";
echo "<input name='shuliang' maxlength='10' value='1'/><br/>";
echo '<input type="submit" value="丢弃" class="submit"/></form>';



echo "<br/><a href='/user.parcel'>我的背包</a> <br/>";

echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";


?>
