<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

//获取boss打败
$time_boss=time();
$time_boss-="1200";
$exec="select * from Boss_tip WHERE time>'".$time_boss."' order by time desc limit 20"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$xtuser=mysqli_query($db,"SELECT * FROM users WHERE id='".$row[userid]."'");
$xtuser=mysqli_fetch_array($xtuser);
echo  user_name($xtuser[id])."击败了$row[name]获得$row[text]<br/>----------------------------<br/>";
}

echo "<br/><a href='/map.games?id=$user[map]'>只是路过</a> <br/>";

echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/><br/>";

?>