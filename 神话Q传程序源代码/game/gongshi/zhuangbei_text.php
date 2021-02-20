<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$id=$_GET['id'];




$wupin = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$id."'");
$wupin = mysqli_fetch_array($wupin);

if($wupin[img]!="0"){
$img="<img src='/img/$wupin[img]'  alt='$wupin[name]' /><br/>";
}
echo "".$wupin[name]."<br/>----------<br/>".$img."<br/>".$wupin[text]."<br/>装备耐久：".$wupin[naijiu_max]."<br/>----------<br/>增加气血：".$wupin[qixue]." <br/>
增加法力：".$wupin[fali]." <br/>
增加防御：".$wupin[fangyu]." <br/>
增加法攻：".$wupin[fagong]." <br/>
增加物攻：".$wupin[wugong]." <br/>
增加速度：".$wupin[sudu]." <br/>";


//判断是否是药品消耗品

echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";




?>
