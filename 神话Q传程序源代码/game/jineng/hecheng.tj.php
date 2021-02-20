<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$jibie=$_GET['jibie'];

echo "选择您拥有的宝石等级:<a href='hecheng.tj?jibie=1&zhuangbei=".$id."&kong=".$kong."'>1级</a>|<a href='hecheng.tj?jibie=2&zhuangbei=".$id."&kong=".$kong."'>2级</a>|<a href='hecheng.tj?jibie=3&zhuangbei=".$id."&kong=".$kong."'>3级</a>|<a href='hecheng.tj?jibie=4&zhuangbei=".$id."&kong=".$kong."'>4级</a>|<a href='hecheng.tj?jibie=5&zhuangbei=".$id."&kong=".$kong."'>5级</a>|<a href='hecheng.tj?jibie=6&zhuangbei=".$id."&kong=".$kong."'>6级</a>|<a href='hecheng.tj?jibie=7&zhuangbei=".$id."&kong=".$kong."'>7级</a>|<a href='hecheng.tj?jibie=8&zhuangbei=".$id."&kong=".$kong."'>8级</a>|<a href='hecheng.tj?jibie=9&zhuangbei=".$id."&kong=".$kong."'>9级</a>|<a href='hecheng.tj?jibie=10&zhuangbei=".$id."&kong=".$kong."'>10级</a><br/>";

if(!$jibie){$jibie="1";}
if(preg_match('/^[0-9]+$/u',$jibie)){
$exec="select * from xiangqian WHERE dengji='".$jibie."' order by dengji ASC limit 10"; 
$result=mysqli_query($db,$exec); 

while($row=mysqli_fetch_array($result)){ 
$xq6=$xiangqian->xianshi($row[xiangqian]);
 $xxxss=explode("|",$xq6); 
echo $xxxss[1]."级".$xxxss[2]."+".$xxxss[0].$xxxss[3]."<br/>";	
	
}
echo"<br/>";
}
	echo "<br/><a href='hecheng
'>宝石合成</a><br/>----------<br/><a href='/map.games
'>返回地图</a><br/>";
echo footer();