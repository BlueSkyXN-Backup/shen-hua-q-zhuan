# shen-hua-q-zhuan
童年WAP页游-神话Q传

作者原文：

这个是几年前写的，写之前没有明确计划，后台改改改的越来越看不懂了。
打算重新写一遍程序。旧版本就分享出了

http://wap.xyz/read-25-1.html

安装说明 推荐NPGNX1.2+PHP5.6+MYSQL5.6+REDIS 

下载源码解压到网站根目录。 

打开class/db.php修改数据库链接，只需要修改第一个数据库链接。 

如果是APACHE写入伪静态

RewriteEngine on

RewriteBase / 

RewriteCond %{REQUEST_FILENAME} !-d 

RewriteCond %{REQUEST_FILENAME} !-f 

RewriteRule ^(.*)$ index.php?xyz=$1 [QSA,PT,L]

Nignx伪静态

if (!-d $request_filename){ set $rule_0 1$rule_0; } 

if (!-f $request_filename){ set $rule_0 2$rule_0; } 

if ($rule_0 = "21"){ rewrite ^/(.*)$ /index.php?xyz=$1 last; }


