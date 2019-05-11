
CREATE TABLE IF NOT EXISTS `__PREFIX__kdniao` (
  `company` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='快递鸟物流编码表';


BEGIN;
INSERT INTO `__PREFIX__kdniao` (`company`, `code`) VALUES
('顺丰速运', 'SF'),
('百世快递', 'HTKY'),
('中通快递', 'ZTO'),
('申通快递', 'STO'),
('圆通速递', 'YTO'),
('韵达速递', 'YD'),
('邮政快递包裹', 'YZPY'),
('EMS', 'EMS'),
('天天快递', 'HHTT'),
('京东快递', 'JD'),
('优速快递', 'UC'),
('德邦快递', 'DBL'),
('宅急送', 'ZJS'),
('TNT快递', 'TNT'),
('UPS', 'UPS'),
('DHL', 'DHL'),
('FEDEX联邦(国内件）', 'FEDEX'),
('FEDEX联邦(国际件）', 'FEDEX_GJ');
COMMIT;