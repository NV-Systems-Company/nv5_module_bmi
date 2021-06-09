<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-10-2010 20:59
 */

if( ! defined( 'NV_IS_FILE_MODULES' ) ) die( 'Stop!!!' );

$sql_drop_module = array();

$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_object;";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_round;";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_result;";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_result_user;";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_user_register;";

$sql_create_module = $sql_drop_module;

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_object (
 id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
 title varchar(150) NOT NULL,
 alias varchar(150) NOT NULL DEFAULT '',
 image varchar(150) NOT NULL DEFAULT '',
 description text,
 weight smallint(4) NOT NULL DEFAULT '0' COMMENT 'STT',
 status tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 : Hiển thị, 0 Ẩn',
 PRIMARY KEY (id),
 UNIQUE KEY alias (alias)
) ENGINE=MyISAM";

//bang cac do tuoi cua doi tuong
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_round (
 id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
 objectid smallint(5) unsigned NOT NULL,
 title varchar(150) NOT NULL,
 description text,
 weight smallint(4) NOT NULL DEFAULT '0' COMMENT 'STT',
 status tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 : Hiển thị, 0 Ẩn',
 PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_result (
 id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
 roundid smallint(5) unsigned NOT NULL,
 scorefrom float unsigned NOT NULL,
 scoreto float unsigned NOT NULL,
 title varchar(150) NOT NULL,
 image varchar(150) NOT NULL DEFAULT '',
 description text,
 status tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 : Hiển thị, 0 Ẩn',
 PRIMARY KEY (id),
 KEY roundid (roundid)
) ENGINE=MyISAM";

//bang user tra cuu
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_user_register (
 id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
 roundid smallint(5) unsigned NOT NULL,
 fullname varchar(250) NOT NULL,
 mobile varchar(50) NOT NULL,
 email varchar(50) NOT NULL,
 addtime int(11) NOT NULL,
 PRIMARY KEY (id),
 UNIQUE KEY mobile (mobile)
) ENGINE=MyISAM";


$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_result_user (
 id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
 userid mediumint(8) unsigned NOT NULL,
 resultid smallint(5) unsigned NOT NULL,
 score float unsigned NOT NULL,
 addtime int(11) NOT NULL,
 PRIMARY KEY (id),
 KEY userid (userid),
 KEY resultid (resultid)
) ENGINE=MyISAM";

$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'titlesite', '')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'description', '')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'og_image', '')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'bodytext', '')";
