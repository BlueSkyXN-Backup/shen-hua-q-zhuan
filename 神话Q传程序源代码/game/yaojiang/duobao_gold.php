<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

echo "<a href='/map.games'>返回地图</a><br/>";
$jiangli="66|77|88|99";//中奖号码
$jiangli_wupin="zb,291|zb,292|zb,289|zb,290";//中奖奖品
$jiangli_wupin_shuliang="1,1|1,1|1,1|1,1";//中奖奖品数量
$jiangli_wupin_jilv="10000|10000|10000|10000";//中奖奖品几率
if($_GET['mys']){
//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
//统计幸运符数量

if($user[gold]>='888888'){
	$user[gold]-='888888';
	$sql2="update users set gold='".$user[gold]."' where id='".$userid."'";
$ok22=mysqli_query($db,$sql2);
	if($ok22){
		$suiji=mt_rand(001,100);

$jiangli_id= explode("|", $jiangli);
$jiangli_wupin_id= explode("|", $jiangli_wupin);
$jiangli_wupin_shuliang_id= explode("|", $jiangli_wupin_shuliang);
$jiangli_wupin_jilv_id= explode("|", $jiangli_wupin_jilv);
$chou=count($jiangli_id)-1;
for ($i = 0;$i<count($jiangli_id); $i++) {
	if(strpos($suiji,$jiangli_id[$i])!== false){
	echo'获得号码：'.$suiji.'，中奖了！获得：';
	echo $huode_jiangli= $xyz->beibao($jiangli_wupin_id[$i],$jiangli_wupin_shuliang_id[$i],$jiangli_wupin_jilv_id[$i],10,$userid,'','');
	$s="insert into news(text,time,userid) values('鸿运当头，金条夺宝中获得【".$huode_jiangli."】','".$pass."','$userid')";
$ok=mysqli_query($db,$s);
	mysqli_query($db,"COMMIT");
	echo'<br/><a href="duobao_gold">继续摇奖</a><br/>';
	break;//跳出循环
}else{
	if($i==$chou){
	echo'获得号码：'.$suiji.'！非常遗憾！你没有中奖。<br/>
		<a href="duobao_gold">继续夺宝</a><br/>';
	}
}

}
$s="insert into yaojiang(haoma,time,userid) values('".$suiji."','".time()."','".$userid."')";
$ok=mysqli_query($db,$s);
}else{
	echo"抽奖失败<br/><a href='duobao_gold'>继续夺宝</a><br/>";
mysqli_query($db,"ROLLBACK");
}
}else{
	echo"你没有足够的金条<br/><a href='duobao_gold'>继续夺宝</a><br/>";
mysqli_query($db,"ROLLBACK");
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");//自动提交
}else{
    echo"-------------------------------<br/><img src='/img/yao.png'height='100'/><br/>
		
		<a href='duobao_gold?mys=ududhduhwuduwbbdwffwf'>点击夺宝</a>(需要金条*888888)
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
echo "<br/>------------------------<br/>【最新摇奖/夺宝动态】<br/>";
$result = mysqli_query($db,"SELECT * FROM yaojiang  order by id desc limit 30");
while($row = mysqli_fetch_array($result))
  {
      echo user_name($row[userid])."获得幸运号".$row[haoma]."<br/>";
  }
echo "<br/><a href='/map.games'>返回地图</a>";?>