<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 08 Apr 2014 15:13:43 GMT
 */

if ( ! defined( 'NV_SYSTEM' ) ) die( 'Stop!!!' );

define( 'NV_IS_MOD_NVFORM', true );

require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
$config_module = $module_config[$module_name];

$alias_cat_url = isset($array_op[0]) ? $array_op[0] : '';
$count_op = count($array_op);

$page = 1;
if (!empty($array_op) and $op == 'main') {
    $op = 'main';
    if ($count_op == 1) {

        $array_page = explode('-', $array_op[0]);
        $id = intval(end($array_page));
        $number = strlen($id) + 1;
        $alias_url = substr($array_op[0], 0, -$number);
        if ($id > 0 and $alias_url != '') {
            if ($id > 0) {
                $op = 'detail';
            }
        }
    }
}



/**
 * nv_check_username_reg()
 * Ham kiem tra ten dang nhap kha dung
 *
 * @param mixed $login
 * @return
 */
function nv_check_username_reg( $login )
{
    global $db, $db_config, $lang_module;

    $stmt = $db->prepare( 'SELECT userid FROM ' . NV_USERS_GLOBALTABLE . ' WHERE md5username= :md5username' );
    $stmt->bindValue( ':md5username', nv_md5safe( $login ), PDO::PARAM_STR );

    $stmt->execute();

    list( $userid ) = $stmt->fetch(3);
    if( $userid > 0 ){
        return $userid;
    }

    $stmt = $db->prepare( 'SELECT userid FROM ' . NV_USERS_GLOBALTABLE . '_reg WHERE md5username= :md5username' );
    $stmt->bindValue( ':md5username', nv_md5safe( $login ), PDO::PARAM_STR );
    $stmt->execute();

    list($userid) = $stmt->fetch(3);
    if( $userid > 0 ){
        return $userid;
    }

    return 0;
}

/**
 * nv_check_email_reg()
 * Ham kiem tra email kha dung
 *
 * @param mixed $email
 * @return
 */
function nv_check_email_reg( $email )
{
    global $db, $db_config, $lang_module;

    list($left, $right) = explode('@', $email);
    $left = preg_replace('/[\.]+/', '', $left);
    $pattern = str_split($left);
    $pattern = implode('.?', $pattern);
    $pattern = '^' . $pattern . '@' . $right . '$';

    $stmt = $db->prepare( 'SELECT userid FROM ' . NV_USERS_GLOBALTABLE . ' WHERE email RLIKE :pattern' );
    $stmt->bindParam( ':pattern', $pattern, PDO::PARAM_STR );
    $stmt->execute();
    list($userid) = $stmt->fetch(3);

    if( $userid > 0 ) {
        return $userid;
    }

    $stmt = $db->prepare( 'SELECT userid FROM ' . NV_USERS_GLOBALTABLE . '_reg WHERE email RLIKE :pattern' );
    $stmt->bindParam( ':pattern', $pattern, PDO::PARAM_STR );
    $stmt->execute();
    list($userid) = $stmt->fetch(3);
    if( $userid > 0 ) {
        return $userid;
    }

    $stmt = $db->prepare( 'SELECT userid FROM ' . NV_USERS_GLOBALTABLE . '_openid WHERE email RLIKE :pattern' );
    $stmt->bindParam( ':pattern', $pattern, PDO::PARAM_STR );
    $stmt->execute();
    list($userid) = $stmt->fetch(3);
    if( $userid > 0 ) {
        return $userid;
    }

    return 0;
}


function nv_create_users( $username, $password, $email, $full_name, $gender, $birthday, $your_question, $answer, $group_id, $in_groups, $mobile, $chucvu, $donvicongtac )
{
    global $db, $crypt, $global_config, $lang_module;

    $password_hash = $crypt->hash( $password );
    $sql = "INSERT INTO " . NV_USERS_GLOBALTABLE . " (
            group_id, username, md5username, password, email, first_name, last_name, gender, photo, birthday, sig, regdate,
            question, answer, passlostkey, view_mail, remember, in_groups,
            active, checknum, last_login, last_ip, last_agent, last_openid, idsite, email_verification_time, active_obj
        ) VALUES (
            " . $group_id . ",
            :username,
            :md5username,
            :password,
            :email,
            :first_name,
            :last_name,
            :gender
            , '',
            :birthday,
            :sig,
             " . NV_CURRENTTIME . ",
            :question,
            :answer,
            '', 0, 1,
            '" . implode(',', $in_groups) . "',
            1, '', 0, '', '', '', " . $global_config['idsite'] . ", -1, 'SYSTEM'
        )";
    $array_fullname = explode(' ', $full_name );
    $first_name = end($array_fullname);
    array_pop($array_fullname);
    $last_name = implode(' ', $array_fullname);
    $data_insert = array();
    $data_insert['username'] = $username;
    $data_insert['md5username'] = nv_md5safe($username);
    $data_insert['password'] = $password_hash;
    $data_insert['email'] = $email;
    $data_insert['first_name'] = $first_name;
    $data_insert['last_name'] = $last_name;
    $data_insert['question'] = $your_question;
    $data_insert['answer'] = $answer;
    $data_insert['gender'] = $gender;
    $data_insert['birthday'] = intval($birthday);
    $data_insert['sig'] = '';

    $userid = $db->insert_id($sql, 'userid', $data_insert);
    if ($userid > 0) {
        $query_field['userid'] = $userid;
        $query_field['mobile'] = $db->quote( $mobile );
        $query_field['chucvu'] = $db->quote( $chucvu );
        $query_field['donvicongtac'] = $db->quote( $donvicongtac );
        $db->query('INSERT INTO ' . NV_USERS_GLOBALTABLE . '_info (' . implode(', ', array_keys($query_field)) . ') VALUES (' . implode(', ', array_values($query_field)) . ')');

        if (!empty( $in_groups )) {
            $data = '';
            foreach ( $in_groups as $group_id ){
                $db->query('INSERT INTO ' . NV_USERS_GLOBALTABLE . '_groups_users (
                    group_id, userid, is_leader, approved, data, time_requested, time_approved
                ) VALUES (
                    ' . $group_id . ',' . $userid . ', 0, 1, ' . $db->quote( $data ) . ', ' . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . '
                )');
                $db->query('UPDATE ' . NV_USERS_GLOBALTABLE . '_groups SET numbers = numbers+1 WHERE group_id=' . $group_id );
            }
        }

        //Tu dong dang nhap sau khi tao tk
        $array_user = array(
            'userid' => $userid,
            'username' => $username,
            'last_agent' => '',
            'last_ip' => '',
            'last_login' => 0,
            'last_openid' => ''
        );
        validUserLog($array_user, 1, '');
        //end Tu dong dang nhap sau khi tao tk

        //gui mail thông bao
        $_url = nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users', true);
        if (strpos($_url, NV_MY_DOMAIN) !== 0) {
            $_url = NV_MY_DOMAIN . $_url;
        }
        $subject = $lang_module['account_register'];
        $message = sprintf($lang_module['account_register_info'], $first_name, $global_config['site_name'], $_url, $username, $password );
        nv_sendmail([$global_config['site_name'], $global_config['site_email']], $email, $subject, $message);
    }
    return $userid;
}



/**
 * validUserLog()
 *
 * @param mixed $array_user
 * @param mixed $remember
 * @param mixed $opid
 * @return
 */
function validUserLog($array_user, $remember, $opid, $current_mode = 0)
{
    global $db, $global_config, $nv_Request, $lang_module, $global_users_config, $module_name, $client_info;

    $remember = intval($remember);
    $checknum = md5(nv_genpass(10));
    $user = array(
        'userid' => $array_user['userid'],
        'current_mode' => $current_mode,
        'checknum' => $checknum,
        'checkhash' => md5($array_user['userid'] . $checknum . $global_config['sitekey'] . $client_info['browser']['key']),
        'current_agent' => NV_USER_AGENT,
        'last_agent' => $array_user['last_agent'],
        'current_ip' => NV_CLIENT_IP,
        'last_ip' => $array_user['last_ip'],
        'current_login' => NV_CURRENTTIME,
        'last_login' => intval($array_user['last_login']),
        'last_openid' => $array_user['last_openid'],
        'current_openid' => $opid
    );

    $stmt = $db->prepare("UPDATE " . NV_USERS_GLOBALTABLE . " SET
        checknum = :checknum,
        last_login = " . NV_CURRENTTIME . ",
        last_ip = :last_ip,
        last_agent = :last_agent,
        last_openid = :opid,
        remember = " . $remember . "
        WHERE userid=" . $array_user['userid']);

    $stmt->bindValue(':checknum', $checknum, PDO::PARAM_STR);
    $stmt->bindValue(':last_ip', NV_CLIENT_IP, PDO::PARAM_STR);
    $stmt->bindValue(':last_agent', NV_USER_AGENT, PDO::PARAM_STR);
    $stmt->bindValue(':opid', $opid, PDO::PARAM_STR);
    $stmt->execute();
    $live_cookie_time = ($remember) ? NV_LIVE_COOKIE_TIME : 0;

    $nv_Request->set_Cookie('nvloginhash', json_encode($user), $live_cookie_time);

    if (!empty($global_users_config['active_user_logs'])) {
        $log_message = $opid ? ($lang_module['userloginviaopt'] . ' ' . $opid) : $lang_module['st_login'];
        nv_insert_logs(NV_LANG_DATA, $module_name, '[' . $array_user['username'] . '] ' . $log_message, ' Client IP:' . NV_CLIENT_IP, 0);
    }
}