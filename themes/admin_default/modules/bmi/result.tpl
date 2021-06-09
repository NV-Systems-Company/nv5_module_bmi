<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">
<!-- BEGIN: view -->
<form class="form-inline" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>{LANG.object_title}</th>
					<th>{LANG.round_title}</th>
					<th>Điểm</th>
					<th>{LANG.title}</th>
					<th>{LANG.status}</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<!-- BEGIN: loop -->
				<tr>
					<td> {VIEW.object_title} </td>
					<td> {VIEW.round_title} </td>
					<td> {VIEW.scorefrom} - {VIEW.scoreto} </td>
					<td> {VIEW.title} </td>
					<td> {VIEW.status} </td>
					<td class="text-center">
                        <i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{VIEW.link_edit}">{LANG.edit}</a>
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
					<tr class="form-inline">
						<th class="text-right"> {LANG.scorefrom} </th>
						<td><input class="form-control w200" type="text" name="scorefrom" value="{ROW.scorefrom}" required="required"/>
						{LANG.scoreto}
						<input class="form-control w200" type="text" name="scoreto" value="{ROW.scoreto}" required="required"/></td>
					</tr>
    				<tr>
    					<th class="text-right"> {LANG.title} </th>
    					<td><input class="form-control w500" type="text" name="title" id="idtitle" value="{ROW.title}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" /></td>
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
						<th class="text-right"> {LANG.select_object} </th>
						<td>
							<select class="form-control w500" name="roundid">
							<!-- BEGIN: select_round -->
								<option value="{ROUND.id}" {ROUND.sl}>{ROUND.title}</option>
							<!-- END: select_round -->
							</select>
						</td>
					</tr>
    				<tr>
    					<th class="text-right"> {LANG.status} </th>
    					<td>
							<select class="form-control w500" name="status">
								<option value=""> --- </option>
								<!-- BEGIN: select_status -->
								<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
								<!-- END: select_status -->
							</select>
						</td>
    				</tr>
    			</tbody>
    		</table>
    	</div>
    	<div style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
    </form>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<script>
	var CFG = [];
	CFG.upload_current = '{UPLOAD_CURRENT}';
	CFG.upload_path = '{UPLOAD_CURRENT}';
	$(document).ready(function() {
		$("#begintime,#endtime").datepicker({
			dateFormat : "dd/mm/yy",
			changeMonth : true,
			changeYear : true,
			showOtherMonths : true,
			showOn: 'focus'
		});

		$('#start_time-btn').click(function(){
			$("#begintime").datepicker('show');
		});

		$('#end_time-btn').click(function(){
			$("#endtime").datepicker('show');
		});
	});
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
			}else{
				window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '={OP}&objectid=' + r_split[1];
				return;
			}
			clearTimeout(nv_timer);

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