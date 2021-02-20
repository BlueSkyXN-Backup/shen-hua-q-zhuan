
<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
$my=$_GET['my'];
$name=$_POST['name'];
$shouji=$_POST['shouji'];
$pass=$_POST['pass'];
$name_shu=strlen($name);
$pass_shu=strlen($pass);

if ($my=="ok"){
if($_SESSION['code']==$_POST['yanzheng']){
if ($name_shu>"5" and $name_shu<"17"){
if ($pass_shu>"5" and $pass_shu<"17"){
if(preg_match('/^[A-Za-z0-9]+$/u',$name)) {
if(preg_match('/^[A-Za-z0-9]+$/u',$pass)) {
$resultl = mysqli_query($db,"SELECT * FROM user WHERE name='".$name."'");
$my = mysqli_fetch_array($resultl);
if ($my){
echo "账号已经被注册了！<br/><a href='/login?my=reg'>返回重新注册</a><br/>";
}else{
$pass=md5($pass);
$s="insert into user(name,pass) values('".$name."','".$pass."')";
$ok=mysqli_query($db,$s);
if ($ok){
echo "<b>注册成功!<br/><a href='/login?my=login'>点击立刻前往登录</a></b><br/>";
}else{
echo "<b>抱歉，注册失败！！<br/><a href='/login?my=reg'>返回重新注册</a></b><br/>";
}
}
}else{
echo"密码只能包含字母、数字！<br/><a href='/login?my=reg'>返回重新注册</a></b><br/><br/>";  
}
}else{
echo"用户名只能包含字母、数字！<br/><a href='/login?my=reg'>返回重新注册</a></b><br/><br/>"; 
}
}else{
echo "密码不得小于6位大于16位数！<br/><a href='/login?my=reg'>返回重新注册</a><br/>";
}
}else{
echo "用户名不得小于6位数大于16位数！<br/><a href='/login?my=reg'>返回重新注册</a><br/>";
}
}else{
echo "验证码错误<br/><a href='/login?my=reg'>返回重新注册</a><br/>";
}

}


if ($my=="ko"){
	if($_SESSION['code']==$_POST['yanzheng']){
  $pass=md5($pass);
$resultlee = mysqli_query($db,"SELECT * FROM user WHERE name='".$name."' and password='".$pass."'");
$myee = mysqli_fetch_array($resultlee);
if ($myee){
$sid=$myee['sid'];
$zone = mysqli_query($db,"SELECT * FROM user WHERE name='".$name."'");
$zone = mysqli_fetch_array($zone);
$_SESSION['name']=$zone['name'];

echo "登录成功！<br/>";
header("refresh:3;url=/main.do");
print('正在加载，请稍等...<br>3秒后自动跳转。');

echo "<br/><a href='/main'>马上进入</a>";
}else{
echo "登录失败<br/>请检查密码账号是否正确<br/><a href='/login?my=login'>点击重新登录</a><br/>";
}
}else{
echo "登录失败<br/>验证码输入错误<br/><a href='/login?my=login'>点击重新登录</a><br/>";
	
}
}


// if ($my=="mbko"){
//   $pass=md5($pass);
// @$resultlee = mysqli_query($db,"SELECT * FROM user WHERE shouji='".$shouji."' and shouji_if='1' and pass='".$pass."'");
// @$myee = mysqli_fetch_array($resultlee);
// if ($myee){
// $sid=$myee['sid'];
// $zone = mysqli_query($db,"SELECT * FROM user WHERE shouji='".$shouji."'");
// $zone = mysqli_fetch_array($zone);
// $_SESSION['name']=$zone['id'];
// echo $zone['name'];

// echo "登录成功！<br/>";
// header("refresh:3;url=/main.php");
// print('正在加载，请稍等...<br>3秒后自动跳转。');

// echo "<br/><a href='/main.php'>马上进入</a>";
// }else{
// echo "登录失败<br/>请检查密码手机号是否正确<br/><a href='/login?my=mblogin'>点击重新登录</a><br/>";
// }
// }


if ($my==""){
echo"<img src='/Logo.jpg'  alt='魔神传说' /><br/>";

echo "玩神话Q传交天下朋友，寻找童年的伙伴。<br/>";
echo "<br/><a href='/login?my=login'>登录游戏</a>";
echo " | <a href='/login?my=reg'>注册账号</a><br/><img src='/img/guanfang.jpg'/>";
//获取公告
//获取当前地图NPC
$result = mysqli_query($db,"select * from gonggao order by rand() limit 2");
while($row = mysqli_fetch_array($result))
  {
  echo "<br/><a href='/Activity/Article.php?id=$row[id]'><img src='/img/top.gif'  alt='$row[name]' />$row[name]</a>";
  }
echo "<br/> <img src='/img/zhiyin.jpg'/><br/><a href='/login?my=bj'>游戏背景</a>|<a href='/login?my=wf'>游戏玩法</a><br/><a href='/login?my=cw'>宠物神兵</a>";


}





if ($my=="reg"){
//$_SESSION['code']=rand(1000,999999);//生成随机验证码
$code=$_SESSION['code'];//赋值
echo"<img src='/Logo.jpg'  alt='魔神传说' /><br/>";
echo " 神话Q传欢迎你！<br/>";

echo '<form name="form1" method="post" action="login?my=ok" >
    通行证(6～16位字母和数字)：<br/><input type="text" name="name" /><!--普通文本框--><br/>
   密码(6～16位字母和数字)：<br/><input type="password" name="pass" /><!--密码框--><br/>
   验证码：';
echo"<img src=\"img.php\" onclick=\"this.src='img.php'\" title=\"点击更换\"/><br/>";
echo '<br/>输入验证码<input type="text" name="yanzheng" /><!--验证框--><br/>

      <input type="submit" value="提交注册" />
   </form>';

echo "<br/><br/>温馨提示：账号和密码只能用于登录游戏，请勿泄露。如出现被盗概不负责！";
echo "<br/><a href='/login?my=login'>登录游戏</a>";
echo " | <a href='/login?my=reg'>注册通行证</a>";

}



if ($my=="login"){
echo"<img src='/Logo.jpg'  alt='魔神传说' /><br/>";
echo " 欢迎您的到来，赶快注册账号和好友一起称霸神话世界吧！<br/>";
echo '<form name="form1" method="post" action="login?my=ko" >
        <img src="/img/kz.gif"/>通行账号：<br/><input type="text" name="name" /><!--普通文本框-->
<br/>
        <img src="/img/kz.gif"/>通行密码：<br/><input type="password" name="pass" /><!--密码框-->
<br/>';
echo"<img src=\"img.php\" onclick=\"this.src='img.php'\" title=\"点击更换\"/><br/>";
echo '<br/>输入验证码<input type="text" name="yanzheng" /><!--验证框--><br/>';

       echo' <input type="submit" value="提交登录" />
    </form>';
echo "<br/><a href='/login?my=reg'>注册账号</a>";

}
// if ($my=="mblogin"){
// echo"<img src='/Logo.jpg'  alt='魔神传说' /><br/>";
// echo " 欢迎您的到来，赶快注册账号和好友一起称霸神话世界吧！<br/>";
// echo '<form name="form1" method="post" action="login?my=mbko" >
//         <img src="/img/kz.gif"/>手机号：<br/><input type="text" name="shouji" /><!--普通文本框-->
// <br/>
//         <img src="/img/kz.gif"/>通行密码：<br/><input type="password" name="pass" /><!--密码框-->
// <br/>
//         <input type="submit" value="提交登录" />
//     </form>';
// echo "<br/><a href='/login?my=reg'>注册账号</a>";
// echo " |<a href='/login?my=login'>账号登录</a>";

// }
if($my=="wangji"){

echo"<img src='/Logo.jpg'  alt='魔神传说' /><br/>";
echo "输入密保手机和登录账号进行找回密码(手机号遗失或忘记账号将不支持找回密码)！<br/>";
echo '<form name="form1" method="post" action="login?my=wangjiko" >
        <img src="/img/kz.gif"/>密保手机号：<br/><input type="text" name="shouji" /><!--普通文本框-->
<br/>
        <img src="/img/kz.gif"/>通行账号：<br/><input type="password" name="name" /><!--密码框-->
<br/>
        <input type="submit" value="确定找回" />
    </form>';
echo "<br/><a href='/login?my=reg'>注册账号</a>";
echo " |<a href='/login?my=login'>账号登录</a>";


}




if($my=="bj"){
echo " <br/>【游戏背景】<br/>";
echo"你穿越时空来到了神话世界，在神话体验之旅中，你将会获得遗落在时空隧道中的黄金套装高仿品，有金在手，可以令你交友、打怪、比武、升级等等一切变得更加容易！";
}
if($my=="cw"){
echo " <br/>【宠物神兵】<br/>";
echo"神话Q传游戏中有上百种成就称号，完成相应的成就不但可以永久提升角色基础属性，还可以获得对应的称号。要知道做任务才是升级的王道啊！神话Q传游戏中的任务多种多样， 分为高经验奖励的主线任务还有多种支线任务、活动任务、帮派任务、可重复活动活动、日常任务等。其中的任务剧情可要细细品味啊！";
}
if($my=="wf"){
echo " <br/>【游戏玩法】<br/>";
echo"你和朋友正在西湖泛舟游玩，突然前方的湖底徐徐 升起一道白色的龙旋风，你还在惊叹眼前的奇观中时， 就连人带船地被卷了进去，去到了千年之前的西湖了。 为了回到未来世界，你在寻找开启时空之门钥匙的旅程 中，却被卷进了一场人、妖、鬼、仙、佛五族争夺神秘 地下宫殿的镇宫之宝的血雨腥风中，而当你历经辛苦终 于寻得钥匙可以穿越时空回到未来世界之时，却面临了 一个很难的抉择，是留在前世不再回到未来世界，是忘 记前世记忆回到未来世界，是保留前世记忆回到未来世 界，还是回到未来世界将高新技术带回前世……";
}

echo " <br/>【玩家动态】<br/>";

$exec="select * from news order by id desc limit 3"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$xtuser=mysqli_query($db,"SELECT * FROM users WHERE id='".$row[userid]."'");
$xtuser=mysqli_fetch_array($xtuser);
echo  "<a href='/user.php?id=$xtuser[id]'>$xtuser[name]</a>$row[text]<br/>";
}
echo " <br/><a href='/login'>游戏首页</a>";






?>