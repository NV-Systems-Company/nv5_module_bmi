<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Apr 20, 2010 10:47:41 AM
 */

if (!defined('NV_IS_MOD_NVFORM')) {
    die('Stop!!!');
}

if( $nv_Request->isset_request('bmi', 'post')){
    $weight = $nv_Request->get_int('weight', 'post', 0);
    $height = $nv_Request->get_int('height', 'post', 0);
    $objectid = $nv_Request->get_int('objectid', 'post', 0);
    $roundid = $nv_Request->get_int('roundid', 'post', 0);

    $height = $height/100;//chuyen doi sang he met

    $bmi = round( $weight / ( $height * $height ), 2);

    $data_result = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_result WHERE roundid=' . $roundid . ' AND scorefrom<=' . $bmi . ' AND scoreto>' . $bmi )->fetch();
    if( !empty( $data_result )){
        $array_reponse = array(
            'status' => 'OK',
            'bmi' => $bmi,
            'resultid' => $data_result['id'],
            'roundid' => $roundid,
            'title' => $data_result['title'],
            'description' => $data_result['description'],
            'mess' => 'ok'
        );
    }else{
        $array_reponse = array(
            'status' => 'OK',
            'bmi' => $bmi,
            'resultid' => $data_result['id'],
            'roundid' => $roundid,
            'title' => 'Chỉ số của bạn là ' . $bmi,
            'description' => 'Đang cập nhật!',
            'mess' => 'ok'
        );
    }

    echo json_encode($array_reponse);
    exit;
}

elseif( $nv_Request->isset_request('savename', 'post')){
    $fullname = $nv_Request->get_title('fullname', 'post', '');
    $id = $nv_Request->get_int('id', 'post', 0);
    $md5id = $nv_Request->get_title('md5id', 'post', '');

    $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_user_register WHERE id=' . $id;
    $result = $db->query( $sql );
    $user_register = $result->fetch();
    $md5id_true = md5($user_register['mobile'] . $user_register['id'] . NV_CHECK_SESSION );

    if( $md5id != $md5id_true ) {
        $array_reponse = array(
            'status' => 'ERROR',
            'mess' => 'Hệ thống không ghi nhận được thông tin của bạn!'
        );
    }else{
        $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_user_register SET fullname=' . $db->quote( $fullname ) . ' WHERE id=' . $id;
        $db->query( $sql );
        $array_reponse = array(
            'status' => 'OK',
            'mess' => 'Cảm ơn bạn đã cập nhật thông tin!'
        );
    }

    echo json_encode($array_reponse);
    exit;
} elseif( $nv_Request->isset_request('bmi_save', 'post')){
    $mobile = $nv_Request->get_title('mobile', 'post', '');
    $score = $nv_Request->get_float('score', 'post', 0);
    $resultid = $nv_Request->get_float('resultid', 'post', 0);
    $roundid = $nv_Request->get_int('roundid', 'post', 0);
    $phone_preg = '/^(09|03|07|08|05)+([0-9]{8})\b$/';

    if( empty( $mobile )) {
        $array_reponse = array(
            'status' => 'ERROR',
            'mess' => 'Số điện thoại không bỏ trống'
        );
    }elseif( !preg_match( $phone_preg, $mobile ) ) {
        $array_reponse = array(
            'status' => 'ERROR',
            'mess' => 'Số điện thoại không đúng định dạng'
        );
    }else{

        $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_user_register WHERE mobile=' . $db->quote( $mobile );
        $result = $db->query( $sql );
        $user_register = $result->fetch();
        $contents = '';

        if( empty( $user_register )){
            $_sql ='INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_user_register ( roundid, fullname, mobile, email, addtime ) 
            VALUES ( :roundid, :fullname, :mobile, :email, :addtime)';

            $data_insert = array();
            $data_insert['roundid'] = $roundid;
            $data_insert['fullname'] = '';
            $data_insert['mobile'] = $mobile;
            $data_insert['email'] = '';
            $data_insert['addtime'] = NV_CURRENTTIME;
            $id = $db->insert_id($_sql, 'id', $data_insert);
            if( $id > 0 ){
                $_sql ='INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_result_user ( userid, resultid, score, addtime ) 
                VALUES (:userid, :resultid, :score, :addtime)';

                $data_insert = array();
                $data_insert['userid'] = $id;
                $data_insert['resultid'] = $resultid;
                $data_insert['score'] = $score;
                $data_insert['addtime'] = NV_CURRENTTIME;
                $db->insert_id($_sql, 'id', $data_insert);
            }
        }else{
            $id = $user_register['id'];
            $_sql ='INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_result_user ( userid, resultid, score, addtime ) 
                VALUES (:userid, :resultid, :score, :addtime)';

            $data_insert = array();
            $data_insert['userid'] = $user_register['id'];
            $data_insert['resultid'] = $resultid;
            $data_insert['score'] = $score;
            $data_insert['addtime'] = NV_CURRENTTIME;
            $db->insert_id($_sql, 'id', $data_insert);

            $sql = 'SELECT id, score, addtime FROM ' . NV_PREFIXLANG . '_' . $module_data . '_result_user WHERE userid=' . $user_register['id'] . ' ORDER BY addtime ASC';
            $result = $db->query( $sql );
            $weight = 0;
            while( $row = $result->fetch() )
            {
                $array_data[] = $row;
            }

            $contents = nv_bmi_main_chart( $user_register, $array_data );
        }

        if( $id > 0){

            $array_reponse = array(
                'status' => 'OK',
                'mess' => 'Hệ thống đã lưu trữ kết quả BMI của bạn. Các lần sau chỉ cần bạn nhập SĐT này để theo dõi chỉ số của mình!',
                'link_view' => NV_MY_DOMAIN . nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . md5($mobile . $id . NV_CHECK_SESSION ) . '-' . $id, true),
                'data' => $contents
            );
        }

    }


    echo json_encode($array_reponse);
    exit;
}




if( $nv_Request->isset_request('showround', 'post')){
    $objectid = $nv_Request->get_int('objectid', 'post', 0);
    $roundid = $nv_Request->get_int('roundid', 'post', 0);

    $html = '<select class="required form-control" name="roundid">';
    foreach ( $array_round as $round ){
        if( $round['objectid'] == $objectid ){
            $html .= '<option value="' . $round['id'] . '">' . $round['title'] . '</option>';
        }
    }
    $html .= '</select>';
    echo $html;
    exit;
}


$array_config = $module_config[$module_name];
$page_title = $array_config['titlesite'];
$description = $array_config['description'];
$bodytext = $array_config['bodytext'];

if( !empty( $array_config['og_image'] )){
    $imagesize = @getimagesize(NV_ROOTDIR . $array_config['og_image'] );
    $meta_property['og:image'] = NV_MY_DOMAIN . $array_config['og_image'];
}


$contents = nv_bmi_main( $array_object, $bodytext );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
