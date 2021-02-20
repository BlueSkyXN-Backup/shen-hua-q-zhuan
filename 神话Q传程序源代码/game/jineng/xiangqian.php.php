<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$id=$_GET['zhuangbei'];//装备id
$kong=$_GET['kong'];//镶嵌孔位
$baoshi=$_GET['baoshi'];//镶嵌的宝石ID

//判断装备id只能为数字
if(!preg_match('/^[0-9]+$/u',$id)) {
	echo"你未拥有该装备，<a href='./xiangqian_index.php
'>重新选择装备</a><br/><a href='/map.games?id=$user[map]'>返回地图</a>";


exit( );
}else{
	$resultl = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$id."' and userid='".$userid."'");
$zhuangbeiif= mysqli_fetch_array($resultl);
if (!$zhuangbeiif){
	echo"你未拥有该装备，<a href='./xiangqian_index.php
'>重新选择装备</a><br/><a href='/map.games?id=$user[map]'>返回地图</a>";


exit( );
}else{
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
    echo "错误孔位，强行终止程序！";
exit();
    break;
}

if($zhuangbeiif[$kong]=='0'){
	echo"该孔位未打孔，请<a href='./xiangqian_index.php?jibie=1&zhuangbei=".$id."
'>重新选择孔位</a><br/><a href='/map.games?id=$user[map]'>返回地图</a>";


exit( );	
}elseif($zhuangbeiif[$kong]!='1'){
	echo"该孔位已经镶嵌宝石，请<a href='./xiangqian_index.php?jibie=1&zhuangbei=".$id."
'>重新选择孔位</a><br/><a href='/map.games?id=$user[map]'>返回地图</a>";


exit( );		
}else{
	///////////////////////
	//判定是否拥有宝石
if(!preg_match('/^[0-9]+$/u',$baoshi)) {
	echo"未选择宝石，<a href='./xiangqian_index.php?zhuangbei=$id&kong=$kong&jibie=1
'>点击选择宝石</a><br/>";

}else{
	$resultl = mysqli_query($db,"SELECT * FROM beibao WHERE id='".$baoshi."' and userid='".$userid."'");
$baoshiif= mysqli_fetch_array($resultl);
if (!$baoshiif){
	echo"未拥有该宝石，请<a href='./xiangqian_index.php?zhuangbei=$id&kong=$kong&jibie=1
'>重新选择宝石</a><br/><a href='/map.games?id=$user[map]'>返回地图</a>";


exit( );

}else{
	//////////////////
	//*判定物品是否是宝石*数据库不存在就不能被镶嵌。
	$resultl = mysqli_query($db,"SELECT * FROM xiangqian WHERE ids='".$baoshiif[wupin_id]."'");
$xiangqianif= mysqli_fetch_array($resultl);
if(!$xiangqianif){
	echo"异常定义，请<a href='./xiangqian_index.php?zhuangbei=$id&kong=$kong&jibie=1
'>重新选择宝石</a><br/><a href='/map.games?id=$user[map]'>返回地图</a>";

exit( );
}else{
	//同类宝石只能镶嵌1个
		for($j=1;$j<7;$j++){
			if($zhuangbeiif[xq.$j]!='1' and $zhuangbeiif[xq.$j]!='0'){
	$wupinid = explode(",", $zhuangbeiif[xq.$j]);
	$wupinids = explode(",", $xiangqianif[xiangqian]);
if($wupinid[0]==$wupinids[0]){
	$xqsshop='shop';
}
			}
}
if($xqsshop){
	echo"同同类型宝石只允许镶嵌一个！";
		echo "<a href='./xiangqian_index.php?jibie=1&zhuangbei=".$id."
'>继续镶嵌其他孔位</a><br/>";
}else{
	//执行镶嵌
	///////////////
		
	//开始镶嵌
	//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
//扣除宝石
		$resultl = mysqli_query($db,"SELECT * FROM beibao WHERE id='".$baoshi."' and userid='".$userid."'");
$baoshiids= mysqli_fetch_array($resultl);
$baoshiids[shuliang]-="1";
if($baoshiids[shuliang]<"1"){

$sql3 = "delete from beibao where id ='".$baoshiids[id]."'";
$ok1=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$baoshiids[shuliang]."' where id='".$baoshiids[id]."'";
$ok1=mysqli_query($db,$sql2);
}

	//修改孔位
	echo $xiangqianif[xiangqian];
	$sql4="update zhuangbei set $kong='".$xiangqianif[xiangqian]."' where id='".$zhuangbeiif[id]."' and userid='".$userid."'";
$ok=mysqli_query($db,$sql4);
echo $kong;
	if($ok && $ok1){
		echo'镶嵌成功<br/>';
	}else{
		echo"镶嵌失败<br/>";
	}
	echo "<a href='./xiangqian_index.php?jibie=1&zhuangbei=".$id."
'>继续镶嵌其他孔位</a><br/>";
	
	
	
	mysqli_query($db,"COMMIT");//数据提交
//数据回滚mysqli_query($db,"ROLLBACK");
mysqli_query($db,"END"); //事务处理完时别忘记
mysqli_query($db,"SET AUTOCOMMIT=1");//自动提交
	


	//////////////////////////////
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
echo"<br/><a href='/map.games?id=$user[map]'>返回地图</a>";

?>