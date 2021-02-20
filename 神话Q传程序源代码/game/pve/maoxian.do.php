<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
//
$pvp_leixing="maoxian";
if($user['mys']!="maoxian"){
    echo "野怪被偷走了~<a href='/maoxian/map'>返回副本</a>！<br/>";
     mysqli_query($db,"update users set mys='map' where id='".$userid."'");
       exit();
}
	$maoxian = mysqli_query($db,"SELECT * FROM maoxian WHERE duiwuid='".$user[duiwu_id]."'");
$maoxian = mysqli_fetch_array($maoxian);
if(!$maoxian){
	header("location:../maoxian/map");//跳转地址
}
	$muban = mysqli_query($db,"SELECT * FROM muban_maoxian WHERE id='".$maoxian[leibie]."'");
$muban = mysqli_fetch_array($muban);
$guanqia = explode("|", $muban[xiaoguo]); 	//获取模板数据
$guan=$maoxian[guan]-1;
$guanqia_shuju= explode(",", $guanqia[$guan]);
if($maoxian[guaiwushu]>=$guanqia_shuju['1']){
    echo"击杀达标";
    header("location:../maoxian/map");//跳转地址
    exit();
}
$wg_leixing="maoxian";
$pk[id]=$userid.$user[map]."maoxian";
//战斗操作
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
$news=3;//初始化news变量
//最多只能攻击怪物数的次数
//获取用户出站宠物数据宠物
if($user[chongwu_id]!="0"){
$chongwu= mysqli_query($db,"SELECT * FROM pet WHERE userid='".$userid."' and id='".$user[chongwu_id]."'");
$chongwu= mysqli_fetch_array($chongwu);}
if ($user[qixue]<"1"){
$user[zhuangtai]="no";
}
if ($chongwu[zhuangtai]<"1" ){
$chongwu[zhuangtai]="no";
}
//人物和宠物死亡执行代码
if ($user[zhuangtai]=="no" && $chongwu[zhuangtai]=="no" ){
$renwu_zhuangtai="no";
}
//获取当前地图有几只怪物$guaiwu_shu
$result = mysqli_query($db,"SELECT * FROM guaiwu WHERE  userid='".$userid."' and map='".$maoxian[id]."' and leixing='".$wg_leixing."' and qixue>'0'");
$guaiwu_shu=mysqli_num_rows($result);

//判断是否还有怪物和人物宠是否死亡
if ($renwu_zhuangtai=="no"||$guaiwu_shu<"1" ){
    //怪物没有了执行代码
if ($guaiwu_shu<"1" ){
$news=1;
}
//人物和宠物死亡执行代码
if ($user[zhuangtai]=="no" && $chongwu[zhuangtai]=="no" ){
$news=0;
}
}else{



//打入用户参与战斗的
$b= array(array('name'=>'user|'.$user[id],'sudu'=>$user[sudu],'qixue'=>$user[qixue],'fali'=>$user[fali],'duixiang'=>'0'));
//获取用户出站宠物数据宠物
if($user[chongwu_id]!="0"){
$chongwu= mysqli_query($db,"SELECT * FROM pet WHERE userid='".$userid."' and id='".$user[chongwu_id]."'");
$chongwu= mysqli_fetch_array($chongwu);
$c=array('name'=>'pet|'.$chongwu[id],'sudu'=>$chongwu[sudu],'qixue'=>$chongwu[qixue],'fali'=>$chongwu[fali],'duixiang'=>'0');
$b[] = $c;
$zhandou_chongwu="$chongwu[username]|血：$chongwu[qixue]/$chongwu[qixuemax]<br/>法：$chongwu[fali]/$chongwu[fali_max]";
}
//获取当前地图怪物数据
$result = mysqli_query($db,"SELECT * FROM guaiwu WHERE userid='".$userid."' and map='".$maoxian[id]."' and leixing='".$wg_leixing."' and qixue>'0'");
while($row = mysqli_fetch_array($result)){
$c=array('name'=>'guaiwu|'.$row[id],'sudu'=>$row[sudu],'qixue'=>$row[qixue],'fali'=>$user[guaiwu],'duixiang'=>'1');
$b[] = $c;
$zhandou_guaiwu.="<br/>$row[username]|血：$row[qixue]/$row[qixuemax]";
     $guaiwusss = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$row[yuanshi]."'");
$guaiwuimg=mysqli_fetch_array($guaiwusss); 
}
//进行排序
$list =getSort($b,'sudu',SORT_DESC);//按速度进行排序
$xiaohao_xuefa=$list;//这个变量统计怪物消耗血量


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
	

}else{
	$result = mysqli_query($db,"SELECT * FROM guaiwu WHERE userid='".$userid."' and leixing='".$wg_leixing."' and map='".$maoxian[id]."'and qixue>'0'");
while($row = mysqli_fetch_array($result))
  {
$yuanshiids.="|$row[yuanshi]";//获取怪物原始id
  }
$yuanshiids=substr($yuanshiids,1);//获取怪物原始id
$_SESSION['yuanshi']=$yuanshiids;
//获取所有怪物的原始id，战斗胜利结算奖励
//设置战斗时人物必须复活
if ($user[zhuangtai]=="no"){
$news=0;
}


}


//pvpmd5结束
}


$user = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM users WHERE id='".$userid."'"));
if ($user[qixue]<"1"){
$user[zhuangtai]="no";
}
if ($chongwu[zhuangtai]<"1" ){
$chongwu[zhuangtai]="no";
}
//人物和宠物死亡执行代码
if ($user[zhuangtai]=="no" && $chongwu[zhuangtai]=="no" ){
$renwu_zhuangtai="no";
}
//获取当前地图有几只怪物$guaiwu_shu
$result = mysqli_query($db,"SELECT * FROM guaiwu WHERE  userid='".$userid."' and map='".$maoxian[id]."' and leixing='".$wg_leixing."' and qixue>'0'");
$guaiwu_shu=mysqli_num_rows($result);
//判断是否还有怪物和人物宠是否死亡
if ($renwu_zhuangtai=="no"||$guaiwu_shu<"1" ){
    //怪物没有了执行代码
if ($guaiwu_shu<"1" ){
$news=1;
}
//人物和宠物死亡执行代码
if ($user[zhuangtai]=="no" && $chongwu[zhuangtai]=="no" ){
$news=0;
}
}


//显示内容
switch ($news):
    case 0:
    	//定义战亡显示
if($user[dengji]<"31"){

$html=<<<HTML

战斗失败<br/>
站亡并不可怕，可怕的总是站亡。
<a href='/Mall/Introduce.php?id=7'>神话黄金套装大礼包</a>让你远离站亡，成为神话战士！
<br/>
<a href='/fuhuo.php?my=1'>原地复活</a>（等级<=30级没有死亡惩罚） <br/>
<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>
HTML;
}else{
  $html=<<<HTML

战斗失败<br/>
站亡并不可怕，可怕的总是站亡。
<a href='/Mall/Introduce.php?id=7'>神话黄金套装大礼包</a>让你远离站亡，成为神话战士！
<br/>
<a href='/fuhuo.php?my=1'>免费复活</a>（有死亡惩罚） <br/><a href='/fuhuo.php?my=2'>道具复活</a>（原地满血复活，没有任何死亡惩罚。需要<a href='/Mall/Introduce.php?id=64'>替身娃娃</a>）<br/>
<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>
HTML;
}
$_SESSION['md5']=md5(md5(time()));
        break;
case 1:
    $html=<<<HTML

战斗胜利<a href='/map.games'>返回地图</a> <br/>
<a href='/pve/pve.do?GO=maoxian'>继续打怪</a> <br/>

HTML;
    if($_GET['md5']){
    if($_GET['md5']!=$_G[md5]){
      $html.="请不要重复刷新战斗胜利页面！";
    }else{
        $yuanshijiangli=$_SESSION['yuanshi'];
//获得奖励开始
$guaiwu_yuanshi= explode("|", $yuanshijiangli); 
for($jl=0;$jl<count($guaiwu_yuanshi);$jl++) 
{

	//更新副本击杀
		$map2 = mysqli_query($db,"SELECT * FROM maoxian WHERE duiwuid='".$user[duiwu_id]."'");
$map2 = mysqli_fetch_array($map2);

if($maoxian[guan]==$map2[guan]){

    $guanqia_shuju2= explode("-", $guanqia_shuju[0]);
	if($guanqia_shuju2[0]==$guaiwu_yuanshi[$jl]){
	$map2[guaiwushu]+=1;
	   $sql1="update maoxian set guaiwushu='".$map2[guaiwushu]."'where duiwuid='".$user[duiwu_id]."'";
$ok1=mysqli_query($db,$sql1);

	}
}
}
    
	$_SESSION['md5']=md5(md5(time()));
include $_SERVER['DOCUMENT_ROOT']."/class/pve/pve_news1.php";
}}



        break;
default:
	

foreach($xiaohao_xuefa as $ksss=>$vsss){
$xiaohao_yuanshi= explode("|", $vsss['name']); 
	$s123guai=$xiaohao_yuanshi[0].$xiaohao_yuanshi[1];
	$xiaohaos_xue[$s123guai]=$vsss['qixue'];
	$xiaohaos_fa[$s123guai]=$vsss['fali'];
}
//获取人物战斗血量的消耗

		$aj123guaiwu="user".$user[id];
	if($xiaohaos_xue[$aj123guaiwu]){
		if($user[qixue]>$xiaohaos_xue[$aj123guaiwu]){
			$guai1=$user[qixue]-$xiaohaos_xue[$aj123guaiwu];
			$user_guai1="[+".$guai1."]";
		}elseif($user[qixue]<$xiaohaos_xue[$aj123guaiwu]){
			$guai1=$xiaohaos_xue[$aj123guaiwu]-$user[qixue];
			$user_guai1="[-".$guai1."]";
	}}
		if($xiaohaos_fa[$aj123guaiwu]){
		if($user[fali]>$xiaohaos_fa[$aj123guaiwu]){
			$guai2=$user[fali]-$xiaohaos_fa[$aj123guaiwu];
			$user_guai2="[+".$guai2."]";
		}elseif($user[fali]<$xiaohaos_fa[$aj123guaiwu]){
			$guai2=$xiaohaos_fa[$aj123guaiwu]-$user[fali];
			$user_guai2="[-".$guai2."]";
	}}
	//获取宠物战斗血量的消耗
if($user[chongwu_id]!="0"){
		$aj123guaiwu="pet".$chongwu[id];
	if($xiaohaos_xue[$aj123guaiwu]){
		if($chongwu[qixue]>$xiaohaos_xue[$aj123guaiwu]){
			$guai1=$chongwu[qixue]-$xiaohaos_xue[$aj123guaiwu];
			$chongwu_guai1="[+".$guai1."]";
		}elseif($chongwu[qixue]<$xiaohaos_xue[$aj123guaiwu]){
			$guai1=$xiaohaos_xue[$aj123guaiwu]-$chongwu[qixue];
			$chongwu_guai1="[-".$guai1."]";
	}}
	$zhandou_chongwu="$chongwu[username]|血：$chongwu[qixue]/$chongwu[qixuemax]".$chongwu_guai1."<br/>";
}

//获取当前地图怪物数据
$result = mysqli_query($db,"SELECT * FROM guaiwu WHERE userid='".$user['id']."' and map='".$maoxian[id]."' and leixing='".$wg_leixing."' and qixue>'0'");
$zhandou_guaiwu=NULL;
while($row = mysqli_fetch_array($result)){
	$aj123guaiwu="guaiwu".$row['id'];
		$guai1=null;
	if($xiaohaos_xue['$aj123guaiwu']){
		if($row['qixue']>$xiaohaos_xue['$aj123guaiwu']){
			$guai1=$row['qixue']-$xiaohaos_xue['$aj123guaiwu'];
			$guai1="['+".$guai1."']";
		}elseif($row['qixue']<$xiaohaos_xue['$aj123guaiwu']){
			$guai1=$xiaohaos_xue['$aj123guaiwu']-$row['qixue'];
			$guai1="['-".$guai1."']";
	}}
$zhandou_guaiwu.="<br/>".$row['username']."|血：".$row['qixue']."/".$row['qixuemax'].$guai1;
}
$yaopin_html=yaopin(kj1,$user[kj1],maoxian)."|".yaopin(kj2,$user[kj2],maoxian)."|".yaopin(kj3,$user[kj3],maoxian)."|".yaopin(kj4,$user[kj4],maoxian)."|".yaopin(kj5,$user[kj5],maoxian);
$jineng_html=jineng(kj6,$user[kj6],$user[zhongzu],maoxian)."|".jineng(kj7,$user[kj7],$user[zhongzu],maoxian)."|".jineng(kj8,$user[kj8],$user[zhongzu],maoxian)."|".jineng(kj9,$user[kj9],$user[zhongzu],maoxian)."|".jineng(kj10,$user[kj10],$user[zhongzu],maoxian);


$html=<<<HTML
<img src='/img/$guaiwuimg[img]'  width='90' height='100' /><br/>



$zidong<a href='maoxian.do?go=bz&md5=$_G[md5]'>捕捉</a> <a href='maoxian.do?go=tp&md5=$_G[md5]'>逃跑</a> 
<br/>技能：<a href='maoxian.do?go=putong&md5=$_G[md5]'>普通</a>$jineng_html
 
<br/>药品：$yaopin_html

<br/>
我|血：$user[qixue]/$user[qixuemax] $user_guai1<br/>
我|法：$user[fali]/$user[fali_max]  $user_guai2<br/>
<br/>
$zhandou_chongwu==================
$zhandou_guaiwu
HTML;
endswitch;
echo $html;
echo  "<br/><br/>【最近60条战斗状况】<br/>";
$result = mysqli_query($db,"SELECT * FROM pvp_tip WHERE cid='".$pk[id]."'order by id DESC limit 60");
while($row = mysqli_fetch_array($result))
 {
echo  "$row[text]<br/>";
}
$sql3 = "delete from guaiwu where qixue<'1'";
$ok=mysqli_query($db,$sql3);
if($ok){
	echo"ok";
}