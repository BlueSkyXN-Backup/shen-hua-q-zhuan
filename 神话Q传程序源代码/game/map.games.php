<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$footer=footer();
$mapid=$_GET['id'];
$baoxiang=$_GET['baoxiang'];
$map = mysqli_query($db,"SELECT * FROM map WHERE id='".$mapid."'");
$map = mysqli_fetch_array($map);
if(!$map){
$map = mysqli_query($db,"SELECT * FROM map WHERE id='".$user['map']."'");
$map = mysqli_fetch_array($map);
}

if($userid!="1"){
    if($user['duiwu_id']!=NULL){
    $duiwu = mysqli_query($db,"SELECT * FROM duiwu WHERE id='".$user['duiwu_id']."'");
$duiwu = mysqli_fetch_array($duiwu);
  if($duiwu['duizhang']==$userid){
//转生限制地图
$xianzhi1=abs($map[z]);
$xianzhi2=$user[zhuansheng]+1;
if($xianzhi1>$xianzhi2){
    $xianzhi3=$xianzhi1-1;
    echo "你无法前往高等级位面，进入当前地图需要人物等级达到".$xianzhi3."转<br/>";
    
echo "<a href='/map.games?id=1'>返回地图</a>";
    exit();
}
}
} else{
    //转生限制地图
$xianzhi1=abs($map[z]);
$xianzhi2=$user[zhuansheng]+1;
if($xianzhi1>$xianzhi2){
    $xianzhi3=$xianzhi1-1;
    echo "你无法前往高等级位面，进入当前地图需要人物等级达到".$xianzhi3."转<br/>";
    
echo "<a href='/map.games?id=1'>返回地图</a>";
    exit();
}
}

}
 $shu = mysqli_fetch_array(mysqli_query($db,"SELECT count(*) FROM zhuangbei WHERE yuanshi='313'"));
 echo$shu[0];
if($user[ceshi]=="0"){

if($shu[0]<"6"){
    if(mysqli_query($db,"update users set ceshi='2' where id='".$userid."'")){
        $huode_html="获得奖励:". $xyz->beibao('zb,313,7|zb,314,7|zb,315,7|zb,316,7|zb,317,7|zb,318,7','1,1|1,1|1,1|1,1|1,1|1,1|1,1','10001|10000|10000|10000|10000|10000','10',$userid,' ',' ');
echo $huode_html;
    }
}
}

   	$fuben= mysqli_query($db,"SELECT * FROM fuben WHERE duiwuid='".$user[duiwu_id]."'");
$fuben= mysqli_fetch_array($fuben);
if($fuben){
echo' <meta http-equiv="refresh" content="0;url=/fuben/map">';
	echo"<br/>检测你正在副本中，<a href='/fuben/map?id=".$zhuangtai_map."'>点击进入</a> 。<br/>";
}
 
$maoxian= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM maoxian WHERE duiwuid='".$user[duiwu_id]."'"));
if($maoxian){
echo' <meta http-equiv="refresh" content="0;url=/maoxian/map">';
	echo"<br/>检测你正在冒险中，<a href='/maoxian/map?id=".$zhuangtai_map."'>点击进入</a> 。<br/>";
}
//载入宝箱请设置定时任务
if($user['duiwu_id']!=NULL){
//获取队长mapid
$duiwu = mysqli_query($db,"SELECT * FROM duiwu WHERE id='".$user['duiwu_id']."'");
$duiwu = mysqli_fetch_array($duiwu);
  if($duiwu['duizhang']==$userid){
    $resultl = mysqli_query($db,"SELECT * FROM map WHERE id='".$mapid."'");
$my = mysqli_fetch_array($resultl);
if ($my){
$sql2="update users set map='".$mapid."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
}else{
$mapid=$user['map'];
}
if(!$mapid){
$mapid=$user['map'];
}
  }else{
  $npc = mysqli_query($db,"SELECT * FROM users WHERE id='".$duiwu['duizhang']."'");
$npc = mysqli_fetch_array($npc);
  $mapid=$npc['map'];
    $sql2="update users set map='".$mapid."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
  echo"当前队伍中默认跟随队长移动。如需移动其他地图请退出队伍。<br/>";
  }
}else{
$resultl = mysqli_query($db,"SELECT * FROM map WHERE id='".$mapid."'");
$my = mysqli_fetch_array($resultl);
if ($my){
$sql2="update users set map='".$mapid."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
}else{
$mapid=$user['map'];
}
if(!$mapid){
$mapid=$user['map'];
}
}


$exec="select * from news order by id desc limit 1"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$xtuser=mysqli_query($db,"SELECT * FROM users WHERE id='".$row['userid']."'");
$xtuser=mysqli_fetch_array($xtuser);
echo  user_name($xtuser['id']).$row['text'];

}
//获取boss打败
$time_boss=time();
$time_boss-="1200";
$exec="select * from Boss_tip WHERE time>'".$time_boss."' order by time desc limit 2"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$xtuser=mysqli_query($db,"SELECT * FROM users WHERE id='".$row['userid']."'");
$xtuser=mysqli_fetch_array($xtuser);
echo  "<br/><img src='/img/laba.gif'/>".user_name($xtuser[id])."经过轮番激烈战斗击败了".$row[name]."获得<a href='/boss_tip'>巨额奖励</a>";
}



$map_suiji=mt_rand(0,1);
if($map_suiji=="0"){
$f='1.txt';   //文件名
$a=file($f);  //把文件的所有内容获取到数组里面
$n=count($a); //获得总行数
$n-=1;
$rnd=rand(0,$n);    //产生随机行号
$rnd_line=$a[$rnd];
 $map_suijitip= "<br/>[系统]".$rnd_line; 
    
}elseif($map_suiji=="3"){
    //显示结果
$result = mysqli_query($db,"SELECT * FROM baoxiang WHERE leibie='map' order by rand() limit 1");
while($row = mysqli_fetch_array($result))
  {
$mapss = mysqli_query($db,"SELECT * FROM map WHERE id='".$row['map']."'");
$mapss = mysqli_fetch_array($mapss);

$map_suijitip="<br/><img src='/img/laba.gif'/><a href='/map.games?id=".$row['map']."'>".$mapss['name']."</a>突现一批宝箱！速去砸开夺得重赏！ ";
  }
}elseif($map_suiji=="1"){
$result = mysqli_query($db,"SELECT * FROM guaiwu WHERE leixing='boss' order by rand() limit 1");
while($row = mysqli_fetch_array($result))
  {
$mapss = mysqli_query($db,"SELECT * FROM map WHERE id='".$row['map']."'");
$mapss = mysqli_fetch_array($mapss);

$map_suijitip="<br/><img src='/img/laba.gif'/><a href='/map.games?id=".$row['map']."'>".$mapss['name']."</a>突现BOSS！速去围杀夺得重赏！ ";
  }
}
echo $map_suijitip;

//获取公告
//获取当前地图NPC
// $result = mysqli_query($db2,"select * from pk_read WHERE sortid='2' and del='0' and top='1' order by rand() limit 2");
// while($row = mysqli_fetch_array($result))
//  {
//   echo "<br/><a href='https://game.wap.xyz/read-".$row['id']."-1.html'><img src='/img/laba.gif'/>".$row['title']."</a>";
//   }
//echo "<br/><a href='/Sign/Recharge'><img src='/img/laba.gif'/>幻想尊翼-新年快乐</a>";
 
//获取队伍邀请
$result = mysqli_query($db,"select * from duiwu_yaoqing WHERE userid='".$userid."'and zhuangtai='0'  order by rand() limit 1");
while($row = mysqli_fetch_array($result))
  {
  $npc = mysqli_query($db,"SELECT * FROM users WHERE id='".$row['npcid']."'");
$npc = mysqli_fetch_array($npc);
  echo "<br/><a href='/Activity/Article.php?id=".$row['id']."'><img src='/img/top.gif'  alt='".$row['name']."' />".$npc['username']."</a>邀请你加入队伍<a href='/ranks/ranks.php?id=".$row['id']."&my=yes'><img src='/img/top.gif'  alt='".$row['name']."' />同意</a>|<a href='/ranks/ranks.php?id=".$row['id']."'><img src='/img/top.gif'  alt='".$row['name']."' />取消</a>";
  }

//获取是否有未读消息

if($_GET['tishi']){
echo"<br/>点击过快了，使用客户端没有限制哦~";
}
if($baoxiang){
//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁

$dakai_baoxiang=mysqli_query($db,"SELECT * FROM baoxiang WHERE id='".$baoxiang."' and leibie='map' and map='".$mapid."'");
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
$huode_html="". $xyz->beibao($yuanshi['jiangli'],$yuanshi['jianglishu'],$yuanshi['jianglijilv'],'9999',$userid,'','');
//for循环结束
}//扣了乾坤锤
echo "<br/>你打开了宝箱获得了：".$huode_html;

$sql3 = "delete from baoxiang where id ='".$baoxiang."'";
$ok=mysqli_query($db,$sql3);
//更新打开宝箱时间
$sql1="update map set  baoxiang_time='".time()."' where id='".$mapid."'";
$ok=mysqli_query($db,$sql1);
$s="insert into news(text,time,userid) values('砸开了【".$dakai_baoxiang['name']."】获得".$huode_html."','".$pass."','$userid')";
$ok=mysqli_query($db,$s);

}else{
//没有乾坤锤执行代码

echo $baoxiang_xuyao['2'];
}
//mysqli_query($db,"ROLLBACK");
mysqli_query($db,"COMMIT");
}else{
//没有宝箱执行代码

echo "<br/>宝箱不存在！";
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");


}


echo head();
$sql = "SELECT * FROM users WHERE map='".$mapid."'";
$result = mysqli_query($db,$sql);
$map_users=mysqli_num_rows($result);
$map = mysqli_query($db,"SELECT * FROM map WHERE id='".$mapid."'");
$map = mysqli_fetch_array($map);
//获取地图坐标
$x=$map['x'];//地图x坐标
$y=$map['y'];//地图y坐标
$z=$map['z'];//地图z坐标
$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);
echo $map['name']."<a href='/map.games?id=".$map['id']."'>刷新</a><br/>";

if($map['img']!="0" and $map['img']!=null){
echo"<img src='/img/".$map['img']."'height='100'/><br/>";
}
if($map['text']){
echo $map['text']."<br/>";	
}

echo "你看见了：";
//获取当前地图玩家
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from users WHERE  map='".$mapid."'")); 
$totalNumber=$total['0']; 
if($totalNumber>"4"){
$map_gengduo="|<a href='/maps?id=".$map['id']."'>更多</a>";
}
$exec="select * from users  WHERE map='".$mapid."' order by rand() limit 4"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$map_user.= "|".user_name($row['id']);
}
$map_user=substr($map_user,1);//清楚最前面的|
//获取当前地图NPC
$resultl = mysqli_query($db,"SELECT * FROM npc WHERE map='".$mapid."'");
$my = mysqli_fetch_array($resultl);
if($my){
$map_npc1= "<br/>【NPC】";
}

$resultl = mysqli_query($db,"SELECT * FROM npc WHERE map='".$mapid."'");
while($row = mysqli_fetch_array($resultl))
  {
  	$tan=null;
  	$result3 = mysqli_query($db,"SELECT * FROM renwu WHERE npc='".$row['id']."'");

while($tans = mysqli_fetch_array($result3))
  {
switch($tans['leixing']){
case"huodong":
//活动任务
if($tans['dengji']<=$user[dengji] && $tans['dengji_max']>=$user[dengji]){
//判断是否已经接受
$resultl4 = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$tans['id']."' and userid='".$userid."'");
$my4 = mysqli_fetch_array($resultl4);
if (!$my4){  
 $tan="<img src='/img/tan.gif'/>";
}
}
break;
case"richang":
//日常任务
if($tans['dengji']<=$user[dengji] && $tans['dengji_max']>=$user[dengji]){
//符合剧情任务进度
//判断是否已经接受
$resultl4 = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$tans['id']."' and userid='".$userid."'");
$my4 = mysqli_fetch_array($resultl4);
if (!$my4){  
$tan="<img src='/img/tan.gif'/>";
}
}
break;
case"zhixian":
    
$user_zhixian = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM users_zhixian WHERE zhixian_id='".$row[zhixian_id]."' and userid='".$userid."'"));
if(!$user_zhixian){
    $s="insert into users_zhixian(zhixian_id,userid,zhixianjindu) values('".$row[zhixian_id]."','".$userid."','1')";
$ko=mysqli_query($db,$s);
$user_zhixian = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM renwu_my WHERE zhixian_id='".$row[zhixian_id]."' and userid='".$userid."'"));
}
if($row[juqing_dengji]==$user_zhixian[zhixianjindu]){
//符合剧情任务进度
//判断是否已经接受
$resultl = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$row[id]."' and userid='".$userid."'");
$my4 = mysqli_fetch_array($resultl);
if (!$my4){
 $tan="<img src='/img/tan.gif'/>";
}

}else{
//不符合剧情任务进度
}

break;
case"juqing":
if($tans['juqing_dengji']==$user[juqing]){
//符合剧情任务进度
//判断是否已经接受
$resultl4 = mysqli_query($db,"SELECT * FROM renwu_my WHERE yuanshi='".$tans['id']."' and userid='".$userid."'");
$my4 = mysqli_fetch_array($resultl4);
if (!$my4){  
$tan="<img src='/img/tan.gif'/>";
}
}

break;
default:

break;
}
}
$map_npc.= "|".$tan."<a href='/npc.do?id=".$row['id']."'>".$row['name']."</a>";
  }
$map_npc=substr($map_npc,1);//清楚最前面的|
// //获取当前地图怪物的数组
if ($map['guaiwu']!=NULL){
$guaiwu=array();
$guaiwu_id= explode(",", $map['guaiwu']); 
$guaiwu_shu=count($guaiwu_id);
$guaiwu_shu-="1";
//随机怪物数量
$suiji=rand(2,6);
for ($j=1;$j<$suiji;$j++) 
{
$suiji_guaiwu=rand(0,$guaiwu_shu);
   array_push($guaiwu,$guaiwu_id[$suiji_guaiwu]);
}
$_SESSION['guaiwuid']=$guaiwu;

 $guaiwu=(array_count_values($guaiwu));
 foreach($guaiwu as $guaiwu_a=>$guaiwu_b){//依次取出数组中元素，$a是元素的键名$b是键值
   $result = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$guaiwu_a."'");
 $rows = mysqli_fetch_array($result);
   $guaiwu_map.="<a href='pve/pve.do?GO=PVP'>".$rows['name']."</a>(".$guaiwu_b.")";
 }
}else{
unset($_SESSION['guaiwuid']);
}
 if($guaiwu_map){
 $guaiwu_map="<br/>【怪物】".$guaiwu_map."";
 }
/**if($map['guaiwu']){
//	$guaiwu122 = explode(",", $map['guaiwu']);
for($gw=0;$gw<count($guaiwu122);$gw++) 
{
		$result = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$guaiwu122['$gw']."'");
$rows = mysqli_fetch_array($result);
$guaiwu_map1.="<a href='/pve10.php?gu=wap.xyz'>$rows['name']</a> ";
	}
	$guaiwu_map="<br/>【怪物】".$guaiwu_map1."";
}
**/

//获取当前地图怪物
$result = mysqli_query($db,"SELECT * FROM guaiwu WHERE leixing='boss' and map='".$mapid."'");
while($row = mysqli_fetch_array($result))
  {
$result = mysqli_query($db,"SELECT * FROM boss_time WHERE map='".$mapid."'");
$rows = mysqli_fetch_array($result);
$boss_map="<br/>【boss】<a href='pve/pve.do?GO=boss'>".$rows['name']."</a>";
  }
  
  if(!$boss_map){
  	$result = mysqli_query($db,"SELECT * FROM boss_time WHERE map='".$mapid."'");
$rows = mysqli_fetch_array($result);
if($rows){
 	$rows['time']+=$map['boss_time'];
  		$rows['time']-=time();
  		if($rows['time']>"0"){
 $rows['time']=timesecond($rows['time']);
  		$boss_map="<br/>【boss】 ".$rows['time']."后再次刷新";}else{
  			$boss_map="<br/>【boss】 等待系统刷新中";
  		}
  } }

//获取当前地图宝箱

$resultl = mysqli_query($db,"SELECT * FROM baoxiang WHERE leibie='map' and map='".$mapid."'");
$my = mysqli_fetch_array($resultl);
if($my){
$maps_baoxiang= "<br/>【宝箱】";
}
$result = mysqli_query($db,"SELECT * FROM baoxiang WHERE leibie='map' and map='".$mapid."'");
while($row = mysqli_fetch_array($result))
  {
$maps_baoxiang.= "<a href='/map.games?id=".$map['id']."&baoxiang=".$row['id']."'><img src='/img/ico/".$row[ico]."'/>".$row['name']."</a> ";
  }

//获取地图可采集
if($map['wajue']!=null){
	$wajue="<br/>【采集】";
	$map_wajue= explode("|",$map['wajue']);
	 for($j=0;$j<count($map_wajue);$j++){
    //读取当前回复药剂效果
    $wajue_map = explode(",", $map_wajue[$j]); 
    $wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$wajue_map['0']."'");
$wupin = mysqli_fetch_array($wupin);
    	$wajue.="<a href='/wajue?id=".$map['id']."&wajue=$j'>".$wupin[name]."</a> ";

	 }
	
}




//地图方向

//北方
$bei_x=$x;
$bei_x-=1;
$bei = mysqli_query($db,"SELECT * FROM map WHERE x='".$bei_x."' and y='".$y."' and z='".$z."'");
$bei = mysqli_fetch_array($bei);
if ($bei['id']==""){

}else{
$bei= "<br/><a href='/map.games?id=".$bei['id']."'>北：".$bei['name']."↑</a>";

}

//南方
$nan_x=$x;
$nan_x+=1;
$nan = mysqli_query($db,"SELECT * FROM map WHERE x='".$nan_x."' and y='".$y."' and z='".$z."'");
$nan = mysqli_fetch_array($nan);

if ($nan['id']==""){

}else{
$nan= "<br/><a href='/map.games?id=".$nan['id']."'>南：".$nan['name']."↓</a>";
}

//西方
$xi_y=$y;
$xi_y-=1;
$zuo = mysqli_query($db,"SELECT * FROM map WHERE x='".$x."' and y='".$xi_y."' and z='".$z."'");
$zuo = mysqli_fetch_array($zuo);

if ($zuo['id']==""){

}else{
$zuo= "<br/><a href='/map.games?id=".$zuo['id']."'>西：".$zuo['name']."←</a>";

}

//东方
$dong_y=$y;
$dong_y+=1;
$you = mysqli_query($db,"SELECT * FROM map WHERE x='".$x."' and y='".$dong_y."' and z='".$z."'");
$you = mysqli_fetch_array($you);
if ($you['id']==""){

}else{
$you= "<br/><a href='/map.games?id=".$you['id']."'>东：".$you['name']."→</a>";

}


//上天
$shang_z+=$z;
$shang_z+=1;
$shang= mysqli_query($db,"SELECT * FROM map WHERE x='".$x."' and y='".$y."' and z='".$shang_z."'");
$shang= mysqli_fetch_array($shang);
if ($shang['id']==""){

}else{
$shang= "<br/><a href='/map.games?id=".$shang['id']."'>上：".$shang['name']."→</a>";

}
//入地
$xia_z+=$z;
$xia_z-=1;
$xia= mysqli_query($db,"SELECT * FROM map WHERE x='".$x."' and y='".$y."' and z='".$xia_z."'");
$xia = mysqli_fetch_array($xia);
if ($xia['id']==""){

}else{
$xia= "<br/><a href='/map.games?id=".$xia['id']."'>下：".$xia['name']."→</a>";

}






//地图显示
$html=<<<HTML
	$wajue
	$boss_map
$guaiwu_map
$map_npc1
$map_npc
$maps_baoxiang
<br/>
【玩家】
$map_user
$map_gengduo
<br/><cebter>============</center>
$bei
$nan
$zuo
$you
$shang
$xia

$footer
HTML;

echo $html;
if ($userid=="1"){
echo "<br/><a href='/manye/map?x=".$map['x']."&y=".$map['y']."&z=".$map['z']."'>管理后台</a>";

}
//
     mysqli_query($db,"update users set mys='map' where id='".$userid."'");
mysqli_query($db,"delete from guaiwu where leixing='guaiwu' and userid='".$userid."'");
mysqli_query($db,"delete from guaiwu where leixing='fuben' and userid='".$userid."'");
mysqli_query($db,"delete from boss_go where userid='".$userid."'");
unset($_SESSION['pvp']);
echo "<br/><a href='/main.do'>返回选择角色</a>";
//echo "<img src='http://api.btstu.cn/sjbz/?lx=m_meizi'/>";
     

