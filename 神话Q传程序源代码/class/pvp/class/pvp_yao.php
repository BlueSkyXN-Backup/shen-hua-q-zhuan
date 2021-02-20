<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
$kuaijie_yaoping=NULL;
	for($k=1;$k<6;$k++) 
{
$result = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and id='".$user['kj'.$k]."'");
$kj = mysqli_fetch_array($result);
if($kj){
$result = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$kj[wupin_id]."'");
$wp= mysqli_fetch_array($result);
if($wp[kuaijie]=="yes"){
 
  $k1=$k;
  $k1+="5";
$kuaijie_yaoping.="<a href='/".php_self()."?id=$guaiwuid&pk=$pvp_md5&jn=$k1'>$wp[name]($kj[shuliang])</a>";
$kuaijie_yaoping2.="<a href='/fuben/".php_self()."?id=$guaiwuid&pk=$pvp_md5&jn=$k1'>$wp[name]($kj[shuliang])</a>";

}
}
}



if($kuaijie_yaoping==NULL){
  $kuaijie_yaoping="你未设置战斗快捷药品！";
}