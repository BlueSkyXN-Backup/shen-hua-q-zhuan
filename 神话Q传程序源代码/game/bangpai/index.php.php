<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$userid=$_SESSION['users'];

$npcid=$_GET['id'];

 $bangpai_user = mysqli_query($db,"SELECT * FROM bangpai_user WHERE userid='".$userid."'");
$bangpai_user = mysqli_fetch_array($bangpai_user);


if(!$bangpai_user){
    echo "你还没有加入帮派！<br/>";
 echo "<br/>
    <a href='chuangjian'>创建帮派</a>|<a href='list'>搜索帮派</a><br/>帮派任务|<a href='#'>帮派聊天</a><br/>帮派贡献|帮贡兑换<br/>帮派签到|帮派设置<br/>";
}else{

 $bangpainame1 = mysqli_query($db,"SELECT * FROM bangpai WHERE id='".$bangpai_user[bangpaiid]."'");
$bangpainame = mysqli_fetch_array($bangpainame1);
//获取帮主
$bangpai_zhu = mysqli_query($db,"SELECT * FROM users WHERE id='".$bangpainame[bangzhu]."'");
$bangpainame_zhu = mysqli_fetch_array($bangpai_zhu);

		echo"帮派名称：$bangpainame[name]<br/>帮主: ".user_name($bangpainame_zhu[id])."<br/>帮派等级：$bangpainame[dengji]<br/>帮派建设度：$bangpainame[jianshe]<br/>帮派资金：$bangpainame[zijin]<br/>帮派人数：$bangpainame[shuliang]<br/>";
		  $bangpainame = mysqli_query($db,"SELECT * FROM bangpai WHERE id='".$npcid."'");
$bangpainame = mysqli_fetch_array($bangpainame);
    echo "<a href='/bangpai/bangpai.php?id=$bangpainame[id]'> $bangpainame[name]</a><br/>$bangpainame[text]<br/>
    <a href='chengyuan.php?id=$user[map]'>帮派成员</a>|<a href='guanli.php'>成员审核</a><br/>帮派任务|<a href='/bangpai/chengyuan.php?chat=43'>帮派聊天</a><br/>帮派贡献|帮贡兑换<br/><a href='/Sign/Sign.php?my=sign_bangpai'>帮派签到</a>|帮派设置<br/>";
echo "<br/><a href='index.php?id=$user[map]'>帮派列表</a> <br/>";
}












echo "<a href='/map.gamesp?id=$user[map]'>返回地图</a> <br/><br/>";



echo footer();?>