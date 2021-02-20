<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$id=$_GET['zhuangbei'];//装备id
$kong=$_GET['kong'];//镶嵌孔位
$baoshi=$_GET['baoshi'];//镶嵌的宝石ID
$jibie=$_GET['jibie'];//镶嵌的宝石级别


//开始编写选择镶嵌代码
$page=$_GET['page']; 










//判断装备id只能为数字
if(!preg_match('/^[0-9]+$/u',$id)) {
echo"请选择装备进行镶嵌<br/>";
$perNumber=8;
$url="./xiangqian_index.php?";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from zhuangbei WHERE userid='".$userid."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from zhuangbei WHERE userid='".$userid."' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "你没有装备<br/>";
}else{
while($zhuangbei=mysqli_fetch_array($result)){ 

echo zhuangbei_name($zhuangbei[id])." <a href='./xiangqian_index.php?zhuangbei=$zhuangbei[id]&wap=1'>镶嵌</a><br/>";


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
echo "你没有装备可以镶嵌。<br/>";
}
}

   echo "<br/>装备镶嵌，是进阶顶级神器的必选方式之一！<br/><br/> ";
}else{
	$resultl = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$id."' and userid='".$userid."'");
$zhuangbeiif= mysqli_fetch_array($resultl);
if (!$zhuangbeiif){
echo"你未拥有该装备，终止代码行为！";
exit();//结束
}else{
    if($zhuangbeiif[time]!=null){
echo "当前装备非永久装备，强化后装备到期会被系统回收！<br/>";
}
	///////
	//代码开始***判定孔位代码
//获取装备强化类型
switch($kong){
      case "xq1":
    $zhuangbei_leixing= "1号孔";
    $zhuangbei_gold= "1000";

    break;  
  case "xq2":
    $zhuangbei_leixing= "2号孔";
   $zhuangbei_gold= "2000";

    break;
      case "xq3":
    $zhuangbei_leixing= "3号孔";
   $zhuangbei_gold= "3000";

    break;
      case "xq4":
    $zhuangbei_leixing= "4号孔";
   $zhuangbei_gold= "4000";

    break;
      case "xq5":
    $zhuangbei_leixing= "5号孔";
   $zhuangbei_gold= "5000";

    break;
      case "xq6":
    $zhuangbei_leixing= "6号孔";
   $zhuangbei_gold= "6000";
    break;
  default:
  $zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$id."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
//获取宝石镶嵌
if($zhuangbei[xq1]=="0"){
$xq1="<a href='/jineng/dakong.php?id=".$id."&shuxing=xq1
'>未打孔</a>";
}elseif($zhuangbei[xq1]=="1"){
$xq1="<a href='/jineng/xiangqian_index.php?zhuangbei=".$id."&kong=xq1&jibie=1
'>可镶嵌</a>";
}else{
$xq1=$xiangqian->xianshi($zhuangbei[xq1]);
 $xxxss=explode("|",$xq1); 
$xq1=$xxxss[1]."级".$xxxss[2]."+".$xxxss[0].$xxxss[3]."<a href='zhaichu?zhuangbei=".$id."&kong=xq1&jibie=1
'>摘除</a>";
}

if($zhuangbei[xq2]=="0"){
$xq2="<a href='/jineng/dakong.php?id=".$id."&shuxing=xq2
'>未打孔</a>";
}elseif($zhuangbei[xq2]=="1"){
$xq2="<a href='/jineng/xiangqian_index.php?zhuangbei=".$id."&kong=xq2&jibie=1
'>可镶嵌</a>";
}else{
$xq2=$xiangqian->xianshi($zhuangbei[xq2]);
 $xxxss=explode("|",$xq2); 
$xq2=$xxxss[1]."级".$xxxss[2]."+".$xxxss[0].$xxxss[3]."<a href='zhaichu?zhuangbei=".$id."&kong=xq2&jibie=1
'>摘除</a>";
}

if($zhuangbei[xq3]=="0"){
$xq3="<a href='/jineng/dakong.php?id=".$id."&shuxing=xq3
'>未打孔</a>";
}elseif($zhuangbei[xq3]=="1"){
$xq3="<a href='/jineng/xiangqian_index.php?zhuangbei=".$id."&kong=xq3&jibie=1
'>可镶嵌</a>";
}else{
$xq3=$xiangqian->xianshi($zhuangbei[xq3]);
 $xxxss=explode("|",$xq3); 
$xq3=$xxxss[1]."级".$xxxss[2]."+".$xxxss[0].$xxxss[3]."<a href='zhaichu?zhuangbei=".$id."&kong=xq3&jibie=1
'>摘除</a>";
}

if($zhuangbei[xq4]=="0"){
$xq4="<a href='/jineng/dakong.php?id=".$id."&shuxing=xq4
'>未打孔</a>";
}elseif($zhuangbei[xq4]=="1"){
$xq4="<a href='/jineng/xiangqian_index.php?zhuangbei=".$id."&kong=xq4&jibie=1
'>可镶嵌</a>";
}else{
$xq4=$xiangqian->xianshi($zhuangbei[xq4]);
 $xxxss=explode("|",$xq4); 
$xq4=$xxxss[1]."级".$xxxss[2]."+".$xxxss[0].$xxxss[3]."<a href='zhaichu?zhuangbei=".$id."&kong=xq4&jibie=1
'>摘除</a>";}

if($zhuangbei[xq5]=="0"){
$xq5="<a href='/jineng/dakong.php?id=".$id."&shuxing=xq5
'>未打孔</a>";
}elseif($zhuangbei[xq5]=="1"){
$xq5="<a href='/jineng/xiangqian_index.php?zhuangbei=".$id."&kong=xq5&jibie=1
'>可镶嵌</a>";
}else{
$xq5=$xiangqian->xianshi($zhuangbei[xq5]);
 $xxxss=explode("|",$xq5); 
$xq5=$xxxss[1]."级".$xxxss[2]."+".$xxxss[0].$xxxss[3]."<a href='zhaichu?zhuangbei=".$id."&kong=xq5&jibie=1
'>摘除</a>";}

if($zhuangbei[xq6]=="0"){
$xq6="<a href='/jineng/dakong.php?id=".$id."&shuxing=xq6
'>未打孔</a>";
}elseif($zhuangbei[xq6]=="1"){
$xq6="<a href='/jineng/xiangqian_index.php?zhuangbei=".$id."&kong=xq6&jibie=1
'>可镶嵌</a>";
}else{
$xq6=$xiangqian->xianshi($zhuangbei[xq6]);
 $xxxss=explode("|",$xq6); 
$xq6=$xxxss[1]."级".$xxxss[2]."+".$xxxss[0].$xxxss[3]."<a href='zhaichu?zhuangbei=".$id."&kong=xq6&jibie=1
'>摘除</a>";
}




$html=<<<HTML
<img src='/img/kz.gif' />请选择要镶嵌<br/>
1孔位：$xq1<br/>
2孔位：$xq2<br/>
3孔位：$xq3<br/>
4孔位：$xq4<br/>
5孔位：$xq5<br/>
6孔位：$xq6<br/>

HTML;
echo $html;

echo "<a href='./xiangqian_index.php?'>重新选择装备</a><br/>";
echo footer();

exit();
    break;
}

if($zhuangbeiif[$kong]=='0'){
	echo"该孔位未打孔，请<a href='./xiangqian_index.php?jibie=1&zhuangbei=".$id."
'>重新选择孔位</a><br/>".footer();;

exit( );	
}elseif($zhuangbeiif[$kong]!='1'){
	echo"该孔位已经镶嵌宝石，请<a href='./xiangqian_index.php?jibie=1&zhuangbei=".$id."
'>重新选择孔位</a><br/>".footer();;

exit( );	
}else{
	///////////////////////
	//判定是否拥有宝石
if(!preg_match('/^[0-9]+$/u',$baoshi)) {
echo "选择宝石等级:<a href='xiangqian_index.php?jibie=1&zhuangbei=".$id."&kong=".$kong."'>1级</a>|<a href='xiangqian_index.php?jibie=2&zhuangbei=".$id."&kong=".$kong."'>2级</a>|<a href='xiangqian_index.php?jibie=3&zhuangbei=".$id."&kong=".$kong."'>3级</a>|<a href='xiangqian_index.php?jibie=4&zhuangbei=".$id."&kong=".$kong."'>4级</a>|<a href='xiangqian_index.php?jibie=5&zhuangbei=".$id."&kong=".$kong."'>5级</a>|<a href='xiangqian_index.php?jibie=6&zhuangbei=".$id."&kong=".$kong."'>6级</a>|<a href='xiangqian_index.php?jibie=7&zhuangbei=".$id."&kong=".$kong."'>7级</a>|<a href='xiangqian_index.php?jibie=8&zhuangbei=".$id."&kong=".$kong."'>8级</a>|<a href='xiangqian_index.php?jibie=9&zhuangbei=".$id."&kong=".$kong."'>9级</a>|<a href='xiangqian_index.php?jibie=10&zhuangbei=".$id."&kong=".$kong."'>10级</a>
<br/>";
echo"装备名：$zhuangbeiif[name]<br/>【选择宝石】<br/>----------<br/>";
///index面板
if(preg_match('/^[0-9]+$/u',$jibie)){
$exec="select * from xiangqian WHERE dengji='".$jibie."' order by dengji ASC limit 10"; 
$result=mysqli_query($db,$exec); 

while($row=mysqli_fetch_array($result)){ 

	$resultl = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$row[ids]."' and userid='".$userid."'");
$wp= mysqli_fetch_array($resultl);

if(!$wp){
	echo $row[text]."(未拥有)<br/>";
	
}else{
echo  "<a href='xiangqian_index.php?jibie=6&zhuangbei=".$id."&kong=".$kong."&baoshi=$wp[id]'>$row[text]</a><br/>";
		
	}
}
}else{
	
}
	echo "----------<br/><a href='./xiangqian_index.php?jibie=1&zhuangbei=".$id."
'>重新选择孔位</a><br/>";
}else{
	$resultl = mysqli_query($db,"SELECT * FROM beibao WHERE id='".$baoshi."' and userid='".$userid."'");
$baoshiif= mysqli_fetch_array($resultl);
if (!$baoshiif){
echo"未拥有该宝石，请<a href='./xiangqian_index.php?zhuangbei=$id&kong=$kong&jibie=1
'>重新选择宝石</a><br/>".footer();

exit( );
}else{
	//////////////////
	//*判定物品是否是宝石*数据库不存在就不能被镶嵌。
	$resultl = mysqli_query($db,"SELECT * FROM xiangqian WHERE ids='".$baoshiif[wupin_id]."'");
$xiangqianif= mysqli_fetch_array($resultl);
if(!$xiangqianif){
	echo"异常定义，请<a href='./xiangqian_index.php?zhuangbei=$id&kong=$kong&jibie=1
'>重新选择宝石</a><br/>".footer();

exit( );
}else{
	//同类宝石只能镶嵌1个
		for($j=1;$j<7;$j++){
			if($zhuangbeiif[xq.$j]!='1'and $zhuangbeiif[xq.$j]!='0'){
			
	$wupinid = explode(",", $zhuangbeiif[xq.$j]);
	$wupinids = explode(",", $xiangqianif[xiangqian]);
if($wupinid[0]==$wupinids[0]){
	$xqsshop='shop';
}
			}
}
if($xqsshop){
	echo"同同类型宝石只允许镶嵌一个！<br/>";
	echo "<a href='./xiangqian_index.php?jibie=1&zhuangbei=".$id."&kong=".$kong."
'>重新选择宝石</a><br/>";
}else{
	//执行镶嵌
	///////////////
	echo"装备名：$zhuangbeiif[name]<br/>你正在镶嵌$baoshiif[name]<br/>";
echo"<a href='xiangqian.php?jibie=6&zhuangbei=".$id."&kong=".$kong."&baoshi=$baoshi'>确定镶嵌</a><br/>";
	//////////////////////////////
	echo "<a href='./xiangqian_index.php?jibie=1&zhuangbei=".$id."&kong=".$kong."
'>重新选择宝石</a><br/>";
}

	
	

	
}
	
	/////////////////////////
	
	
}
}
	////////////////////////////
}

	/////////
	
	
	
	
	
}
}












/*
镶嵌功能解说

*/

echo "<a href='/map.games?id=$user[map]'>只是路过</a> <br/>";
echo footer();
?>
