<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$userid=$_SESSION['users'];
$id=$_GET['id'];
$my_yes=$_GET['my'];
$wap=$_GET['wap'];
if($user[fuzhi]!="0"){



//处理制作进程
if($my_yes){
	$ziuzo_shuliang=$_POST['shuliang'];
	if(preg_match('/^[0-9]+$/u',$ziuzo_shuliang)) {
//这里判断是否数量低于1
if($ziuzo_shuliang<"1"){
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(你最少需要合成一件！);//结束

}
}else{
	echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(请输入数字！);//结束
}
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
$exec="select * from fuzhi WHERE id='".$id."'"; 
$result=mysqli_query($db,$exec); 
$row=mysqli_fetch_array($result);
//获取材料
$rowxuyao = explode("|", $row[xuyao]);
//获取奖励
$rowjiangli = explode("|", $row[jiangli]);
//进行扣除行动
$cailiao_shu=count($rowxuyao);//控制器数量
for($j=0;$j<$cailiao_shu;$j++)
{

$xuyao= explode(",", $rowxuyao[$j]);
$xuyao_shu=$xuyao[2]*$ziuzo_shuliang;
switch($xuyao[0]){
case"wp":
	$resultl = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$xuyao[1]."' and userid='".$userid."'");
$wpshu = mysqli_fetch_array($resultl);
if($wpshu){
if($xuyao_shu<=$wpshu[shuliang]){
$wpshu[shuliang]-=$xuyao_shu;
if($wpshu[shuliang]<"1"){
$sql3 = "delete from beibao where id ='".$wpshu[id]."' and userid='".$userid."'";
$ok1=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$wpshu[shuliang]."' where id='".$wpshu[id]."' and userid='".$userid."'";
$ok1=mysqli_query($db,$sql2);
}
if($ok1){$xiaoguoshu+="1";}else{$xiaoguoshu-="1";}
}
}
break;
case"zb":
	$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from zhuangbei WHERE yuanshi='".$xuyao[1]."' and shiyong='no' and userid='".$userid."'")); 
	if($total[0]>=$xuyao_shu){
$resultl = mysqli_query($db,"SELECT * FROM zhuangbei WHERE yuanshi='".$xuyao[1]."' and shiyong='no' and userid='".$userid."'order by rand() limit ".$xuyao_shu);

while($myzb = mysqli_fetch_array($resultl)){ 
$sql3 = "delete from zhuangbei where id='".$myzb[id]."'";
$ok=mysqli_query($db,$sql3);
if($ok){
	$zbshu+='1';
}
}
if($zbshu==$xuyao[2]){
	$xiaoguoshu+="1";
}else{$xiaoguoshu-="1";}

}
break;
case"huoli":
if($user[huoli]>=$xuyao_shu){
	$user[huoli]-=$xuyao_shu;
	$sql2="update users set huoli='".$user[huoli]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
	if($ok){
			$xiaoguoshu+="1";
	}else{$xiaoguoshu-="1";}
}
break;
case"gold":
if($user[gold]>=$xuyao_shu){
	$user[gold]-=$xuyao_shu;
	$sql2="update users set gold='".$user[gold]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
	if($ok){
			$xiaoguoshu+="1";
	}else{$xiaoguoshu-="1";}
}
break;

default:

break;
}
}
if($cailiao_shu!=$xiaoguoshu){
mysqli_query($db,"ROLLBACK");
echo"合成失败，材料或者活力不足。<br/>";
}else{
	//写入奖励
	$jiangli_shu=count($rowjiangli);
	for($x=0;$x<$jiangli_shu;$x++)
{
$jiangli= explode(",", $rowjiangli[$x]);
$jiangli[2]*=$ziuzo_shuliang;
switch($jiangli[0]){
case"wp":
	//物品写入数据库
$jiangli_my = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and wupin_id='".$jiangli[1]."'");
$jiangli_my = mysqli_fetch_array($jiangli_my);
if ($jiangli_my){
$wupin = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$jiangli[1]."' and userid='".$userid."'");
$wupin = mysqli_fetch_array($wupin);
$wupin[shuliang]+=$jiangli[2];
$sql4="update beibao set shuliang='".$wupin[shuliang]."' where wupin_id='".$jiangli[1]."' and userid='".$userid."'";
$ok=mysqli_query($db,$sql4);
}else{
$s="insert into beibao(userid,wupin_id,shuliang,jiyu) values('".$userid."','".$jiangli[1]."','".$jiangli[2]."','yes')";
$ok=mysqli_query($db,$s);
}
if($ok){
	$jianglishu+="1";
	$muban1 = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$jiangli[1]."'");
$muban1 = mysqli_fetch_array($muban1);
	$huode_name.=" $muban1[name]*".$jiangli[2];
}
break;
case"zb":
//写入装备
$muban1 = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$jiangli[1]."'");
$muban1 = mysqli_fetch_array($muban1);
$s="insert into zhuangbei(yuanshi,userid,name,text,dengji,naijiu,naijiu_max,leixing) values('".$muban1[id]."','".$userid."','".$muban1[name]."','".$muban1[text]."','".$muban1[dengji]."','".$muban1[naijiu]."','".$muban1[naijiu_max]."','".$muban1[leixing]."')";
$ok=mysqli_query($db,$s);
if($ok){
	$jianglishu+="1";
	$huode_name.=" $muban1[name]*".$jiangli[2];
}
//判断是物品还是装备结束
break;
case"jingyan":
	$user[jingan]+=$jiangli[2];
	$sql2="update users set jingyan='".$user[jingyan]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
if($ok){
	$jianglishu+="1";
	$huode_name.=" 经验*".$jiangli[2];
}
break;
	case"fuzhi_jingyan":
			$user[fuzhi_int]+=$jiangli[2];
	$sql2="update users set fuzhi_int='".$user[fuzhi_int]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
if($ok){
	$jianglishu+="1";
		$huode_name.=" 熟练度*".$jiangli[2];
}
break;
default:

break;
}
}
if($jiangli_shu==$jianglishu){
	mysqli_query($db,"COMMIT");//数据提交
	echo"合成成功。获得：".$huode_name."<br/>";
}else{
	mysqli_query($db,"ROLLBACK");
	echo"合成出了一点小意外。<br/>";
}	
	
	
}
echo "<a href='zhizuo?id=$id'>继续合成</a><br/>";
//数据回滚mysql_query($db,"ROLLBACK");
mysqli_query($db,"END"); //事务处理完时别忘记
mysqli_query($db,"SET AUTOCOMMIT=1");//自动提交
echo "<a href='index'>副职首页</a><br/>";
}else{




$exec="select * from fuzhi WHERE id='".$id."'"; 
$result=mysqli_query($db,$exec); 
$row=mysqli_fetch_array($result);
//获取材料
$rowxuyao = explode("|", $row[xuyao]);
$xuyao_wupin="材料：";
for($j=0;$j<count($rowxuyao);$j++)
{
$xuyao= explode(",", $rowxuyao[$j]);
switch($xuyao[0]){
case"wp":
$wupin_name=mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$xuyao[1]."'");
$wupin_name=mysqli_fetch_array($wupin_name);
break;
case"zb":
$wupin_name= mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$xuyao[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);
//判断是物品还是装备结束
break;
case"jingyan":
$wupin_name[name]="经验";
break;
case"gold":
$wupin_name[name]="金币";
break;
case"huoli":
$wupin_name[name]="活力";
break;
default:

break;
}
$xuyao_wupin.=  " ".$wupin_name[name]."*".$xuyao[2];
}

//获取奖励
$rowjiangli = explode("|", $row[jiangli]);
$jiangli_wupin="制作可获得：";
for($j=0;$j<count($rowjiangli);$j++)
{
$jiangli= explode(",", $rowjiangli[$j]);
switch($jiangli[0]){
case"wp":
$wupin_name=mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$jiangli[1]."'");
$wupin_name=mysqli_fetch_array($wupin_name);
break;
case"zb":
$wupin_name= mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$jiangli[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);
//判断是物品还是装备结束
break;
case"jingyan":
$wupin_name[name]="经验";
break;
case"gold":
$wupin_name[name]="金币";
default:
	case"fuzhi_jingyan":
$wupin_name[name]="熟练度";
default:

break;
}
$jiangli_wupin.=  " ".$wupin_name[name]."*".$jiangli[2];


}
echo $xuyao_wupin;
echo "<br/>".$jiangli_wupin;
echo "
<form action='zhizuo?id=$row[id]&my=yes' method='post'>
<input name='shuliang' maxlength='5' value='1'></input>
<input type='submit' value='确定制作 $row[name]' class='link'/></form>
<br/>";
echo "<a href='index'>副职首页</a><br/>";
}
}else{
echo"你还没有学习副职！<br/>";

}

echo "<a href='/map.games'>返回地图</a><br/>";
echo footer();
?>