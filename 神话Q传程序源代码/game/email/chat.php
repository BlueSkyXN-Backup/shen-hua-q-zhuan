<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$id=$_GET['id'];
$shouze=$_GET['sz'];
$my=$_GET['my'];
$userid=$_SESSION['users'];

$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);

echo "<a href='/map.games?id=".$user['map']."'>返回地图</a><br/>";
$f='1.txt';   //文件名
$a=file($f);  //把文件的所有内容获取到数组里面
$n=count($a); //获得总行数
$n-=1;
$rnd=rand(0,$n);    //产生随机行号
$rnd_line=$a[$rnd];
 $map_suijitip[0]= "[系统]$rnd_line"; //显示结果
$result = mysqli_query($db,"SELECT * FROM baoxiang order by rand() limit 1");
while($row = mysqli_fetch_array($result))
  {
$mapss = mysqli_query($db,"SELECT * FROM map WHERE id='".$row[map]."'");
$mapss = mysqli_fetch_array($mapss);

$map_suijitip[1]="[系统]<a href='/map.games?id=$row[map]'>$mapss[name]</a>突现一批宝箱！速去砸开夺得重赏！ ";
  }
$result = mysqli_query($db,"SELECT * FROM guaiwu WHERE leixing='boss' order by rand() limit 1");
while($row = mysqli_fetch_array($result))
  {
$mapss = mysqli_query($db,"SELECT * FROM map WHERE id='".$row[map]."'");
$mapss = mysqli_fetch_array($mapss);

$map_suijitip[2]="[系统]<a href='/map.games?id=$row[map]'>$mapss[name]</a>突现BOSS！速去围杀夺得重赏！ ";
  }
$map_suiji=mt_rand(0,2);
if(!$map_suijitip[$map_suiji]){
$map_suiji=0;
}
echo $map_suijitip[$map_suiji];
//获取是否有未读消息
$resultl = mysqli_query($db,"SELECT * FROM email WHERE zhuangtai='0' and userid='".$userid."'");
$email= mysqli_fetch_array($resultl);
if ($email){
$email_tip="<img src='/img/message.gif'  alt='新消息' />";
}
//获取boss打败
$time_boss=time();
$time_boss-="720";
$exec="select * from Boss_tip WHERE time>'".$time_boss."' order by time desc limit 2"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$xtuser=mysqli_query($db,"SELECT * FROM users WHERE id='".$row[userid]."'");
$xtuser=mysqli_fetch_array($xtuser);
echo  "<br/><img src='/img/laba.gif'/>".user_name($xtuser[id])."经过轮番激烈战斗击败了".$row[name]."获得<a href='/boss_tip'>巨额奖励</a>";
}

echo head();
echo "<a href='chat'>公聊</a>|<a href='/bangpai/chengyuan.php?chat=43'>帮聊</a><br/>";

if ($my=="ok"){
$text=$_GET['txt'];  
$data=date("H:i");
if($user[qixue]<"0"||$user[zhuangtai]=="no"){
echo "你已经死亡，无法发言。<br/>";
}else{
    if($user[dengji]<"25"){
echo "公聊发言需要角色25级以上。<br/>";
}else{
	  if($user[jinyan]>time()){
echo "你正在被禁言中！<br/>";
}else{
if($text==""){
echo "请勿发表空白信息<br/>";
}else{
$text=strip_tags($text);
$s="insert into chat(text,fid,time) values('".$text."','".$userid."','".$data."')";
$ok=mysqli_query($db,$s);
if ($ok){
echo "信息发送成功！<br/>";
}else{
echo "信息发送失败！<br/>";
}
}
}}
}}
echo <<<end
<form action="chat?my=ok" method="get" style='margin:0px'>
<textarea name="txt" maxlength="500"></textarea>
<input type="hidden" name="my" value="ok"/>  
<input type="submit" value="发送" class="link"/></form><a href='chat'>刷新内容</a>|<a href='chat?sz=shouze'>聊天守则</a>
<br/>
end;


$exec="select * from news order by id desc limit 1"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$xtuser=mysqli_query($db,"SELECT * FROM users WHERE id='".$row['userid']."'");
$xtuser=mysqli_fetch_array($xtuser);
echo  user_name($xtuser['id']).$row['text']."<br/>";
}
if($shouze){
   echo"【聊天守则】<br/>欢迎您参加交流和讨论，为维护网上游戏公共秩序和社会稳定，请您自觉遵守以下条款：<br/>
一、 不得利用本站危害国家安全、泄露国家秘密，不得侵犯国家社会集体的和公民的合法权益，不得利用本站制作、复制和传播非法信息！<br/>
二、互相尊重，对自己的言论和行为负责。
三、您必需同意不发表带有辱骂,淫秽,粗俗,诽谤,带有仇恨性,恐吓的,不健康的或是任何违反法律的内容！<br/>
四、不得刷屏、发布广告内容。<br/>如违反聊天守则将禁言15分钟～360小时。情节恶劣者将永久停封游戏账号。最终解释权归神话Q传运营团队所有。"; 
}else{
//聊天信息分页显示
$perNumber=16; 
$page=$_GET['page']; 

if($page>"10"){$page=10;}
$url="chat?";
$total=mysqli_fetch_array(mysqli_query($db,"select count(*) from chat")); 
$totalNumber=$total[0]; 
$totalPage=ceil($totalNumber/$perNumber); 
if (!isset($page)|| !$page) { 
$page=1; 
} 
$startCount=($page-1)*$perNumber; 
$exec="select * from chat order by id desc limit $startCount,$perNumber"; 
$result=mysqli_query($db,$exec); 
if($total==0){
echo "暂无发言!<br/>";
}else{
while($row=mysqli_fetch_array($result)){ 
$resep = mysqli_query($db,"SELECT * FROM users WHERE id='".$row['fid']."'");
$myp = mysqli_fetch_array($resep);

echo "[".$row['time']."]".user_name($myp['id'])."：".$row['text']."<br/>";

}
if($totalPage>"10"){$totalPage=10;}
echo page($url,$totalPage,$page,'');


}

}
$exec="select * from news where leibie='1' order by id desc limit 1"; 
$result=mysqli_query($db,$exec); 
while($row=mysqli_fetch_array($result)){ 
$xtuser=mysqli_query($db,"SELECT * FROM users WHERE id='".$row[userid]."'");
$xtuser=mysqli_fetch_array($xtuser);
echo  "<br/>".user_name($xtuser[id])."$row[text]<br/>";
}
echo "<a href='/map.games?id=$user[map]'>只是路过</a> <br/>";

echo "<a href='/map.games?id=$user[map]'>返回地图</a> <br/>";

?>

