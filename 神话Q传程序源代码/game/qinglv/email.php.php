<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$cid=$_POST['jid'];
$my=$_GET['my'];
//获取是否有未读消息
$resultl = mysqli_query($db,"SELECT * FROM email WHERE zhuangtai='0' and userid='".$userid."'");
$email= mysqli_fetch_array($resultl);
if ($email){
$email_tip="<img src='/img/message.gif'  alt='新消息' />";
}


if($my){
$resep = mysqli_query($db,"SELECT * FROM qinglv_yaoqing WHERE id='".$my."'");
$qinglv_yaoqing = mysqli_fetch_array($resep);
if($qinglv_yaoqing[npcid]!=$userid){
echo"只能本人操作<br/>";
}else{
$qinglv1=mysqli_fetch_array(mysqli_query($db,"select * from qinglv where nan IN('".$qinglv_yaoqing[npcid]."') or nv IN('".$qinglv_yaoqing[npcid]."')"));
$qinglv2=mysqli_fetch_array(mysqli_query($db,"select * from qinglv where nan IN('".$qinglv_yaoqing[userid]."') or nv IN('".$qinglv_yaoqing[userid]."')"));
      if($qinglv1 || $qinglv2){
        echo"必须双方是单身才能成为情侣哦～<br/>";
    }else{
    if($user[sex]=="0"){
    $s="insert into qinglv(nan,nv,enai) values('".$qinglv_yaoqing[userid]."','".$userid."','1')";
$ok=mysqli_query($db,$s);
    }else{
      $s="insert into qinglv(nv,nan,enai) values('".$qinglv_yaoqing[userid]."','".$userid."','1')";
$ok=mysqli_query($db,$s);
    }
    if($ok){
      echo"成功<br/>";
      //执行删除
      $sql3 = "delete from qinglv_zhenghun where userid ='".$qinglv_yaoqing[userid]."'";
$ok=mysqli_query($db,$sql3);
 $sql3 = "delete from qinglv_zhenghun where userid ='".$qinglv_yaoqing[npcid]."'";
$ok=mysqli_query($db,$sql3);
 $sql3 = "delete from qinglv_yaoqing where npcid ='".$qinglv_yaoqing[userid]."'";
$ok=mysqli_query($db,$sql3);
 $sql3 = "delete from qinglv_yaoqing where npcid ='".$qinglv_yaoqing[npcid]."'";
$ok=mysqli_query($db,$sql3);
 $sql3 = "delete from qinglv_yaoqing where userid ='".$qinglv_yaoqing[userid]."'";
$ok=mysqli_query($db,$sql3);
 $sql3 = "delete from qinglv_yaoqing where userid ='".$qinglv_yaoqing[npcid]."'";
$ok=mysqli_query($db,$sql3);
    }else{
    echo"失败<br/>";
    }
    
    }
}
}



//聊天信息分页显示

$perNumber=10; 
$page=$_GET['page']; 
$url="email.php?my=1&amp;";

$total=mysqli_num_rows(mysqli_query($db,"SELECT * FROM qinglv_yaoqing WHERE npcid='".$userid."'")); 
echo $total[0];
$totalNumber=$total; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="SELECT * FROM qinglv_yaoqing WHERE npcid='".$userid."' order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "暂时还没有对你示爱的异性哦～!<br/>";
}else{


while($arr=mysqli_fetch_array($result)){ 
$resep = mysqli_query($db,"SELECT * FROM users WHERE id='".$arr['userid']."'");
$myp = mysqli_fetch_array($resep);
echo "<a href='/user.php?id=$arr[userid]'>$myp[username]</a>对你有好感！<a href='email.php?my=$arr[id]'>同意，结为情侣</a><br/>";
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
echo "暂无系统消息!<br/>";
}
}



echo "<a href='index.php'>征友榜</a> <br/>";

echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
?>