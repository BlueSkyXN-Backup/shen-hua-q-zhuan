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
$get_huobi=$_GET['huobi'];
$task=$_GET['task'];
$get_zhonglei=$_GET['zhonglei'];
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a><br/>";
//获取指定销售货币内容
switch($get_huobi){
case"3":
$huobi="jingyan";//金条购买
 $get_huobi="3";
        $huobi_name="经验";
break;
case"2":
$huobi="shenzhoubi";//神州币购买
     $get_huobi="2";
        $huobi_name="神州币";
break;
default:
$huobi="gold";//经验购买
     $get_huobi="1";
        $huobi_name="金币";
break;
}
//获取是宠物、装备、还是物品
switch($get_zhonglei){
case"3":
$zhonglei="chongwu";//宠物
    $get_zhonglei="3";
break;
case"2":
$zhonglei="zhuangbei";//装备
      $get_zhonglei="2";
break;
default:
$zhonglei="jiben";//物品
      $get_zhonglei="1";
break;
}


echo "筛选:<a href='/Transaction/list?huobi=".$get_huobi."&zhonglei=1'>物品</a>|<a href='/Transaction/list?huobi=".$get_huobi."&zhonglei=2'>装备</a>|<a href='/Transaction/list?huobi=".$get_huobi."&zhonglei=3'>宠物</a><br/> ";
echo "<form action='./list?huobi=".$get_huobi."&zhonglei=".$get_zhonglei."&' method='get'>";
echo "搜物品<br/>";
echo "<input name='task' maxlength='100' value='$task'/>";
echo"<input type='hidden' name='huobi' value='$get_huobi'>";
echo"<input type='hidden' name='zhonglei' value='$get_zhonglei'>";
echo '<input type="submit" value="搜索" class="link"/></form>';
//echo "<br/>筛选:<a href='/Transaction/list?huobi=1&zhonglei=".$get_zhonglei."'>金条</a>|<a href='/Transaction/list?huobi=2&zhonglei=".$get_zhonglei."'>神州币</a>|<a href='/Transaction/list?huobi=3&zhonglei=".$get_zhonglei."'>经验</a><br/> ";
if($mys=="1"){
//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
mysqli_query($db,"SELECT * FROM jiaoyi WHERE id='".$wupinid."'");
mysqli_query($db,"select * from beibao where userid='".$userid."'");//锁定该用户的所有物品

//给系统消息
$new_shuliang=$shuliang;
$jiaoyi = mysqli_query($db,"SELECT * FROM jiaoyi WHERE id='".$wupinid."'");
$jiaoyi = mysqli_fetch_array($jiaoyi);
$jiaoyihuobi=$jiaoyi[huobi];


if(preg_match('/^[0-9]+$/u',$wupinid)) {
if(preg_match('/^[0-9]+$/u',$shuliang)) {
//这里判断是否数量低于1
if($shuliang<"1"){
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(你最少要购买一件物品哦！);//结束

}else{
if($shuliang>"100"){
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(你单次只能购买100件！);//结束
}	
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
if($jiaoyi){

//物品存在，开始上架物品
if($shuliang>$jiaoyi[shuliang]){
echo"没有这么多的物品出售哦！";
}else{
    
$jiage=$jiaoyi[jiage];
$jiage*=$shuliang;

if($jiage<=$user[$jiaoyihuobi]){


$jiaoyi[shuliang]-=$shuliang;
if($jiaoyi[shuliang]<"1"){

$sql3 = "delete from jiaoyi where id ='".$wupinid."'";
$ok1=mysqli_query($db,$sql3);
}else{
$sql2="update jiaoyi set shuliang='".$jiaoyi[shuliang]."' where id='".$wupinid."'";
$ok1=mysqli_query($db,$sql2);
}

//物品写入数据库
if($jiaoyi[leixing]=="jiben"){
$new_wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$jiaoyi[wupin_id]."'");
$wupintiji = mysqli_fetch_array($new_wupin);
$wupintiji[tiji]*=$shuliang;
$user[beibao_rongliang]+=$wupintiji[tiji];
if($user[beibao_rongliang]<=$user[beibao_rongliangmax]){
$sql2="update users set beibao_rongliang='".$user[beibao_rongliang]."' where id='".$userid."'";
$okrongliang=mysqli_query($db,$sql2);
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
echo "背包容量不足";
}
}
//装备写入数据库
if($jiaoyi[leixing]=="zhuangbei"){
$new_wupin = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$jiaoyi[zhuangbei_id]."'");
$wupintiji = mysqli_fetch_array($new_wupin);
$wupintiji[tiji]*=$shuliang;
$user[beibao_rongliang]+=$wupintiji[tiji];
if($user[beibao_rongliang]<=$user[beibao_rongliangmax]){
$sql2="update users set beibao_rongliang='".$user[beibao_rongliang]."' where id='".$userid."'";
$okrongliang=mysqli_query($db,$sql2);
  $muban1 = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$jiaoyi[zhuangbei_id]."'");
$muban1 = mysqli_fetch_array($muban1);
if($jiaoyi[zhuangbei_time]==null){
$s="insert into zhuangbei(yuanshi,userid,name,text,dengji,naijiu,naijiu_max,leixing,qh1,qh2,qh3,qh4,qh5,qh6,xq1,xq2,xq3,xq4,xq5,xq6) values('".$muban1[id]."','".$userid."','".$muban1[name]."','".$muban1[text]."','".$muban1[dengji]."','".$jiaoyi[naijiu]."','".$muban1[naijiu_max]."','".$muban1[leixing]."','".$jiaoyi[qh1]."','".$jiaoyi[qh2]."','".$jiaoyi[qh3]."','".$jiaoyi[qh4]."','".$jiaoyi[qh5]."','".$jiaoyi[qh6]."','".$jiaoyi[xq1]."','".$jiaoyi[xq2]."','".$jiaoyi[xq3]."','".$jiaoyi[xq4]."','".$jiaoyi[xq5]."','".$jiaoyi[xq6]."')";
}else{
   $s="insert into zhuangbei(yuanshi,userid,name,text,dengji,naijiu,naijiu_max,leixing,qh1,qh2,qh3,qh4,qh5,qh6,xq1,xq2,xq3,xq4,xq5,xq6,time) values('".$muban1[id]."','".$userid."','".$muban1[name]."','".$muban1[text]."','".$muban1[dengji]."','".$jiaoyi[naijiu]."','".$muban1[naijiu_max]."','".$muban1[leixing]."','".$jiaoyi[qh1]."','".$jiaoyi[qh2]."','".$jiaoyi[qh3]."','".$jiaoyi[qh4]."','".$jiaoyi[qh5]."','".$jiaoyi[qh6]."','".$jiaoyi[xq1]."','".$jiaoyi[xq2]."','".$jiaoyi[xq3]."','".$jiaoyi[xq4]."','".$jiaoyi[xq5]."','".$jiaoyi[xq6]."','".$jiaoyi[zhuangbei_time]."')"; 
}
$ok2=mysqli_query($db,$s);
}else{
echo "背包空间不足";
}
}

//宠物写入数据库
if($jiaoyi[leixing]=="chongwu"){
$user[chongwu_rongliang]+="1";
if($user[chongwu_rongliang]<=$user[chongwu_rongliangmax]){
$sql2="update users set chongwu_rongliang='".$user[chongwu_rongliang]."' where id='".$userid."'";
  $muban = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$jiaoyi[chongwu_id]."'");
$guaiwu = mysqli_fetch_array($muban);
  $s="insert into pet(muban,userid,username,zhuangtai,chengzhanglv,dengji,jingyan,qixue,qixuemax,fali,fali_max,fangyu,gongji_fa,gongji,sudu) values('".$jiaoyi[chongwu_id]."','".$userid."','".$guaiwu[name]."','yes','".$jiaoyi[chongwu_chengzhanglv]."','".$jiaoyi[chongwu_dengji]."','0','".$jiaoyi[chongwu_qixue]."','".$jiaoyi[chongwu_qixuemax]."','".$jiaoyi[chongwu_fali]."','".$jiaoyi[chongwu_falimax]."','".$jiaoyi[chongwu_fangyu]."','".$jiaoyi[chongwu_fagong]."','".$jiaoyi[chongwu_wugong]."','".$jiaoyi[chongwu_sudu]."')";
$ok2=mysqli_query($db,$s);
}else{
echo "宠物栏空位不足";
}
}
//扣除卖家金币

$user[$jiaoyihuobi]-=$jiage;
$sql2="update users set $jiaoyihuobi='".$user[$jiaoyihuobi]."' where id='".$userid."'";
$ok3=mysqli_query($db,$sql2);
//写入货币给卖家
$npc = mysqli_query($db,"SELECT * FROM users WHERE id='".$jiaoyi[userid]."'");
$npc = mysqli_fetch_array($npc);
$jiage*=0.95;
$jiage=floor($jiage);
$npc[$jiaoyihuobi]+=$jiage;
$sql2="update users set $jiaoyihuobi='".$npc[$jiaoyihuobi]."' where id='".$jiaoyi[userid]."'";
$ok4=mysqli_query($db,$sql2);
//提醒卖家东西卖了
//出售的物品
if($jiaoyi[leixing]=="jiben"){
$new_wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$jiaoyi[wupin_id]."'");
$new_wupin = mysqli_fetch_array($new_wupin);
}
//出售的装备
if($jiaoyi[leixing]=="zhuangbei"){
$new_wupin = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$jiaoyi[zhuangbei_id]."'");
$new_wupin = mysqli_fetch_array($new_wupin);
}
//出售的宠物
if($jiaoyi[leixing]=="chongwu"){
$new_wupin = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$jiaoyi[chongwu_id]."'");
$new_wupin = mysqli_fetch_array($new_wupin);
}
//获取指定销售货币内容
switch($jiaoyi[huobi]){
	
case"gold":
	$chushouhuobi_name="金条";
break;
case"shenzhoubi":
$chushouhuobi_name="神州币";
break;
default:
$chushouhuobi_name="经验";
break;

}
$s="insert into email(text,userid,leibie,zhuangtai) values('你在交易系统销售的【".$new_wupin[name]."】卖出".$new_shuliang."件，获得".$jiage.$chushouhuobi_name."','".$jiaoyi[userid]."','1','0')";
$ok5=mysqli_query($db,$s);
}else{
echo"金币不足！<br/>";
}

}
}else{
echo"该商品不存在！<br/>";
}

if($ok1 && $ok2 && $ok3 && $ok4 && $ok5){
mysqli_query($db,"COMMIT");
echo"购买成功！<br/>";
}else{
mysqli_query($db,"ROLLBACK");
echo"购买失败！<br/>";
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");
}




//输出正在出售的东西
$perNumber=8;
$page=$_GET['page']; 
$url="./list?task=".$task."&huobi=".$get_huobi."&zhonglei=".$get_zhonglei."&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from jiaoyi WHERE leixing='".$zhonglei."' and huobi='".$huobi."' and name like '%".$task."%'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from jiaoyi WHERE leixing='".$zhonglei."' and huobi='".$huobi."' and name like '%".$task."%' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你背包里没有物品！<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
  //显示物品
  if($zhonglei=="jiben"){
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
  echo "--------------------<br/><a href='./text?id=$row[id]'>$wupin[name]</a>*$row[shuliang]个<br/>单价:$row[jiage] $huobi_name";
echo "<form action='list?id=$row[id]&huobi=$get_huobi&zhonglei=$get_zhonglei&my=1' method='post'>";
echo "数量:";
echo "<input name='shuliang' maxlength='10' value='1'/><br/>";
echo '<input type="submit" value="确定购买" class="link"/></form>';
}
 //显示装备
  if($zhonglei=="zhuangbei"){
$wupin = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$row[zhuangbei_id]."'");
$wupin = mysqli_fetch_array($wupin);
if($row[zhuangbei_time]==null){
    $zhuangtai="";
}else{
    $row[zhuangbei_time]-=time();
    $row[zhuangbei_time]/=86400;
    $zhuangtai=ceil($row[zhuangbei_time]);
    $zhuangtai="(".$zhuangtai."天)";
}
  echo "--------------------<br/><a href='./text?id=$row[id]'>$wupin[name]</a>$zhuangtai*1<br/>单价:$row[jiage] $huobi_name";
echo "<form action='list?id=$row[id]&huobi=$get_huobi&zhonglei=$get_zhonglei&my=1' method='post'>";
echo "数量:";
echo "<input name='shuliang' maxlength='10' value='1'/><br/>";
echo '<input type="submit" value="确定购买" class="link"/></form>';
}
   //显示宠物
  if($zhonglei=="chongwu"){
$wupin = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$row[chongwu_id]."'");
$wupin = mysqli_fetch_array($wupin);
  echo "--------------------<br/><a href='./text?id=$row[id]'>$wupin[name]</a><br/>单价:$row[jiage] $huobi_name";
echo "<form action='list?id=$row[id]&huobi=$get_huobi&zhonglei=$get_zhonglei&my=1' method='post'>";
echo "数量:";
echo "<input name='shuliang' maxlength='10' value='1'/><br/>";
echo '<input type="submit" value="确定购买" class="link"/></form>';
}
//显示结束

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
echo "当前没有人上架该类商品，可以筛选其它物品以及销售货币。<br/>";
}
}

   
echo "<a href='index'>交易界面</a><br/> ";

echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a><br/>";
//删除超过7天没有出售的物品
$result = mysqli_query($db,"SELECT * FROM jiaoyi");
while($row = mysqli_fetch_array($result))
  {
$row[time]+="2592000";
if($row[time]<time()){
$sql3 = "delete from jiaoyi where id ='".$row[id]."'";
$ok1=mysqli_query($db,$sql3);
if($ok1){
   //显示宠物
  if($row[leixing]=="chongwu"){
$wupin = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$row[chongwu_id]."'");
$wupin = mysqli_fetch_array($wupin);
}
  if($row[leixing]=="jiben"){
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
}
  if($row[leixing]=="zhuangbei"){
$wupin = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$row[zhuangbei_id]."'");
$wupin = mysqli_fetch_array($wupin);
}

$s="insert into email(text,userid,leibie,zhuangtai) values('你在交易系统销售的".$wupin[name]."*".$row[shuliang]."，超过30天未出售，已被系统自动回收。','".$row[userid]."','1','0')";
$ok5=mysqli_query($db,$s);
}
}

}

?>