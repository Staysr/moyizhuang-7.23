ALTER TABLE `zd_sys_role`
ADD COLUMN `is_admin`  tinyint(3) NOT NULL DEFAULT 0 COMMENT '是否超级管理员' AFTER `remark`;