<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
$pk_go="yes";
$pvp_leixing="pk";
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
    $news="3";


$resultl = mysqli_query($db,"SELECT * FROM pk WHERE userid='".$userid."' or npcid='".$userid."'");
$pk_pve= mysqli_fetch_array($resultl);
if($pk){
$wg_leixing="pk";
$pk[id]=$pk_pve[userid].$pk_pve[npcid]."pk";
/**
	* @param array $list 要排序的数组
	* @param string $sort_key  要按照排序的字段
	* @param $order 排序方式，省略默认降序  降序SORT_DESC   升序  SORT_ASC
	* @return array 返回排序后的数组
	*/
	function getSort($list,$sort_key,$order=SORT_DESC){
		if(!is_array($list)){
			return $list;
		}
		$key_array = array();
		foreach($list as $v){
			$key_array[] = $v[$sort_key];
		}
		array_multisort($key_array,$order,$list);
		return $list;
	}
    



include $_SERVER['DOCUMENT_ROOT']."/class/pvp/class/jineng.php";

	//获取发起者
	$pk_user= mysqli_query($db,"SELECT * FROM users WHERE id='".$pk_pve[userid]."'");
$pk_user= mysqli_fetch_array($pk_user);
if($pk_user[qixue]<"1"){
	$user_zhuangtai="no";
}
//获取发起者宠物
//获取用户出站宠物数据宠物
if($pk_user[chongwu_id]!="0"){
$user_chongwu= mysqli_query($db,"SELECT * FROM pet WHERE userid='".$pk_user[id]."' and id='".$pk_user[chongwu_id]."'");
$user_chongwu= mysqli_fetch_array($user_chongwu);
if($user_chongwu[qixue]<"1"){
	$user_chongwu_zhuangtai="no";
}
}else{
	$user_chongwu_zhuangtai="no";
}
	//获取被PK者
	$pk_npc= mysqli_query($db,"SELECT * FROM users WHERE id='".$pk_pve[npcid]."'");
$pk_npc= mysqli_fetch_array($pk_npc);
if($pk_npc[qixue]<"1"){
	$npc_zhuangtai="no";
}
//获取被pk者宠物
//获取用户出站宠物数据宠物
if($pk_npc[chongwu_id]!="0"){
$npc_chongwu= mysqli_query($db,"SELECT * FROM pet WHERE userid='".$pk_npc[id]."' and id='".$pk_npc[chongwu_id]."'");
$npc_chongwu= mysqli_fetch_array($npc_chongwu);
if($npc_chongwu[qixue]<"1"){
	$npc_chongwu_zhuangtai="no";
}
}else{
	$npc_chongwu_zhuangtai="no";
}


//人物和宠物死亡执行代码
if ($user_chongwu_zhuangtai=="no" && $user_zhuangtai=="no" ){
$renwu_user="no";
}else{	
	$renwu_user="yes";
	
	}

//人物和宠物死亡执行代码

if ($npc_chongwu_zhuangtai=="no" && $npc_zhuangtai=="no" ){
$renwu_npc="no";
}else{
$renwu_npc="yes";
	
}
//判断是否还有怪物和人物宠是否死亡
if ($renwu_npc=="no"  ||$renwu_user=="no" ){
    //被pk者死亡执行代码
if ($renwu_npc=="no"){
$news=1;
}
//发起者死亡死亡执行代码
if ($renwu_user=="no"){
$news=0;
}
}



//开始排列双方战斗对象

//先判断是否是发起者
if($userid==$pk_user[id]){
	$duixiang_user="1";//我为真
	$duixiang_npc="0";//敌人为假
}elseif($userid==$pk_npc[id]){
$duixiang_user="0";//敌人为假
$duixiang_npc="1";//我为真
	
}else{
	//对象错误，停止程序
	exit('Not Found WAPWORK,系统程序错误');
}

$b= array(
  array('name'=>'user|'.$pk_user[id],'sudu'=>$pk_user[sudu],'duixiang'=>'0')
);
$c=array('name'=>'user|'.$pk_npc[id],'sudu'=>$pk_npc[sudu],'duixiang'=>'1');
$b[] = $c;
if($pk_npc[chongwu_id]!="0"){
$c = array('name'=>'pet|'.$pk_npc[chongwu_id],'sudu'=>$npc_chongwu[sudu],'duixiang'=>'1');
$b[] = $c;
}
if($pk_user[chongwu_id]!="0"){
$c = array('name'=>'pet|'.$pk_user[chongwu_id],'sudu'=>$user_chongwu[sudu],'duixiang'=>'0');
$b[] = $c;
}
//排列战斗对象完毕
//进行排序
$list =getSort($b,'sudu',SORT_DESC);
      
//定义主动玩家的技能操作

//开始执行打怪
if($_GET['md5']){
    if($_GET['md5']!=$_G[md5]){
        echo"异常错误";
        exit();
    }
    
	//判定操作
	switch ($_GET['go']){
    case "kj1":
    	$user_caozuo='chiyao';
    	$GO=$_GET['go'];
    	break;
    case "kj2":
    		$user_caozuo='chiyao';
    	$GO=$_GET['go'];
    	break;
    case "kj3":
    		$user_caozuo='chiyao';
    	$GO=$_GET['go'];
    	break;
    case "kj4":
    		$user_caozuo='chiyao';
    	$GO=$_GET['go'];
    	break;
    case "kj5":
    		$user_caozuo='chiyao';
    	$GO=$_GET['go'];
    	break;
    case "kj6":
    		$user_caozuo='jineng';
    	$GO=$_GET['go'];
    		break;
    case "kj7":
    	$user_caozuo='jineng';
    	$GO=$_GET['go'];
    	break;
    case "kj8":
    	$user_caozuo='jineng';
    	$GO=$_GET['go'];
    	break;
    case "kj9":
    	$user_caozuo='jineng';
    	$GO=$_GET['go'];
    	break;
    case "kj10":
    	$user_caozuo='jineng';
    	$GO=$_GET['go'];
    	break;
    case "tp":
    	$user_caozuo='taopao';
    		$GO=$_GET['go'];
    	//逃跑
    	break;
    case "zh":
    	//召唤宠物
    	$GO=$_GET['go'];
    	break;	
    case "bz":
    	//捕捉
    	$user_caozuo='buzhuo';
    	$GO=$_GET['go'];
    	break;
    	default:
    	  	$user_caozuo='putong';
    	$GO="putong";

}
	include $_SERVER['DOCUMENT_ROOT']."/class/pvp/pvp_go.php";
}else{}//pvpmd5结束





	//获取发起者
	$pk_user= mysqli_query($db,"SELECT * FROM users WHERE id='".$pk_pve[userid]."'");
$pk_user= mysqli_fetch_array($pk_user);
if($pk_user[qixue]<"1"){
	$user_zhuangtai="no";
}
//获取发起者宠物
//获取用户出站宠物数据宠物
if($pk_user[chongwu_id]!="0"){
$user_chongwu= mysqli_query($db,"SELECT * FROM pet WHERE userid='".$pk_user[id]."' and id='".$pk_user[chongwu_id]."'");
$user_chongwu= mysqli_fetch_array($user_chongwu);
	$userhtml=<<<HTML

<br/>
$user_chongwu[username] <br/>
气血|$user_chongwu[qixue]/$user_chongwu[qixuemax] <br/>
法力|$user_chongwu[fali]/$user_chongwu[fali_max]  <br/>

HTML;


if($user_chongwu[qixue]<"1"){
	$user_chongwu_zhuangtai="no";
}
}else{
	$user_chongwu_zhuangtai="no";
}
	//获取被PK者
	$pk_npc= mysqli_query($db,"SELECT * FROM users WHERE id='".$pk_pve[npcid]."'");
$pk_npc= mysqli_fetch_array($pk_npc);
if($pk_npc[qixue]<"1"){
	$npc_zhuangtai="no";
}
//获取被pk者宠物
//获取用户出站宠物数据宠物
if($pk_npc[chongwu_id]!="0"){
$npc_chongwu= mysqli_query($db,"SELECT * FROM pet WHERE userid='".$pk_npc[id]."' and id='".$pk_npc[chongwu_id]."'");
$npc_chongwu= mysqli_fetch_array($npc_chongwu);
	$npchtml=<<<HTML

<br/>
$npc_chongwu[username] <br/>
气血|$npc_chongwu[qixue]/$npc_chongwu[qixuemax] <br/>
法力|$npc_chongwu[fali]/$npc_chongwu[fali_max]  <br/>

HTML;


if($npc_chongwu[qixue]<"1"){
	$npc_chongwu_zhuangtai="no";
}
}else{
	$npc_chongwu_zhuangtai="no";
}


//人物和宠物死亡执行代码
if ($user_chongwu_zhuangtai=="no" && $user_zhuangtai=="no" ){
$renwu_user="no";
}else{	
	$renwu_user="yes";
	
	}

//人物和宠物死亡执行代码

if ($npc_chongwu_zhuangtai=="no" && $npc_zhuangtai=="no" ){
$renwu_npc="no";
}else{
$renwu_npc="yes";
	
}
//判断是否还有怪物和人物宠是否死亡
if ($renwu_npc=="no"  ||$renwu_user=="no" ){
    //被pk者死亡执行代码
if ($renwu_npc=="no"){
$news=1;
}
//发起者死亡死亡执行代码
if ($renwu_user=="no"){
$news=0;
}
}

$yaopin_html=yaopin(kj1,$user[kj1],pk)."|".yaopin(kj2,$user[kj2],pk)."|".yaopin(kj3,$user[kj3],pk)."|".yaopin(kj4,$user[kj4],pk)."|".yaopin(kj5,$user[kj5],pk);
$jineng_html=jineng(kj6,$user[kj6],$user[zhongzu],pk)."|".jineng(kj7,$user[kj7],$user[zhongzu],pk)."|".jineng(kj8,$user[kj8],$user[zhongzu],pk)."|".jineng(kj9,$user[kj9],$user[zhongzu],pk)."|".jineng(kj10,$user[kj10],$user[zhongzu],pk);
if($userid==$pk_user[id]){
		$html=<<<HTML

<br/>
$pk_user[username] <br/>
气血||$pk_user[qixue]/$pk_user[qixuemax] <br/>
法力|$pk_user[fali]/$pk_user[fali_max]  <br/>
$userhtml
<br/>
$pk_npc[username] <br/>
气血|$pk_npc[qixue]/$pk_npc[qixuemax] <br/>
法力|$pk_npc[fali]/$pk_npc[fali_max]  <br/>
$npchtml
$jineng_html|<a href='pk.do?go=tp&md5=$_G[md5]'>逃跑</a><br/>
$yaopin_html<br/>
HTML;

}else{
		$html=<<<HTML
<br/>
$pk_npc[username]<br/>
气血|$pk_npc[qixue]/$pk_npc[qixuemax] <br/>
法力|$pk_npc[fali]/$pk_npc[fali_max]  <br/>
$npchtml
<br/>
$pk_user[username] <br/>
气血|$pk_user[qixue]/$pk_user[qixuemax] <br/>
法力|$pk_user[fali]/$pk_user[fali_max]  <br/>
$userhtml
$jineng_html|<a href='pk.do?go=tp&md5=$_G[md5]'>逃跑</a><br/>
$yaopin_html<br/>
HTML;
}






//显示内容
switch ($news){
    case 0:
    //发起者死亡
    $sql3 = "delete from pk where id ='".$pk_pve[id]."'";
$ok=mysqli_query($db,$sql3);
    $s="insert into news(text,time,userid) values('不自量力，想要追杀<a href=\'/user/user?id=".$pk_npc[id]."\'>".$pk_npc[username]."</a>却被摁在地上摩擦！','".$pass."','".$pk_user[id]."')";
$ok=mysqli_query($db,$s);

    if($userid==$pk_user[id]){  
    echo"对方非常强大将你反杀，再去修炼几年再来试试吧。";
   $s="insert into email(text,userid,leibie,zhuangtai) values('<a href=\'/user/user?id=".$pk_user[id]."\'>".$pk_user[username]."</a>，不自量力，妄想追杀你，却被你斩于马下。','".$pk_npc[id]."','1','0')";
$ok5=mysqli_query($db,$s);
}else{	
    echo"对方不自量力，妄想追杀你，却被你斩于马下。";
     $s="insert into email(text,userid,leibie,zhuangtai) values('<a href=\'/user/user?id=".$pk_npc[id]."\'>".$pk_npc[username]."</a>非常强大将你反杀，再去修炼几年再来试试吧。','".$pk_user[id]."','1','0')";
$ok5=mysqli_query($db,$s);
}
echo "<br/><a href='/map.games'>返回地图</a> ";
       break;
       case 1:
       	//
       		$user_zuie= mysqli_query($db,"SELECT * FROM users WHERE id='".$pk_user[id]."'");
$user_zuie= mysqli_fetch_array($user_zuie);
    $npc_zuie= mysqli_query($db,"SELECT * FROM users WHERE id='".$pk_npc[id]."'");
$npc_zuie= mysqli_fetch_array($npc_zuie);
if($user_zuie[dengji]>$npc_zuie[dengji]){
    $user_pk_cha=$user_zuie[dengji]-$npc_zuie[dengji];
}else{
   $user_pk_cha=$npc_zuie[dengji]-$user_zuie[dengji]; 
}
if($user_pk_cha>="50" ||$npc_zuie[zhuansheng]<$user_zuie[zhuansheng]){
    $user_zuie[zuie]+="1";
$user_zuie[zuie2]+="5";
    $s="insert into news(text,time,userid) values('不讲武德！欺负<a href=\'/user/user?id=".$pk_npc[id]."\'>".$pk_npc[username]."</a>。罪孽值额外+4。','".$pass."','".$pk_user[id]."')";
$ok=mysqli_query($db,$s);
 //被pk者死亡 
     if($userid==$pk_npc[id]){   	
    echo"<a href=\'/user/user?id=".$pk_user[id]."\'>".$pk_user[username]."</a>以大欺小，将你击杀了！快去升级然后找对手报仇吧！";
       $s="insert into email(text,userid,leibie,zhuangtai) values('你成功击杀了<a href=\'/user/user?id=".$pk_npc[id]."\'>".$pk_npc[username]."</a>，获得罪孽值+5、罪恶值+1','".$pk_user[id]."','1','0')";
$ok5=mysqli_query($db,$s);
}else{	
	echo"你成功击杀了对手，获得罪孽值+5、罪恶值+1。";
    $s="insert into email(text,userid,leibie,zhuangtai) values('<a href=\'/user/user?id=".$pk_user[id]."\'>".$pk_user[username]."</a>对手以大欺小，将你击杀了！快去升级然后找对手报仇吧','".$pk_npc[id]."','1','0')";
$ok5=mysqli_query($db,$s);
}
}else{
$jine=$npc_zuie[gold]*0.5;
$npc_zuie[gold]-=$jine;
$jine2=$jine*0.5;
$user_zuie[gold]+=$jine2;
$user_zuie[zuie]+="1";
$user_zuie[zuie2]+="1";
$s="insert into news(text,time,userid) values('被<a href=\'/user/user?id=".$pk_user[id]."\'>".$pk_user[username]."</a>击杀了，掉了".$jine."个金条，其中50%归<a href=\'/user/user?id=".$pk_user[id]."\'>".$pk_user[username]."</a>所有。','".$pass."','".$pk_npc[id]."')";
$ok=mysqli_query($db,$s); 
			//人物对象
			$sql1="update users set gold='".$npc_zuie[gold]."' where id='".$pk_npc[id]."'";
$ok=mysqli_query($db,$sql1);
 //被pk者死亡 
     if($userid==$pk_npc[id]){   	
    echo"你被击杀了!掉落金条".$jine."个。";
       $s="insert into email(text,userid,leibie,zhuangtai) values('你成功击杀了<a href=\'/user/user?id=".$pk_npc[id]."\'>".$pk_npc[username]."</a>，获得".$jine2."个金条，罪孽值+1、罪恶值+1。','".$pk_user[id]."','1','0')";
$ok5=mysqli_query($db,$s);
}else{	
	echo"你成功击杀了对手，获得金条".$jine2."个,罪孽值+1、罪恶值+1。";
    $s="insert into email(text,userid,leibie,zhuangtai) values('你被<a href=\'/user/user?id=".$pk_user[id]."\'>".$pk_user[username]."</a>击杀了，掉落了".$jine."个金条','".$pk_npc[id]."','1','0')";
$ok5=mysqli_query($db,$s);
}
}
$sql1="update users set zuie='".$user_zuie[zuie]."',zuie2='".$user_zuie[zuie2]."',gold='".$user_zuie[gold]."' where id='".$user_zuie[id]."'";
$ok=mysqli_query($db,$sql1);
       
    $sql3 = "delete from pk where id ='".$pk_pve[id]."'";
$ok=mysqli_query($db,$sql3);
       	
   
echo "<br/><a href='/map.games'>返回地图</a> ";
       break;
    default:
	//打印数据
	
	echo $html;


	    break;
	       }
	
	
	echo  "<br/><br/>【战斗状况】<br/><br/>";
$result = mysqli_query($db,"SELECT * FROM pvp_tip WHERE cid='".$pk_pve[id]."'order by id DESC limit 38");
while($row = mysqli_fetch_array($result))
 {
echo  "$row[text]<br/>";
}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
echo footer();
	exit();
	
	
	
}else{
       echo "对手已逃跑，或战斗已结束~<a href='/map.games'>返回地图</a>！<br/>";
}