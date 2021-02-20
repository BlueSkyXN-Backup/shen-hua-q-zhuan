<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$id=$_GET['id'];




$muban = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$id."'");
$muban = mysqli_fetch_array($muban);

if($muban[img]!="0"){
$img="<img src='/img/$muban[img]' height='300' alt='$muban[name]' /><br/>";
}
echo "".$muban[name]."<br/>----------<br/>".$img."<br/>$muban[text]<br/>----------<br/>";
//判断是否是药品消耗品
$shuxing_dian=$muban['dengji'];
$shuxing_dian*=2;

//计算怪物成长率
$chengzhanglv=rand($muban['chengzhanglv'],$muban['chengzhanglvs']);
$shuxing_dian1=$muban['chengzhanglv']/100*$shuxing_dian;
$shuxing_dian2=$muban['chengzhanglvs']/100*$shuxing_dian;


$xidian_qixuemax=$muban['qixue_max'];
$xidian_falimax=$muban['fali_max'];
$xidian_fangyu=$muban['fangyu'];
$xidian_fagong=$muban['fagong'];
$xidian_wugong=$muban['wugong'];
$xidian_sudu=$muban['sudu'];
//
$qixue1=ceil($xidian_qixuemax*$shuxing_dian1);
$fali1=ceil($xidian_falimax*$shuxing_dian1);
$fangyu1=ceil($xidian_fangyu*$shuxing_dian1);
$fagong1=ceil($xidian_fagong*$shuxing_dian1);
$wugong1=ceil($xidian_wugong*$shuxing_dian1);
$sudu1=ceil($xidian_sudu*$shuxing_dian1);
//
$qixue2=ceil($xidian_qixuemax*$shuxing_dian2);
$fali2=ceil($xidian_falimax*$shuxing_dian2);
$fangyu2=ceil($xidian_fangyu*$shuxing_dian2);
$fagong2=ceil($xidian_fagong*$shuxing_dian2);
$wugong2=ceil($xidian_wugong*$shuxing_dian2);
$sudu2=ceil($xidian_sudu*$shuxing_dian2);
//取整
$chengzhang1=$muban['chengzhanglv']/100;
$chengzhang2=$muban['chengzhanglvs']/100;





$xuyao_wupinid = explode("|", $muban[diaoluo_id]); 

for($j=0;$j<count($xuyao_wupinid);$j++)
{
$xuyaowupinid= explode(",", $xuyao_wupinid[$j]); 

switch($xuyaowupinid[0]){
case"wp":
$wupin_name=mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$xuyaowupinid[1]."'");
$wupin_name=mysqli_fetch_array($wupin_name);
break;
case"zb":
$wupin_name= mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$xuyaowupinid[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);
break;
default:
break;
}
$diaoluo.="、".$wupin_name[name];
}

echo"等级：".$muban[dengji]."<br/>";
echo"成长率：".$chengzhang1."~".$chengzhang2."<br/>";

echo"气血：".$qixue1."~".$qixue2."<br/>";
echo"法力：".$fali1."~".$fali2."<br/>";
echo"防御：".$fangyu1."~".$fangyu2."<br/>";
echo"法攻：".$fagong1."~".$fagong2."<br/>";
echo"物攻：".$wugong1."~".$wugong2."<br/>";
echo"速度：".$sudu1."~".$sudu2."<br/>";
echo"概率掉落道具：金条、经验".$diaoluo;

echo "<br/><a href='guaiwu'>图鉴首页</a> <br/>";

echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";




?>
