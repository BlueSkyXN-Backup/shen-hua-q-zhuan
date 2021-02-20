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
//判断是否携带装备
$pet_zhuangbei=0;
$pet_zhuangbei+=$pet[maozi];
$pet_zhuangbei+=$pet[xianglian];
$pet_zhuangbei+=$pet[yifu];
$pet_zhuangbei+=$pet[wuqi];
$pet_zhuangbei+=$pet[xiezi];
$pet_zhuangbei+=$pet[ps1];
$pet_zhuangbei+=$pet[ps2];
$pet_zhuangbei+=$pet[ps3];
$pet_zhuangbei+=$pet[ps4];
$pet_zhuangbei+=$pet[ps5];
$pet_zhuangbei+=$pet[ps3];
$pet_zhuangbei+=$pet[ps7];
$pet_zhuangbei+=$pet[ps8];
$pet_zhuangbei+=$pet[sz1];
$pet_zhuangbei+=$pet[fw1];
$pet_zhuangbei+=$pet[sz2];
$pet_zhuangbei+=$pet[sz3];
$pet_zhuangbei+=$pet[sz4];
$pet_zhuangbei+=$pet[sz5];
$pet_zhuangbei+=$pet[fw2];
$pet_zhuangbei+=$pet[fw3];
$pet_zhuangbei+=$pet[fw4];
$pet_zhuangbei+=$pet[fw5];

if($pet_zhuangbei=="0"){
$sql1="update users set chongwu_id='0' where id='".$userid."'";
$ok=mysqli_query($db,$sql1);
$sql3 = "delete from pet where id ='".$id."'";
$ok=mysqli_query($db,$sql3);
echo "放生成功！";
}else{
echo "请将该宠物身上的所有装备卸下再放生！";
}
}else{
echo "你没有这个宠物，快醒醒！";
}

 $chongwu = mysqli_query($db,"SELECT * FROM pet WHERE userid='".$userid."'");
$chongwushu= mysqli_num_rows($chongwu);


$user[chongwu_rongliang]=$chongwushu;
$sql2="update users set chongwu_rongliang='".$user[chongwu_rongliang]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
echo "<br/><a href='/Pet/index.php?id=$zhuangtai_map'>宠物首页</a> <br/>";

echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
