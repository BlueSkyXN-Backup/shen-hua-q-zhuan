<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
//设置页面html默认字符编码集为utf-8
header('content-type:text/html;charset=utf-8');
$host = 'localhost';
$userName = 'game';
$password = '3648199832';
$dbName = 'game';
$db=mysqli_connect($host,$userName,$password,$dbName);
// 检查连接
if (!$db)
{
    die("连接错误: " . mysqli_connect_error());
} 