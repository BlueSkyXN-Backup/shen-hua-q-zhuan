<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$mjje=2000;
$zsje=7000;
$jzje=4000;
$yzje=3000;
$wb=$_GET['wb'];


echo "<a href='/map.games?id=$user[map]'>返回地图</a><br/>当前：中级金条挖宝区<br/>";
if(!isset($wb)){
$zs=rand(1,12);
$jz=rand(1,12);
$jza=rand(1,12);
$yz=rand(1,12);
$yza=rand(1,12);
$yzb=rand(1,12);
while($zs==$jz or $zs==$jza or $zs==$yz or $zs==$yza or $zs==$yzb or $jz==$jza or $jz==$yz or $jz==$yza or $jz==$yzb or $jza==$yz or $jza==$yza or $jza==$yzb or $yz==$yza or $yz==$yzb or $yza==$yzb){
$zs=rand(1,12);
$jz=rand(1,12);
$jza=rand(1,12);
$yz=rand(1,12);
$yza=rand(1,12);
$yzb=rand(1,12);
}
$_SESSION['zs']=$zs;
$_SESSION['jz']=$jz;
$_SESSION['jza']=$jza;
$_SESSION['yz']=$yz;
$_SESSION['yza']=$yza;
$_SESSION['yzb']=$yzb;
echo "你当前的帐号共有<font color=red>".$user[gold]."</font>金币!<br />";
echo "<br />
---------------
<br />说明: 每次挖宝需要花费".$mjje."金币。<br />钻石*1，挖到将获得".$zsje."金币！<br />金子*2，若挖到金子将获得".$jzje."金币！<br />
银子*3，若挖到银子将获得".$yzje."金币！<br />地雷*6，挖到地雷将不会获得金币！
";


}
if(isset($wb)){
if(!isset($_SESSION['zs'])){
header('Location:wabao.php');
echo "<meta http-equiv='refresh' content='0;url=wabao.php'>违法刷新！<a href='wabao.php'><font color=red>点击返回挖宝首页</font></a>";

exit();
}
if($user[gold]<$mjje){
echo "对不起.你的金币少于".$mjje;
}else{
if($_SESSION['zs']==1){
$wb1="钻石";
}elseif($_SESSION['jz']==1){
$wb1="金子";
}elseif($_SESSION['jza']==1){
$wb1="金子";
}elseif($_SESSION['yz']==1){
$wb1="银子";
}elseif($_SESSION['yza']==1){
$wb1="银子";
}elseif($_SESSION['yzb']==1){
$wb1="银子";
}elseif($_SESSION['yzb']!=1){
$wb1="地雷";
}
if($_SESSION['zs']==2){
$wb2="钻石";
}elseif($_SESSION['jz']==2){
$wb2="金子";
}elseif($_SESSION['jza']==2){
$wb2="金子";
}elseif($_SESSION['yz']==2){
$wb2="银子";
}elseif($_SESSION['yza']==2){
$wb2="银子";
}elseif($_SESSION['yza']==2){
$wb2="银子";
}elseif($_SESSION['yzb']!=2){
$wb2="地雷";
}
if($_SESSION['zs']==3){
$wb3="钻石";
}elseif($_SESSION['jz']==3){
$wb3="金子";
}elseif($_SESSION['jza']==3){
$wb3="金子";
}elseif($_SESSION['yz']==3){
$wb3="银子";
}elseif($_SESSION['yza']==3){
$wb3="银子";
}elseif($_SESSION['yzb']==3){
$wb3="银子";
}elseif($_SESSION['yzb']!=3){
$wb3="地雷";
}
if($_SESSION['zs']==4){
$wb4="钻石";
}elseif($_SESSION['jz']==4){
$wb4="金子";
}elseif($_SESSION['jza']==4){
$wb4="金子";
}elseif($_SESSION['yz']==4){
$wb4="银子";
}elseif($_SESSION['yza']==4){
$wb4="银子";
}elseif($_SESSION['yzb']==4){
$wb4="银子";
}elseif($_SESSION['yzb']!=4){
$wb4="地雷";
}
if($_SESSION['zs']==5){
$wb5="钻石";
}elseif($_SESSION['jz']==5){
$wb5="金子";
}elseif($_SESSION['jza']==5){
$wb5="金子";
}elseif($_SESSION['yz']==5){
$wb5="银子";
}elseif($_SESSION['yza']==5){
$wb5="银子";
}elseif($_SESSION['yzb']==5){
$wb5="银子";
}elseif($_SESSION['yzb']!=5){
$wb5="地雷";
}
if($_SESSION['zs']==6){
$wb6="钻石";
}elseif($_SESSION['jz']==6){
$wb6="金子";
}elseif($_SESSION['jza']==6){
$wb6="金子";
}elseif($_SESSION['yz']==6){
$wb6="银子";
}elseif($_SESSION['yza']==6){
$wb6="银子";
}elseif($_SESSION['yzb']==6){
$wb6="银子";
}elseif($_SESSION['yzb']!=6){
$wb6="地雷";
}
if($_SESSION['zs']==7){
$wb7="钻石";
}elseif($_SESSION['jz']==7){
$wb7="金子";
}elseif($_SESSION['jza']==7){
$wb7="金子";
}elseif($_SESSION['yz']==7){
$wb7="银子";
}elseif($_SESSION['yza']==7){
$wb7="银子";
}elseif($_SESSION['yzb']==7){
$wb7="银子";
}elseif($_SESSION['yzb']!=7){
$wb7="地雷";
}
if($_SESSION['zs']==8){
$wb8="钻石";
}elseif($_SESSION['jz']==8){
$wb8="金子";
}elseif($_SESSION['jza']==8){
$wb8="金子";
}elseif($_SESSION['yz']==8){
$wb8="银子";
}elseif($_SESSION['yza']==8){
$wb8="银子";
}elseif($_SESSION['yzb']==8){
$wb8="银子";
}elseif($_SESSION['yzb']!=8){
$wb8="地雷";
}
if($_SESSION['zs']==9){
$wb9="钻石";
}elseif($_SESSION['jz']==9){
$wb9="金子";
}elseif($_SESSION['jza']==9){
$wb9="金子";
}elseif($_SESSION['yz']==9){
$wb9="银子";
}elseif($_SESSION['yza']==9){
$wb9="银子";
}elseif($_SESSION['yzb']==9){
$wb9="银子";
}elseif($_SESSION['yzb']!=9){
$wb9="地雷";
}
if($_SESSION['zs']==10){
$wb10="钻石";
}elseif($_SESSION['jz']==10){
$wb10="金子";
}elseif($_SESSION['jza']==10){
$wb10="金子";
}elseif($_SESSION['yz']==10){
$wb10="银子";
}elseif($_SESSION['yza']==10){
$wb10="银子";
}elseif($_SESSION['yzb']==10){
$wb10="银子";
}elseif($_SESSION['yzb']!=10){
$wb10="地雷";
}
if($_SESSION['zs']==11){
$wb11="钻石";
}elseif($_SESSION['jz']==11){
$wb11="金子";
}elseif($_SESSION['jza']==11){
$wb11="金子";
}elseif($_SESSION['yz']==11){
$wb11="银子";
}elseif($_SESSION['yza']==11){
$wb11="银子";
}elseif($_SESSION['yzb']==11){
$wb11="银子";
}elseif($_SESSION['yzb']!=11){
$wb11="地雷";
}
if($_SESSION['zs']==12){
$wb12="钻石";
}elseif($_SESSION['jz']==12){
$wb12="金子";
}elseif($_SESSION['jza']==12){
$wb12="金子";
}elseif($_SESSION['yz']==12){
$wb12="银子";
}elseif($_SESSION['yza']==12){
$wb12="银子";
}elseif($_SESSION['yzb']==12){
$wb12="银子";
}elseif($_SESSION['yzb']!=12){
$wb12="地雷";
}
if($wb==$_SESSION['zs']){
$user[gold]=$user[gold]-$mjje+$zsje;
mysqli_query($db,"UPDATE users SET gold='$user[gold]' WHERE id='$userid'");
echo "恭喜你挖到了钻石！获得".$zsje."金币！<br/><a href='wabao.php'>挖宝!</a>";
$s="insert into news(text,time,userid) values('在中级挖宝区挖中了钻石！','".$pass."','$userid')";
$ok=mysqli_query($db,$s);
}
if($wb==$_SESSION['jz'] or $wb==$_SESSION['jza']){
$user[gold]=$user[gold]-$mjje+$jzje;
mysqli_query($db,"UPDATE users SET gold='$user[gold]' WHERE id='$userid'");
echo "恭喜你挖到了金子，获得".$jzje."金币！<br/><a href='wabao.php'>继续挖宝</a>";
}
if($wb==$_SESSION['yz'] or $wb==$_SESSION['yza'] or $wb==$_SESSION['yzb']){
$user[gold]=$user[gold]-$mjje+$yzje;
mysqli_query($db,"UPDATE users SET gold='$user[gold]' WHERE id='$userid'");
echo "恭喜你挖到了银子！获得".$yzje."金币！<br/><a href='wabao.php'>继续挖宝</a>";
}
if($wb!=$_SESSION['zs']){
if($wb!=$_SESSION['jz']){
if($wb!=$_SESSION['jza']){
if($wb!=$_SESSION['yz']){
if($wb!=$_SESSION['yza']){
if($wb!=$_SESSION['yzb']){
$user[gold]=$user[gold]-$mjje;
mysqli_query($db,"UPDATE users SET gold='$user[gold]' WHERE id='$userid'");
echo "倒霉，挖到了地雷！<br/><a href='wabao.php'>继续挖宝</a>";
}
}
}
}
}
}
echo "<br />你当前的帐号共有<font color=red>".$user[gold]."</font>金币!";
echo "<br />".$wb1."|".$wb2."|".$wb3."|".$wb4."<br />".$wb5."|".$wb6."|".$wb7."|".$wb8."<br />".$wb9."|".$wb10."|".$wb11."|".$wb12;
unset($_SESSION['zs']);
unset($_SESSION['jz']);
unset($_SESSION['jza']);
unset($_SESSION['yz']);
unset($_SESSION['yza']);
unset($_SESSION['yzb']);

echo "<br/><a href='wabao.php'>挖宝首页</a><br/>";
echo"<br/><a href='/map.games?id=$user[map]'>返回地图</a>";

}
}
?>