<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 10 Dec 2011 06:46:54 GMT
 */

if( !defined( 'NV_MAINFILE' ) )
    die( 'Stop!!!' );

if( !nv_function_exists( 'nv_block_svs_topscore' ) )
{
    function nv_block_config_svs_top( $module, $data_block, $lang_block )
    {
        global $site_mods, $nv_Cache;

        $html = '';
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['object'] . ':</label>';
        $html .= '<div class="col-sm-9"><select name="config_object" class="form-control">';
        $html .= '<option value="0"> -- </option>';
        $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_object ORDER BY weight ASC';
        $list = $nv_Cache->db($sql, 'id', $module);
        foreach ($list as $l) {
            $html .= '<option value="' . $l['id'] . '" ' . (($data_block['object'] == $l['id']) ? ' selected="selected"' : '') . '>' . $l['title'] . '</option>';
        }
        $html .= '</select>';
        $html .= '</div></div>';

        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['numrow'] . ':</label>';
        $html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_numrow" size="5" value="' . $data_block['numrow'] . '"/></div>';
        $html .= '</div>';

        return $html;
    }

    function nv_block_config_svs_top_submit( $module, $lang_block )
    {
        global $nv_Request;
        $return = array( );
        $return['error'] = array( );
        $return['config'] = array( );
        $return['config']['object'] = $nv_Request->get_int( 'config_object', 'post' );
        $return['config']['numrow'] = $nv_Request->get_int( 'config_numrow', 'post' );
        return $return;
    }

    function nv_block_svs_topscore( $block_config )
    {
        global $db, $site_mods, $nv_Cache, $module_info, $module_name, $lang_module, $global_config, $array_catalog, $config_module, $module_config;

        $module = $block_config['module'];

        if( $module_name != $module ){
            $config_module = $module_config[$module];
            $array_temp = $nv_Cache->db( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_catalog WHERE status=1 ORDER BY weight', 'id', $module );

            $array_catalog = array();
            $link_tmp = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=';
            foreach ( $array_temp as $tmp ){
                $tmp['link'] = $link_tmp . $tmp['alias'];
                $array_catalog[$tmp['id']] = $tmp;
            }
        }

        if( file_exists( NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $site_mods[$module]['module_file'] . '/block_svs_topscore.tpl' ) )
        {
            $block_theme = $module_info['template'];
        }
        else
        {
            $block_theme = 'default';
        }

        $xtpl = new XTemplate( 'block_svs_topscore.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $site_mods[$module]['module_file'] );
        $xtpl->assign( 'LANG', $lang_module );
        $xtpl->assign( 'TOTAL', $block_config['numrow'] );
        $stt = 1;
        $xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
        $result = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_project WHERE totalscore >0 AND objectid=' . $block_config['object'] . ' ORDER BY totalscore DESC LIMIT ' . $block_config['numrow'] );
        while ( $data_content = $result->fetch( )){
            $data_content['stt'] = $stt++;
            if ( !empty($data_content['image'])) {
                $data_content['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module . '/' . $data_content['image'];
            } else {
                $data_content['image'] = $config_module['image_default'];
            }
            $data_content['title_cut'] = nv_clean60( $data_content['title'], 55 );
            $data_content['link'] = $array_catalog[$data_content['catid']]['link'] . '/' . $data_content['alias'] . '-' . $data_content['id'] . $global_config['rewrite_exturl'];
            $data_content['totalscore'] = number_format( $data_content['totalscore'], 0, '.', ',');
            $xtpl->assign('DATA', $data_content );
            $xtpl->parse( 'main.loop' );
        }

        $xtpl->parse( 'main' );
        return $xtpl->text( 'main' );

    }

}

if( defined( 'NV_SYSTEM' ) )
{
    $module = $block_config['module'];
    $content = nv_block_svs_topscore( $block_config );

}
