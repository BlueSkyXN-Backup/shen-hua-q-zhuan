<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$mys=$_GET['my'];
$wap=$_GET['wap'];

echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
//进入冒险
if($wap){
			$muban = mysqli_query($db,"SELECT * FROM muban_maoxian WHERE id='".$mys."'");
$muban = mysqli_fetch_array($muban);//询问冒险是否存在
	if($muban){
	//是否在冒险
	$map = mysqli_query($db,"SELECT * FROM maoxian WHERE duiwuid='".$user[duiwu_id]."'");
$map = mysqli_fetch_array($map);
if($map){
	echo"你已经在冒险了！<br/>";
	
}else{
		//进入冒险需要创建队伍
		if($user[duiwu_id]!=null){
			//获取队伍数据
			$resultl = mysqli_query($db,"SELECT * FROM duiwu WHERE id='".$user[duiwu_id]."'");
$duiwu= mysqli_fetch_array($resultl);
if($duiwu){
	if($duiwu[duizhang]==$userid){
		//判断所有队员是否有冒险令牌
		//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
		$result = mysqli_query($db,"select * from users WHERE duiwu_id='".$duiwu[id]."'");
while($row = mysqli_fetch_array($result))
  {
  	//统计用户冒险令
  	$tongji_shu=mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$muban[lingpai]."' and userid='".$row[id]."'");
$tongji_shu=mysqli_fetch_array($tongji_shu);
if(empty($tongji_shu[shuliang])||$tongji_shu[shuliang]<"1"||$row[dengji]<$muban[dengji]){
$if_break="1";
$if_break_name.=$row[username]." ";
}else{
	$tongji_shu[shuliang]-="1";
	if($tongji_shu[shuliang]<"1"){
$sql3 = "delete from beibao where id ='".$tongji_shu[id]."'";
$ok=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$tongji_shu[shuliang]."' where id='".$tongji_shu[id]."'";
$ok=mysqli_query($db,$sql2);
}
}//统计数量如果有一个用户没有令牌终止循环
}
//扣除令牌结束
if($if_break=="1"){
//有玩家没有冒险令
echo"进入冒险失败！以下用户等级低于".$muban[dengji]."级或没有冒险令：".$if_break_name."<br/>";
mysqli_query($db,"ROLLBACK");//数据回滚
}else{
	//扣除冒险令成功！
	$maoxian_time=$muban[time]*"3600";
	$maoxian_time+=time();
	$s="insert into maoxian(duiwuid,time,leibie) values('".$duiwu[id]."','".$maoxian_time."','".$muban[id]."')";
$ok1=mysqli_query($db,$s);
// $s3="insert into news(text,time,userid,leibie) values('和队友正在前往".$muban[name]."夺宝！','".$pass."','".$userid."','2')";
// $ok3=mysqli_query($db,$s3);
if($ok && $ok1){
		echo"进入冒险成功！<br/>";
		
		echo"<a href='/maoxian/map?id=".$zhuangtai_map."'>点击进入</a> 。<br/>";
		mysqli_query($db,"COMMIT");//数据提交
}else{
	echo"进入冒险失败！程序错误。<br/>";
mysqli_query($db,"ROLLBACK");//数据回滚
}

	

}

  mysqli_query($db,"END"); //事务处理完时别忘记
mysqli_query($db,"SET AUTOCOMMIT=1");//自动提交
	}else{
	echo"你不是队长无法进入冒险！<br/>";	
	}
}else{
	echo"队伍被解散或者你被踢出队伍了！<br/>";
}
		}else{
			echo"请先创建队伍或者加入别人队伍进入冒险！<br/>";
		}
	//冒险进入需要创建冒险令
	

	
	
	
	
}
}else{
	echo"冒险不存在！<br/>";
}
}




$exec="select * from muban_maoxian WHERE dengji>'0' order by dengji ASC limit 20"; 
$result=mysqli_query($db,$exec); 

while($row=mysqli_fetch_array($result)){ 
	$sid+=1;
	if($sid>1){echo"|";}

if($mys==$row[id]){echo $row[name];}else{
echo  "<a href='/maoxian/index?my=$row[id]'>$row[name]</a>";}
}


if($mys){
	$muban = mysqli_query($db,"SELECT * FROM muban_maoxian WHERE id='".$mys."'");
$muban = mysqli_fetch_array($muban);//询问冒险是否存在
		$muban_wuping = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$muban[lingpai]."'");
$muban_wuping = mysqli_fetch_array($muban_wuping);//询问冒险是否存在
$xiaoguo=explode("|", $muban[xiaoguo]);
$guan=count($xiaoguo);
//解读怪物名称
for($k=0;$k<$guan;$k++)
{
    $xiaoguo_guai=explode(",",$xiaoguo[$k]);
    $guaiwu_name=mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$xiaoguo_guai[0]."'");
$guaiwu_name=mysqli_fetch_array($guaiwu_name);
$guaiwu.=$guaiwu_name[name]."*".$xiaoguo_guai[1]." ";
}

//解读通关奖励	
$jiangli = explode("|", $muban[jiangli]); 
$huode_html="";
  
  	for($j=0;$j<count($jiangli);$j++)
{
$jiangli_one= explode(",", $jiangli[$j]);
$suiji=$jiangli_one[2];
switch($jiangli_one[0]){
case"wp":
$wupin_name=mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$jiangli_one[1]."'");
$wupin_name=mysqli_fetch_array($wupin_name);
break;
case"zb":
$wupin_name= mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$jiangli_one[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);
//判断是物品还是装备结束
break;
case"gold":
$wupin_name[name]="金币";
break;
case"jingyan":
$wupin_name[name]="经验";
break;
case"jifen":
$wupin_name[name]="冒险积分";
break;
case"shenzhoubi":
$wupin_name[name]="神州币";
break;
default:
break;
}


$huode_html.=$wupin_name[name]."*".$suiji." ";

}

	echo "<br/>-----------------<br/>$muban[name]<small> (共".$guan."关)</small> <br/><small> $muban[text]<br/>通关奖励:".$huode_html."<br/>通关时限:".$muban[time]."小时<br/>进入要求：所有队友拥有<font color='red'> <a href='/gongshi/wupin_text?id=$muban_wuping[id]'>$muban_wuping[name]</a> </font> 且人物等级大于<font color='red'>$muban[dengji]级 </font></small> <br/><a href='/maoxian/index?my=".$muban[id]."&wap=yes'><img src='/img/go.jpg' width='93' height='32' alt='进入冒险'></a><br/>";

}else{
	echo"<br/><br/>";
}

echo "<small>温馨提示：进入冒险只能队长操作，队长点击进入冒险后队员会自动消耗冒险令进入冒险。</small><br/><a href='/Mall/maoxian.php?my=jiben'>冒险商店</a> <br/><a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";

