<?php
//这里开始执行操作
switch ($caozuo):
    case "jineng":
        //技能发动
        //获取战斗技能
 $userss_jineng=pvp_jineng($user_jineng[jinengid],$user_jineng[dengji]);
        $jineng_u = explode("|", $userss_jineng); //打印出战斗技能的参数
//此处插入影响效果

//使用技能判断法力

if($pkuser[fali]<$jineng_u['4']){
	//法力不够
	$s0="insert into pvp_tip(text,cid,time) values('".$pkuser[username]."法力不足，无法施展".$jineng_u[5]."！','".$pk[id]."','".time()."')";
$ok0=mysqli_query($db,$s0);
}else{
	if($zhadou_yuanshi[0]!="guaiwu"){
//扣除法力
	$pkuser[fali]-=$jineng_u['4'];
}
	
	if($zhadou_yuanshi['0']=="user"){
			//人物对象
$sql1="update users set fali='".$pkuser[fali]."' where id='".$zhadou_yuanshi['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhadou_yuanshi['0']=="pet"){
	//宠物对象	
$sql1="update pet set fali='".$pkuser[fali]."' where id='".$zhadou_yuanshi['1']."'";
$ok=mysqli_query($db,$sql1);

}elseif($zhadou_yuanshi['0']=="guaiwu"){
	//宠物对象	
$sql1="update guaiwu set fali='".$pkuser[fali]."' where id='".$zhadou_yuanshi['1']."'";
$ok=mysqli_query($db,$sql1);

}
//扣除法力结束






//此处映入打怪
       
                 include $_SERVER['DOCUMENT_ROOT']."/class/pvp/class/".$jineng_u['1'].".php";
      
}

        break;
    case "buzhuo":
        //捕捉
        include $_SERVER['DOCUMENT_ROOT']."/class/pvp/class/pvp_buzhuo.php";
        break;
    case "chiyao":
        //吃药
        include $_SERVER['DOCUMENT_ROOT']."/class/pvp/class/pvp_chiyao.php";
        break;

    case "taopao":
        //逃跑
 include $_SERVER['DOCUMENT_ROOT']."/class/pvp/class/taopao.php";
        break;

endswitch;