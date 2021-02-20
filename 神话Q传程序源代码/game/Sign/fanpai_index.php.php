<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";

 echo "<a href='fanpai.php'>进行金条翻牌</a><br/> ";
echo "<a href='fanpai_xy.php'>进行幸运卡翻牌</a><br/> ";

echo "温馨提示：翻牌每次消耗金币或者幸运卡，能够随机获得奖励。<br/> ";

echo footer();


?>