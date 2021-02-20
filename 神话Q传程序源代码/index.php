
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
 <title>神话Q传</title>
<link rel="stylesheet" href="//game.wap.xyz/css/xyz.css"> 
<link rel="stylesheet" href="//game.wap.xyz/css/xyz9.css"> 
<link rel="stylesheet" href="//game.wap.xyz/css/denglong.css"> 
<link rel="stylesheet" href="//game.wap.xyz/css/zmh.css"> 
<script type="text/javascript" src="//game.wap.xyz/css/jquery.min.js"></script>
<style>


@-webkit-keyframes snow {
0% {
background-position:0 0, 0 0
}
100% {
background-position:500px 500px, 1000px 500px
}
}
@keyframes snow {
0% {
background-position:0 0, 0 0
}
100% {
background-position:500px 500px, 1000px 500px
}
}
.container {
	box-shadow: 0 0 4px 3px rgba(0,0,0,.05);
}
#snowMask {
	position: fixed;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	background: url(//game.wap.xyz/img/snow1.png),url(//game.wap.xyz/img/snow2.png);
	-webkit-animation: 10s snow linear infinite;
	animation: 10s snow linear infinite;
	pointer-events: none;
	z-index: 9999;
}


</style>






</head>
<body class="body">
    

<wap id="canvas">
<?php
session_start();
//获得奖励几率
if($_SERVER['users']!="1"){
    error_reporting(E_ALL^E_NOTICE^E_WARNING);
}
 /** wapwork文字网游框架
 * 作者:wapwork
 * 官网：http://wap.work
 *
 * 作者允许您转载和使用，但必须注明来自wapwork框架。
 */
/********************************************
 wapwork架启动的初始设置
 *******************************************/

define('wapxyz', 'www.wap.xyz');
include $_SERVER['DOCUMENT_ROOT']."/class/config.php";//配置文件
//全局通用数组
global $_G;
$_G= array();//创建全局数组
session_start();
$userid=$_SESSION['users'];
if(!isset($_SESSION['md5'])){//判断是否存在$_SESSION
$_SESSION['md5']=md5(md5(time()));
}
$_G[md5]=$_SESSION['md5'];

/** 引入文件**/
if(file_exists($_SERVER['DOCUMENT_ROOT']."/game/".$_GET['xyz'].".php")){
if($_GET['xyz']){
include $_SERVER['DOCUMENT_ROOT']."/game/".$_GET['xyz'].".php";
}else{
	//默认访问首页
include $_SERVER['DOCUMENT_ROOT']."/game/reg.do.php";
}
}else{
	//文件不存在404
include $_SERVER['DOCUMENT_ROOT']."/game/reg.do.php";
}
//全局末尾的加密函数

// echo'<br/><a target="_blank" href="https://qm.qq.com/cgi-bin/qm/qr?k=SLZ7EiCLpTIlQ1_qFOu3hYvud0iOvYzE&jump_from=webapi">QQ群组:512126565</a>'; 
if(isset($_SESSION['users'])){//判断是否存在$_SESSION
$sql1="update users set  time='".time()."' where id='".$_SESSION['users']."'";
$ok=mysqli_query($db,$sql1);
}
?>
<div id="snowMask"></div>
<script>
var a_idx = 0;
jQuery(document).ready(function($) {
    $("body").click(function(e) {
        var a = new Array("春节", "除夕", "恭喜发财", "万事如意", "Music", "666");
        var $i = $("<span />").text(a[a_idx]);
        a_idx = (a_idx + 1) % a.length;
        var x = e.pageX,
            y = e.pageY;
        $i.css({
            "z-index": 99999,
            "top": y - 20,
            "left": x,
            "position": "absolute",
            "font-weight": "bold",
            "color": "#ff6651"
        });
        $("body").append($i);
        $i.animate({
                "top": y - 180,
                "opacity": 0
            },
            1500,
            function() {
                $i.remove();
            });
    });
});</script>
</body>
</html>