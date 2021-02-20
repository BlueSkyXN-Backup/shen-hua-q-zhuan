<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$id=$_GET['id'];




$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$id."'");
$wupin = mysqli_fetch_array($wupin);

if($wupin[img]!="0"){
$img="<img src='/img/$wupin[img]'  alt='$wupin[name]' /><br/>";
}
echo "".$wupin[name]."<br/>----------<br/>".$img."<br/>".$wupin[text]."<br/>物品体积：".$wupin[tiji]."<br/>----------<br/>";
//判断是否是药品消耗品
if($wupin[xiaohao]=="yes"){
$xiaohao_xiaoguo= explode("|", $wupin[xiaohao_xiaoguo]);
  for($j=0;$j<count($xiaohao_xiaoguo);$j++){
    //读取当前回复药剂效果
    $huifu_xiaohuo = explode(",", $xiaohao_xiaoguo[$j]); 
  switch($huifu_xiaohuo[0]){
case"hp":

$xiaoguo.="气血:".$huifu_xiaohuo[1]." ~".$huifu_xiaohuo[2]."点，";

break;
case"ap":
$xiaoguo.="法力:".$huifu_xiaohuo[1]." ~".$huifu_xiaohuo[2]."点，";

break;
case"huoli":
$xiaoguo.="活力:".$huifu_xiaohuo[1]." ~".$huifu_xiaohuo[2]."点，";

break;
case"beibao":
$xiaoguo.="背包空间:".$huifu_xiaohuo[1]." ~".$huifu_xiaohuo[2]."点，";

break;
case"chongwu":

$xiaoguo.="宠物容量:".$huifu_xiaohuo[1]." ~".$huifu_xiaohuo[2]."点，";
break;
case"shenzhoubi":
$xiaoguo.="神州币:".$huifu_xiaohuo[1]." ~".$huifu_xiaohuo[2]."点，";
break;
 
case"jingyan":
$xiaoguo.="经验:".$huifu_xiaohuo[1]." ~".$huifu_xiaohuo[2]."点，";
break;
      case"buff_jingyan":
$xiaoguo.="双倍经验:".$huifu_xiaohuo[1]." ~".$huifu_xiaohuo[2]."秒，";
break;
            case"buff_gold":
$xiaoguo.="双倍金币:".$huifu_xiaohuo[1]." ~".$huifu_xiaohuo[2]."秒，";
break;
default:

break;
}
 
  }
  echo"物品".$wupin[name]."的快捷效果：".$xiaoguo;
 
}




//判断是否是礼包
if($wupin[libao]=="yes"){


$huode_id=$wupin[libao_id];
$huode_shuliang=$wupin[libao_shu];
$huode_jilv=$wupin[libao_jilv];


//写入物品进入背包
$wupinid = explode("|", $huode_id); 
$shuliangx = explode("|", $huode_shuliang); 
$jilv = explode("|", $huode_jilv); 
for($j=0;$j<count($jilv);$j++)
{
$x=$j;
$suiji_jilv=mt_rand(0,10000);
$wupinid_x=$wupinid[$x];
$wupinids = explode(",", $wupinid_x); 
$shuliang_x=$shuliangx[$x];
$wpshuliang = explode(",", $shuliang_x);
$jilv[$x]/="100";

switch($wupinids[0]){
case"wp":
$wupin_name=mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$wupinids[1]."'");
$wupin_name=mysqli_fetch_array($wupin_name);
break;
case"zb":
$wupin_name= mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$wupinids[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);
//判断是物品还是装备结束
break;
case"gold":
$wupin_name[name]="金币";
break;
case"jingyan":
$wupin_name[name]="经验";
break;
default:

break;
}



if($wpshuliang[0]==$wpshuliang[1]){
	$huode_html.=$wupin_name[name]."".$wpshuliang[0]."个 <br/>";
}else{
$huode_html.=$wupin_name[name]."".$wpshuliang[0]."~".$wpshuliang[1]."个 <br/>";}

//for循环结束
}

//echo "<br/>打开礼包概率奖励:<br/>";
//echo $huode_html;








  }






//echo "<br/><a href='wupin.php'>物品公式大全</a> <br/>";

echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";




?>
