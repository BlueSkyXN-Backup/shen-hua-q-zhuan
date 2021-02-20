<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
//include "class/zhuangbei/xiangqian.php";
$id=$_GET['id'];
if(!isset($_SESSION['users'])){//判断是否存在$_SESSION
header("location:../reg.php");//跳转地址
exit();//结束
}
$resultl = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$id."'");
$my = mysqli_fetch_array($resultl);
if ($my){
}else{
echo"该装备不存在！";
echo "<a href='/map.games'>返回地图</a> <br/><br/>";
exit();//结束
}
$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$id."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei[yuanshi]."'");
$muban_zhuangbei = mysqli_fetch_array($muban_zhuangbei);
if($muban_zhuangbei[zhuansheng]>0){
        $zhuanshengname=china_num($muban_zhuangbei[zhuansheng])."转";
    }
       if($zhuangbei[naijiu]<"1"){
      
$muban_zhuangbei[qixue]="0"; 
$muban_zhuangbei[fali] ="0";
$muban_zhuangbei[fangyu]="0";
$muban_zhuangbei[fagong]="0";
$muban_zhuangbei[wugong]="0";
$muban_zhuangbei[sudu]="0";
}
echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a><br/>";
if($muban_zhuangbei[img]!="0"){
$img="<img src='/img/$muban_zhuangbei[img]'  alt='$muban_zhuangbei[name]' /><br/>";
}
if($muban_zhuangbei[jiyu]==no){
    $jiaoyi="不可交易";
}
if($zhuangbei[userid]==$userid){
if($zhuangbei[time]==null){
    $time="永久";
}else{
    $daoqi=$zhuangbei[time]-time();
    $daoqi=timesecond($daoqi);
    $time=$daoqi;
     $jiaoyi="不可交易";
}
}else{
   $time="未知";
}
//获取装备类型
switch ($muban_zhuangbei[leixing]) {
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
     case "sz1":
    $zhuangbei_leixing= "头饰<br/>";
    break;  
  case "sz2":
    $zhuangbei_leixing= "背饰<br/>";
    break;
      case "sz3":
    $zhuangbei_leixing= "吊坠<br/>";
    break;
      case "sz4":
    $zhuangbei_leixing= "上衣<br/>";
    break;
      case "sz5":
    $zhuangbei_leixing= "袜子<br/>";
    break;
    
    

  default:
    echo "系统错误";
exit();
    break;
}

//获取宝石镶嵌
if($zhuangbei[xq1]=="0"){
$xq1="<a href='/jineng/dakong.php?id=".$id."&shuxing=xq1
'>未打孔</a>";
}elseif($zhuangbei[xq1]=="1"){
$xq1="<a href='/jineng/xiangqian_index.php?zhuangbei=".$id."&kong=xq1&jibie=1
'>可镶嵌</a>";
}else{
$xq1=$xiangqian->xianshi($zhuangbei[xq1]);
 $xxxss=explode("|",$xq1); 
$xq1=$xxxss[1]."级".$xxxss[2]."+".$xxxss[0].$xxxss[3]."<a href='/jineng/zhaichu?zhuangbei=".$id."&kong=xq1&jibie=1
'>摘除</a>";
}
if($zhuangbei[xq2]=="0"){
$xq2="<a href='/jineng/dakong.php?id=".$id."&shuxing=xq2
'>未打孔</a>";
}elseif($zhuangbei[xq2]=="1"){
$xq2="<a href='/jineng/xiangqian_index.php?zhuangbei=".$id."&kong=xq2&jibie=1
'>可镶嵌</a>";
}else{
$xq2=$xiangqian->xianshi($zhuangbei[xq2]);
 $xxxss=explode("|",$xq2); 
$xq2=$xxxss[1]."级".$xxxss[2]."+".$xxxss[0].$xxxss[3]."<a href='/jineng/zhaichu?zhuangbei=".$id."&kong=xq2&jibie=1
'>摘除</a>";
}

if($zhuangbei[xq3]=="0"){
$xq3="<a href='/jineng/dakong.php?id=".$id."&shuxing=xq3
'>未打孔</a>";
}elseif($zhuangbei[xq3]=="1"){
$xq3="<a href='/jineng/xiangqian_index.php?zhuangbei=".$id."&kong=xq3&jibie=1
'>可镶嵌</a>";
}else{
$xq3=$xiangqian->xianshi($zhuangbei[xq3]);
 $xxxss=explode("|",$xq3); 
$xq3=$xxxss[1]."级".$xxxss[2]."+".$xxxss[0].$xxxss[3]."<a href='/jineng/zhaichu?zhuangbei=".$id."&kong=xq3&jibie=1
'>摘除</a>";
}

if($zhuangbei[xq4]=="0"){
$xq4="<a href='/jineng/dakong.php?id=".$id."&shuxing=xq4
'>未打孔</a>";
}elseif($zhuangbei[xq4]=="1"){
$xq4="<a href='/jineng/xiangqian_index.php?zhuangbei=".$id."&kong=xq4&jibie=1
'>可镶嵌</a>";
}else{
$xq4=$xiangqian->xianshi($zhuangbei[xq4]);
 $xxxss=explode("|",$xq4); 
$xq4=$xxxss[1]."级".$xxxss[2]."+".$xxxss[0].$xxxss[3]."<a href='/jineng/zhaichu?zhuangbei=".$id."&kong=xq4&jibie=1
'>摘除</a>";}

if($zhuangbei[xq5]=="0"){
$xq5="<a href='/jineng/dakong.php?id=".$id."&shuxing=xq5
'>未打孔</a>";
}elseif($zhuangbei[xq5]=="1"){
$xq5="<a href='/jineng/xiangqian_index.php?zhuangbei=".$id."&kong=xq5&jibie=1
'>可镶嵌</a>";
}else{
$xq5=$xiangqian->xianshi($zhuangbei[xq5]);
 $xxxss=explode("|",$xq5); 
$xq5=$xxxss[1]."级".$xxxss[2]."+".$xxxss[0].$xxxss[3]."<a href='/jineng/zhaichu?zhuangbei=".$id."&kong=xq5&jibie=1
'>摘除</a>";}

if($zhuangbei[xq6]=="0"){
$xq6="<a href='/jineng/dakong.php?id=".$id."&shuxing=xq6
'>未打孔</a>";
}elseif($zhuangbei[xq6]=="1"){
$xq6="<a href='/jineng/xiangqian_index.php?zhuangbei=".$id."&kong=xq6&jibie=1
'>可镶嵌</a>";
}else{
$xq6=$xiangqian->xianshi($zhuangbei[xq6]);
 $xxxss=explode("|",$xq6); 
$xq6=$xxxss[1]."级".$xxxss[2]."+".$xxxss[0].$xxxss[3]."<a href='/jineng/zhaichu?zhuangbei=".$id."&kong=xq6&jibie=1
'>摘除</a>";
}

//强化
$qianghua1=zhuangbei_qianghua($muban_zhuangbei[qixue],$zhuangbei[qh1]);
$qianghua2=zhuangbei_qianghua($muban_zhuangbei[fali],$zhuangbei[qh2]);
$qianghua3=zhuangbei_qianghua($muban_zhuangbei[fangyu],$zhuangbei[qh3]);
$qianghua4=zhuangbei_qianghua($muban_zhuangbei[fagong],$zhuangbei[qh4]);
$qianghua5=zhuangbei_qianghua($muban_zhuangbei[wugong],$zhuangbei[qh5]);
$qianghua6=zhuangbei_qianghua($muban_zhuangbei[sudu],$zhuangbei[qh6]);

//显示套装

if($muban_zhuangbei[taozhuang_id]!=NULL){
$muban_taozhuang= mysqli_query($db,"SELECT * FROM muban_taozhuang WHERE id='".$muban_zhuangbei[taozhuang_id]."'");
$muban_taozhuang= mysqli_fetch_array($muban_taozhuang);
$taozhuang_name="<br/><br/>唯一被动：【".$muban_taozhuang[taozhuang_name]."】<br/>";
//1件
if($muban_taozhuang[one]!=NULL){
$taozhuang= explode("|", $muban_taozhuang[one]);
$taozhuang_one="<br/>1件加成<br/>";
$taozhuang_one.="增加气血：".$taozhuang[0]."<br/>";
$taozhuang_one.="增加法力：".$taozhuang[1]."<br/>";
$taozhuang_one.="增加防御：".$taozhuang[2]."<br/>";
$taozhuang_one.="增加法攻：".$taozhuang[3]."<br/>";
$taozhuang_one.="增加物攻：".$taozhuang[4]."<br/>";$taozhuang_one.="增加速度：".$taozhuang[5]."<br/>";
}
//3件
if($muban_taozhuang[Three]!=NULL){
$taozhuang= explode("|", $muban_taozhuang[Three]);
$taozhuang_Three="<br/>3件加成<br/>";
$taozhuang_Three.="气血：".$taozhuang[0]."<br/>";
$taozhuang_Three.="法力：".$taozhuang[1]."<br/>";
$taozhuang_Three.="防御：".$taozhuang[2]."<br/>";
$taozhuang_Three.="法攻：".$taozhuang[3]."<br/>";
$taozhuang_Three.="物攻：".$taozhuang[4]."<br/>";$taozhuang_Three.="速度：".$taozhuang[5]."<br/>";
}
//5件
if($muban_taozhuang[Five]!=NULL){
$taozhuang= explode("|", $muban_taozhuang[Five]);
$taozhuang_Five="<br/>5件加成<br/>";
$taozhuang_Five.="气血：".$taozhuang[0]."<br/>";
$taozhuang_Five.="法力：".$taozhuang[1]."<br/>";
$taozhuang_Five.="防御：".$taozhuang[2]."<br/>";
$taozhuang_Five.="法攻：".$taozhuang[3]."<br/>";
$taozhuang_Five.="物攻：".$taozhuang[4]."<br/>";$taozhuang_Five.="速度：".$taozhuang[5]."<br/>";
}
//6件
if($muban_taozhuang[six]!=NULL){
$taozhuang= explode("|", $muban_taozhuang[six]);
$taozhuang_six="<br/>6件加成<br/>";
$taozhuang_six.="气血：".$taozhuang[0]."<br/>";
$taozhuang_six.="法力：".$taozhuang[1]."<br/>";
$taozhuang_six.="防御：".$taozhuang[2]."<br/>";
$taozhuang_six.="法攻：".$taozhuang[3]."<br/>";
$taozhuang_six.="物攻：".$taozhuang[4]."<br/>";$taozhuang_six.="速度：".$taozhuang[5]."<br/>";
}
//7件
if($muban_taozhuang[Seven]!=NULL){
$taozhuang= explode("|", $muban_taozhuang[Seven]);
$taozhuang_Seven="<br/>7件加成<br/>";
$taozhuang_Seven.="气血：".$taozhuang[0]."<br/>";
$taozhuang_Seven.="法力：".$taozhuang[1]."<br/>";
$taozhuang_Seven.="防御：".$taozhuang[2]."<br/>";
$taozhuang_Seven.="法攻：".$taozhuang[3]."<br/>";
$taozhuang_Seven.="物攻：".$taozhuang[4]."<br/>";$taozhuang_Seven.="速度：".$taozhuang[5]."<br/>";
}
}
if($muban_zhuangbei[mianshang]!='0'){
	$mianshang='增加'.$muban_zhuangbei[mianshang].'%免伤<br/>';
}
if($muban_zhuangbei[maxqixue]!='0'){
	$maxqixue='增加'.$muban_zhuangbei[maxqixue].'%体质<br/>';
}
if($muban_zhuangbei[maxfali]!='0'){
	$maxfali='增加'.$muban_zhuangbei[maxfali].'%灵性<br/>';
}
if($muban_zhuangbei[maxfangyu]!='0'){
	$maxfangyu='增加'.$muban_zhuangbei[maxfangyu].'%耐力<br/>';
}
if($muban_zhuangbei[maxgongji]!='0'){
	$maxgongji='增加'.$muban_zhuangbei[maxgongji].'%力量<br/>';
}
if($muban_zhuangbei[maxgongji_fa]!='0'){
	$maxgongji_fa='增加'.$muban_zhuangbei[maxgongji_fa].'%法术<br/>';
}
if($muban_zhuangbei[maxsudu]!='0'){
	$maxsudu='增加'.$muban_zhuangbei[maxsudu].'%敏捷<br/>';
}


//检测种族要求

if(!isset($muban_zhuangbei[juese])){
    $zhuangbei_xianzhi="角色限制:无限制";
}else{
  
$xianzhi = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM muban_juese WHERE id='".$muban_zhuangbei[juese]."'"));
   $zhuangbei_xianzhi="角色限制:【".$xianzhi[name]."】专属"; 
}
if($muban_zhuangbei[zhongzu_max]==null){
    $zhuangbei_dengjimax="";
}else{
   $zhuangbei_dengjimax="~".$muban_zhuangbei[zhongzu_max]; 
}
if($muban_zhuangbei[fuwen]=="yes"){
	$html=<<<HTML
<h3>$muban_zhuangbei[name] <small>$jiaoyi($time)</small></h3>
  $img
$muban_zhuangbei[text]<br/>
类型：$zhuangbei_leixing
体积：$muban_zhuangbei[tiji]<br/>

评级：$muban_zhuangbei[pingji]<br/>
等级：$zhuanshengname $muban_zhuangbei[dengji]$zhuangbei_dengjimax<br/>
$zhuangbei_xianzhi <br/>
$mianshang
$maxqixue
$maxfali
$maxfangyu
$maxgongji
$maxgongji_fa
$maxsudu
增加气血：$muban_zhuangbei[qixue] <br/>
增加法力：$muban_zhuangbei[fali] <br/>
增加防御：$muban_zhuangbei[fangyu] <br/>
增加法攻：$muban_zhuangbei[fagong] <br/>
增加物攻：$muban_zhuangbei[wugong] <br/>
增加速度：$muban_zhuangbei[sudu] <br/>

<a href='/zb/zb.shiyong?my=zhuangbei&leixing=$muban_zhuangbei[leixing]&id=$id'>装备</a> <br/>

HTML;

}else{
//     $muban_zhuangbei[qixue]+=$qianghua1;
// $muban_zhuangbei[fali]+=$qianghua2;
// $muban_zhuangbei[fangyu]+=$qianghua3;
// $muban_zhuangbei[fagong]+=$qianghua4;
// $muban_zhuangbei[wugong]+=$qianghua5;
// $muban_zhuangbei[sudu]+=$qianghua6;
$html=<<<HTML
<h4>$muban_zhuangbei[name] 
<small>$jiaoyi($time)</small></h4>
  $img
$muban_zhuangbei[text]<br/>
耐久：$zhuangbei[naijiu]/$muban_zhuangbei[naijiu_max] <a href='/jineng/xiufu?id=$id'>维修耐久</a><br/>
类型：$zhuangbei_leixing
负重：$muban_zhuangbei[tiji]<br/>
评级：$muban_zhuangbei[pingji]<br/>
穿戴等级：$zhuanshengname $muban_zhuangbei[dengji]$zhuangbei_dengjimax<br/>
$zhuangbei_xianzhi <br/>
$mianshang
$maxqixue
$maxfali
$maxfangyu
$maxgongji
$maxgongji_fa
$maxsudu
增加气血：$muban_zhuangbei[qixue] <a href='/Strengthen/Operation?id=$zhuangbei[id]&shuxing=qh1'>强$zhuangbei[qh1]</a>+$qianghua1<br/>
增加法力：$muban_zhuangbei[fali] <a href='/Strengthen/Operation?id=$zhuangbei[id]&shuxing=qh2'>强$zhuangbei[qh2]</a>+$qianghua2<br/>
增加防御：$muban_zhuangbei[fangyu] <a href='/Strengthen/Operation?id=$zhuangbei[id]&shuxing=qh3'>强$zhuangbei[qh3]</a>+$qianghua3<br/>
增加法攻：$muban_zhuangbei[fagong] <a href='/Strengthen/Operation?id=$zhuangbei[id]&shuxing=qh4'>强$zhuangbei[qh4]</a>+$qianghua4<br/>
增加物攻：$muban_zhuangbei[wugong] <a href='/Strengthen/Operation?id=$zhuangbei[id]&shuxing=qh5'>强$zhuangbei[qh5]</a>+$qianghua5<br/>
增加速度：$muban_zhuangbei[sudu] <a href='/Strengthen/Operation?id=$zhuangbei[id]&shuxing=qh6'>强$zhuangbei[qh6]</a>+$qianghua6<br/>

<a href='zb/zb.shiyong?my=zhuangbei&leixing=$muban_zhuangbei[leixing]&id=$id'>装备</a><br/>镶嵌<br/>
1孔位：$xq1<br/>
2孔位：$xq2<br/>
3孔位：$xq3<br/>
4孔位：$xq4<br/>
5孔位：$xq5<br/>
6孔位：$xq6<br/>
$taozhuang_name
$taozhuang_one
$taozhuang_Three
$taozhuang_Five
$taozhuang_Seven
</small>
HTML;
}
echo $html;
echo "<br/><a href='/user.parcel'>我的背包</a> <br/>";
echo footer();
echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";
