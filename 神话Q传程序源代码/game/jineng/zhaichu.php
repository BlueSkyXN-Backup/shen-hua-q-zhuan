<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$id=$_GET['zhuangbei'];//装备id
$kong=$_GET['kong'];//镶嵌孔位
$ko=$_GET['ko'];//镶嵌孔位
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
}elseif($zhuangbeiif[$kong]=='1'){
    
    
    //执行摘除
	echo"该孔位没有镶嵌宝石，请<a href='./xiangqian_index.php?jibie=1&zhuangbei=".$id."
'>重新选择孔位</a><br/><a href='/map.games?id=$user[map]'>返回地图</a>";


exit( );		
}else{
    
    //*判定物品是否是宝石*数据库不存在就不能被镶嵌。
	$resultl = mysqli_query($db,"SELECT * FROM xiangqian WHERE xiangqian='".$zhuangbeiif[$kong]."'");
$xiangqianif= mysqli_fetch_array($resultl);
if(!$xiangqianif){
    	echo"异常定义，非常严重的BUG，请联系客服修复。<br/>".footer();

exit( );
}else{
    if($ko=="ko"){
        	$ajss="wp,415";
        	$ajgg="wp,".$xiangqianif[ids];
        if($xyz->kou_beibao($ajss,"1",$userid)=="ok"){
            	$sql4="update zhuangbei set $kong='1' where id='".$zhuangbeiif[id]."' and userid='".$userid."'";
$ok=mysqli_query($db,$sql4);
	if($ok){
		echo'摘除成功<br/>';
	}else{
		echo"摘除失败<br/>";
	}
$huode_html="幸运获得:". $xyz->beibao($ajgg,'1,1','10000','2',$userid,' ',' ');
echo $huode_html;
}else{
echo"你需要宝石摘除符！<br/>";
    
}
    }else{
    $resultl1 = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$xiangqianif[ids]."'");
$baoshi_name= mysqli_fetch_array($resultl1);
    
    echo"装备名：$zhuangbeiif[name]<br/>你正在摘除$baoshi_name[name]<br/>将消耗一枚 宝石摘除符！<br/>";
echo"<a href='zhaichu?jibie=yufytghlmiugftdfukl6&zhuangbei=".$id."&kong=".$kong."&ko=ko'>确定摘除</a><br/>";
}
  
  
    
}

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