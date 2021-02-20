<?php

if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

include $_SERVER['DOCUMENT_ROOT']."/class/pvp/class/jineng.php";
echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/>";
echo "<a href='index'>门派技能</a>|<a href='xiufu.php'>装备修复</a>|<a href='hecheng'>宝石合成</a>|<a href='/fuzhi/index'>副职技能</a><br/>-------------------------<br/>";
$my=$_GET['my'];
$get_shengji=$_GET['shengji'];
$userid=$_SESSION['users'];//

//定义种族技能
switch($user[zhongzu]){
case"4":
$jn+="5";
//佛
$u_jineng1="狂煞";
$u_jineng1_text="物理攻击单个目标，伤害跟随技能等级提高而提高。";
$u_jineng2="横扫千军";
    $u_jineng2_text="物理攻击单个目标，31/61级各增加一个目标，伤害跟随技能等级提高而提高。";
$u_jineng3="连环破斩";
    $u_jineng3_text="物理攻击单个目标2次，31/61级各增加一个目标，91级攻击次数增加到3次。伤害跟随技能等级提高而提高。";
$u_jineng4="作茧自缚";
    $u_jineng4_text="有几率对目标封印一个回合，几率随技能等级提升而提升";
$u_jineng5="天罗地网";
    $u_jineng5_text="有一定几率封印对手一个回合（可被仙族技能免疫或解除），61、91各增加一个目标。几率随技能等级提升而提升";
break;

case "1":
$jn+="10";
//妖
$u_jineng1="魅惑";
$u_jineng1_text="法术攻击单个目标。";
$u_jineng2="温柔乡里";
    $u_jineng2_text="使单个敌人迷失攻击目标并攻击队友";  
$u_jineng3="五蛟灭世";
    $u_jineng3_text="法术攻击2个目标，61级增加一个目标，";
$u_jineng4="情投意合";
    $u_jineng4_text="对敌人造成物理、法术伤害，31/61级增加一个目标。";
$u_jineng5="借刀杀人";
    $u_jineng5_text="使单个敌人攻击队友（可被人族技能免疫或解除），31/61/91/各增加一个目标，技能生效几率随技能等级提升而提升。";
break;

case"2":
$jn+="15";
//人
$u_jineng1="浩然正气";
$u_jineng1_text="法术攻击单个目标，31/61级各增加一个目标。伤害跟随技能等级提高而提高。";
$u_jineng2="凝神归元";
    $u_jineng2_text="恢复自身气血值，恢复数量受法术攻击与技能等级影响。";
$u_jineng3="妙手回春";
    $u_jineng3_text="恢复队友气血值，恢复数量受法术攻击与技能等级影响。";
$u_jineng4="起死回生";
    $u_jineng4_text="对我方死亡队友进行复活，并且恢复少许生命值。";
$u_jineng5="福星高照";
    $u_jineng5_text="免疫一回合自身或者队友的所有负面效果。并立即解除持续毒伤。";
break;

case"5":
$jn+="20";
//仙
$u_jineng1="天剑";
$u_jineng1_text="仙族召唤天剑攻击敌人，对目标照成超高法术伤害，照成伤害时恢复自生最大生命2%！";
$u_jineng3="地动星沉";
    $u_jineng3_text="法术攻击1个目标，31/91级各增加一个目标，当自身生命值低于对手时，将恢复自身5%已损失生命值。伤害跟随技能等级提高而提高。";
$u_jineng2="冰心咒";
    $u_jineng2_text="为自己附带一次免控效果，30/60/90级各增加一次免控效果（多次使用技能不会叠加免控次数），满级最多可免控4次。";
$u_jineng4="三昧真火";
    $u_jineng4_text="三昧真火净化负面效果！并为队友解除并且免疫1次佛祖封印效果。），90级增加到2个目标。";
$u_jineng5="天诛地灭";
    $u_jineng5_text="天诛地灭2个敌人！31/61/91级各增加一个攻击目标。";
break;
default:
//鬼
$u_jineng1="摄魂";
$u_jineng1_text="法术%比吸血单个目标，吸血伤害跟随技能等级提高而提高。";
$u_jineng2="消魂蚀骨";
    $u_jineng2_text="法术攻击单个目标，60、120级各增加一个目标，伤害跟随技能等级提高而提高。";
$u_jineng3="尸毒";
    $u_jineng3_text="对目标造成2个回合持续伤害，伤害跟随技能等级提高而提高。";
$u_jineng4="魂飞魄散";
    $u_jineng4_text="法术%比吸血单个目标，31、61级各增加一个目标，吸血伤害跟随技能等级提高而提高。";
$u_jineng5="万毒攻心";
    $u_jineng5_text="对目标造成2个回合持续伤害，31、61级各增加一个目标，91级吸血回合增加到3个回合，伤害跟随技能等级提高而提高。";
break;
}

$jineng1=$u_jineng1;
if($user[jineng1]=="0"){
$jineng1_zhuangtai="未学习";
}else{
$jineng1_zhuangtai=$user[jineng1]."级";
}
$jineng2=$u_jineng2;
if($user[jineng2]=="0"){
$jineng2_zhuangtai="未学习";
}else{
$jineng2_zhuangtai=$user[jineng2]."级";
}
$jineng3=$u_jineng3;
if($user[jineng3]=="0"){
$jineng3_zhuangtai="未学习";
}else{
$jineng3_zhuangtai=$user[jineng3]."级";
}
$jineng4=$u_jineng4;
if($user[jineng4]=="0"){
$jineng4_zhuangtai="未学习";
}else{
$jineng4_zhuangtai=$user[jineng4]."级";
}
$jineng5=$u_jineng5;
if($user[jineng5]=="0"){
$jineng5_zhuangtai="未学习";
}else{
$jineng5_zhuangtai=$user[jineng5]."级";
}
  switch ($my)
{
case "jineng1":
    $dengji_xuyao="0";
    $jn="1";
      break;
case "jineng2":
    $dengji_xuyao="20";
    $jn="2";
      break;
      case "jineng3":
   $dengji_xuyao="60";
   $jn="3";
      break;
      case "jineng4":
   $dengji_xuyao="90";
   $jn="4";
      break;
      case "jineng5":
   $dengji_xuyao="120";
   $jn="5";
      break;
default:
   if($my){ exit(检测到恶意修改URL！严重警告。);
}      
}

switch($user[zhongzu]){
case"4":
$jn+="5";
//佛
break;
case "1":
$jn+="10";
//妖
break;
case"2":
$jn+="15";
//人
break;
case"5":
$jn+="20";
//仙
break;
default:
//鬼
break;
}
////////////////////$u_jineng4
  //升级需要经验
$num1=$user[$my];
//等级*等级
$num1*=$num1;
$num1*=88;
//升级需要金币
$num2=$user[$my];
//等级*等级
$num2*=$num2;
$num2*=9;
if($get_shengji=="yes"){
if($user[dengji]>=$dengji_xuyao){
if($user[$my]<"120"){
if($user[jingyan]>$num1 && $user[gold]>$num2){
$user[jingyan]-=$num1;
$user[gold]-=$num2;
$user[$my]+=1;
$sql2="update users set jingyan='".$user[jingyan]."',gold='".$user[gold]."',$my='".$user[$my]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
if($ok){
echo"升级成功！<br/>";
}else{
echo"升级失败！<br/>";
}
}else{
echo"经验或者金币不足以升级技能<br/>";
}

}else{
  echo"技能等级最高120级。<br/>";
}
}else{
  echo"学习该技能需要玩家等级大于".$dengji_xuyao."级。<br/>";
}
}
////////////////////////////////////
//////////////////

$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);


$next=$user[$my]+"1";
 $userss_jineng=pvp_jineng($jn,$user[$my]);
        $jineng_u = explode("|", $userss_jineng); //打印当前等级
        if($jineng_u[3]=="wu"){
$gongji_leixing="物理";
}else{
$gongji_leixing="法术";
}
$userss_jineng=pvp_jineng($jn,$next);
        $jineng_n = explode("|", $userss_jineng); //打印出下一级

  //升级需要经验
$num1=$user[$my];
//等级*等级
$num1*=$num1;
$num1*=88;
//升级需要金币
$num2=$user[$my];
//等级*等级
$num2*=$num2;
$num2*=9;


switch($jineng_u['1']){


//佛

case "gongji":
$html="攻击".$jineng_u['2']."个目标".$jineng_u['0']."次,并造成".$gongji_leixing."(+".$jineng_u['10'].")伤害。造成伤害时：伤害强化为".$jineng_u['9']."倍";
$html2="攻击".$jineng_n['2']."个目标".$jineng_n['0']."次,并造成".$gongji_leixing."(+".$jineng_u['10'].")伤害。造成伤害时：伤害强化为".$jineng_n['9']."倍";
break;
case "qtyh":
$html="攻击".$jineng_u['2']."个目标".$jineng_u['0']."次,并造成65%物理+75%法术伤害。造成伤害时：伤害强化为".$jineng_u['9']."倍";
$html2="攻击".$jineng_n['2']."个目标".$jineng_n['0']."次,并造成65%物理+75%法术伤害。造成伤害时：伤害强化为".$jineng_n['9']."倍";
break;

default:
$html="呀呀呀~技能介绍正在路上赶来~";
$html2="正义也许会迟到，但他永远不会缺席！";
 
   break;
}



if($my){

  
    echo"<small>【".$jineng_u['5']."】<br/>当前".$user[$my]."级:".$html."<br/>下一级:".$html2;

if($user[$my]==0){
$name="确定学习";

 echo "</small><br/><a href='/jineng/index?my=$my&shengji=yes'>".$name."</a>";
}else{
$name="确定升级";

 echo "</small><br/>需要经验：".$num1."/".$user[jingyan]."<br/>需要金条：".$num2."/".$user[gold]."<br/><a href='/jineng/index?my=$my&shengji=yes'>".$name."</a>";
}
}else{
    echo "<a href='/jineng/index?my=jineng1'>".$jineng1."</a>".$jineng1_zhuangtai." <br/><a href='/jineng/index?my=jineng2'>".$jineng2."</a> ".$jineng2_zhuangtai." <br/><a href='/jineng/index?my=jineng3'>".$jineng3."</a> ".$jineng3_zhuangtai." <br/><a href='/jineng/index?my=jineng4'>".$jineng4."</a> ".$jineng4_zhuangtai." <br/><a href='/jineng/index?my=jineng5'>".$jineng5."</a> ".$jineng5_zhuangtai." <br/>";
    
}
echo "<br/>--------------------------<br/><a href='./index?'>技能首页</a> <br/>";


