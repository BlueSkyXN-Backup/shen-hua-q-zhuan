<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}

function chongzhi($userid,$trade_no,$buyer_logon_id,$out_trade_no){
   global $db;
$npc = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$npc = mysqli_fetch_array($npc);
$sql1="update pay set  zhuangtai='1',alipay_dingdan='".$trade_no."',alipay_zhanghao='".$buyer_logon_id."' where dingdanhao='".$out_trade_no."'";
if($ok)
$pay[gold]*=$chongzhi_jinermb;
$npc[shenzhoubi]+=$pay[gold];
$sql2="update users set shenzhoubi='".$npc[shenzhoubi]."',shsj='".$npc[shsj]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
echo "恭喜你，成功为".$npc[username]."充值".$pay[gold]."神州币。<br />";
   return $user_name;
}


function user_name($userid){
   global $db;
   $user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);
if($user[rongyu]){
$rongyu_img="<img src='/img/rongyu/".$user[rongyu]."'  height='26'/>";
}
if($user[vip]>time()){
    $user_name=$rongyu_img."<img src='/img/vip/vip_logo.png'  width='17' height='17'  /><a href='/user/user?id=".$user['id']."'><font color='#FFA500'>".$user['username']."</font></a>";
}else{
$user_name=$rongyu_img."<a href='/user/user?id=".$user['id']."'>".$user['username']."</a>";
    
}
   return $user_name;
}
//用户玩家宠物系列疯转函数
//计算人物宠物属性
function shuxing($userid,$user_leixing){
$xiangqian=new xiangqian();
global $db;
$user=mysqli_query($db,"SELECT * FROM $user_leixing WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);
$shuxing_dian=$user['dengji'];
$shuxing_dian*=5;
$maxqixue='0';
$maxfali='0';
$maxfangyu='0';
$maxgongji='0';
$maxgongji_fa='0';
$maxsudu='0';
if($user_leixing=='pet')
{
    $muban = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$user[muban]."'");
$muban = mysqli_fetch_array($muban);
//检测模板
$xidian_qixue=$muban[qixue_max];
$xidian_fali=$muban[fali_max];
$xidian_fangyu=$muban[fangyu];
$xidian_fagong=$muban[fagong];
$xidian_wugong=$muban[wugong];
$xidian_sudu=$muban[sudu];

}
if($user_leixing=="users"){
//检测种族
if ($user['zhongzu']=="3"){
$zhuangtai_zhongzu=鬼族;
$xidian_qixue="20";
$xidian_fali="15";
$xidian_fangyu="13";
$xidian_fagong="18";
$xidian_wugong="15";
$xidian_sudu="12";
}
if ($user['zhongzu']=="4"){
$zhuangtai_zhongzu=佛族;
$xidian_qixue="18";
$xidian_fali="18";
$xidian_fangyu="13";
$xidian_fagong="15";
$xidian_wugong="20";
$xidian_sudu="12";
}

if ($user['zhongzu']=="1"){
$zhuangtai_zhongzu=妖族;
$xidian_qixue="20";
$xidian_fali="15";
$xidian_fangyu="16";
$xidian_fagong="18";
$xidian_wugong="15";
$xidian_sudu="12";
}
if ($user['zhongzu']=="2"){
$zhuangtai_zhongzu=人族;
$xidian_qixue="23";
$xidian_fali="15";
$xidian_fangyu="13";
$xidian_fagong="18";
$xidian_wugong="15";
$xidian_sudu="12";
}
if ($user['zhongzu']=="5"){
$zhuangtai_zhongzu=仙族;
$xidian_qixue="18";
$xidian_fali="15";
$xidian_fangyu="13";
$xidian_fagong="20";
$xidian_wugong="15";
$xidian_sudu="13";
}
}



//叠加用户等级
$user['shuxing1']+=$user['dengji'];
$user['shuxing2']+=$user['dengji'];
$user['shuxing3']+=$user['dengji'];
$user['shuxing4']+=$user['dengji'];
$user['shuxing5']+=$user['dengji'];
$user['shuxing6']+=$user['dengji'];
//计算用户属性
$xidian_qixue*=$user['shuxing1'];
$xidian_fali*=$user['shuxing2'];
$xidian_fangyu*=$user['shuxing3'];
$xidian_fagong*=$user['shuxing6'];
$xidian_wugong*=$user['shuxing4'];
$xidian_sudu*=$user['shuxing5'];
$shuxing_mianshang="1";//设定会收到100%伤害



$shuxing_qixue='0';
$shuxing_fali='0';
$shuxing_fangyu='0';
$shuxing_wugong='0';
$shuxing_fagong='0';
$shuxing_sudu='0';
  //创建装备套装属性的数组
$taozhuang_shuxing=array();
for($i=1;$i<=23;$i++){
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
$zhuangbeileixing=$user[$zhuangbei_leixing];
if($zhuangbeileixing!="0"){
$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$zhuangbeileixing."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
//装备是否存在
if(!$zhuangbei){
	$sql2="update $user_leixing set $zhuangbei_leixing='0' where id='".$user['id']."'";
$ok=mysqli_query($db,$sql2);
}else{
    if($zhuangbei[shiyong]!="yes"){
        $sql2="update zhuangbei set shiyong='no' where id='".$zhuangbei[id]."'";
$ok=mysqli_query($db,$sql2);
        $sql2="update $user_leixing set $zhuangbei_leixing='0' where id='".$user['id']."'";
$ok=mysqli_query($db,$sql2);
    }else{
if($zhuangbei['naijiu']>"0"){
$yuanshi= mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei['yuanshi']."'");
$yuanshi = mysqli_fetch_array($yuanshi);
  //判断是否有套装属性
  if($yuanshi['taozhuang_id']!=NULL){
  array_push($taozhuang_shuxing,$yuanshi['taozhuang_id']);
  }
//强化
$qianghua1=zhuangbei_qianghua($yuanshi['qixue'],$zhuangbei['qh1']);
$qianghua2=zhuangbei_qianghua($yuanshi['fali'],$zhuangbei['qh2']);
$qianghua3=zhuangbei_qianghua($yuanshi['fangyu'],$zhuangbei['qh3']);
$qianghua4=zhuangbei_qianghua($yuanshi['fagong'],$zhuangbei['qh4']);
$qianghua5=zhuangbei_qianghua($yuanshi['wugong'],$zhuangbei['qh5']);
$qianghua6=zhuangbei_qianghua($yuanshi['sudu'],$zhuangbei['qh6']);
//加入百分比属性
if($yuanshi[maxqixue]!='0'){
	$maxqixue+=$yuanshi[maxqixue];
}
if($yuanshi[maxfali]!='0'){
	$maxfali+=$yuanshi[maxfali];
}
if($yuanshi[maxfangyu]!='0'){
	$maxfangyu+=$yuanshi[maxfangyu];
}
if($yuanshi[maxgongji]!='0'){
	$maxgongji+=$yuanshi[maxgongji];
}
if($yuanshi[maxgongji_fa]!='0'){
	$maxgongji_fa+=$yuanshi[maxgongji_fa];
}
if($yuanshi[maxsudu]!='0'){
	$maxsudu+=$yuanshi[maxsudu];
}

if($yuanshi[fuwen]=="no"){
//加入镶嵌
for($css=1;$css<7;$css++){

 
 if($zhuangbei[xq.$css]!="0"&&$zhuangbei[xq.$css]!="1"){
$xiaoguos=$xiangqian->xianshi($zhuangbei[xq.$css]);
 $xiaoguos=explode("|",$xiaoguos);
 	 if($xiaoguos['4']=="1"){
 	 	$shuxing_qixue+=$xiaoguos['0'];
 	 }elseif($xiaoguos['4']=="2"){
 	 	$shuxing_sudu+=$xiaoguos['0'];
 	 }elseif($xiaoguos['4']=="3"){
 	 	$shuxing_fagong+=$xiaoguos['0'];
 	 }elseif($xiaoguos['4']=="4"){
 	 	$shuxing_fangyu+=$xiaoguos['0'];
 	 }elseif($xiaoguos['4']=="5"){
 	 	$shuxing_wugong+=$xiaoguos['0'];
 	 }elseif($xiaoguos['4']=="6"){
 	 	$shuxing_fali+=$xiaoguos['0'];
 	 }elseif($xiaoguos['4']=="7"){
 	 	$shuxing_pojia+=$xiaoguos['0'];
 	 }
 	 
 	 
 	 
 }
}
//开始计算装备属性
$shuxing_qixue+=$qianghua1;
$shuxing_fali+=$qianghua2;
$shuxing_fangyu+=$qianghua3;
$shuxing_fagong+=$qianghua4;
$shuxing_wugong+=$qianghua5;
$shuxing_sudu+=$qianghua6;
}

$shuxing_qixue+=$yuanshi['qixue'];
$shuxing_fali+=$yuanshi['fali'];
$shuxing_fangyu+=$yuanshi['fangyu'];
$shuxing_wugong+=$yuanshi['wugong'];
$shuxing_fagong+=$yuanshi['fagong'];
$shuxing_sudu+=$yuanshi['sudu'];
$shuxing_pojia+=$yuanshi['pojia'];
if($yuanshi['mianshang']>"0"){
$mianqu=100-$yuanshi['mianshang'];
$mianqu/=100;
$shuxing_mianshang*=$mianqu;
}
}else{
  if($zhuangbei['naijiu']<"-10"){  //装备耐久为0执行卸下
     $sql2="update zhuangbei set shiyong='no' where id='".$zhuangbei[id]."'";
$ok=mysqli_query($db,$sql2);
        $sql2="update $user_leixing set $zhuangbei_leixing='0' where id='".$user['id']."'";
$ok=mysqli_query($db,$sql2);}
    
}
}
}
}
}
//现在开始激活套装属性
$taozhuang_jihuo=(array_count_values($taozhuang_shuxing));
foreach($taozhuang_jihuo as $taozhuang_a=>$taozhuang_b){//依次取出数组中元素，$a是元素的键名$b是键值
$muban_taozhuangs= mysqli_query($db,"SELECT * FROM muban_taozhuang WHERE id='".$taozhuang_a."'");
$muban_taozhuangs= mysqli_fetch_array($muban_taozhuangs);
  if($taozhuang_b>="7"&&$muban_taozhuangs['Seven']!=NULL){
    //激活7件套装
    $shuxing_taozhuang= explode("|", $muban_taozhuangs['Seven']);
    $shuxing_qixue+=$shuxing_taozhuang['0'];
$shuxing_fali+=$shuxing_taozhuang['1'];
$shuxing_fangyu+=$shuxing_taozhuang['2'];
$shuxing_fagong+=$shuxing_taozhuang['3'];
$shuxing_wugong+=$shuxing_taozhuang['4'];
$shuxing_sudu+=$shuxing_taozhuang['5'];
  }else{
            if($taozhuang_b>="6"&&$muban_taozhuangs['six']!=NULL){
  
         //激活6件套装
    $shuxing_taozhuang= explode("|", $muban_taozhuangs['six']);
    $shuxing_qixue+=$shuxing_taozhuang['0'];
$shuxing_fali+=$shuxing_taozhuang['1'];
$shuxing_fangyu+=$shuxing_taozhuang['2'];
$shuxing_fagong+=$shuxing_taozhuang['3'];
$shuxing_wugong+=$shuxing_taozhuang['4'];
$shuxing_sudu+=$shuxing_taozhuang['5'];
  }else{
      if($taozhuang_b>="5"&&$muban_taozhuangs['Five']!=NULL){
    //激活5件套装
         //激活7件套装
    $shuxing_taozhuang= explode("|", $muban_taozhuangs['Five']);
    $shuxing_qixue+=$shuxing_taozhuang['0'];
$shuxing_fali+=$shuxing_taozhuang['1'];
$shuxing_fangyu+=$shuxing_taozhuang['2'];
$shuxing_fagong+=$shuxing_taozhuang['3'];
$shuxing_wugong+=$shuxing_taozhuang['4'];
$shuxing_sudu+=$shuxing_taozhuang['5'];
  }else{
      if($taozhuang_b>="3"&&$muban_taozhuangs['Three']!=NULL){
    //激活3件套装
         //激活7件套装
    $shuxing_taozhuang= explode("|", $muban_taozhuangs['Three']);
    $shuxing_qixue+=$shuxing_taozhuang['0'];
$shuxing_fali+=$shuxing_taozhuang['1'];
$shuxing_fangyu+=$shuxing_taozhuang['2'];
$shuxing_fagong+=$shuxing_taozhuang['3'];
$shuxing_wugong+=$shuxing_taozhuang['4'];
$shuxing_sudu+=$shuxing_taozhuang['5'];
  }else{
      if($taozhuang_b>="1"&&$muban_taozhuangs['one']!=NULL){
    //激活1件套装
         
    $shuxing_taozhuang= explode("|", $muban_taozhuangs['one']);
    $shuxing_qixue+=$shuxing_taozhuang['0'];
$shuxing_fali+=$shuxing_taozhuang['1'];
$shuxing_fangyu+=$shuxing_taozhuang['2'];
$shuxing_fagong+=$shuxing_taozhuang['3'];
$shuxing_wugong+=$shuxing_taozhuang['4'];
$shuxing_sudu+=$shuxing_taozhuang['5'];
  }else{
    //否则不激活
  }
   
  }
  }
  }
}
}
if($user_leixing=="users"){
//转生加成
if($user['zhuansheng']>"0" && $user['zhuansheng']<"4"){
for($zss=0;$zss<$user['zhuansheng'];$zss++){
 $shuxing_qixue+="48880";
$shuxing_fali+="40540";
$shuxing_fangyu+="18880";
$shuxing_wugong+="18880";
$shuxing_fagong+="18880";
$shuxing_sudu+="8888";   
}
}else{
    if($user['zhuansheng']>"5"){
        $user['zhuansheng']="5";
    }
	for($zss=0;$zss<$user['zhuansheng'];$zss++){
 $shuxing_qixue+="68880";
$shuxing_fali+="60540";
$shuxing_fangyu+="18880";
$shuxing_wugong+="28880";
$shuxing_fagong+="28880";
$shuxing_sudu+="18888";   
}
}
}
$maxqixue/=100;
$maxfali/=100;
$maxfangyu/=100;
$maxgongji/=100;
$maxgongji_fa/=100;
$maxsudu/=100;
$xidian_qixue*=1+$maxqixue;
$xidian_fali*=1+$maxfali;
$xidian_fangyu*=1+$maxfangyu;
$xidian_fagong*=1+$maxgongji_fa;
$xidian_wugong*=1+$maxgongji;
$xidian_sudu*=1+$maxsudu;
$shuxing_qixue+=$xidian_qixue;
$shuxing_fali+=$xidian_fali;
$shuxing_fangyu+=$xidian_fangyu;
$shuxing_wugong+=$xidian_wugong;
$shuxing_fagong+=$xidian_fagong;
$shuxing_sudu+=$xidian_sudu;
$shuxing_mianshang=1-$shuxing_mianshang;
$shuxing_mianshang*=100;
//最后将属性写入数据库
$sql2="update $user_leixing  set qixuemax='".$shuxing_qixue."',fali_max='".$shuxing_fali."',fangyu='".$shuxing_fangyu."', gongji='".$shuxing_wugong."',gongji_fa='".$shuxing_fagong."',sudu='".$shuxing_sudu."',pojia='".$shuxing_pojia."',mianshang='".$shuxing_mianshang."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);

//更新用户爵位

if($user_leixing=="users"){
$juewei="0|100|500|1500|3000|5000|10000";
$juewei = explode("|", $juewei); 
for($jw=0;$jw<count($juewei);$jw++)
{
    if($user[chongzhi]>$juewei[$jw]){
        $user[juewei]=$jw;
    }else{
        break;
    }
}
$sql2="update users  set juewei='".$user[juewei]."' where id='".$user[id]."'";
$ok=mysqli_query($db,$sql2);
}
	return $shuxing_qixue;

}



