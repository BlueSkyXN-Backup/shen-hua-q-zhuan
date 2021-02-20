<?php
   
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
//圣诞冰封 有30%几率封印对手
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
	
	
	//开始攻击
if($jineng_u[3]=="wu"){
$zhandou_gongji=$pkuser[gongji];
}else{
$zhandou_gongji=$pkuser[gongji_fa];
}
//获取技能是法术还是物理
for ($c=0;$c<$jineng_u['0'];$c++) 
{
if($zhandou_gongji>$guaiwu[fangyu] ||$pkuser[pojia]>"0" ||$jineng_u['10']>'0'){
	//有伤害
$zhandou_shanghai=$zhandou_gongji-$guaiwu[fangyu];
if($zhandou_shanghai<"1"){
	$zhandou_shanghai="0";
}

$zhandou_shanghai+=$jineng_u['10'];
$zhandou_shanghai*=$jineng_u['9'];
$zhandou_shanghai+=$pkuser[pojia];//破甲
$mianshang=100-$guaiwu[mianshang];
$mianshang/=100;
$zhandou_shanghai*=$mianshang;
if($zhandou_shanghai<"1"){
	$zhandou_shanghai="1";
}
$pojia_text=null;
if($pkuser[pojia]>"0"){
    $pkuser_pojia=$pkuser[pojia]*$mianshang;
    $pojia_text="(+".$pkuser_pojia."破甲)";
}


$guaiwu[qixue]-=$zhandou_shanghai;
if(mt_rand(0,100)<"30"){
    $s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."对".$guaiwu[username]."使用了".$jineng_u[5]."造成".$zhandou_shanghai.$pojia_text."点伤害！并被冰封一个回合。','".$pk[id]."','".time()."')";
    $guaiwu[zhandou_fengyin]+="1";
}else{
   $s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."对".$guaiwu[username]."使用了".$jineng_u[5]."造成".$zhandou_shanghai.$pojia_text."点伤害！','".$pk[id]."','".time()."')";
}
mysqli_query($db,$s0);

		if($zhandou0['0']=="user"){
			//人物对象
$sql1="update users set zhandou_fengyin='".$guaiwu[zhandou_fengyin]."',qixue='".$guaiwu[qixue]."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhandou0['0']=="pet"){
	//宠物对象	
$sql1="update pet set zhandou_fengyin='".$guaiwu[zhandou_fengyin]."',qixue='".$guaiwu[qixue]."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhandou0['0']=="guaiwu"){
	//宠物对象	
$sql1="update guaiwu set zhandou_fengyin='".$guaiwu[zhandou_fengyin]."',qixue='".$guaiwu[qixue]."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);
}


//获取敌方对象结束
}
}

}
}
}