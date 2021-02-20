	<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}

foreach($list as $ks=>$vs){
	$zhadou_yuanshi= explode("|", $vs['name']); 
	//判断当前对象的阵营
	if($vs['duixiang']=="0"){
		$gongji_duixiang="1";
	}elseif($vs['duixiang']=="1"){
			$gongji_duixiang="0";
	}

	switch ($zhadou_yuanshi['0']){
    case "user":
    //人物
$pkuser= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM users WHERE id='".$zhadou_yuanshi['1']."'"));
if($pvp_leixing=="boss"){
if($pkuser[id]!=$userid){
    continue;//跳出循环
}
}
if($zhadou_yuanshi['1']==$userid){//判断是不是操作者本人

switch ($user_caozuo) {
   case "putong":
          $jn="99999";
	    $sql1="update users set jineng='99999',jineng_dengji='0' where id='".$pkuser[id]."'";
$ok1=mysqli_query($db,$sql1);
$caozuo='jineng';
	
	$user_jineng[jinengid]=$jn;
$user_jineng[dengji]="0";

     break;
   case "jineng":
  $caozuo='jineng';
	    	if($pkuser[$GO]!="0"){
	    	    $jn=substr($pkuser[$GO],-1);
switch($pkuser[zhongzu]){
case"4":
$jn+="5";
//佛
break;
case "1":
$jn+="10";
//妖
break;
case"2":
$jn+="15";
//人
break;
case"5":
$jn+="20";
//仙
break;
default:
//鬼
break;
}
	}else{
	    $jn="9999999";
	}
	
	$user_jineng[jinengid]=$jn;
$user_jineng[dengji]=$pkuser[$pkuser[$GO]];
$sql1="update users set jineng='".$jn."',jineng_dengji='".$user_jineng[dengji]."' where id='".$pkuser[id]."'";
$ok1=mysqli_query($db,$sql1);

     break;
   case "chiyao":
     	     
$pk_yaopin= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and id='".$user[$GO]."'"));
if($pk_yaopin){
    $caozuo="chiyao";
}else{
    $caozuo="jineng";
}
     break;
         break;
   case "buzhuo":
   $caozuo="buzhuo";
     break;
   default:
       $caozuo="taopao";
}
}else{
    $caozuo='jineng';
	$user_jineng[jinengid]=$pkuser[jineng];
$user_jineng[dengji]=$pkuser[jinneng_dengji];
}
 break;
 case "guaiwu":
    //怪物
    $caozuo="jineng";
    $resultl = mysqli_query($db,"SELECT * FROM guaiwu WHERE id='".$zhadou_yuanshi[1]."'");
$pkuser= mysqli_fetch_array($resultl);
$user_jineng[jinengid]=$pkuser[jineng];
$user_jineng[dengji]=$pkuser[dengji];
break;
    case "pet":
    //宠物
    $caozuo="jineng";
    $resultl = mysqli_query($db,"SELECT * FROM pet WHERE id='".$zhadou_yuanshi[1]."'");
$pkuser= mysqli_fetch_array($resultl);
if($pvp_leixing=="boss"){
    if($pkuser[userid]!=$userid){
    continue;//跳出循环
}
}
$user_jineng[jinengid]=$pkuser[jineng];
$user_jineng[dengji]=$pkuser[dengji];
break;

}




if($pkuser[qixue]<"1"){
		continue;//死亡就跳出循环
	}
	//
	
//自动补血
	switch ($zhadou_yuanshi[0]){
    case "user":
 $userbuchong = mysqli_query($db,"SELECT * FROM users WHERE id='".$zhadou_yuanshi[1]."'");
$userbuchong= mysqli_fetch_array($userbuchong);
if($userbuchong[qixue]>'0'){
	if($userbuchong[qixue]<$userbuchong[qixuemax]){
		$qixuejia1=$userbuchong[qixuemax]-$userbuchong[qixue];
		if($userbuchong[zd_qx1]<$qixuejia1){
			//不足以不满
			$userbuchong[qixue]+=$userbuchong[zd_qx1];
			$userbuchong[zd_qx1]="0";
			$qixuebu1=$userbuchong[zd_qx1];
		}else{
			//可以补满
			$userbuchong[qixue]=$userbuchong[qixuemax];
			$userbuchong[zd_qx1]-=$qixuejia1;
			$qixuebu1=$qixuejia1;
		}
	}
		if($userbuchong[fali]<$userbuchong[fali_max]){
		$falijia1=$userbuchong[fali_max]-$userbuchong[fali];
		if($userbuchong[zd_fl1]<$falijia1){
			//不足以不满
			$userbuchong[fali]+=$userbuchong[zd_fl1];
			$userbuchong[zd_fl1]="0";
			$falibu1=$userbuchong[zd_fl1];
		}else{
			//可以补满
			$userbuchong[fali]=$userbuchong[fali_max];
			$userbuchong[zd_fl1]-=$falijia1;
				$falibu1=$falijia1;
		}
	}
		$sql1="update users set qixue='".$userbuchong[qixue]."',fali='".$userbuchong[fali]."',zd_qx1='".$userbuchong[zd_qx1]."',zd_fl1='".$userbuchong[zd_fl1]."' where id='".$userbuchong[id]."'";
$ok=mysqli_query($db,$sql1);
if(!$qixuebu1){$qixuebu1="0";};if(!$falibu1){$falibu1="0";};
	$s0="insert into pvp_tip(text,cid,time) values('自动补血功能为".$userbuchong[username]."补充".$qixuebu1."气血、".$falibu1."法力。','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);
}
 break;
  case "pet":
  //首先获取宠物主人

$petbuchong = mysqli_query($db,"SELECT * FROM pet WHERE id='".$zhadou_yuanshi[1]."'");
$petbuchong= mysqli_fetch_array($petbuchong);
 $userbuchong = mysqli_query($db,"SELECT * FROM users WHERE id='".$petbuchong[userid]."'");
$userbuchong= mysqli_fetch_array($userbuchong);
if($petbuchong[qixue]>'0'){
	if($petbuchong[qixue]<$petbuchong[qixuemax]){
		$qixuejia2=$petbuchong[qixuemax]-$petbuchong[qixue];
		if($userbuchong[zd_qx2]<$qixuejia2){
			//不足以不满
			$petbuchong[qixue]+=$userbuchong[zd_qx2];
			$userbuchong[zd_qx2]="0";
			$qixuebu2=$userbuchong[zd_qx2];
		}else{
			//可以补满
			$petbuchong[qixue]=$petbuchong[qixuemax];
			$userbuchong[zd_qx2]-=$qixuejia2;
			$qixuebu2=$qixuejia2;
		}
	}
		if($petbuchong[fali]<$petbuchong[fali_max]){
		$falijia2=$petbuchong[fali_max]-$petbuchong[fali];
		if($userbuchong[zd_fl2]<$falijia2){
			//不足以不满
			$petbuchong[fali]+=$userbuchong[zd_fl2];
		$userbuchong[zd_fl2]="0";
			$falibu2=$userbuchong[zd_fl2];
		}else{
			//可以补满
			$petbuchong[fali]=$petbuchong[fali_max];
			$userbuchong[zd_fl2]-=$falijia2;
				$falibu2=$falijia2;
		}
	}
		$sql2="update pet set qixue='".$petbuchong[qixue]."',fali='".$petbuchong[fali]."' where id='".$petbuchong[id]."'";
$ok=mysqli_query($db,$sql2);
$sql1="update users set zd_qx2='".$userbuchong[zd_qx2]."',zd_fl2='".$userbuchong[zd_fl2]."' where id='".$userbuchong[id]."'";
$ok=mysqli_query($db,$sql1);

if(!$qixuebu2){$qixuebu2="0";};if(!$falibu2){$falibu2="0";};
	$s0="insert into pvp_tip(text,cid,time) values('自动补血功能为".$petbuchong[username]."补充".$qixuebu2."气血、".$falibu2."法力。','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);
}
 break;
	}

	
	//鬼族用毒效果
	       $zhandou_dux= mysqli_query($db,"SELECT * FROM zhandou_du WHERE userid='".$zhadou_yuanshi[1]."' and leixing='".$zhadou_yuanshi[0]."'");
while($zhandou_du= mysqli_fetch_array($zhandou_dux)){
	$zhandou_du[huihe]-="1";
	$pkuser[qixue]-=$zhandou_du[shanghai];
	if($zhadou_yuanshi['0']=="user"){
			//人物对象
$sql1="update users set qixue='".$pkuser[qixue]."' where id='".$zhadou_yuanshi['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhadou_yuanshi['0']=="pet"){
	//宠物对象	
$sql1="update pet set qixue='".$pkuser[qixue]."'where id='".$zhadou_yuanshi['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhadou_yuanshi['0']=="guaiwu"){
	//宠物对象	
$sql1="update guaiwu set qixue='".$pkuser[qixue]."'where id='".$zhadou_yuanshi['1']."'";
$ok=mysqli_query($db,$sql1);
}
	$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."受到".$zhandou_du[shanghai]."点持续伤害,剩余".$zhandou_du[huihe]."回合。','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);

if($zhandou_du[huihe]<"1"){
$sql3 = "delete from zhandou_du where id ='".$zhandou_du[id]."'";
$ok=mysqli_query($db,$sql3);	
	
}else{
	$sql2="update zhandou_du set huihe='".$zhandou_du[huihe]."' where id='".$zhandou_du[id]."'";
$ok=mysqli_query($db,$sql2);
}


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
if($zhadou_yuanshi['0']=="user"){
			//人物对象
$sql1="update users set zhandou_jiedao='".$pkuser[zhandou_jiedao]."' where id='".$zhadou_yuanshi['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhadou_yuanshi['0']=="pet"){
	//宠物对象	
$sql1="update pet set zhandou_jiedao='".$pkuser[zhandou_jiedao]."' where id='".$zhadou_yuanshi['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhadou_yuanshi['0']=="guaiwu"){
	//宠物对象	
$sql1="update guaiwu set zhandou_jiedao='".$pkuser[zhandou_jiedao]."' where id='".$zhadou_yuanshi['1']."'";
$ok=mysqli_query($db,$sql1);

}

	$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."受魅惑持续中，将攻击队友。','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);


}

//佛族封印效果
if($pkuser[zhandou_fengyin]>"0"){
$pkuser[zhandou_fengyin]-="1";
if($zhadou_yuanshi['0']=="user"){			//人物对象
$sql1="update users set zhandou_fengyin='".$pkuser[zhandou_fengyin]."' where id='".$zhadou_yuanshi['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhadou_yuanshi['0']=="pet"){
	//宠物对象	
$sql1="update pet set zhandou_fengyin='".$pkuser[zhandou_fengyin]."' where id='".$zhadou_yuanshi['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhadou_yuanshi['0']=="guaiwu"){
	//宠物对象	
$sql1="update guaiwu set zhandou_fengyin='".$pkuser[zhandou_fengyin]."' where id='".$zhadou_yuanshi['1']."'";
$ok=mysqli_query($db,$sql1);
}
	$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."受封印效果持续中，该回合沉默。','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);
continue;//跳出循环
}


//引入通用代码
    include $_SERVER['DOCUMENT_ROOT']."/class/pve/pve_go.php";
}