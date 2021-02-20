<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$userid=$_SESSION['users'];
$id=$_GET['id'];
$wap=$_GET['wap'];

 $bangpai_user = mysqli_query($db,"SELECT * FROM bangpai_user WHERE userid='".$userid."'");
$bangpai_user = mysqli_fetch_array($bangpai_user);


$resultl = mysqli_query($db,"SELECT * FROM bangpai WHERE id='".$bangpai_user[bangpaiid]."'");
$my = mysqli_fetch_array($resultl);
if($my[bangzhu]==$userid || $my[fubangzhu]==$userid){

}else{
echo"你不是帮派管理员，你没有资格管理！";
echo "<a href='/map.games?id=$npc[map]'>返回地图</a> <br/><br/>";
exit();//结束
}

  
  
  
  
  
 if($id){
 	//获取邀请信息
 	$resultl = mysqli_query($db,"SELECT * FROM bangpai_yaoqing WHERE id='".$id."'");
$bangpai_yaoqing = mysqli_fetch_array($resultl);
if($bangpai_yaoqing){
 	//执行同意或者拒绝 
 	  $resultl = mysqli_query($db,"SELECT * FROM bangpai WHERE id='".$bangpai_user[bangpaiid]."'");
$bangpais= mysqli_fetch_array($resultl);
    if($bangpais[shuliang]>=$bangpais[shuliang_max]){
       echo"帮派人数已满！";
    }else{
//帮派有位置执行操作
//判断玩家是否已经加如了其他帮派。
	$npc = mysqli_query($db,"SELECT * FROM users WHERE id='".$bangpai_yaoqing[userid]."'");
$npc = mysqli_fetch_array($npc);
if($npc[bangpai_id]==NULL || $npc[bangpai_id]=="0"){


      	if($wap=="0"){
 		//同意加入
$s="insert into bangpai_user(userid,bangpaiid,time) values('".$bangpai_yaoqing[userid]."','".$bangpais[id]."','".time()."')";
$ko2=mysqli_query($db,$s);
  //告诉玩家处理状态
  $s="insert into email(text,userid,leibie,zhuangtai) values('【".$bangpais[name]."】的管理员同意你加入帮派，恭喜你成为帮派的一员！','".$bangpai_yaoqing[userid]."','1','0')";
$ok2=mysqli_query($db,$s);
$s0="insert into bangpai_email(text,userid,leixing,bangpaiid) values('加入了帮派，恭喜成为帮派的一员','".$bangpai_yaoqing[userid]."','1','".$bangpai_user[bangpaiid]."')";
$ok=mysqli_query($db,$s0);
 	}else{
 		//拒绝加入
 		
  //告诉玩家处理状态
  $s="insert into email(text,userid,leibie,zhuangtai) values('【".$bangpais[name]."】的管理员拒绝你加入帮派。','".$bangpai_yaoqing[userid]."','1','0')";
$ok2=mysqli_query($db,$s);
 	}
 		
 	
}else{
	  echo"该玩家已经加入了其他帮派，麻烦下次快一点。";
}
 	
        //清楚该用户的所有帮派申请
    $sql1="update bangpai_yaoqing set  zhuangtai='1' where userid='".$bangpai_yaoqing[userid]."'";
$ok=mysqli_query($db,$sql1);
        echo"操作成功";
    }
}else{
	echo"不存在申请";
}

 	
 }

//打印成员
//显示基本物品
$perNumber=8;
$page=$_GET['page'];     
$url="guanli.php?";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from bangpai_yaoqing WHERE zhuangtai='0' and bangpai_id='".$bangpai_user[bangpaiid]."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from bangpai_yaoqing WHERE zhuangtai='0' and bangpai_id='".$bangpai_user[bangpaiid]."' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "当前没有新的申请！<br/>";
}else{
	
while($row=mysqli_fetch_array($result)){ 
	$npc = mysqli_query($db,"SELECT * FROM users WHERE id='".$row[userid]."'");
$npc = mysqli_fetch_array($npc);
  echo "<br/>".user_name($npc[id])."申请加入帮派。<a href='guanli.php?wap=0&id=$row[id]'>同意</a>-<a href='guanli.php?wap=1&id=$row[id]'>拒接</a>";
  
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
echo "当前没有新的申请！<br/>";
}
}





echo "<br/><a href='index.php'>返回帮派</a> <br/><a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";





echo footer();?>