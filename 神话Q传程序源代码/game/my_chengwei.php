<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$userid=$_SESSION['users'];
$chengwei=$_GET['chengwei'];
$page=$_GET['page'];


    //聊天信息分页显示
$perNumber=8;
$url="my_chengwei?";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from users_chengwei WHERE userid='".$userid."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from users_chengwei  WHERE userid='".$userid."' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你没有获得称谓哦，快去做任务赢取称谓吧！<br/>";
}else{
echo"点击称谓立刻更换成功了！<br/>";
while($row=mysqli_fetch_array($result)){ 
 echo "<a href='/user/my?chengwei=$row[id]'>$row[name]</a><br/>";

}

 echo "<br/><br/>";

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
echo "你没有获得称谓哦，快去做任务赢取称谓吧！<br/>";
}
}



echo footer()."<br/><a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/>";


?>