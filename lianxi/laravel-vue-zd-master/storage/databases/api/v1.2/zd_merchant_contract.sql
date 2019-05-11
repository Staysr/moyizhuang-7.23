/*
Navicat MySQL Data Transfer

Source Server         : 192.168.2.242 (开发)
Source Server Version : 50633
Source Host           : 192.168.2.242:3306
Source Database       : fzhd

Target Server Type    : MYSQL
Target Server Version : 50633
File Encoding         : 65001

Date: 2018-09-26 17:05:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for zd_merchant_contract
-- ----------------------------
DROP TABLE IF EXISTS `zd_merchant_contract`;
CREATE TABLE `zd_merchant_contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL DEFAULT '0' COMMENT '商户ID',
  `path` varchar(1000) DEFAULT NULL COMMENT '文件路径',
  `create_time` datetime NOT NULL,
  `modify_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商户合同';


ALTER TABLE `zd_merchant` ADD COLUMN `contract_count`  int NULL DEFAULT 0 COMMENT '商户合同数目' AFTER `warehouse_count`;
