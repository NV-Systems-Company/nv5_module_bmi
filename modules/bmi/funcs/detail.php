<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 3-6-2010 0:14
 */

if (!defined('NV_IS_MOD_NVFORM')) {
    die('Stop!!!');
}

$contents = '';
$publtime = 0;
    
$query = $db_slave->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_user_register WHERE id = ' . $id);
$user_register = $query->fetch();


if (!empty($user_register)) {
    $result_user_bmi = array();
    $result = $db_slave->query('SELECT t1.*, t2.title,t2.description FROM ' . NV_PREFIXLANG . '_' . $module_data . '_result_user AS t1 INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_result AS t2 ON t1.resultid=t2.id where t1.userid=' . $id . ' ORDER BY t1.id' );
    while ($data = $result->fetch()){
        $result_user_bmi[$data['id']] = $data;
    }

    $base_url_rewrite = nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . md5($user_register['mobile'] . $user_register['id'] . NV_CHECK_SESSION ) . '-' . $user_register['id'], true);

    $canonicalUrl = $base_url_rewrite;
    $canonicalUrl = str_replace('&', '&amp;', $canonicalUrl);
    
    $page_title = 'Kết quả tra cứu BMI dành cho ' . $user_register['fullname'];
    $description = $config_module['description'];

    if (!empty($config_module['og_image'])) {
        $user_register['image'] = $config_module['og_image'];
        $meta_property['og:image'] = NV_MY_DOMAIN . $user_register['image'];
    }

    $publtime = intval($user_register['addtime']);
    $meta_property['og:type'] = 'article';
    $meta_property['article:published_time'] = date('Y-m-dTH:i:s', $publtime);

    $contents = nv_bmi_detail_theme( $user_register, $result_user_bmi );

}



include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
