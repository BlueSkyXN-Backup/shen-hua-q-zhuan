<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$userid=$_SESSION['users'];
$id=$_GET['id'];
$wap=$_GET['wap'];
$page=$_GET['page']; 
$chat=$_GET['chat'];
$tiren=$_GET['tiren'];
/********************************************
 wap框架头部变量
 *******************************************/
echo $wapwork->title(我的队伍);

echo "<a href='index.php'>队伍</a>|<a href='index.php?chat=$user[map]'>聊天</a> <br/><br/>";
if(!$chat){
  //队长踢人
  if($tiren){
      $resultl = mysqli_query($db,"SELECT * FROM users WHERE id='".$tiren."'");
$tiren= mysqli_fetch_array($resultl);
    if($tiren){
    $resultl = mysqli_query($db,"SELECT * FROM duiwu WHERE id='".$user[duiwu_id]."'");
$duiwu= mysqli_fetch_array($resultl);
    if($duiwu[duizhang]==$userid||$duiwu[fuduizhang]==$userid){
        if($duiwu[duizhang]!=$tiren[id]){
    if($user[duiwu_id]==$tiren[duiwu_id]){
 $sql2="update users set duiwu_id=NULL where id='".$tiren[id]."'";
$ok=mysqli_query($db,$sql2);
      if($ok){
            echo"踢出成功！";
      }else{
          echo"踢出失败！";
      } 
  }else{
    echo"对方不在你的队伍中！";
    }
         }else{
          echo"队长无法被踢出。<br/>";
  
  }
    }else{
          echo"你不是队长，无法踢人。<br/>";
  
  }
  }else{
       echo"不存在用户<br/>";
    }
  }
  
  
  
  
  
  
  
  
//用户id是否存在
if($id){
  if($user[duiwu_id]!=NULL){
    $resultl = mysqli_query($db,"SELECT * FROM duiwu WHERE id='".$user[duiwu_id]."'");
$duiwu= mysqli_fetch_array($resultl);
    if($duiwu[duizhang]==$userid||$duiwu[fuduizhang]==$userid){
       $resultl = mysqli_query($db,"SELECT * FROM users WHERE duiwu_id='".$user[duiwu_id]."'");
$duiwushu= mysqli_num_rows($resultl);
      if($duiwushu<"6"){
  //用户手抖存在队伍存在执行邀请队伍
$npc = mysqli_query($db,"SELECT * FROM users WHERE id='".$id."'");
$npc = mysqli_fetch_array($npc);

if($npc){
  //用户手抖存在队伍存在执行邀请队伍

  if($npc[duiwu_id]==NULL){
  	$map2 = mysqli_query($db,"SELECT * FROM fuben WHERE duiwuid='".$user[duiwu_id]."'");
$map2 = mysqli_fetch_array($map2);
$map3 = mysqli_query($db,"SELECT * FROM maoxian WHERE duiwuid='".$user[duiwu_id]."'");
$map3 = mysqli_fetch_array($map3);
if(!$map2 and !$map3){
    $s="insert into duiwu_yaoqing(userid,npcid,duiwuid,time,zhuangtai) values('".$npc[id]."','".$userid."','".$user[duiwu_id]."','".time()."','0')";
$ok=mysqli_query($db,$s);
if($ok){
    echo "邀请成功<br/>";
}else{
    echo "邀请失败<br/>";
}
}else{
	 echo "副本冒险中不能邀请。<br/>";
}
  
}else{
    echo "对方已经有队伍了<br/>";
  } 
}else{
echo"没有数据<br/>";
}
      }else{
        echo"你的队伍已有5人，无法继续邀请。<br/>";
      }
    }else{
          echo"你不是队长，无法邀请。<br/>";
    }
  }else{
    echo"你没有队伍，无法邀请。<br/>";
  }
}else{
  //不是邀请，创建队伍
if($user[duiwu_id]==NULL){
$s="insert into duiwu(duizhang,shuliang,fuduizhang) values('".$userid."','1','0')";
$ok=mysqli_query($db,$s);
$user[duiwu_id]=mysqli_insert_id($db);
$sql1="update users set  duiwu_id='".$user[duiwu_id]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql1);
}
}


$resultl = mysqli_query($db,"SELECT * FROM duiwu WHERE id='".$user[duiwu_id]."'");
$duiwu= mysqli_fetch_array($resultl);

$exec="select * from users WHERE duiwu_id='".$user[duiwu_id]."'"; 
$result=mysqli_query($db,$exec); 
while($duiwu_user=mysqli_fetch_array($result)){ 
  
echo "<br/><a href='/user.php?id=$duiwu_user[id]'>$duiwu_user[username]</a> |";
if($duiwu[duizhang]==$duiwu_user[id]){
echo "队长";
}else{
echo "队员";
  if($duiwu[duizhang]==$userid||$duiwu[fuduizhang]==$userid){
      echo "<a href='index.php?tiren=$duiwu_user[id]'>踢出</a>";
  }
}  
}
}else{
  $my=$_GET['my'];  
if ($my=="ok"){

$text=$_POST['txt'];  
if($text==""){
echo "请勿发表空白信息<br/>";
}else{
$text=strip_tags($text);
 $s0="insert into duiwu_email(text,userid,leixing,duiwuid) values('".$text."','".$userid."','1','".$user[duiwu_id]."')";
$ok=mysqli_query($db,$s0);
if ($ok){
echo "信息发送成功！<br/>";
}else{
echo "信息发送失败！<br/>";
}
}
}
echo <<<end
<form action="index.php?chat=ok&my=ok" method="post" style='margin:0px'>
输入发送内容：<a href='index.php?chat=o'>刷新</a><br/><textarea name="txt" maxlength="500"></textarea><br/> 
<input type="submit" value="发送信息" class="link"/></form>
end;


//聊天信息分页显示
$perNumber=16; 
$page=$_GET['page']; 
$url="index.php?chat=o&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from duiwu_email WHERE duiwuid='".$user[duiwu_id]."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from duiwu_email WHERE duiwuid='".$user[duiwu_id]."' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "暂无发言!<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$resep = mysqli_query($db,"SELECT * FROM users WHERE id='".$row['userid']."'");
$myp = mysqli_fetch_array($resep);
echo "[公共]<a href='/user.php?id=$row[userid]'>$myp[username]</a>：".$row['text']."<br/>";
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
echo "暂无发言!<br/>";
}
}
}
echo "<br/><a href='lgout.php'>退出队伍</a> <br/><a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";




?>