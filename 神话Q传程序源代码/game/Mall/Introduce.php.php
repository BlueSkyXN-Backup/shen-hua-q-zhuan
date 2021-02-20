<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$my=$_GET['my'];
$id=$_GET['id'];

$row = mysqli_query($db,"SELECT * FROM shangcheng WHERE id='".$id."'");
$row = mysqli_fetch_array($row);
if($row[shangpin_leixing]=="zhuangbei"){
//装备
  $myp = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$row[shangpin_id]."'");
$myp = mysqli_fetch_array($myp);

}else{
$myp = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[shangpin_id]."'");
$myp = mysqli_fetch_array($myp);
}
if($myp){
}else{
echo "抱歉！你想要查看的商品不存在或者已经下架了！<br/><a href='/Mall/Mall.php'>返回商城</a>";
exit();//结束
}
if($row[huobi]=="shenzhoubi"){
$huobi="神州币";
}elseif($row[huobi]=="gold"){
$huobi="金条";
}elseif($row[huobi]=="fuben"){
$huobi="副本积分";
}elseif($row[huobi]=="xjsj"){
$huobi="心愿水晶";
$huobi_gold="xjsj";
}elseif($row[huobi]=="shsj"){
$huobi="神话水晶";
$huobi_gold="shsj";
}
if($row[gold_no]==null){
	$yj="";
}else{
	
	$yj="<s>".$row[gold_no].$huobi."</s>";
}


echo"$myp[name] <br/>单价：$yj $row[gold]$huobi<br/>$myp[text]<br/>";
if($row[shangpin_leixing]=="zhuangbei"){
  //获取装备类型
switch ($myp[leixing]) {
  case "maozi":
    $zhuangbei_leixing="帽子<br/>";
    break;
  case "xianglian":
    $zhuangbei_leixing="项链<br/>";
    break;
  case "yifu":
    $zhuangbei_leixing="衣服<br/>";
    break;
  case "wuqi":
    $zhuangbei_leixing="武器<br/>";
    break;
  case "xiezi":
    $zhuangbei_leixing="鞋子<br/>";
    break;
      case "ps1":
    $zhuangbei_leixing= "发饰<br/>";
    break;  
  case "ps2":
    $zhuangbei_leixing= "翅膀<br/>";
    break;
      case "ps3":
    $zhuangbei_leixing= "披风<br/>";
    break;
      case "ps4":
    $zhuangbei_leixing= "戒指<br/>";
    break;
      case "ps5":
    $zhuangbei_leixing= "腰带<br/>";
    break;
      case "ps6":
    $zhuangbei_leixing= "手镯<br/>";
    break;
      case "ps7":
    $zhuangbei_leixing= "勋章<br/>";
    break;
      case "ps8":
    $zhuangbei_leixing= "耳环<br/>";
    break;
      case "fw":
    $zhuangbei_leixing= "符文<br/>";
    break;
  default:
    echo "系统错误";
exit();
    break;
}

if($myp[fuwen]=="yes"){

echo"类型：$zhuangbei_leixing
等级：$myp[dengji]<br/>
减免伤害：$myp[mianshang] %<br/>
气血：$myp[qixue] <br/>
法力：$myp[fali] <br/>
防御：$myp[fangyu] <br/>
法攻：$myp[fagong] <br/>
物攻：$myp[wugong] <br/>
速度：$myp[sudu]<br/> ";
}else{
echo"类型：$zhuangbei_leixing
耐久：$myp[naijiu]<br/>
等级：$myp[dengji]<br/>
气血：$myp[qixue] <br/>
法力：$myp[fali] <br/>
防御：$myp[fangyu] <br/>
法攻：$myp[fagong] <br/>
物攻：$myp[wugong] <br/>
速度：$myp[sudu]<br/> ";
}
}
echo"体积：$myp[tiji]<br/>";
if($myp[img]!="0"){
echo"<img src='/img/$myp[img]'  alt='$myp[name]' /><br/>";
}
echo "<form action='Buy.php?id=$row[id]' method='post'>";
echo "数量:<br/>";
echo "<input name='shuliang' maxlength='10' value='1'/><br/>";
echo '<input type="submit" value="购买" class="link"/></form>';

if($row[shei]=="1"){
echo"<a href='/Mall/Mall.php?my=$row[shangpin_leixing]'>返回商城</a><br/>";
}elseif($row[shei]=="2"){
echo"<a href='/Mall/npc.php?my=$row[shangpin_leixing]'>返回商店</a><br/>";	
}elseif($row[shei]=="3"){
echo"<a href='/Mall/fuben.php?my=$row[shangpin_leixing]'>返回商店</a><br/>";	
}elseif($row[shei]=="9"){
echo"<a href='/Mall/shsj?my=$row[shangpin_leixing]'>返回商店</a><br/>";	
}

echo footer();




