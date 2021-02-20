<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
$class_renwu=new renwu();
class renwu{
//任务相关函数
public function wen($renwuid,$userid){
	global $db;//数据连接
	$renwu = mysqli_query($db,"SELECT * FROM renwu WHERE id='".$renwuid."'");
$renwu = mysqli_fetch_array($renwu);
$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);
	switch($renwu[leibie]){
case"shouji":	
$xuyao_wupinid = explode("|", $renwu[xuyao_id]); 
$xuyao_shuliang= explode("|", $renwu[xuyao_shu]); 
$xuyao_if=count($xuyao_wupinid );
$xuyao="0";//定义完成任务有几个条件
for($j=0;$j<count($xuyao_wupinid );$j++)
{
$x=$j;
$xuyaowupinid= explode(",", $xuyao_wupinid[$x]); 
$suiji=$xuyao_shuliang[$x];
switch($xuyaowupinid[0]){
case"wp":
$wupin_name=mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$xuyaowupinid[1]."'");
$wupin_name=mysqli_fetch_array($wupin_name);
//统计背包有几件还物品
$tongji_shu=mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$xuyaowupinid[1]."' and userid='".$userid."'");
$tongji_shu=mysqli_fetch_array($tongji_shu);
if($tongji_shu[shuliang]>=$suiji){
	$xuyao+="1";
}

break;
case"zb":
$wupin_name= mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$xuyaowupinid[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);
//判断是物品还是装备结束
$result=mysqli_query($db,"SELECT * FROM zhuangbei WHERE shiyong='no' and yuanshi='".$xuyaowupinid[1]."' and userid='".$userid."'");
$zb_suiji=mysqli_num_rows($result);
if($zb_suiji>=$suiji){
	$xuyao+="1";
}
break;
case"pet":
$wupin_name= mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$xuyaowupinid[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);
if($xuyaowupinid[2]){
$wupin_name[name]=$xuyaowupinid[2]."级".$wupin_name[name];
}
$result=mysqli_query($db,"SELECT * FROM pet WHERE maozi='0' and xianglian='0' and yifu='0' and wuqi='0' and xiezi='0' and ps1='0' and ps2='0' and ps3='0' and ps4='0' and ps5='0' and ps6='0' and ps7='0' and ps8='' and sz1='0' and sz2='0' and sz3='0' and sz4='0' and sz5='0' and fw1='0' and fw2='0' and fw3='0' and fw4='0' and fw5='0' and muban='".$xuyaowupinid[1]."' and dengji>='".$xuyaowupinid[2]."' and userid='".$userid."'");
$pet_suiji=mysqli_num_rows($result);
if($pet_suiji>=$suiji){
	$xuyao+="1";
}

break;


case"jingyan":
$wupin_name[name]="经验";
if($user[jingyan]>=$suiji){
	$xuyao+="1";
}
break;
case"gold":
$wupin_name[name]="金币";
if($user[gold]>=$suiji){
	$xuyao+="1";
}
break;
case"zuie":
$wupin_name[name]="罪恶";
if($user[zuie]>=$suiji){
	$xuyao+="1";
}
break;
default:

break;
}
}
//判断是否完成任务
if($xuyao_if==$xuyao){
	$wanchengrenwu="<img src='/img/wen.gif'/>";
}else{
	$wanchengrenwu="<img src='/img/wenno.png'/>";
}

	//物品收集结束
break;
case"jisha":
//击杀怪物
	$jiasha_id = explode("|", $renwu[jisha_guaiwu]); 
$jisha_shuliang= explode("|", $renwu[jisha_shu]); 
$if_jisha="0";
$ajs=count($jiasha_id);
for($j=0;$j<$ajs;$j++)
{
	$guaiwu1 = mysqli_query($db,"SELECT * FROM renwu_guaiwu WHERE renwuid='".$renwuid."' and guaiwuid='".$jiasha_id[$j]."' and userid='".$userid."'");
$guaiwu1 = mysqli_fetch_array($guaiwu1);
if(!$guaiwu1){}
if($guaiwu1[shuliang]<=$guaiwu1[shuliang_my]){
		$if_jisha+="1";
}
}
if($if_jisha==$ajs){
	$wanchengrenwu="<img src='/img/wen.gif'/>";
}else{
	$wanchengrenwu="<img src='/img/wenno.png'/>";
}
break;
case"duihua":
	$wanchengrenwu="<img src='/img/wen.gif'/>";
break;

}
return $wanchengrenwu;
}
	//打怪后统计怪物数量
	public function jishu_guaiwu($guaiwuid,$userid){
	global $db;//数据连接
	$resultl = mysqli_query($db,"SELECT * FROM renwu_guaiwu WHERE guaiwuid='".$guaiwuid."' and userid='".$userid."' order by id desc limit 1");
$renwu_guaiwu = mysqli_fetch_array($resultl);
if ($renwu_guaiwu){
$renwu = mysqli_query($db,"SELECT * FROM renwu WHERE id='".$renwu_guaiwu[renwuid]."'");
$renwu = mysqli_fetch_array($renwu);
$renwu_guaiwu[shuliang_my]+="1";
if($renwu_guaiwu[shuliang]<=$renwu_guaiwu[shuliang_my]){
$jingdu="已完成";
}else{
$jingdu="".$renwu_guaiwu[shuliang_my]."/".$renwu_guaiwu[shuliang]."";
}
$renwu="<a href='/task/index.task?id=$renwu[id]'>".$renwu[name]."</a>[击杀该怪物(".$jingdu.")]";
$sql4="update renwu_guaiwu set shuliang_my='".$renwu_guaiwu[shuliang_my]."' where id='".$renwu_guaiwu[id]."'";
$ok=mysqli_query($db,$sql4);if($ok){
    mysqli_query($db,"COMMIT");//数据提交
}else{
        
	mysqli_query($db,"ROLLBACK");
    }

}
	
return $renwu;
	}
	
	
	
//特殊任务提交
public function qita($leixing,$userid)//打入类型、用户id
{
    	global $db;//数据连接
    		global $user;//用户参数
    	switch($leixing){
case"qianghua":	
break;
case"wp":

break;
    	}
}
	
	
	
}


