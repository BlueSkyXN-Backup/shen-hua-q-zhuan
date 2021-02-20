<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
class xyz{
//背包相关函数
public function beibao($huode_id,$huode_shuliang,$huode_jilv,$max,$userid,$huode1,$huode2){
	global $db;//数据连接

// if($_SERVER['HTTP_CONNECTION']=="Keep-Alive"){
    
// $xyz_diaoluo="50000";
// }else{	$xyz_diaoluo="10000";}
//开始一个事务
//定义最多获得几样物品
$ifshu='0';
if($max==null){
	$shuss='999';
}else{
$shuss=$max;
}
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);
//写入物品进入背包
$wupinid = explode("|", $huode_id); 
$wupinshuliang = explode("|", $huode_shuliang); 
$wupinjilv = explode("|", $huode_jilv); 
	$xieru_ok=0;
	$xieru_if=0;
for($x=0;$x<count($wupinid);$x++)
{
    $wupinidxx = explode("-", $wupinid[$x]);
    $wupinidxx_shu=count($wupinidxx)-1;
    $wupinidxx_shu=mt_rand(0,$wupinidxx_shu);
$suiji_jilv=mt_rand(0,10000);
$wupinids = explode(",", $wupinidxx[$wupinidxx_shu]); 
$wupinshuliangxxx=explode("-", $wupinshuliang[$x]);
$wupinshuliangs = explode(",", $wupinshuliangxxx[$wupinidxx_shu]);
if($suiji_jilv<=$wupinjilv[$x]){
	if($ifshu>=$shuss){
		   break;//跳出循环
	}
	$ifshu+='1';//判断+1
	$xieru_if+="1";//判断+1
	
	
$huode_shuliang=mt_rand($wupinshuliangs[0],$wupinshuliangs[1]);

switch($wupinids[0]){
case"wp":
//物品写入数据库
$wupin = mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$userid."' and wupin_id='".$wupinids[1]."'");
$wupin = mysqli_fetch_array($wupin);
$muban = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$wupinids[1]."'");
$muban = mysqli_fetch_array($muban);//运算背包体积
$tiji=$muban[tiji]*$huode_shuliang;
$user[beibao_rongliang]+=$tiji;
if($user[beibao_rongliang]<=$user[beibao_rongliangmax]||$tiji=="0"){
if ($wupin){
$wupin[shuliang]+=$huode_shuliang;
$sql4="update beibao set shuliang='".$wupin[shuliang]."' where wupin_id='".$wupinids[1]."' and userid='".$userid."'";
$ok=mysqli_query($db,$sql4);
}else{
$s="insert into beibao(userid,wupin_id,shuliang,jiyu) values('".$userid."','".$wupinids[1]."','".$huode_shuliang."','yes')";
$ok=mysqli_query($db,$s);
}
$sql2="update users set beibao_rongliang='".$user[beibao_rongliang]."' where id='".$userid."'";
$okrongliang=mysqli_query($db,$sql2);
$huode_html.=$huode1.$muban[name]."*".$huode_shuliang.$huode2;
}else{
	//体积不够
	$okrongliang="1";
	$ok="1";
	$huode_html.=$huode1."背包空间不足，请清理背包空间。".$huode2;
}
break;
case"zb":
//写入装备

$wupin_name= mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$wupinids[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);

$tiji=$wupin_name[tiji]*$huode_shuliang;
$user[beibao_rongliang]+=$tiji;
if($user[beibao_rongliang]<=$user[beibao_rongliangmax]){

	for($zb=0;$zb<$huode_shuliang;$zb++){
 if($wupinids[2]){
        $juese2= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM zhuangbei WHERE yuanshi='".$wupinids[1]."' and userid='".$userid."' and time>'".time()."' order by id desc LIMIT 1"));
        if(!$juese2){
          
          $huoqu_date="(".$wupinids[2]."天)";
	      $zhuangbei_time=$wupinids[2]*86400;
    $zhuangbei_time+=time();
    $s="insert into zhuangbei(yuanshi,userid,name,dengji,naijiu,leixing,time) values('".$wupin_name[id]."','".$userid."','".$wupin_name[name]."','".$wupin_name[dengji]."','".$wupin_name[naijiu]."','".$wupin_name[leixing]."','".$zhuangbei_time."')";
$ok=mysqli_query($db,$s);


        }else{
      $huoqu_date="(".$wupinids[2]."天)";
        $juese2[time]+=$wupinids[2]*86400;
        $s="update zhuangbei set time='".$juese2[time]."' where id='".$juese2[id]."' and userid='".$userid."'";
        
$ok=mysqli_query($db,$s);
        }
    }else{
  
   $s="insert into zhuangbei(yuanshi,userid,name,dengji,naijiu,leixing) values('".$wupin_name[id]."','".$userid."','".$wupin_name[name]."','".$wupin_name[dengji]."','".$wupin_name[naijiu]."','".$wupin_name[leixing]."')"; 
    
$ok=mysqli_query($db,$s);

}


}


	
$sql2="update users set beibao_rongliang='".$user[beibao_rongliang]."' where id='".$userid."'";
$okrongliang=mysqli_query($db,$sql2);
$huode_html.=$huode1.$wupin_name[name].$huoqu_date."*".$huode_shuliang.$huode2;
}else{
	//体积不够
	$okrongliang="1";
	$ok="1";
	$huode_html.=$huode1."背包空间不足，请清理背包空间。".$huode2;

}


break;

case"juese":
//juese写入数据库
$wupin_name= mysqli_query($db,"SELECT * FROM muban_juese WHERE id='".$wupinids[1]."'");
$wupin_name= mysqli_fetch_array($wupin_name);

    
    if($wupinids[2]){
        $juese2= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM juese WHERE muban='".$wupinids[1]."' and userid='".$userid."' and time>'".time()."' order by id desc LIMIT 1"));
        if(!$juese2){
        //持有期限道具，直接加在期限道具上面
         $huoqu_date="(".$wupinids[2]."天)";
	      $zhuangbei_time=$wupinids[2]*86400;
    $zhuangbei_time+=time();
   $s="insert into juese(userid,muban,time) values('".$userid."','".$wupinids[1]."','". $zhuangbei_time."')";
   
$ok=mysqli_query($db,$s);
        }else{
         $huoqu_date="(".$wupinids[2]."天)";
        $juese2[time]+=$wupinids[2]*86400;
        $s="update juese set time='".$juese2[time]."' where id='".$juese2[id]."' and userid='".$userid."'";
        
$ok=mysqli_query($db,$s);
        }
    }else{
   $juese1= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM juese WHERE muban='".$wupinids[1]."' and userid='".$userid."' and time is null"));
   if(!$juese1){
    $s="insert into juese(userid,muban) values('".$userid."','".$wupinids[1]."')";
    
$ok=mysqli_query($db,$s);
}else{
   $ok="1"; 
}
}

$okrongliang="1";
$huode_html.=$huode1.$wupin_name[name].$huoqu_date."*".$huode_shuliang.$huode2;
break;
case"shenzhoubi":
$user[shenzhoubi] +=$huode_shuliang;
$sql2="update users set shenzhoubi='".$user[shenzhoubi]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);

	$okrongliang="1";
	$huode_html.=$huode1."神州币*".$huode_shuliang.$huode2;

break;
case"gold":
$user[gold] +=$huode_shuliang;
$sql2="update users set gold='".$user[gold]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);

	$okrongliang="1";
	$huode_html.=$huode1."金条*".$huode_shuliang.$huode2;

break;
case"jingyan":
$user[jingyan] +=$huode_shuliang;
$sql2="update users set jingyan='".$user[jingyan]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);


	$okrongliang="1";
	$huode_html.=$huode1."经验*".$huode_shuliang.$huode2;
break;
case"xjsj":
$user[xjsj] +=$huode_shuliang;
$sql2="update users set xjsj='".$user[xjsj]."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);


	$okrongliang="1";
	$huode_html.=$huode1."心愿水晶*".$huode_shuliang.$huode2;
break;
default:
break;
}

if($ok){
//写入
$xieru_ok+="1";
		
}

//随机几率写入结束
}
//for循环结束
}


if($xieru_ok==$xieru_if){
		mysqli_query($db,"COMMIT");//数据提交

	 return $huode_html;
}else{
	mysqli_query($db,"ROLLBACK");
	 return 'no';
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");//自动提交
}



//扣除物品函数

public function kou_beibao($kou_id,$kou_shuliang,$userid){
	global $db;//数据连接
//开始一个事务
mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
$id = explode("|", $kou_id); 
$shuliang = explode("|", $kou_shuliang); 
$user = mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'");
$user = mysqli_fetch_array($user);
$shanchu_ok=0;
	$shanchu_if=0;
for($x=0;$x<count($id);$x++)
{	$shanchu_if+=1;
	$ids= explode(",", $id[$x]);
	switch($ids[0]){
case"wp":
$wupinid = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$ids[1]."' and userid='".$userid."'");
$wupinid = mysqli_fetch_array($wupinid);
if ($wupinid) {

if($wupinid[shuliang]>=$shuliang[$x]){
$wupinid[shuliang]-=$shuliang[$x];
if($wupinid[shuliang]<"1"){

$sql3 = "delete from beibao where wupin_id ='".$ids[1]."' and userid='".$userid."'";
$ok=mysqli_query($db,$sql3);
}else{
$sql2="update beibao set shuliang='".$wupinid[shuliang]."' where wupin_id='".$ids[1]."' and userid='".$userid."'";
$ok=mysqli_query($db,$sql2);
}	
}
}
break;
}
if($ok){
//shanchu
$shanchu_ok+="1";
		
}
}
	if($shanchu_ok==$shanchu_if){
		mysqli_query($db,"COMMIT");//数据提交

	 return "ok";
}else{
	mysqli_query($db,"ROLLBACK");
	 return "no";
}
mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");//自动提交
}


//背包物品数量查询
public function wp_shu($huode_id,$usersid){
	global $db;//数据连接
	mysqli_query($db,"SET AUTOCOMMIT=0");//关闭自动提交
mysqli_query($db,"BEGIN"); //事务锁
	$wupinshu = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM beibao WHERE userid='".$usersid."' and wupin_id='".$huode_id."'"));
	if($wupinshu){
	    $shuliang=$wupinshu[shuliang];
	}else{
	     $shuliang=0;
	}

	mysqli_query($db,"END");
mysqli_query($db,"SET AUTOCOMMIT=1");//自动提交
	 return $shuliang;
}


//背包物品数量查询
public function wp($huode_id){
	global $db;//数据连接
	$wupinshu = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM muban_wuping WHERE  id='".$huode_id."'"));
	 return $wupinshu[name];
}
//背包容量查询
public function beibao_rongliang($user_id){
	global $db;//数据连接
	$user_rongliang = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM users WHERE  id='".$user_id."'"));
	if($user_rongliang[beibao_rongliangmax]>=$user_rongliang[beibao_rongliang]){
	$rongliang=$user_rongliang[beibao_rongliangmax]-$user_rongliang[beibao_rongliang];
	}else{
	    $rongliang="0";
	}
	 return $rongliang;
}

}