<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$userid=$_SESSION['users'];
$id=$_GET['id'];
$wap=$_GET['wap'];
$page=$_GET['page']; 


if(!$wap){
echo"请选择装备进行强化<br/>";
$perNumber=8;
$url="./index?";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from zhuangbei WHERE userid='".$userid."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from zhuangbei WHERE leixing!='fw' and userid='".$userid."' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你没有装备<br/>";
}else{
while($zhuangbei=mysqli_fetch_array($result)){ 

  echo zhuangbei_name($zhuangbei[id])." <a href='./index?id=$zhuangbei[id]&wap=1'>强化</a><br/>";



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
echo "你没有装备可以强化。<br/>";
}
}

   echo "<br/>强化装备，是进阶顶级神器的必选方式之一！<br/> ";
}else{
$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$id."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei[yuanshi]."'");
$muban_zhuangbei = mysqli_fetch_array($muban_zhuangbei);
if($zhuangbei[time]!=null){
echo "当前装备非永久装备，强化后装备到期会被系统回收！<br/>";
}


$html=<<<HTML
<img src='/img/kz.gif' />请选择要强化的属性<br/>
气血：$muban_zhuangbei[qixue] <a href='/Strengthen/Operation?id=$zhuangbei[id]&shuxing=qh1'>强化$zhuangbei[qh1]</a>+$qianghua1<br/>
法力：$muban_zhuangbei[fali] <a href='/Strengthen/Operation?id=$zhuangbei[id]&shuxing=qh2'>强化$zhuangbei[qh2]</a>+$qianghua2<br/>
防御：$muban_zhuangbei[fangyu] <a href='/Strengthen/Operation?id=$zhuangbei[id]&shuxing=qh3'>强化$zhuangbei[qh3]</a>+$qianghua3<br/>
法攻：$muban_zhuangbei[fagong] <a href='/Strengthen/Operation?id=$zhuangbei[id]&shuxing=qh4'>强化$zhuangbei[qh4]</a>+$qianghua4<br/>
物攻：$muban_zhuangbei[wugong] <a href='/Strengthen/Operation?id=$zhuangbei[id]&shuxing=qh5'>强化$zhuangbei[qh5]</a>+$qianghua5<br/>
速度：$muban_zhuangbei[sudu] <a href='/Strengthen/Operation?id=$zhuangbei[id]&shuxing=qh6'>强化$zhuangbei[qh6]</a>+$qianghua6<br/>
HTML;
echo $html;

echo "<a href='./index?'>重新选择装备</a><br/>";
}
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
?>