<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$id=$_GET['id'];


$row = mysqli_query($db,"SELECT * FROM jiaoyi WHERE id='".$id."'");
$row = mysqli_fetch_array($row);

if($row[huobi]=="shenzhoubi"){
$huobi_name="神州币<br/>";
}else{
$huobi_name="金条<br/>";
}

  //显示物品
  if($row[leixing]=="jiben"){
$wupin = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$row[wupin_id]."'");
$wupin = mysqli_fetch_array($wupin);
echo "".$wupin[name]."<br/>".$wupin[text]."";
echo "<form action='list?id=$row[id]&huobi=$get_huobi&zhonglei=$get_zhonglei&my=1' method='post'>";
echo "数量:<br/>";
echo "<input name='shuliang' maxlength='10' value='1'/><br/>";
echo '<input type="submit" value="确定购买" class="link"/></form>';
}
 //显示装备
  if($row[leixing]=="zhuangbei"){
$wupin = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$row[zhuangbei_id]."'");
$myp = mysqli_fetch_array($wupin);
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
if($row[zhuangbei_time]==null){
    $zhuangtai="";
}else{
    $row[zhuangbei_time]-=time();
    $row[zhuangbei_time]/=86400;
    $zhuangtai=ceil($row[zhuangbei_time]);
    $zhuangtai="(".$zhuangtai."天)";
}
  echo "--------------------<br/>$myp[name]$zhuangtai<br/>单价:$row[jiage] $huobi_name";

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

echo"体积：$myp[tiji]<br/>";
if($myp[img]!="0"){
echo"<img src='/img/$myp[img]'  alt='$myp[name]' /><br/>";
}
echo "<form action='list?id=$row[id]&huobi=$get_huobi&zhonglei=$get_zhonglei&my=1' method='post'>";
echo "数量:<br/>";
echo "<input name='shuliang' maxlength='10' value='1'/><br/>";
echo '<input type="submit" value="确定购买" class="link"/></form>';
}
   //显示宠物
  if($row[leixing]=="chongwu"){
$wupin = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$row[chongwu_id]."'");
$myp = mysqli_fetch_array($wupin);
  echo "--------------------<br/>$myp[name]<br/>单价:$row[jiage] $huobi_name";
  echo"
成长率：$row[chongwu_chengzhanglv]<br/>
等级：$row[chongwu_dengji]<br/>
气血：$row[chongwu_qixuemax] <br/>
法力：$row[chongwu_falimax] <br/>
防御：$row[chongwu_fangyu] <br/>
法攻：$row[chongwu_fagong] <br/>
物攻：$row[chongwu_wugong] <br/>
速度：$row[chongwu_sudu]<br/> ";
echo "<form action='list?id=$row[id]&huobi=$get_huobi&zhonglei=$get_zhonglei&my=1' method='post'>";
echo "数量:<br/>";
echo "<input name='shuliang' maxlength='10' value='1'/><br/>";
echo '<input type="submit" value="确定购买" class="link"/></form>';
}
//显示结束



echo "<br/><a href='./list'>返回交易</a> <br/>";

echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";



?>
