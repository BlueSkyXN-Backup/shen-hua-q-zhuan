<?php
   
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
switch ($pvp_leixing) {

   case "boss":
//taopao
  $sql3 = "delete from boss_go where  userid='".$userid."' and map='".$user[map]."'";
$ok=mysqli_query($db,$sql3);
$ok_pao=mysqli_query($db,"update users set mys='map' where id='".$userid."'");
if($ok_pao && $ok)
{header("location:../map.games");//跳转地址
}
     break;
     case "pk":
  $sql3 = "delete from pk where  userid='".$userid."' or npcid='".$userid."'";
$ok=mysqli_query($db,$sql3);
//taopao
$ok_pao=mysqli_query($db,"update users set mys='map' where id='".$userid."'");
if($ok_pao && $ok)
{header("location:../map.games");//跳转地址
}
     break;
   default:
//taopao
$ok_pao=mysqli_query($db,"update users set mys='map' where id='".$userid."'");
if($ok_pao)
{header("location:../map.games");//跳转地址
}
}



