/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 08 Apr 2014 15:13:43 GMT
 */

function get_alias(id) {
	var title = strip_tags(document.getElementById('idtitle').value);
	if (title != '') {
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=alias&nocache=' + new Date().getTime(), 'title=' + encodeURIComponent(title) + '&id=' + id, function(res) {
			if (res != "") {
				document.getElementById('idalias').value = res;
			} else {
				document.getElementById('idalias').value = '';
			}
		});
	}
	return false;
}


$("input[name=selectimage]").click(function() {
	var area = "image";
	var path = CFG.upload_path;
	var currentpath = CFG.upload_current;
	var type = "image";
	nv_open_browse(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
	return false;
});

function modalShowHtml() {
    var htmlform = $('#poupcontent').html();
    modalShow('', htmlform);
}

function modalShowFile(obj) {
    var filetype = $(obj).attr('data-filetype');
    var filename = $(obj).attr('data-file');
    var html = '';
    if( filetype == 'application/pdf' || filetype == 'video/mp4' ){
        html = '<iframe align="middle" frameborder="0" height="500" scrolling="yes" src="' + filename + '" width="100%"></iframe>';
    }else if( filetype == 'application/vnd.open'){
        window.location.href = filename;
    }else if( filetype == 'image/jpeg'){
        html = '<img class="img-thumbnail" src="' + filename + '" />';
    }
    modalShow('', html)
}

function nv_add_otherimage() {
	var newitem = '';
	newitem += "<div class=\"form-group\">";
	newitem += "<div class=\"input-group\">";
	newitem += "	<input class=\"form-control\" type=\"text\" name=\"documentfile[]\" id=\"documentfile_" + file_items + "\" />";
	newitem += "	<span class=\"input-group-btn\">";
	newitem += "		<button class=\"btn btn-default\" type=\"button\" onclick=\"nv_open_browse( '" + script_name + "?" + nv_name_variable + "=upload&popup=1&area=documentfile_" + file_items + "&path=" + file_dir + "&type=file&currentpath=" + currentpath + "', 'NVImg', 850, 400, 'resizable=no,scrollbars=no,toolbar=no,location=no,status=no' ); return false; \" >";
	newitem += "			<em class=\"fa fa-folder-open-o fa-fix\">&nbsp;</em></button>";
	newitem += "	</span>";
	newitem += "</div>";
	newitem += "</div>";

	$("#projectfile").append(newitem);
	file_items++;
}

function nv_add_otherimageuser() {

	var newitem = '';
	newitem += "<div class=\"form-group\">";
	newitem += "<div class=\"input-group\">";
	newitem += "	<input class=\"form-control\" type=\"text\" name=\"imgusers[]\" id=\"imgusers_" + file_items_user + "\" />";
	newitem += "	<span class=\"input-group-btn\">";
	newitem += "		<button class=\"btn btn-default\" type=\"button\" onclick=\"nv_open_browse( '" + script_name + "?" + nv_name_variable + "=upload&popup=1&area=imgusers_" + file_items_user + "&path=" + file_dir + "&type=file&currentpath=" + currentpath + "', 'NVImg', 850, 400, 'resizable=no,scrollbars=no,toolbar=no,location=no,status=no' ); return false; \" >";
	newitem += "			<em class=\"fa fa-folder-open-o fa-fix\">&nbsp;</em></button>";
	newitem += "	</span>";
	newitem += "</div>";
	newitem += "</div>";

	$("#imgusers").append(newitem);
	file_items_user++;
}
function nv_add_otherimageproduct() {

	var newitem = '';
	newitem += "<div class=\"form-group\">";
	newitem += "<div class=\"input-group\">";
	newitem += "	<input class=\"form-control\" type=\"text\" name=\"imgproduct[]\" id=\"imgproduct_" + file_items_product + "\" />";
	newitem += "	<span class=\"input-group-btn\">";
	newitem += "		<button class=\"btn btn-default\" type=\"button\" onclick=\"nv_open_browse( '" + script_name + "?" + nv_name_variable + "=upload&popup=1&area=imgproduct_" + file_items_product + "&path=" + file_dir + "&type=file&currentpath=" + currentpath + "', 'NVImg', 850, 400, 'resizable=no,scrollbars=no,toolbar=no,location=no,status=no' ); return false; \" >";
	newitem += "			<em class=\"fa fa-folder-open-o fa-fix\">&nbsp;</em></button>";
	newitem += "	</span>";
	newitem += "</div>";
	newitem += "</div>";

	$("#imgproduct").append(newitem);
	file_items_product++;
}