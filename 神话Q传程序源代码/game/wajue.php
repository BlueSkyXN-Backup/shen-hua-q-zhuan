<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$mapid=$_GET['id'];
$wajue=$_GET['wajue'];
$my=$_GET['my'];
$shuliang=$_POST['shuliang'];

echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a><br/>";

if(preg_match('/^[0-9]+$/u',$mapid)) {
if(preg_match('/^[0-9]+$/u',$wajue)) {
}else{
exit(系统错误);//结束	
}
}else{exit(系统错误);//结束
}



if($user[map]!=$mapid){
	echo"你没有在当前地图，无法采集！<br/>";
}else{
$map = mysqli_query($db,"SELECT * FROM map WHERE id='".$mapid."'");
$map = mysqli_fetch_array($map);

//获取地图可采集
if($map[wajue]==null){
	echo"没有可以采集的物品<br/>";
}else{
	$map_wajue= explode("|",$map[wajue]);
	if(!$map_wajue[$wajue]){
			echo"没有可以采集的物品<br/>";
	}else{
    $wajue_map = explode(",", $map_wajue[$wajue]); 
    $wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$wajue_map[0]."'");
$wupin = mysqli_fetch_array($wupin);
 $wupin2 = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$wajue_map[1]."'");
$wupin2 = mysqli_fetch_array($wupin2);

if($my=="yes"){
if(preg_match('/^[0-9]+$/u',$shuliang)) {
	//事务锁开启
	mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
	//获取工具数量
	$wupin_shuliang = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$wajue_map[1]."' and userid='".$userid."'");
$wupin_shuliang = mysqli_fetch_array($wupin_shuliang);
if($wupin_shuliang[shuliang]<$shuliang){
	echo"$wupin2[name]不足！（可寻找<a href='/npc.do?id=39'>黑心商人</a>购买）<br/>";	
}else{
	$wupin_shuliang[shuliang]-=$shuliang;
	if($wupin_shuliang[shuliang]<"1"){
		
$sql3 = "delete from beibao where id ='".$wupin_shuliang[id]."'";
$ok1=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$wupin_shuliang[shuliang]."' where id='".$wupin_shuliang[id]."'";
$ok1=mysqli_query($db,$sql2);
}
	
	
	$wupin[tiji]*=$shuliang;
$user[beibao_rongliang]+=$wupin[tiji];
if($user[beibao_rongliang]<=$user[beibao_rongliangmax]){
$sql2="update users set beibao_rongliang='".$user[beibao_rongliang]."' where id='".$userid."'";
$okrongliang=mysqli_query($db,$sql2);
$bb = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and wupin_id='".$wajue_map[0]."'");
$bb = mysqli_fetch_array($bb);
if ($bb){
$bb[shuliang]+=$shuliang;
$sql4="update beibao set shuliang='".$bb[shuliang]."' where wupin_id='".$wajue_map[0]."' and userid='".$userid."'";
$ok2=mysqli_query($db,$sql4);
}else{
$s="insert into beibao(userid,wupin_id,shuliang,jiyu) values('".$userid."','".$wajue_map[0]."','".$shuliang."','yes')";
$ok2=mysqli_query($db,$s);
}
}else{
echo "背包容量不足";
}



	
	
	
}

if($ok1 &&$ok2){
mysqli_query($db,"COMMIT");
echo"采集成功！获得$wupin[name]*$shuliang<br/>";
}else{
mysqli_query($db,"ROLLBACK");
echo"采集失败！<br/>";
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");
}else{
	echo"请输入正确的数量！<br/>";	
}	
}
    	echo"$wupin[name]<br/>$wupin[text](需要$wupin2[name]*1)";
    	echo "<form action='wajue?id=$mapid&wajue=$wajue&my=yes' method='post'>";
echo "数量:";
echo "<input name='shuliang' maxlength='10' value='1'/><br/>";
echo '<input type="submit" value="采集" class="link"/></form>';

	}
	
}
}










echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a><br/>";
echo footer();
?>