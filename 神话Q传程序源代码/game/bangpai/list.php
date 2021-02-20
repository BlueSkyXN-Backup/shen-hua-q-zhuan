<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
//帮派列表
$list=$_GET['list'];
echo"帮派搜索<br/>";
echo "<form action='list' method='get'>";
echo "名称:<br/>";
echo "<input name='list' maxlength='100' value='$list'/>";
echo '<input type="submit" value="搜索帮派" class="link"/></form>---------------<br/>';

$perNumber=10; 
$page=$_GET['page']; 
$url="list?";
if($list){
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from bangpai WHERE  name like '%".$list."%'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from bangpai  WHERE  name like'%".$list."%' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你没有接受任何任务，快去游戏里寻找活动任务吧！<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 

echo "<a href='bangpai.php?id=$row[id]'>$row[name]</a><br/>";
}


$qq=$page-1;
if ($page != 1) { 
echo "<a href='".$url."page=".$qq."&task=".$list."'>上一页</a>";
} 
if ($page<$totalPage) { 
$qqw=$page+1;
echo "<a href='".$url."page=".$qqw."&task=".$list."'>下一页</a> ";
}
if ($totalNumber){
echo "第".$page."页/共".$totalPage."页<br/>";
}else{
echo "没有包含“".$list."”关键词的帮派<br/>";
}
}
}else{


}





echo "<br/><a href='list'>查看所有地图</a><br/><a href='/map.games'>返回地图</a>";


?>