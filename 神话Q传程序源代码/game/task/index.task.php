<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$renwuid=$_GET['id'];
$renwutext=$_GET['my'];

$resultl = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$renwuid."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){
$jieshou="yes";
}else{
$jieshou="no";
if($renwu[dengji]<=$user[dengji] && $renwu[dengji_max]>=$user[dengji]){
//符合任务进度
//不符合剧任务进度
echo "你不能接受该任务";
echo "<a href='/npc.do?id=$renwu[npc]'>返回NPC</a><br/>";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";

exit();
}
}

$renwu = mysqli_query($db,"SELECT * FROM renwu WHERE id='".$renwuid."'");
$renwu = mysqli_fetch_array($renwu);

//判断是否是剧情任务
if($renwu[leixing]=="juqing"){
if($renwu[juqing_dengji]==$user[juqing]){
//符合剧情任务进度
}else{
//不符合剧情任务进度
echo "你不能接受该剧情任务";
echo "<a href='/npc.do?id=$renwu[npc]'>返回NPC</a><br/>";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";

exit();
}
}


//判断是否是日常任务
if($renwu[leixing]=="richang"){



//判断日常
$resultl = mysqli_query($db,"SELECT * FROM renwu_one WHERE leibie='richang' and userid='".$userid."'");
$rc = mysqli_fetch_array($resultl);
if($rc[shuliang]>="10"){
echo "你已经超过今日可接受日常任务数量，明天再来吧！";
echo "<a href='/npc.do?id=$renwu[npc]'>返回NPC</a><br/>";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";

exit();	
}
if($rc[shuliang]=="9"){
$jiangli_xjsj="心愿水晶*1<br/>";
}

}


//不等于1就是任务介绍，否则是任务对话
if($renwutext==""){
//解读任务奖励
$jianglis_wupinid = explode("|", $renwu[jiangli_id]); 
$jianglis_shuliang= explode("|", $renwu[jiangli_shu]); 
for($j=0;$j<count($jianglis_wupinid);$j++)
{
$x=$j;
$wupinids = explode(",", $jianglis_wupinid[$x]); 
$suiji=$jianglis_shuliang[$x];
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
case"pet":
$wupin_name= mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$wupinids[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);
if($wupinids[2]){
$wupin_name[name]=$wupinids[2]."级".$wupin_name[name];
}
break;
case"jingyan":
		if($renwu[leixing]=="richang"){
	//判断日常
$resultl = mysqli_query($db,"SELECT * FROM renwu_one WHERE leibie='richang' and userid='".$userid."'");
$rc = mysqli_fetch_array($resultl);	
if($rc[shuliang]){
	$jingyan_rc=$suiji*$rc[shuliang];
	$suiji+=$jingyan_rc;
}
	}
$wupin_name[name]="经验";
break;
case"gold":
$wupin_name[name]="金币";

break;
case"shenzhoubi":
$wupin_name[name]="神州币";

break;
case"zuie":
$wupin_name[name]="罪恶";
break;
default:

break;
}
$renwu_jiangliwupin.="$wupin_name[name]*".$suiji."<br/>";
//解读任务奖励
}

//收集物品装备
if($renwu[leibie]=="shouji"){
//任务需要物品
$xuyao_wupinidss = explode("|", $renwu[xuyao_id]); 
$xuyao_shuliang= explode("|", $renwu[xuyao_shu]); 
$xuyao_wupin.="物品名(拥有/需要)<br/>";
for($j=0;$j<count($xuyao_wupinidss);$j++)
{
$x=$j;
$xuyaowupinid=explode(",", $xuyao_wupinidss[$x]); 
$suiji=$xuyao_shuliang[$x];
switch($xuyaowupinid[0]){
case"wp":
$wupin_name=mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$xuyaowupinid[1]."'");
$wupin_name=mysqli_fetch_array($wupin_name);
//统计背包有几件还物品
$tongji_shu=mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$xuyaowupinid[1]."' and userid='".$userid."'");
$tongji_shu=mysqli_fetch_array($tongji_shu);
    if(!$tongji_shu[shuliang]){
    $tongji_shu[shuliang]="0";
    }
$xuyao_wupin.="$wupin_name[name]($tongji_shu[shuliang]/".$suiji.")<br/>";

break;
case"zb":
$wupin_name= mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$xuyaowupinid[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);
//判断是物品还是装备结束
$result=mysqli_query($db,"SELECT * FROM zhuangbei WHERE shiyong='no' and yuanshi='".$xuyaowupinid[1]."' and userid='".$userid."' and time is null");
$zb_suiji=mysqli_num_rows($result);
$xuyao_wupin.="$wupin_name[name](".$zb_suiji."/".$suiji.")<br/>";
break;
case"pet":
$wupin_name= mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$xuyaowupinid[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);
if($xuyaowupinid[2]){
$wupin_name[name]=$xuyaowupinid[2]."级".$wupin_name[name];
}
$result=mysqli_query($db,"SELECT * FROM pet WHERE maozi='0' and xianglian='0' and yifu='0' and wuqi='0' and xiezi='0' and ps1='0' and ps2='0' and ps3='0' and ps4='0' and ps5='0' and ps6='0' and ps7='0' and ps8='' and sz1='0' and sz2='0' and sz3='0' and sz4='0' and sz5='0' and fw1='0' and fw2='0' and fw3='0' and fw4='0' and fw5='0' and muban='".$xuyaowupinid[1]."' and dengji>='".$xuyaowupinid[2]."' and userid='".$userid."'");
$pet_suiji=mysqli_num_rows($result);
$xuyao_wupin.="$wupin_name[name]($pet_suiji/".$suiji.")【只显示未穿戴装备的】<br/>";


break;

case"jingyan":
$wupin_name[name]="经验";
$xuyao_wupin.="$wupin_name[name]($user[jingyan]/".$suiji.")<br/>";

break;
case"gold":
$wupin_name[name]="金币";
$xuyao_wupin.="$wupin_name[name]($user[gold]/".$suiji.")<br/>";

break;
case"shenzhoubi":
$wupin_name[name]="神州币";
$xuyao_wupin.="$wupin_name[name]($user[shenzhoubi]/".$suiji.")<br/>";

break;
case"zuie":
$wupin_name[name]="罪恶";
$xuyao_wupin.="$wupin_name[name]($user[zuie]/".$suiji.")<br/>";

break;
default:

break;
}

}
}




//称谓奖励
if($renwu[chengwei]==""){
}else{
$jiangli_chengwei="称谓:".$renwu[chengwei]."<br/>";
}

//击杀怪物任务
if($renwu[leibie]=="jisha"){
	$jisha=null;
	$jiasha_id = explode("|", $renwu[jisha_guaiwu]); 
$jisha_shuliang= explode("|", $renwu[jisha_shu]); 
for($j=0;$j<count($jiasha_id);$j++)
{
$guaiwu = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$jiasha_id[$j]."'");
$guaiwu = mysqli_fetch_array($guaiwu);

$guaiwu_map = mysqli_query($db,"SELECT * FROM map WHERE id='".$guaiwu[map]."'");
$guaiwu_map = mysqli_fetch_array($guaiwu_map);
$jisha.="前往<a href='/map.games?id=".$guaiwu_map[id]."'>".$guaiwu_map[name]."</a>击杀".$guaiwu[name]."*".$jisha_shuliang[$j]."<br/>";
}
}


$npc= mysqli_query($db,"SELECT * FROM npc WHERE id='".$renwu[npc_wancheng]."'");
$npc= mysqli_fetch_array($npc);
$npc_wancheng="与<a href='/npc.do?id=".$renwu[npc_wancheng]."'>".$npc[name]."</a>对话<br/>";

switch($jieshou){
  case "no":
//任务介绍页面
//任务要求


//获取任务奖励
$html=<<<HTML
【任务介绍】<br/>
$renwu[text]<br/>
【任务要求】<br/>
$xuyao_wupin
$jisha
$npc_wancheng
【任务奖励】<br/>
$renwu_jiangliwupin
$jiangli_xjsj
$jiangli_chengwei<br/>
<a href='/task/jieshou.task?id=$renwuid&jieshou=jieshou'>接受任务</a> <br/>
HTML;
break;
case"yes":
//称谓奖励
if($renwu[chengwei]==""){
}else{
$jiangli_chengwei="称谓:".$renwu[chengwei]."<br/>";
}

//击杀怪物任务
//击杀怪物任务
if($renwu[leibie]=="jisha"){
	$jisha=null;
	$jiasha_id = explode("|", $renwu[jisha_guaiwu]); 
$jisha_shuliang= explode("|", $renwu[jisha_shu]); 
for($j=0;$j<count($jiasha_id);$j++)
{
$guaiwu = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$jiasha_id[$j]."'");
$guaiwu = mysqli_fetch_array($guaiwu);
$guaiwu1 = mysqli_query($db,"SELECT * FROM renwu_guaiwu WHERE renwuid='".$renwuid."'and userid='".$userid."' and guaiwuid='".$jiasha_id[$j]."'");
$guaiwu1 = mysqli_fetch_array($guaiwu1);
$guaiwu_map = mysqli_query($db,"SELECT * FROM map WHERE id='".$guaiwu[map]."'");
$guaiwu_map = mysqli_fetch_array($guaiwu_map);
$jisha1.="前往<a href='/map.games?id=".$guaiwu_map[id]."'>".$guaiwu_map[name]."</a>击杀".$guaiwu[name]."*(".$guaiwu1[shuliang_my]."/".$guaiwu1[shuliang].")<br/>";
}
}

//获取任务奖励
if($_GET['wanchengjiaofu']){
    $html=<<<HTML
【任务介绍】<br/>
$renwu[text]<br/>
【任务要求】<br/>
$xuyao_wupin
$jisha1
$npc_wancheng
【任务奖励】<br/>
$renwu_jiangliwupin
$jiangli_xjsj
$jiangli_chengwei<br/>
<a href='/task/Obtain.task?id=$renwuid&mys=yes'>确认完成任务</a> 
<br/>
HTML;
}else{
$html=<<<HTML
【任务介绍】<br/>
$renwu[text]<br/>
【任务要求】<br/>
$xuyao_wupin
$jisha1
$npc_wancheng
【任务奖励】<br/>
$renwu_jiangliwupin
$jiangli_xjsj
$jiangli_chengwei
<br/>
<a href='/task/fangqi.task?id=$renwuid&jieshou=fangqi'>放弃任务</a> <br/>
花费99999神州币完成任务
HTML;
}
break;
default:
echo"出现了未知错误";
break;
}
}elseif($renwutext=="2"){
//完成任务对话
$renwu_diuhua= explode("|", $renwu[text_wancheng]); 
for($j=0;$j<count($renwu_diuhua);$j++)
{
$duihua_go=explode(",", $renwu_diuhua[$j]); 
if($duihua_go[0]=="0"){
$npc = mysqli_query($db,"SELECT * FROM npc WHERE id='".$renwu[npc_wancheng]."'");
$npc = mysqli_fetch_array($npc);
$html.=$npc[name];
}elseif($duihua_go[0]=="1"){
$html.="我";
}else{
$html.="……";
}

$html.="：".$duihua_go[1]."<br/>";
}

if($renwu[wancheng_anniu]==""){
$renwu[wancheng_anniu]="好的，完成任务领取奖励";
}
$html.="<a href='/task/index.task?id=$renwuid&wanchengjiaofu=wancheng'>".$renwu[wancheng_anniu]."</a><br/><a href='/npc.do?id=$renwu[npc]'>下次再来交付任务</a> ";

}else{
//接受任务对话
$renwu_diuhua= explode("|", $renwu[text_jieshou]); 
for($j=0;$j<count($renwu_diuhua);$j++)
{
$duihua_go=explode(",", $renwu_diuhua[$j]); 
if($duihua_go[0]=="0"){
$npc = mysqli_query($db,"SELECT * FROM npc WHERE id='".$renwu[npc]."'");
$npc = mysqli_fetch_array($npc);
$html.=$npc[name];
}elseif($duihua_go[0]=="1"){
$html.="我";
}else{
$html.="……";
}

$html.="：".$duihua_go[1]."<br/>";
}

if($renwu[jieshou_anniu]==""){
$renwu[jieshou_anniu]="好的,马上去";
}
if($renwu[jieshou_no]==""){
$renwu[jieshou_no]="算了，我在想一想";
}
$html.="<a href='/task/index.task?id=$renwuid'>".$renwu[jieshou_anniu]."</a><br/><a href='/npc.do?id=$renwu[npc]'>".$renwu[jieshou_no]."</a> ";

}


echo $html;

echo "<br/><a href='/npc.do?id=$renwu[npc]'>返回NPC</a>";


