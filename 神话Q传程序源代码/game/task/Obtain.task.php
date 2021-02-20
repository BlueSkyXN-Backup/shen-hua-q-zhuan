<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
//任务接受
$userid=$_SESSION['users'];
$renwuid=$_GET['id'];
$mys=$_GET['mys'];
$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);
//调用用户数据
//接受任务或者放弃任务
$renwu = mysqli_query($db,"SELECT * FROM renwu WHERE id='".$renwuid."'");
$renwu = mysqli_fetch_array($renwu);
//判断等级是否达到要求
if($renwu[dengji]<=$user[dengji]){
}else{
echo "接受该任务需要等级达到".$renwu[dengji]."";
echo "<a href='/map.games?id=$user[map]'>只是路过</a> <br/>";
echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/><br/>";

exit();
}
//判断是否是剧情任务
if($renwu[leixing]=="juqing"){
if($renwu[juqing_dengji]==$user[juqing]){
//符合剧情任务进度
}else{
//不符合剧情任务进度
echo "你不能接受该剧情任务";
echo "<a href='/map.games?id=$user[map]'>只是路过</a> <br/>";
echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/><br/>";

exit();
}
}else{
//不是剧情任务则不执行
}


//判断是否是支线任务
if($renwu[leixing]=="zhixian"){
    $user_zhixian = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM users_zhixian WHERE zhixian_id='".$renwu[zhixian_id]."' and userid='".$userid."'"));
if($renwu[juqing_dengji]==$user_zhixian[zhixianjindu]){
//符合剧情任务进度
}else{
//不符合剧情任务进度
echo "你不能接受该支线任务";
echo "<a href='/map.games?id=$zhuangtai_map'>只是路过</a> <br/>";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
echo footer();
exit();
}
}



//
//
//
//现在开始写代码

  //开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
mysqli_query($db,"select * from beibao where userid='".$userid."' for update");//锁定该用户的所有物品
mysqli_query($db,"select * from zhuangbei where userid='".$userid."' for update");//锁定该用户的所有装备
mysqli_query($db,"select * from users where id='".$userid."' for update");//锁定该用户资料

//判断你提交的任务是否存在
//判断是否存在任务
$resultl = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$renwuid."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if($my){
}else{
echo "你没有接受该任务，怎么去完成任务啊？";
echo "<a href='/map.games?id=$user[map]'>只是路过</a> <br/>";
echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/><br/>";

exit();
}
$leibie=$renwu[leibie];
//物品收集
switch($leibie){
case"shouji":	
$xuyao_wupinid = explode("|", $renwu[xuyao_id]); 
$xuyao_shuliang= explode("|", $renwu[xuyao_shu]); 
$_SESSION['xuyao']=count($xuyao_wupinid );
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
$result=mysqli_query($db,"SELECT * FROM zhuangbei WHERE shiyong='no' and yuanshi='".$xuyaowupinid[1]."' and time is null and userid='".$userid."'");
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
case"shenzhoubi":
$wupin_name[name]="神州币";
if($user[shenzhoubi]>=$suiji){
	$xuyao+="1";
}
break;
default:

break;
}
}
//判断是否完成任务
if($_SESSION['xuyao']<=$xuyao){
	$wanchengrenwu="yes";
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
if($guaiwu1[shuliang]<=$guaiwu1[shuliang_my]){
		$if_jisha+="1";
}
}
if($if_jisha==$ajs){
	$wanchengrenwu="yes";
}
break;
case"duihua":
		$wanchengrenwu="yes";

break;

}







if($wanchengrenwu=="yes"){
if($mys!="yes"){
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
if($renwu[wancheng_no]==""){
$renwu[wancheng_no]="下次再来交付任务";
}
$html.="<a href='/task/index.task?id=$renwuid&wanchengjiaofu=wancheng'>".$renwu[wancheng_anniu]."</a><br/><a href='/npc.do?id=$renwu[npc]'>".$renwu[wancheng_no]."</a> ";
echo $html;
}else{
	if($renwu[leibie]=="shouji"){
//删除任务需要物品
$xuyao_wupinid = explode("|", $renwu[xuyao_id]); 
$xuyao_shuliang= explode("|", $renwu[xuyao_shu]); 
$_SESSION['xuyao']=count($xuyao_wupinid );
$xuyao="0";//定义完成任务有几个条件
for($j=0;$j<count($xuyao_wupinid );$j++)
{
$x=$j;
$xuyaowupinid= explode(",", $xuyao_wupinid[$x]); 
$suiji=$xuyao_shuliang[$x];
switch($xuyaowupinid[0]){
case"wp":
$tongji_shu=mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$xuyaowupinid[1]."' and userid='".$userid."'");
$tongji_shu=mysqli_fetch_array($tongji_shu);

$tongji_shu[shuliang]-=$suiji;
if($tongji_shu[shuliang]<"1"){

$sql3 = "delete from beibao where id ='".$tongji_shu[id]."'";
$ok=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$tongji_shu[shuliang]."' where id='".$tongji_shu[id]."'";
$ok=mysqli_query($db,$sql2);
}

break;
case"zb":
//判断是物品还是装备结束
$result=mysqli_query($db,"SELECT * FROM zhuangbei WHERE shiyong='no' and yuanshi='".$xuyaowupinid[1]."' and time is null and userid='".$userid."'");
$zb_suiji=mysqli_num_rows($result);

for($y=0;$y<$suiji;$y++)
{
 
$exec="select * from zhuangbei WHERE shiyong='no' and yuanshi='".$xuyaowupinid[1]."' and userid='".$userid."' order by id desc limit 1"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$sql3 = "delete from zhuangbei where id='".$row[id]."'";
$ok=mysqli_query($db,$sql3);
}
}
break;

case"pet":
$result=mysqli_query($db,"SELECT * FROM pet WHERE maozi='0' and xianglian='0' and yifu='0' and wuqi='0' and xiezi='0' and ps1='0' and ps2='0' and ps3='0' and ps4='0' and ps5='0' and ps6='0' and ps7='0' and ps8='' and sz1='0' and sz2='0' and sz3='0' and sz4='0' and sz5='0' and fw1='0' and fw2='0' and fw3='0' and fw4='0' and fw5='0' and muban='".$xuyaowupinid[1]."' and dengji>='".$xuyaowupinid[2]."' and userid='".$userid."'");
$pet_suiji=mysqli_num_rows($result);

for($y=0;$y<$suiji;$y++)
{
 
$exec="select * from pet WHERE maozi='0' and xianglian='0' and yifu='0' and wuqi='0' and xiezi='0' and ps1='0' and ps2='0' and ps3='0' and ps4='0' and ps5='0' and ps6='0' and ps7='0' and ps8='' and sz1='0' and sz2='0' and sz3='0' and sz4='0' and sz5='0' and fw1='0' and fw2='0' and fw3='0' and fw4='0' and fw5='0' and muban='".$xuyaowupinid[1]."' and dengji>='".$xuyaowupinid[2]."' and userid='".$userid."' order by id desc limit 1"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$sql3 = "delete from pet where id='".$row[id]."'";
$ok=mysqli_query($db,$sql3);
}
}
break;
case"jingyan":
$user[jingyan]-=$suiji;
$sql2="update users set jingyan='".$user[jingyan]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
break;
case"gold":
$user[gold]-=$suiji;
$sql2="update users set gold='".$user[gold]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
break;
case"zuie":
$user[zuie]-=$suiji;
$sql2="update users set zuie='".$user[zuie]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
break;
case"shenzhoubi":
$user[shenzhoubi]-=$suiji;
$sql2="update users set shenzhoubi='".$user[shenzhoubi]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
break;
default:

break;
}
}
//删除结束
}



	//这里执行完成任务后的删除表和奖励
	//解读任务奖励
$jianglis_wupinid = explode("|", $renwu[jiangli_id]); 
$jianglis_shuliang
= explode("|", $renwu[jiangli_shu]); 
for($j=0;$j<count($jianglis_wupinid );$j++)
{
$x=$j;
$wupinids = explode(",", $jianglis_wupinid[$x]); 

$suiji=$jianglis_shuliang[$x];

switch($wupinids[0]){
case"wp":

//物品写入数据库
$my = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and wupin_id='".$wupinids[1]."'");
$my = mysqli_fetch_array($my);
if ($my){
$wupin = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$wupinids[1]."' and userid='".$userid."'");
$wupin = mysqli_fetch_array($wupin);
$shuliang=$wupin[shuliang];
$shuliang+=$suiji;
$sql4="update beibao set shuliang='".$shuliang."' where wupin_id='".$wupinids[1]."' and userid='".$userid."'";
$ok=mysqli_query($db,$sql4);
}else{
$s="insert into beibao(userid,wupin_id,shuliang,jiyu) values('".$userid."','".$wupinids[1]."','".$suiji."','yes')";
$ok=mysqli_query($db,$s);
}
$wupin_name=mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$wupinids[1]."'");
$wupin_name=mysqli_fetch_array($wupin_name);
$huode_jiangli.="$wupin_name[name]*".$suiji."<br/>";
break;
case"zb":
//写入装备
$muban1 = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$wupinids[1]."'");
$muban1 = mysqli_fetch_array($muban1);
$s="insert into zhuangbei(yuanshi,userid,name,text,dengji,naijiu,naijiu_max,leixing) values('".$muban1[id]."','".$userid."','".$muban1[name]."','".$muban1[text]."','".$muban1[dengji]."','".$muban1[naijiu]."','".$muban1[naijiu_max]."','".$muban1[leixing]."')";
$ok=mysqli_query($db,$s);
$wupin_name= mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$wupinids[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);
//判断是物品还是装备结束
$huode_jiangli.="$wupin_name[name]*".$suiji."<br/>";

break;
case"pet":
//写入宠物
$muban1 = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$wupinids[1]."'");
$muban1 = mysqli_fetch_array($muban1);

//计算怪物成长率
$chengzhanglv=rand($muban1[chengzhanglv],$muban1[chengzhanglvs]);
$chengzhanglv/="100";
$s="insert into pet(muban,userid,username,zhuangtai,chengzhanglv,dengji,jingyan,qixue,qixuemax,fali,fali_max,fangyu,gongji_fa,gongji,sudu) values('".$muban1[id]."','".$userid."','".$muban1[name]."','yes','".$chengzhanglv."','".$muban1[dengji]."','0','".$guaiwu[qixue]."','".$guaiwu[qixue_max]."','".$guaiwu[fali]."','".$guaiwu[fali_max]."','".$guaiwu[fangyu]."','".$guaiwu[fagong]."','".$guaiwu[gongji]."','".$guaiwu[sudu]."')";
$ok=mysqli_query($db,$s);




$wupin_name= mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$wupinids[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);
//判断是物品还是装备结束
$huode_jiangli.="$wupin_name[name]*".$suiji."<br/>";

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
$user[jingyan] +=$suiji;
$sql2="update users set jingyan='".$user[jingyan]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$huode_jiangli.="经验*".$suiji."<br/>";
if($user[chongwu_id]!="0"){
	$chongwu= mysqli_query($db,"SELECT * FROM pet WHERE userid='".$userid."' and id='".$user[chongwu_id]."'");
$chongwu= mysqli_fetch_array($chongwu);
$chongwu[jingyan] +=$suiji;
$sql2="update pet set jingyan='".$chongwu[jingyan]."' where id='".$user[chongwu_id]."'";
$ok=mysqli_query($db,$sql2);
$huode_jiangli.="宠物".$chongwu[username]."获得经验*".$suiji."<br/>";
}
break;
case"gold":
$user[gold] +=$suiji;
$sql2="update users set gold='".$user[gold]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$huode_jiangli.="金币*".$suiji."<br/>";
break;
    case"shenzhoubi":
$user[shenzhoubi] +=$suiji;
$sql2="update users set shenzhoubi='".$user[shenzhoubi]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$huode_jiangli.="神州币*".$suiji."<br/>";
break;
    case"ch":

break;
default:

break;	
}

//解读任务奖励
}
//写入称谓奖励
if($renwu[chengwei]==""){
}else{

$resultl = mysqli_query($db,"SELECT * FROM users_chengwei WHERE name='".$renwu[chengwei]."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if($my){
}else{
$s="insert into users_chengwei(userid,name) values('".$userid."','".$renwu[chengwei]."')";
$ok=mysqli_query($db,$s);
if($ok){
$huode_chengwei="称谓:".$renwu[chengwei]."<br/>";
}else{
}

}
}


//这里写入完成任务后删除任务表以及打怪表。
$sql3 = "delete from renwu_my where yuanshi='".$renwuid."' and userid='".$userid."'";
$okrenwu=mysqli_query($db,$sql3);
$sql3 = "delete from renwu_guaiwu where renwuid ='".$renwuid."' and userid='".$userid."'";
$ok=mysqli_query($db,$sql3);

    echo"恭喜你完成任务！<br/>【获得奖励】<br/>";
echo $huode_jiangli;
echo $huode_chengwei;
if($renwu[leixing]=="juqing"){
//完成剧情任务将剧情加1
$juqing_dengji=$renwu[juqing_dengji];
$juqing_dengji+="1";
$sql2="update users set juqing='".$juqing_dengji."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
}
if($renwu[leixing]=="zhixian"){
//完成剧情任务将支线加1
$user_zhixian = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM users_zhixian WHERE zhixian_id='".$renwu[zhixian_id]."' and userid='".$userid."'"));
$juqing_dengji=$user_zhixian[zhixianjindu];
$juqing_dengji+="1";
$sql2="update users_zhixian set zhixianjindu='".$juqing_dengji."' where zhixian_id='".$renwu[zhixian_id]."' and userid='".$userid."'";
$ok=mysqli_query($db,$sql2);
}
	//日常任务
  	if($renwu[leixing]=="richang"){//判断是否是日常任务
//判断日常给予心愿水晶
$resultl = mysqli_query($db,"SELECT * FROM renwu_one WHERE leibie='richang' and userid='".$userid."'");
$rc = mysqli_fetch_array($resultl);
if($rc[shuliang]=="9"){
$jiangli_xjsj="心愿水晶*1<br/>";
echo $xyz->beibao('xjsj,1','1,1','10000','10',$userid,' ',' ');
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


$resultl = mysqli_query($db,"SELECT * FROM renwu_one WHERE leibie='richang' and userid='".$userid."'");
$rc = mysqli_fetch_array($resultl);
if(!$rc){
	$s="insert into renwu_one(userid,renwuid,shuliang,leibie,time) values('".$userid."','".$renwu[id]."','1','richang','".time()."')";
$ok2=mysqli_query($db,$s);
}else{
	$rc[shuliang]+="1";
	 $sql1="update renwu_one set shuliang='".$rc[shuliang]."' where id='".$rc[id]."'";
$ok1=mysqli_query($db,$sql1);
}
}//日常任务

	//活动任务
  	if($renwu[leixing]=="huodong"){
$resultl = mysqli_query($db,"SELECT * FROM renwu_one WHERE leibie='huodong' and renwuid='".$renwu[id]."' and userid='".$userid."'");
$rc = mysqli_fetch_array($resultl);
if(!$rc){
	$s="insert into renwu_one(userid,renwuid,shuliang,leibie,time) values('".$userid."','".$renwu[id]."','1','huodong','".time()."')";
$ok2=mysqli_query($db,$s);
}else{
	$rc[shuliang]+="1";
	 $sql1="update renwu_one set shuliang='".$rc[shuliang]."' where id='".$rc[id]."'";
$ok1=mysqli_query($db,$sql1);
}
}//活动任务
mysqli_query($db,"COMMIT");
}
}else{
echo"未达到任务要求";

echo "<br/><a href='/task/index.task?id=$renwuid'>查看任务要求</a> <br/>";
mysqli_query($db,"ROLLBACK");
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");



echo "<br/><a href='/npc.do?id=$renwu[npc_wancheng]'>返回NPC</a> <br/>";

echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/>";
