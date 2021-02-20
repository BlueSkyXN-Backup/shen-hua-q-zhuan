<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$userid=$_SESSION['users'];
$wap=$_GET['wap'];

if($user[zhuansheng]>"16"){
	echo"你已经16转，功德圆满！";
}else{

	//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
//统计数量
$tongji_shu=mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='79' and userid='".$userid."'");
$tongji_shu=mysqli_fetch_array($tongji_shu);
if(!$tongji_shu[shuliang]){
$tongji_shu[shuliang]="0";
}


if($user[zhuansheng]=="0"){
    $xuyao_79="1";
    
}elseif($user[zhuansheng]=="1"){
    $xuyao_79="4";
    
}else{
    $xuyao_79=$user[zhuansheng]*$user[zhuansheng];
 
}
$xuyao_dengji=$user[zhuansheng]*10;
$xuyao_dengji+="100";
//打孔执行代码
//强化提交
if($wap=="yes"){
$zhongzu=$_POST['zhongzu'];
if(empty($zhongzu)||$zhongzu<1||$zhongzu>5){
$zhongzu="1";
}
    
    if($user[dengji]>=$xuyao_dengji){
//扣除强化石
if($tongji_shu[shuliang]<$xuyao_79){
echo"转生券不够！<br/>";

}else{
  $user_zhuangbei=0;
$user_zhuangbei+=$user[maozi];
$user_zhuangbei+=$user[xianglian];
$user_zhuangbei+=$user[yifu];
$user_zhuangbei+=$user[wuqi];
$user_zhuangbei+=$user[xiezi];
$user_zhuangbei+=$user[ps1];
$user_zhuangbei+=$user[ps2];
$user_zhuangbei+=$user[ps3];
$user_zhuangbei+=$user[ps4];
$user_zhuangbei+=$user[ps5];
$user_zhuangbei+=$user[ps6];
$user_zhuangbei+=$user[ps7];
$user_zhuangbei+=$user[ps8];
$user_zhuangbei+=$user[sz1];
$user_zhuangbei+=$user[sz2];
$user_zhuangbei+=$user[sz3];
$user_zhuangbei+=$user[sz4];
$user_zhuangbei+=$user[sz5];
  $user_zhuangbei+=$user[fw1];
$user_zhuangbei+=$user[fw2];
$user_zhuangbei+=$user[fw3];
$user_zhuangbei+=$user[fw4];
$user_zhuangbei+=$user[fw5];
    
    
    
    if($user_zhuangbei=="0"){
      $user_jineng+=$user[jineng1];
$user_jineng+=$user[jineng2];
$user_jineng+=$user[jineng3];
$user_jineng+=$user[jineng4];
$user_jineng+=$user[jineng5];
  if($user_jineng>="300"){
$tongji_shu[shuliang]-=$xuyao_79;
if($tongji_shu[shuliang]<"1"){
$sql3 = "delete from beibao where userid='".$userid."' and wupin_id='79'";
$ok1=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$tongji_shu[shuliang]."' where userid='".$userid."' and wupin_id='79'";
$ok1=mysqli_query($db,$sql2);
}

$user[zhuansheng]+="1";
$user[shuxing]+=$user[shuxing1];
$user[shuxing]+=$user[shuxing2];
$user[shuxing]+=$user[shuxing3];
$user[shuxing]+=$user[shuxing4];
$user[shuxing]+=$user[shuxing5];
$user[shuxing]+=$user[shuxing6];
$shuxingv=$user[dengji];
$shuxingv*="6";
$user[shuxing]+=$shuxingv;
//$sql1="update users set zhongzu='".$zhongzu."',zhuansheng='".$user[zhuansheng]."',dengji='1',shuxing='".$user[shuxing]."',shuxing1='0',shuxing2='0',shuxing3='0',shuxing4='0',shuxing5='0',shuxing6='0' where id='".$userid."'";
//$ok1=mysqli_query($db,$sql1);
//最后将属性写入数据库
$sql2="update users set zhongzu='".$zhongzu."',zhuansheng='".$user[zhuansheng]."',dengji='1',jingyan='0',shuxing='".$user[shuxing]."', shuxing1='0',shuxing2='0',shuxing3='0',shuxing4='0',shuxing5='0',shuxing6='0', jineng1='0',jineng2='0',jineng3='0',jineng4='0',jineng5='0' where id='".$userid."'";
$ok2=mysqli_query($db,$sql2);
if($ok1 && $ok2){
echo"转生成功！<br/>";
mysqli_query($db,"COMMIT");//提交
}else{
echo"转生失败！<br/>";
mysqli_query($db,"ROLLBACK");
}


    }else{
    echo"请将门派技能等级总和升到300级！<br/>";
}
    }else{
    echo"转生请脱下所有装备！<br/>";
}
}
}else{
    echo"当前转生需要等级大于".$xuyao_dengji."级<br/>";
}
    
    
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");

echo"当前$user[dengji]级，需要转生券".$xuyao_79."件<br/>";



echo '<form action="/user_zs?wap=yes" method="post">  
      
  
 选择转生种族:<select name="zhongzu" id="zhongzu">
<option value="2">人族</option>
<option value="4">佛族</option>
<option value="5">仙族</option>
<option value="3">鬼族</option>
<option value="1">妖族</option>


</select> 

<input type="submit" class="link" value="确定转生" />
        
</form>';
}
echo "<br/> 提示：转生需要人物转生券，转生需要脱下所有装备配饰与符文。<br/>转生后人物所有属性点归零返还到 可分配属性点 上且人物所有数据重置为新手<br/><a href='/user/my'>我的状态</a> ";


?>