<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

  echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
$userid=$_SESSION['users'];
$wupinid=$_GET['id'];
$npcid=$_GET['npcid'];
$mys=$_GET['my'];
$myss=$_GET['mys'];
$page=$_GET['page'];
$get_leixing=$_GET['leixing'];
$shuliang=$_POST['shuliang'];
$gold=$_POST['gold'];
$searchs=$_GET['task'];

$haoyou_1=mysqli_fetch_array(mysqli_query($db,"SELECT * FROM haoyou WHERE userid='".$userid."' and cid='".$npcid."'"));
$haoyou_2=mysqli_fetch_array(mysqli_query($db,"SELECT * FROM haoyou WHERE userid='".$npcid."' and cid='".$userid."'"));
if($haoyou_1 && $haoyou_2){
if(!preg_match('/^[0-9]+$/u',$npcid)){
  echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";

exit(用户错误);//结束
}
//设置不能给自己东西
	if($userid==$npcid){
echo"给自己物品这种操作简直多此一举！<br/>";
}else{

$resultl = mysqli_query($db,"SELECT * FROM users WHERE id='".$npcid."'");
$my = mysqli_fetch_array($resultl);
if ($my){
}else{
echo"该用户不存在！";
echo "<a href='/map.games?id=$npc[map]'>返回地图</a> <br/><br/>";
exit();//结束
}
$npc = mysqli_query($db,"SELECT * FROM users WHERE id='".$npcid."'");
$npc = mysqli_fetch_array($npc);
echo"你正在给予物品给$npc[username]<br/>";
//定义给予类型
if($get_leixing=="1"){
$get_leixing="zhuangbei";
}elseif($get_leixing=="2"){
  $get_leixing="chongwu";
}elseif($get_leixing=="5"){
  $get_leixing="jintiao";
}else{
	$get_leixing="jiben";
}
 echo "<br/><a href='index.give?npcid=$npcid'>基本</a>|<a href='index.give?npcid=$npcid&mys=zb'>装备</a>|<a href='index.give?npcid=$npcid&mys=cl'>材料</a>|<a href='index.give?npcid=$npcid&mys=sc'>商城</a>|<a href='index.give?npcid=$npcid&mys=cw'>宠物</a>|<a href='index.give?npcid=$npcid&mys=jt'>游戏币</a><br/>";
   
echo "<form action='index.give' method='get'>";
echo "<input name='task' maxlength='100' value='$searchs'/>";
echo"<input type='hidden' name='mys' value='$myss'>";
echo"<input type='hidden' name='npcid' value='$npcid'>";
echo '<input type="submit" value="搜索" class="link"/></form>';
if($mys=="1"){
//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
mysqli_query($db,"select * from beibao where userid='".$userid."' for update");//锁定该用户的所有物品

//上架装备定义shuliang
if($get_leixing=="zhuangbei"||$get_leixing=="chongwu"){
	$shuliang="1";
}
if(preg_match('/^[0-9]+$/u',$shuliang)) {
//这里判断是否数量低于1
if($shuliang<"1"){
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(你最少要上架一件物品哦！);//结束

}
}else{
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(数量只能是数字);//结束

}

//这里写执行
if($get_leixing=="jiben"){
  //判断是否存在该物品
  $jiaoyi = mysqli_query($db,"SELECT * FROM beibao WHERE id='".$wupinid."' and userid='".$userid."'");
$jiaoyi = mysqli_fetch_array($jiaoyi);

if ($jiaoyi){
//物品存在，开始上架物品
if($shuliang>$jiaoyi[shuliang]){
echo"您没有这么多物品哦！";
}else{

$jiaoyi[shuliang]-=$shuliang;
  $jiyu_shuliang=$shuliang;
if($jiaoyi[shuliang]<"1"){

$sql3 = "delete from beibao where id ='".$wupinid."'";
$ok1=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$jiaoyi[shuliang]."' where id='".$wupinid."'";
$ok1=mysqli_query($db,$sql2);
}

  $new_wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$jiaoyi[wupin_id]."'");
$wupintiji = mysqli_fetch_array($new_wupin);
if($jiaoyi[wupin_id]=="39"||$jiaoyi[wupin_id]=="231"){
	if($jiaoyi[wupin_id]=="39"){
		$haogandu=$jiyu_shuliang*2;
	}elseif($jiaoyi[wupin_id]=="231"){
		$haogandu=$jiyu_shuliang*13;
	}
	$qinglv=mysqli_fetch_array(mysqli_query($db,"select * from qinglv where nan IN('".$npcid."','".$userid."') or nv IN('".$npcid."','".$userid."')"));
    if($qinglv){
    
        $qinglv[enai]+=$haogandu;
        $sql2="update qinglv set enai='".$qinglv[enai]."' where id='".$qinglv[id]."'";
$ok1=mysqli_query($db,$sql2);
        
    }
  $s="insert into email(text,userid,leibie,zhuangtai) values('<a href=\"/user/user?id=$user[id]\">".$user[username]."</a>赠予您".$jiyu_shuliang."件".$wupintiji[name].",别傻兮兮的去背包寻找了，".$wupintiji[name]."已经转化为你们之间的友好度了。','".$npcid."','1','0')";
$ok2=mysqli_query($db,$s);
}else{
//把物品给对方
$wupintiji[tiji]*=$shuliang;
$npc[beibao_rongliang]+=$wupintiji[tiji];
if($npc[beibao_rongliang]<=$npc[beibao_rongliangmax]){
  $sql2="update users set beibao_rongliang='".$npc[beibao_rongliang]."' where id='".$npcid."'";
$okrongliang=mysqli_query($db,$sql2);
$my = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$npcid."' and wupin_id='".$jiaoyi[wupin_id]."'");
$my = mysqli_fetch_array($my);
if ($my){
$wupin = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$jiaoyi[wupin_id]."' and userid='".$npcid."'");
$wupin = mysqli_fetch_array($wupin);
$suiji=$wupin[shuliang];
$shuliang+=$suiji;
$sql4="update beibao set shuliang='".$shuliang."' where wupin_id='".$jiaoyi[wupin_id]."' and userid='".$npcid."'";
$ok2=mysqli_query($db,$sql4);
}else{
$s="insert into beibao(userid,wupin_id,shuliang,jiyu) values('".$npcid."','".$jiaoyi[wupin_id]."','".$shuliang."','yes')";
$ok2=mysqli_query($db,$s);
}


  //告诉玩家给予了你东西
  if($userid=="1"){
$s="insert into email(text,userid,leibie,zhuangtai) values('获得系统奖励：【".$wupintiji[name]."】".$jiyu_shuliang."件。','".$npcid."','1','0')";
}else{

  $s="insert into email(text,userid,leibie,zhuangtai) values('<a href=\"/user/user?id=$user[id]\">".$user[username]."</a>给予你【".$wupintiji[name]."】".$jiyu_shuliang."件。','".$npcid."','1','0')";
}
$ok5=mysqli_query($db,$s);
}else{
  echo "对方背包容量不足";
}
  
}

}
}else{
echo"该物品不存在！";
}
}
//上架物品结束




//金条
if($get_leixing=="jintiao"){
	if($shuliang<"20001"){
	if($user[gold]>=$shuliang){
	$user[gold]-=$shuliang;
  	$npc[gold]+=$shuliang;
  	if($userid!=$npcid){
$sql2="update users set gold='".$user[gold]."' where id='".$userid."'";
$ok1=mysqli_query($db,$sql2);
$sql2="update users set gold='".$npc[gold]."' where id='".$npcid."'";
$ok2=mysqli_query($db,$sql2);
}else{
		echo"不能给自己金条。";
}
//告诉玩家给予了你东西
  $s="insert into email(text,userid,leibie,zhuangtai) values('<a href=\"/user/user?id=$user[id]\">".$user[username]."</a>给予你".$shuliang."个金条。','".$npcid."','1','0')";
$ok2=mysqli_query($db,$s);
}else{
	echo"金币不足";
}
}else{
	echo"单次最多只能给予2万金币！";
}
}
//上架物品结束

//上架装备
if($get_leixing=="zhuangbei"){
$resultl = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$wupinid."' and userid='".$userid."'");
$jiaoyi= mysqli_fetch_array($resultl);
if ($jiaoyi){
//zhuawgbei存在，开始上架zhuangbei

//开始给
  $new_wupin = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$jiaoyi[yuanshi]."'");
$wupintiji = mysqli_fetch_array($new_wupin);
$wupintiji[tiji]*=$shuliang;
$npc[beibao_rongliang]+=$wupintiji[tiji];
if($npc[beibao_rongliang]<=$npc[beibao_rongliangmax]){
$sql2="update users set beibao_rongliang='".$npc[beibao_rongliang]."' where id='".$npcid."'";
$okrongliang=mysqli_query($db,$sql2);
 
$sql1="update zhuangbei set  userid='".$npcid."' where id='".$wupinid."'";
$ok1=mysqli_query($db,$sql1);
    //告诉玩家给予了你东西
   if($userid=="1"){
   $s="insert into email(text,userid,leibie,zhuangtai) values('获得系统奖励：【".$wupintiji[name]."】".$shuliang."件。','".$npcid."','1','0')";
}else{
    $s="insert into email(text,userid,leibie,zhuangtai) values('<a href=\"/user/user?id=$user[id]\">".$user[username]."</a>给予你【".$wupintiji[name]."】".$shuliang."件。','".$npcid."','1','0')";
}
$ok2=mysqli_query($db,$s);
}else{
echo "背包空间不足";
}

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
  
$npc[chongwu_rongliang]+="1";
if($npc[chongwu_rongliang]<=$npc[chongwu_rongliangmax]){
$sql2="update users set chongwu_rongliang='".$npc[chongwu_rongliang]."' where id='".$npcid."'";
  $okrongliang=mysqli_query($db,$sql2);
$sql1="update pet set  userid='".$npcid."' where id='".$wupinid."'";
$ok1=mysqli_query($db,$sql1);
    //告诉玩家给予了你东西
  $s="insert into email(text,userid,leibie,zhuangtai) values('<a href=\"/user/user?id=$user[id]\">".$user[username]."</a>给予你【".$my[username]."】".$shuliang."只。','".$npcid."','1','0')";
$ok2=mysqli_query($db,$s);
}else{
echo "对方宠物栏空位不足";
}
}else{
echo"請卸下寵物身上所有装备！";
}

}else{
echo"该宠物不存在！";
}
}


if($ok1 && $ok2){
mysqli_query($db,"COMMIT");
echo"给予成功！";
}else{
mysqli_query($db,"ROLLBACK");
echo"给予失败！";
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");

}

//定义物品类别
$result = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."'");
while($row = mysqli_fetch_array($result))
  {
  $wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);

if(!$row[leibie]){
$sql4="update beibao set name='".$wupin[name]."' , leibie='".$wupin[leibie]."' where id='".$row[id]."' and userid='".$userid."'";

$ok=mysqli_query($db,$sql4);
}
  }


switch($myss){
case"zb":
    //聊天信息分页显示
$perNumber=8;
    $page=$_GET['page'];   
$url="index.give?task=".$searchs."&mys=zb&npcid=$npcid&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from zhuangbei WHERE jiyu='yes' and shiyong='no' and userid='".$userid."' and time is null and name like '%$searchs%'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from zhuangbei  WHERE jiyu='yes' and shiyong='no' and userid='".$userid."' and time is null and name like '%$searchs%' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你背包里没有装备！<br/>";
}else{
while($zhuangbei=mysqli_fetch_array($result)){ 

$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei[yuanshi]."'");
$muban_zhuangbei = mysqli_fetch_array($muban_zhuangbei);


 echo "<br/>".zhuangbei_name($zhuangbei[id])."<br/>";

if($muban_zhuangbei[jiyu]=="yes"){
echo "<form action='index.give?mys=zb&id=$zhuangbei[id]&my=1&leixing=1&npcid=$npcid' method='post'>";

echo '<input type="submit" value="确定给予" class="link"/></form>';
}else{

if($userid=="1" || $npcid=="1"){
echo "<form action='index.give?mys=zb&id=$zhuangbei[id]&my=1&leixing=1&npcid=$npcid' method='post'>";

echo '<input type="submit" value="确定给予" class="link"/></form>';
}
}
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
echo "你背包里没有装备！<br/>";
}
}


break;

case"cl":
//显示基本物品
$perNumber=8;
$page=$_GET['page'];     
$url="index.give?task=".$searchs."&mys=cl&npcid=$npcid&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from beibao WHERE userid='".$userid."' and leibie='cailiao' and name like '%$searchs%'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from beibao WHERE userid='".$userid."' and leibie='cailiao' and name like '%$searchs%' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你背包里没有物品！<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);


  echo "<br/><a href='wupin.php?id=$row[id]'>$wupin[name]</a>*$row[shuliang]个<br/>";
if($wupin[jiyu]=="yes"){
echo "<form action='index.give?mys=cl&id=$row[id]&my=1&npcid=$npcid' method='post'>";
echo "数量:<br/>";
echo "<input name='shuliang' maxlength='10' value='$row[shuliang]'/><br/>";
echo '<input type="submit" value="确定给予" class="link"/></form>';
}else{

if($userid=="1" || $npcid=="1"){
echo "<form action='index.give?mys=cl&id=$row[id]&my=1&npcid=$npcid' method='post'>";
echo "数量:<br/>";
echo "<input name='shuliang' maxlength='10' value='$row[shuliang]'/><br/>";
echo '<input type="submit" value="确定给予" class="link"/></form>';

}
}
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
echo "你背包里没有物品！<br/>";
}
}

break;

case"sc":
//显示基本物品
$perNumber=8;
$page=$_GET['page'];     
$url="index.give?task=".$searchs."&mys=sc&npcid=$npcid&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from beibao WHERE userid='".$userid."' and leibie='shangcheng'and name like '%$searchs%'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from beibao WHERE userid='".$userid."' and leibie='shangcheng' and name like '%$searchs%' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你背包里没有物品！<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);


  echo "<br/><a href='wupin.php?id=$row[id]'>$wupin[name]</a>*$row[shuliang]个<br/>";
if($wupin[jiyu]=="yes"){
echo "<form action='index.give?mys=sc&id=$row[id]&my=1&npcid=$npcid' method='post'>";
echo "数量:<br/>";
echo "<input name='shuliang' maxlength='10' value='$row[shuliang]'/><br/>";

echo '<input type="submit" value="确定给予" class="link"/></form>';
}else{

if($userid=="1" || $npcid=="1"){

echo "<form action='index.give?mys=sc&id=$row[id]&my=1&npcid=$npcid' method='post'>";
echo "数量:<br/>";
echo "<input name='shuliang' maxlength='10' value='$row[shuliang]'/><br/>";

echo '<input type="submit" value="确定给予" class="link"/></form>';

}
}
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
echo "你背包里没有物品！<br/>";
}
}

break;
case"cw":
    $page=$_GET['page']; 
$perNumber=8;
$url="index.give?task=".$searchs."&mys=cw&npcid=$npcid&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from pet WHERE userid='".$userid."' and username like '%$searchs%'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from pet WHERE userid='".$userid."' and username like '%$searchs%' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你没有宠物<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
  echo "<br/><a href='./pet.php?id=$row[id]'>$row[username]</a>($row[dengji]级)<br/>";
echo "<form action='index.give?mys=cw&&id=$row[id]&my=1&leixing=2&npcid=$npcid' method='post'>";

echo '<input type="submit" value="确定给予" class="link"/></form>';

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
case"jt":
  echo "<br/>拥有金条$user[gold]<br/>";
echo "<form action='index.give?mys=jt&&id=$row[id]&my=1&leixing=5&npcid=$npcid' method='post'>";
echo "给予数量:<br/>";
echo "<input name='shuliang' maxlength='10' value='$row[shuliang]'/><br/>";

echo '<input type="submit" value="确定给予" class="link"/></form>';
break;
default:
//显示基本物品
$perNumber=8;
$page=$_GET['page'];     
$url="index.give?task=".$searchs."&npcid=$npcid&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from beibao WHERE userid='".$userid."' and leibie='jiben'and name like '%$searchs%'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from beibao WHERE userid='".$userid."' and leibie='jiben' and name like '%$searchs%' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你背包里没有物品！<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
  echo "<br/><a href='/wupin.php?id=$row[id]'>$wupin[name]</a>*$row[shuliang]个<br/>";

  if($wupin[jiyu]=="yes"){
    echo "<form action='index.give?id=$row[id]&my=1&npcid=$npcid' method='post'>";
echo "数量:<br/>";
echo "<input name='shuliang' maxlength='10' value='$row[shuliang]'/><br/>";

echo '<input type="submit" value="确定给予" class="link"/></form>';
}else{

if($userid=="1" || $npcid=="1"){
 echo "<form action='index.give?id=$row[id]&my=1&npcid=$npcid' method='post'>";
echo "数量:<br/>";
echo "<input name='shuliang' maxlength='10' value='$row[shuliang]'/><br/>";

echo '<input type="submit" value="确定给予" class="link"/></form>';

}
}
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
echo "你背包里没有物品！<br/>";
}
}

   

break;
}


}
}else{
    echo"非双向好友，不可给予！请双方先添加好友吧！";
}

  echo "<br/><a href='/user/user?id=$npcid'>用户资料</a><br/> ";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
