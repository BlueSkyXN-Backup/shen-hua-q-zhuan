<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$shuxing=$_GET['shuxing'];
$get_shengji=$_GET['shengji'];
$get_chengwei=$_GET['chengwei'];
$get_rongyu=$_GET['rongyu'];
$get=$_GET['id'];
//更换称谓
if($get_chengwei!=""){
$resultl = mysqli_query($db,"SELECT * FROM users_chengwei WHERE id='".$get_chengwei."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){
$sql2="update users set chengwei='".$get_chengwei."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
if($ok){
echo"更换称谓成功！<br/>";
}else{
echo"更换称谓失败！<br/>";
}
}
}
//更换荣誉
if($get_rongyu!=""){
$resultl = mysqli_query($db,"SELECT * FROM users_ch WHERE id='".$get_rongyu."' and userid='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){
    $rongyu1232 = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM muban_rongyu WHERE id='".$my[muban]."'"));
$sql2="update users set rongyu='".$rongyu1232[img]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
if($ok){
echo"更换荣誉成功！<br/>";
}else{
echo"更换荣誉失败！<br/>";
}
}
}
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
$zb[$zhuangbei_leixing]="无 <a href='/zb/zb.xianshi?leixing=$zhuangbei_leixing'>换装</a> ";
}else{
$zb[$zhuangbei_leixing]=zhuangbei_name($user[$zhuangbei_leixing])."<a href='/zb/zb.shiyong?my=xiexia&leixing=$zhuangbei_leixing&id=$user[$zhuangbei_leixing]'>卸下</a>";
}
}
//计算升级需要经验

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
}

//升级提交
if($get_shengji=="yes"){
    
$max_dengji=$user[zhuansheng]*10;
$max_dengji+="120";
if($user[dengji]>=$max_dengji){

echo"当前等级最高".$max_dengji."级！(每次转生MAX等级限制+10)<br/>";
}else{
if($user[jingyan]>$num1){
$user[jingyan]-=$num1;
$user[dengji]+=1;
if($user[zhuansheng]<"5"){
$user[shuxing]+=5;
}
$sql2="update users set jingyan='".$user[jingyan]."',dengji='".$user[dengji]."',shuxing='".$user[shuxing]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
}else{
echo"经验不足以升级<br/>";
}
}
}
//计算升级需要经验
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
}
//判断是否可以升级
if($user[jingyan]>$num1){
$shengji="<a href='/user/my?shengji=yes'>升级</a>";
}else{
$shengji="经验不足";
}

$shuxing_dian=$user[dengji];
$shuxing_dian*=5;
$userid=$_SESSION['users'];
$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);

//获取用户称谓
$user_chengwei = mysqli_query($db,"SELECT * FROM users_chengwei WHERE id='".$user[chengwei]."'");
$user_chengwei= mysqli_fetch_array($user_chengwei);
if ($user[sex]=="0"){
$sex="女";
$img="<img src='/img/tj.png'  width='90' height='100' ><br/>";

}
if ($user[sex]=="1"){
$sex="男";
$img="<img src='/img/xy.png'  width='90' height='100'>";
}
if($user[juese]!=null){
$juese= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM juese WHERE id='".$user[juese]."' and userid='".$userid."'"));
$juese2= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM muban_juese WHERE id='".$juese[muban]."'"));

$img="<img src='/img/juese/".$juese2[img]."'  width='90' height='100' alt='$npc[name]' /><br/>";
    
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
		  $sql1="update users set shuxing='".$user[shuxing]."',shuxing1='".$user[shuxing1]."',shuxing2='".$user[shuxing2]."',shuxing3='".$user[shuxing3]."',shuxing4='".$user[shuxing4]."',shuxing5='".$user[shuxing5]."',shuxing6='".$user[shuxing6]."' where id='".$userid."'";
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


//
/*if($user[zhuansheng]=="1"){
    $zhuanshengname="一转";
}elseif($user[zhuansheng]=="2"){
    $zhuanshengname="二转";
}elseif($user[zhuansheng]=="3"){
    $zhuanshengname="三转";
}elseif($user[zhuansheng]=="4"){
    $zhuanshengname="四转";
}else{
    $zhuanshengname="";}*/
    if($user[zhuansheng]>0){
        $zhuanshengname=china_num($user[zhuansheng])."转";
    }
    
    
    $qinglv=mysqli_fetch_array(mysqli_query($db,"select * from qinglv where nan IN('".$userid."') or nv IN('".$userid."')"));
    if(!$qinglv){
        $qinglv_name="无";
    }else{
      if($user[sex]=="0"){
         $user_qinglv = mysqli_query($db,"SELECT * FROM users WHERE id='".$qinglv[nan]."'");
$user_qinglv= mysqli_fetch_array($user_qinglv); 

$qinglv_name="<a href='/user.php?id=".$user_qinglv[id]."'>".$user_qinglv[username]."</a>";
      }else{
                 $user_qinglv = mysqli_query($db,"SELECT * FROM users WHERE id='".$qinglv[nv]."'");
$user_qinglv= mysqli_fetch_array($user_qinglv); 

$qinglv_name="<a href='/user.php?id=".$user_qinglv[id]."'>".$user_qinglv[username]."</a>"; 
      }
        
        
        
    }
    
    

if ($user[zhongzu]=="1"){
$zhongwu="妖族";
}
if ($user[zhongzu]=="2"){

$zhongwu="人族";

}
if ($user[zhongzu]=="3"){

$zhongwu="鬼族";

}
if ($user[zhongzu]=="4"){

$zhongwu="佛族";

}
if ($user[zhongzu]=="5"){

$zhongwu="仙族";
}
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
$html=<<<HTML
<form action='my?shuxing=1&fengpei=yes' method='post'>
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
可分配属性：$user[shuxing]（<a href='/user_xd'>洗点</a>）<br/>Tips:已分配的可分配属性点掉级不会扣除,但升级不会重复获得。<br/>
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
case "6":
$html=<<<HTML
<form action='./map?x=$get_x&y=$get_y&z=$get_z&my=ok' method='post'>
人物属性公开：<select name="sel">
                    <option value="1">公开</option>
                    <option value="2">保密</option>
                </select>(保密状态下别人无法看看你的属性、装备，且不录入排行榜)<br/>
            人物动态公开：<select name="sel">
                    <option value="1">公开</option>
                    <option value="2">保密</option>
                </select>(保密状态下游戏动态将不会同步到世界广播) <br/>
                被加好友：<select name="sel">
                    <option value="1">接受</option>
                    <option value="2">拒绝</option>
                </select><br/>
                接受陌生人私聊：<select name="sel">
                    <option value="1">接受</option>
                    <option value="2">拒绝</option>
                </select><br/>
                PK：<select name="sel">
                    <option value="1">关闭</option>
                    <option value="2">开启</option>
                </select>(关闭状态下别人只能使用杀人香强制PK)<br/>
               是否接受给予： <select name="sel">
                    <option value="1">接受所有人给予</option>
                    <option value="2">只接受双向好友给予</option>
                    <option value="3">拒绝任何人给予</option>
                </select><br/>
个性签名:
<input name='guaiwu' maxlength='100' value='$map[guaiwu]'/><br/>
个人说明:
<textarea name=\"text\" id=\"Content\" rows=\"3\"></textarea><br/>
<input type="submit" value="确定修改" class="submit"/></form>
HTML;
break;
default:
	if($user[fuzhi]!=0){
switch($user[fuzhi]){
case 1:
$fuzhi_name="药师熟练度：$user[fuzhi_int]<br/>";
break;
case 2:
$fuzhi_name="工匠熟练度：$user[fuzhi_int]<br/>";
break;
case 3:
$fuzhi_name="裁缝熟练度：$user[fuzhi_int]<br/>";
break;
case 4:
$fuzhi_name="木匠熟练度：$user[fuzhi_int]<br/>";
break;
}
}
$name=user_name($user[id]);

if ($user[zhongzu]=="1"){
$zhongwu="妖族";
}
if ($user[zhongzu]=="2"){

$zhongwu="人族";

}
if ($user[zhongzu]=="3"){

$zhongwu="鬼族";

}
if ($user[zhongzu]=="4"){

$zhongwu="佛族";

}
if ($user[zhongzu]=="5"){

$zhongwu="仙族";
}
if($user[rongyu]){
$rongyu_img="<img src='/img/rongyu/".$user[rongyu]."'  height='50'/>";
}
$html=<<<HTML
$img <a href='qq'>更换角色</a><br/>
$name<br/>
ID：$user[id] <br/>
性别：$sex <br/>
等级：$zhuanshengname $user[dengji] 级<a href='/user_zs?'>转生</a><br/>
种族：$zhongwu <br/>
罪恶：$user[zuie] <br/>
罪孽：$user[zuie2] <br/>
情侣：$qinglv_name <br/>
活力：$user[huoli]<br/>
帮贡：$user[banggong]<br/>
$fuzhi_name
成就：$user[chengjiu]<br/>
战绩：$user[zhanji]<br/>
荣誉：$rongyu_img   <a href='/my_rongyu'>更换</a><br/>
称谓：$user_chengwei[name]   <a href='/my_chengwei'>更换</a><br/>
经验：$user[jingyan] /
  $num1  $shengji<br/>
HTML;
break;
}

//判断用户状态
if($user[zhuangtai]=="yes"){
$zhuangtai_zhuangtai="正常";
}else{
$zhuangtai_zhuangtai="死亡";
}
echo"状态:".$zhuangtai_zhuangtai."<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a><br/>";
echo"<a href='my?'>基本</a>|<a href='my?shuxing=1'>属性</a>|<a href='my?shuxing=2'>装备</a>|<a href='my?shuxing=5'>时装</a>|<a href='my?shuxing=3'>配饰</a>|<a href='my?shuxing=4'>符文</a><br/>";
echo $html;

echo "<br/><a href='/map.games?id=".$zhuangtai_map."'>只是路过</a> <br/>";
echo footer();
echo "<br/><a href='/map.games?id=".$zhuangtai_map."'>返回地图</a> <br/>";

?>