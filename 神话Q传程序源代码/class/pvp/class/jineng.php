<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}


//显示技能名称
function jineng($kj,$leixing,$zhongzu,$url){
	global $db;
	global $_G;
	switch($zhongzu){
case"4":
//佛
$jineng[jineng1]="狂煞";
$jineng[jineng2]="横扫千军";
$jineng[jineng3]="连环破斩";
$jineng[jineng4]="作茧自缚";
$jineng[jineng5]="天罗地网";
break;

case "1":
//妖
$jineng[jineng1]="魅惑";
$jineng[jineng2]="情意绵绵";
$jineng[jineng3]="五蛟灭世";
$jineng[jineng4]="情投意合";
$jineng[jineng5]="借刀杀人";
break;

case"2":

//人
$jineng[jineng1]="浩然正气";
$jineng[jineng2]="凝神归元";
$jineng[jineng3]="妙手回春";
$jineng[jineng4]="起死回生";
$jineng[jineng5]="福星高照";
break;

case"5":
//仙
$jineng[jineng1]="天剑";
$jineng[jineng3]="地动星沉";
$jineng[jineng2]="冰心咒";
$jineng[jineng4]="三昧真火";
$jineng[jineng5]="天诛地灭";
break;
default:
//鬼
$jineng[jineng1]="摄魂";
$jineng[jineng2]="消魂蚀骨";
$jineng[jineng3]="尸毒";
$jineng[jineng4]="魂飞魄散";
$jineng[jineng5]="万毒攻心";
break;
}
if($leixing=="0"){
	$html="<a href='/Settings/index'>快捷</a>";
}else{
	$html="<a href='".$url.".do?go=".$kj."&md5=".$_G[md5]."'>".$jineng[$leixing]."</a>";
}
return $html;
}
//显示药品名称
function yaopin($leixing,$jinengid,$url){
	global $db;
		global $_G;
if($jinengid=="0"){
	$html="<a href='/Settings/index'>快捷</a>";
}else{
	$user_jineng = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM beibao WHERE id='".$jinengid."'"));
$jineng = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$user_jineng[wupin_id]."'"));
	$html="<a href='".$url.".do?go=".$leixing."&md5=".$_G[md5]."'>".$jineng['name']."</a>";
}
return $html;
}





function pvp_jineng($jineng_id,$jineng_dengji){
	
//鬼佛妖人仙
//获取种族技能
switch($jineng_id){
//鬼
case "1":
$jineng_name="摄魂";
$jineng_gongji="fa";
$jineng_leixing="xixue";
$jineng_fali=$jineng_dengji*2;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
  $jineng_xixue=$jineng_dengji*0.0018;//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue=$jineng_dengji*0.0022;//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;
       case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
    $jineng_xixue=$jineng_dengji*0.0024;//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="1";//攻击同一个怪物几次
  $jineng_xixue=$jineng_dengji*0.0025;//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
          break;
}

break;


case "2":
$jineng_name="消魂蚀骨";
$jineng_gongji="fa";
$jineng_leixing="gongji";
$jineng_fali=$jineng_dengji*3;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0013;//攻击翻倍数
      
  break;    
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.005;//攻击翻倍数
      
  break;
 
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0017;//攻击翻倍数
          break;
}

break;


case "3":
$jineng_name="尸毒";
$jineng_gongji="fa";
$jineng_leixing="dushang";
$jineng_fali=$jineng_dengji*4;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="2";//攻击同一个怪物几次
         $jineng_xixue="0.03";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="2";//攻击同一个怪物几次
         $jineng_xixue="0.06";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;   
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="2";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="2";//攻击同一个怪物几次
         $jineng_xixue="0.09";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
          break;
}

break;


case "4":
$jineng_name="魂飞魄散";
$jineng_gongji="fa";
$jineng_leixing="xixue";
$jineng_fali=$jineng_dengji*8;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
      $jineng_xixue=$jineng_dengji*0.0018;//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
        $jineng_xixue=$jineng_dengji*0.0018;//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;   
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
      $jineng_xixue=$jineng_dengji*0.0018;//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="1";//攻击同一个怪物几次
    $jineng_xixue=$jineng_dengji*0.0018;//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
          break;
}

break;


case "5":
$jineng_name="万毒攻心";
$jineng_gongji="fa";
$jineng_leixing="dushang";
$jineng_fali=$jineng_dengji*8;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="2";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="2";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="2";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<129:
           $jineng_cishu="3";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
          break;
}
break;

//佛

case "6":
$jineng_name="狂煞";
$jineng_gongji="wu";
$jineng_leixing="gongji";
$jineng_fali=$jineng_dengji*1;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.003";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0013;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0015;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.03";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0017;//攻击翻倍数
          break;
}

break;


case "7":
$jineng_name="横扫千军";
$jineng_gongji="wu";
$jineng_leixing="gongji";
$jineng_fali=$jineng_dengji*8;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0013;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0015;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0017;//攻击翻倍数
          break;
}

break;


case "8":
$jineng_leixing="gongji";
$jineng_name="连环破斩";
$jineng_gongji="wu";
$jineng_leixing="gongji";
$jineng_fali=$jineng_dengji*30;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="2";//攻击同一个怪物几次
         $jineng_xixue="0.03";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="2";//攻击同一个怪物几次
         $jineng_xixue="0.06";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.00013;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="2";//攻击同一个怪物几次
         $jineng_xixue="0.023";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.00015;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="3";//攻击同一个怪物几次
         $jineng_xixue="0.09";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.00017;//攻击翻倍数
          break;
}

break;


case "9":
$jineng_name="作茧自缚";
$jineng_gongji="wu";
$jineng_leixing="fengyin";
$jineng_fali=$jineng_dengji*10;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="3";//攻击同一个怪物几次
         $jineng_xixue="0.083";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="3";//攻击同一个怪物几次
         $jineng_xixue="0.096";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.099";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="3";//攻击同一个怪物几次
         $jineng_xixue="0.1";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
          break;
}

break;


case "10":
$jineng_name="天罗地网";
$jineng_gongji="wu";
$jineng_leixing="fengyin";
$jineng_fali=$jineng_dengji*30;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<129:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.046";//攻击吸血
            $jineng_shuliang="4";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
          break;
}
break;
//妖
case "11":
$jineng_name="魅惑";
$jineng_gongji="fa";
$jineng_leixing="gongji";
$jineng_fali=$jineng_dengji*1;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.003";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0013;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0015;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.03";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0017;//攻击翻倍数
          break;
}

break;


case "12":
$jineng_name="温柔乡里";
$jineng_gongji="wu";
$jineng_leixing="jiedao";
$jineng_fali=$jineng_dengji*4;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0013;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0015;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0017;//攻击翻倍数
          break;
}

break;


case "13":
$jineng_name="五蛟灭世";
$jineng_gongji="fa";
$jineng_leixing="gongji";
$jineng_fali=$jineng_dengji*5;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0013;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0015;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0017;//攻击翻倍数
          break;
}

break;


case "14":
$jineng_name="情投意合";
$jineng_gongji="fa";
$jineng_leixing="qtyh";
$jineng_fali=$jineng_dengji*8;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0013;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0015;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="2";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0017;//攻击翻倍数
          break;
}

break;


case "15":
$jineng_name="借刀杀人";
$jineng_gongji="fa";
$jineng_leixing="jiedao";
$jineng_fali=$jineng_dengji*30;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<129:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="4";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
          break;
}
break;

//人
case "16":
$jineng_name="浩然正气";
$jineng_gongji="fa";
$jineng_leixing="gongji";
$jineng_fali=$jineng_dengji*10;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0013;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0015;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=4;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0017;//攻击翻倍数
          break;
}

break;


case "17":
$jineng_name="凝神归元";
$jineng_gongji="fa";
$jineng_leixing="huixue1";
$jineng_fali=$jineng_dengji*5;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_huixue=1+$jineng_dengji*0.01;//攻击吸血
          
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.01;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_huixue=1+$jineng_dengji*0.013;//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_huixue=1+$jineng_dengji*0.015;//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_huixue=1+$jineng_dengji*0.017;//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
          break;
}

break;


case "18":
$jineng_name="妙手回春";
$jineng_gongji="fa";
$jineng_leixing="huixue2";
$jineng_fali=$jineng_dengji*10;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_huixue=1+$jineng_dengji*0.008;//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_huixue=1+$jineng_dengji*0.015;//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_huixue=1+$jineng_dengji*0.01;//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_huixue=1+$jineng_dengji*0.011;//攻击吸血
            $jineng_shuliang="4";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
          break;
}

break;


case "19":
$jineng_name="起死回生";
$jineng_gongji="fa";

$jineng_leixing="fuhuo";
$jineng_fali=$jineng_dengji*30;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="3";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="3";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="3";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
          break;
}

break;


case "20":
$jineng_name="福星高照";
$jineng_gongji="fa";
$jineng_leixing="jiechu";//解除负面小鬼
$jineng_fali=$jineng_dengji*10;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="3";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="4";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<129:
           $jineng_cishu="5";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="4";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
          break;
}
break;

//仙
case "21":
$jineng_name="天剑";
$jineng_gongji="fa";
$jineng_leixing="tianjian";
$jineng_fali=$jineng_dengji*2;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.003";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0025;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0058;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0076;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.03";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0099;//攻击翻倍数
          break;
}

break;


case "22":
$jineng_name="冰心咒";
$jineng_gongji="fa";
$jineng_leixing="mianyi";
$jineng_fali=$jineng_dengji*3;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
          break;
}

break;


case "23":
$jineng_name="地动星沉";
$jineng_gongji="fa";
$jineng_leixing="ddxc";
$jineng_fali=$jineng_dengji*7;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0013;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="2";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0015;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="2";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0017;//攻击翻倍数
          break;
}

break;


case "24":
$jineng_name="三昧真火";
$jineng_gongji="fa";
$jineng_leixing="mianyi";
$jineng_fali=$jineng_dengji*10;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="3";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="3";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<121:
           $jineng_cishu="3";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
          break;
}

break;


case "25":
$jineng_name="天诛地灭";
$jineng_gongji="fa";
$jineng_leixing="gongji";
$jineng_fali=$jineng_dengji*7;
switch($jineng_dengji){
     case $jineng_dengji>0 && $jineng_dengji<31:
            $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="2";//攻击几只怪物
            $jineng_shanghai=10;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.002;//攻击翻倍数
            break;
    case $jineng_dengji>30 && $jineng_dengji<61:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="3";//攻击几只怪物
            $jineng_shanghai=30;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0043;//攻击翻倍数
      
  break;  
  case $jineng_dengji>60 && $jineng_dengji<91:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0.013";//攻击吸血
            $jineng_shuliang="4";//攻击几只怪物
            $jineng_shanghai=50;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0065;//攻击翻倍数
      
  break;
    case $jineng_dengji>90 && $jineng_dengji<129:
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="5";//攻击几只怪物
            $jineng_shanghai=80;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.0083;//攻击翻倍数
          break;
}
break;
//BOSS
case "98":
$jineng_name="终焉审判";
$jineng_gongji="fa";
$jineng_leixing="aoyilunhui";
$jineng_fali=0;
            $jineng_cishu="1";//攻击同一个怪物几次
    $jineng_xixue=0;//攻击吸血
            $jineng_shuliang="999999";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
break;

case "99":
$jineng_name="全体攻击";
$jineng_gongji="fa";
$jineng_leixing="gongji";
$jineng_fali=$jineng_dengji*10;
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="9999";//攻击几只怪物
            $jineng_shanghai=$jineng_dengji*100;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数

break;
case "101":
$jineng_name="三生诀";
$jineng_gongji="fa";
$jineng_leixing="gongji";
$jineng_fali=$jineng_dengji*0;
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="99999";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.011;//攻击翻倍数

break;
case "102":
$jineng_name="圣诞冰封";
$jineng_gongji="wu";
$jineng_leixing="sdbf";
$jineng_fali=0;
            $jineng_cishu="1";//攻击同一个怪物几次
    $jineng_xixue=0;//攻击吸血
            $jineng_shuliang="999999";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
break;
case "103":
$jineng_name="天震地骇";
$jineng_gongji="fa";
$jineng_leixing="gongji";
$jineng_fali=$jineng_dengji*0;
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="7";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.011;//攻击翻倍数

break;
case "104":
$jineng_name="末世终焉";
$jineng_gongji="wu";
$jineng_leixing="sdbf";
$jineng_fali=0;
            $jineng_cishu="1";//攻击同一个怪物几次
    $jineng_xixue=0;//攻击吸血
            $jineng_shuliang="999999";//攻击几只怪物
            $jineng_shanghai=1888;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.01;//攻击翻倍数
break;
case "105":
$jineng_name="命运";
$jineng_gongji="fa";
$jineng_leixing="myzs";
$jineng_fali=0;
            $jineng_cishu="1";//攻击同一个怪物几次
    $jineng_xixue=0;//攻击吸血
            $jineng_shuliang="999999";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1+$jineng_dengji*0.001;//攻击翻倍数
break;
default:
$jineng_name="普通攻击";
$jineng_gongji="wu";
$jineng_leixing="gongji";
           $jineng_cishu="1";//攻击同一个怪物几次
         $jineng_xixue="0";//攻击吸血
            $jineng_shuliang="1";//攻击几只怪物
            $jineng_shanghai=0;//附带伤害
            $jineng_fanbei=1;//攻击翻倍数
 
   break;
}

return $jineng_cishu."|".$jineng_leixing."|".$jineng_shuliang."|".$jineng_gongji."|".$jineng_fali."|".$jineng_name."|".$jineng_xixue."|".$jineng_huixue."|".$jineng_dengji."|".$jineng_fanbei."|".$jineng_shanghai;
}
?>