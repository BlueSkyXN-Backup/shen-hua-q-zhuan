<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
$resultl = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and id='".$user[$GO]."'");
$wp_yao = mysqli_fetch_array($resultl);
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$wp_yao[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
  $xiaohao_xiaoguo= explode("|", $wupin[xiaohao_xiaoguo]);
  for($j=0;$j<count($xiaohao_xiaoguo);$j++){
    //读取当前回复药剂效果
    $huifu_xiaohuo = explode(",", $xiaohao_xiaoguo[$j]); 
  switch($huifu_xiaohuo[0]){
case"hp":
$user[qixue] +=$huifu_xiaohuo[1];
      if($user[qixue]>$user[qixuemax]){
$user[qixue]=$user[qixuemax];
$shiyong_jiaxue=bcsub("$user[qixuemax]","$yuanshi_xue");  //加了多少血
}
$sql2="update users set qixue='".$user[qixue]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="增加气血:".$huifu_xiaohuo[1]." ";
break;
case"ap":
$user[fali] +=$huifu_xiaohuo[1];
      if($user[fali]>$user[fali_max]){
$user[fali]=$user[fali_max];
$shiyong_jiaxue=bcsub("$user[fali_max]","$yuanshi_xue");  //加了多少血
}
$sql2="update users set fali='".$user[fali]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
$xiaoguo.="增加法力:".$huifu_xiaohuo[1]." ";
break;
default:
break;
}
 
  }
//使用成功
$s3="insert into pvp_tip(text,cid,time) values('".$user[username]."使用了".$wupin[name]."".$xiaoguo."','".$pk[id]."','".time()."')";
$ok=mysqli_query($db,$s3);

//减去物品
$wp_yao[shuliang]-="1";
if($wp_yao[shuliang]<"1"){

$sql3 = "delete from beibao where id ='".$wp_yao[id]."'";
$ok=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$wp_yao[shuliang]."' where id='".$wp_yao[id]."'";
$ok=mysqli_query($db,$sql2);
}  