CREATE TABLE `statistics_driver_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL COMMENT '日期',
  `driver_id` int(11) NOT NULL DEFAULT '0' COMMENT '司机ID',
  `big_id` int(11) NOT NULL DEFAULT '0' COMMENT '大队长ID',
  `small_id` int(11) NOT NULL DEFAULT '0' COMMENT '小队长ID',
  `driver_type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '司机类型',
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '城市ID',
  `order_complete_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '完成订单金额（已付款未付款已评价-不包括有责取消）',
  `order_complete_total` int(11) NOT NULL DEFAULT '0' COMMENT '完成订单数（已付款未付款已评价）',
  `order_cancel_total` int(11) NOT NULL DEFAULT '0' COMMENT '订单取消数量',
  `work_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '在线时长',
  `task_order_total` int(11) NOT NULL DEFAULT '0' COMMENT '大B单数（统计已完成的出车单）',
  `task_order_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '大B金额（统计已完成的出车单）',
  PRIMARY KEY (`id`),
  UNIQUE KEY `date_driver_unique` (`date`,`driver_id`) COMMENT '日期和司机组合索引',
  KEY `date_big` (`date`,`big_id`) COMMENT '日期和大队长组合索引 ',
  KEY `date_small` (`date`,`small_id`) COMMENT '日期和小队长组全索引'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='司机数据汇总数据';

