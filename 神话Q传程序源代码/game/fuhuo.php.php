<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
//
$my=$_GET['my'];
//调用自己的数据
$userid=$_SESSION['users'];



//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);
//统计复活娃娃
$tongji_shu=mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='30' and userid='".$userid."'");
$tongji_shu=mysqli_fetch_array($tongji_shu);
if(!$tongji_shu[shuliang]){
$tongji_shu[shuliang]="0";
}
//低于30级原地复活
if ($user[dengji]<"31"){
   $sql1="update users set qixue='".$user[qixuemax]."',zhuangtai='yes' where id='".$userid."'";
$ok1=mysqli_query($db,$sql1);
  $ok2=$ok1;
}else{
//判断是否使用道具复活
if ($my=="1"){
  //获取免费复活扣除经验

$num1=$user[dengji];
$i=$user[dengji];
//等级*等级
$num1*=$num1;
$num1*=$i;
$num1*=12;
if($user[zhuansheng]>"0"){
$jsp=$user[zhuansheng]+1;
$num1*=$jsp;
}
if($user[zuie2]>"0"){
    $zuie2_jingyan=$user[zuie2]*0.1;
    $zuie2_jingyan+="1";
    $num1*=$zuie2_jingyan;
    $num1*=$zuie2_jingyan;
}
  $num1*=0.3;
  $chengfa=$user[zuie2]/10;
$chengfa=ceil($chengfa);
$diaoji=$chengfa+1;
$diaoshuxing=$diaoji*5;
  if($user[jingyan]<$num1){
  //直接扣除等级
     $user[dengji]-="1";
     $user[shuxing]-="5";
    $sql1="update users set qixue='100',zhuangtai='yes',dengji='".$user[dengji]."',map='1',shuxing='".$user[shuxing]."' where id='".$userid."'";
$ok1=mysqli_query($db,$sql1);
  }else{
    //直接扣经验
    $user[jingyan]-=$num1;
    $sql1="update users set qixue='100',zhuangtai='yes',jingyan='".$user[jingyan]."',map='1' where id='".$userid."'";
$ok1=mysqli_query($db,$sql1);
  }
  $ok2=$ok1;
}else{
    if($user[zuie2]<"10"){
//道具娃娃复活
  if($tongji_shu[shuliang]>="1"){
    //扣除替身娃娃
    $tongji_shu[shuliang]-="1";
if($tongji_shu[shuliang]<"1"){
$sql3 = "delete from beibao where userid='".$userid."' and wupin_id='30'";
$ok1=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$tongji_shu[shuliang]."' where userid='".$userid."' and wupin_id='30'";
$ok1=mysqli_query($db,$sql2);
}
    //复活任务
  $sql1="update users set qixue='".$user[qixuemax]."',zhuangtai='yes' where id='".$userid."'";
$ok2=mysqli_query($db,$sql1);
  }else{
    echo "你需要道具娃娃。";
  }

}else{
     echo "你罪孽值大于10无法使用提升娃娃替你接受死亡惩罚。<a href='/Mall/Introduce.php?id=214'>特赦令</a>可以清除罪孽值哦~";
}
}
}




//$sql1="update users set  zhuangtai='yes' where id='".$userid."'";
//$ok=mysqli_query($db,$sql1);

if ($ok1 && $ok2){
echo "<br/>复活成功";
  mysqli_query($db,"COMMIT");
}else{
echo "<br/>复活失败";
  mysqli_query($db,"ROLLBACK");
}
  echo "<a href='/map.games'>返回地图</a>";
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");

?>