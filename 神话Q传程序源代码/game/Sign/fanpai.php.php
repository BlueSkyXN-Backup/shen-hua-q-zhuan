<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$fp=$_GET['fp'];
//查看是否进行着新一轮的翻牌
$fanpai = mysqli_query($db,"SELECT * FROM fanpai WHERE userid='".$userid."' and leixing='gold'");
$fanpai = mysqli_fetch_array($fanpai);
$fanpai = mysqli_query($db,"SELECT * FROM fanpai WHERE userid='".$userid."' and leixing='gold'");
$fanpai = mysqli_fetch_array($fanpai);
//不存在新一轮的翻牌
if(!$fanpai){
//设定喜字
$xi=mt_rand(1,9);
for ($x=0; $x<=9; $x++) {
  $xizi[$x]="0";
}
//设定通关喜字
$xizi[$xi]="1";
//在写入数据库
$s="insert into fanpai(userid,leixing,shuliang,jie,fp1,fp2,fp3,fp4,fp5,fp6,fp7,fp8,fp9) values('".$userid."','gold','0','1','".$xizi[1]."','".$xizi[2]."','".$xizi[3]."','".$xizi[4]."','".$xizi[5]."','".$xizi[6]."','".$xizi[7]."','".$xizi[8]."','".$xizi[9]."')";
$ok=mysqli_query($db,$s);

}
$fanpai = mysqli_query($db,"SELECT * FROM fanpai WHERE userid='".$userid."' and leixing='gold'");
$fanpai = mysqli_fetch_array($fanpai);
//设置翻牌需要金条
if($fanpai[jie]=="1"){
$gold="3000";
$gold_jie="第一轮";
	$wupinid_x="63|64|65|70|63|64|65|69|75|1|2|3|6|54|61";
}elseif($fanpai[jie]=="2"){
$gold="10000";
$gold_jie="第二轮";
	$wupinid_x="63|64|65|69|75|1|2|3|6|7|21|63|64|65|70|63|64|65|69|75|1|2|3|6|54|61";
}else{
$gold="100000";
$gold_jie="第三轮";
	$wupinid_x="2|8|9|11|12|15|17|18|20|21|22|23|24|36|36|36|37|38|39|45|64|65|63|64|65|70|63|64|65|69|75|1|2|3|6|54|61";
}

for ($x=1; $x<=$fanpai[shuliang]; $x++) {
  $gold*="2";
}

if(!isset($fp)){
echo "你当前的帐号共有<font color=red>".$user[gold]."</font>金条!<br />";
if($fanpai[fp1]=="2"){
echo "已翻|";
}else{
echo "<a href='fanpai.php?fp=1'>翻牌</a>|";
}
if($fanpai[fp2]=="2"){
echo "已翻|";
}else{
echo "<a href='fanpai.php?fp=2'>翻牌</a>|";
}
if($fanpai[fp3]=="2"){
echo "已翻<br/>";
}else{
echo "<a href='fanpai.php?fp=3'>翻牌</a><br/>";
}
if($fanpai[fp4]=="2"){
echo "已翻|";
}else{
echo "<a href='fanpai.php?fp=4'>翻牌</a>|";
}
if($fanpai[fp5]=="2"){
echo "已翻|";
}else{
echo "<a href='fanpai.php?fp=5'>翻牌</a>|";
}
if($fanpai[fp6]=="2"){
echo "已翻<br/>";
}else{
echo "<a href='fanpai.php?fp=6'>翻牌</a><br/>";
}
if($fanpai[fp7]=="2"){
echo "已翻|";
}else{
echo "<a href='fanpai.php?fp=7'>翻牌</a>|";
}
if($fanpai[fp8]=="2"){
echo "已翻|";
}else{
echo "<a href='fanpai.php?fp=8'>翻牌</a>|";
}
if($fanpai[fp9]=="2"){
echo "已翻<br/>";
}else{
echo "<a href='fanpai.php?fp=9'>翻牌</a><br/>";
}


echo "<br/>
---------------
<br/>当前：".$gold_jie."金条翻牌区<br/>当前翻牌需要：<font color=blue>".$gold."</font>金条！<br/>说明:每次翻牌消耗金币，翻牌金条逐步递增，一共三个关卡。翻中喜字获得本轮大奖并进入下一关！";
echo "<br/><a href='fanpai_index.php'>切换翻牌</a>";

echo footer()."<br/><a href='/map.games?id=$user[map]'>返回地图</a>";
}
if(isset($fp)){
$fanpai = mysqli_query($db,"SELECT * FROM fanpai WHERE userid='".$userid."' and leixing='gold'");
$fanpai = mysqli_fetch_array($fanpai);
if($fp>"9"||$fp<"1"){
$fp="9";
}

if($user[gold]<$gold){
echo "对不起.你的金币少于".$gold."<br/>你可以购买<a href='/Mall/Introduce.php?id=26'>钱匣子</a>获得金条！";
echo "<br/><a href='fanpai_xy.php'>翻牌首页</a>";
echo footer()."<br/><a href='/map.games?id=$user[map]'>返回地图</a>";
}else{
$user[gold]-=$gold;
mysqli_query($db,"UPDATE users SET gold='$user[gold]' WHERE id='$userid'");
if($fanpai['fp'.$fp]=="1"){
//翻拍通过
if($fanpai[jie]=="1"){
	$fanpaijie="2";
	$wupin_id="72";
	$xi_tip="翻出喜字，获得	
一阶金条祝福箱*1。进入第二阶金条翻牌！";
}elseif($fanpai[jie]=="2"){
		$fanpaijie="3";
		$wupin_id="73";
		$xi_tip="翻出喜字，获得	
二阶金条祝福箱*1。进入第三阶金条翻牌！";
}else{
		$fanpaijie="1";
		$wupin_id="74";
		$xi_tip="翻出喜字，获得本轮终极大奖：神秘金条祝福箱*1。";
}
$s="insert into news(text,time,userid) values('在".$gold_jie."金条翻牌".$xi_tip."','".$pass."','$userid')";
$ok=mysqli_query($db,$s);
$xi=mt_rand(1,9);
for ($x=0; $x<=9; $x++) {
  $xizi[$x]="0";
}
//设定通关喜字
$xizi[$xi]="1";
//在写入数据库
//删除
$sql3 = "delete from fanpai where userid ='".$userid."' and leixing='gold'";
$ok=mysqli_query($db,$sql3);
//写入
$s="insert into fanpai(userid,leixing,shuliang,jie,fp1,fp2,fp3,fp4,fp5,fp6,fp7,fp8,fp9) values('".$userid."','gold','0','".$fanpaijie."','".$xizi[1]."','".$xizi[2]."','".$xizi[3]."','".$xizi[4]."','".$xizi[5]."','".$xizi[6]."','".$xizi[7]."','".$xizi[8]."','".$xizi[9]."')";
$ok=mysqli_query($db,$s);
//写入喜字奖励
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
//物品写入数据库
$my = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and wupin_id='".$wupin_id."'");
$my = mysqli_fetch_array($my);
if ($my){
$wupin = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$wupin_id."' and userid='".$userid."'");
$wupin = mysqli_fetch_array($wupin);
$shuliang=$wupin[shuliang];
$shuliang+="1";
$sql4="update beibao set shuliang='".$shuliang."' where wupin_id='".$wupin_id."' and userid='".$userid."'";
$ok=mysqli_query($db,$sql4);
}else{
$s="insert into beibao(userid,wupin_id,shuliang,jiyu) values('".$userid."','".$wupin_id."','1','yes')";
$ok=mysqli_query($db,$s);
}
mysqli_query($db,"COMMIT");//数据提交
//数据回滚mysqli_query($db,"ROLLBACK");
mysqli_query($db,"END"); 


echo $xi_tip;

}elseif($fanpai['fp'.$fp]=="2"){
echo "当前卡片已经被翻过了!";
}else{
	//定义随机一个奖励

	$wupinids = explode("|", $wupinid_x);
	$suijiidshu=count($wupinids);
	$suijiidshu-="1";
	$suijiid=mt_rand(0,$suijiidshu);
	
//写入不中奖励
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
//物品写入数据库
$my = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and wupin_id='".$wupinids[$suijiid]."'");
$my = mysqli_fetch_array($my);
if ($my){
$wupin = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$wupinids[$suijiid]."' and userid='".$userid."'");
$wupin = mysqli_fetch_array($wupin);
$shuliang=$wupin[shuliang];
$shuliang+="1";
$sql4="update beibao set shuliang='".$shuliang."' where wupin_id='".$wupinids[$suijiid]."' and userid='".$userid."'";
$ok=mysqli_query($db,$sql4);
}else{
$s="insert into beibao(userid,wupin_id,shuliang,jiyu) values('".$userid."','".$wupinids[$suijiid]."','1','yes')";
$ok=mysqli_query($db,$s);
}

mysqli_query($db,"COMMIT");//数据提交
//数据回滚mysqli_query($db,"ROLLBACK");
mysqli_query($db,"END"); 
mysqli_query($db,"SET AUTOCOMMIT=1");//开启自动提交
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$wupinids[$suijiid]."'");
$wupin = mysqli_fetch_array($wupin);
echo "获得".$wupin[name]."*1";
$fanpaimysqli='fp'.$fp;
$fanpai[shuliang]+="1";
mysqli_query($db,"UPDATE fanpai SET ".$fanpaimysqli."='2',shuliang='".$fanpai[shuliang]."' WHERE leixing='gold' and userid='".$userid."'");//更新翻牌进度
}
echo "<br/><a href='fanpai.php'>继续翻牌</a>";

echo "<br />你当前的帐号共有<font color=red>".$user[gold]."</font>金币!";

echo "<br/><a href='fanpai.php'>翻牌首页</a><br/>";

echo footer()."<br/><a href='/map.games?id=$user[map]'>返回地图</a>";

}
}
?>