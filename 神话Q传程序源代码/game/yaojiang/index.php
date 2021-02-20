<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
if($user[dengji]>="30"){
echo "<a href='/map.games'>返回地图</a><br/>";
$jiangli="111|222|333|444|555|666|777|888|999|1001";//中奖号码
$jiangli_wupin="xjsj,10|xjsj,10|xjsj,10|xjsj,10|xjsj,10|xjsj,10|xjsj,10|xjsj,10|xjsj,10|gold,100";//中奖奖品
$jiangli_wupin_shuliang="9,9|5,5|10,10|8,8|7,7|6,6|11,11|18,18|10,10|10000000,10000000";//中奖奖品数量
$jiangli_wupin_jilv="10000|10000|10000|10000|10000|10000|10000|10000|10000";//中奖奖品几率
if($_GET['mys']){
//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
//统计幸运符数量
$tongji_shu=mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='208' and userid='".$userid."'");
$tongji_shu=mysqli_fetch_array($tongji_shu);
if(!$tongji_shu[shuliang]){
$tongji_shu[shuliang]="0";
}
if($tongji_shu[shuliang]>'0'){
	$tongji_shu[shuliang]-='1';
	$wp208='wp,208';
	if($xyz->kou_beibao($wp208,"1",$userid)=="ok"){
		$suiji=mt_rand(0001,1009);

$jiangli_id= explode("|", $jiangli);
$jiangli_wupin_id= explode("|", $jiangli_wupin);
$jiangli_wupin_shuliang_id= explode("|", $jiangli_wupin_shuliang);
$jiangli_wupin_jilv_id= explode("|", $jiangli_wupin_jilv);
$chou=count($jiangli_id)-1;
for ($i = 0;$i<count($jiangli_id); $i++) {
	if(strpos($suiji,$jiangli_id[$i])!== false){
	echo'获得号码：'.$suiji.'，中奖了！获得：';
	echo $huode_jiangli= $xyz->beibao($jiangli_wupin_id[$i],$jiangli_wupin_shuliang_id[$i],$jiangli_wupin_jilv_id[$i],10,$userid,'','');
	$s="insert into news(text,time,userid) values('鸿运当头，摇奖中获得【".$huode_jiangli."】幸运号码。','".$pass."','$userid')";
$ok=mysqli_query($db,$s);
	mysqli_query($db,"COMMIT");
	echo'<br/><a href="index">继续摇奖</a><br/>';
	break;//跳出循环
}else{
	if($i==$chou){
	echo'获得号码：'.$suiji.'！非常遗憾！你没有中奖。<br/>
		<a href="index">继续摇奖</a><br/>';
	}
}

}
$s="insert into yaojiang(haoma,time,userid) values('".$suiji."','".time()."','".$userid."')";
$ok=mysqli_query($db,$s);
}else{
	echo"你没有摇奖盒<br/>";
mysqli_query($db,"ROLLBACK");
}
}else{
	echo"你没有摇奖盒<br/>";
mysqli_query($db,"ROLLBACK");
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");//自动提交
}else{
    echo"-------------------------------<br/><img src='/img/yao.png'height='100'/><br/>
		
		<a href='index?mys=ududhduhwuduwbbdwffwf'>摇一下奖</a>(需要摇奖盒*1)
		<br/>-------------------------------<br/>";
        //解读充值奖励	
        
$jianglihao= explode("|",$jiangli);
$jiangliid = explode("|",$jiangli_wupin); 
$shuliang = explode("|",$jiangli_wupin_shuliang);
$huode_html="";
  $leixing="";
  	for($j=0;$j<count($jiangliid);$j++)
{
$jiangli_one= explode(",", $jiangliid[$j]);
$shuliang_one= explode(",", $shuliang[$j]);
$suiji=mt_rand($shuliang_one[0],$shuliang_one[1]);
switch($jiangli_one[0]){
case"wp":
$wupin_name=mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$jiangli_one[1]."'");
$wupin_name=mysqli_fetch_array($wupin_name);
$leixing="(物品)";
break;
case"zb":
$wupin_name= mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$jiangli_one[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);
switch ($wupin_name[leixing]) {
  case "maozi":
    $zhuangbei_leixing="帽子";
    break;
  case "xianglian":
    $zhuangbei_leixing="项链";
    break;
  case "yifu":
    $zhuangbei_leixing="衣服";
    break;
  case "wuqi":
    $zhuangbei_leixing="武器";
    break;
  case "xiezi":
    $zhuangbei_leixing="鞋子";
    break;
      case "ps1":
    $zhuangbei_leixing= "发饰";
    break;  
  case "ps2":
    $zhuangbei_leixing= "翅膀>";
    break;
      case "ps3":
    $zhuangbei_leixing= "披风";
    break;
      case "ps4":
    $zhuangbei_leixing= "戒指";
    break;
      case "ps5":
    $zhuangbei_leixing= "腰带";
    break;
      case "ps6":
    $zhuangbei_leixing= "手镯";
    break;
      case "ps7":
    $zhuangbei_leixing= "勋章";
    break;
      case "ps8":
    $zhuangbei_leixing= "耳环";
    break;
       case "fw":
    $zhuangbei_leixing= "符文";
    break;
     case "sz1":
    $zhuangbei_leixing= "头饰";
    break;  
  case "sz2":
    $zhuangbei_leixing= "背饰";
    break;
      case "sz3":
    $zhuangbei_leixing= "吊坠";
    break;
      case "sz4":
    $zhuangbei_leixing= "上衣";
    break;
      case "sz5":
    $zhuangbei_leixing= "袜子";
    break;
    
    

  default:
    echo "系统错误";
exit();
    break;
}
$leixing="(".$zhuangbei_leixing.")";
//判断是物品还是装备结束
break;
case"gold":
$wupin_name[name]="金币";
$leixing="";
break;
case"jingyan":
$wupin_name[name]="经验";
$leixing="";
break;
case"xjsj":
$wupin_name[name]="心愿水晶";
$leixing="(稀有)";
break;
default:
break;
}
echo"<small> 摇出".$jianglihao[$j]."可获得：<b>".$wupin_name[name].$leixing."*".$suiji."</b></small><br/>";

}

		

}
echo "<br/>------------------------<br/>【最新摇奖动态】<br/>";
$result = mysqli_query($db,"SELECT * FROM yaojiang  order by id desc limit 30");
while($row = mysqli_fetch_array($result))
  {
      echo user_name($row[userid])."获得幸运号".$row[haoma]."<br/>";
  }
}else{
    echo"摇奖等级达到30级后开启";
}
echo "<br/><a href='/map.games'>返回地图</a>";?>