<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}

include $_SERVER['DOCUMENT_ROOT']."/class/xxs.php";//xxs文件
$redis = new Redis();//初始化Redis服务器 
$redis->connect('127.0.0.1', 6379);//链接Redis服务器 
include $_SERVER['DOCUMENT_ROOT']."/class/db.php";//数据库配置文件
include $_SERVER['DOCUMENT_ROOT']."/class/huode.php";//背包物品函数配置文件
include $_SERVER['DOCUMENT_ROOT']."/class/function.php";//通用函数配置文件
include $_SERVER['DOCUMENT_ROOT']."/class/renwu_function.php";//任务函数配置文件
include $_SERVER['DOCUMENT_ROOT']."/class/user.php";//用户充值配置文件
$chongzhi_jinermb="100";//充值金额
?>