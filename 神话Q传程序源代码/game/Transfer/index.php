<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$userid=$_SESSION['users'];
$task=$_GET['task'];



echo "<a href='npc'>NPC</a>|<a href='index'>地图</a><br/>";

echo"【地图传送】<br/>";
$perNumber=10; 
$page=$_GET['page']; 
$url="index?";
if($task){
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from map WHERE  name like '%".$task."%'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from map  WHERE  name like'%".$task."%' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你没有接受任何任务，快去游戏里寻找活动任务吧！<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 

echo "<a href='/map.games?id=$row[id]'>$row[name]</a><br/>";
}


$qq=$page-1;
if ($page != 1) { 
echo "<a href='".$url."page=".$qq."&task=".$task."'>上一页</a>";
} 
if ($page<$totalPage) { 
$qqw=$page+1;
echo "<a href='".$url."page=".$qqw."&task=".$task."'>下一页</a> ";
}
if ($totalNumber){
echo "第".$page."页/共".$totalPage."页<br/>";
}else{
echo "没有包含“".$task."”的地图<br/>";
}
}
}else{


$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from map WHERE  tuijianif ='1'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from map  WHERE  tuijianif ='1' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你没有接受任何任务，快去游戏里寻找活动任务吧！<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 

echo "<a href='/map.games?id=$row[id]'>$row[name]</a>($row[tuijian])<br/>";
}


$qq=$page-1;
if ($page != 1) { 
echo "<a href='".$url."page=".$qq."&task=".$task."'>上一页</a>";
} 
if ($page<$totalPage) { 
$qqw=$page+1;
echo "<a href='".$url."page=".$qqw."&task=".$task."'>下一页</a> ";
}
if ($totalNumber){
echo "第".$page."页/共".$totalPage."页<br/>";
}else{
echo "没有推荐地图<br/>";
}
}


}


echo "<form action='index' method='get'>";
echo "地名关键词:<br/>";
echo "<input name='task' maxlength='100' value='$task'/>";
echo '<input type="submit" value="地图搜索" class="link"/></form>';



echo "<br/><a href='index'>地图图鉴</a><br/><a href='/map.games'>返回地图</a>";


?>