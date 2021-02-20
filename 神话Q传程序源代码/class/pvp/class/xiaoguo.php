<?php
   
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}

//鬼族用毒效果
if($pkuser[zhandou_du]>"0"){
$pkuser[zhandou_du]-="1";
$pkuser[qixue]-=$pkuser[zhandou_dushang];
if($zhandou0['0']=="user"){
			//人物对象
$sql1="update users set qixue='".$pkuser[qixue]."',zhandou_du='".$pkuser[zhandou_du]."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhandou0['0']=="pet"){
	//宠物对象	
$sql1="update pet set qixue='".$pkuser[qixue]."',zhandou_du='".$pkuser[zhandou_du]."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhandou0['0']=="guaiwu"){
	//宠物对象	
$sql1="update pet set qixue='".$pkuser[qixue]."',zhandou_du='".$pkuser[zhandou_du]."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}

	$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."受毒伤持续中，受到".$pkuser[zhandou_dushang]."点持续伤害。','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);

if($pkuser[qixue]<"1"){
    	$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."被打死了。','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);

		continue;//跳出循环
	}

}



//妖族借刀效果
if($pkuser[zhandou_jiedao]>"0"){
$gongji_duixiang=$vs['duixiang'];
$pkuser[zhandou_jiedao]-="1";
if($zhandou0['0']=="user"){
			//人物对象
$sql1="update users set zhandou_jiedao='".$pkuser[zhandou_jiedao]."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhandou0['0']=="pet"){
	//宠物对象	
$sql1="update pet set zhandou_jiedao='".$pkuser[zhandou_jiedao]."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhandou0['0']=="guaiwu"){
	//宠物对象	
$sql1="update pet set zhandou_jiedao='".$pkuser[zhandou_jiedao]."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}

	$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."受魅惑持续中，将攻击队友。','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);


}

//佛族封印效果
if($pkuser[zhandou_fengyin]>"0"){

$pkuser[zhandou_fengyin]-="1";
if($zhandou0['0']=="user"){
			//人物对象
$sql1="update users set zhandou_fengyin='".$pkuser[zhandou_fengyin]."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhandou0['0']=="pet"){
	//宠物对象	
$sql1="update pet set zhandou_fengyin='".$pkuser[zhandou_fengyin]."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhandou0['0']=="guaiwu"){
	//宠物对象	
$sql1="update pet set zhandou_fengyin='".$pkuser[zhandou_fengyin]."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}


	$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."受封印效果持续中，该回合沉默。','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);

continue;//跳出循环
	

}



