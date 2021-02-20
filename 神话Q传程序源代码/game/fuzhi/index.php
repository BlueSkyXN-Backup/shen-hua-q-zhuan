<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$userid=$_SESSION['users'];
$id=$_GET['id'];
$my_yes=$_GET['my'];
$wap=$_GET['wap'];

echo "<a href='/map.games'>返回地图</a><br/>";
if($userid!="1"){
    exit('副职已下线');
}
if($my_yes=="wj"){
		$sql2="update users set fuzhi='0',fuzhi_int='0' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
if($ok){echo"忘记成功！<br/>";
	$user[fuzhi]="0";
}else{echo"忘记失败！<br/>";}
}
if($user[fuzhi]!=0){
switch($user[fuzhi]){
case 1:
$fuzhi_name="药师";
break;
case 2:
$fuzhi_name="工匠";
break;
case 3:
$fuzhi_name="裁缝";
break;
case 4:
$fuzhi_name="木匠";
break;


}
$num=$user[fuzhi_int];
switch($num){
        case $num>0 and $num<21:
            $fuzhi_dengji="1级";
            $fuzhi_jingyan="21";
            break;
              case $num>20 and $num<101:
            $fuzhi_dengji="2级";
            $fuzhi_jingyan="101";
            break;
              case $num>=101 and $num<1001:
            $fuzhi_dengji="3级";
            $fuzhi_jingyan="1001";
            break;
              case $num>=1001 and $num<5001:
            $fuzhi_dengji="4级";
            $fuzhi_jingyan="5001";
            break;
              case $num>=5001 and $num<100000000:
            $fuzhi_dengji="5级";
            $fuzhi_jingyan="9999999";
            break;
            }
$exec="select * from fuzhi WHERE zhiye='".$user[fuzhi]."' and shulian<='".$user[fuzhi_int]."' order by id ASC limit 10"; 
$result=mysqli_query($db,$exec); 
echo"你当前".$fuzhi_dengji.$fuzhi_name."可以制作：<br/>";
while($row=mysqli_fetch_array($result)){ 
if($mys==$row[id]){echo $row[name];}else{
echo  "<a href='zhizuo?id=$row[id]'>$row[name]</a><br/>";
	echo "
<form action='zhizuo?id=$row[id]&my=yes' method='post'>
<input name='shuliang' maxlength='5' value=''></input>
<input type='submit' value='制作 $row[name]' class='link'/></form>==============
<br/>";
}

}
echo"熟练度：$user[fuzhi_int]/".$fuzhi_jingyan."";

echo "<br/><a href='index?my=wj'>忘记副职(忘记后熟练度清零，可学习其他职业)</a>";
}else{
	if($my_yes=="ko"){
		$zhongzu=$_POST['zhongzu'];
		$sql2="update users set fuzhi='".$zhongzu."' where id='".$userid."'";
$ok=mysqli_query($db,$sql2);
if($ok){echo"学习成功！<br/>";}else{echo"学习失败！<br/>";}
echo "<br/><a href='index'>返回副职</a>";
	}else{
echo"你还没有学习副职！<br/>";
echo '<form action="index?my=ko" method="post">  
     

 选择职业:<select name="zhongzu" id="zhongzu">
<option value="2">工匠</option>
<option value="4">木匠</option>

<option value="3">裁缝</option>
<option value="1">药师</option>


</select> 
<br/>【副职介绍】

<br/>
【药师】：擅长采药以及炼制药品丹药。<br/>
【工匠】：擅长采集矿石锻造宝石。<br>
【裁缝】：擅长狩猎以及缝纫装备！<br>
【木匠】：开发中。<br>
<input type="submit" class="link" value="确定学习" />     
</form>
';}
}

echo "<br/><a href='/map.games'>返回地图</a>";
echo footer();
?>