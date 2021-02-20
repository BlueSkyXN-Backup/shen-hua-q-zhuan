<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$mys=$_GET['my'];


echo "<a href='/Rank/Rank.php?my=2'>等级</a>|<a href='/Rank/Rank.php?my=3'>财富</a>|<a href='/Rank/Rank.php?my=14'>宠物</a> |<a href='/Rank/Rank.php?my=5'>气血</a>|<a href='/Rank/Rank.php?my=6'>法力</a>|<a href='/Rank/Rank.php?my=8'>物攻</a>|<a href='/Rank/Rank.php?my=9'>法攻</a>|<a href='/Rank/Rank.php?my=10'>防御</a>|<a href='/Rank/Rank.php?my=7'>速度</a>|<a href='/Rank/Rank.php?my=11'>恶人</a>|<a href='/Rank/Rank.php?my=13'>贵族</a><br/>";


switch($mys){
case"1":
$exec="select * from news order by id desc limit 10"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$xtuser=mysqli_query($db,"SELECT * FROM users WHERE id='".$row[userid]."'");
$xtuser=mysqli_fetch_array($xtuser);
echo  "[系统]".user_name($xtuser[id])."$row[text]<br/>";
}
break;
case"2":
$exec="select * from users WHERE zhuangtai='yes' order by dengji desc limit 10"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
if($row[zhuansheng]=="1"){
    $zhuanshengname="一转";
}elseif($row[zhuansheng]=="2"){
    $zhuanshengname="二转";
}elseif($row[zhuansheng]=="3"){
    $zhuanshengname="三转";
}elseif($row[zhuansheng]=="4"){
    $zhuanshengname="四转";
}else{
    $zhuanshengname="";
}
$ids+="1";
echo  $ids.".".user_name($row[id])."".$zhuanshengname."$row[dengji]级<br/>";
}
break;
case"3":
$exec="select * from users WHERE zhuangtai='yes' order by gold DESC limit 11"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$ids+="1";
echo  $ids.".".user_name($row[id])."$row[gold]金条<br/>";
}

break;
    case"5":
$exec="select * from users WHERE zhuangtai='yes'and dengji>'29' order by qixuemax DESC limit 10"; 

$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$ids+="1";
echo  $ids.".".user_name($row[id])."气血值 $row[qixuemax]<br/>";
}
echo"能力排行只显示等级大于30的玩家！<br/>";
break;
    case"6":
$exec="select * from users WHERE zhuangtai='yes'and dengji>'29' order by fali_max DESC limit 10"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$ids+="1";
echo  $ids.".".user_name($row[id])."法力$row[fali_max]<br/>";
}
echo"能力排行只显示等级大于30的玩家！<br/>";
break;
    case"7":
$exec="select * from users WHERE zhuangtai='yes'and dengji>'29' order by sudu DESC limit 10"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$ids+="1";
echo  $ids.".".user_name($row[id])."速度$row[sudu]<br/>";
}
echo"能力排行只显示等级大于30的玩家！<br/>";
break;
        case"8":
$exec="select * from users WHERE zhuangtai='yes'and dengji>'29' order by gongji DESC limit 10"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$ids+="1";
echo  $ids.".".user_name($row[id])."物攻 $row[gongji]<br/>";
}
echo"能力排行只显示等级大于30的玩家！<br/>";
break;
        case"9":
$exec="select * from users WHERE zhuangtai='yes'and dengji>'29' order by gongji_fa DESC limit 10"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$ids+="1";
echo  $ids.".".user_name($row[id])."法攻$row[gongji_fa]<br/>";
}
echo"能力排行只显示等级大于30的玩家！<br/>";
break;
        case"10":
$exec="select * from users WHERE zhuangtai='yes'and dengji>'29' order by fangyu DESC limit 10"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$ids+="1";
echo  $ids.".".user_name($row[id])."防御值 $row[fangyu]<br/>";
}
echo"能力排行只显示等级大于30的玩家！<br/>";
break;
   case"11":
$exec="select * from users WHERE  dengji>'29' order by zuie DESC limit 10"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$ids+="1";
echo  $ids.".".user_name($row[id])."罪恶值 $row[zuie]<br/>";
}
echo"罪恶越高死亡掉落的金条越多哦！<br/>";
break;
   case"12":
$exec="select * from users WHERE dengji>'0' order by beibao_rongliangmax DESC limit 10"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$ids+="1";
echo  $ids.".".user_name($row[id])."背包空间 $row[beibao_rongliangmax]<br/>";
}
echo"背包越大越好，物品越多越好！<br/>";
break;

   case"13":
$exec="select * from users WHERE dengji>'0' and chongzhi>'0' order by chongzhi DESC limit 10"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$ids+="1";
echo  $ids.".".user_name($row[id])."<br/>";
}
echo"最近15天充值排名。<br/>";
break;
   case"14":
       //宠物排行
$exec="select * from pet WHERE dengji>'0' order by gongji DESC limit 10"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$ids+="1";
$exec3="select * from users WHERE id='".$row[userid]."'"; 
$result3=mysqli_query($db,$exec3); 
$row2=mysqli_fetch_array($result3);
echo  $ids.".".user_name($row2[id])."的$row[username] $row[gongji]物攻<br/>";
}

echo"-----------------------------<br/>";
$exec="select * from pet WHERE  dengji>'0' order by gongji_fa DESC limit 10"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$ids1+="1";
$exec3="select * from users WHERE id='".$row[userid]."'"; 
$result3=mysqli_query($db,$exec3); 
$row2=mysqli_fetch_array($result3);
echo  $ids1.".".user_name($row2[id])."的$row[username] $row[gongji_fa]法攻<br/>";
}
echo"-----------------------------<br/>";
$exec="select * from pet WHERE dengji>'0' order by fangyu DESC limit 10"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$ids2+="1";
$exec3="select * from users WHERE id='".$row[userid]."'"; 
$result3=mysqli_query($db,$exec3); 
$row2=mysqli_fetch_array($result3);
echo  $ids2.".".user_name($row2[id])."的$row[username] $row[fangyu]防御<br/>";
}
echo"强的的神宠 <br/>";
break;

default:
$exec="select * from users WHERE zhuangtai='yes'and dengji>'29' order by gongji DESC limit 10"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$ids+="1";
echo  $ids.".".user_name($row[id])."物攻 $row[gongji]<br/>";
}
echo"能力排行只显示等级大于30的玩家！<br/>";
break;
}







echo "<a href='/map.games?id=$zhuangtai_map'>只是路过</a> <br/>";

echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
?>