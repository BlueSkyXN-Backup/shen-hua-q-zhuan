<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$my_go=$_GET['my'];
$baoshi=$_GET['baoshi'];//镶嵌的宝石ID
$jibie=$_GET['jibie'];//镶嵌的宝石级别

echo "<a href='index'>门派技能</a>|<a href='xiufu.php'>装备修复</a>|<a href='hecheng'>宝石合成</a>|<a href='/fuzhi/index'>副职技能</a><br/>-------------------------<br/>";

if($baoshi and preg_match('/^[0-9]+$/u',$baoshi)){
    
$hecheng=mysqli_fetch_array(mysqli_query($db,"select * from hecheng WHERE id='".$baoshi."'")); 
    //合成符
    if($hecheng){
    if($hecheng[dengji]<"6"){$hecheng_fu="205"; }else{$hecheng_fu="403";}
//统计拥有的合成符数量
$resultl = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$hecheng_fu."' and userid='".$userid."'");
$hcs= mysqli_fetch_array($resultl);
if(!$hcs){$hcs[shuliang]="0";}
$resultl = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$hecheng_fu."'");
$hcx= mysqli_fetch_array($resultl);
//统计宝石数量
$resultl = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$hecheng[ids]."' and userid='".$userid."'");
$wps= mysqli_fetch_array($resultl);
if(!$wps){$wps[shuliang]="0";}
$resultl = mysqli_query($db,"SELECT * FROM muban_wuping WHERE id='".$hecheng[idx]."'");
$wpx= mysqli_fetch_array($resultl);

    
if($my_go and preg_match('/^[0-9]+$/u',$my_go)){
    //这里写入执行合成的代码
    $shuliang=$_POST['shuliang'];
    if(preg_match('/^[0-9]+$/u',$shuliang)){
        if($shuliang>="5"){
            if($shuliang<=$wps[shuliang]){
            
            $huode_shuliang=$shuliang/5;
            $huode_shuliang=floor($huode_shuliang);
            if($hcs[shuliang]<$huode_shuliang){
                echo"当前合成需要".$hcx[name]."*".$huode_shuliang."个<br/>";
            }else{
                //
                	$ajid="wp,".$hecheng_fu."|wp,".$hecheng[ids];
                	$ajsl=$huode_shuliang."|".$shuliang;
               
if($xyz->kou_beibao($ajid,$ajsl,$userid)=="ok"){
     if($hecheng[dengji]<"5"){}
    $jl_wp="wp,".$hecheng[idx];
    $jl_sl=$huode_shuliang.",".$huode_shuliang;
$huode_html="幸运获得:". $xyz->beibao($jl_wp,$jl_sl,'10000',9999,$userid,' ',' ');
echo $huode_html;
$s="insert into news(text,time,userid,leibie) values('合成成功了！".$huode_html."','".time()."','".$userid."','0')";
$ok=mysqli_query($db,$s);
if($ok){
mysqli_query($db,"COMMIT");
}else{
	echo"0";
}
}
                
                //
            }
            }else{
                echo"你未拥有".$shuliang."个".$hecheng[text]."<br/>";
            }
        }else{
        echo"你给的材料太少了！至少要5颗宝石才能合成新的宝石呢！<br/>";
        }
        
        
    }else{
        echo"呀呀呀！你的数学是体育老师教的吗？<br/>";
    }
    
    
}else{
	
echo"您正在提升：".$hecheng[text]."等级。";
echo "<form action='hecheng?baoshi=".$baoshi."&my=1' method='post'>";
echo "请放入5枚以上".$hecheng[text].":";
echo "<input name='shuliang' maxlength='10' value='5'/><br/>";

echo '<input type="submit" value="确定合成'.$wpx[name].'" class="submit"/></form>';
}

	echo "----------<br/>提升后你将获得更高等级的同类宝石！<br/>----------<br/>提示：合成时每放入5枚宝石就会扣除1枚合成符！<br/>";

    
    
    
    
    
}else{
    	echo "想利用bug？想都别想。<br/>";
}  
	echo "----------<br/><a href='./hecheng?
'>重新选择宝石</a><br/><a href='/map.games
'>返回地图</a><br/>";
echo footer();
}else{


echo "选择您拥有的宝石等级:<a href='hecheng?jibie=1&zhuangbei=".$id."&kong=".$kong."'>1级</a>|<a href='hecheng?jibie=2&zhuangbei=".$id."&kong=".$kong."'>2级</a>|<a href='hecheng?jibie=3&zhuangbei=".$id."&kong=".$kong."'>3级</a>|<a href='hecheng?jibie=4&zhuangbei=".$id."&kong=".$kong."'>4级</a>|<a href='hecheng?jibie=5&zhuangbei=".$id."&kong=".$kong."'>5级</a>|<a href='hecheng?jibie=6&zhuangbei=".$id."&kong=".$kong."'>6级</a>|<a href='hecheng?jibie=7&zhuangbei=".$id."&kong=".$kong."'>7级</a>|<a href='hecheng?jibie=8&zhuangbei=".$id."&kong=".$kong."'>8级</a>|<a href='hecheng?jibie=9&zhuangbei=".$id."&kong=".$kong."'>9级</a>
<br/>";
echo"<br/>【选择你想要晋升宝石】<br/>----------<br/>";
///index面板
if(!$jibie){$jibie="1";}
if(preg_match('/^[0-9]+$/u',$jibie)){
$exec="select * from hecheng WHERE dengji='".$jibie."' order by dengji ASC limit 10"; 
$result=mysqli_query($db,$exec); 

while($row=mysqli_fetch_array($result)){ 
$resultl = mysqli_query($db,"SELECT * FROM beibao WHERE wupin_id='".$row[ids]."' and userid='".$userid."'");
$wp= mysqli_fetch_array($resultl);

if(!$wp){
	echo $row[text]."0<br/>";
	
}else{
echo  "<a href='hecheng?baoshi=$row[id]'>$row[text]</a>$wp[shuliang]<br/>";
}	
	
}
echo"宝石后面的数字代表拥有的宝石数量<br/>";
}else{
	
echo"<br/>提示：当前级别的宝石不能通过合成获得！您可以寻找工匠锻造宝石或者前往交易售后。<br/>----------<br/>";
}
	echo "<br/><a href='hecheng.tj
'>宝石图鉴</a><br/>----------<br/><a href='/map.games
'>返回地图</a><br/>";
echo footer();
}