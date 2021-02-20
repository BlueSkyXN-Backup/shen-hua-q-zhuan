<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
//获取帮派创建令牌
 $bangpai_user = mysqli_query($db,"SELECT * FROM bangpai_user WHERE userid='".$userid."'");
$bangpai_user = mysqli_fetch_array($bangpai_user);
$shu_425=$xyz->wp_shu("425",$userid);
if($shu_425<"1"){
    echo"你没有".$xyz->wp("425")."<br/>";
}else{
    if($user[dengji]<"55"){
        echo"创建帮派需要人物等级大于55级哦~赶快努力升级吧！<br/>";
    }else{
        $mys=$_GET['mys'];
        if($mys){
             $name=$_POST['mingcheng'];
             
if(!preg_match('/^[A-Za-z0-9\x{4e00}-\x{9fa5}]+$/u',$name)){
    echo"帮派名称不符合规则";
}else{
    if(!$bangpai_user){
        //执行创建命令
        $s="insert into bangpai(name,bangzhu) values('".$name."','".$userid."')";
$ko=mysqli_query($db,$s);
$bangpaiid=mysqli_insert_id($db);
$s="insert into bangpai_user(userid,bangpaiid,time) values('".$userid."','".$bangpaiid."','".time()."')";
$ko2=mysqli_query($db,$s);
     if($ko && $ko2 &&$xyz->kou_beibao("wp,425","1",$userid)=="ok"){
         echo"创建成功";
     }else{
         echo "创建失败";
     }
    }else{
        echo "你已经有帮派了！请退出原有帮派再来创建新的帮派吧！";
    }
}
        }else{
            
    
        echo'<form action="?mys=fr" method="post">
帮派名称:
<input type="text" name="mingcheng" id="mingcheng" maxlength="6" onblur="quancheng()">
<br>
<input type="submit" value="创建帮派">
</form>';
        }

    }
    
    
    
    
    
}
echo"<a href='index.php'>返回</a><br/>";
echo footer();
?>