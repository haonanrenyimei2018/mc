-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.7.17-log - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win64
-- HeidiSQL 版本:                  9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 正在导出表  db_mc.mc_admin 的数据：1 rows
DELETE FROM `mc_admin`;
/*!40000 ALTER TABLE `mc_admin` DISABLE KEYS */;
INSERT INTO `mc_admin` (`id`, `username`, `password`, `portrait`, `loginnum`, `last_login_ip`, `last_login_time`, `real_name`, `status`, `groupid`) VALUES
	(1, 'admins', 'd8875489915237eaf976d8b72d64febc', 'http://www.mc.cc/uploads/face/20180504\\b9ef5e08594df0075866156919c1fbe1.jpg', 276, '127.0.0.1', 1525871727, '超级管理员', 1, 1);
/*!40000 ALTER TABLE `mc_admin` ENABLE KEYS */;

-- 正在导出表  db_mc.mc_auth_group 的数据：4 rows
DELETE FROM `mc_auth_group`;
/*!40000 ALTER TABLE `mc_auth_group` DISABLE KEYS */;
INSERT INTO `mc_auth_group` (`id`, `title`, `status`, `rules`, `create_time`, `update_time`) VALUES
	(1, '超级管理员', 1, '', 1446535750, 1446535750),
	(2, '内容管理员', 1, '1,2,9,10,11,12,3,30,31,32,33,34,4,35,36,37,38,39,5,6,7,8,27,28,29,13,14,22,24,25,40,41,42,43,26,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58', 1446535750, 1479305018),
	(3, '系统维护员', 1, '1,2,9,10,11,12,3,30,31,32,33,34,4,35,36,37,38,39,5,6,7,8,27,28,29,13,14,22,24,25,40,41,42,43,26,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60', 1446535750, 1479879017),
	(4, '系统测试员', 1, '1,2,9,10,11,12,3,30,31,32,33,34,4,35,36,37,38,39,5,6,7,8,27,28,29,13,14,22,24,25,40,41,42,43,26,44,45,46,48,49,50,51,52,53,54,55,56,57,58', 1446535750, 1479878738);
/*!40000 ALTER TABLE `mc_auth_group` ENABLE KEYS */;

-- 正在导出表  db_mc.mc_auth_group_access 的数据：2 rows
DELETE FROM `mc_auth_group_access`;
/*!40000 ALTER TABLE `mc_auth_group_access` DISABLE KEYS */;
INSERT INTO `mc_auth_group_access` (`uid`, `group_id`) VALUES
	(1, 1),
	(15, 2);
/*!40000 ALTER TABLE `mc_auth_group_access` ENABLE KEYS */;

-- 正在导出表  db_mc.mc_auth_rule 的数据：36 rows
DELETE FROM `mc_auth_rule`;
/*!40000 ALTER TABLE `mc_auth_rule` DISABLE KEYS */;
INSERT INTO `mc_auth_rule` (`id`, `name`, `title`, `type`, `status`, `css`, `condition`, `pid`, `sort`, `create_time`, `update_time`) VALUES
	(1, '#', '系统管理', 1, 1, 'fa fa-gear', '', 0, 2, 1446535750, 1477312169),
	(2, 'admin/user/index', '用户管理', 1, 1, '', '', 1, 10, 1446535750, 1477312169),
	(3, 'admin/role/index', '角色管理', 1, 1, '', '', 1, 20, 1446535750, 1477312169),
	(4, 'admin/menu/index', '菜单管理', 1, 1, '', '', 1, 30, 1446535750, 1477312169),
	(5, '#', '数据库管理', 1, 1, 'fa fa-database', '', 0, 2, 1446535750, 1477312169),
	(6, 'admin/data/index', '数据库备份', 1, 1, '', '', 5, 50, 1446535750, 1477312169),
	(7, 'admin/data/optimize', '优化表', 1, 1, '', '', 6, 50, 1477312169, 1477312169),
	(8, 'admin/data/repair', '修复表', 1, 1, '', '', 6, 50, 1477312169, 1477312169),
	(9, 'admin/user/useradd', '添加用户', 1, 1, '', '', 2, 50, 1477312169, 1477312169),
	(10, 'admin/user/useredit', '编辑用户', 1, 1, '', '', 2, 50, 1477312169, 1477312169),
	(11, 'admin/user/userdel', '删除用户', 1, 1, '', '', 2, 50, 1477312169, 1477312169),
	(12, 'admin/user/user_state', '用户状态', 1, 1, '', '', 2, 50, 1477312169, 1477312169),
	(13, '#', '日志管理', 1, 1, 'fa fa-tasks', '', 0, 6, 1477312169, 1477312169),
	(14, 'admin/log/operate_log', '行为日志', 1, 1, '', '', 13, 50, 1477312169, 1477312169),
	(22, 'admin/log/del_log', '删除日志', 1, 1, '', '', 14, 50, 1477312169, 1477316778),
	(133, '#', '代理类型管理', 1, 1, 'fa fa-circle-thin', '', 0, 50, 1525444293, 1525444293),
	(134, '#', '代理管理', 1, 1, 'fa fa-circle-thin', '', 0, 50, 1525444370, 1525444370),
	(135, '#', '参数设置', 1, 1, 'fa fa-circle-thin', '', 0, 50, 1525444423, 1525444423),
	(27, 'admin/data/import', '数据库还原', 1, 1, '', '', 5, 50, 1477639870, 1477639870),
	(28, 'admin/data/revert', '还原', 1, 1, '', '', 27, 50, 1477639972, 1477639972),
	(29, 'admin/data/del', '删除', 1, 1, '', '', 27, 50, 1477640011, 1477640011),
	(30, 'admin/role/roleAdd', '添加角色', 1, 1, '', '', 3, 50, 1477640011, 1477640011),
	(31, 'admin/role/roleEdit', '编辑角色', 1, 1, '', '', 3, 50, 1477640011, 1477640011),
	(32, 'admin/role/roleDel', '删除角色', 1, 1, '', '', 3, 50, 1477640011, 1477640011),
	(33, 'admin/role/role_state', '角色状态', 1, 1, '', '', 3, 50, 1477640011, 1477640011),
	(34, 'admin/role/giveAccess', '权限分配', 1, 1, '', '', 3, 50, 1477640011, 1477640011),
	(35, 'admin/menu/add_rule', '添加菜单', 1, 1, '', '', 4, 50, 1477640011, 1477640011),
	(36, 'admin/menu/edit_rule', '编辑菜单', 1, 1, '', '', 4, 50, 1477640011, 1477640011),
	(37, 'admin/menu/del_rule', '删除菜单', 1, 1, '', '', 4, 50, 1477640011, 1477640011),
	(38, 'admin/menu/rule_state', '菜单状态', 1, 1, '', '', 4, 50, 1477640011, 1477640011),
	(39, 'admin/menu/ruleorder', '菜单排序', 1, 1, '', '', 4, 50, 1477640011, 1477640011),
	(140, '#', '公司公告', 1, 1, 'fa fa-circle-thin', '', 0, 50, 1525444690, 1525444690),
	(139, '#', '培训课程', 1, 1, 'fa fa-circle-thin', '', 0, 50, 1525444670, 1525444670),
	(138, '#', '广告信息', 1, 1, 'fa fa-circle-thin', '', 0, 50, 1525444627, 1525444627),
	(137, '#', '积分商城', 1, 1, 'fa fa-circle-thin', '', 0, 50, 1525444596, 1525444596),
	(136, '#', '财务管理', 1, 1, 'fa fa-circle-thin', '', 0, 50, 1525444527, 1525444527);
/*!40000 ALTER TABLE `mc_auth_rule` ENABLE KEYS */;

-- 正在导出表  db_mc.mc_config 的数据：18 rows
DELETE FROM `mc_config`;
/*!40000 ALTER TABLE `mc_config` DISABLE KEYS */;
INSERT INTO `mc_config` (`id`, `name`, `type`, `title`, `group`, `extra`, `remark`, `create_time`, `update_time`, `status`, `value`, `sort`) VALUES
	(1, 'web_site_title', 1, '网站标题', 1, '', '网站标题前台显示标题', 1378898976, 1480575456, 1, '网站管理台', 0),
	(2, 'web_site_description', 2, '网站描述', 1, '', '网站搜索引擎描述', 1378898976, 1379235841, 1, '', 1),
	(3, 'web_site_keyword', 2, '网站关键字', 1, '', '网站搜索引擎关键字', 1378898976, 1381390100, 1, '', 8),
	(4, 'web_site_close', 4, '站点状态', 1, '0:关闭,1:开启', '站点关闭后其他用户不能访问，管理员可以正常访问', 1378898976, 1480643099, 1, '1', 0),
	(9, 'config_type_list', 3, '配置类型列表', 4, '', '主要用于数据解析和页面表单的生成', 1378898976, 1379235348, 1, '0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举', 2),
	(10, 'web_site_icp', 1, '网站备案号', 1, '', '设置在网站底部显示的备案号，如“ 陇ICP备15002349号-1', 1378900335, 1480643159, 1, '鲁ICP备00000000号-1', 0),
	(20, 'config_group_list', 3, '配置分组', 4, '', '配置分组', 1379228036, 1384418383, 1, '1:基本\r\n2:内容\r\n3:用户\r\n4:系统', 4),
	(22, 'auth_config', 3, 'Auth配置', 4, '', '自定义Auth.class.php类配置', 1379409310, 1379409564, 1, 'AUTH_ON:1\r\nAUTH_TYPE:2', 8),
	(25, 'list_rows', 0, '后台每页记录数', 2, '', '后台数据每页显示记录数', 1379503896, 1380427745, 1, '10', 10),
	(26, 'user_allow_register', 4, '是否允许用户注册', 3, '0:关闭注册\r\n1:允许注册', '是否开放用户注册', 1379504487, 1379504580, 1, '0', 3),
	(28, 'data_backup_path', 1, '数据库备份根路径', 4, '', '路径必须以 / 结尾', 1381482411, 1381482411, 1, './data/', 5),
	(29, 'data_backup_part_size', 0, '数据库备份卷大小', 4, '', '该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M', 1381482488, 1381729564, 1, '20971520', 7),
	(30, 'data_backup_compress', 4, '数据库备份文件是否启用压缩', 4, '0:不压缩\r\n1:启用压缩', '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', 1381713345, 1381729544, 1, '1', 9),
	(31, 'data_backup_compress_level', 4, '数据库备份文件压缩级别', 4, '1:普通\r\n4:一般\r\n9:最高', '数据库备份文件的压缩级别，该配置在开启压缩时生效', 1381713408, 1381713408, 1, '9', 10),
	(32, 'develop_mode', 4, '开启开发者模式', 4, '0:关闭\r\n1:开启', '是否开启开发者模式', 1383105995, 1383291877, 1, '0', 11),
	(36, 'admin_allow_ip', 2, '禁止后台访问IP', 4, '', '多个用逗号分隔，如果不配置表示不限制IP访问', 1387165454, 1480643409, 1, '0.0.0.0,120.25.77.116', 0),
	(37, 'app_trace', 4, '是否显示页面Trace', 4, '0:关闭\r\n1:开启', '是否显示页面Trace信息', 1387165685, 1387165685, 1, '0', 1),
	(38, 'app_debug', 4, '应用调试模式', 4, '0:关闭\r\n1:开启', '网站正式部署建议关闭', 1478522232, 1478522395, 1, '1', 0);
/*!40000 ALTER TABLE `mc_config` ENABLE KEYS */;

-- 正在导出表  db_mc.mc_log 的数据：10 rows
DELETE FROM `mc_log`;
/*!40000 ALTER TABLE `mc_log` DISABLE KEYS */;
INSERT INTO `mc_log` (`log_id`, `admin_id`, `admin_name`, `description`, `ip`, `status`, `add_time`) VALUES
	(3800, 1, 'admins', '用户【admins】登录成功', '127.0.0.1', 1, 1525268847),
	(3802, 1, 'admins', '用户【admins】添加菜单成功', '127.0.0.1', 1, 1525444293),
	(3803, 1, 'admins', '用户【admins】添加菜单成功', '127.0.0.1', 1, 1525444370),
	(3804, 1, 'admins', '用户【admins】添加菜单成功', '127.0.0.1', 1, 1525444423),
	(3805, 1, 'admins', '用户【admins】添加菜单成功', '127.0.0.1', 1, 1525444527),
	(3806, 1, 'admins', '用户【admins】添加菜单成功', '127.0.0.1', 1, 1525444596),
	(3807, 1, 'admins', '用户【admins】添加菜单成功', '127.0.0.1', 1, 1525444627),
	(3808, 1, 'admins', '用户【admins】添加菜单成功', '127.0.0.1', 1, 1525444670),
	(3809, 1, 'admins', '用户【admins】添加菜单成功', '127.0.0.1', 1, 1525444690),
	(3810, 1, 'admins', '用户【admins】登录成功', '127.0.0.1', 1, 1525871727);
/*!40000 ALTER TABLE `mc_log` ENABLE KEYS */;

-- 正在导出表  db_mc.mc_user_type 的数据：~0 rows (大约)
DELETE FROM `mc_user_type`;
/*!40000 ALTER TABLE `mc_user_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `mc_user_type` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
