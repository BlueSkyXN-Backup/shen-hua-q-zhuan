<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
//
$id=$_GET['id'];

$_SESSION['parcel']=md5(date("Y-m-d H:i:s"));
$parcel=$_SESSION['parcel'];

$muban = mysqli_query($db,"SELECT * FROM beibao WHERE id='".$id."'");
$muban = mysqli_fetch_array($muban);
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$muban[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);

if($wupin[img]!="0"){
$img="<img src='/img/$wupin[img]'  height='100'/><br/>";
}
echo "".$wupin[name]."<br/>----------<br/>".$img."<br/>".$wupin[text]."<br/>物品体积：".$wupin[tiji]."<br/>----------<br/>";
if($wupin[xiaohao]=="yes"){
echo"<a href='/user.parcel?shiyong=yes&id=$muban[id]&parcel=$parcel'>使用</a>";
}
if($wupin[libao]=="yes"){
echo"<a href='/user.parcel?shiyong=yes&id=$muban[id]&parcel=$parcel'>使用</a>";
}
echo"<a href='/wupin_diuqi?id=$muban[id]&page=".$page."'>丢弃</a>";





echo "<br/><a href='/user.parcel'>我的背包</a> <br/>";

echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";

?>
