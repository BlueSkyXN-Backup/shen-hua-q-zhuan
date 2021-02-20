<?php
   
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
//仙族免疫控制
$shuliang="0";
foreach($list as $ks=>$zd){


//对队友
if($zd['duixiang']==$vs['duixiang']){

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

	$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."对".$guaiwu[username]."使用了".$jineng_u[5]."，获得免控效果".$jineng_u['0']."次！','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);

		if($zhandou0['0']=="user"){
			//人物对象
$sql1="update users set zhandou_mianyi='".$jineng_u['0']."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhandou0['0']=="pet"){
	//宠物对象	
$sql1="update pet set zhandou_mianyi='".$jineng_u['0']."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhandou0['0']=="guaiwu"){
	//宠物对象	
$sql1="update guaiwu set zhandou_mianyi='".$jineng_u['0']."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}

//获取敌方对象结束
}
}
}