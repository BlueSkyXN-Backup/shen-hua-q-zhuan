<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
$cid=$_SESSION['name'];
if(!isset($_SESSION['name'])){//判断是否存在$_SESSION[name]
header("location:../reg.do");//跳转地址
exit();//结束
}

$my=$_GET['my'];
$name=$_POST['name'];
$sex=$_POST['sex'];
$zhongzu=$_POST['zhongzu'];
$userid=$_SESSION['name'];
  $user = mysqli_query($db,"SELECT * FROM users WHERE userid='".$userid."'");
$user= mysqli_num_rows($user);//统计用户创建个数
if ($user<"3"){
if ($my=="ko"){
if ($sex=="" or $name==""){
echo "请先取好你的名字吧！<br/>";
}else{
if(preg_match('/^[A-Za-z0-9\x{4e00}-\x{9fa5}]+$/u',$name)){
$resultl = mysqli_query($db,"SELECT * FROM users WHERE username='".$name."'");
$my = mysqli_fetch_array($resultl);
if ($my){
echo "昵称已经被注册了！<br/>";
}else{
$s="insert into users(username,userid,map,sex,zhongzu) values('".$name."','".$userid."','1','".$sex."','".$zhongzu."')";
$ko=mysqli_query($db,$s);
if ($ko){
echo "<b>创建成功!</b><br/>";
$userid=mysqli_insert_id($db);
$s="insert into news(text,time,userid) values('加入了神话，大家快去欢迎小新吧！','".$pass."','".$userid."')";
$ok=mysqli_query($db,$s);
header("HTTP/1.1 301 Moved Permanently");

header("Location: /main.do?my=$userid");

}else{
echo "<b>创建失败!</b><br/>";
}


}
}else{
echo"昵称只能是汉字、字母和数字组成！";
}
}
}

echo '<form action="news.juese?my=ko" method="post">  
      昵称:<input type="text" name="name" maxlength="8" />
  <br/>
 种族:<select name="zhongzu" id="zhongzu">
<option value="2">人族</option>
<option value="4">佛族</option>
<option value="5">仙族</option>
<option value="3">鬼族</option>
<option value="1">妖族</option>


</select> 

<br/>
    性别:<select name="sex" id="sex">
<option value="1">帅哥</option>
<option value="0">美女</option>

</select> 

<input type="submit" class="link" value="创建角色" />
        
</form>
===========================
<br/>
【种族介绍】
<br/>
每个种族拥有不同的技能，体验不同的师门任务哦！<br/>
【鬼族】：擅长吸血用毒，战斗中吸取对手生命恢复自身生命值！且擅长用毒，对敌人造成多回合持续伤害。属性点主加：气血、法攻、防御、法力、速度、物攻<br/>
【人族】：擅长复活回血，技能能解除负面效果。属性点主加：法攻、气血、防御、法力、速度、物攻。<br>
【妖族】：擅长魅惑，战斗中使用魅惑技能能使敌人迷失攻击目标！ 属性点主加：法攻、物攻、防御、气血、法力、速度<br>
【仙族】：擅长法术群攻，战斗中使用法术群体敌人，拥有克制佛族封印的技能属性点主加：法攻、防御、气血、法力、速度、物攻<br>
【佛族】：擅长物术攻击，战斗时高额物理伤害爆发力极强，拥有封印技能。属性点主加：物攻、防御、法力、气血、速度，法攻勿加<br>

<br/>';
}else{
echo "<b>一个账号只能创建3个角色哦！</b><br/>";
}
echo "<a href='main.do'>取消创建</a><br/>";

?>
