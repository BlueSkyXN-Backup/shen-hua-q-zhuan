<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
class wapwork{
	public function title($title){

}

}

$wapwork=new wapwork();
$xyz=new xyz();
	class xiangqian{
	public $x;
	var $shuju;
function xianshi($shuju){
		//解析数据
		 $yangshi=explode(",",$shuju); 
		 //0,宝石类型//1，宝石等级
		 switch ($yangshi['0']) {
  case "1":
    $baoshi_leixing="绿宝石";
    $baoshi_id="1";   $baoshi_shuxing="0,150,540,1000,2100,6000,24000,104000,450000,1600000,9000000";
    $baoahi_xiaoguo="qixue";
      $baoahi_name="气血";
    break;
    case "2":
    $baoshi_leixing="黑宝石";
    $baoshi_id="2";  $baoshi_shuxing="0,80,259,480,1080,2880,11200,49920,216000,768000,4320000";
    $baoahi_xiaoguo="qixue";
      $baoahi_name="速度";
    break;
case "3":
    $baoshi_leixing="美玉";
    $baoshi_id="3";   $baoshi_shuxing="0,100,324,600,1260,3600,14000,62400,270000,960000,5400000";
    $baoahi_xiaoguo="fagong";
      $baoahi_name="法攻";
    break;
case "4":
    $baoshi_leixing="绿松玉";
    $baoshi_id="4";  $baoshi_shuxing="0,110,356,660,1386,3960,15400,68640,197000,1056000,5940000";
    $baoahi_xiaoguo="fangyu";
      $baoahi_name="防御";
    break;
case "5":
    $baoshi_leixing="红玛瑙";
    $baoshi_id="5"; $baoshi_shuxing=$baoshi_shuxing="0,100,324,600,1260,3600,14000,62400,270000,960000,5400000";
    $baoahi_xiaoguo="wugong";
      $baoahi_name="物攻";
    break;
case "6":
    $baoshi_leixing="紫水晶";
    $baoshi_id="6"; $baoshi_shuxing="0,150,540,1000,2100,6000,24000,104000,450000,1600000,9000000";
     $baoahi_name="法力";
    break;
    case "7":
    $baoshi_leixing="破甲石";
    $baoshi_id="7"; $baoshi_shuxing="0,40,129,240,540,1440,5600,24960,108000,384000,2160000";
    $baoahi_xiaoguo="pojia";
     $baoahi_name="破甲";
    break;
      case "8":
    $baoshi_leixing="太乙天石";
    $baoshi_id="8"; $baoshi_shuxing="0,40,129,240,540,1440,5600,24960,68000,184000,360000";
    $baoahi_xiaoguo="pojia33";
     $baoahi_name="体质";
    break;
      default:
    echo "系统错误";
exit();
    break;
}
 $shuxing=explode(",",$baoshi_shuxing); 
		//判定宝石类型结束，获取宝石等级计算。
		//定义出最终属性
		$xiaoguo=$shuxing[$yangshi['1']];
		
		return $xiaoguo."|".$yangshi['1']."|".$baoshi_leixing."|".$baoahi_name."|".$baoshi_id;	
	}	
}
//实例化类
$xiangqian=new xiangqian();


//时间转换
function timesecond($seconds){
	$seconds = (int)$seconds;
	if( $seconds>3600 ){
		if( $seconds>24*3600 ){
			$days		= (int)($seconds/86400);
			$days_num	= $days."天";
			$seconds	= $seconds%86400;//取余
		}
		$hours = intval($seconds/3600);
		$minutes = $seconds%3600;//取余下秒数
		$time = $days_num.$hours."小时".gmstrftime('%M分钟%S秒', $minutes);
	}else{
		$time = gmstrftime('%H时%M分%S秒', $seconds);
	}
	return $time;
}

//装备强化数
function zhuangbei_qianghua($shuju,$qianghua){
switch ($qianghua) {
  case "1":
  $qianghua="0.05";
    break;
  case "2":
  $qianghua="0.15";
    break;
  case "3":
  $qianghua="0.25";
    break;
  case "4":
  $qianghua="0.40";
    break;
  case "5":
  $qianghua="0.55";
    break;
  case "6":
  $qianghua="0.70";
    break;
  case "7":
  $qianghua="0.90";
    break;
  case "8":
  $qianghua="1.30";
    break;
  case "9":
  $qianghua="1.80";
    break;
  case "10":
  $qianghua="2.50";
    break;
    case "11":
  $qianghua="5.50";
    break;
    case "12":
  $qianghua="12.50";
    break;
}
$qianghua*=$shuju;
$qianghua=floor($qianghua);
return $qianghua;
}

//获取页面文件名
function php_self(){

    $php_self=substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);

    return $php_self;

}



//数字转换汉字
function china_num($num,$mode=true) {
  $char = array("零","一","二","三","四","五","六","七","八","九");
  $dw = array("","十","百","千","","万","亿","兆");
  $dec = "点";
  $retval = "";
  if($mode)
    preg_match_all("/^0*(\d*)\.?(\d*)/",$num, $ar);
  else
    preg_match_all("/(\d*)\.?(\d*)/",$num, $ar);
  if($ar['2']['0'] != "")
    $retval = $dec . ch_num($ar['2']['0'],false); //如果有小数，则用递归处理小数
  if($ar['1']['0'] != "") {
    $str = strrev($ar['1']['0']);
    for($i=0;$i<strlen($str);$i++) {
      $out[$i] = $char[$str[$i]];
      if($mode) {
        $out[$i] .= $str[$i] != "0"? $dw[$i%4] : "";
        if($str[$i]+$str[$i-1] == 0)
          $out[$i] = "";
        if($i%4 == 0)
          $out[$i] .= $dw[4+floor($i/4)];
      }
    }
    $retval = join("",array_reverse($out)) . $retval;
  }
  return $retval;
}

function zhuangbei_name($zhuangbeiid){
   global $db;
  $zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$zhuangbeiid."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbei['yuanshi']."'");
$muban_zhuangbei= mysqli_fetch_array($muban_zhuangbei);
//获取宝石镶嵌
$zb_kong="0";
$zb_shi="0";
if($zhuangbei['xq1']=="0"){

}elseif($zhuangbei['xq1']=="1"){
$zb_kong+="1";
}else{
$zb_shi+="1";
$zb_kong+="1";
}
if($zhuangbei['xq2']=="0"){

}elseif($zhuangbei['xq2']=="1"){
$zb_kong+="1";
}else{
$zb_shi+="1";
$zb_kong+="1";
}

if($zhuangbei['xq3']=="0"){

}elseif($zhuangbei['xq3']=="1"){
$zb_kong+="1";
}else{
$zb_shi+="1";
$zb_kong+="1";
}

if($zhuangbei['xq4']=="0"){

}elseif($zhuangbei['xq4']=="1"){
$zb_kong+="1";
}else{
$zb_shi+="1";
$zb_kong+="1";
}

if($zhuangbei['xq5']=="0"){

}elseif($zhuangbei['xq5']=="1"){
$zb_kong+="1";
}else{
$zb_shi+="1";
$zb_kong+="1";
}

if($zhuangbei['xq6']=="0"){

}elseif($zhuangbei['xq6']=="1"){
$zb_kong+="1";
}else{
$zb_shi+="1";
$zb_kong+="1";
}
if($zb_shi!="0"){
$zbshi=$zb_shi."石";
}else{
$zbshi="";
}
//获取宝石镶嵌结束
//获取强化
$zb_qiang="0";
$zb_qiang+=$zhuangbei['qh1'];
$zb_qiang+=$zhuangbei['qh2'];
$zb_qiang+=$zhuangbei['qh3'];
$zb_qiang+=$zhuangbei['qh4'];
$zb_qiang+=$zhuangbei['qh5'];
$zb_qiang+=$zhuangbei['qh6'];
if($zb_qiang!="0"){
$zbqiang="强".$zb_qiang;
}else{
	$zbqiang="";
}
if($zhuangbei[time]==null){
    $zhuangtai="";
}else{
    // $zhuangbei[time]-=time();
    // $zhuangbei[time]/=86400;
    // $zhuangtai=ceil($zhuangbei[time]);
    // $zhuangtai="(".$zhuangtai."天)";
}
if($muban_zhuangbei['leixing']=="fw"){
    $zhuangbei_name="<a href='/zb/zb.shuxing?id=".$zhuangbei['id']."'><wap class='".$muban_zhuangbei['divs']."'>".$muban_zhuangbei['name']."".$zhuangtai."</a></wap>";
}else{
$zhuangbei_name="<a href='/zb/zb.shuxing?id=".$zhuangbei['id']."'><wap class='".$muban_zhuangbei['divs']."'>".$muban_zhuangbei['name']."".$zhuangtai."</a>".$zb_kong."孔".$zbshi.$zbqiang."</wap>";
}
   return $zhuangbei_name;
}

function zhuangbei_yuanshi($zhuangbeiid){
   global $db;
$muban_zhuangbei = mysqli_query($db,"SELECT * FROM muban_zhuangbei WHERE id='".$zhuangbeiid."'");
$muban_zhuangbei= mysqli_fetch_array($muban_zhuangbei);

    $zhuangbei_name="<wap class='".$muban_zhuangbei['divs']."'>".$muban_zhuangbei['name']."</wap>";

   return $zhuangbei_name;
}

function page($url,$totalPage,$page,$get){
	//链接。最大地址。当前page
	$html.="第".$page."页/共".$totalPage."页";
$qq=$page-1;
if ($page != 1) { 
$html.="<a href='".$url."page=".$qq."'>上一页</a>";
} 
if ($page<$totalPage) { 
$qqw=$page+1;
$html.="<a href='".$url."page=".$qqw."'>下一页</a> ";
}
$html.='<form action="'.$url.'" method="get"> 
<input type="text" name="page" />';
if($get){
	$get= explode("|", $get);
	$html.='<input type="hidden" name="'.$get[0].'" value="'.$get[1].'">';
}
$html.='<input type="submit" value="翻页" class="link"/></form>';
return $html;
}


function footer(){
    global $db;
    global $user;
    //获取是否有未读消息
$resultl = mysqli_query($db,"SELECT * FROM haoyou_email WHERE zhuangtai='0' and yourid='".$user[id]."'");
$email= mysqli_fetch_array($resultl);
if ($email){
$haoyou_tip="<img src='/img/message.gif'  alt='新消息' />";
}
	$html="<div class='tip'>【更多功能】</div><cebter>============</center><br/><a href='/user.parcel'>背包</a>|<a href='/task/list.task?id=1'>任务</a>|<a href='/jineng/index'>技能</a>|<a href='/bangpai/index.php'>帮派</a><br/><a href='/Pet/index.php?my=1'>宠物</a>|<a href='/Friend/index.php'>好友$haoyou_tip</a>|<a href='/user/my'>状态</a>|<a href='/Mall/Mall.php?my=jiben'>商城</a><br/><a href='/Settings/index'>设置</a>|<a href='/Rank/Rank.php'>排行</a>|<a href='/Transaction/index'>交易</a>|<a href='/cdk/cdk'>兑换</a> <br/>";
return $html;
}

function head(){
    global $db;
    global $user;
    global $userid;
    $resultl = mysqli_query($db,"SELECT * FROM email WHERE zhuangtai='0' and userid='".$user[id]."'");
$email= mysqli_fetch_array($resultl);
if ($email){
$email_tip="<img src='/img/message.gif'>";
}
    $zhongzu_men=array("2"=>"171","3"=>"94","5"=>"154","4"=>"138","1"=>"187");
$zhongzu=$user[zhongzu];
if($user[sign_time]=="0"){
    $tan="<img src='/img/tan.gif'  alt='$row[name]' />";
}
$zaixianshijian=time()-$_SESSION['time'];
if($userid=="1"){
	$zaixianshijian="99999999999";
}
if($user[sign_time_one]=="0" and $zaixianshijian>"3600"){
    $tan="<img src='/img/tan.gif'  alt='$row[name]' />";
}
if($user[sign_time_two]=="0" and $zaixianshijian>"7200"){
    $tan="<img src='/img/tan.gif'  alt='$row[name]' />";
}
if($user[sign_time_three]=="0" and $zaixianshijian>"10800"){
    $tan="<img src='/img/tan.gif'  alt='$row[name]' />";
}
if($user[sign_time_four]=="0" and $zaixianshijian>"14400"){
    $tan="<img src='/img/tan.gif'  alt='$row[name]' />";
}
$qinglv_si=mysqli_fetch_array(mysqli_query($db,"select * from qinglv where nan IN('".$userid."') or nv IN('".$userid."')"));
if($user[sign_qinglv]=="0" and $qinglv_si){
    $tan="<img src='/img/tan.gif'  alt='$row[name]' />";
}
$bangpai_si = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM bangpai_user WHERE userid='".$userid."'"));

if($user[sign_bangpai]=="0" and $bangpai_si){
    $tan="<img src='/img/tan.gif'  alt='$row[name]' />";
}
	$html="<br/><a href='/Sign/Sign.php?my=index'>".$tan."领奖</a>|<a href='/email/chat'>聊天</a>|<a href='/map.games?id=43'>名人堂</a>|<a href='/map.games?id=".$zhongzu_men[$zhongzu]."'>回门</a>|<a href='/Transfer/index'>传送</a>|<a href='/ranks/index.php'>队伍</a>|<a href='/npc.do?id=39'>黑心商店</a>|<a href='/Friend/email.php?my=0'>消息</a>".$email_tip."|<a href='/Strengthen/index'>强化</a>|<a href='/Sign/fanpai_index.php'>翻牌</a>|<a href='/fuben/index'>副本</a>|<a href='/maoxian/index'>冒险</a>|<a href='/jineng/xiangqian_index.php'>镶嵌</a>|<a href='/yaojiang/index'>摇奖</a>|<a href='/yaojiang/duobao_index'>夺宝</a><br/>";
return $html;
}


function zhandou_sudu($user,$npc){
    if($user<$npc){
      $to=$npc/$user;
      if($to>"2"){
        return no;  
      }else{
          return yes;
      }
    }else{
       return yes;
    }
    
}
?>