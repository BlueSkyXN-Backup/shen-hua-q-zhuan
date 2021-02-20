<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";




  echo "<a href='list?huobi=1&zhonglei=1'>查看金条寄售商品</a><br/> ";
echo "<a href='list?huobi=2&zhonglei=1'>查看神州币寄售商品</a><br/> ";
echo "<a href='Shelf'>我要寄售物品</a><br/> ";
echo "<a href='Offshelf'>我正在出售的物品</a><br/>温馨提示：在交易系统寄售物品系统将收取出售价格的5%手续费(手续费不足1时将按1收取)<br/>在本系统上架的物品超过30天未出售系统将自动销毁处理！<br/> ";
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";
//删除超过15天没有出售的物品
$result = mysqli_query($db,"SELECT * FROM jiaoyi");
while($row = mysqli_fetch_array($result))
  {
$row[time]+=864008*365;
if($row[time]<time()){
$sql3 = "delete from jiaoyi where id ='".$row[id]."'";
$ok1=mysqli_query($db,$sql3);
if($ok1){
   //显示宠物
  if($row[leixing]=="chongwu"){
$wupin = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$row[chongwu_id]."'");
$wupin = mysqli_fetch_array($wupin);
}
  if($row[leixing]=="jiben"){
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
}
  if($row[leixing]=="zhuangbei"){
$wupin = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$row[zhuangbei_id]."'");
$wupin = mysqli_fetch_array($wupin);
}

$s="insert into email(text,userid,leibie,zhuangtai) values('你在交易系统销售的".$wupin[name]."*".$row[shuliang]."，超过365天未出售，已被系统自动销毁。','".$row[userid]."','1','0')";
$ok5=mysqli_query($db,$s);
}
}else{
    
    if($row[leixing]=="zhuangbei"){
       if(isset($row[zhuangbei_time])){
        if($row[zhuangbei_time]<time()){
            $sql3 = "delete from jiaoyi where id ='".$row[id]."'";
$ok1=mysqli_query($db,$sql3);
if($ok1){
$wupin = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$row[zhuangbei_id]."'");
$wupin = mysqli_fetch_array($wupin);
$s="insert into email(text,userid,leibie,zhuangtai) values('你在交易系统销售的期限道具：".$wupin[name]."*".$row[shuliang]."，已过期，已被系统自动销毁。','".$row[userid]."','1','0')";
$ok5=mysqli_query($db,$s);
}
}
}
}
}

}?>