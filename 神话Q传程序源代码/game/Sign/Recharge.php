<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$mys=$_GET['my'];

$oldtime = '2021-02-10 00:00:00'; //开始时间
$newstime = '2021-02-18 00:00:00';//结束时间
 $catime = strtotime($oldtime);
 $tatime = strtotime($newstime);

echo"<a href='/map.games?id=$user[map]'>返回地图</a><br/><a href='Sign.php'>签到奖励</a>|充值奖励<br/>活动时间即刻~02月17日<br/>";
if($xyz->beibao_rongliang($userid)<"500"){
    echo"你当前背包可用容量低于300！请确保背包容量足够放下道具！<br/>";
}

// //更新排行榜
if($userid!="1"){
    if(time()<$catime){
        echo"活动未开始<br/>";
        exit();
    }
    if(time()>$tatime){
        echo"活动已结束<br/>";
        exit();
    }
}

$jine="0";
//获取用户充值金额
//获取当前地图NPC
$result = mysqli_query($db,"select * from pay_jiangli WHERE userid='".$userid."'");
$row = mysqli_fetch_array($result);
if(!$row){
//没有表创建一个
$s="insert into pay_jiangli(userid) values('".$userid."')";
$ok=mysqli_query($db,$s);
}

$result = mysqli_query($db,"select * from shsj WHERE time>'".$catime."' and zhuangtai='1' and userid='".$userid."'");
while($row = mysqli_fetch_array($result))
  {
$jine+=$row[gold];
  }
  if(!$jine){
  	$jine+=0;
  }
  $jine22=98-$jine;
   if($jine22<"0"){
  	$jine22=0;
  }
echo "已<a href='/alipay/wappay/shsj'>充值</a><small>".$jine."</small>元【<a href='/alipay/wappay/shsj'>点这里充值</a>】<br/>";


//每日签到奖励
if($mys){
   switch($mys){
case"1":
$huode_id="shenzhoubi,0";
$huode_shuliang="120,120";
$huode_jilv="10000";
$huode_jine="6";
break;
case"2":
$huode_id="shenzhoubi,0|wp,79";
$huode_shuliang="360,360|1,1";
$huode_jilv="10000|10000|10000";
$huode_jine="18";
break;
case"3":
$huode_id="shenzhoubi,0|wp,79";
$huode_shuliang="720,720|1,1";
$huode_jilv="10000|10000";
$huode_jine="36";
break;
case"4":
$huode_id="wp,373|wp,21";
$huode_shuliang="1,1|1000,1000";
$huode_jilv="10000|10000";
$huode_jine="68";
break;
case"5":
$huode_id="zb,325";
$huode_shuliang="1,1";
$huode_jilv="10000";
$huode_jine="138";
break;
case"6":
$huode_id="zb,322";
$huode_shuliang="1,1";
$huode_jilv="10000";
$huode_jine="324";
break;
case"7":
$huode_id="wp,79|zb,264";
$huode_shuliang="101,101|1,1";
$huode_jilv="10000|10000";
$huode_jine="648";
break;
case"8":
$huode_id="wp,79|zb,265";
$huode_shuliang="101,101|1,1";
$huode_jilv="10000|10000";
$huode_jine="1080";
break;
case"9":
$huode_id="zb,323";
$huode_shuliang="1,1";
$huode_jilv="10000|10000";
$huode_jine="2000";
break;
case"10":
$huode_id="zb,324";
$huode_shuliang="1,1";
$huode_jilv="10000|10000";
$huode_jine="3000";
break;
default:
$mys=NULL;
break;
}
if($jine>=$huode_jine){
$result = mysqli_query($db,"select * from pay_jiangli WHERE userid='".$userid."'");
$row = mysqli_fetch_array($result);
if($row['jl'.$mys]==NULL){
//设置已领奖励 
$jishu="jl".$mys;
$sql2="update pay_jiangli set $jishu='1' where userid='".$userid."'";
$ok=mysqli_query($db,$sql2);
if($ok){
echo "恭喜你获得：<font color='red'>";
echo $xyz->beibao($huode_id,$huode_shuliang,$huode_jilv,"100",$userid," "," ");
echo "</font><br/>";
}
}else{
echo "你已领取该奖励<br/>";
}
}else{
echo "未达到充值要求。<br/>";
}
}





echo"--------------<br/>";
//定义奖励数量
for ($i=1; $i <=10; $i++) {
   switch($i){
case"1":
$huode_id="shenzhoubi,0";
$huode_shuliang="120,120";
$huode_jilv="10000";
$huode_jine="6";
break;
case"2":
$huode_id="shenzhoubi,0|wp,79";
$huode_shuliang="360,360|1,1";
$huode_jilv="10000|10000|10000";
$huode_jine="18";
break;
case"3":
$huode_id="shenzhoubi,0|wp,79";
$huode_shuliang="720,720|1,1";
$huode_jilv="10000|10000";
$huode_jine="36";
break;
case"4":
$huode_id="wp,373|wp,21";
$huode_shuliang="1,1|1000,1000";
$huode_jilv="10000|10000";
$huode_jine="68";
break;
case"5":
$huode_id="zb,325";
$huode_shuliang="1,1";
$huode_jilv="10000";
$huode_jine="138";
break;
case"6":
$huode_id="zb,322";
$huode_shuliang="1,1";
$huode_jilv="10000";
$huode_jine="324";
break;
case"7":
$huode_id="wp,79|zb,264";
$huode_shuliang="101,101|1,1";
$huode_jilv="10000|10000";
$huode_jine="648";
break;
case"8":
$huode_id="wp,79|zb,265";
$huode_shuliang="101,101|1,1";
$huode_jilv="10000|10000";
$huode_jine="1080";
break;
case"9":
$huode_id="zb,323";
$huode_shuliang="1,1";
$huode_jilv="10000|10000";
$huode_jine="2000";
break;
case"10":
$huode_id="zb,324";
$huode_shuliang="1,1";
$huode_jilv="10000|10000";
$huode_jine="3000";
break;

default:
$mys=NULL;
break;
}
    //解读充值奖励	
$jiangli = explode("|", $huode_id); 
$shuliang = explode("|",$huode_shuliang);
$huode_html="";
  $leixing="";
  	for($j=0;$j<count($jiangli);$j++)
{
$jiangli_one= explode(",", $jiangli[$j]);
$shuliang_one= explode(",", $shuliang[$j]);
$suiji=mt_rand($shuliang_one[0],$shuliang_one[1]);
switch($jiangli_one[0]){
case"wp":
$wupin_name=mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$jiangli_one[1]."'");
$wupin_name=mysqli_fetch_array($wupin_name);
$wupin_name[name]="<a href='/gongshi/wupin_text?id=$wupin_name[id]'>$wupin_name[name]</a>";
$leixing="(物品)";
break;
case"zb":
$wupin_name= mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$jiangli_one[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);
$wupin_name[name]="<a href='/gongshi/zhuangbei_text?id=$wupin_name[id]'>$wupin_name[name]</a>";
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
break;
case"jingyan":
$wupin_name[name]="经验";
break;
case"shenzhoubi":
$wupin_name[name]="神州币";
break;
case"xjsj":
$wupin_name[name]="心愿水晶";
$leixing="(稀有)";
break;
default:
break;
}


$huode_html.=$wupin_name[name]."".$leixing."*".$suiji." ";

}
$result = mysqli_query($db,"select * from pay_jiangli WHERE userid='".$userid."'");
$row = mysqli_fetch_array($result);
//定义数据

if($row[jl.$i]==NULL){
$jl1="未领取";
}else{
$jl1="已领取";
}
echo"<small> 充值".$huode_jine."元神州币可获得：<b>".$huode_html."</b></small> <a href='./Recharge?my=".$i."'>点击领取</a><br/>";
}
$html=<<<HTML

<a href='/map.games?id=$user[map]'>返回地图</a>
HTML;
echo $html;

