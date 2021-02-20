<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$id=$_GET['id'];


$shuliang=$_POST['shuliang'];
if(preg_match('/^[0-9]+$/u',$id)) {
if(preg_match('/^[0-9]+$/u',$shuliang)) {
//这里判断是否数量低于1
if($shuliang<"1"){
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(你最少要购买一件物品哦！);//结束

}
}else{
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(数量只能是数字);//结束
}
}else{
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(未知物品);//结束
}
//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
$row = mysqli_query($db,"SELECT * FROM shangcheng WHERE id='".$id."'");
$row = mysqli_fetch_array($row);
if($row[shangpin_leixing]=="zhuangbei"){
//装备
  
$myp = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$row[shangpin_id]."'");
$myp = mysqli_fetch_array($myp);
}else{
$myp = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[shangpin_id]."'");
$myp = mysqli_fetch_array($myp);
}
if($myp){
}else{
echo "抱歉！你想要购买的商品不存在或者已经下架了！<br/><a href='/Mall/Mall.php'>返回商城</a>";
exit();//结束
}
if($row[huobi]=="shenzhoubi"){
$huobi="神州币";
$huobi_gold="shenzhoubi";
}elseif($row[huobi]=="gold"){
$huobi="金条";
$huobi_gold="gold";
}elseif($row[huobi]=="fuben"){
$huobi="副本积分";
$huobi_gold="fuben";
}elseif($row[huobi]=="xjsj"){
$huobi="心愿水晶";
$huobi_gold="xjsj";
}elseif($row[huobi]=="shsj"){
$huobi="神话水晶";
$huobi_gold="shsj";
}

//判断是否足够金币，进行购买
if($row[shuliang]>=$shuliang){
$row[gold]*=$shuliang;
if($user[$huobi_gold]>=$row[gold]){
$user[$huobi_gold]-=$row[gold];
$sql2="update users set $huobi_gold='".$user[$huobi_gold]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
if($ok){
$suiji=$shuliang;
  
if($row[shangpin_leixing]=="zhuangbei"){  
  for($j=0;$j<$suiji;$j++)
{
//写入装备
$s="insert into zhuangbei(yuanshi,userid,name,text,dengji,naijiu,naijiu_max,leixing) values('".$myp[id]."','".$userid."','".$myp[name]."','".$mypmyp[text]."','".$myp[dengji]."','".$myp[naijiu]."','".$myp[naijiu_max]."','".$myp[leixing]."')";
$ok=mysqli_query($db,$s);
  }
}else{
//物品写入数据库
$my = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and wupin_id='".$row[shangpin_id]."'");
$my = mysqli_fetch_array($my);
if ($my){
$wupin = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$row[shangpin_id]."' and userid='".$userid."'");
$wupin = mysqli_fetch_array($wupin);
$shuliang=$wupin[shuliang];
$shuliang+=$suiji;
$sql4="update beibao set shuliang='".$shuliang."' where wupin_id='".$row[shangpin_id]."' and userid='".$userid."'";
$ok=mysqli_query($db,$sql4);
}else{
$s="insert into beibao(userid,wupin_id,shuliang,jiyu) values('".$userid."','".$row[shangpin_id]."','".$suiji."','yes')";
$ok=mysqli_query($db,$s);
}
}
  
echo "恭喜你成功购买！<br/>$myp[name]已经放入你的背包了！";
$row[shuliang]-=$suiji;
$sql4="update shangcheng set shuliang='".$row[shuliang]."' where id='".$id."'";
$ok=mysqli_query($db,$sql4);
}else{
echo "购买失败";
}
mysqli_query($db,"COMMIT");
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");

}else{
echo "$huobi 不够哦！！！";
}
}else{
echo "商城库存不足";
}

if($row[shei]=="1"){
echo"<a href='/Mall/Mall.php?my=$row[shangpin_leixing]'>返回商城</a><br/>";
}elseif($row[shei]=="2"){
echo"<a href='/Mall/npc.php?my=$row[shangpin_leixing]'>返回商店</a><br/>";	
}elseif($row[shei]=="3"){
echo"<a href='/Mall/fuben.php?my=$row[shangpin_leixing]'>返回商店</a><br/>";	
}elseif($row[shei]=="9"){
echo"<a href='/Mall/shsj?my=$row[shangpin_leixing]'>返回商店</a><br/>";	
}

echo footer();





