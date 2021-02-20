<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$mapid=$_GET['id'];
$baoxiang=$_GET['baoxiang'];

$userid=$_SESSION['users'];
$resultl = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){
}else{
header("location:../reg.do");//跳转地址
exit();//结束
}

$exec="select * from news order by id desc limit 1"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$xtuser=mysqli_query($db,"SELECT * FROM users WHERE id='".$row['userid']."'");
$xtuser=mysqli_fetch_array($xtuser);
echo  user_name($xtuser['id']).$row['text'];

}



$map_suiji=mt_rand(0,0);
if($map_suiji=="0"){
    //显示结果
$result = mysqli_query($db,"SELECT * FROM baoxiang WHERE leibie='map' order by rand() limit 1");
while($row = mysqli_fetch_array($result))
  {
$mapss = mysqli_query($db,"SELECT * FROM map WHERE id='".$row[map]."'");
$mapss = mysqli_fetch_array($mapss);

$map_suijitip="<br/> [系统]<a href='/map.games?id=$row[map]'>$mapss[name]</a>突现一批宝箱！速去砸开夺得重赏！";
  }
}elseif($map_suiji=="2"){
$result = mysqli_query($db,"SELECT * FROM guaiwu WHERE leixing='boss' order by rand() limit 1");
while($row = mysqli_fetch_array($result))
  {
$mapss = mysqli_query($db,"SELECT * FROM map WHERE id='".$row[map]."'");
$mapss = mysqli_fetch_array($mapss);

$map_suijitip="[系统]<a href='/map.games?id=$row[map]'>$mapss[name]</a>突现BOSS！速去围杀夺得重赏！<br/> ";
  }
}
echo $map_suijitip;


	$map = mysqli_query($db,"SELECT * FROM fuben WHERE duiwuid='".$user[duiwu_id]."'");
$map = mysqli_fetch_array($map);
if($map){
	
	if($baoxiang){
//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁

$dakai_baoxiang=mysqli_query($db,"SELECT * FROM baoxiang WHERE id='".$baoxiang."' and leibie='fuben' and map='".$map[id]."'");
$dakai_baoxiang=mysqli_fetch_array($dakai_baoxiang);

if($dakai_baoxiang){
    $muban_baoxiang=mysqli_query($db,"SELECT * FROM muban_baoxiang WHERE id='".$dakai_baoxiang['muban']."'");
$muban_baoxiang=mysqli_fetch_array($muban_baoxiang);
$baoxiang_xuyao= explode(",", $muban_baoxiang['xuyao']);

//统计是否需要乾坤锤
$my = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and wupin_id='".$baoxiang_xuyao['1']."'");//锁定该用户的背包
$wupin_shu= mysqli_fetch_array($my);
if ($wupin_shu){
$wupin_shu['shuliang']-="1";
if($wupin_shu['shuliang']<"1"){

$sql3 = "delete from beibao where userid='".$userid."' and wupin_id='".$baoxiang_xuyao['1']."'";
$ok1=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$wupin_shu['shuliang']."' where userid='".$userid."' and wupin_id='".$baoxiang_xuyao['1']."'";
$ok1=mysqli_query($db,$sql2);
}
if($ok1){
//扣除乾坤锤成功
$yuanshi=mysqli_query($db,"SELECT * FROM muban_baoxiang WHERE id='".$dakai_baoxiang['muban']."'");
$yuanshi= mysqli_fetch_array($yuanshi);
$huode_html="". $xyz->beibao($yuanshi['jiangli'],$yuanshi['jianglishu'],$yuanshi['jianglijilv'],'9999',$userid,' ',' ');
//for循环结束
}//扣了乾坤锤
echo "<br/>你打开了宝箱获得了：".$huode_html;

$sql3 = "delete from baoxiang where id ='".$baoxiang."'";
$ok=mysqli_query($db,$sql3);
//更新打开宝箱时间
$sql1="update map set  baoxiang_time='".time()."' where id='".$mapid."'";
$ok=mysqli_query($db,$sql1);
$s="insert into news(text,time,userid) values('砸开了【".$dakai_baoxiang['name']."】获得".$huode_html."','".$pass."','".$userid."')";
$ok=mysqli_query($db,$s);

}else{
//没有乾坤锤执行代码

echo $baoxiang_xuyao['2'];
}
//mysqli_query($db,"ROLLBACK");
mysqli_query($db,"COMMIT");
}else{
//没有宝箱执行代码

echo "宝箱不存在！<br/>";
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");


}




		//获取模板
		$muban = mysqli_query($db,"SELECT * FROM muban_fuben WHERE id='".$map[leibie]."'");
$muban = mysqli_fetch_array($muban);
$guanqia = explode("|", $muban[xiaoguo]); 	//获取模板数据
$guan=$map[guan]-1;
$guanqia_shuju = explode(",", $guanqia[$guan]);

	//检测通关自动进入下一关
if($map[guaiwushu]>=$guanqia_shuju['1']){
	$guanqia_shu=count($guanqia);
	if($guanqia_shu>$map[guan]){
	//执行通关命令
	$map[guan]+=1;
	$map[guaiwushu]=0;
		   $sql1="update fuben set guan='".$map[guan]."',guaiwushu='".$map[guaiwushu]."' where duiwuid='".$user[duiwu_id]."'";
$ok1=mysqli_query($db,$sql1);
$sql3 = "delete from baoxiang where leibie='fuben' and map='".$map[id]."'";
$ok1=mysqli_query($db,$sql3);//删除宝箱
//	//重新获取模板
		$muban = mysqli_query($db,"SELECT * FROM muban_fuben WHERE id='".$map[leibie]."'");
$muban = mysqli_fetch_array($muban);
$guanqia = explode("|", $muban[xiaoguo]); 	//获取模板数据
$guan=$map[guan]-1;
$guanqia_shuju = explode(",", $guanqia[$guan]);
//写入宝箱
if($guanqia_shuju[1]!=""){
	$guanqia_baoxiang = explode(".", $guanqia_shuju[2]);
	for($bx=0;$bx<count($guanqia_baoxiang);$bx++)
{
 $resultl = mysqli_query($db,"SELECT * FROM baoxiang WHERE muban='".$guanqia_baoxiang[$bx]."' and leibie='fuben' and map='".$map[id]."'");
$shengcheng_baoxiang = mysqli_fetch_array($resultl);

//开始生成宝箱
 $resultl33 = mysqli_query($db,"SELECT * FROM muban_baoxiang WHERE id='".$guanqia_baoxiang[$bx]."'");
$baoxiangname = mysqli_fetch_array($resultl33);
$s="insert into baoxiang(muban,map,name,leibie) values('".$guanqia_baoxiang[$bx]."','".$map[id]."','".$baoxiangname[name]."','fuben')";
$ok=mysqli_query($db,$s);

	
}
}




}else{
	//写入通关奖励
	$jiangli = explode("|", $muban[jiangli]); 
	$result = mysqli_query($db,"select * from users WHERE duiwu_id='".$duiwu[id]."'");
while($row = mysqli_fetch_array($result))
  {
$huode_html="";
  	mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
  	for($j=0;$j<count($jiangli);$j++)
{
$jiangli_one= explode(",", $jiangli[$j]);
$suiji=$jiangli_one[2];

switch($jiangli_one[0]){
case"wp":

//物品写入数据库
$my = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$row[id]."' and wupin_id='".$jiangli_one[1]."'");
$my = mysqli_fetch_array($my);
if ($my){
$wupin = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$jiangli_one[1]."' and userid='".$row[id]."'");
$wupin = mysqli_fetch_array($wupin);
$shuliang=$wupin[shuliang];
$shuliang+=$suiji;
$sql4="update beibao set shuliang='".$shuliang."' where wupin_id='".$jiangli_one[1]."' and userid='".$row[id]."'";
$ok=mysqli_query($db,$sql4);
}else{
$s="insert into beibao(userid,wupin_id,shuliang,jiyu) values('".$row[id]."','".$jiangli_one[1]."','".$suiji."','yes')";
$ok=mysqli_query($db,$s);
}
$wupin_name=mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$jiangli_one[1]."'");
$wupin_name=mysqli_fetch_array($wupin_name);
break;
case"zb":
//写入装备
$muban1 = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$jiangli_one[1]."'");
$muban1 = mysqli_fetch_array($muban1);
$s="insert into zhuangbei(yuanshi,userid,name,text,dengji,naijiu,naijiu_max,leixing) values('".$muban1[id]."','".$row[id]."','".$muban1[name]."','".$muban1[text]."','".$muban1[dengji]."','".$muban1[naijiu]."','".$muban1[naijiu_max]."','".$muban1[leixing]."')";
$ok=mysqli_query($db,$s);
$wupin_name= mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$jiangli_one[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);
//判断是物品还是装备结束
break;
case"gold":
$row[gold] +=$suiji;
$sql2="update users set gold='".$row[gold]."' where id='".$row[id]."'";
$ok=mysqli_query($db,$sql2);
$wupin_name[name]="金币";
break;
case"jingyan":
$row[jingyan] +=$suiji;
$sql2="update users set jingyan='".$row[jingyan]."' where id='".$row[id]."'";
$ok=mysqli_query($db,$sql2);
$wupin_name[name]="经验";
break;
case"jifen":
$row[fuben] +=$suiji;
$sql2="update users set fuben='".$row[fuben]."' where id='".$row[id]."'";
$ok=mysqli_query($db,$sql2);
$wupin_name[name]="副本积分";
break;
case"shenzhoubi":
$row[shenzhoubi] +=$suiji;
$sql2="update users set shenzhoubi='".$row[shenzhoubi]."' where id='".$row[id]."'";
$ok=mysqli_query($db,$sql2);
$wupin_name[name]="神州币";
break;
default:

break;
}


$huode_html.=$wupin_name[name]."*".$suiji." ";

}
//for循环结束
  	if($row[id]==$userid){echo "恭喜你获得奖励：".$huode_html;}
$s="insert into email(text,userid,leibie,zhuangtai) values('你通关副本，获得奖励：".$huode_html."。','".$row[id]."','1','0')";
$ok5=mysqli_query($db,$s);
mysqli_query($db,"COMMIT");
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");

  	
	
  }
	
	//删除副本数据
		$sql3 = "delete from fuben where duiwuid='".$user[duiwu_id]."'";
$ok1=mysqli_query($db,$sql3);
$sql3 = "delete from baoxiang where leibie='fuben' and map='".$map[id]."'";
$ok1=mysqli_query($db,$sql3);
echo"<br/>你已经成功通关副本！<br/><a href='/fuben/index?id=$map[id]'>返回副本首页</a><br/>";

exit();//结束
}

}
//副本通关结束

if($_GET['tuichu']){
		
	$sql3 = "delete from fuben where duiwuid='".$user[duiwu_id]."'";
$ok1=mysqli_query($db,$sql3);
	$result = mysqli_query($db,"select * from users WHERE duiwu_id='".$duiwu[id]."'");
while($row = mysqli_fetch_array($result))
  {$s="insert into email(text,userid,leibie,zhuangtai) values('成功退出副本！','".$row[id]."','1','0')";
$ok5=mysqli_query($db,$s);}

echo"副本退出成功！<a href='/fuben/index?id='".$zhuangtai_map."'>返回副本首页</a><br/>";	}






echo head();
$sql = "SELECT * FROM users WHERE map='".$mapid."'";
//获取数据
	$muban_guaiwu = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$guanqia_shuju[0]."'");
$muban_guaiwu = mysqli_fetch_array($muban_guaiwu);
echo "第".$map[guan]."关，击杀$muban_guaiwu[name] ($map[guaiwushu],$guanqia_shuju[1] )  <a href='/fuben/map?id=$map[id]'>刷新</a><br/>";
	if($map[time]<time()){
	echo"副本即将自动退出<br/>";	
	$sql3 = "delete from fuben where duiwuid='".$user[duiwu_id]."'";
$ok1=mysqli_query($db,$sql3);
	$result = mysqli_query($db,"select * from users WHERE duiwu_id='".$duiwu[id]."'");
while($row = mysqli_fetch_array($result))
  {$s="insert into email(text,userid,leibie,zhuangtai) values('你未在规定时间内通关副本已经自动退出！','".$row[id]."','1','0')";
$ok5=mysqli_query($db,$s);}
	}else{
$map[time]-=time();
$zaixian_time1=timesecond($map[time]);
echo"副本将在".$zaixian_time1."之后自动<a href='map?tuichu=dfdsdddv'>退出</a>";
}
echo "<br/>你看见了：";

$guaiwu=array();
$guaiwu_id= explode("-", $guanqia_shuju[0]); 
$guaiwu_shu=count($guaiwu_id);
$guaiwu_shu-="1";
//随机怪物数量
$suiji=rand(2,6);
for ($j=1;$j<$suiji;$j++) 
{
$suiji_guaiwu=rand(0,$guaiwu_shu);
   array_push($guaiwu,$guaiwu_id[$suiji_guaiwu]);
}
$_SESSION['guaiwufuben']=$guaiwu;

 $guaiwu=(array_count_values($guaiwu));
 foreach($guaiwu as $guaiwu_a=>$guaiwu_b){//依次取出数组中元素，$a是元素的键名$b是键值
   $result = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$guaiwu_a."'");
 $rows = mysqli_fetch_array($result);
   $guaiwu_map.="<a href='/pve/pve.do?GO=fuben'>".$rows[name]."</a>(".$guaiwu_b.")";
 }
if($guaiwu_map){
 $guaiwu_map="<br/>【怪物】".$guaiwu_map."";
}
//获取当前地图宝箱
$resultl = mysqli_query($db,"SELECT * FROM baoxiang WHERE leibie='fuben' and map='".$map[id]."'");
$my = mysqli_fetch_array($resultl);
if($my){
$maps_baoxiang= "<br/>【宝箱】";
}
$result = mysqli_query($db,"SELECT * FROM baoxiang WHERE leibie='fuben' and map='".$map[id]."'");
while($row = mysqli_fetch_array($result))
  {
$maps_baoxiang.= "<a href='/fuben/map?id=$map[id]&baoxiang=$row[id]'><img src='/img/ico/".$row[ico]."'/>$row[name]</a> ";
  }



$footer=footer();

//地图显示
$html=<<<HTML
$boss_map
$guaiwu_map
$map_npc1
$map_npc
$maps_baoxiang

$footer
HTML;

echo $html;

}else{
	echo"你没有在副本！";
	echo "<br/><a href='/map.games'>返回地图</a>";
}
?>
