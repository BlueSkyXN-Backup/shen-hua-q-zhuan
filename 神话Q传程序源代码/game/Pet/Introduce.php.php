<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
$id=$_GET['id'];
if(preg_match('/^[0-9]+$/u',$id)) {
}else{
echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/>";
exit(宠物id只能是数字);//结束
}
$my = mysqli_query($db,"SELECT * FROM pet WHERE userid='".$userid."' and id='".$id."'");
$my = mysqli_fetch_array($my);
if($my){
//显示宠物信息
echo "<b>$my[username]</b><br/>等级：$my[dengji]<br/>成长率：$my[chengzhanglv]气血：$my[qixue]<br/>法力：$my[fali]<br/>防御：$my[fangyu]<br/>法攻：$my[gongji_fa]<br/>物攻：$my[gongji]<br/>速度：$my[sudu] ";
}else{
echo "你没有这只宠物！";
}


echo "<br/><a href='/map.games?id=$user[map]'>返回地图</a>";







include "../footer.php";