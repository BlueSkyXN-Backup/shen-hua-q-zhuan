<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
//进入战斗生成怪物的函数
$resultl = mysqli_query($db,"SELECT * FROM guaiwu WHERE userid='".$user['id']."' and map='".$user['map']."' and qixue>'0'");
$guaiwu = mysqli_fetch_array($resultl);
if (!$guaiwu){
$resultl = mysqli_query($db,"SELECT * FROM map WHERE id='".$user['map']."'");
$map= mysqli_fetch_array($resultl);
if ($map['guaiwu']!=NULL){
    if(!$_SESSION['guaiwuid']){//不存在数量生成执行生成数量
        $guaiwu=array();
$guaiwu_id= explode(",", $map['guaiwu']); 
$guaiwu_shu=count($guaiwu_id);
$guaiwu_shu-="1";
//随机怪物数量
$suiji=rand(2,6);
for ($j=1;$j<$suiji;$j++) 
{
$suiji_guaiwu=rand(0,$guaiwu_shu);
   array_push($guaiwu,$guaiwu_id[$suiji_guaiwu]);
}
$guaiwu=(array_count_values($guaiwu));
    }else{
    	$guaiwu=(array_count_values($_SESSION['guaiwuid']));
    }



 foreach($guaiwu as $guaiwu_a=>$guaiwu_b){//依次取出数组中元素，$a是元素的键名$b是键值
$muban = mysqli_query($db,"SELECT * FROM muban_guaiwu WHERE id='".$guaiwu_a."'");
$muban = mysqli_fetch_array($muban);
for ($j=0;$j<$guaiwu_b;$j++) 
{
$shuxing_dian=$muban['dengji'];
$shuxing_dian*=2;

//计算怪物成长率
$chengzhanglv=rand($muban['chengzhanglv'],$muban['chengzhanglvs']);
$chengzhanglv/="100";
$shuxing_dian*=$chengzhanglv;
$xidian_qixue=$muban['qixue'];
$xidian_fali=$muban['fali'];
$xidian_qixuemax=$muban['qixue_max'];
$xidian_falimax=$muban['fali_max'];
$xidian_fangyu=$muban['fangyu'];
$xidian_fagong=$muban['fagong'];
$xidian_wugong=$muban['wugong'];
$xidian_sudu=$muban['sudu'];

$xidian_qixue*=$shuxing_dian;
$xidian_fali*=$shuxing_dian;$xidian_qixuemax*=$shuxing_dian;
$xidian_falimax*=$shuxing_dian;
$xidian_fangyu*=$shuxing_dian;
$xidian_fagong*=$shuxing_dian;
$xidian_wugong*=$shuxing_dian;
$xidian_sudu*=$shuxing_dian;
//取整


$xidian_qixue=ceil($xidian_qixue);
$xidian_fali=ceil($xidian_fali);
$xidian_qixuemax=ceil($xidian_qixuemax);
$xidian_falimax=ceil($xidian_falimax);
$xidian_fangyu=ceil($xidian_fangyu);
$xidian_fagong=ceil($xidian_fagong);
$xidian_wugong=ceil($xidian_wugong);
$xidian_sudu=ceil($xidian_sudu);


$guaiwuid=$muban['id'];
$name=$muban['name'];
$text=$muban['text'];
$map=$user['map'];
$dengji=$muban['dengji'];
$dengji_max=$muban['dengji_max'];
$zhongzu=$muban['zhongzu'];
$qixue=$xidian_qixue;
$qixue_max=$xidian_qixuemax;
$fali=$xidian_fali;
$fali_max=$xidian_falimax;
$fangyu=$xidian_fangyu;
$fagong=$xidian_fagong;
$wugong=$xidian_wugong;
$sudu=$xidian_sudu;
$guaiwujinengs = explode("|",$muban['jineng']);
$guaiwujineng=count($guaiwujinengs);
$guaiwujineng-=1;
 $guaiwujineng=rand(0,$guaiwujineng);
$s="insert into guaiwu(yuanshi,userid,username,text,buzhuo,map,chengzhanglv,dengji,dengji_max,zhongzu,qixue,qixuemax,fali,fali_max,fangyu,gongji_fa,gongji,sudu,jineng,pojia,mianshang) values('".$guaiwuid."','".$userid."','".$name.$j."','".$text."','".$muban['buzhuo']."','".$map."','".$chengzhanglv."','".$dengji."','".$dengji_max."','".$zhongzu."','".$qixue."','".$qixue_max."','".$fali."','".$fali_max."','".$fangyu."','".$fagong."','".$wugong."','".$sudu."','".$guaiwujinengs[$guaiwujineng]."','".$muban['pojia']."','".$muban['mianshang']."')";
$ok=mysqli_query($db,$s);
}
}
}
}
unset($_SESSION['guaiwuid']);