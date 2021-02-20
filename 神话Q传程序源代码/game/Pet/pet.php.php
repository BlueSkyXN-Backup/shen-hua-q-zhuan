<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}

include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

$userid=$_SESSION['users'];
$get_shengji=$_GET['shengji'];
$shuxing=$_GET['shuxing'];
$id=$_GET['id'];
$fuhuo=$_GET['fuhuo'];
$mys=$_GET['my'];
if(!preg_match('/^[0-9]+$/u',$id)){
exit(系统错误);}//判定宠物id只能是数字

$user = mysqli_query($db,"SELECT * FROM pet WHERE userid='".$userid."' and id='".$id."'");
$user = mysqli_fetch_array($user);
$muban= mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$user[muban]."'");
$muban= mysqli_fetch_array($muban);

echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/><br/>";
//获取5神装

$zb=array();
for($ii=1;$ii<=23;$ii++){
switch ($ii) {
  case "1":
    $zhuangbei_leixing="maozi";
    break;
  case "2":
    $zhuangbei_leixing="xianglian";
    break;
  case "3":
    $zhuangbei_leixing="yifu";
    break;
  case "4":
    $zhuangbei_leixing="wuqi";
    break;
  case "5":
    $zhuangbei_leixing="xiezi";
    break;
      case "6":
    $zhuangbei_leixing= "ps1";
    break;  
  case "7":
    $zhuangbei_leixing= "ps2";
    break;
      case "8":
    $zhuangbei_leixing= "ps3";
    break;
      case "9":
    $zhuangbei_leixing= "ps4";
    break;
      case "10":
    $zhuangbei_leixing= "ps5";
    break;
      case "11":
    $zhuangbei_leixing= "ps6";
    break;
      case "12":
    $zhuangbei_leixing= "ps7";
    break;
      case"13":
    $zhuangbei_leixing= "ps8";
    break;
case"14":
    $zhuangbei_leixing= "fw1";
    break;
case"15":
    $zhuangbei_leixing= "fw2";
    break;
case"16":
    $zhuangbei_leixing= "fw3";
    break;
case"17":
    $zhuangbei_leixing= "fw4";
    break;
case"18":
    $zhuangbei_leixing= "fw5";
    break;
    case"19":
    $zhuangbei_leixing= "sz1";
    break;
case"20":
    $zhuangbei_leixing= "sz2";
    break;
case"21":
    $zhuangbei_leixing= "sz3";
    break;
case"22":
    $zhuangbei_leixing= "sz4";
    break;
case"23":
    $zhuangbei_leixing= "sz5";
    break;
  default:
    echo "系统错误";
exit();
    break;
}

if($user[$zhuangbei_leixing]=="0"){
$zb[$zhuangbei_leixing]="无 <a href='/Pet/zb.xianshi?leixing=$zhuangbei_leixing&chongwuid=$user[id]'>换装</a> ";
}else{
$zb[$zhuangbei_leixing]=zhuangbei_name($user[$zhuangbei_leixing])."<a href='/Pet/zb.shiyong?my=xiexia&leixing=$zhuangbei_leixing&id=$user[$zhuangbei_leixing]&chongwuid=$user[id]'>卸下</a>";
}
}



//计算升级需要经验
if($user[dengji]<70){
$num1=$user[dengji];
//等级*等级
$num1*=$num1;
$num1*=88;
}else{
$num1=$user[dengji];
$i=$user[dengji];
//等级*等级
$num1*=$num1;
$num1*=88;

}
//判断是否可以升级
if($user[jingyan]>$num1){
$shengji="<a href='./pet.php?id=".$id."&shengji=yes'>升级</a>";
}else{
$shengji="经验不足";
}
//复活提交
if($fuhuo=="yes"){
$sql1="update pet set qixue='".$user[qixuemax]."',fali='".$user[fali_max]."',zhuangtai='yes' where id='".$id."'";
$ok1=mysqli_query($db,$sql1);
if($ok1){
	echo"复活成功<br/>";
}else{
		echo"复活失败<br/>";
}
}
if($get_shengji=="yes"){

if($user[dengji]>="120"){

echo"已满级<br/>";
}else{
if($user[jingyan]>$num1){
$user[jingyan]-=$num1;
$user[dengji]+=1;
$user[shuxing]+="5";
$sql2="update pet set jingyan='".$user[jingyan]."',dengji='".$user[dengji]."',shuxing='".$user[shuxing]."' where id='".$id."'";
$ok=mysqli_query($db,$sql2);
if($ok){
    echo"升级成功！<br/>";
}else{
    echo"升级失败！<br/>";
}


//判断是否可以升级
if($user[jingyan]>$num1){
$shengji="<a href='./pet.php?id=".$id."&shengji=yes'>升级</a>";
}else{
$shengji="经验不足";
}
}else{
echo"经验不足以升级<br/>";
}
}
}
//计算升级需要经验

//计算升级需要经验
if($user[dengji]<70){
$num1=$user[dengji];
//等级*等级
$num1*=$num1;
$num1*=88;
}else{
$num1=$user[dengji];
$i=$user[dengji];
//等级*等级
$num1*=$num1;
$num1*=88;
}


//属性分配
$get_shuxing=$_GET['fengpei'];
if($get_shuxing=="yes"){
	
if(preg_match('/^[0-9]+$/u',$_POST['shuxing1'])) {
if(preg_match('/^[0-9]+$/u',$_POST['shuxing2'])) {
if(preg_match('/^[0-9]+$/u',$_POST['shuxing3'])) {
if(preg_match('/^[0-9]+$/u',$_POST['shuxing4'])) {
if(preg_match('/^[0-9]+$/u',$_POST['shuxing5'])) {
if(preg_match('/^[0-9]+$/u',$_POST['shuxing6'])) {
	//验证通过开始分配
	$shuxingdian="0";
	$shuxingdian+=$_POST['shuxing1'];
	$shuxingdian+=$_POST['shuxing2'];
	$shuxingdian+=$_POST['shuxing3'];
	$shuxingdian+=$_POST['shuxing4'];
	$shuxingdian+=$_POST['shuxing5'];
	$shuxingdian+=$_POST['shuxing6'];
	if($user[shuxing]<$shuxingdian){
		echo"当前可分配属性点不足！<br/>";
	}else{
		$user[shuxing]-=$shuxingdian;
		$user[shuxing1]+=$_POST['shuxing1'];
		$user[shuxing2]+=$_POST['shuxing2'];
		$user[shuxing3]+=$_POST['shuxing3'];
		$user[shuxing4]+=$_POST['shuxing4'];
		$user[shuxing5]+=$_POST['shuxing5'];
		$user[shuxing6]+=$_POST['shuxing6'];
		  $sql1="update pet set shuxing='".$user[shuxing]."',shuxing1='".$user[shuxing1]."',shuxing2='".$user[shuxing2]."',shuxing3='".$user[shuxing3]."',shuxing4='".$user[shuxing4]."',shuxing5='".$user[shuxing5]."',shuxing6='".$user[shuxing6]."' where id='".$user[id]."'";
$ok1=mysqli_query($db,$sql1);
if($ok1){
		echo"分配成功！<br/>";
}else{
		echo"分配失败！<br/>";
}
	}

}else{
echo "法攻分配栏只能输入数字！ <br/>";
}
}else{
echo "速度分配栏只能输入数字！ <br/>";
}
}else{
echo "物攻分配栏只能输入数字！ <br/>";
}
}else{
echo "防御分配栏只能输入数字！ <br/>";
}
}else{
echo "法力分配栏只能输入数字！ <br/>";
}
}else{
echo "气血分配栏只能输入数字！<br/>";
}
	
	
	
}
$userid=$_SESSION['users'];
$user = mysqli_query($db,"SELECT * FROM pet WHERE userid='".$userid."' and id='".$id."'");
$user = mysqli_fetch_array($user);
if($mys=="xiugai"){
$petname=$_POST['username'];
//修改宠物昵称
if(preg_match('/^[A-Za-z0-9\x{4e00}-\x{9fa5}]+$/u',$petname)){
$user[username]=$petname;
$sql2="update pet set username='".$petname."' where id='".$id."'";
$ok=mysqli_query($db,$sql2);
if($ok){
echo"修改成功！<br/>";}
}else{
echo"修改失败，昵称不能包含特殊符号!<br/>";}}




switch ($shuxing){
case "1":
	$user[shuxing1]+=$user[dengji];
$user[shuxing2]+=$user[dengji];
$user[shuxing3]+=$user[dengji];
$user[shuxing4]+=$user[dengji];
$user[shuxing5]+=$user[dengji];
$user[shuxing6]+=$user[dengji];
if($user[shuxing]<'1'){
	$user[shuxing]='0';
}
	

//模板技能
$html=<<<HTML
<form action='pet.php?shuxing=1&id=$user[id]&fengpei=yes' method='post'>
气血：$user[qixue]/$user[qixuemax]  体质：$user[shuxing1]<br/>
影响角色气血最大值<br/>
<input name='shuxing1' maxlength='10' value='0'/><br/>
法力：$user[fali]/$user[fali_max] 灵性：$user[shuxing2]<br/>
影响角色法力最大值<br/>
<input name='shuxing2' maxlength='10' value='0'/><br/>
防御：$user[fangyu] 耐力：$user[shuxing3]<br/>
影响角色防御最大值<br/>
<input name='shuxing3' maxlength='10' value='0'/><br/>
物攻：$user[gongji] 力量：$user[shuxing4]<br/>
影响角色物攻伤害最大值<br/>
<input name='shuxing4' maxlength='10' value='0'/><br/>
法攻：$user[gongji_fa]  法术：$user[shuxing6]<br/>
影响角色法攻伤害最大值<br/>
<input name='shuxing6' maxlength='10' value='0'/><br/>
速度：$user[sudu] 敏捷：$user[shuxing5]<br/>
影响角色速度最大值<br/>
<input name='shuxing5' maxlength='10' value='0'/><br/>
<input type="submit" value="确定分配" class="link"/></form>
可分配属性：$user[shuxing]<br/>Tips:已分配的可分配属性点掉级不会扣除,但升级不会重复获得。<br/>
HTML;
break;
case "2":
$html=<<<HTML
帽子：$zb[maozi]<br/>
项链：$zb[xianglian]<br/>
衣服：$zb[yifu]<br/>
武器：$zb[wuqi]<br/>
鞋子：$zb[xiezi]<br/>
HTML;
break;
    case "3":
$html=<<<HTML
发饰：$zb[ps1]<br/>
耳环：$zb[ps8]<br/>
翅膀：$zb[ps2]<br/>
披风：$zb[ps3]<br/>
戒指：$zb[ps4]<br/>
腰带：$zb[ps5]<br/>
手镯：$zb[ps6]<br/>
勋章：$zb[ps7]<br/>
HTML;
break;
case "4":
$html=<<<HTML
符文1：$zb[fw1]<br/>
符文2：$zb[fw2]<br/>
符文3：$zb[fw3]<br/>
符文4：$zb[fw4]<br/>
符文5：$zb[fw5]<br/>
HTML;
break;
case "5":
$html=<<<HTML
头饰：$zb[sz1]<br/>
背饰：$zb[sz2]<br/>
吊坠：$zb[sz3]<br/>
上衣：$zb[sz4]<br/>
袜子：$zb[sz5]<br/>
HTML;
break;

default:
	//获取数据
$muban= mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$user[muban]."'");
$muban= mysqli_fetch_array($muban);
$jineng=$_GET['jineng'];
if($jineng){//执行宠物默认技能设置
if($jineng=="pt"){//设置普通攻击
$sql2="update pet set jineng='0' where id='".$id."'";
$ok=mysqli_query($db,$sql2);
if($ok){echo"设置成功。<br/>";}else{echo"设置失败。<br/>";}
}else{//设置技能
$muban_jineng= explode(",", $muban[jineng]);
	if(in_array($jineng,$muban_jineng)){
$sql2="update pet set jineng='".$jineng."' where id='".$id."'";
$ok=mysqli_query($db,$sql2);
if($ok){echo"设置成功。<br/>";}else{echo"设置失败。<br/>";}
}else{
echo"设置失败！宠物未拥有该技能。<br/>";
}
}
	
}
$muban_jineng= explode(",", $muban[jineng]);
//技能函数
    include $_SERVER['DOCUMENT_ROOT']."/class/pvp/class/jineng.php";
for($js=0;$js<count($muban_jineng);$js++)
{

	$user_jineng=pvp_jineng($muban_jineng[$js],$muban_jineng[$js]);
	$user_jineng= explode("|",$user_jineng);
	//技能id
	$jinengs_name.="<a href='./pet.php?id=".$id."&jineng=$muban_jineng[$js]'>".$user_jineng[5]."</a><br/>";//技能名字
}
	$jinengs_name.="<a href='./pet.php?id=".$id."&jineng=pt'>普通攻击</a><br/>";//技能名字

$html=<<<HTML
<img src='/img/$muban[img]'  width='90' height='100' alt='$guaiwu[name]' />
<form action="pet.php?id=$id&my=xiugai" method="post"> 
昵称:<input type="text" name="username" value="$user[username]"/>
 <input type="submit" class="link" value="修改" />
 </form>
名称：$muban[name] <br/>
介绍：$muban[text] <br/>
宠物成长率：$user[chengzhanglv]%<br/>
宠物等级：$user[dengji] <br/>
宠物携带等级：$muban[dengji] <br/>
忠诚度:$user[zhongcheng] <br/>
  忠诚度耗尽宠物会罢工哦~试试购买<a href='/Mall/Introduce.php?id=136'>宠物口粮</a>或者任务获得。
  <br/>
经验：$user[jingyan] /
  $num1  $shengji<br/>
  气血：$user[qixue]/$user[qixuemax]  <br/>


法力：$user[fali]/$user[fali_max] <br/>

  【宠物技能】<br/>
  $jinengs_name
HTML;
break;
}

//判断用户状态
if($user[zhuangtai]=="yes"){
$zhuangtai_zhuangtai="正常";
}else{
$zhuangtai_zhuangtai="死亡<a href='pet.php?shuxing=0&id=$id&fuhuo=yes'>复活</a>";
}
echo"<a href='./pet.php?shuxing=0&id=$user[id]'>基本</a>|<a href='./pet.php?shuxing=1&id=$user[id]'>属性</a>|<a href='./pet.php?shuxing=2&id=$user[id]'>装备</a>|<a href='./pet.php?shuxing=3&id=$user[id]'>配饰</a>|<a href='./pet.php?shuxing=5&id=$user[id]'>时装</a>|<a href='./pet.php?shuxing=4&id=$user[id]'>符文</a><br/>状态:".$zhuangtai_zhuangtai."<br/>------------------------------<br/>";
echo $html;

echo "<br/><a href='/Pet/index.php'>宠物首页</a> <br/>";

echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/><br/>";

?>