<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}

  $html=<<<HTML

战斗胜利<a href='/map.games'>返回地图</a> <br/>

HTML;
//判断奖励
  if($_GET['md5']){
    if($_GET['md5']!=$_G[md5]){
      $html.="请不要重复刷新战斗胜利页面！";
    }else{
	$_SESSION['md5']=md5(md5(time()));
$resultl = mysqli_query($db,"SELECT * FROM boss_time WHERE map='".$user[map]."'");
$bossjiangli= mysqli_fetch_array($resultl);
$bossa="boss";
$bossa.=$bossjiangli[names];
$bossjianglis=$redis->lpop($bossa);
if($bossjianglis=="yes"){
    //设置限制击杀
$rc_cishu = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM boss_cishu WHERE boss='".$bossjiangli[id]."' and userid='".$userid."'"));
if(!$rc_cishu){
    $s="insert into boss_cishu(cishu,boss,userid) values('1','".$bossjiangli[id]."','".$userid."')";
$ok=mysqli_query($db,$s);
}else{
$rc_cishu[cishu]+="1";
 $sql1="update boss_cishu set cishu='".$rc_cishu[cishu]."' where boss='".$rc_cishu[boss]."' and userid='".$userid."'";
mysqli_query($db,$sql1);
}
$yuanshijiangli=$bossjiangli[boss_id];
//获得奖励开始
$guaiwu_yuanshi= explode(",", $yuanshijiangli); 
for($jl=0;$jl<count($guaiwu_yuanshi);$jl++) 
{
	//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁

$guaiwu = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$guaiwu_yuanshi[$jl]."'");
$guaiwu = mysqli_fetch_array($guaiwu);
//增加金币
   $suiji=rand(90,120);
   $gold=$guaiwu[dengji];
    $gold*=$suiji;
    //判断BUFF是否有效
    if($user[buff_gold]>time()){
        $gold*=2;
    }
    if($user[vip]>time()){
        $gold*=1.5;
    }
   $user[gold] +=$gold;
   $sql2="update users set gold='".$user[gold]."' where id='".$userid."'";
   $ok=mysqli_query($db,$sql2);
   $jiangligold+=$gold;
//增加经验
$suiji1=rand(9000,12000);
$jingyan=$guaiwu[dengji];
$jingyan*=$suiji1;
$jingyan*=3;
  //判断BUFF是否有效
if($user[buff_jingyan]>time()){
  $jingyan*=2;
}
  //判断BUFF是否有效
if($user[vip]>time()){
  $jingyan*=2;
}
$myjingyan=$user[jingyan];
$user[jingyan] +=$jingyan;
$sql2="update users set jingyan='".$user[jingyan]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
//宠物经验
if($user[chongwu_id]!="0"){
	$chongwu= mysqli_query($db,"SELECT * FROM pet WHERE userid='".$userid."' and id='".$user[chongwu_id]."'");
$chongwu= mysqli_fetch_array($chongwu);
$chongwu[jingyan] +=$jingyan;
$sql2="update pet set jingyan='".$chongwu[jingyan]."' where id='".$user[chongwu_id]."'";
$ok=mysqli_query($db,$sql2);
}
$jianglijingyan +=$jingyan;
   if($user[duiwu_id]!=NULL){
     $zudui_jingyan=$jianglijingyan;
     $zudui_jingyan*="0.4";
     $result = mysqli_query($db,"SELECT * FROM users WHERE duiwu_id='".$user[duiwu_id]."'");
while($row = mysqli_fetch_array($result))
  {
  $row[jingyan] +=$zudui_jingyan;
$sql2="update users set jingyan='".$row[jingyan]."' where id='".$row[id]."'";
$ok=mysqli_query($db,$sql2);
  $s0="insert into duiwu_email(text,userid,leixing,duiwuid) values('获得".$zudui_jingyan."点组队战斗经验','".$row[id]."','1','".$row[duiwu_id]."')";
$ok=mysqli_query($db,$s0);

}
   }
  //查看背包是否有空间储存
  $wupin_html.="". $xyz->beibao($guaiwu[diaoluo_id],$guaiwu[diaoluo_shuliang],$guaiwu[diaoluo_jilv],"999",$userid,"获得物品 ","<br/>")."";

  
 
//击杀怪物任务触发
$renwu=$class_renwu->jishu_guaiwu($guaiwu_yuanshi[$jl],$userid);

//击杀怪物触发任务 结束
mysqli_query($db,"COMMIT");
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");
}
$html.="我|血：".$user[qixue]."/".$user[qixuemax]." <br/>
我|法：".$user[fali]."/".$user[fali_max]."  <br/>";
if($user[chongwu_id]!="0"){
$html.=$chongwu[username]."|血：".$chongwu[qixue]."/".$chongwu[qixuemax]." <br/>
".$chongwu[username]."|法：".$chongwu[fali]."/".$chongwu[fali_max]."  <br/>";
}
$html.="---------------------<br/>获得金币：".$jiangligold."
<br/>获得经验：".$jianglijingyan."<br/>";
if($user[chongwu_id]!="0"){
$html.= $chongwu[username]."获得经验：".$jianglijingyan."<br/>";
}
$html.="获得组队经验：".$zudui_jingyan."<br/>";
$html.=$wupin_html;
$html.=$renwu;

$boss_tip= "金币*".$jiangligold."
,经验*".$jianglijingyan."";
$boss_tip.=$wupin_html ;
$s0="insert into Boss_tip(text,userid,time,name) values('".$boss_tip."','".$userid."','".time()."','".$bossjiangli[name]."')";
$ok=mysqli_query($db,$s0);
//更新boss时间
$sql1="update map set  boss_time='".time()."' where id='".$user[map]."'";
$ok=mysqli_query($db,$sql1);
}else{
    $html.="怪物已被其他玩家击杀。";
}
}
}