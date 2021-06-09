<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 08 Apr 2014 15:13:43 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );


    $error = $row['bodytext'] = '';
    $row['catid'] = $row['objectid'] = 0;
    $row['numproject'] = 1;
    $row['id'] = $nv_Request->get_int( 'id', 'get', 0 );
    if( $row['id'] > 0 ){
        $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_project WHERE id =' . $row['id'] )->fetch();

        $project_user = $db->query('SELECT projectid, fullname, mobile, email, school_name, yearstudy,ismaster FROM ' . NV_PREFIXLANG . '_' . $module_data . '_project_users WHERE projectid =' . $row['id'] . ' ORDER BY id' )->fetchAll();
        $project_file = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_project_file WHERE projectid =' . $row['id'] . ' ORDER BY id' )->fetchAll();
        $project_canbo = $db->query( 'SELECT * FROM ' . NV_USERS_GLOBALTABLE . ' AS t1 INNER JOIN ' . NV_USERS_GLOBALTABLE . '_info AS t2 ON t1.userid=t2.userid WHERE t1.userid =' . $row['userid'] )->fetch();
        $project_canbo['fullname'] = nv_show_name_user( $project_canbo['first_name'], $project_canbo['last_name'] );
    }

    if( $nv_Request->isset_request( 'submit', 'post' ) )
    {
        $phone_preg = '/^(09|03|07|08|05)+([0-9]{8})\b$/';

        $row['id'] = $nv_Request->get_int( 'id', 'post', 0 );
        $row['userid'] = $nv_Request->get_int( 'userid', 'post', 0 );
        $row['fullname_canbo'] = $nv_Request->get_title( 'fullname_canbo', 'post', '' );
        $row['mobile_canbo'] = $nv_Request->get_title( 'mobile_canbo', 'post', '' );
        $row['email_canbo'] = $nv_Request->get_title( 'email_canbo', 'post', '' );
        $row['chucvu_canbo'] = $nv_Request->get_title( 'chucvu_canbo', 'post', '' );
        $row['donvicongtac_canbo'] = $nv_Request->get_title( 'donvicongtac_canbo', 'post', '' );

        $row['image'] = $nv_Request->get_title( 'image', 'post', '' );
        if (nv_is_file($row['image'], NV_UPLOADS_DIR . '/' . $module_upload)) {
            $lu = strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/');
            $row['image'] = substr($row['image'], $lu);
        } else {
            $row['image'] = '';
        }

        //anh doi thi
        $row['imgusers'] = array();
        $img_list_temp = $nv_Request->get_array( 'imgusers', 'post', array() );
        if( !empty( $img_list_temp )){

            foreach ( $img_list_temp as $imgusers ){
                $lu = strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/');
                $row['imgusers'][] = substr($imgusers, $lu);
            }
        }
        if( !empty( $row['imgusers'] )){
            $row['imgusers'] = implode('[NK4]', $row['imgusers'] );
        }

        //anh san pham
        $row['imgproduct'] = array();
        $img_list_temp = $nv_Request->get_array( 'imgproduct', 'post', array() );
        if( !empty( $img_list_temp )){

            foreach ( $img_list_temp as $imgusers ){
                $lu = strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/');
                $row['imgproduct'][] = substr($imgusers, $lu);
            }
        }
        if( !empty( $row['imgproduct'] )){
            $row['imgproduct'] = implode('[NK4]', $row['imgproduct'] );
        }

        $row['documentfile'] = $nv_Request->get_array( 'documentfile', 'post', array() );


        $row['fullname'] = $nv_Request->get_title( 'fullname', 'post', '' );
        $row['mobile'] = $nv_Request->get_title( 'mobile', 'post', '' );
        $row['email'] = $nv_Request->get_title( 'email', 'post', '' );
        $row['yearstudy'] = $nv_Request->get_int( 'yearstudy', 'post', '' );
        $row['school_name'] = $nv_Request->get_title( 'school_name', 'post', '' );
        $row['year'] = date('Y', NV_CURRENTTIME);// nam du thi
        $row['title'] = $nv_Request->get_title( 'title', 'post', '' );
        $row['alias'] = strtolower( change_alias( $row['title'] ));
        $row['catid'] = $nv_Request->get_int( 'catid', 'post', 0 );
        $row['objectid'] = $nv_Request->get_int( 'objectid', 'post', 0 );
        $row['note'] = $nv_Request->get_string('note', 'post', '');
        $row['description'] = $nv_Request->get_string('description', 'post', '');

        $row['giatrigiaiphap'] = $nv_Request->get_string('giatrigiaiphap', 'post', '');
        $row['tinhungdung'] = $nv_Request->get_string('tinhungdung', 'post', '');
        $row['tinhdocdao'] = $nv_Request->get_string('tinhdocdao', 'post', '');
        $row['tinhkhathi'] = $nv_Request->get_string('tinhkhathi', 'post', '');

        $row['strength'] = $nv_Request->get_string('strength', 'post', '');
        $row['weakness'] = $nv_Request->get_string('weakness', 'post', '');
        $row['opportunity'] = $nv_Request->get_string('opportunity', 'post', '');
        $row['challenge'] = $nv_Request->get_string('challenge', 'post', '');

        $row['full_name_other'] = $nv_Request->get_array( 'full_name_other', 'post', '' );
        $row['mobile_other'] = $nv_Request->get_array( 'mobile_other', 'post', '' );
        $row['email_other'] = $nv_Request->get_array( 'email_other', 'post', '' );
        $row['yearstudy_other'] = $nv_Request->get_array( 'yearstudy_other', 'post', '' );


        if( empty( $row['fullname_canbo'] )) {
            $error = $lang_module['error_fullname_canbo'];
        }
        elseif( empty( $row['mobile_canbo'] ) ) {
            $error = $lang_module['error_mobile_canbo'];
        }
        elseif( !preg_match( $phone_preg, $row['mobile_canbo'] ) ) {
            $error = $lang_module['error_mobile_canbo_format'];
        }
        elseif( empty( $row['email_canbo'] ) ) {
            $error = $lang_module['error_email_canbo'];
        }
        elseif( $mail_check = nv_check_valid_email( $row['email_canbo'] ) ) {
            $error = $mail_check;
        }
        elseif( empty( $row['fullname'] )) {
            $error = $lang_module['error_fullname'];
        }
        elseif( empty( $row['school_name'] ) ) {
            $error = $lang_module['error_school'];
        }
        elseif( empty( $row['mobile'] )) {
            $error = $lang_module['error_mobile'];
        }elseif( !preg_match( $phone_preg, $row['mobile'] ) ) {
            $error = $lang_module['error_mobile_fomart'];
        }
        elseif( empty( $row['email'] ) ) {
            $error = $lang_module['error_email'];
        }
        elseif( nv_check_valid_email( $row['email'] ) != '') {
            $error = $lang_global['email_incorrect'];
        }
        elseif( empty( $row['title'] )) {
            $error = $lang_module['error_title_project'];
        }elseif( $row['catid'] == 0) {
            $error = $lang_module['error_catid'];
        }elseif( $row['objectid'] == 0) {
            $error = $lang_module['error_objectid'];
        }elseif( empty( $row['note'] )) {
            $error = $lang_module['error_note_project'];
        }elseif( empty( $row['description'] )) {
            $error = $lang_module['error_description_project'];
        }elseif( empty( $row['documentfile'] )){
            $error = $lang_module['error_file_document_project'];
        }

        if( empty( $error ) )
        {
            try
            {
                $stmt = $db->prepare( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_project SET 
                title=:title, image=:image, year=:year, catid=:catid, objectid=:objectid, note=:note, description=:description, giatrigiaiphap=:giatrigiaiphap, tinhungdung=:tinhungdung, tinhdocdao=:tinhdocdao, tinhkhathi=:tinhkhathi, bodytext=:bodytext, strength=:strength, weakness=:weakness, opportunity=:opportunity, challenge=:challenge, imgusers=:imgusers, imgproduct=:imgproduct, edittime=' . NV_CURRENTTIME . '
                WHERE id=' . $row['id'] );
                $stmt->bindParam( ':title', $row['title'], PDO::PARAM_STR );
                $stmt->bindParam( ':image', $row['image'], PDO::PARAM_INT );
                $stmt->bindParam( ':year', $row['year'], PDO::PARAM_INT );
                $stmt->bindParam( ':catid', $row['catid'], PDO::PARAM_INT );
                $stmt->bindParam( ':objectid', $row['objectid'], PDO::PARAM_INT );
                $stmt->bindParam( ':note', $row['note'], PDO::PARAM_STR, strlen( $row['note'] ) );
                $stmt->bindParam( ':description', $row['description'], PDO::PARAM_STR, strlen( $row['description'] ) );

                $stmt->bindParam( ':giatrigiaiphap', $row['giatrigiaiphap'], PDO::PARAM_STR, strlen( $row['giatrigiaiphap'] ) );
                $stmt->bindParam( ':tinhungdung', $row['tinhungdung'], PDO::PARAM_STR, strlen( $row['tinhungdung'] ) );
                $stmt->bindParam( ':tinhdocdao', $row['tinhdocdao'], PDO::PARAM_STR, strlen( $row['tinhdocdao'] ) );
                $stmt->bindParam( ':tinhkhathi', $row['tinhkhathi'], PDO::PARAM_STR, strlen( $row['tinhkhathi'] ) );

                $stmt->bindParam( ':bodytext', $row['bodytext'], PDO::PARAM_STR, strlen( $row['bodytext'] ) );
                $stmt->bindParam( ':strength', $row['strength'], PDO::PARAM_STR, strlen( $row['strength'] ) );
                $stmt->bindParam( ':weakness', $row['weakness'], PDO::PARAM_STR, strlen( $row['weakness'] ) );
                $stmt->bindParam( ':opportunity', $row['opportunity'], PDO::PARAM_STR, strlen( $row['opportunity'] ) );
                $stmt->bindParam( ':challenge', $row['challenge'], PDO::PARAM_STR, strlen( $row['challenge'] ) );
                $stmt->bindParam( ':imgusers', $row['imgusers'], PDO::PARAM_STR, strlen( $row['imgusers'] ) );
                $stmt->bindParam( ':imgproduct', $row['imgproduct'], PDO::PARAM_STR, strlen( $row['imgproduct'] ) );
                $exc = $stmt->execute();
                if( $exc )
                {

                    //cap nhap thông tin can bo nop bai
                    $array_fullname = explode(' ', $row['fullname_canbo'] );
                    $first_name = end($array_fullname);
                    array_pop($array_fullname);
                    $last_name = implode(' ', $array_fullname);

                    $sql = 'UPDATE ' . NV_USERS_GLOBALTABLE . ' SET 
                    first_name=:first_name, last_name=:last_name, email=:email 
                    WHERE userid=' . $row['userid'];

                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR );
                    $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR );
                    $stmt->bindParam(':email', $row['email_canbo'], PDO::PARAM_STR );
                    $stmt->execute();

                    $sql = 'UPDATE ' . NV_USERS_GLOBALTABLE . '_info SET 
                    mobile=:mobile, chucvu=:chucvu, donvicongtac=:donvicongtac 
                    WHERE userid=' . $row['userid'];

                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':mobile', $row['mobile_canbo'], PDO::PARAM_STR );
                    $stmt->bindParam(':chucvu', $row['chucvu_canbo'], PDO::PARAM_STR );
                    $stmt->bindParam(':donvicongtac', $row['donvicongtac_canbo'], PDO::PARAM_STR );
                    $stmt->execute();


                    //xoa thong tin user cu
                    $db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_project_users  WHERE projectid = ' . $row['id'] );

                    //thông tin truong nhom
                    $_sql ='INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_project_users 
                            ( projectid, fullname, mobile, email, school_name, yearstudy, ismaster) 
                            VALUES (:projectid, :fullname, :mobile, :email, :school_name, :yearstudy, :ismaster)';

                    $data_insert = array();
                    $data_insert['projectid'] = $row['id'];
                    $data_insert['fullname'] = $row['fullname'];
                    $data_insert['mobile'] = $row['mobile'];
                    $data_insert['email'] = $row['email'];
                    $data_insert['school_name'] = $row['school_name'];
                    $data_insert['yearstudy'] = intval( $row['yearstudy'] );
                    $data_insert['ismaster'] = 1;
                    $db->insert_id($_sql, 'id', $data_insert);

                    //cac thanh vien khac trong nhom
                    foreach ( $row['full_name_other'] as $key => $fullname ){
                        $fullname = trim( $fullname );
                        if( !empty( $fullname )){
                            $_sql ='INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_project_users 
                            ( projectid, fullname, mobile, email, school_name, yearstudy, ismaster) 
                            VALUES (:projectid, :fullname, :mobile, :email, :school_name, :yearstudy, :ismaster)';

                            $data_insert = array();
                            $data_insert['projectid'] = $row['id'];
                            $data_insert['fullname'] = $fullname;
                            $data_insert['mobile'] = $row['mobile_other'][$key];
                            $data_insert['email'] = $row['email_other'][$key];
                            $data_insert['school_name'] = '';
                            $data_insert['yearstudy'] = intval( $row['yearstudy_other'][$key] );
                            $data_insert['ismaster'] = 0;

                            $db->insert_id($_sql, 'id', $data_insert);
                        }
                    }

                    //ghi file tai lieu
                    $db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_project_file  WHERE projectid = ' . $row['id'] );
                    if( !empty( $row['documentfile'] )){
                        foreach ( $row['documentfile'] as $file_name ){
                            $filetype = end(explode('.', $file_name));

                            $lu = strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/');
                            $file_name = substr($file_name, $lu);

                            $_sql ='INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_project_file 
                            (projectid, roundid, title, description, filename, filetype, status, addtime, edittime) 
                            VALUES (:projectid, :roundid, :title, :description, :filename, :filetype, 0, ' . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ')';

                            $data_insert = array();
                            $data_insert['projectid'] = $row['id'];
                            $data_insert['roundid'] = 0;
                            $data_insert['title'] = $file_name;
                            $data_insert['description'] = '';
                            $data_insert['filename'] = $file_name;
                            $data_insert['filetype'] = $filetype;
                            $db->insert_id($_sql, 'id', $data_insert);
                        }
                    }

                    $nv_Cache->delMod( $module_name );
                    Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=project' );
                    die();
                }
            }
            catch ( PDOException $e )
            {
                trigger_error( $e->getMessage() );
                $error = $e->getMessage();
            }
        }
    }

    $page_title = 'Nộp các dự án vòng thi cơ sở (SV Startup 2020)';
if( !empty( $row['image'] )){
    $row['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $row['image'];
}
$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'NV_ASSETS_DIR', NV_ASSETS_DIR );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'UPLOADS_DIR_USER', NV_UPLOADS_DIR . '/' . $module_name );
$xtpl->assign( 'CONTENT', $row );
$xtpl->assign( 'CANBO', $project_canbo );
if( !empty( $error )){
    $xtpl->assign( 'ERROR', $error );
    $xtpl->parse( 'main.error' );
}

if( !empty( $array_temp ) ) {
    foreach ($array_temp as $catalog ) {
        $catalog['sl'] = ($row['catid'] == $catalog['id'])? ' selected=selected' : '';
        $xtpl->assign( 'CATALOG', $catalog );
        $xtpl->parse( 'main.catalog' );
    }
}

if( !empty( $array_object ) ) {
    foreach ($array_object as $object ) {
        $object['sl'] = ($row['objectid'] == $object['id'])? ' selected=selected' : '';
        $xtpl->assign( 'OBJECT', $object );
        $xtpl->parse( 'main.object' );
    }
}

if( !empty( $row['imgusers'] )){
    $row['imgusers'] = explode('[NK4]', $row['imgusers'] );
    foreach ( $row['imgusers'] as $key => $imgusers ){
        $imgusers = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $imgusers;
        $xtpl->assign( 'key', $key );
        $xtpl->assign( 'IMGUSER', $imgusers );
        $xtpl->parse( 'main.imgusers' );
    }
}
$xtpl->assign( 'FILE_ITEMS_USER', count( $row['imgusers'] ) );


if( !empty( $row['imgproduct'] )){
    $row['imgproduct'] = explode('[NK4]', $row['imgproduct'] );
    foreach ( $row['imgproduct'] as $key => $imgusers ){
        $imgusers = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $imgusers;
        $xtpl->assign( 'key', $key );
        $xtpl->assign( 'IMGUSER', $imgusers );
        $xtpl->parse( 'main.imgproduct' );
    }
}
$xtpl->assign( 'FILE_ITEMS_PRODUCT', count( $row['imgproduct'] ) );

if( !empty( $project_user )){
    foreach ( $project_user as $puser ){
        if( $puser['ismaster'] == 1 ){
            $xtpl->assign( 'MUSER', $puser );
        }else{
            $xtpl->assign( 'PUSER', $puser );
            $xtpl->parse( 'main.user_other' );
        }
    }
}
$xtpl->assign( 'num_form_project', count( $project_user ) -1 );

if( !empty( $project_file )){
    $stt = 0;
    foreach ( $project_file as $pfile ){
        $pfile['key'] = $stt++;
        if( !empty( $pfile['filename'] ) ){
            $pfile['filename'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $pfile['filename'];
            $xtpl->assign( 'PFILE', $pfile );
            $xtpl->parse( 'main.project_file' );
        }
    }
}
$xtpl->assign( 'FILE_ITEMS', count( $project_file ) );
$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );



include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';