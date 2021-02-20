<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$userid=$_SESSION['users'];
$wap=$_GET['wap'];

	//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
//统计数量
$tongji_shu=mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='312' and userid='".$userid."'");
$tongji_shu=mysqli_fetch_array($tongji_shu);
if(!$tongji_shu[shuliang]){
$tongji_shu[shuliang]="0";
}

//强化提交
if($wap=="yes"){
 
if($tongji_shu[shuliang]<"1"){
echo"你没有洗点符！<br/>";

}else{
    
$tongji_shu[shuliang]-="1";
if($tongji_shu[shuliang]<"1"){
$sql3 = "delete from beibao where userid='".$userid."' and wupin_id='312'";
$ok1=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$tongji_shu[shuliang]."' where userid='".$userid."' and wupin_id='312'";
$ok1=mysqli_query($db,$sql2);
}
$user[shuxing]+=$user[shuxing1];
$user[shuxing]+=$user[shuxing2];
$user[shuxing]+=$user[shuxing3];
$user[shuxing]+=$user[shuxing4];
$user[shuxing]+=$user[shuxing5];
$user[shuxing]+=$user[shuxing6];
//最后将属性写入数据库
$sql2="update users set shuxing='".$user[shuxing]."', shuxing1='0',shuxing2='0',shuxing3='0',shuxing4='0',shuxing5='0',shuxing6='0' where id='".$userid."'";
$ok2=mysqli_query($db,$sql2);
if($ok1 && $ok2){
echo"洗点成功！<br/>";
mysqli_query($db,"COMMIT");//提交
}else{
echo"洗点失败！<br/>";
mysqli_query($db,"ROLLBACK");
}


    
    
}
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");

echo"洗点将已分配属性归还到可分配属性，将消耗【人物洗点符】*1!你确定洗点吗？<br/>";

echo '<form action="/user_xd?wap=yes" method="post">  
<input type="submit" class="link" value="确定洗点" />
</form>';

echo "<br/> <a href='/user/my'>我的状态</a> ";



?>