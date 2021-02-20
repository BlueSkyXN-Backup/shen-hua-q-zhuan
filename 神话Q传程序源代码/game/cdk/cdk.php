<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}

$cdk=$_POST['cdk'];
if($cdk){
    if($userid<"99999999"){
$cdks= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM cdk WHERE cdk='".$cdk."'"));
    if($cdks){
        $cdku= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM cdk_user WHERE cdk='".$cdks[id]."' and user='".$userid."'"));
        if($cdku){
            echo"CDK兑换码已经使用过了！<br/>";
        }else{
            $s="insert into cdk_user(cdk,user,time) values('".$cdks[id]."','".$userid."','".time()."')";
            if(mysqli_query($db,$s)){
           echo "恭喜你获得：<font color='red'>";
echo $xyz->beibao($cdks[xiaoguo],$cdks[xiaoguo_shu],$cdks[xiaoguo_jilv],"100",$userid," "," ");
echo "</font><br/>";
}
        }
        
        
        
    }else{echo"CDK兑换码不存在！<br/>";}
    }else{echo"你不在本次补偿活动中！<br/>";}
}










echo "<form action='cdk' method='post'>";
echo "兑换码：";
echo "<input name='cdk' maxlength='100' value='$task'/>";
echo '<input type="submit" value="确定" class="link"/></form>';
echo"请输入CDK兑换码，请确保背包有足够的空间！<br/>";



echo"<a href='/map.games?id=$user[map]'>返回地图</a>";