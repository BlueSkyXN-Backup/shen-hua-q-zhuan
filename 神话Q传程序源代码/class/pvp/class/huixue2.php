<?php
   
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
//人族回血队友
//打怪中的普通攻击代码
$shuliang="0";
foreach($list as $ks=>$zd){


//只复活队友
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
if($guaiwu[qixue]<"1"){
    continue;
}

	$shuliang+="1";
	if($shuliang>$jineng_u[2]){
		break;//跳出循环
		}
	//开始回血
if($jineng_u[3]=="wu"){
$zhandou_gongji=$pkuser[gongji];
}else{
$zhandou_gongji=$pkuser[gongji_fa];
}
	$huixues=$zhandou_gongji*$jineng_u[7];

	$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."对".$guaiwu[username]."使用了".$jineng_u[5]."','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);
//开始攻击
$guaiwu[qixue]+=$huixues;
		if($zhandou0['0']=="user"){
			//人物对象
$sql1="update users set qixue='".$guaiwu[qixue]."'where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhandou0['0']=="pet"){
	//宠物对象	
$sql1="update pet set qixue='".$guaiwu[qixue]."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);
}elseif($zhandou0['0']=="guaiwu"){
	//宠物对象	
$sql1="update guaiwu set qixue='".$guaiwu[qixue]."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);
}
	$s0="insert into pvp_tip(text,cid,time) values('".$$guaiwu[username]."恢复".$huixues."点气血。','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);
//获取敌方对象结束
}




}