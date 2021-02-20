<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
$cid=$_SESSION['name'];
if(!isset($_SESSION['name'])){//判断是否存在$_SESSION[name]
header("location:../reg.do");//跳转地址
exit();//结束
}
$my=$_GET['my'];
$zone = mysqli_query($db2,"SELECT * FROM pk_user WHERE id='".$cid."'");
$zone = mysqli_fetch_array($zone);

if(!$my){
echo"<img src='/Logo.jpg'  alt='魔神传说' /><br/>【角色选择】<br/>";
$result = mysqli_query($db,"SELECT * FROM users WHERE  userid='".$cid."'");
while($user= mysqli_fetch_array($result)){
echo "$user[username]<br/>";
echo "等级：$user[dengji] ";
echo " 种族:";
if ($user['zhongzu']=="1"){
echo "妖";
}
if ($user['zhongzu']=="2"){
echo "人";
}
if ($user['zhongzu']=="3"){
echo "鬼";
}
if ($user['zhongzu']=="4"){
echo "佛";
}
if ($user['zhongzu']=="5"){
echo "仙";
} 


 echo "<br/><a href='/main.do?my=$user[id]'>进入游戏</a><br/>";


}

  $users= mysqli_query($db,"SELECT * FROM users WHERE userid='".$cid."'");
$users= mysqli_num_rows($users);
if ($users<"3"){
echo '<a href="news.juese">创建新角色</a><br/>';
}

echo '<b>【客服专区】</b><br/>神话QQ：321003480<br/><img src="/img/guanfang.jpg"/>';
//获取当前地图NPC
$result = mysqli_query($db,"select * from gonggao where zhuangtai='1' order by rand() limit 6");
while($row = mysqli_fetch_array($result))
  {
 echo "<br/><a href='/news/gonggao.news?id=".$row['id']."'><img src='/img/laba.gif'/>".$row['name']."</a>";
  }
  echo '<br/><a href="http://game.wap.xyz/main">返回服务区选择</a>';
}else{
//进入游戏

$user = mysqli_query($db,"SELECT * FROM users WHERE userid='".$cid."' and id='".$my."'");
$user = mysqli_fetch_array($user);
if($user){
   $sql2="update users set sid='00000' where userid='".$cid."'";
$ok1=mysqli_query($db,$sql2);
if($_SESSION['users']!=$user[id]){
//$s="insert into news(text,time,userid) values('进入游戏了，怎么？不去打个招呼吗？','".$pass."','".$user[id]."')";
//$ok=mysqli_query($db,$s);
$_SESSION['users']=$user[id];
$_SESSION['time']=time();
$acc=md5(time());
$_SESSION['sid']=$acc;
$sql2="update users set sid='".$acc."',ip='".getip()."' where id='".$user[id]."'";
$ok1=mysqli_query($db,$sql2);
header("location:../map.games");//跳转地址
}else{
$_SESSION['users']=$user[id];
header("location:../map.games");//跳转地址
$acc=md5(time());
$_SESSION['sid']=$acc;
$sql2="update users set sid='".$acc."' where id='".$user[id]."'";
$ok1=mysqli_query($db,$sql2);
}
}else{
echo "角色不存在";
}
}

