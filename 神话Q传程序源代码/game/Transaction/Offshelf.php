<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";

include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$userid=$_SESSION['users'];
$wupinid=$_GET['id'];
$mys=$_GET['my'];
$shuliang=$_POST['shuliang'];


if($mys=="1"){
//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
mysqli_query($db,"select * from beibao where userid='".$userid."' for update");//锁定该用户的所有物品
mysqli_query($db,"select * from zhuangbei where userid='".$userid."' for update");//锁定该用户的所有装备
mysqli_query($db,"select * from pet where userid='".$userid."' for update");//锁定该用户的所有宠物
mysqli_query($db,"SELECT * FROM jiaoyi WHERE  userid='".$userid."' and id='".$wupinid."' for update");//锁定该物品



if(preg_match('/^[0-9]+$/u',$wupinid)) {
if(preg_match('/^[0-9]+$/u',$shuliang)) {
//这里判断是否数量低于1
if($shuliang<"1"){
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(你最少要下架一件物品哦！);//结束

}
}else{
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(数量只能是数字);//结束

}
}else{
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(id只能是数字);//结束

}

//这里写执行
//判断是否存在该物品
$jiaoyi = mysqli_query($db,"SELECT * FROM jiaoyi WHERE  userid='".$userid."' and id='".$wupinid."'");
$jiaoyi = mysqli_fetch_array($jiaoyi);
if($jiaoyi){
//物品存在，开始下架物品
if($jiaoyi[leixing]=="jiben"){
if($shuliang>$jiaoyi[shuliang]){
echo"没有这么多的物品出售哦！";
}else{
if($user[beibao_rongliang]<$user[beibao_rongliangmax]){
$jiaoyi[shuliang]-=$shuliang;
if($jiaoyi[shuliang]<"1"){
$sql3 = "delete from jiaoyi where id ='".$wupinid."'";
$ok1=mysqli_query($db,$sql3);
}else{
$sql2="update jiaoyi set shuliang='".$jiaoyi[shuliang]."' where id='".$wupinid."'";
$ok1=mysqli_query($db,$sql2);
}

//物品写入数据库
$my = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and wupin_id='".$jiaoyi[wupin_id]."'");
$my = mysqli_fetch_array($my);
if ($my){
$wupin = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$jiaoyi[wupin_id]."' and userid='".$userid."'");
$wupin = mysqli_fetch_array($wupin);
$suiji=$wupin[shuliang];
$shuliang+=$suiji;
$sql4="update beibao set shuliang='".$shuliang."' where wupin_id='".$jiaoyi[wupin_id]."' and userid='".$userid."'";
$ok2=mysqli_query($db,$sql4);
}else{
$s="insert into beibao(userid,wupin_id,shuliang,jiyu) values('".$userid."','".$jiaoyi[wupin_id]."','".$shuliang."','yes')";
$ok2=mysqli_query($db,$s);
}

}else{
 echo"背包空间已满，请清理背包空间再下架物品！<br/>";
}
}
}
//下架物品结束
//下架装备
if($jiaoyi[leixing]=="zhuangbei"){
if($shuliang>$jiaoyi[shuliang]){
echo"没有这么多的物品出售哦！";
}else{
if($user[beibao_rongliang]<$user[beibao_rongliangmax]){
$sql3 = "delete from jiaoyi where id ='".$wupinid."'";
$ok1=mysqli_query($db,$sql3);
 $muban1 = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$jiaoyi[zhuangbei_id]."'");
$muban1 = mysqli_fetch_array($muban1);
if($jiaoyi[zhuangbei_time]==null){
$s="insert into zhuangbei(yuanshi,userid,name,text,dengji,naijiu,naijiu_max,leixing,qh1,qh2,qh3,qh4,qh5,qh6,xq1,xq2,xq3,xq4,xq5,xq6) values('".$muban1[id]."','".$userid."','".$muban1[name]."','".$muban1[text]."','".$muban1[dengji]."','".$jiaoyi[naijiu]."','".$muban1[naijiu_max]."','".$muban1[leixing]."','".$jiaoyi[qh1]."','".$jiaoyi[qh2]."','".$jiaoyi[qh3]."','".$jiaoyi[qh4]."','".$jiaoyi[qh5]."','".$jiaoyi[qh6]."','".$jiaoyi[xq1]."','".$jiaoyi[xq2]."','".$jiaoyi[xq3]."','".$jiaoyi[xq4]."','".$jiaoyi[xq5]."','".$jiaoyi[xq6]."')";
}else{
    $s="insert into zhuangbei(yuanshi,userid,name,text,dengji,naijiu,naijiu_max,leixing,qh1,qh2,qh3,qh4,qh5,qh6,xq1,xq2,xq3,xq4,xq5,xq6,time) values('".$muban1[id]."','".$userid."','".$muban1[name]."','".$muban1[text]."','".$muban1[dengji]."','".$jiaoyi[naijiu]."','".$muban1[naijiu_max]."','".$muban1[leixing]."','".$jiaoyi[qh1]."','".$jiaoyi[qh2]."','".$jiaoyi[qh3]."','".$jiaoyi[qh4]."','".$jiaoyi[qh5]."','".$jiaoyi[qh6]."','".$jiaoyi[xq1]."','".$jiaoyi[xq2]."','".$jiaoyi[xq3]."','".$jiaoyi[xq4]."','".$jiaoyi[xq5]."','".$jiaoyi[xq6]."','".$jiaoyi[zhuangbei_time]."')";
}
$ok2=mysqli_query($db,$s);
//物品写入数据库

}else{
 echo"背包空间已满，请清理背包空间再下架物品！<br/>";
}
}
}
//下架装备结束
//下架宠物
if($jiaoyi[leixing]=="chongwu"){
if($shuliang>$jiaoyi[shuliang]){
echo"没有这么多的物品出售哦！";
}else{
if($user[chongwu_rongliang]<$user[chongwu_rongliangmax]){
$sql3 = "delete from jiaoyi where id ='".$wupinid."'";
$ok1=mysqli_query($db,$sql3);
  $muban = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$jiaoyi[chongwu_id]."'");
$guaiwu = mysqli_fetch_array($muban);
  $s="insert into pet(muban,userid,username,zhuangtai,chengzhanglv,dengji,jingyan,qixue,qixuemax,fali,fali_max,fangyu,gongji_fa,gongji,sudu) values('".$jiaoyi[chongwu_id]."','".$userid."','".$guaiwu[name]."','yes','".$jiaoyi[chongwu_chengzhanglv]."','".$jiaoyi[chongwu_dengji]."','0','".$jiaoyi[chongwu_qixue]."','".$jiaoyi[chongwu_qixuemax]."','".$jiaoyi[chongwu_fali]."','".$jiaoyi[chongwu_falimax]."','".$jiaoyi[chongwu_fangyu]."','".$jiaoyi[chongwu_fagong]."','".$jiaoyi[chongwu_wugong]."','".$jiaoyi[chongwu_sudu]."')";
$ok2=mysqli_query($db,$s);
}else{
 echo"背包空间已满，请清理背包空间再下架物品！<br/>";
}
}
}
//下架宠物结束
}else{
echo"该物品不存在！";
}


if($ok1 && $ok2){
mysqli_query($db,"COMMIT");
echo"下架成功！";
}else{
mysqli_query($db,"ROLLBACK");
echo"下架失败！";
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");
}
echo"<br/>";

$perNumber=8;
$page=$_GET['page']; 
$url="./Offshelf?";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from jiaoyi WHERE  userid='".$userid."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from jiaoyi WHERE  userid='".$userid."' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你没有上架过物品！<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
if($row[leixing]=="jiben"){
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
}
if($row[leixing]=="zhuangbei"){
$wupin = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$row[zhuangbei_id]."'");
$wupin = mysqli_fetch_array($wupin);
}
if($row[leixing]=="chongwu"){
$wupin = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$row[chongwu_id]."'");
$wupin = mysqli_fetch_array($wupin);
}
if($row[huobi]=="gold"){
	$huobi="金条";
}else{
		$huobi="神州币";
}
  echo "--------------------<br/><a href='./text?id=$row[wupin_id]'>$wupin[name]</a>*$row[shuliang]个<br/>单价:$row[jiage]$huobi";
echo "<form action='Offshelf?id=$row[id]&my=1' method='post'>";
echo "数量:";
echo "<input name='shuliang' maxlength='10' value='$row[shuliang]'/><br/>";
echo '<input type="submit" value="下架" class="link"/></form>';

}

 echo "<br/><br/>";


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
echo "你没有上架物品！<br/>";
}
}

   
echo "<br/><a href='Shelf'>我要出售</a><br/> ";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
?>