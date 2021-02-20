<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$task=$_GET['task'];


//echo "<a href='npc.php'>NPC</a>|<a href='index.php'>地图</a><br/>";
if($task){
echo"【怪物图鉴大全】<br/>";
$perNumber=10; 
$page=$_GET['page']; 
$url="guaiwu?";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from muban_guaiwu WHERE  name like '%".$task."%'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from muban_guaiwu  WHERE  name like'%".$task."%' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你没有接受任何任务，快去游戏里寻找活动任务吧！<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 

echo "<a href='guaiwu_text?id=$row[id]'>$row[name]</a><br/>";
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
echo "没有包含“".$task."”的物品<br/>";
}
}
}else{
    echo"输入怪物名字开始搜索";
}

echo "<form action='guaiwu' method='get'>";
echo "怪物名称:<br/>";
echo "<input name='task' maxlength='100' value='$task'/>";
echo '<input type="submit" value="搜索" class="link"/></form>';



echo "<br/><a href='guaiwu'>搜索首页</a><br/><a href='/map.games'>返回地图</a>";



