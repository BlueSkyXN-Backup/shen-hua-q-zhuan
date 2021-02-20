<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$my=$_GET['my'];
$ok=$_GET['ok'];
$id=$_GET['id'];
 switch($user[zhongzu]){
case"4":
//佛
$jineng[jineng1]="狂煞";
$jineng[jineng2]="横扫千军";
$jineng[jineng3]="连环破斩";
$jineng[jineng4]="作茧自缚";
$jineng[jineng5]="天罗地网";
break;

case "1":
;
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
$jineng[jineng3]="万剑归宗";
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

if($my){
    if($my>'0' and $my<'6'){
  echo"点击药品名称设置快捷菜单<br/> ";
$result = mysqli_query($db,"SELECT * FROM muban_wuping WHERE kuaijie='yes'");
while($row = mysqli_fetch_array($result))
  {
$wp = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$row[id]."' and userid='".$userid."'");
$wp = mysqli_fetch_array($wp);
if($wp){
  echo"<a href='index?ok=".$my."&id=".$wp[id]."'>$row[name]</a><br/> ";
}else{
  echo"$row[name](未拥有)<br/> ";
}

  }
}elseif($my>'5' and $my<'11'){
      echo"点击技能名称设置快捷菜单<br/> ";
    	for($k=1;$k<6;$k++) 
{
    if($user['jineng'.$k]!=0){
        echo"<a href='index?ok=".$my."&id=".$k."'>".$jineng['jineng'.$k]."</a><br/> ";
    }else{
  echo$jineng['jineng'.$k]."(未学习)<br/> ";
}
    
    
}
    
    
   echo'<div class="tip">=======华丽分割=======</div>' ;
}else{
    
  echo"迷路了~找找回家的路吧。<br/> ";
}

}



  //设置快捷菜单
  if($ok){
      if($ok>'0' and $ok<'6'){
 $wp = mysqli_query($db,"SELECT * FROM beibao WHERE id='".$id."' and userid='".$userid."'");
$wp = mysqli_fetch_array($wp);
if($wp){
  $result = mysqli_query($db,"SELECT * FROM muban_wuping WHERE ID='".$wp[wupin_id]."' and kuaijie='yes'");
$row = mysqli_fetch_array($result);
  if($row){
    $ok="kj".$ok;
    echo $ok;
    $user[$ok]=$wp[id];
    $sql1="update users set  $ok='".$wp[id]."' where id='".$userid."'";
$ok1=mysqli_query($db,$sql1);
if($ok1){
  echo"设置成功！<br/> ";
}else{
  echo"设置失败！<br/> ";
}
    
  }else{
   echo"该物品不能设置战斗快捷方式！<br/> ";
  }
}else{
  echo"你没有拥有该物品<br/> ";
}

}elseif($ok>'5' and $ok<'11'){
    
    
    if($user['jineng'.$id]!=0){
        $ok="kj".$ok;
        $user[$ok]="jineng".$id;
            $sql1="update users set  $ok='".$user[$ok]."' where id='".$userid."'";
$ok1=mysqli_query($db,$sql1);
if($ok1){
  echo"设置成功！<br/> ";
}else{
  echo"设置失败！<br/> ";
}
    }else{
        echo"你未学习该技能<br/>";
    }
    
    
}else{
    
  echo"迷路了~找找回家的路吧。<br/> ";
}
}




///华丽显示
	for($k=1;$k<6;$k++) 
{
$result = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and id='".$user['kj'.$k]."'");
$kj = mysqli_fetch_array($result);
if($kj){
$result = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$kj[wupin_id]."'");
$wp= mysqli_fetch_array($result);

$kuaijie_yaoping.=" <a href='index?my=".$k."'>$wp[name]($kj[shuliang])</a>";


}else{
$kuaijie_yaoping.=" <a href='index?my=".$k."'>未设置快捷药品".$k."</a>";
}
}


	for($k=6;$k<11;$k++) 
{
   
$i+="1";
if($user['kj'.$k]!="0"){
    $kj=$user['kj'.$k];
$kuaijie_jineng.=" <a href='index?my=".$k."'>$jineng[$kj]</a>";
}else{
$kuaijie_jineng.=" <a href='index?my=".$k."'>未设置快捷技能".$i."</a>";
}
}
echo"点击设置战斗快捷药品<br/>";
echo"$kuaijie_yaoping";
echo"<br/>点击设置战斗快捷技能<br/>";
echo"$kuaijie_jineng";


echo "<br/><a href='/map.games?id=".$zhuangtai_map."'>返回地图</a>";
