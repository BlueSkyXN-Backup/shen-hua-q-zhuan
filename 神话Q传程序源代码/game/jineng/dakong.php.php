<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$userid=$_SESSION['users'];
$id=$_GET['id'];
$my_yes=$_GET['my'];
$wap=$_GET['wap'];

//判断装备id只能为数字
if(!preg_match('/^[0-9]+$/u',$id)) {
echo"你的装备正在别人家仓库中！";
echo "<a href='/map.games'>返回地图</a> <br/><br/>";
exit();//结束
}
$_SESSION['qianghua']=md5(date("Y-m-d H:i:s"));
$ok_qianghua=$_SESSION['qianghua'];
$qianghua_shuxing=$_GET['shuxing'];
//获取装备强化类型
switch($qianghua_shuxing){
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
    echo "乱选孔位装备会被打碎掉哦！。";
exit();
    break;
}
$resultl = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$id."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if (!$my){
echo"你未拥有该装备，不能进行打孔！";
echo "<a href='/map.games'>返回地图</a> <br/><br/>";
exit();//结束
}
if ($my[$qianghua_shuxing]!="0"){
echo"该孔位已经打过孔了！";

echo "<a href='/jineng/xiangqian_index.php?zhuangbei=$id&wap=1'>选择其他孔位</a> ";

echo "<a href='/map.games'>返回地图</a> <br/><br/>";
exit();//结束
}

echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";
//统计打孔器数量
$tongji_shu=mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='20' and userid='".$userid."'");
$tongji_shu=mysqli_fetch_array($tongji_shu);
if(!$tongji_shu[shuliang]){
$tongji_shu[shuliang]="0";
}
if($xy>$tongji_shu[shuliang]){
echo"打孔器不够<br/>";
echo "<a href='/map.games'>返回地图</a> <br/>";
exit();//结束
}
$yongyou_wupin.="拥有打孔器：$tongji_shu[shuliang]个(打孔必备)<br/>";




$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$id."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei[yuanshi]."'");
$muban_zhuangbei = mysqli_fetch_array($muban_zhuangbei);
$xuyao_20="1";
$chenggong_lv="100";
//打孔执行代码
//强化提交
if($wap=="yes"){
//扣除强化石
if($tongji_shu[shuliang]<$xuyao_20 or $user[gold]<$zhuangbei_gold){
echo"打孔器不够或者金币不足！";

echo "<a href='/jineng/xiangqian_index.php?zhuangbei=$id&wap=1'>选择其他孔位</a> ";

echo "<a href='/map.games'>返回地图</a> <br/><br/>";
exit();//结束
}
$tongji_shu[shuliang]-=$xuyao_20;
if($tongji_shu[shuliang]<"1"){
$sql3 = "delete from beibao where userid='".$userid."' and wupin_id='20'";
$ok=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$tongji_shu[shuliang]."' where userid='".$userid."' and wupin_id='20'";
$ok=mysqli_query($db,$sql2);
}
//扣除打孔器结束
$user[gold]-=$zhuangbei_gold;
$sql1="update users set  gold='".$user[gold]."' where id='".$userid."'";
$ok1=mysqli_query($db,$sql1);
//扣除金币结束

$chenggong=mt_rand(1,100);
if($chenggong_lv>=$chenggong){
echo"恭喜你打孔成功！<br/>";
$zhuangbei[$qianghua_shuxing]+="1";
$sql1="update zhuangbei set  $qianghua_shuxing='1' where id='".$id."'";
$ok=mysqli_query($db,$sql1);

}else{
echo"打孔失敗";
}
}

echo"<br/><br/><img src='/img/kz.gif' />$muban_zhuangbei[name]<br/>当前打孔".$zhuangbei_leixing.$zhuangbei[$qianghua_shuxing]."<br/><br/>需要打孔器*<font s color='blue'>".$xuyao_20."</font><br/>需要金条*<font s color='blue'>".$zhuangbei_gold."</font>当前成功率：<font s color='blue'>".$chenggong_lv."％</font><br/>";
echo $qh_linjie;
echo "<a href='dakong.php?id=$id&shuxing=$qianghua_shuxing&wap=yes'>确定打孔</a> ";



echo $yongyou_wupin;


echo "<a href='/jineng/xiangqian_index.php?zhuangbei=$id&wap=1'>选择其他孔位</a> ";
?>