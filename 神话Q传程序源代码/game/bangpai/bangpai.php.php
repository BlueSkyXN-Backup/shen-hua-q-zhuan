<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$userid=$_SESSION['users'];

$npcid=$_GET['id'];
$shenqing=$_GET['shenqing'];

$resultl = mysqli_query($db,"SELECT * FROM bangpai WHERE id='".$npcid."'");
$my = mysqli_fetch_array($resultl);


if ($my){
}else{
echo"该帮派不存在！";
echo "<a href='/map.games?id=$npc[map]'>返回地图</a> <br/><br/>";
exit();//结束
}
//发送加入帮派请求
if($shenqing=="yes"){
	//chuli jiaru qingqiou判断是否已经有帮派
	if($user[bangpai_id]==NULL || $user[bangpai_id]=="0"){
		//这里判断是否已经发送了加入请求
		$resultl = mysqli_query($db,"SELECT * FROM bangpai_yaoqing WHERE userid='".$userid."' and bangpai_id='".$npcid."'");
$ifbangpai = mysqli_fetch_array($resultl);
if(!$ifbangpai){
		//处理加入请求
		    $s="insert into bangpai_yaoqing(userid,bangpai_id,time,zhuangtai) values('".$userid."','".$npcid."','".time()."','0')";
$ok=mysqli_query($db,$s);
if($ok){
    echo "申请成功<br/>";
}else{
    echo "申请失败<br/>";
}

}else{
		echo"你已经申请过了，无需重复申请。请等待帮派管理员申请！";
}

	}else{
		echo"你已经有帮派了，无法在加入帮派！";
	}
	}
	



  $bangpainame1 = mysqli_query($db,"SELECT * FROM bangpai WHERE id='".$npcid."'");
$bangpainame = mysqli_fetch_array($bangpainame1);
    echo "<a href='/bangpai/bangpai.php?id=$bangpainame[id]'> $bangpainame[name]</a>帮主: ".user_name($bangpainame[bangzhu])."<br/>帮派等级：$bangpainame[dengji]<br/>帮派建设度：$bangpainame[jianshe]<br/>帮派资金：$bangpainame[zijin]<br/>人数：$bangpainame[shuliang] /50<br/>$bangpainame[text]<br/>
    <a href='bangpai.php?id=$npcid&shenqing=yes'>申请加入该帮派</a><br/>";
echo "<br/><a href='index.php?id=$user[map]'>帮派列表</a> <br/>";

echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/><br/>";



echo footer();?>