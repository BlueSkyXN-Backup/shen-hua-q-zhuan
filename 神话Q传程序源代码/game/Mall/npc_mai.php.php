<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$userid=$_SESSION['users'];
$wupinid=$_GET['id'];
$mys=$_GET['my'];
$myss=$_GET['mys'];
$get_leixing=$_GET['leixing'];
$shuliang=$_POST['shuliang'];
$gold=$_POST['gold'];
//定义销售货币
$get_sex=$_POST['sex'];
if($get_sex=="1"){
$sex="gold";
}else{
  $sex="shenzhoubi";
}
if($get_leixing=="1"){
$get_leixing="zhuangbei";
}elseif($get_leixing=="2"){
  $get_leixing="chongwu";
}else{
	$get_leixing="jiben";
}


 echo "<br/><a href='npc_mai.php'>基本</a>|<a href='npc_mai.php?mys=zb'>装备</a>|<a href='npc_mai.php?mys=cl'>材料</a>|<a href='npc_mai.php?mys=sc'>商城</a><br/>";
if($mys=="1"){
//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
mysqli_query($db,"select * from beibao where userid='".$userid."' for update");//锁定该用户的所有物品

$jiaoyi = mysqli_query($db,"SELECT * FROM beibao WHERE id='".$wupinid."' and userid='".$userid."'");
$jiaoyi = mysqli_fetch_array($jiaoyi);

//上架装备定义shuliang
if($get_leixing=="zhuangbei"||$get_leixing=="chongwu"){
	$shuliang="1";
}

if(preg_match('/^[0-9]+$/u',$shuliang)) {
//这里判断是否数量低于1
if($shuliang<"1"){
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(你最少要出售一件物品哦！);//结束
}
}else{
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(数量只能是数字);//结束

}

//这里写执行
if($get_leixing=="jiben"){
//判断是否存在该物品
$resultl = mysqli_query($db,"SELECT * FROM beibao WHERE id='".$wupinid."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){
//物品存在，开始上架物品
if($shuliang>$jiaoyi[shuliang]){
echo"您没有这么多物品哦！";
}else{

$jiaoyi[shuliang]-=$shuliang;
if($jiaoyi[shuliang]<"1"){

$sql3 = "delete from beibao where id ='".$wupinid."'";
$ok1=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$jiaoyi[shuliang]."' where id='".$wupinid."'";
$ok1=mysqli_query($db,$sql2);
}
//获得金币奖励
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$jiaoyi[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
$goldos=$shuliang*$wupin[shoumai];
$user[gold]+=$goldos;
$sql2="update users set gold='".$user[gold]."' where id='".$userid."'";
$ok2=mysqli_query($db,$sql2);
}
}else{
echo"该物品不存在！";
}
}
//上架物品结束
//上架装备
if($get_leixing=="zhuangbei"){
$resultl = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$wupinid."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){
//zhuawgbei存在，开始上架zhuangbei

$sql3 = "delete from zhuangbei where id ='".$wupinid."'";
$ok1=mysqli_query($db,$sql3);
//获得金币奖励
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$my[yuanshi]."'");
$muban_zhuangbei = mysqli_fetch_array($muban_zhuangbei);
$goldos=$shuliang*$muban_zhuangbei[shoumai];
$user[gold]+=$goldos;
$sql2="update users set gold='".$user[gold]."' where id='".$userid."'";
$ok2=mysqli_query($db,$sql2);

}else{
echo"该装备不存在！";
}
}
////上架宠物
if($get_leixing=="chongwu"){
$resultl = mysqli_query($db,"SELECT * FROM pet WHERE id='".$wupinid."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){
//宠物存在，开始上架//判断是否携带装备
$pet_zhuangbei=0;
$pet_zhuangbei+=$my[maozi];
$pet_zhuangbei+=$my[xianglian];
$pet_zhuangbei+=$my[yifu];
$pet_zhuangbei+=$my[wuqi];
$pet_zhuangbei+=$my[xiezi];
$pet_zhuangbei+=$my[ps1];
$pet_zhuangbei+=$my[ps2];
$pet_zhuangbei+=$my[ps3];
$pet_zhuangbei+=$my[ps4];
$pet_zhuangbei+=$my[ps5];
$pet_zhuangbei+=$my[ps3];
$pet_zhuangbei+=$my[ps7];

if($pet_zhuangbei=="0"){
$sql3 = "delete from pet where id ='".$wupinid."'";
$ok1=mysqli_query($db,$sql3);
//添加到上架
$s="insert into jiaoyi(userid,leixing,time,huobi,jiage,chongwu_id,shuliang,chongwu_chengzhanglv,chongwu_dengji,chongwu_jingyan,chongwu_qixue,chongwu_qixuemax,chongwu_fali,chongwu_falimax,chongwu_fangyu,chongwu_fagong,chongwu_wugong,chongwu_sudu) values('".$userid."','chongwu','".time()."','".$sex."','".$gold."','".$my[muban]."','1','".$my[chengzhanglv]."','".$my[dengji]."','".$my[jingyan]."','".$my[qixue]."','".$my[qixuemax]."','".$my[fali]."','".$my[fali_max]."','".$my[fangyu]."','".$my[gongji_fa]."','".$my[gongji]."','".$my[sudu]."')";
$ok2=mysqli_query($db,$s);
}else{
echo"請卸下寵物身上所有装备！";
}

}else{
echo"该宠物不存在！";
}
}


if($ok1 && $ok2){
mysqli_query($db,"COMMIT");
echo"出售成功，获得".$goldos."金条<br/>";
}else{
mysqli_query($db,"ROLLBACK");
echo"出售失败！<br/>";
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");

}







switch($myss){
case"zb":
    //聊天信息分页显示
$perNumber=8;
$page=$_GET['page'];    
$url="npc_mai.php?mys=zb&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from zhuangbei WHERE shiyong='no' and userid='".$userid."' and name like '%$searchs%'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from zhuangbei  WHERE shiyong='no' and userid='".$userid."' and name like '%$searchs%' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你背包里没有装备！<br/>";
}else{
while($zhuangbei=mysqli_fetch_array($result)){ 
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei[yuanshi]."'");
$muban_zhuangbei = mysqli_fetch_array($muban_zhuangbei);
echo "---------------<br/>".zhuangbei_name($zhuangbei[id])."<br/>";
if($muban_zhuangbei[shoumai]!=null){
  echo "<form action='npc_mai.php?id=$zhuangbei[id]&my=1&leixing=1&mys=zb' method='post'>";
echo "单价:$muban_zhuangbei[shoumai]金条<br/>";
echo '<input type="submit" value="出售" class="link"/></form>';
}
}



$qq=$page-1;
if ($page != 1) { 
echo "<a href='".$url."page=".$qq."'>上一页</a>";
} 
if ($page<$totalPage) { 
$qqw=$page+1;
echo "<a href='".$url."page=".$qqw."'>下一页</a> ";
}
if ($totalNumber){
echo "第".$page."页/共".$totalPage."页<br/>";
}else{
echo "你背包里没有装备！<br/>";
}
}


break;

case"cl":
//显示基本物品
$perNumber=8;
$page=$_GET['page'];     
$url="npc_mai.php?mys=cl&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from beibao WHERE userid='".$userid."' and leibie='cailiao'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from beibao WHERE userid='".$userid."' and leibie='cailiao' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你背包里没有物品！<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
  echo "---------------<br/><a href='/wupin.php?id=$row[id]'>$wupin[name]</a>*$row[shuliang]个<br/>";
if($wupin[shoumai]!=null){
  echo "<form action='npc_mai.php?id=$row[id]&my=1&mys=cl' method='post'>";
echo "单价:$wupin[shoumai]金条<br/>";
echo "数量:";
echo "<input name='shuliang' maxlength='10' value='1'/><br/>";
echo '<input type="submit" value="出售" class="link"/></form>';
}
}



$qq=$page-1;
if ($page != 1) { 
echo "<a href='".$url."page=".$qq."'>上一页</a>";
} 
if ($page<$totalPage) { 
$qqw=$page+1;
echo "<a href='".$url."page=".$qqw."'>下一页</a> ";
}
if ($totalNumber){
echo "第".$page."页/共".$totalPage."页<br/>";
}else{
echo "你背包里没有物品！<br/>";
}
}

break;

case"sc":
//显示基本物品
$perNumber=8;
$page=$_GET['page'];     
$url="npc_mai.php?mys=sc&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from beibao WHERE userid='".$userid."' and leibie='shangcheng'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from beibao WHERE userid='".$userid."' and leibie='shangcheng' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你背包里没有物品！<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
  echo "<a href='/wupin.php?id=$row[id]'>$wupin[name]</a>*$row[shuliang]个<br/>";
if($wupin[shoumai]!=null){
  echo "---------------<br/><form action='npc_mai.php?id=$row[id]&my=1&mys=sc' method='post'>";
echo "单价:$wupin[shoumai]金条<br/>";
echo "数量:";
echo "<input name='shuliang' maxlength='10' value='1'/><br/>";
echo '<input type="submit" value="出售" class="link"/></form>';
}
}


$qq=$page-1;
if ($page != 1) { 
echo "<a href='".$url."page=".$qq."'>上一页</a>";
} 
if ($page<$totalPage) { 
$qqw=$page+1;
echo "<a href='".$url."page=".$qqw."'>下一页</a> ";
}
if ($totalNumber){
echo "第".$page."页/共".$totalPage."页<br/>";
}else{
echo "你背包里没有物品！<br/>";
}
}

break;
case"cw":
$perNumber=8;
$url="npc_mai.php?mys=cw&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from pet WHERE userid='".$userid."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from pet WHERE userid='".$userid."' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你没有宠物<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
  echo "<a href='./pet.php?id=$row[id]'>$row[username]</a>($row[dengji]级)<br/>";
echo "<form action='npc_mai.php?id=$row[id]&my=1&leixing=2' method='post'>";

echo "单价:<br/>";
echo "<input name='gold' maxlength='10' value=''/><select name='sex' id='sex'>
<option value='1'>金条</option>
<option value='0'>神州币</option>
</select> <br/>";
echo '<input type="submit" value="确定上架" class="link"/></form>';

}

$qq=$page-1;
if ($page != 1) { 
echo "<a href='".$url."page=".$qq."'>上一页</a>";
} 
if ($page<$totalPage) { 
$qqw=$page+1;
echo "<a href='".$url."page=".$qqw."'>下一页</a> ";
}
if ($totalNumber){
echo "第".$page."页/共".$totalPage."页<br/>";
}else{
echo "你没有宠物，赶快去野外捕捉心仪的宠物吧！<br/>";
}
}
break;
default:
//显示基本物品
$perNumber=8;
$page=$_GET['page'];     
$url="npc_mai.php?";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from beibao WHERE userid='".$userid."' and leibie='jiben'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from beibao WHERE userid='".$userid."' and leibie='jiben' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你背包里没有物品！<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
  echo "---------------<br/><a href='/wupin.php?id=$row[id]'>$wupin[name]</a>*$row[shuliang]个<br/>";
if($wupin[shoumai]!=null){
  echo "<form action='npc_mai.php?id=$row[id]&my=1' method='post'>";
echo "单价:$wupin[shoumai]金条<br/>";
echo "数量:";
echo "<input name='shuliang' maxlength='10' value='1'/><br/>";
echo '<input type="submit" value="出售" class="link"/></form>';
}
}

 

$qq=$page-1;
if ($page != 1) { 
echo "<a href='".$url."page=".$qq."'>上一页</a>";
} 
if ($page<$totalPage) { 
$qqw=$page+1;
echo "<a href='".$url."page=".$qqw."'>下一页</a> ";
}
if ($totalNumber){
echo "第".$page."页/共".$totalPage."页<br/>";
}else{
echo "你背包里没有物品！<br/>";
}
}

   

break;
}
 echo"金条：$user[gold]<br/><br/>温馨提示：买了不退款，卖了不退货。<br/>";


echo "<a href='/map.games?id=$zhuangtai_map'>只是路过</a> <br/>";

echo footer();
?>