<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 12/31/2009 0:51
 */

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

$array_object = $nv_Cache->db( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_object WHERE status=1 ORDER BY weight', 'id', $module_name );
$array_round = $nv_Cache->db( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_round WHERE status=1 ORDER BY weight', 'id', $module_name );
$array_result = $nv_Cache->db( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_result WHERE status=1', 'id', $module_name );

$array_status = [
	0 => 'Ẩn',
	1 => 'Hiện'
]; 

function nv_svs_sendmail($rowsid, $from, $to, $subject, $message, $replyto, $files = '')
{
    global $db, $module_name, $module_data, $global_config, $nv_Cache, $lang_module, $crypt;

    $mailserver = nv_get_mailserver($rowsid);

    if (!empty($mailserver)) {
        try {
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->SetLanguage(NV_LANG_INTERFACE);
            $mail->CharSet = $global_config['site_charset'];

            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Port = $mailserver['smtp_port'];
            $mail->Host = $mailserver['smtp_host'];
            $mail->Username = $mailserver['smtp_username'];
            $mail->Password = $crypt->decrypt(nv_base64_decode($mailserver['smtp_password']));

            $SMTPSecure = intval($mailserver['smtp_encrypted']);
            switch ($SMTPSecure) {
                case 1:
                    $mail->SMTPSecure = 'ssl';
                    break;
                case 2:
                    $mail->SMTPSecure = 'tls';
                    break;
                default:
                    $mail->SMTPSecure = '';
            }

            $message = nv_url_rewrite($message);
            $message = nv_change_buffer($message);
            $message = nv_unhtmlspecialchars($message);

            if (is_array($from)) {
                $mail->From = $from[1];
                $mail->FromName = $from[0];
            } else {
                $mail->From = $from[1];
            }

            if (is_array($replyto)) {
                $mail->addReplyTo($replyto[1], $replyto[0]);
            } else {
                $mail->addReplyTo($replyto);
            }

            if (empty($to)) {
                return $lang_module['error_empty_to'];
            }

            if (!is_array($to)) {
                $to = array(
                    $to
                );
            }

            foreach ($to as $_to) {
                $mail->addAddress($_to);
            }

            $mail->Subject = nv_unhtmlspecialchars($subject);
            $mail->WordWrap = 120;
            $mail->Body = $message;
            $mail->AltBody = strip_tags($message);
            $mail->IsHTML(true);

            if (!empty($files)) {
                $files = array_map('trim', explode(',', $files));

                foreach ($files as $file) {
                    $mail->addAttachment($file);
                }
            }

            if (!$mail->Send()) {
                trigger_error($mail->ErrorInfo, E_USER_WARNING);
                return $mail->ErrorInfo;
            }

            $_SESSION[$module_data . '_mailserver'][$rowsid][$mailserver['id']]++;
        } catch (phpmailerException $e) {
            trigger_error($e->errorMessage(), E_USER_WARNING);
            return $e->errorMessage();
        }
    } else {
        return $lang_module['error_empty_mailserver'];
    }
}

function nv_get_mailserver($rowsid)
{
    global $db, $module_data, $module_name, $nv_Cache, $user_info;

    $_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_mailserver WHERE status=1';
    $array_mailserver = $nv_Cache->db($_sql, '', $module_name);
    $key = array_rand($array_mailserver);//lay ngau nhien cac mail server
	
    return $array_mailserver[$key];

}