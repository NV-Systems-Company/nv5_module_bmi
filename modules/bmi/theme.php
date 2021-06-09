<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 08 Apr 2014 15:13:43 GMT
 */

if ( ! defined( 'NV_IS_MOD_NVFORM' ) ) die( 'Stop!!!' );


function nv_bmi_main( $array_object, $bodytext )
{
    global $module_name, $lang_module, $lang_global, $module_info;

    $xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    $xtpl->assign('MODULE_NAME', $module_name);
    $xtpl->assign('LINK_BMI', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name );
    if (!empty($array_object)) {
        foreach ($array_object as $object ) {
            $xtpl->assign('OBJECT', $object);
            $xtpl->parse('main.object.loop');
        }
        $xtpl->parse('main.object');
    }
    if( !empty( $bodytext )){
        $xtpl->assign('bodytext', $bodytext);
        $xtpl->parse('main.bodytext');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

function nv_bmi_main_chart( $user_register, $array_data )
{
    global $module_name, $lang_module, $lang_global, $module_info;

    $xtpl = new XTemplate('chart.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    $xtpl->assign('MODULE_NAME', $module_name);
    $user_register['fullname'] = empty( $user_register['fullname'] )? $user_register['mobile'] :$user_register['fullname'];
    $xtpl->assign('USER', $user_register );
    if (!empty($array_data)) {
        foreach ($array_data as $data ) {
            $data['addtime'] = date('d/m/Y', $data['addtime'] );
            $xtpl->assign('DATA', $data);
            $xtpl->parse('main.data.score');
            $xtpl->parse('main.data.addtime');
        }
        $xtpl->parse('main.data');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

function nv_bmi_detail_theme( $user_register, $result_user )
{
    global $module_name, $lang_module, $lang_global, $module_info;

    $xtpl = new XTemplate('detail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    $xtpl->assign('MODULE_NAME', $module_name);
    $xtpl->assign('LINK_BMI', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name );
    $user_register['md5id'] = md5($user_register['mobile'] . $user_register['id'] . NV_CHECK_SESSION );
    $xtpl->assign('USER', $user_register);
    $hidden = empty( $user_register['fullname'])? '' : ' hide';
    $xtpl->assign('HIDDEN', $hidden );

    $chart = nv_bmi_main_chart( $user_register, $result_user );
    $xtpl->assign('CHART', $chart);

    if (!empty($result_user)) {
        $stt = 1;
        foreach ($result_user as $data ) {
            $data['addtime'] = date('H:i, d/m/Y', $data['addtime'] );
            $data['col_float'] = ( $stt % 2 ) ? 'left' : 'right';
            $xtpl->assign('DATA', $data);
            $xtpl->parse('main.show_detail.data');
            $stt++;
        }
        $xtpl->parse('main.show_detail');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}