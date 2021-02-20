<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}

$yuanshijiangli=$_SESSION['yuanshi'];
$guaiwu_yuanshi= explode("|", $yuanshijiangli); 
for($jl=0;$jl<count($guaiwu_yuanshi);$jl++) 
{
	$guaiwu = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$guaiwu_yuanshi[$jl]."'");
$guaiwu = mysqli_fetch_array($guaiwu);
//增加金币
   $suiji=rand(1,2);
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
$suiji1=rand(5,11);
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

$wupin_html.="". $xyz->beibao($guaiwu[diaoluo_id],$guaiwu[diaoluo_shuliang],$guaiwu[diaoluo_jilv],"999",$userid,"获得物品 ","<br/>")."";


//击杀怪物任务触发
$renwu=$class_renwu->jishu_guaiwu($guaiwu_yuanshi[$jl],$userid);

	
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
