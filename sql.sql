-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2021-02-17 00:28:22
-- 服务器版本： 5.6.50-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `work`
--

-- --------------------------------------------------------

--
-- 表的结构 `bangpai`
--

CREATE TABLE IF NOT EXISTS `bangpai` (
  `id` int(225) NOT NULL,
  `name` varchar(200) NOT NULL,
  `text` varchar(200) NOT NULL DEFAULT '帮主很懒，还没有设置帮派介绍。',
  `bangzhu` int(22) NOT NULL COMMENT '帮主id',
  `shuliang` int(225) NOT NULL DEFAULT '1' COMMENT '帮众数量',
  `shuliang_max` int(255) NOT NULL DEFAULT '50' COMMENT '帮派最大人数',
  `fubangzhu` int(22) DEFAULT NULL COMMENT '副帮主id',
  `dengji` int(22) NOT NULL DEFAULT '1' COMMENT '帮派等级',
  `jianshe` bigint(225) NOT NULL DEFAULT '0',
  `zijin` bigint(225) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='帮派';

-- --------------------------------------------------------

--
-- 表的结构 `bangpai_email`
--

CREATE TABLE IF NOT EXISTS `bangpai_email` (
  `id` int(225) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `userid` int(225) NOT NULL,
  `leixing` int(225) NOT NULL DEFAULT '1',
  `bangpaiid` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `bangpai_user`
--

CREATE TABLE IF NOT EXISTS `bangpai_user` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `bangpaiid` int(10) NOT NULL,
  `time` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `bangpai_yaoqing`
--

CREATE TABLE IF NOT EXISTS `bangpai_yaoqing` (
  `id` int(25) NOT NULL,
  `userid` int(25) NOT NULL COMMENT '申请人ID',
  `bangpai_id` int(25) NOT NULL COMMENT '被申请帮派',
  `time` int(25) NOT NULL COMMENT '申请时间',
  `zhuangtai` int(25) NOT NULL COMMENT '处理状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='帮派申请处理';

-- --------------------------------------------------------

--
-- 表的结构 `baoxiang`
--

CREATE TABLE IF NOT EXISTS `baoxiang` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `muban` int(100) NOT NULL,
  `map` int(100) NOT NULL,
  `leibie` varchar(500) NOT NULL DEFAULT 'map',
  `ico` varchar(100) NOT NULL DEFAULT 'kt.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `baoxiang_time`
--

CREATE TABLE IF NOT EXISTS `baoxiang_time` (
  `id` int(11) NOT NULL,
  `muban` int(11) NOT NULL,
  `map` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `beibao`
--

CREATE TABLE IF NOT EXISTS `beibao` (
  `id` int(20) NOT NULL,
  `userid` int(22) NOT NULL COMMENT '拥有者id',
  `wupin_id` int(22) NOT NULL COMMENT '物品id',
  `shuliang` int(20) NOT NULL COMMENT '数量',
  `jiyu` varchar(200) NOT NULL DEFAULT 'yes' COMMENT '是否可以给予',
  `name` varchar(200) NOT NULL,
  `leibie` varchar(29) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全服背包';

-- --------------------------------------------------------

--
-- 表的结构 `boss_cishu`
--

CREATE TABLE IF NOT EXISTS `boss_cishu` (
  `boss` int(10) NOT NULL,
  `cishu` int(10) NOT NULL,
  `userid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `boss_go`
--

CREATE TABLE IF NOT EXISTS `boss_go` (
  `id` int(10) NOT NULL,
  `map` int(10) NOT NULL,
  `userid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `boss_time`
--

CREATE TABLE IF NOT EXISTS `boss_time` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `names` varchar(2000) NOT NULL,
  `time` varchar(300) NOT NULL COMMENT '刷新时间',
  `boss_id` varchar(2000) NOT NULL COMMENT '是刷新的BOSSid',
  `boss` int(100) NOT NULL COMMENT '设定BOSS',
  `map` int(100) NOT NULL,
  `dengji` int(10) NOT NULL DEFAULT '0',
  `dengji_max` int(10) NOT NULL DEFAULT '500',
  `cishu` int(10) NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `Boss_tip`
--

CREATE TABLE IF NOT EXISTS `Boss_tip` (
  `id` int(100) NOT NULL,
  `time` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `userid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `cdk`
--

CREATE TABLE IF NOT EXISTS `cdk` (
  `id` int(50) NOT NULL,
  `userid` int(50) DEFAULT NULL,
  `cdk` varchar(100) NOT NULL,
  `xiaoguo` varchar(500) NOT NULL,
  `xiaoguo_shu` varchar(1000) NOT NULL,
  `xiaoguo_jilv` varchar(1000) NOT NULL,
  `time` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='cdk';

-- --------------------------------------------------------

--
-- 表的结构 `cdk_user`
--

CREATE TABLE IF NOT EXISTS `cdk_user` (
  `id` int(10) NOT NULL,
  `user` int(10) NOT NULL,
  `cdk` int(10) NOT NULL,
  `time` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(100) NOT NULL,
  `text` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fid` int(100) NOT NULL,
  `time` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `duiwu`
--

CREATE TABLE IF NOT EXISTS `duiwu` (
  `id` int(225) NOT NULL,
  `duizhang` int(225) NOT NULL COMMENT '队长id',
  `shuliang` int(225) NOT NULL COMMENT '队员数量',
  `fuduizhang` int(225) NOT NULL COMMENT '副队长id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='队伍';

-- --------------------------------------------------------

--
-- 表的结构 `duiwu_yaoqing`
--

CREATE TABLE IF NOT EXISTS `duiwu_yaoqing` (
  `id` int(11) NOT NULL,
  `userid` int(225) NOT NULL COMMENT '被邀请id',
  `npcid` int(225) NOT NULL,
  `duiwuid` int(225) NOT NULL COMMENT '队伍id',
  `time` int(225) NOT NULL COMMENT '邀请时间',
  `zhuangtai` int(225) NOT NULL DEFAULT '0' COMMENT '检测是否确认队伍邀请'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id` int(225) NOT NULL,
  `text` varchar(3000) NOT NULL,
  `userid` int(225) NOT NULL,
  `leibie` int(225) NOT NULL,
  `zhuangtai` int(225) NOT NULL COMMENT '1为已读，0为未读'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='信息收件箱';

-- --------------------------------------------------------

--
-- 表的结构 `fanpai`
--

CREATE TABLE IF NOT EXISTS `fanpai` (
  `id` int(50) NOT NULL,
  `leixing` varchar(500) NOT NULL COMMENT '金币翻牌，卡片翻牌',
  `userid` int(50) NOT NULL COMMENT '用户id',
  `jie` int(50) NOT NULL COMMENT '当前进度',
  `shuliang` int(50) NOT NULL COMMENT '翻了几次',
  `fp1` int(25) NOT NULL,
  `fp2` int(25) NOT NULL,
  `fp3` int(25) NOT NULL,
  `fp4` int(25) NOT NULL,
  `fp5` int(25) NOT NULL,
  `fp6` int(25) NOT NULL,
  `fp7` int(25) NOT NULL,
  `fp8` int(25) NOT NULL,
  `fp9` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='翻牌';

-- --------------------------------------------------------

--
-- 表的结构 `fuben`
--

CREATE TABLE IF NOT EXISTS `fuben` (
  `id` int(225) NOT NULL,
  `duiwuid` int(22) NOT NULL COMMENT '队伍id',
  `guaiwushu` int(225) NOT NULL DEFAULT '0' COMMENT '击杀怪物数量',
  `guan` int(225) NOT NULL DEFAULT '1' COMMENT '第几关',
  `time` int(225) NOT NULL COMMENT '结束时间',
  `leibie` int(225) NOT NULL COMMENT '副本等级，写入模板id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `fuzhi`
--

CREATE TABLE IF NOT EXISTS `fuzhi` (
  `id` int(225) NOT NULL,
  `name` varchar(50) NOT NULL,
  `zhiye` int(225) NOT NULL COMMENT '职业',
  `xuyao` varchar(1000) NOT NULL,
  `jiangli` varchar(1000) NOT NULL,
  `shulian` int(100) NOT NULL DEFAULT '0' COMMENT '需要熟练度'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `gonggao`
--

CREATE TABLE IF NOT EXISTS `gonggao` (
  `id` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `text` varchar(3000) NOT NULL,
  `yuedushu` int(100) NOT NULL,
  `zhuangtai` int(10) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公告活动';

-- --------------------------------------------------------

--
-- 表的结构 `gonglue`
--

CREATE TABLE IF NOT EXISTS `gonglue` (
  `id` int(225) NOT NULL,
  `name` varchar(100) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `fenglei` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `guaiwu`
--

CREATE TABLE IF NOT EXISTS `guaiwu` (
  `id` int(11) NOT NULL,
  `yuanshi` int(200) NOT NULL COMMENT '怪物原始id',
  `leixing` varchar(1000) NOT NULL DEFAULT 'guaiwu',
  `boss` varchar(200) DEFAULT NULL,
  `userid` int(200) DEFAULT NULL COMMENT '该用户专享怪物',
  `username` varchar(1000) NOT NULL COMMENT '名字',
  `text` varchar(2000) NOT NULL COMMENT '介绍',
  `buzhuo` varchar(200) NOT NULL,
  `map` int(100) NOT NULL COMMENT '怪物所在地图',
  `chengzhanglv` varchar(200) NOT NULL COMMENT '成长率',
  `dengji` int(200) NOT NULL COMMENT '等级',
  `dengji_max` int(200) NOT NULL COMMENT '等级上限',
  `zhongzu` varchar(200) NOT NULL COMMENT '种族',
  `qixuemax` bigint(200) NOT NULL COMMENT '气血上限',
  `fali` int(200) NOT NULL COMMENT '法力',
  `fali_max` int(200) NOT NULL COMMENT '法力上限',
  `qixue` bigint(110) NOT NULL COMMENT '气血',
  `gongji` int(110) NOT NULL COMMENT '攻击',
  `fangyu` int(110) NOT NULL COMMENT '防御',
  `gongji_fa` int(200) NOT NULL COMMENT '法术攻击',
  `sudu` int(200) NOT NULL COMMENT '速度',
  `pojia` bigint(225) NOT NULL DEFAULT '0',
  `mianshang` int(100) NOT NULL DEFAULT '0',
  `zhandou_fengyin` int(11) NOT NULL,
  `zhandou_du` int(25) NOT NULL,
  `zhandou_dushang` int(222) NOT NULL,
  `zhandou_jiedao` int(25) NOT NULL,
  `jineng` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `haoyou`
--

CREATE TABLE IF NOT EXISTS `haoyou` (
  `id` int(225) NOT NULL,
  `userid` int(225) NOT NULL COMMENT '用户id',
  `cid` int(225) NOT NULL COMMENT '好友id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `haoyou_email`
--

CREATE TABLE IF NOT EXISTS `haoyou_email` (
  `id` int(100) NOT NULL,
  `text` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `userid` int(225) NOT NULL,
  `yourid` int(225) NOT NULL,
  `zhuangtai` int(225) NOT NULL,
  `time` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户消息';

-- --------------------------------------------------------

--
-- 表的结构 `hecheng`
--

CREATE TABLE IF NOT EXISTS `hecheng` (
  `id` int(225) NOT NULL,
  `ids` int(225) NOT NULL COMMENT '宝石id（物品）',
  `text` varchar(225) NOT NULL COMMENT '重要函数储存',
  `dengji` int(225) NOT NULL,
  `idx` int(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='宝石镶嵌预留函数';

-- --------------------------------------------------------

--
-- 表的结构 `jiaoyi`
--

CREATE TABLE IF NOT EXISTS `jiaoyi` (
  `id` int(200) NOT NULL,
  `userid` int(200) NOT NULL COMMENT '上架用户id',
  `name` varchar(50) NOT NULL,
  `leixing` varchar(200) NOT NULL COMMENT '物品类型（物品还是装备）',
  `time` int(225) NOT NULL COMMENT '上架时间',
  `huobi` varchar(200) NOT NULL COMMENT '销售货币（gold,zuanshi,daobi）',
  `jiage` bigint(200) NOT NULL COMMENT '物品销售价格',
  `wupin_id` int(200) DEFAULT NULL,
  `shuliang` int(200) DEFAULT NULL,
  `naijiu` int(225) DEFAULT NULL,
  `zhuangbei_id` int(225) DEFAULT NULL,
  `zhuangbei_time` int(50) DEFAULT NULL,
  `qh1` int(225) DEFAULT '0',
  `qh2` int(225) DEFAULT '0',
  `qh3` int(225) DEFAULT '0',
  `qh4` int(225) DEFAULT '0',
  `qh5` int(225) DEFAULT '0',
  `qh6` int(225) DEFAULT '0',
  `xq1` varchar(225) DEFAULT '1',
  `xq2` varchar(225) DEFAULT '0',
  `xq3` varchar(225) DEFAULT '0',
  `xq4` varchar(225) DEFAULT '0',
  `xq5` varchar(225) DEFAULT '0',
  `xq6` varchar(225) DEFAULT '0',
  `chongwu_id` int(225) DEFAULT NULL COMMENT '出售宠物ID',
  `chongwu_chengzhanglv` varchar(1000) DEFAULT NULL,
  `chongwu_dengji` int(225) DEFAULT NULL,
  `chongwu_jingyan` int(228) DEFAULT NULL,
  `chongwu_qixue` int(225) DEFAULT NULL,
  `chongwu_qixuemax` int(225) DEFAULT NULL,
  `chongwu_fali` int(225) DEFAULT NULL,
  `chongwu_falimax` int(225) DEFAULT NULL,
  `chongwu_fangyu` int(225) DEFAULT NULL,
  `chongwu_fagong` int(225) DEFAULT NULL,
  `chongwu_wugong` int(225) DEFAULT NULL,
  `chongwu_sudu` int(228) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='玩家交商城';

-- --------------------------------------------------------

--
-- 表的结构 `jineng`
--

CREATE TABLE IF NOT EXISTS `jineng` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `zhongzu` int(10) NOT NULL,
  `text` varchar(110) NOT NULL,
  `gongji` varchar(20) NOT NULL,
  `leixing` varchar(20) NOT NULL,
  `fali` decimal(5,5) NOT NULL,
  `cishu` int(10) NOT NULL,
  `shuliang` int(10) NOT NULL,
  `xixue` decimal(5,5) NOT NULL,
  `shanghai` decimal(5,5) NOT NULL,
  `fanbei` decimal(5,5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `juese`
--

CREATE TABLE IF NOT EXISTS `juese` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `muban` int(10) NOT NULL,
  `time` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `juqing`
--

CREATE TABLE IF NOT EXISTS `juqing` (
  `id` int(22) NOT NULL,
  `leixing` int(11) NOT NULL DEFAULT '0',
  `text_1` varchar(2000) NOT NULL,
  `text_0` varchar(2000) NOT NULL,
  `dengji` int(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `maoxian`
--

CREATE TABLE IF NOT EXISTS `maoxian` (
  `id` int(225) NOT NULL,
  `duiwuid` int(22) NOT NULL COMMENT '队伍id',
  `guaiwushu` int(225) NOT NULL DEFAULT '0' COMMENT '击杀怪物数量',
  `guan` int(225) NOT NULL DEFAULT '1' COMMENT '第几关',
  `time` int(225) NOT NULL COMMENT '结束时间',
  `leibie` int(225) NOT NULL COMMENT '副本等级，写入模板id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `map`
--

CREATE TABLE IF NOT EXISTS `map` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `text` varchar(200) NOT NULL,
  `img` varchar(2000) NOT NULL DEFAULT '0' COMMENT '地图图片',
  `x` varchar(1000) NOT NULL COMMENT 'x坐标',
  `y` varchar(1000) NOT NULL COMMENT 'y坐标',
  `z` int(100) NOT NULL DEFAULT '0' COMMENT 'z坐标',
  `shang` int(11) DEFAULT '0',
  `xia` int(11) DEFAULT '0',
  `zuo` int(11) DEFAULT '0',
  `you` int(11) DEFAULT '0',
  `wajue` varchar(2000) DEFAULT NULL COMMENT '地图可狩猎物品',
  `guaiwu` varchar(200) DEFAULT NULL COMMENT '地图刷新怪物',
  `baoxiang_time` varchar(100) NOT NULL DEFAULT '0' COMMENT '宝箱打开时间生成时间',
  `boss_time` int(200) NOT NULL COMMENT 'boss刷新机制',
  `boss_time_jiangli` bigint(100) NOT NULL,
  `tuijianif` int(25) DEFAULT NULL,
  `tuijian` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='地图';

-- --------------------------------------------------------

--
-- 表的结构 `muban_baoxiang`
--

CREATE TABLE IF NOT EXISTS `muban_baoxiang` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ico` varchar(100) DEFAULT 'kt.png',
  `xuyao` varchar(1000) NOT NULL COMMENT '打开需求',
  `jiangli` varchar(1000) NOT NULL COMMENT '宝箱奖励',
  `jianglishu` varchar(500) NOT NULL,
  `jianglijilv` varchar(500) NOT NULL,
  `map` varchar(1000) NOT NULL COMMENT '所在地图'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `muban_fuben`
--

CREATE TABLE IF NOT EXISTS `muban_fuben` (
  `id` int(225) NOT NULL,
  `name` varchar(225) NOT NULL COMMENT '副本名称',
  `text` varchar(1225) NOT NULL COMMENT '副本介绍',
  `dengji` int(225) NOT NULL COMMENT '副本等级',
  `xiaoguo` varchar(2000) NOT NULL COMMENT '多个怪物用-隔开',
  `lingpai` int(25) NOT NULL COMMENT '令牌id',
  `jiangli` varchar(2000) NOT NULL COMMENT '通关奖励',
  `time` int(10) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `muban_guaiwu`
--

CREATE TABLE IF NOT EXISTS `muban_guaiwu` (
  `id` int(100) NOT NULL,
  `name` varchar(2000) NOT NULL COMMENT '怪物名字',
  `text` varchar(2000) NOT NULL COMMENT '怪物介绍',
  `map` int(100) NOT NULL,
  `img` varchar(200) NOT NULL DEFAULT 'xy.png' COMMENT '怪物IMG',
  `buzhuo` varchar(200) NOT NULL DEFAULT 'no',
  `chengzhanglv` varchar(200) NOT NULL COMMENT '最小成长率',
  `chengzhanglvs` varchar(200) NOT NULL COMMENT '最大成长率',
  `zhongzu` varchar(200) NOT NULL,
  `qixue` varchar(200) NOT NULL COMMENT '气血',
  `qixue_max` varchar(200) NOT NULL COMMENT '气血上限',
  `fali` varchar(200) NOT NULL COMMENT '法力',
  `fali_max` varchar(200) NOT NULL COMMENT '法力上限',
  `fangyu` varchar(200) NOT NULL COMMENT '防御',
  `fagong` varchar(200) NOT NULL COMMENT '法术攻击',
  `wugong` varchar(200) NOT NULL COMMENT '物攻',
  `sudu` varchar(200) NOT NULL COMMENT '速度',
  `pojia` int(22) NOT NULL DEFAULT '0',
  `mianshang` int(22) NOT NULL DEFAULT '0',
  `dengji` varchar(200) NOT NULL COMMENT '等级',
  `dengji_max` varchar(200) NOT NULL DEFAULT '120' COMMENT '等级上限',
  `diaoluo_name` varchar(2000) NOT NULL COMMENT '掉落物品名字',
  `diaoluo_id` varchar(2000) DEFAULT NULL,
  `diaoluo_jilv` varchar(2000) DEFAULT NULL,
  `diaoluo_shuliang` varchar(2000) DEFAULT NULL,
  `jineng` varchar(100) NOT NULL DEFAULT '0' COMMENT '会技能id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='怪物模板';

-- --------------------------------------------------------

--
-- 表的结构 `muban_juese`
--

CREATE TABLE IF NOT EXISTS `muban_juese` (
  `id` int(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `jineng` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `muban_maoxian`
--

CREATE TABLE IF NOT EXISTS `muban_maoxian` (
  `id` int(225) NOT NULL,
  `name` varchar(225) NOT NULL COMMENT '副本名称',
  `text` varchar(1225) NOT NULL COMMENT '副本介绍',
  `dengji` int(225) NOT NULL COMMENT '副本等级',
  `xiaoguo` varchar(2000) NOT NULL COMMENT '多个怪物用-隔开',
  `lingpai` int(25) NOT NULL COMMENT '令牌id',
  `jiangli` varchar(2000) NOT NULL COMMENT '通关奖励',
  `time` int(10) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `muban_rongyu`
--

CREATE TABLE IF NOT EXISTS `muban_rongyu` (
  `id` int(10) NOT NULL,
  `name` varchar(10) NOT NULL,
  `img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `muban_taozhuang`
--

CREATE TABLE IF NOT EXISTS `muban_taozhuang` (
  `id` int(100) NOT NULL,
  `taozhuang_name` varchar(1000) NOT NULL COMMENT '备注是哪一个套装激活',
  `one` varchar(1000) DEFAULT NULL,
  `Three` varchar(1000) DEFAULT NULL COMMENT '3件激活',
  `Five` varchar(1000) DEFAULT NULL COMMENT '5件激活',
  `six` varchar(1000) DEFAULT NULL,
  `Seven` varchar(1000) DEFAULT NULL COMMENT '7件激活'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='装备套装属性';

-- --------------------------------------------------------

--
-- 表的结构 `muban_wuping`
--

CREATE TABLE IF NOT EXISTS `muban_wuping` (
  `id` int(200) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 NOT NULL COMMENT '名称',
  `text` varchar(500) CHARACTER SET utf8mb4 NOT NULL COMMENT '介绍',
  `shuliang` int(10) DEFAULT NULL COMMENT '该定义礼包最多获得几件数量',
  `dengji` int(225) NOT NULL DEFAULT '0' COMMENT '用户需要达到多少级才能使用',
  `tiji` int(52) NOT NULL DEFAULT '1' COMMENT '物品体积',
  `jiyu` varchar(50) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'yes',
  `img` varchar(200) CHARACTER SET utf8mb4 NOT NULL DEFAULT '0',
  `xiaohao_xiaoguo` varchar(50) CHARACTER SET utf8mb4 NOT NULL COMMENT '当前为消耗物品的快捷',
  `xiaohao` varchar(2000) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'no' COMMENT '是否是消耗品',
  `libao` varchar(50) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'no' COMMENT '是否是礼包',
  `libao_id` varchar(2000) CHARACTER SET utf8mb4 NOT NULL COMMENT '礼包物品id',
  `libao_shu` varchar(2000) CHARACTER SET utf8mb4 NOT NULL COMMENT '礼包数量',
  `libao_jilv` varchar(2000) CHARACTER SET utf8mb4 NOT NULL COMMENT '礼包物品几率',
  `leibie` varchar(50) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'jiben' COMMENT '物品类别',
  `kuaijie` varchar(50) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'no' COMMENT '是否可设置战斗快捷方式',
  `shoumai` int(100) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='物品模板';

-- --------------------------------------------------------

--
-- 表的结构 `muban_zhuangbei`
--

CREATE TABLE IF NOT EXISTS `muban_zhuangbei` (
  `id` int(20) NOT NULL COMMENT 'id',
  `name` varchar(3000) NOT NULL COMMENT '装备名称',
  `taozhuang_id` int(100) DEFAULT NULL COMMENT '触发套装属性',
  `juese` int(25) DEFAULT NULL,
  `yanse` varchar(30) NOT NULL DEFAULT '#004B97',
  `divs` varchar(50) NOT NULL DEFAULT 'none',
  `fuwen` varchar(20) NOT NULL DEFAULT 'no',
  `text` varchar(5000) NOT NULL COMMENT '介绍',
  `dengji` varchar(100) NOT NULL COMMENT '装备等级',
  `dengji_max` int(10) DEFAULT NULL,
  `zhuansheng` int(10) NOT NULL DEFAULT '0',
  `tiji` int(100) NOT NULL DEFAULT '5',
  `jiyu` varchar(20) NOT NULL DEFAULT 'yes',
  `img` varchar(200) NOT NULL DEFAULT '0',
  `pingji` varchar(50) NOT NULL DEFAULT '暂无',
  `naijiu` int(20) NOT NULL COMMENT '耐久',
  `naijiu_max` int(20) NOT NULL COMMENT '最大耐久',
  `leixing` varchar(100) NOT NULL COMMENT '类型（武器或者衣服）',
  `qixue` int(100) NOT NULL COMMENT '气血',
  `fali` int(100) NOT NULL COMMENT '法力',
  `fangyu` int(100) NOT NULL COMMENT '防御',
  `fagong` int(100) NOT NULL COMMENT '法攻',
  `wugong` int(100) NOT NULL COMMENT '物攻',
  `sudu` int(100) NOT NULL COMMENT '速度',
  `mianshang` int(10) NOT NULL DEFAULT '0' COMMENT '免伤',
  `maxqixue` int(10) NOT NULL DEFAULT '0',
  `maxfali` int(10) NOT NULL DEFAULT '0',
  `maxfangyu` int(10) NOT NULL DEFAULT '0',
  `maxgongji` int(10) NOT NULL DEFAULT '0',
  `maxgongji_fa` int(10) NOT NULL DEFAULT '0',
  `maxsudu` int(10) NOT NULL DEFAULT '0',
  `shoumai` int(100) NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='装备模板';

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(200) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `time` int(25) NOT NULL,
  `userid` int(100) NOT NULL,
  `leibie` int(25) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户操作打开礼包';

-- --------------------------------------------------------

--
-- 表的结构 `npc`
--

CREATE TABLE IF NOT EXISTS `npc` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL COMMENT '角色名字',
  `text` varchar(1000) NOT NULL COMMENT '介绍',
  `img` varchar(2000) NOT NULL DEFAULT '0',
  `map` int(11) NOT NULL COMMENT '所在地图',
  `tuijianif` int(10) DEFAULT NULL,
  `tuijian` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统角色';

-- --------------------------------------------------------

--
-- 表的结构 `paimai`
--

CREATE TABLE IF NOT EXISTS `paimai` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `leixing` int(10) NOT NULL COMMENT '拍卖的类型',
  `paimai_id` int(20) NOT NULL COMMENT '拍卖的东西识别',
  `qimai_jiage` bigint(50) NOT NULL COMMENT '起拍价格',
  `baoliu_jiage` bigint(50) NOT NULL COMMENT '最大价格'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `pay`
--

CREATE TABLE IF NOT EXISTS `pay` (
  `id` int(223) NOT NULL,
  `userid` int(223) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `zhuangtai` int(100) NOT NULL,
  `gold` varchar(2230) NOT NULL,
  `dingdanhao` varchar(200) NOT NULL COMMENT '订单号',
  `alipay_dingdan` varchar(50) DEFAULT NULL,
  `alipay_zhanghao` varchar(100) DEFAULT NULL,
  `time` int(100) NOT NULL COMMENT '操作时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pay_jiangli`
--

CREATE TABLE IF NOT EXISTS `pay_jiangli` (
  `id` int(225) NOT NULL,
  `userid` int(25) NOT NULL,
  `jl1` int(25) DEFAULT NULL,
  `jl2` int(25) DEFAULT NULL,
  `jl3` int(25) DEFAULT NULL,
  `jl4` int(25) DEFAULT NULL,
  `jl5` int(25) DEFAULT NULL,
  `jl6` int(25) DEFAULT NULL,
  `jl7` int(25) DEFAULT NULL,
  `jl8` int(25) DEFAULT NULL,
  `jl9` int(25) DEFAULT NULL,
  `jl10` int(25) DEFAULT NULL,
  `jl11` int(10) DEFAULT NULL,
  `jl12` int(10) DEFAULT NULL,
  `jl13` int(10) DEFAULT NULL,
  `jl14` int(10) DEFAULT NULL,
  `jl15` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='充值奖励领取内容';

-- --------------------------------------------------------

--
-- 表的结构 `pet`
--

CREATE TABLE IF NOT EXISTS `pet` (
  `id` int(100) NOT NULL,
  `userid` int(11) NOT NULL COMMENT '哪个账号的chongwu',
  `muban` int(100) NOT NULL,
  `username` varchar(16) NOT NULL,
  `zhuangtai` varchar(100) NOT NULL DEFAULT 'yes' COMMENT '人物是否活着',
  `zhongcheng` int(100) NOT NULL DEFAULT '200' COMMENT '宠物默认忠诚度',
  `chengzhanglv` float NOT NULL,
  `dengji` int(11) DEFAULT '1' COMMENT '等级',
  `jingyan` int(225) DEFAULT '100' COMMENT '经验',
  `qixue` int(100) DEFAULT '200' COMMENT '气血',
  `qixuemax` int(100) DEFAULT '1000' COMMENT '气血上限',
  `fali` int(100) NOT NULL DEFAULT '200' COMMENT '法力',
  `fali_max` int(100) NOT NULL DEFAULT '200' COMMENT '法力上限',
  `gongji` int(100) DEFAULT '50' COMMENT '攻击',
  `gongji_fa` int(100) NOT NULL DEFAULT '50' COMMENT '法术攻击',
  `fangyu` int(100) DEFAULT '30' COMMENT '防御',
  `sudu` int(200) NOT NULL DEFAULT '50' COMMENT '用户速度',
  `maozi` int(200) NOT NULL DEFAULT '0' COMMENT '帽子',
  `xianglian` int(200) NOT NULL DEFAULT '0' COMMENT '项链',
  `yifu` int(200) NOT NULL DEFAULT '0' COMMENT '衣服',
  `wuqi` int(200) NOT NULL DEFAULT '0' COMMENT '武器',
  `xiezi` int(200) NOT NULL DEFAULT '0' COMMENT '鞋子',
  `pojia` bigint(225) NOT NULL DEFAULT '0',
  `mianshang` int(100) NOT NULL DEFAULT '0',
  `ps1` int(225) NOT NULL,
  `ps2` int(225) NOT NULL,
  `ps3` int(225) NOT NULL,
  `ps4` int(225) NOT NULL,
  `ps5` int(225) NOT NULL,
  `ps6` int(225) NOT NULL,
  `ps7` int(225) NOT NULL,
  `ps8` int(225) NOT NULL,
  `sz1` int(225) NOT NULL,
  `sz2` int(225) NOT NULL,
  `sz3` int(225) NOT NULL,
  `sz4` int(225) NOT NULL,
  `sz5` int(225) NOT NULL,
  `fw1` int(225) NOT NULL,
  `fw2` int(225) NOT NULL,
  `fw3` int(225) NOT NULL,
  `fw4` int(225) NOT NULL,
  `fw5` int(225) NOT NULL,
  `jineng1` int(225) NOT NULL,
  `jineng2` int(225) NOT NULL,
  `jineng3` int(225) NOT NULL,
  `jineng4` int(225) NOT NULL,
  `jineng5` int(225) NOT NULL,
  `jineng` int(9) NOT NULL DEFAULT '0',
  `zhandou_du` int(225) NOT NULL,
  `zhandou_dushang` int(225) NOT NULL,
  `zhandou_fengyin` int(225) NOT NULL,
  `zhandou_jiedao` int(225) NOT NULL,
  `shuxing1` int(225) NOT NULL,
  `shuxing2` int(225) NOT NULL,
  `shuxing3` int(225) NOT NULL,
  `shuxing4` int(225) NOT NULL,
  `shuxing5` int(225) NOT NULL,
  `shuxing6` int(225) NOT NULL,
  `shuxing` int(225) NOT NULL,
  `jihuo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='游戏用户';

-- --------------------------------------------------------

--
-- 表的结构 `pk`
--

CREATE TABLE IF NOT EXISTS `pk` (
  `id` int(225) NOT NULL,
  `userid` int(225) NOT NULL COMMENT 'pk发起人',
  `npcid` int(225) NOT NULL COMMENT '被pk人',
  `time` int(225) NOT NULL COMMENT '发起时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `pvp_tip`
--

CREATE TABLE IF NOT EXISTS `pvp_tip` (
  `id` int(25) NOT NULL,
  `cid` varchar(300) CHARACTER SET utf8 NOT NULL,
  `text` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `qinglv`
--

CREATE TABLE IF NOT EXISTS `qinglv` (
  `id` int(225) NOT NULL,
  `nan` int(225) NOT NULL COMMENT '男方',
  `nv` int(225) NOT NULL COMMENT '女方',
  `enai` int(225) NOT NULL COMMENT '恩爱值'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='情侣数据库';

-- --------------------------------------------------------

--
-- 表的结构 `qinglv_yaoqing`
--

CREATE TABLE IF NOT EXISTS `qinglv_yaoqing` (
  `id` int(225) NOT NULL,
  `shuliang` int(225) NOT NULL,
  `userid` int(225) NOT NULL,
  `npcid` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='情侣邀请';

-- --------------------------------------------------------

--
-- 表的结构 `qinglv_zhenghun`
--

CREATE TABLE IF NOT EXISTS `qinglv_zhenghun` (
  `id` int(225) NOT NULL,
  `userid` int(225) NOT NULL COMMENT '发布人id',
  `time` int(225) NOT NULL COMMENT '时间',
  `sex` int(255) NOT NULL COMMENT '发布人性别'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `renwu`
--

CREATE TABLE IF NOT EXISTS `renwu` (
  `id` int(200) NOT NULL COMMENT 'id',
  `name` varchar(2000) NOT NULL COMMENT '任务名称',
  `gold` int(22) NOT NULL DEFAULT '999999999',
  `dengji` varchar(100) NOT NULL DEFAULT '0' COMMENT '人物等级要求',
  `dengji_max` int(225) NOT NULL DEFAULT '90000' COMMENT '最大等级可接受任务',
  `cishu` int(11) NOT NULL DEFAULT '999',
  `jieshou` varchar(10) NOT NULL DEFAULT 'yes' COMMENT '是否能接受',
  `text` varchar(2000) NOT NULL COMMENT '任务描述',
  `text_jieshou` varchar(2000) NOT NULL COMMENT '接受之前的对话',
  `text_wancheng` varchar(1000) NOT NULL COMMENT '完成任务时对话',
  `jieshou_anniu` varchar(200) NOT NULL,
  `jieshou_no` varchar(225) NOT NULL,
  `wancheng_anniu` varchar(200) NOT NULL,
  `wanccheng_no` varchar(225) NOT NULL,
  `leixing` varchar(200) NOT NULL COMMENT '任务类型',
  `zhixian_id` int(10) NOT NULL COMMENT '唯一支线id识别',
  `juqing_dengji` int(20) NOT NULL COMMENT '如果是剧情任务填写等级要求',
  `leibie` varchar(200) NOT NULL COMMENT '任务类别、jisha,shouji',
  `npc` int(20) NOT NULL COMMENT '所属npc',
  `npc_wancheng` int(10) NOT NULL COMMENT '交付任务寻找NPC',
  `chengwei` varchar(200) NOT NULL COMMENT '奖励称谓',
  `jiangli_id` varchar(2000) NOT NULL COMMENT '奖励物品id',
  `jiangli_shu` varchar(200) NOT NULL COMMENT '物品奖励数量',
  `xuyao_id` varchar(200) NOT NULL COMMENT '任务需求物品id',
  `xuyao_shu` varchar(200) NOT NULL COMMENT '任务需求物品数量',
  `jisha_guaiwu` varchar(200) NOT NULL COMMENT '需要击杀怪物',
  `jisha_shu` varchar(200) NOT NULL COMMENT '需要击杀的数量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务模板';

-- --------------------------------------------------------

--
-- 表的结构 `renwu_guaiwu`
--

CREATE TABLE IF NOT EXISTS `renwu_guaiwu` (
  `id` int(200) NOT NULL,
  `userid` int(200) NOT NULL COMMENT '用户id',
  `guaiwuid` int(200) NOT NULL COMMENT '怪物id',
  `renwuid` int(200) NOT NULL COMMENT '任务id',
  `shuliang` int(200) NOT NULL COMMENT '击杀数量',
  `shuliang_my` int(200) NOT NULL DEFAULT '0' COMMENT '当前已击杀'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `renwu_my`
--

CREATE TABLE IF NOT EXISTS `renwu_my` (
  `id` int(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `leixing` varchar(100) NOT NULL,
  `yuanshi` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `renwu_one`
--

CREATE TABLE IF NOT EXISTS `renwu_one` (
  `id` int(225) NOT NULL,
  `userid` int(225) NOT NULL,
  `renwuid` int(225) NOT NULL,
  `shuliang` int(225) NOT NULL,
  `time` int(225) NOT NULL,
  `leibie` varchar(225) NOT NULL COMMENT 'shimen。richang。huodong'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='限制部分活动任务数量';

-- --------------------------------------------------------

--
-- 表的结构 `shangcheng`
--

CREATE TABLE IF NOT EXISTS `shangcheng` (
  `id` int(20) NOT NULL,
  `shangpin_leixing` varchar(80) NOT NULL,
  `shangpin_id` int(22) NOT NULL,
  `gold` decimal(10,1) NOT NULL,
  `gold_no` int(50) DEFAULT NULL,
  `shuliang` int(22) NOT NULL DEFAULT '200000',
  `huobi` varchar(100) NOT NULL DEFAULT 'gold',
  `shei` int(10) NOT NULL DEFAULT '1' COMMENT '在哪里售卖'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商城';

-- --------------------------------------------------------

--
-- 表的结构 `shsj`
--

CREATE TABLE IF NOT EXISTS `shsj` (
  `id` int(223) NOT NULL,
  `userid` int(223) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `zhuangtai` int(100) NOT NULL,
  `gold` varchar(2230) NOT NULL,
  `dingdanhao` varchar(200) NOT NULL COMMENT '订单号',
  `alipay_dingdan` varchar(50) DEFAULT NULL,
  `alipay_zhanghao` varchar(100) DEFAULT NULL,
  `time` int(100) NOT NULL COMMENT '操作时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `url`
--

CREATE TABLE IF NOT EXISTS `url` (
  `id` int(225) NOT NULL,
  `url` varchar(2000) NOT NULL,
  `time` int(225) NOT NULL,
  `userid` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(15) NOT NULL,
  `name` varchar(99) NOT NULL COMMENT '账号',
  `pass` varchar(999) NOT NULL COMMENT '密码',
  `ce_id` int(11) NOT NULL DEFAULT '0',
  `map` int(30) NOT NULL COMMENT '当前地图',
  `dengji` int(50) NOT NULL COMMENT '等级',
  `jingyan` int(50) NOT NULL COMMENT '经验',
  `shouji` varchar(200) DEFAULT NULL COMMENT '密保手机',
  `wangji` int(20) DEFAULT NULL COMMENT '重置密码的验证码',
  `shouji_if` int(20) DEFAULT NULL COMMENT '是否认证',
  `shouji_yanzhengma` int(20) DEFAULT NULL COMMENT '密保验证码',
  `gold` int(225) NOT NULL,
  `shenzhoubi` decimal(10,1) NOT NULL,
  `tuijian` int(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL,
  `userid` int(11) NOT NULL COMMENT '哪个账号的用户',
  `maoxian` int(20) NOT NULL DEFAULT '0' COMMENT '冒险积分',
  `juewei` int(10) NOT NULL DEFAULT '0' COMMENT '人物爵位',
  `rongyu` varchar(100) DEFAULT NULL,
  `vip` int(25) NOT NULL,
  `juese` int(10) DEFAULT NULL,
  `shsj` int(25) NOT NULL,
  `xjsj` int(10) NOT NULL,
  `mys` varchar(20) NOT NULL DEFAULT 'map',
  `chongzhi` int(225) NOT NULL DEFAULT '0' COMMENT '充值金额多少',
  `sex` int(1) NOT NULL,
  `fenghao` int(60) NOT NULL DEFAULT '0',
  `username` varchar(160) NOT NULL,
  `jinyan` int(225) NOT NULL DEFAULT '0' COMMENT '禁言',
  `fuben` int(225) NOT NULL DEFAULT '0' COMMENT '副本积分',
  `buff_jingyan` int(225) NOT NULL COMMENT '双倍经验卡',
  `buff_gold` int(225) NOT NULL,
  `zhuangtai` varchar(100) NOT NULL DEFAULT 'yes' COMMENT '人物是否活着',
  `chongwu_id` int(100) NOT NULL,
  `duiwu_id` int(25) DEFAULT NULL,
  `bangpai_id` int(225) DEFAULT NULL,
  `pk_id` int(225) DEFAULT NULL COMMENT '此处显示用户是否是pkzhuangtai',
  `map` int(10) DEFAULT NULL COMMENT '用户当前的地点',
  `map_z` int(11) NOT NULL DEFAULT '0' COMMENT '用户所在大陆',
  `juqing` varchar(200) NOT NULL DEFAULT '0' COMMENT '剧情任务id',
  `zhongzu` varchar(100) NOT NULL,
  `chengwei` int(30) NOT NULL DEFAULT '0' COMMENT '称谓id',
  `dengji` int(11) DEFAULT '1' COMMENT '等级',
  `zhuansheng` int(25) NOT NULL DEFAULT '0' COMMENT '转生',
  `gold` decimal(13,1) NOT NULL DEFAULT '100.0',
  `shenzhoubi` decimal(10,1) NOT NULL,
  `zuie` int(100) NOT NULL DEFAULT '0' COMMENT '罪恶值',
  `zuie2` int(100) NOT NULL DEFAULT '0' COMMENT '罪恶指数',
  `banggong` int(225) NOT NULL,
  `zhanji` int(225) NOT NULL,
  `huoli` int(225) NOT NULL DEFAULT '500',
  `fuzhi` int(5) NOT NULL DEFAULT '0' COMMENT '副职类型',
  `fuzhi_int` int(225) DEFAULT '0' COMMENT '副职经验',
  `chengjiu` int(25) NOT NULL DEFAULT '0',
  `jingyan` bigint(225) DEFAULT '100' COMMENT '经验',
  `shuxing` int(225) NOT NULL DEFAULT '5' COMMENT '未分配属性',
  `shuxing1` int(225) NOT NULL DEFAULT '1',
  `shuxing2` int(225) NOT NULL DEFAULT '1',
  `shuxing3` int(225) NOT NULL DEFAULT '1',
  `shuxing4` int(225) NOT NULL DEFAULT '1',
  `shuxing5` int(225) NOT NULL DEFAULT '1',
  `shuxing6` int(225) NOT NULL DEFAULT '1',
  `qixue` bigint(225) DEFAULT '200' COMMENT '气血',
  `qixuemax` bigint(225) DEFAULT '1000' COMMENT '气血上限',
  `fali` bigint(225) NOT NULL DEFAULT '200' COMMENT '法力',
  `fali_max` bigint(225) NOT NULL DEFAULT '200' COMMENT '法力上限',
  `gongji` bigint(225) DEFAULT '50' COMMENT '攻击',
  `gongji_fa` bigint(225) NOT NULL DEFAULT '50' COMMENT '法术攻击',
  `fangyu` bigint(225) DEFAULT '30' COMMENT '防御',
  `sudu` bigint(225) NOT NULL DEFAULT '50' COMMENT '用户速度',
  `pojia` bigint(225) NOT NULL COMMENT '破甲',
  `mianshang` int(100) NOT NULL DEFAULT '0',
  `maozi` bigint(225) NOT NULL DEFAULT '0' COMMENT '帽子',
  `xianglian` bigint(225) NOT NULL DEFAULT '0' COMMENT '项链',
  `yifu` bigint(225) NOT NULL DEFAULT '0' COMMENT '衣服',
  `wuqi` bigint(225) NOT NULL DEFAULT '0' COMMENT '武器',
  `xiezi` bigint(225) NOT NULL DEFAULT '0' COMMENT '鞋子',
  `sz1` int(225) NOT NULL DEFAULT '0',
  `sz2` int(225) NOT NULL DEFAULT '0',
  `sz3` int(225) NOT NULL DEFAULT '0',
  `sz4` int(225) NOT NULL DEFAULT '0',
  `sz5` int(225) NOT NULL DEFAULT '0',
  `ps1` int(225) NOT NULL,
  `ps2` int(225) NOT NULL,
  `ps3` int(225) NOT NULL,
  `ps4` int(225) NOT NULL,
  `ps5` int(225) NOT NULL,
  `ps6` int(225) NOT NULL,
  `ps7` int(225) NOT NULL,
  `ps8` int(225) NOT NULL DEFAULT '0' COMMENT '耳环',
  `fw1` int(225) NOT NULL DEFAULT '0',
  `fw2` int(225) NOT NULL DEFAULT '0',
  `fw3` int(225) NOT NULL DEFAULT '0',
  `fw4` int(225) NOT NULL DEFAULT '0',
  `fw5` int(225) NOT NULL DEFAULT '0',
  `kj1` int(10) NOT NULL,
  `kj2` int(10) NOT NULL,
  `kj3` int(10) NOT NULL,
  `kj4` int(10) NOT NULL,
  `kj5` int(10) NOT NULL,
  `kj6` varchar(10) NOT NULL DEFAULT '0',
  `kj7` varchar(10) NOT NULL DEFAULT '0',
  `kj8` varchar(10) NOT NULL DEFAULT '0',
  `kj9` varchar(10) NOT NULL DEFAULT '0',
  `kj10` varchar(10) NOT NULL DEFAULT '0',
  `jineng1` int(225) NOT NULL,
  `jineng2` int(225) NOT NULL,
  `jineng3` int(225) NOT NULL,
  `jineng4` int(225) NOT NULL,
  `jineng5` int(225) NOT NULL,
  `maxqixue` int(10) NOT NULL DEFAULT '0',
  `maxfali` int(10) NOT NULL DEFAULT '0',
  `maxfangyu` int(10) NOT NULL DEFAULT '0',
  `maxgongji` int(10) NOT NULL DEFAULT '0',
  `maxgongji_fa` int(10) NOT NULL DEFAULT '0',
  `maxsudu` int(10) NOT NULL DEFAULT '0',
  `sign_time` int(50) NOT NULL DEFAULT '0' COMMENT '上次签到时间',
  `sign_qinglv` int(22) NOT NULL DEFAULT '0',
  `sign_bangpai` int(22) NOT NULL DEFAULT '0',
  `sign_day` int(50) NOT NULL DEFAULT '0' COMMENT '连续签到天数',
  `sign_days` int(50) NOT NULL DEFAULT '0' COMMENT '总签到次数',
  `sign_time_one` int(25) NOT NULL DEFAULT '0' COMMENT '在线1小时',
  `sign_time_two` int(25) NOT NULL DEFAULT '0' COMMENT '2小时',
  `sign_time_three` int(25) NOT NULL DEFAULT '0' COMMENT '3小时',
  `sign_time_four` int(25) NOT NULL DEFAULT '0' COMMENT '4小时',
  `time` int(100) NOT NULL,
  `ip` varchar(100) NOT NULL COMMENT '用户ip',
  `beibao_rongliang` int(11) NOT NULL COMMENT '当前背包容量',
  `beibao_rongliangmax` int(5) NOT NULL DEFAULT '5000' COMMENT '最大背包容量',
  `chongwu_rongliang` int(100) NOT NULL DEFAULT '0',
  `chongwu_rongliangmax` int(5) NOT NULL DEFAULT '5' COMMENT '宠物容量',
  `sid` varchar(500) DEFAULT NULL,
  `jineng` int(9) NOT NULL DEFAULT '0' COMMENT '上一次技能',
  `jineng_dengji` int(10) NOT NULL DEFAULT '1',
  `zhandou_fengyin` int(25) NOT NULL COMMENT '佛族封印状态',
  `zhandou_du` int(25) NOT NULL COMMENT '鬼族毒伤状态',
  `zhandou_dushang` int(225) NOT NULL COMMENT '鬼族毒伤伤害',
  `zhandou_jiedao` int(25) NOT NULL COMMENT '借刀杀人',
  `zd_qx1` int(225) NOT NULL DEFAULT '0' COMMENT '自动回血',
  `zd_fl1` int(225) NOT NULL DEFAULT '0' COMMENT '自动回法',
  `zd_qx2` int(225) NOT NULL DEFAULT '0' COMMENT '自动宠物回血',
  `zd_fl2` int(225) NOT NULL DEFAULT '0' COMMENT '自动宠物回蓝',
  `ceshi` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='游戏用户';

-- --------------------------------------------------------

--
-- 表的结构 `users_ch`
--

CREATE TABLE IF NOT EXISTS `users_ch` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `muban` int(10) NOT NULL,
  `time` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `users_chengwei`
--

CREATE TABLE IF NOT EXISTS `users_chengwei` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '称谓名',
  `userid` int(11) NOT NULL COMMENT '拥有者名字'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `users_zhixian`
--

CREATE TABLE IF NOT EXISTS `users_zhixian` (
  `id` int(10) NOT NULL,
  `zhixian_id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `zhixianjindu` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='记录玩家支线任务进度的数据表';

-- --------------------------------------------------------

--
-- 表的结构 `user_jineng`
--

CREATE TABLE IF NOT EXISTS `user_jineng` (
  `id` int(25) NOT NULL,
  `userid` int(25) NOT NULL,
  `jinengid` int(25) NOT NULL,
  `dengji` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='记录用户学习的技能';

-- --------------------------------------------------------

--
-- 表的结构 `xiangqian`
--

CREATE TABLE IF NOT EXISTS `xiangqian` (
  `id` int(225) NOT NULL,
  `ids` int(225) NOT NULL COMMENT '宝石id（物品）',
  `text` varchar(225) NOT NULL COMMENT '重要函数储存',
  `dengji` int(225) NOT NULL,
  `xiangqian` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='宝石镶嵌预留函数';

-- --------------------------------------------------------

--
-- 表的结构 `yaojiang`
--

CREATE TABLE IF NOT EXISTS `yaojiang` (
  `id` int(22) NOT NULL,
  `userid` int(22) NOT NULL,
  `haoma` int(22) NOT NULL,
  `time` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `zhandou_du`
--

CREATE TABLE IF NOT EXISTS `zhandou_du` (
  `id` int(11) NOT NULL,
  `userid` int(100) NOT NULL,
  `leixing` varchar(100) NOT NULL,
  `huihe` int(100) NOT NULL,
  `shanghai` bigint(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='鬼族毒伤记录';

-- --------------------------------------------------------

--
-- 表的结构 `zhuangbei`
--

CREATE TABLE IF NOT EXISTS `zhuangbei` (
  `id` int(20) NOT NULL COMMENT 'id',
  `yuanshi` varchar(500) NOT NULL COMMENT '装备原始模板id',
  `shiyong` varchar(200) NOT NULL DEFAULT 'no' COMMENT '装备是否使用',
  `jiyu` varchar(50) NOT NULL DEFAULT 'yes',
  `name` varchar(300) DEFAULT NULL COMMENT '装备名称',
  `userid` varchar(200) NOT NULL COMMENT '拥有者',
  `text` varchar(400) DEFAULT NULL COMMENT '介绍',
  `dengji` varchar(200) NOT NULL COMMENT '装备等级',
  `naijiu` int(20) NOT NULL COMMENT '耐久',
  `naijiu_max` int(20) DEFAULT NULL COMMENT '最大耐久',
  `leixing` varchar(100) NOT NULL COMMENT '类型（武器或者衣服）',
  `qh1` int(22) NOT NULL DEFAULT '0',
  `qh2` int(22) NOT NULL DEFAULT '0',
  `qh3` int(22) NOT NULL DEFAULT '0',
  `qh4` int(22) NOT NULL DEFAULT '0',
  `qh5` int(22) NOT NULL DEFAULT '0',
  `qh6` int(22) NOT NULL DEFAULT '0',
  `xq1` varchar(225) CHARACTER SET utf8mb4 NOT NULL DEFAULT '1',
  `xq2` varchar(225) NOT NULL DEFAULT '0',
  `xq3` varchar(225) NOT NULL DEFAULT '0',
  `xq4` varchar(225) NOT NULL DEFAULT '0',
  `xq5` varchar(225) NOT NULL DEFAULT '0',
  `xq6` varchar(225) NOT NULL DEFAULT '0',
  `time` int(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='装备模板';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bangpai`
--
ALTER TABLE `bangpai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bangpai_email`
--
ALTER TABLE `bangpai_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bangpai_user`
--
ALTER TABLE `bangpai_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bangpai_yaoqing`
--
ALTER TABLE `bangpai_yaoqing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baoxiang`
--
ALTER TABLE `baoxiang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baoxiang_time`
--
ALTER TABLE `baoxiang_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beibao`
--
ALTER TABLE `beibao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boss_go`
--
ALTER TABLE `boss_go`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boss_time`
--
ALTER TABLE `boss_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Boss_tip`
--
ALTER TABLE `Boss_tip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cdk`
--
ALTER TABLE `cdk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cdk_user`
--
ALTER TABLE `cdk_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duiwu`
--
ALTER TABLE `duiwu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duiwu_yaoqing`
--
ALTER TABLE `duiwu_yaoqing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fanpai`
--
ALTER TABLE `fanpai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuben`
--
ALTER TABLE `fuben`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuzhi`
--
ALTER TABLE `fuzhi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gonggao`
--
ALTER TABLE `gonggao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gonglue`
--
ALTER TABLE `gonglue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guaiwu`
--
ALTER TABLE `guaiwu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `haoyou`
--
ALTER TABLE `haoyou`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `haoyou_email`
--
ALTER TABLE `haoyou_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hecheng`
--
ALTER TABLE `hecheng`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jiaoyi`
--
ALTER TABLE `jiaoyi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jineng`
--
ALTER TABLE `jineng`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `juese`
--
ALTER TABLE `juese`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `juqing`
--
ALTER TABLE `juqing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maoxian`
--
ALTER TABLE `maoxian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muban_baoxiang`
--
ALTER TABLE `muban_baoxiang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muban_fuben`
--
ALTER TABLE `muban_fuben`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muban_guaiwu`
--
ALTER TABLE `muban_guaiwu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muban_juese`
--
ALTER TABLE `muban_juese`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muban_maoxian`
--
ALTER TABLE `muban_maoxian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muban_rongyu`
--
ALTER TABLE `muban_rongyu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muban_taozhuang`
--
ALTER TABLE `muban_taozhuang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muban_wuping`
--
ALTER TABLE `muban_wuping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muban_zhuangbei`
--
ALTER TABLE `muban_zhuangbei`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `npc`
--
ALTER TABLE `npc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_jiangli`
--
ALTER TABLE `pay_jiangli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pk`
--
ALTER TABLE `pk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pvp_tip`
--
ALTER TABLE `pvp_tip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qinglv`
--
ALTER TABLE `qinglv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qinglv_yaoqing`
--
ALTER TABLE `qinglv_yaoqing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qinglv_zhenghun`
--
ALTER TABLE `qinglv_zhenghun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renwu`
--
ALTER TABLE `renwu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renwu_guaiwu`
--
ALTER TABLE `renwu_guaiwu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renwu_my`
--
ALTER TABLE `renwu_my`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renwu_one`
--
ALTER TABLE `renwu_one`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shangcheng`
--
ALTER TABLE `shangcheng`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shsj`
--
ALTER TABLE `shsj`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_ch`
--
ALTER TABLE `users_ch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_chengwei`
--
ALTER TABLE `users_chengwei`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_zhixian`
--
ALTER TABLE `users_zhixian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_jineng`
--
ALTER TABLE `user_jineng`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xiangqian`
--
ALTER TABLE `xiangqian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yaojiang`
--
ALTER TABLE `yaojiang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zhandou_du`
--
ALTER TABLE `zhandou_du`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zhuangbei`
--
ALTER TABLE `zhuangbei`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bangpai`
--
ALTER TABLE `bangpai`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bangpai_email`
--
ALTER TABLE `bangpai_email`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bangpai_user`
--
ALTER TABLE `bangpai_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bangpai_yaoqing`
--
ALTER TABLE `bangpai_yaoqing`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `baoxiang`
--
ALTER TABLE `baoxiang`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `baoxiang_time`
--
ALTER TABLE `baoxiang_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beibao`
--
ALTER TABLE `beibao`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `boss_go`
--
ALTER TABLE `boss_go`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `boss_time`
--
ALTER TABLE `boss_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Boss_tip`
--
ALTER TABLE `Boss_tip`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cdk`
--
ALTER TABLE `cdk`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cdk_user`
--
ALTER TABLE `cdk_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `duiwu`
--
ALTER TABLE `duiwu`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `duiwu_yaoqing`
--
ALTER TABLE `duiwu_yaoqing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fanpai`
--
ALTER TABLE `fanpai`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fuben`
--
ALTER TABLE `fuben`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fuzhi`
--
ALTER TABLE `fuzhi`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gonggao`
--
ALTER TABLE `gonggao`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gonglue`
--
ALTER TABLE `gonglue`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `guaiwu`
--
ALTER TABLE `guaiwu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `haoyou`
--
ALTER TABLE `haoyou`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `haoyou_email`
--
ALTER TABLE `haoyou_email`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hecheng`
--
ALTER TABLE `hecheng`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jiaoyi`
--
ALTER TABLE `jiaoyi`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jineng`
--
ALTER TABLE `jineng`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `juese`
--
ALTER TABLE `juese`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `juqing`
--
ALTER TABLE `juqing`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `maoxian`
--
ALTER TABLE `maoxian`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `map`
--
ALTER TABLE `map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `muban_baoxiang`
--
ALTER TABLE `muban_baoxiang`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `muban_fuben`
--
ALTER TABLE `muban_fuben`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `muban_guaiwu`
--
ALTER TABLE `muban_guaiwu`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `muban_juese`
--
ALTER TABLE `muban_juese`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `muban_maoxian`
--
ALTER TABLE `muban_maoxian`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `muban_rongyu`
--
ALTER TABLE `muban_rongyu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `muban_taozhuang`
--
ALTER TABLE `muban_taozhuang`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `muban_wuping`
--
ALTER TABLE `muban_wuping`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `muban_zhuangbei`
--
ALTER TABLE `muban_zhuangbei`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `npc`
--
ALTER TABLE `npc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pay`
--
ALTER TABLE `pay`
  MODIFY `id` int(223) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pay_jiangli`
--
ALTER TABLE `pay_jiangli`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pk`
--
ALTER TABLE `pk`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pvp_tip`
--
ALTER TABLE `pvp_tip`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qinglv`
--
ALTER TABLE `qinglv`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qinglv_yaoqing`
--
ALTER TABLE `qinglv_yaoqing`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qinglv_zhenghun`
--
ALTER TABLE `qinglv_zhenghun`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `renwu`
--
ALTER TABLE `renwu`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `renwu_guaiwu`
--
ALTER TABLE `renwu_guaiwu`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `renwu_my`
--
ALTER TABLE `renwu_my`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `renwu_one`
--
ALTER TABLE `renwu_one`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shangcheng`
--
ALTER TABLE `shangcheng`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shsj`
--
ALTER TABLE `shsj`
  MODIFY `id` int(223) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `url`
--
ALTER TABLE `url`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_ch`
--
ALTER TABLE `users_ch`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_chengwei`
--
ALTER TABLE `users_chengwei`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_zhixian`
--
ALTER TABLE `users_zhixian`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_jineng`
--
ALTER TABLE `user_jineng`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xiangqian`
--
ALTER TABLE `xiangqian`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `yaojiang`
--
ALTER TABLE `yaojiang`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zhandou_du`
--
ALTER TABLE `zhandou_du`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zhuangbei`
--
ALTER TABLE `zhuangbei`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'id';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
