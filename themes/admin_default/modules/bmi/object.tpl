<!-- BEGIN: main -->
<!-- BEGIN: view -->
<form class="form-inline" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>{LANG.stt}</th>
					<th>{LANG.title}</th>
					<th>{LANG.status}</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<!-- BEGIN: loop -->
				<tr>
					<td>
                        <!-- BEGIN: sort_weight -->
    						<select class="form-control" id="id_weight_{VIEW.id}" onchange="nv_change_weight('{VIEW.id}');">
    						<!-- BEGIN: weight_loop -->
    							<option value="{WEIGHT.key}"{WEIGHT.selected}>{WEIGHT.title}</option>
    						<!-- END: weight_loop -->
                            </select>
                        <!-- END: sort_weight -->	
				    </td>
					<td> {VIEW.title} </td>
					<td> {VIEW.status} </td>
					<td class="text-center">
                        <i class="fa fa-user fa-lg">&nbsp;</i> <a href="{VIEW.link_yearold}">{LANG.yearold}</a>
						- <i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{VIEW.link_edit}">{LANG.edit}</a>
                         - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a>
                    </td>
				</tr>
				<!-- END: loop -->
			</tbody>
		</table>
	</div>
</form>
<!-- END: view -->
    <!-- BEGIN: error -->
    <div class="alert alert-warning">{ERROR}</div>
    <!-- END: error -->
    <form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    	<input type="hidden" name="id" value="{ROW.id}" />
    	<div class="table-responsive">
    		<table class="table table-striped table-bordered table-hover">
    			<tbody>
    				<tr>
    					<th class="text-right"> {LANG.title} </th>
    					<td><input class="form-control w500" type="text" name="title" id="idtitle" value="{ROW.title}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" /></td>
    				</tr>
                    <tr>
						<th class="text-right">{LANG.alias}: </th>
						<td><input class="form-control w500 pull-left" name="alias" type="text" value="{ROW.alias}" maxlength="250" id="idalias"/> &nbsp;<em class="fa fa-refresh fa-lg fa-pointer text-middle" onclick="get_alias('{OP}', {ROW.id});">&nbsp;</em></td>
					</tr>
					<tr>
						<td>{LANG.image}</td>
						<td><input class="w350 form-control pull-left" type="text" name="image" id="image" value="{ROW.image}" style="margin-right: 5px"/><input type="button" value="Browse server" name="selectimage" class="btn btn-info"/></td>
					</tr>
                    <tr>
						<th class="text-right">{LANG.description} </th>
						<td ><textarea class="form-control" id="description" name="description" cols="100" rows="5">{ROW.description}</textarea></td>
					</tr>
    				<tr>
    					<th class="text-right"> {LANG.status} </th>
    					<td><select class="form-control w500" name="status">
    					<option value=""> --- </option>
    					<!-- BEGIN: select_status -->
    					<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
    					<!-- END: select_status -->
    				</select></td>
    				</tr>
    			</tbody>
    		</table>
    	</div>
    	<div style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
    </form>
<script>
	var CFG = [];
	CFG.upload_current = '{UPLOAD_CURRENT}';
	CFG.upload_path = '{UPLOAD_CURRENT}';
</script>
<script type="text/javascript">
//<![CDATA[
	function nv_change_weight(id) {
		var nv_timer = nv_settimeout_disable('id_weight_' + id, 5000);
		var new_vid = $('#id_weight_' + id).val();
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '={OP}&nocache=' + new Date().getTime(), 'ajax_action=1&id=' + id + '&new_vid=' + new_vid, function(res) {
			var r_split = res.split('_');
			if (r_split[0] != 'OK') {
				alert(nv_is_change_act_confirm[2]);
			}
			clearTimeout(nv_timer);
			window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '={OP}';
			return;
		});
		return;
	}
    <!-- BEGIN: auto_get_alias -->
	$("#idtitle").change(function() {
		get_alias("{OP}", 0);
	});
	<!-- END: auto_get_alias -->
//]]>
</script>
<!-- END: main -->