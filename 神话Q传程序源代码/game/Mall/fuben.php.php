<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$get_my=$_GET['my'];

switch($get_my){
case "jiben":
$Mall_name="jiben";
break;
case "zhuangbei":
$Mall_name="zhuangbei";
break;
case "cailiao":
$Mall_name="cailiao";
break;
default:
$Mall_name="xiaohao";
break;

}


echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
echo "<a href='./fuben.php?my=jiben'>基本</a>|<a href='./fuben.php?my=zhuangbei'>装备</a>|<a href='./fuben.php?my=cailiao'>材料</a>|<a href='./fuben.php?my=xiaohao'>药品</a> <br/>";
if($Mall_name=="zhuangbei"){
//装备
$perNumber=8; 
$page=$_GET['page']; 
$url="/Mall/fuben.php?my=$Mall_name&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from shangcheng WHERE shei='3' and shangpin_leixing='".$Mall_name."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from shangcheng WHERE shei='3' and shangpin_leixing='".$Mall_name."' order by id desc limit $startCount,$perNumber";
$result=mysqli_query($db,$exec); 
if($total==0){
echo "没有商品<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$myp = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$row[shangpin_id]."'");
$myp = mysqli_fetch_array($myp);

if($row[huobi]=="shenzhoubi"){
$huobi="神州币";
}elseif($row[huobi]=="gold"){
$huobi="金条";
}elseif($row[huobi]=="fuben"){
$huobi="副本积分";
}

echo "---------------<br/><a href='/Mall/Introduce.php?id=$row[id]'>$myp[name]</a>$row[gold]$huobi<br/>";
echo "<form action='Buy.php?id=$row[id]' method='post'>";
echo "数量:";
echo "<input name='shuliang' maxlength='10' value='1'/><br/>";
echo '<input type="submit" value="购买" class="link"/></form>';
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
echo "商城里空空如也！<br/>";
}
}
}else{
//聊天信息分页显示
$perNumber=8; 
$page=$_GET['page']; 
$url="/Mall/fuben.php?my=$Mall_name&";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from shangcheng WHERE shei='3' and shangpin_leixing='".$Mall_name."'")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from shangcheng WHERE shei='3' and shangpin_leixing='".$Mall_name."' order by id desc limit $startCount,$perNumber";
$result=mysqli_query($db,$exec); 
if($total==0){
echo "没有商品<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$myp = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[shangpin_id]."'");
$myp = mysqli_fetch_array($myp);

if($row[huobi]=="shenzhoubi"){
$huobi="神州币";
}elseif($row[huobi]=="gold"){
$huobi="金条";
}elseif($row[huobi]=="fuben"){
$huobi="副本积分";
}

echo "---------------<br/><a href='/Mall/Introduce.php?id=$row[id]'>$myp[name]</a>$row[gold]$huobi<br/>";
echo "<form action='Buy.php?id=$row[id]' method='post'>";
echo "数量:";
echo "<input name='shuliang' maxlength='10' value='1'/><br/>";
echo '<input type="submit" value="购买" class="link"/></form>';
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
echo "商城里空空如也！<br/>";
}
}
}

echo"副本积分：$user[fuben]<br/><br/>温馨提示：买了不退款，卖了不退货。<br/>";

echo "<a href='/npc.do?id=81'>商人丁全有</a> <br/>";

echo footer();
?>