<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";if(!isset($_SESSION['users'])){//判断是否存在$_SESSION
header("location:../main.do");//跳转地址
exit();//结束
}
$userid=$_SESSION['users'];
$shuxing=$_GET['shuxing'];
$npcid=$_GET['id'];
$pvp=$_GET['pvp'];
$resultl = mysqli_query($db,"SELECT * FROM users WHERE id='".$npcid."'");
$my = mysqli_fetch_array($resultl);
if (!$my){
echo"该用户不存在！";
echo footer();
exit();//结束
}

$npc = mysqli_query($db,"SELECT * FROM users WHERE id='".$npcid."'");
$npc = mysqli_fetch_array($npc);
$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);
/********************************************
 wap框架头部变量
 *******************************************/
echo $wapwork->title($npc[username]);


echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/>";

if($_GET[jubao]){
    echo"举报成功<br/>";
}
//获取用户称谓
$user_chengwei = mysqli_query($db,"SELECT * FROM users_chengwei WHERE id='".$npc[chengwei]."'");
$user_chengwei= mysqli_fetch_array($user_chengwei);
$zb=array();
for($ii=1;$ii<=23;$ii++){
switch ($ii) {
  case "1":
    $zhuangbei_leixing="maozi";
    break;
  case "2":
    $zhuangbei_leixing="xianglian";
    break;
  case "3":
    $zhuangbei_leixing="yifu";
    break;
  case "4":
    $zhuangbei_leixing="wuqi";
    break;
  case "5":
    $zhuangbei_leixing="xiezi";
    break;
      case "6":
    $zhuangbei_leixing= "ps1";
    break;  
  case "7":
    $zhuangbei_leixing= "ps2";
    break;
      case "8":
    $zhuangbei_leixing= "ps3";
    break;
      case "9":
    $zhuangbei_leixing= "ps4";
    break;
      case "10":
    $zhuangbei_leixing= "ps5";
    break;
      case "11":
    $zhuangbei_leixing= "ps6";
    break;
      case "12":
    $zhuangbei_leixing= "ps7";
    break;
      case"13":
    $zhuangbei_leixing= "ps8";
    break;
case"14":
    $zhuangbei_leixing= "fw1";
    break;
case"15":
    $zhuangbei_leixing= "fw2";
    break;
case"16":
    $zhuangbei_leixing= "fw3";
    break;
case"17":
    $zhuangbei_leixing= "fw4";
    break;
case"18":
    $zhuangbei_leixing= "fw5";
    break;
    case"19":
    $zhuangbei_leixing= "sz1";
    break;
case"20":
    $zhuangbei_leixing= "sz2";
    break;
case"21":
    $zhuangbei_leixing= "sz3";
    break;
case"22":
    $zhuangbei_leixing= "sz4";
    break;
case"23":
    $zhuangbei_leixing= "sz5";
    break;
  default:
    echo "系统错误";
exit();
    break;
}

if($npc[$zhuangbei_leixing]=="0"){
$zb[$zhuangbei_leixing]="无 ";
}else{
$zb[$zhuangbei_leixing]=zhuangbei_name($npc[$zhuangbei_leixing]);
}
}

//获取用户境界
$num=$npc[dengji];
if($pvp){
    if($userid!=$npcid){
    	$map1 = mysqli_query($db,"SELECT * FROM fuben WHERE duiwuid='".$user[duiwu_id]."'");
$map1 = mysqli_fetch_array($map1);
$map2 = mysqli_query($db,"SELECT * FROM fuben WHERE duiwuid='".$npc[duiwu_id]."'");
$map2 = mysqli_fetch_array($map2);
if(!$map1){
	if(!$map2){
	$resultl = mysqli_query($db,"SELECT * FROM pk WHERE userid='".$npcid."' or npcid='".$npcid."'");
$pks= mysqli_fetch_array($resultl);
if($pks){
	echo"对方正在pk中!<br/>";
}else{
    
		if($user[zhuangtai]=="yes" && $user[qixue]>"0"){
		if($npc[zhuangtai]=="yes" && $npc[qixue]>"0"){
	if($user[dengji]>"24"){
		if($npc[dengji]>"24"){
		//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
$myss= mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and wupin_id='11'");//锁定该用户的背包杀人香
$wupin_11= mysqli_fetch_array($myss);
$myss= mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$npcid."' and wupin_id='78'");//锁定该用户的背包神功护体丸
$wupin_78= mysqli_fetch_array($myss);
if($user[map]==$npc[map]){
    	$s="insert into pk(userid,npcid,time) values('".$userid."','".$npcid."','".time()."')";
$ok2=mysqli_query($db,$s);
$ok1="y";
	echo"PK成功！返回地图进入PK。<br/>";
header("refresh:0;url=/map.games");

}
else{
if($wupin_11[shuliang]>"0"){
			$wupin_11[shuliang]-="1";
		if($wupin_11[shuliang]<"1"){

$sql3 = "delete from beibao where userid='".$userid."' and wupin_id='11'";
$ok1=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$wupin_11[shuliang]."' where userid='".$userid."' and wupin_id='11'";
$ok1=mysqli_query($db,$sql2);
}	
	if($wupin_78[shuliang]>"0"){
		echo"对方消耗了一刻神功护体丸，逃脱了你的追杀。<br/>";
		 $s="insert into email(text,userid,leibie,zhuangtai) values('<a href=\"/user/user?id=$user[id]\">".$user[username]."</a>想要杀你，你消耗了一枚神功护体丸逃过一劫。','".$npcid."','1','0')";
$ok5=mysqli_query($db,$s);

		$wupin_78[shuliang]-="1";
		if($wupin_78[shuliang]<"1"){

$sql3 = "delete from beibao where userid='".$npcid."' and wupin_id='78'";
$ok2=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$wupin_78[shuliang]."' where userid='".$npcid."' and wupin_id='78'";
$ok2=mysqli_query($db,$sql2);
}

}else{
	$s="insert into pk(userid,npcid,time) values('".$userid."','".$npcid."','".time()."')";
$ok2=mysqli_query($db,$s);
	echo"PK成功！返回地图进入PK。<br/>";
header("refresh:0;url=/map.games");

}
}else{
	echo"你们没有在同一地图，杀人之前需要先点一根杀人香！<br/>";
}
}

if($ok1 && $ok2){
mysqli_query($db,"COMMIT");//提交
//pk扣耐久
//计算属性
shuxing($userid,user);
shuxing($npcid,user);
//扣除装备耐久
for($i=1;$i<=18;$i++){
switch ($i) {
  case "1":
    $zhuangbei_leixing="maozi";
    break;
  case "2":
    $zhuangbei_leixing="xianglian";
    break;
  case "3":
    $zhuangbei_leixing="yifu";
    break;
  case "4":
    $zhuangbei_leixing="wuqi";
    break;
  case "5":
    $zhuangbei_leixing="xiezi";
    break;
      case "6":
    $zhuangbei_leixing= "ps1";
    break;  
  case "7":
    $zhuangbei_leixing= "ps2";
    break;
      case "8":
    $zhuangbei_leixing= "ps3";
    break;
      case "9":
    $zhuangbei_leixing= "ps4";
    break;
      case "10":
    $zhuangbei_leixing= "ps5";
    break;
      case "11":
    $zhuangbei_leixing= "ps6";
    break;
      case "12":
    $zhuangbei_leixing= "ps7";
    break;
      case "13":
    $zhuangbei_leixing= "ps8";
    break;
    case "14":
    $zhuangbei_leixing= "sz1";
    break;  
  case "15":
    $zhuangbei_leixing= "sz2";
    break;
      case "16":
    $zhuangbei_leixing= "sz3";
    break;
      case "17":
    $zhuangbei_leixing= "sz4";
    break;
      case "18":
    $zhuangbei_leixing= "sz5";
    break;
  default:
    echo "系统错误";
exit();
    break;
}
$zhuangbeileixing=$user[$zhuangbei_leixing];
if($zhuangbeileixing!="0"){
$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$zhuangbeileixing."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$zhuangbei[naijiu]-="1";
//最后将耐久写入数据库
$sql2="update zhuangbei set naijiu='".$zhuangbei[naijiu]."' where id='".$zhuangbeileixing."'";
$ok=mysqli_query($db,$sql2);
}
}
for($i=1;$i<=18;$i++){
switch ($i) {
  case "1":
    $zhuangbei_leixing="maozi";
    break;
  case "2":
    $zhuangbei_leixing="xianglian";
    break;
  case "3":
    $zhuangbei_leixing="yifu";
    break;
  case "4":
    $zhuangbei_leixing="wuqi";
    break;
  case "5":
    $zhuangbei_leixing="xiezi";
    break;
      case "6":
    $zhuangbei_leixing= "ps1";
    break;  
  case "7":
    $zhuangbei_leixing= "ps2";
    break;
      case "8":
    $zhuangbei_leixing= "ps3";
    break;
      case "9":
    $zhuangbei_leixing= "ps4";
    break;
      case "10":
    $zhuangbei_leixing= "ps5";
    break;
      case "11":
    $zhuangbei_leixing= "ps6";
    break;
      case "12":
    $zhuangbei_leixing= "ps7";
    break;
      case "13":
    $zhuangbei_leixing= "ps8";
    break;
    case "14":
    $zhuangbei_leixing= "sz1";
    break;  
  case "15":
    $zhuangbei_leixing= "sz2";
    break;
      case "16":
    $zhuangbei_leixing= "sz3";
    break;
      case "17":
    $zhuangbei_leixing= "sz4";
    break;
      case "18":
    $zhuangbei_leixing= "sz5";
    break;
  default:
    echo "系统错误";
exit();
    break;
}
$zhuangbeileixing=$npc[$zhuangbei_leixing];
if($zhuangbeileixing!="0"){
$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$zhuangbeileixing."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$zhuangbei[naijiu]-="1";
//最后将耐久写入数据库
$sql2="update zhuangbei set naijiu='".$zhuangbei[naijiu]."' where id='".$zhuangbeileixing."'";
$ok=mysqli_query($db,$sql2);
}
}

//pk扣耐久结束
}else{
	mysqli_query($db,"ROLLBACK");
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");
	}else{
		echo"不能击杀等级小于25级的萌新哦。<br/>";
	}
	}else{
		echo"pk需要玩家等级大于等于25级。<br/>";
	}
	}else{
		echo"对方已经死亡，无法pk!<br/>";
	}
	}else{
		echo"你已死亡，无法pk!<br/>";
	}
	
}
}else{
	echo"对手正在副本中，不能被pk。<br/>";
}
}else{
	echo"请先退出副本。<br/>";
}


}else{
    echo"你不能和自己PK。<br/>";
}
}



/*if($npc[zhuansheng]=="1"){
    $zhuanshengname="一转";
}elseif($npc[zhuansheng]=="2"){
    $zhuanshengname="二转";
}elseif($npc[zhuansheng]=="3"){
    $zhuanshengname="三转";
}elseif($npc[zhuansheng]=="4"){
    $zhuanshengname="四转";
}else{
    $zhuanshengname="";
}*/
   if($npc[zhuansheng]>0){
        $zhuanshengname=china_num($npc[zhuansheng])."转";
    }



echo"<a href='/user/user?id=$npcid'>基本</a>|<a href='/user/user?shuxing=1&id=$npcid'>属性</a>|<a href='/user/user?shuxing=3&id=$npcid'>配饰</a>|<a href='/user/user?shuxing=5&id=$npcid'>时装</a>|<a href='/user/user?shuxing=4&id=$npcid'>符文</a>|<a href='/user/user?shuxing=7&id=$npcid'>法宝</a><br/>";
if($npc[fenghao]=="yes"){

echo "<b>该用户已被查封！</b><br/>";
}
if ($npc[sex]=="0"){
$sex="女";
$img="<img src='/img/tj.png'  width='90' height='100' alt='$npc[name]' /><br/>";

}
if ($npc[sex]=="1"){
$sex="男";
$img="<img src='/img/xy.png'  width='90' height='100' alt='$npc[name]' /><br/>";
}
if($npc[juese]!=null){
$juese= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM juese WHERE id='".$npc[juese]."' and userid='".$npc[id]."'"));
$juese2= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM muban_juese WHERE id='".$juese[muban]."'"));

$img="<img src='/img/juese/".$juese2[img]."'  width='90' height='100' alt='$npc[name]' /><br/>";
    
}
if ($npc[zhongzu]=="1"){
$zhongwu="妖族";
}
if ($npc[zhongzu]=="2"){

$zhongwu="人族";

}
if ($npc[zhongzu]=="3"){

$zhongwu="鬼族";

}
if ($npc[zhongzu]=="4"){

$zhongwu="佛族";

}
if ($npc[zhongzu]=="5"){

$zhongwu="仙族";
}
if($userid=="1"){
//获取用户在线时间
$zaixian_time=time();
$zaixian_time-=$npc[time];
$zaixian_time1=timesecond($zaixian_time);}


$shuxing_dian=$npc[dengji];
$shuxing_dian*=$shuxing_dian;

//获取帮派
$bangpai_user = mysqli_query($db,"SELECT * FROM bangpai_user WHERE userid='".$npc[id]."'");
$bangpai_user = mysqli_fetch_array($bangpai_user);
if($bangpai_user){
  $bangpainame = mysqli_query($db,"SELECT * FROM bangpai WHERE id='".$bangpai_user[bangpaiid]."'");
$bangpainame = mysqli_fetch_array($bangpainame);
    $bangpai="<a href='/bangpai/bangpai.php?id=$bangpainame[id]'> $bangpainame[name]</a>";
}else{
  $bangpai="无";
}


$qinglv=mysqli_fetch_array(mysqli_query($db,"select * from qinglv where nan IN('".$npc[id]."') or nv IN('".$npc[id]."')"));
    if(!$qinglv){
        $qinglv_name="无";
    }else{
      if($npc[sex]=="0"){
         $user_qinglv = mysqli_query($db,"SELECT * FROM users WHERE id='".$qinglv[nan]."'");
$user_qinglv= mysqli_fetch_array($user_qinglv); 

$qinglv_name="<a href='/user/user?id=".$user_qinglv[id]."'>".$user_qinglv[username]."</a>";
      }else{
                 $user_qinglv = mysqli_query($db,"SELECT * FROM users WHERE id='".$qinglv[nv]."'");
$user_qinglv= mysqli_fetch_array($user_qinglv); 

$qinglv_name="<a href='/user/user?id=".$user_qinglv[id]."'>".$user_qinglv[username]."</a>"; 
      }
        
        
        
    }
    
switch ($shuxing){
case "1":
$html=<<<HTML
气血：$npc[qixuemax] <br/>
法力：$npc[fali_max]<br/>
防御：$npc[fangyu] <br/>
物攻：$npc[gongji]<br/>
法攻：$npc[gongji_fa]<br/>
速度：$npc[sudu]<br/>
穿甲：$npc[pojia]<br/>
HTML;
break;
case "2":
$html=<<<HTML
帽子：$zb[maozi] <br/>
项链：$zb[xianglian]<br/>
衣服：$zb[yifu]<br/>
武器：$zb[wuqi]<br/>
鞋子：$zb[xiezi]<br/>
HTML;
break;
    case "3":
$html=<<<HTML
发饰：$zb[ps1]<br/>
耳环：$zb[ps8]<br/>
翅膀：$zb[ps2]<br/>
披风：$zb[ps3]<br/>
戒指：$zb[ps4]<br/>
腰带：$zb[ps5]<br/>
手镯：$zb[ps6]<br/>
勋章：$zb[ps7]<br/>
HTML;
break;
case "4":
$html=<<<HTML
符文1：$zb[fw1]<br/>
符文2：$zb[fw2]<br/>
符文3：$zb[fw3]<br/>
符文4：$zb[fw4]<br/>
符文5：$zb[fw5]<br/>
HTML;
break;
case "5":
$html=<<<HTML
头饰：$zb[sz1]<br/>
背饰：$zb[sz2]<br/>
吊坠：$zb[sz3]<br/>
上衣：$zb[sz4]<br/>
袜子：$zb[sz5]<br/>
HTML;
break;
case "6":
	$exec="select * from news WHERE userid='".$npcid."' order by id desc limit 10"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$xtuser=mysqli_query($db,"SELECT * FROM users WHERE id='".$row[userid]."'");
$xtuser=mysqli_fetch_array($xtuser);
$html.=user_name($xtuser[id])."$row[text]<br/>";
}
break;
case "7":
$html=<<<HTML
聚宝盆（120级开启）<br/>
摇钱树（120级开启）<br/>
乾坤袋（120级开启）<br/>
混元伞（120级开启）<br/>
HTML;
break;
default:
$name=user_name($npc[id]);
if($npc[rongyu]){
$rongyu_img="<img src='/img/rongyu/".$npc[rongyu]."'  height='50'/>";
}
$html=<<<HTML
$img <a href='/user/user?id=$npcid&jubao=jinyan'>举报</a><br/>
昵称：$name($npc[id])<br/>
$rongyu_img  
等级：$zhuanshengname $npc[dengji]级<br/>
性别：$sex<br/>
种族：$zhongwu<br/>
称谓：$user_chengwei[name]<br/>
帮派：$bangpai<br/>
情侣：$qinglv_name <br/>
帽子：$zb[maozi] <br/>
项链：$zb[xianglian]<br/>
衣服：$zb[yifu]<br/>
武器：$zb[wuqi]<br/>
鞋子：$zb[xiezi]
$zaixian_time1 
HTML;
break;
}



echo $html;


if($userid=="1"){
	echo"<a href='/user/user?id=$npcid&jinyan=jinyan'>禁言</a>|<a href='/user/user?id=$npcid&jinyan=jiechu'>解除</a>";
	if($_GET['jinyan']=="jinyan"){
	//禁言操作
	$jinyan=time()+"360000000";
	$sql1="update users set  jinyan='".$jinyan."',qq='321003480' where id='".$npcid."'";
$ok=mysqli_query($db,$sql1);

}
	if($_GET['jinyan']=="jiechu"){
	//禁言操作
	$sql1="update users set  jinyan='0' where id='".$npcid."'";
$ok=mysqli_query($db,$sql1);
}
}
$haoyou_=mysqli_fetch_array(mysqli_query($db,"SELECT * FROM haoyou WHERE userid='".$userid."' and cid='".$npcid."'"));
if(!$haoyou_){
    $haoyou="<a href='/Friend/index.php?my=ok&jid=$npcid'>加好友</a>|";
    
}
if($npcid!="1"){
echo"<br/>".$haoyou."<a href='/Friend/chat.php?id=$npcid'>发消息</a>|<a href='/give/index.give?npcid=$npcid'>给予</a>|<a href='/ranks/index.php?id=$npcid'>组队</a>|<a href='/user/user?id=$npcid&pvp=yes'>PK</a><br/>";
}
echo "<a href='/map.games?id=$user[map]'>只是路过</a> <br/>";

echo footer();


?>