<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$userid=$_SESSION['users'];
$id=$_GET['id'];
$my_yes=$_GET['my'];
echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/>";
	$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$id."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
if($zhuangbei){
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei[yuanshi]."'");
$muban_zhuangbei = mysqli_fetch_array($muban_zhuangbei);
$naijiu+=$muban_zhuangbei[naijiu_max]-$zhuangbei[naijiu];
$naijiu_gold=$naijiu*1.69;
$naijiu_gold=ceil($naijiu_gold);

$html=<<<HTML

你有$naijiu 点装备耐久可以一键修复<br/>

修复需要金币：$naijiu_gold
<br/>拥有金币：$user[gold]
<a href='xiufu?my=yes&id=$id'>确认修复</a> 

HTML;

if($my_yes=="yes"){
if($user[gold]<$naijiu_gold){
echo"对不起，金币不足！";
}else{
$user[gold]-=$naijiu_gold;
$sql1="update users set  gold='".$user[gold]."' where id='".$userid."'";
$ok1=mysqli_query($db,$sql1);


$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$id."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei[yuanshi]."'");
$muban_zhuangbei = mysqli_fetch_array($muban_zhuangbei);
$sql1="update zhuangbei set  naijiu='".$muban_zhuangbei[naijiu_max]."' where id='".$id."'";
$ok2=mysqli_query($db,$sql1);

}
//耐久写入结束
	

if($ok2){
echo "修复成功！<br/>";
	$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$id."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei[yuanshi]."'");
$muban_zhuangbei = mysqli_fetch_array($muban_zhuangbei);
$naijiu+=$muban_zhuangbei[naijiu_max]-$zhuangbei[naijiu];
$naijiu_gold=$naijiu*1.69;
$naijiu_gold=ceil($naijiu_gold);

$html=<<<HTML

你有$naijiu 点装备耐久可以一键修复<br/>

修复需要金币：$naijiu_gold
<br/>拥有金币：$user[gold]
<a href='xiufu?my=yes&id=$id'>确认修复</a> 

HTML;
}else{
echo "修复失败！<br/>";
}

}


echo $html;
echo"<br/><a href='/zb/zb.shuxing?id=$id'>返回装备属性页</a>";
}else{
    echo"未知错误";
}



echo footer();

