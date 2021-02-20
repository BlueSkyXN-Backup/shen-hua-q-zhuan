<?php
if (!defined('wapxyz')) {
	exit('Not Found WAPWORK,程序异常操作！');
}
include $_SERVER['DOCUMENT_ROOT']."/class/class.php";
$id=$_GET['id'];
$leixing=$_GET['leixing'];

$chongwuid=$_GET['chongwuid'];
switch ($leixing) {
  case "maozi":
    echo "可装备帽子<br/>";
     $leixing1=$leixing;
    break;
  case "xianglian":
    echo "可装备项链<br/>";
     $leixing1=$leixing;
    break;
  case "yifu":
    echo "可装备衣服<br/>";
     $leixing1=$leixing;
    break;
  case "wuqi":
    echo "可装备武器<br/>";
     $leixing1=$leixing;
    break;
  case "xiezi":
    echo "可装备鞋子<br/>";
     $leixing1=$leixing;
    break;
      case "ps1":
    echo "可装备发饰<br/>";
     $leixing1=$leixing;
    break;  
  case "ps2":
    echo "可装备翅膀<br/>";
     $leixing1=$leixing;
    break;
      case "ps3":
    echo "可装备披风<br/>";
     $leixing1=$leixing;
    break;
      case "ps4":
    echo "可装备戒指<br/>";
     $leixing1=$leixing;
    break;
      case "ps5":
    echo "可装备腰带<br/>";
     $leixing1=$leixing;
    break;
      case "ps6":
    echo "可装备手镯<br/>";
     $leixing1=$leixing;
    break;
      case "ps7":
    echo "可装备勋章<br/>";
     $leixing1=$leixing;
    break;
      case "ps8":
    echo "可装备耳环<br/>";
     $leixing1=$leixing;
    break;
          case "fw1":
    echo "可装备符文<br/>";
     $leixing1=$leixing;
    $leixing="fw";
    break;      
    case "fw2":
    echo "可装备符文<br/>";
     $leixing1=$leixing;
     $leixing="fw";
    break;
          case "fw3":
    echo "可装备符文<br/>";
     $leixing1=$leixing;
     $leixing="fw";
    break;
          case "fw4":
    echo "可装备符文<br/>";
     $leixing1=$leixing;
     $leixing="fw";
    break;
          case "fw5":
    echo "可装备符文<br/>";
     $leixing1=$leixing;
     $leixing="fw";
    break;
            case "sz1":
    echo "可装备头饰<br/>";
     $leixing1=$leixing;
   
    break;      
    case "sz2":
    echo "可装备背饰<br/>";
     $leixing1=$leixing;
     
    break;
          case "sz3":
    echo "可装备吊坠<br/>";
     $leixing1=$leixing;
    
    break;
          case "sz4":
    echo "可装备上衣<br/>";
     $leixing1=$leixing;
    
    break;
          case "sz5":
    echo "可装备袜子<br/>";
     $leixing1=$leixing;

    break;
  default:
    echo "亲！禁止利用bug哦，本次已被系统记录。";
exit();
    break;
}

//获取当前可装备的装备
$result = mysqli_query($db,"SELECT * FROM zhuangbei WHERE shiyong='no' and leixing='".$leixing."'  and userid='".$userid."'");
while($row = mysqli_fetch_array($result))
  {
$zhuangbei = mysqli_query($db,"SELECT * FROM zhuangbei WHERE id='".$row[id]."'");
$zhuangbei = mysqli_fetch_array($zhuangbei);

  echo "".zhuangbei_name($zhuangbei[id])." <a href='/Pet/zb.shiyong?my=zhuangbei&leixing=$leixing1&id=$row[id]&chongwuid=$chongwuid'>装备</a><br/>";
  }


echo "<br/><a href='./pet.php?id=".$chongwuid."'>我的宠物</a> <br/>";

echo "<a href='/map.games?id=$zhuangtai_map'>返回地图</a> <br/><br/>";

?>