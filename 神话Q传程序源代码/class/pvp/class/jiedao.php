<?php
   
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
//借刀杀人
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
	//技能效果对大boss无效
if($guaiwu[boss]=="yes"){
	$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."使用了".$jineng_u[5].",".$guaiwu[username]."免疫该技能！','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);
}else{
	$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."对".$guaiwu[username]."使用了".$jineng_u[5]."','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);

		if($zhandou0['0']=="user"){
			//人物对象
$sql1="update users set zhandou_jiedao='1' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhandou0['0']=="pet"){
	//宠物对象	
$sql1="update pet set zhandou_jiedao='1' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhandou0['0']=="guaiwu"){
	//宠物对象	
$sql1="update guaiwu set zhandou_jiedao='1' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}
}
//获取敌方对象结束
}else{	
    $s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."速度太慢了，".$guaiwu[username]."完美闪避技能！','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);
}
}




}}