<?php
   
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
//万毒攻心
$shuliang="0";
foreach($list as $ks=>$zd){


//只攻击这个对象
if($zd['duixiang']==$gongji_duixiang){

	$zhandou0= explode("|", $zd['name']); 
		if($zhandou0['0']=="user"){
			//人物对象
			$guaiwu = mysqli_query($db,"SELECT * FROM users WHERE id='".$zhandou0['1']."'");
$guaiwu = mysqli_fetch_array($guaiwu);
}elseif($zhandou0['0']=="pet"){
	//宠物对象
	$guaiwu = mysqli_query($db,"SELECT * FROM pet WHERE id='".$zhandou0['1']."'");
$guaiwu = mysqli_fetch_array($guaiwu);
}elseif($zhandou0['0']=="guaiwu"){
	//宠物对象
	$guaiwu = mysqli_query($db,"SELECT * FROM guaiwu WHERE id='".$zhandou0['1']."'");
$guaiwu = mysqli_fetch_array($guaiwu);
}

if($guaiwu[qixue]>"0"){
	$shuliang+="1";
	if($shuliang>$jineng_u['2']){
		break;//跳出循环
	}

if(zhandou_sudu($pkuser[sudu],$guaiwu[sudu])=="yes"){

//开始攻击
if($jineng_u[3]=="wu"){
$zhandou_gongji=$pkuser[gongji];
}else{
$zhandou_gongji=$pkuser[gongji_fa];
}//获取技能是法术还是物理

if($zhandou_gongji>$guaiwu[fangyu] ||$pkuser[pojia]>"0"){
	//有伤害
$zhandou_gongji-=$guaiwu[fangyu];
if($zhandou_gongji<"1"){
	$zhandou_gongji="0";
}
$zhandou_gongji+=$pkuser[pojia];//破甲
$mianshang=100-$guaiwu[mianshang];
$mianshang/=100;
$zhandou_gongji*=$mianshang;
if($zhandou_gongji<"1"){
	$zhandou_gongji="1";
}
$pojia_text=null;
if($pkuser[pojia]>"0"){
    $pkuser_pojia=$pkuser[pojia]*$mianshang;
    $pojia_text="(+".$pkuser_pojia."破甲)";
}

$guaiwu[qixue]-=$zhandou_gongji;
	$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."对".$guaiwu[username]."使用了".$jineng_u[5].",".$guaiwu[username]."下回合将受到".$zhandou_gongji.$pojia_text."点伤害，并持续".$jineng_u[0]."回合！','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);
//boss伤害获取经验
if($guaiwu[boss]=="yes"){
	$zhandou_jingyan=$zhandou_gongji*0.6;
	$zhandou_jingyan=floor($zhandou_jingyan);
	$pkuser[jingyan]+=$zhandou_jingyan;
}
//数据写入数据库
if($guaiwu[boss]=="yes"){
	if($zhadou_yuanshi['0']=="user"){
			//人物对象
$sql1="update users set jingyan='".$pkuser[jingyan]."' where id='".$pkuser[id]."'";
$ok=mysqli_query($db,$sql1);
	$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."获得".$zhandou_jingyan."点经验！','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);
}elseif($zhadou_yuanshi['0']=="pet"){
	//宠物对象	
$sql1="update pet set jingyan='".$pkuser[jingyan]."' where id='".$pkuser[id]."'";
$ok=mysqli_query($db,$sql1);
	$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."获得".$zhandou_jingyan."点经验！','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);
}
}
		
			$s="insert into zhandou_du(userid,leixing,huihe,shanghai) values('".$zhandou0['1']."','".$zhandou0['0']."','".$jineng_u[0]."','".$zhandou_gongji."')";
$ok=mysqli_query($db,$s);
}else{
	//无伤害
		$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."对".$guaiwu[username]."使用了".$jineng_u[5].",没有对".$guaiwu[username]."造成伤害！','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);
}


//获取敌方对象结束
}else{	
    $s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."速度太慢了，".$guaiwu[username]."完美闪避技能！','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);
}
}




}}