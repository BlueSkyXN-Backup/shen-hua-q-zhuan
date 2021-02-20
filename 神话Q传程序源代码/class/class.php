<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
//此文件加入到玩家功能页面
if(!isset($_SESSION['users'])){//判断是否存在$_SESSION
header("location:../main.do");//跳转地址
exit();//结束
}
// if($userid!="1"){
//     echo "维护中。预计2月9日18时结束。";
//     exit();
// }
$cid=$_SESSION['name'];
$userid=$_SESSION['users'];
$user = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'"));
//爵位

    //代理IP直接退出  
empty($_SERVER['HTTP_VIA']) or exit('Access Denied');  
//if($user[juewei]<"1"){
 //if($_SERVER['HTTP_CONNECTION']=="Keep-Alive"){
  //echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a><br/>";
    //     exit('Access Denied.你的当前用户组不允许使用自动浏览器。');  
//}}

if($user[juewei]<"2"){
    
//防止快速刷新  
  
$seconds = '6'; //时间段[秒]  
$refresh = '8'; //刷新次数  
//设置监控变量  
$cur_time = time();  
if(isset($_SESSION['last_time'])){  
    $_SESSION['refresh_times'] += 1;  
}else{  
    $_SESSION['refresh_times'] = 1;  
    $_SESSION['last_time'] = $cur_time;  
}  
//处理监控结果  
if($cur_time - $_SESSION['last_time'] < $seconds){  
    if($_SESSION['refresh_times'] >= $refresh){  
//echo"警告！你的当前浏览器存在安全漏洞会泄露你的隐私资料。请更换其他安全浏览器访问。<br/>推荐：UC浏览器、QQ浏览器、手机系统浏览器<br/>游戏永久地址:http://s.wap.xyz<br/>";
echo "<a href='/map.games?id=".$zhuangtai_map."'>返回地图</a><br/>";
        exit('Access Denied.点击过快！请稍等2秒再刷新页面');  
    }  
}else{  
    $_SESSION['refresh_times'] = 0;  
    $_SESSION['last_time'] = $cur_time;  
}
}
////////剧情文件输入
if($juqingtext = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM juqing WHERE dengji='".$user['juqing']."'"))){
	//判定是否是特殊对话
	if($juqingtext['leixng']=="0"){
	echo $juqingtext['text_0'];
	}else{
	echo $juqingtext['text_'.$user[sex]];	
	}
	$user['juqing']+=1;
	mysqli_query($db,"update users set juqing='".$user['juqing']."' where id='".$userid."'");
	exit();
}



if($user['sid']!=$_SESSION['sid']){
echo "你的账号已在别处登录,你被挤掉线了！<a href='/reg.php'>重新登录</a>";
unset($_SESSION['name']);
unset($_SESSION['users']);
unset($_SESSION['sid']);
exit();//结束
}
	
	if($user[fenghao]>time()){
	$user[fenghao]-=time();
	$user[fenghao]=timesecond($user[fenghao]);
echo "账号已经被系统冻结。".$user[fenghao]."后自动解封。<br/><a href='/reg.do'>返回地图主页</a>";
unset($_SESSION['name']);
unset($_SESSION['users']);
unset($_SESSION['sid']);
exit();//结束
}

//脱离战斗状态
//计算属性
if($user[mys]=="map"){
shuxing($userid,users);
}
//限制当前气血
if($user[qixue]>$user[qixuemax]){
$user[qixue]=$user[qixuemax];
$sql4="update users set qixue='".$user[qixue]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql4);//更新人物状态
}
 

//设置人物和宠物死亡状态
$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);
if($user[qixue]<"1" ){
$user[zhuangtai]="no";
$sql4="update users set zhuangtai='".$user[zhuangtai]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql4);//更新人物状态
}
if($user[zhuangtai]=="no" ){
$sql4="update users set qixue='0' where id='".$userid."'";
$ok=mysqli_query($db,$sql4);//更新人物状态
}

//获取用户出站宠物数据宠物
if($user[chongwu_id]!="0"){
$chongwu= mysqli_query($db,"SELECT * FROM pet WHERE userid='".$userid."' and id='".$user[chongwu_id]."'");
$chongwu= mysqli_fetch_array($chongwu);
}else{
$chongwu[zhuangtai]="no";
	
}
if($chongwu){
//宠物存在
//计算属性
if($user[mys]=="map"){
shuxing($user[chongwu_id],pet);
}
if($chongwu[qixue]<"1" ){
$chongwu[zhuangtai]="no";
$sql4="update pet set zhuangtai='".$chongwu[zhuangtai]."' where id='".$user[chongwu_id]."'";
$ok=mysqli_query($db,$sql4);//更新宠物状态
}else{
    //限制当前气血
if($chongwu[qixue]>$chongwu[qixuemax]){
$chongwu[qixue]=$chongwu[qixuemax];
$sql4="update pet set qixue='".$chongwu[qixue]."' where id='".$chongwu[id]."'";
$ok=mysqli_query($db,$sql4);//更新人物状态
}
}
    
}else{
//宠物不存在
if($user[chongwu_id]!="0"){
$user[chongwu_id]="0";
$sql4="update users set chongwu_id='".$user[chongwu_id]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql4);//
}
}

//重置用户快捷不存在物品
	for($k=1;$k<6;$k++) 
{
$result = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and id='".$user['kj'.$k]."'");
$kj = mysqli_fetch_array($result);
if(!$kj){
//未设置
  $my_yao='kj'.$k;
  $sql1="update users set $my_yao='0' where id='".$userid."'";
$ok=mysqli_query($db,$sql1);
}
}
  //查看队伍是否解散
  if($user[duiwu_id]!=NULL){
  $result = mysqli_query($db,"SELECT * FROM duiwu WHERE id='".$user[duiwu_id]."' ");
$duiwu= mysqli_fetch_array($result);
    //队伍不存在更新用户队伍ID
    if(!$duiwu){
      $sql1="update users set duiwu_id=null where id='".$userid."'";
$ok=mysqli_query($db,$sql1);
    }
  
  }
//转跳pk
$resultl = mysqli_query($db,"SELECT * FROM pk WHERE userid='".$userid."' or npcid='".$userid."'");
$pk= mysqli_fetch_array($resultl);
if($pk){
    if($pk_go!="yes"){
header("location:../pve/pk.do");//跳转地址
}
}
