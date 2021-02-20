<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
//捕捉宠物
$shuliang="1";
foreach($list as $ks=>$zd){


//只攻击这个对象
		if($shuliang<"1"){
		break;//跳出循环
	}
		$zhandou0= explode("|", $zd['name']); 
		if($zhandou0['0']=="guaiwu"){
			$shuliang-="1";
		//宠物对象
	$guaiwu = mysqli_query($db,"SELECT * FROM guaiwu WHERE id='".$zhandou0['1']."'");
$guaiwu = mysqli_fetch_array($guaiwu);
if($guaiwu[buzhuo]=="no"){
	$s3="insert into pvp_tip(text,cid,time) values('".$guaiwu[username]."不能被捕捉！','".$pk[id]."','".time()."')";
$ok=mysqli_query($db,$s3);

}else{
  if($user[chongwu_rongliang]<$user[chongwu_rongliangmax]){
if($guaiwu[dengji]>$user[dengji]){
//不能捕捉比自己等级高的怪物
	$s3="insert into pvp_tip(text,cid,time) values('".$guaiwu[username]."等级在你之上，不能被你捕捉！','".$pk[id]."','".time()."')";
$ok=mysqli_query($db,$s3);
}else{

if($guaiwu[sudu]>$user[sudu]){

	$s3="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."捕捉怪物，但被".$guaiwu[username]."狡猾的逃脱了！','".$pk[id]."','".time()."')";
$ok=mysqli_query($db,$s3);

}else{
$s="insert into pet(muban,userid,username,zhuangtai,chengzhanglv,dengji,jingyan,qixue,qixuemax,fali,fali_max,fangyu,gongji_fa,gongji,sudu) values('".$guaiwu[yuanshi]."','".$userid."','".$guaiwu[username]."','yes','".$guaiwu[chengzhanglv]."','".$guaiwu[dengji]."','0','".$guaiwu[qixue]."','".$guaiwu[qixue_max]."','".$guaiwu[fali]."','".$guaiwu[fali_max]."','".$guaiwu[fangyu]."','".$guaiwu[fagong]."','".$guaiwu[gongji]."','".$guaiwu[sudu]."')";
$ok=mysqli_query($db,$s);
echo $ok;
if(ok){
//捕捉成功
//删除怪物
$sql3 = "delete from guaiwu where id ='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql3);
	$s3="insert into pvp_tip(text,cid,time) values('".$guaiwu[username]."成功被你捕捉！','".$pk[id]."','".time()."')";
$ok=mysqli_query($db,$s3);
$user[chongwu_rongliang]+="1";//计算宠物容量
$sql1="update users set chongwu_rongliang='".$user[chongwu_rongliang]."' where id='".$zhandou0['1']."'";
$ok=mysqli_query($db,$sql1);
//删除怪物
$guaiwu_shu-="1";
}else{
//捕捉失败
	$s3="insert into pvp_tip(text,cid,time) values('".$guaiwu[username]."捕捉失败，请联系客服处理bug！！','".$pk[id]."','".time()."')";
$ok=mysqli_query($db,$s3);
}

}
}
    }else{
//宠物栏不够
	$s3="insert into pvp_tip(text,cid,time) values('".$guaiwu[username]."捕捉失败，请购买观音石扩容宠物栏！！','".$pk[id]."','".time()."')";
$ok=mysqli_query($db,$s3);
}
}
}

}

?>