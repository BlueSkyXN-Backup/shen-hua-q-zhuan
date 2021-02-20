<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$userid=$_SESSION['users'];
$mapid=$_GET['id'];



//聊天信息分页显示
$perNumber=12; 
$page=$_GET['page']; 
$url="/maps?id=$mapid&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from users WHERE  map='".$mapid."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from users WHERE map='".$mapid."' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "地图没有玩家<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
echo user_name($row[id])."<br/>";

}


$qq=$page-1;
if ($page != 1) { 
echo "<a href='".$url."page=".$qq."'>上一页</a>";
} 
if ($page<$totalPage) { 
$qqw=$page+1;
echo "<a href='".$url."page=".$qqw."'>下一页</a> ";
}
if ($totalNumber){
echo "第".$page."页/共".$totalPage."页<br/>";
}else{
echo "没有玩家<br/>";

}
}





echo "<a href='/map.games?id=$zhuangtai_map'>只是路过</a> <br/>";

echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";

echo footer();?>