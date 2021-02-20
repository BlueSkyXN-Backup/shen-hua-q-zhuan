<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
//
$mys=$_GET['my'];
$id=$_GET['id'];
$get_shiyong=$_GET['shiyong'];
$userid=$_SESSION['users'];
$page=$_GET['page']; 
$get_parcel=$_GET['parcel']; 
$searchs=$_GET['task'];
$parcel=$_SESSION['parcel'];

echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";


//显示基本物品
  echo "<br/><a href='/user.parcel'>基本</a>|<a href='/user.parcel?my=zb'>装备</a>|<a href='/user.parcel?my=cl'>材料</a>|<a href='/user.parcel?my=sc'>商城</a><br/>";
  
echo "<form action='user.parcel' method='get'>";
echo "<input name='task' maxlength='100' value='$searchs'/>";
echo"<input type='hidden' name='my' value='$mys'>";
echo"<input type='hidden' name='zhonglei' value='$get_zhonglei'>";
echo '<input type="submit" value="搜索" class="link"/></form>';
//执行开启物品
$resultl = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and id='".$id."'");
$my = mysqli_fetch_array($resultl);
if ($my){
if($get_shiyong){
if($parcel==$get_parcel){
$muban = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and id='".$id."'");
$muban = mysqli_fetch_array($muban);
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$muban[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
  
  
//判断是否是药品消耗品
if($wupin[xiaohao]=="yes"){
$xiaohao_xiaoguo= explode("|", $wupin[xiaohao_xiaoguo]);
  for($j=0;$j<count($xiaohao_xiaoguo);$j++){
    //读取当前回复药剂效果
    $huifu_xiaohuo = explode(",", $xiaohao_xiaoguo[$j]); 
  switch($huifu_xiaohuo[0]){
case"hp":
$user[qixue] +=$huifu_xiaohuo[1];
      if($user[qixue]>$user[qixuemax]){
$user[qixue]=$user[qixuemax];
$shiyong_jiaxue=bcsub("$user[qixuemax]","$yuanshi_xue");  //加了多少血
}
$sql2="update users set qixue='".$user[qixue]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="增加气血:".$huifu_xiaohuo[1]." ";





break;
case"ap":
$user[fali] +=$huifu_xiaohuo[1];
      if($user[fali]>$user[fali_max]){
$user[fali]=$user[fali_max];
$shiyong_jiaxue=bcsub("$user[fali_max]","$yuanshi_xue");  //加了多少血
}
$sql2="update users set fali='".$user[fali]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="增加法力:".$huifu_xiaohuo[1]." ";

break;
case"huoli":
    $suiji_huoli=mt_rand($huifu_xiaohuo[1],$huifu_xiaohuo[2]);
$user[huoli] +=$suiji_huoli;
$sql2="update users set huoli='".$user[huoli]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="增加活力:".$suiji_huoli." ";

break;
case"beibao":
$user[beibao_rongliangmax]+=$huifu_xiaohuo[1];
$sql2="update users set beibao_rongliangmax='".$user[beibao_rongliangmax]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="增加背包空间:".$huifu_xiaohuo[1]." ";

break;
case"zuie2":
$user[zuie2]-=$huifu_xiaohuo[1];
if($user[zuie2]<"1"){
    $user[zuie2]="0";
}
$sql2="update users set zuie2='".$user[zuie2]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="减少罪孽值:".$huifu_xiaohuo[1]." ";

break;
case"zc":
	if($user[chongwu_id]!="0"){
$chongwu= mysqli_query($db,"SELECT * FROM pet WHERE userid='".$userid."' and id='".$user[chongwu_id]."'");
$chongwu= mysqli_fetch_array($chongwu);
$chongwu[zhongcheng]+=$huifu_xiaohuo[1];
$sql2="update pet set zhongcheng='".$chongwu[zhongcheng]."' where id='".$chongwu[id]."'";
$ok=mysqli_query($db,$sql2);
}
$xiaoguo.="恢复已携带宠物忠诚度:".$huifu_xiaohuo[1]." ";

break;
case"chongwu":

$user[chongwu_rongliangmax]+=$huifu_xiaohuo[1];
$sql2="update users set chongwu_rongliangmax='".$user[chongwu_rongliangmax]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="增加宠物栏空间:".$huifu_xiaohuo[1]." ";break;
case"shenzhoubi":
$suiji_shenzhoubi=mt_rand($huifu_xiaohuo[1],$huifu_xiaohuo[2]);
$user[shenzhoubi] +=$suiji_shenzhoubi;
$sql2="update users set shenzhoubi='".$user[shenzhoubi]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="获得神州币*".$suiji_shenzhoubi ;
break;
 
case"jingyan":
$suiji_jingyan=mt_rand($huifu_xiaohuo[1],$huifu_xiaohuo[2]);
$user[jingyan] +=$suiji_jingyan;
$sql2="update users set jingyan='".$user[jingyan]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="获得经验*".$suiji_jingyan ;
break;
      case"buff_jingyan":
$suiji_jingyan=mt_rand($huifu_xiaohuo[1],$huifu_xiaohuo[2]);
     if($user[buff_jingyan]>time()){
       $user[buff_jingyan] +=$suiji_jingyan;
     }else{
         $user[buff_jingyan]=time();
       $user[buff_jingyan] +=$suiji_jingyan;
     } 

$sql2="update users set buff_jingyan='".$user[buff_jingyan]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="获得双倍经验时长*".$suiji_jingyan."秒";
break;
            case"buff_gold":
$suiji_gold=mt_rand($huifu_xiaohuo[1],$huifu_xiaohuo[2]);
     if($user[buff_gold]>time()){
       $user[buff_gold] +=$suiji_gold;
     }else{
         $user[buff_gold]=time();
       $user[buff_gold] +=$suiji_gold;
     } 

$sql2="update users set buff_gold='".$user[buff_gold]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="获得双倍金币时长*".$suiji_gold."秒";
break;

case"zd_qx1":
$suiji_zd_qx1=mt_rand($huifu_xiaohuo[1],$huifu_xiaohuo[2]);
$user[zd_qx1] +=$suiji_zd_qx1;
$sql2="update users set zd_qx1='".$user[zd_qx1]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="获得人物回血*".$suiji_zd_qx1 ;
break;
case"zd_fl1":
$suiji_zd_fl1=mt_rand($huifu_xiaohuo[1],$huifu_xiaohuo[2]);
$user[zd_fl1] +=$suiji_zd_fl1;
$sql2="update users set zd_fl1='".$user[zd_fl1]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="获得人物回法*".$suiji_zd_fl1;
break;
case"zd_qx2":
$suiji_zd_qx2=mt_rand($huifu_xiaohuo[1],$huifu_xiaohuo[2]);
$user[zd_qx2] +=$suiji_zd_qx2;
$sql2="update users set zd_qx2='".$user[zd_qx2]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="获得宠物回血*".$suiji_zd_qx2 ;
break;
case"zd_fl2":
$suiji_zd_fl2=mt_rand($huifu_xiaohuo[1],$huifu_xiaohuo[2]);
$user[zd_fl2] +=$suiji_zd_fl2;
$sql2="update users set zd_fl2='".$user[zd_fl2]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="获得宠物回法*".$suiji_zd_fl2 ;
break;
   case"vip":
$suiji_jingyan=mt_rand($huifu_xiaohuo[1],$huifu_xiaohuo[2]);
     if($user[vip]>time()){
       $user[vip] +=$suiji_jingyan;
     }else{
         $user[vip]=time();
       $user[vip] +=$suiji_jingyan;
     } 

$sql2="update users set vip='".$user[vip]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="获得VIP时长*".$suiji_jingyan."秒";
break;
default:

break;
}
 
  }
  echo"使用了".$wupin[name]."".$xiaoguo;
//减去物品
$muban[shuliang]-="1";
if($muban[shuliang]<"1"){

$sql3 = "delete from beibao where id ='".$id."'";
$ok=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$muban[shuliang]."' where id='".$id."'";
$ok=mysqli_query($db,$sql2);
}  
}

//判断是否是礼包
if($wupin[libao]=="yes"){
	if($wupin[dengji]<=$user[dengji]){
	$ajss="wp,".$muban[wupin_id];
if($xyz->kou_beibao($ajss,"1",$userid)=="ok"){
$huode_html="幸运获得:". $xyz->beibao($wupin[libao_id],$wupin[libao_shu],$wupin[libao_jilv],$wupin[shuliang],$userid,' ',' ');
echo $huode_html;
if($userid!="1"){$s="insert into news(text,time,userid,leibie) values('打开了".$wupin[name]."幸运获得".$huode_html."','".time()."','".$userid."','0')";
$ok=mysqli_query($db,$s);}
if($ok){
	mysqli_query($db,"COMMIT");
}else{
	echo"0";
}
}
}else{
	echo"等级不足，无法开启！<br/>";
}

  }

}else{
echo"请勿重复点击<br/>";
}
}
}else{
//echo"你没有这件物品<br/>";
}
//更新打开
$parcel=md5(time());
$_SESSION['parcel']=$parcel;

 //定义物品类别
 $result = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and leibie is NULL");
 while($row = mysqli_fetch_array($result))
   {
 $wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
 $wupin = mysqli_fetch_array($wupin);
 $sql4="update beibao set name='".$wupin[name]."' , leibie='".$wupin[leibie]."' where id='".$row[id]."' and userid='".$userid."'";
 $ok=mysqli_query($db,$sql4);
   }
 $result = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and leibie=''");
 while($row = mysqli_fetch_array($result))
   {
 $wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
 $wupin = mysqli_fetch_array($wupin);
 $sql4="update beibao set name='".$wupin[name]."' , leibie='".$wupin[leibie]."' where id='".$row[id]."' and userid='".$userid."'";
 $ok=mysqli_query($db,$sql4);
   }
   
switch($mys){
case"zb":
    //聊天信息分页显示
$perNumber=8;
$url="user.parcel?task=".$searchs."&my=zb&";
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

 echo "<br/>".zhuangbei_name($zhuangbei[id])."<br/>";

echo"<a href='/zb/zb.shiyong?my=zhuangbei&leixing=$zhuangbei[leixing]&id=$zhuangbei[id]'>装备</a><a href='/zb/zb.diuqi?my=zhuangbei&leixing=$zhuangbei[leixing]&id=$zhuangbei[id]'>丢弃</a>";
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
$url="user.parcel?task=".$searchs."&my=cl&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from beibao WHERE userid='".$userid."' and leibie='cailiao'and name like '%$searchs%'")); 
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


  echo "<br/><a href='wupin?id=$row[id]'>$wupin[name]</a>*$row[shuliang]个<br/>";

if($wupin[xiaohao]=="yes"){
echo"<a href='/user.parcel?shiyong=yes&id=$row[id]&my=$mys&task=$searchs&parcel=$parcel&page=".$page."'>使用</a>";
}
if($wupin[libao]=="yes"){
echo"<a href='/user.parcel?shiyong=yes&id=$row[id]&my=$mys&task=$searchs&parcel=$parcel&page=".$page."'>使用</a>";
}
echo"<a href='/wupin_diuqi?id=$row[id]&page=".$page."'>丢弃</a>";

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
$url="user.parcel?task=".$searchs."&my=sc&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from beibao WHERE userid='".$userid."' and leibie='shangcheng' and name like '%$searchs%'")); 
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


  echo "<br/><a href='wupin?id=$row[id]'>$wupin[name]</a>*$row[shuliang]个<br/>";

if($wupin[xiaohao]=="yes"){
echo"<a href='/user.parcel?shiyong=yes&id=$row[id]&my=$mys&task=$searchs&parcel=$parcel&page=".$page."'>使用</a>";
}
if($wupin[libao]=="yes"){
echo"<a href='/user.parcel?shiyong=yes&id=$row[id]&my=$mys&task=$searchs&parcel=$parcel&page=".$page."'>使用</a>";
}
echo"<a href='/wupin_diuqi?id=$row[id]&page=".$page."'>丢弃</a>";

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
default:
//显示基本物品
$perNumber=8;
$page=$_GET['page'];     
$url="user.parcel?task=".$searchs."&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from beibao WHERE userid='".$userid."' and leibie='jiben' and name like '%$searchs%'")); 
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


  echo "<br/><a href='wupin?id=$row[id]'>$wupin[name]</a>*$row[shuliang]个<br/>";

if($wupin[xiaohao]=="yes"){
echo"<a href='/user.parcel?shiyong=yes&id=$row[id]&my=$mys&task=$searchs&parcel=$parcel&page=".$page."'>使用</a>";
}
if($wupin[libao]=="yes"){
echo"<a href='/user.parcel?shiyong=yes&id=$row[id]&my=$mys&task=$searchs&parcel=$parcel&page=".$page."'>使用</a>";
}
echo"<a href='/wupin_diuqi?id=$row[id]&page=".$page."'>丢弃</a>";

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

//计算背包容量

$result = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."'");
while($row = mysqli_fetch_array($result))
  {
  $wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
  $tiji=$wupin[tiji];
   $tiji*=$row[shuliang];
$beibao_rongliang+=$tiji;
  }

$result = mysqli_query($db,"SELECT * FROM zhuangbei WHERE shiyong='no'and userid='".$userid."'");
$row = mysqli_num_rows($result);
$row*=5;
  
$beibao_rongliang+=$row;
  
if($user[beibao_rongliangmax]>"100000"){
    $user[beibao_rongliangmax]="100000";
}
$user[beibao_rongliang]=$beibao_rongliang;
$sql2="update users set beibao_rongliang='".$beibao_rongliang."',beibao_rongliangmax='".$user[beibao_rongliangmax]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);

echo "<br/>金币：".$user[gold]."个<br/>背包容量：".$user[beibao_rongliang]."/".$user[beibao_rongliangmax];

echo "<br/><a href='/map.games?id=".$zhuangtai_map."'>只是路过</a>";
echo footer."<br/><a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/>";