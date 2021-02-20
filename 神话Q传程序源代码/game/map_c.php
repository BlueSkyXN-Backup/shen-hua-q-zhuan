<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$mapid=$_GET['id'];
$baoxiang=$_GET['baoxiang'];
$userid=$_SESSION['users'];



$map = mysqli_query($db,"SELECT * FROM map WHERE id='".$mapid."'");
$map = mysqli_fetch_array($map);

$sql = "SELECT * FROM users WHERE map='".$mapid."'";
$result = mysqli_query($db,$sql);
$map_users=mysqli_num_rows($result);
$map = mysqli_query($db,"SELECT * FROM map WHERE id='".$mapid."'");
$map = mysqli_fetch_array($map);
//获取地图坐标
$x=$map[x];//地图x坐标
$y=$map[y];//地图y坐标



//地图方向

//北方
$bei_x=$x;
$bei_x-=1;
$shang = mysqli_query($db,"SELECT * FROM map WHERE x='".$bei_x."' and y='".$y."'");
$shang = mysqli_fetch_array($shang);
if ($shang[id]){
$shang0= "<a href='/map_c.php?id=$shang[id]'>$shang[name]</a>";
}
//北方
$bei_x=$x;
$bei_x-=2;
$shang = mysqli_query($db,"SELECT * FROM map WHERE x='".$bei_x."' and y='".$y."'");
$shang = mysqli_fetch_array($shang);
if ($shang[id]){
$shang1= "<a href='/map_c.php?id=$shang[id]'>$shang[name]</a>";
}
//北方
$bei_x=$x;
$bei_x-=3;
$shang = mysqli_query($db,"SELECT * FROM map WHERE x='".$bei_x."' and y='".$y."'");
$shang = mysqli_fetch_array($shang);
if ($shang[id]){
$shang2= "<a href='/map_c.php?id=$shang[id]'>$shang[name]</a>";
}


//南方
$nan_x=$x;
$nan_x+=1;
$xia = mysqli_query($db,"SELECT * FROM map WHERE x='".$nan_x."' and y='".$y."'");
$xia = mysqli_fetch_array($xia);
if ($xia[id]){
$xia0= "<a href='/map_c.php?id=$xia[id]'>$xia[name]</a>";
}
$nan_x=$x;
$nan_x+=2;
$xia = mysqli_query($db,"SELECT * FROM map WHERE x='".$nan_x."' and y='".$y."'");
$xia = mysqli_fetch_array($xia);
if ($xia[id]){
$xia1= "<a href='/map_c.php?id=$xia[id]'>$xia[name]</a>";
}
$nan_x=$x;
$nan_x+=3;
$xia = mysqli_query($db,"SELECT * FROM map WHERE x='".$nan_x."' and y='".$y."'");
$xia = mysqli_fetch_array($xia);
if ($xia[id]){
$xia2= "<a href='/map_c.php?id=$xia[id]'>$xia[name]</a>";
}

//西方
$xi_y=$y;
$xi_y-=1;
$zuo = mysqli_query($db,"SELECT * FROM map WHERE x='".$x."' and y='".$xi_y."'");
$zuo = mysqli_fetch_array($zuo);
if ($zuo[id]){
$zuo0= "<a href='/map_c.php?id=$zuo[id]'>$zuo[name]</a>";
}
$xi_y=$y;
$xi_y-=2;
$zuo = mysqli_query($db,"SELECT * FROM map WHERE x='".$x."' and y='".$xi_y."'");
$zuo = mysqli_fetch_array($zuo);
if ($zuo[id]){
$zuo1= "<a href='/map_c.php?id=$zuo[id]'>$zuo[name]</a>";
}
$xi_y=$y;
$xi_y-=3;
$zuo = mysqli_query($db,"SELECT * FROM map WHERE x='".$x."' and y='".$xi_y."'");
$zuo= mysqli_fetch_array($zuo);
if ($zuo[id]){
$zuo2= "<a href='/map_c.php?id=$zuo[id]'>$zuo[name]</a>";
}

//东方
$dong_y=$y;
$dong_y+=1;
$you = mysqli_query($db,"SELECT * FROM map WHERE x='".$x."' and y='".$dong_y."'");
$you = mysqli_fetch_array($you);
if ($you[id]){
$you0= "<a href='/map_c.php?id=$you[id]'>$you[name]</a>";
}
$dong_y=$y;
$dong_y+=2;
$you = mysqli_query($db,"SELECT * FROM map WHERE x='".$x."' and y='".$dong_y."'");
$you = mysqli_fetch_array($you);
if ($you[id]){
$you1= "<a href='/map_c.php?id=$you[id]'>$you[name]</a>";
}

$dong_y=$y;
$dong_y+=3;
$you = mysqli_query($db,"SELECT * FROM map WHERE x='".$x."' and y='".$dong_y."'");
$you = mysqli_fetch_array($you);
if ($you[id]){
$you2= "<a href='/map_c.php?id=$you[id]'>$you[name]</a>";
}


//地图显示
$html=<<<HTML

<table border="1">
<tr>
<td>Row 1, cell 1</td>
<td>Row 1, cell 1</td>
<td>Row 1, cell 2</td>
<td>$shang2</td>
<td>Row 1, cell 2</td>
<td>Row 1, cell 1</td>
<td>Row 1, cell 2</td>
</tr>
<tr>
<td>Row 1, cell 1</td>
<td>Row 1, cell 2</td>
<td>Row 1, cell 1</td>
<td>$shang1</td>
<td>Row 1, cell 1</td>
<td>Row 1, cell 2</td>
<td>Row 1, cell 1</td>
</tr>
<tr>
<td>Row 1, cell 1</td>
<td>Row 1, cell 2</td>
<td>Row 1, cell 1</td>
<td>$shang0</td>
<td>Row 1, cell 1</td>
<td>Row 1, cell 2</td>
<td>Row 1, cell 1</td>
</tr>
<tr>
<td>$zuo2</td>
<td>$zuo1</td>
<td>$zuo0</td>
<td>我的位置</td>
<td>$you0</td>
<td>$you1</td>
<td>$you2</td>
</tr>
<tr>
<td>Row 1, cell 1</td>
<td>Row 1, cell 2</td>
<td>Row 1, cell 1</td>
<td>$xia0</td>
<td>Row 1, cell 1</td>
<td>Row 1, cell 1</td>
<td>Row 1, cell 2</td>
</tr>
<tr>
<td>Row 1, cell 1</td>
<td>Row 1, cell 2</td>
<td>Row 1, cell 1</td>
<td>$xia1</td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td>$xia2</td>
<td></td>
<td></td>
<td></td>
</tr>
</table>

<br/>
当前为大地图
HTML;

echo $html;


echo "<br/><a href='/map.php?id=$mapid'>返回地图</a>";

include "footer.php";
?>
