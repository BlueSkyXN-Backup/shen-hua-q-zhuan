<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";


$get_x=$_GET['x'];
$get_y=$_GET['y'];
$get_z=$_GET['z'];
$get_name=$_POST['name'];
$get_img=$_POST['img'];
$get_text=$_POST['text'];
$get_guaiwu=$_POST['guaiwu'];
$get_my=$_GET['my'];
if(!isset($_SESSION['users'])){//判断是否存在$_SESSION
header("location:../reg.php");//跳转地址
exit();//结束
}
$userid=$_SESSION['users'];
if ($userid=="1"){
}else{
header("location:../reg.php");//跳转地址
exit();//结束
}
$resultl = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$my = mysqli_fetch_array($resultl);
if ($my){
}else{
header("location:../reg.php");//跳转地址
exit();//结束
}

$map = mysqli_query($db,"SELECT * FROM map WHERE x='".$get_x."' and y='".$get_y."' and z='".$get_z."'");
$map = mysqli_fetch_array($map);
echo $map[id];
if($get_my=="ok"){
$resultl = mysqli_query($db,"SELECT * FROM map WHERE x='".$get_x."' and y='".$get_y."' and z='".$get_z."'");
$my = mysqli_fetch_array($resultl);
if (!$my){
//新增地图
$s="insert into map(name,text,img,x,y,z,guaiwu) values('".$get_name."','".$get_text."','".$get_img."','".$get_x."','".$get_y."','".$get_z."','".$get_guaiwu."')";
$ok=mysqli_query($db,$s);
if ($ok){
echo "新增成功!<br/>";
}else{
echo "新增失败!<br/>";
}
}else{
//修改地图

$sql2="update map set name='".$get_name."',text='".$get_text."',img='".$get_img."',x='".$get_x."',y='".$get_y."',z='".$get_z."',guaiwu='".$get_guaiwu."' where id='".$map[id]."'";
$ok=mysqli_query($db,$sql2);
if ($ok){
echo "资料修改成功!<br/>";
}else{
echo "资料修改失败!<br/>";
}
}
}else{
}

$map = mysqli_query($db,"SELECT * FROM map WHERE x='".$get_x."' and y='".$get_y."' and z='".$get_z."'");
$map = mysqli_fetch_array($map);

//获取地图坐标
$x=$get_x;//地图x坐标
$y=$get_y;//地图y坐标
$z=$get_z;//地图y坐标
$user = mysqli_query($db,"SELECT * FROM users WHERE userid='".$userid."'");
$user = mysqli_fetch_array($user);

if ($_SESSION['users']
==""){
echo "请登录！！";
}else{
echo "$map[name] ($x,$y)  <a href='/manye/map?x=$get_x&y=$get_y&z=$get_z'>刷新</a><br/>$map[text]<br/><br/>";
}

echo "你看见了：<br/>";
if($map[img]=="0"){
}else{
echo"<img src='/img/$map[img]'  alt='$map[name]' /><br/>";
}









//地图方向

//北方
$bei_x=$x;
$bei_x-=1;
$shang = mysqli_query($db,"SELECT * FROM map WHERE x='".$bei_x."' and y='".$y."' and z='".$z."'");
$shang = mysqli_fetch_array($shang);
if(!$shang[name]){
$shang[name]="未有地图";
}
$shang= "<br/>↑：<a href='/manye/map?x=".$bei_x."&y=".$y."&z=".$z."'>$shang[name]</a>";



//南方
$nan_x=$x;
$nan_x+=1;
$xia = mysqli_query($db,"SELECT * FROM map WHERE x='".$nan_x."' and y='".$y."' and z='".$z."'");
$xia = mysqli_fetch_array($xia);
if(!$xia[name]){
$xia[name]="未有地图";
}

$xia= "<br/>↓：<a href='/manye/map?x=".$nan_x."&y=".$y."&z=".$z."'>$xia[name]</a>";


//西方
$xi_y=$y;
$xi_y-=1;
$zuo = mysqli_query($db,"SELECT * FROM map WHERE x='".$x."' and y='".$xi_y."' and z='".$z."'");
$zuo = mysqli_fetch_array($zuo);
if(!$zuo[name]){
$zuo[name]="未有地图";
}
$zuo= "<br/>←：<a href='/manye/map?x=".$x."&y=".$xi_y."&z=".$z."'>$zuo[name]</a>";



//东方
$dong_y=$y;
$dong_y+=1;
$you = mysqli_query($db,"SELECT * FROM map WHERE x='".$x."' and y='".$dong_y."' and z='".$z."'");
$you = mysqli_fetch_array($you);
if(!$you[name]){
$you[name]="未有地图";
}

$you= "<br/>→：<a href='/manye/map?x=".$x."&y=".$dong_y."&z=".$z."'>$you[name]</a>";


//东方
$tian_z=$z;
$tian_z+=1;
$tian = mysqli_query($db,"SELECT * FROM map WHERE x='".$x."' and y='".$y."' and z='".$tian_z."'");
$tian = mysqli_fetch_array($tian);
if(!$tian[name]){
$tian[name]="未有地图";
}

$tian= "<br/>天：<a href='/manye/map?x=".$x."&y=".$y."&z=".$tian_z."'>$tian[name]</a>";

$di_z=$z;
$di_z-=1;
$di = mysqli_query($db,"SELECT * FROM map WHERE x='".$x."' and y='".$y."' and z='".$di_z."'");
$di = mysqli_fetch_array($di);
if(!$di[name]){
$di[name]="未有地图";
}

$di= "<br/>地：<a href='/manye/map?x=".$x."&y=".$y."&z=".$di_z."'>$di[name]</a>";




//地图显示
$html=<<<HTML

$guaiwu
<br/>
$shang
$xia
$zuo
$you
$tian
$di

<br/><br/>
HTML;

echo $html;

echo "<form action='./map?x=$get_x&y=$get_y&z=$get_z&my=ok' method='post'>";
echo "地图名称:<br/>";
echo "<input name='name' maxlength='100' value='$map[name]'/><br/>";
echo "图片地址:<br/>";
echo "<input name='img' maxlength='100' value='$map[img]'/><br/>";
echo "地图怪物:<br/>";
echo "<input name='guaiwu' maxlength='100' value='$map[guaiwu]'/><br/>";
echo "地图简介:<br/>";
echo "<textarea name=\"text\" id=\"Content\" rows=\"3\">$map[text]</textarea><br/>";
echo '<input type="submit" value="确定修改" class="submit"/></form>';



echo "<br/><br/><br/><a href='./npc?id=$map[id]'>NPC管理</a><br/>";
$jjj=time()-600;
$exec="select * from users  WHERE time>'".$jjj."' order by rand() limit 40"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
echo "<br/>".user_name($row[id]);
}

echo "<br/><br/><br/><a href='/map.games?id=$map[id]'>返回地图</a><br/>";

?>
