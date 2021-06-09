<!-- BEGIN: main -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="box-main">
	<div class="latest-heading text-center">
		CHỈ SỐ BMI THEO THỜI GIAN {USER.fullname}
	</div>
	<div class="content-block form-inline{HIDDEN}" style="width: 100%">
		<div class="form-group text-center" style="width: 100%">
			<div id="alert-msg" class="text-center"></div>
			<div class="input-group" id="in_fullname" style="width: 100%">
				<input type="hidden" name="id" value="{USER.id}">
				<input type="hidden" name="md5id" value="{USER.md5id}">
				<input type="text" maxlength="100" value="" style="width: 100%" name="fullname" class="form-control required" placeholder="Cập nhật họ tên của bạn">
				<span class="input-group-addon pointer" title="Lưu lại" onclick="save_fullname();"><em class="fa fa-save fa-lg"></em></span>
			</div>
		</div>
	</div>
	<div>{CHART}</div>
	<div class="text-center" style="padding: 10px">
		<a class="btn btn-success" style="color: #000" href="{LINK_BMI}"><strong>Kiểm tra BMI của bạn ngay</strong></a>
	</div>
	<!-- BEGIN: show_detail -->
	<div class="latest-heading text-center">
		Chi tiết chỉ số theo thời gian của {USER.fullname}
	</div>
	<div class="timeline">
		<!-- BEGIN: data -->
		<div class="container-timeline {DATA.col_float}">
			<div class="content">
				<h3>{DATA.score}: {DATA.title}</h3>
				<p><i class="fa fa-calendar">&nbsp;</i>{DATA.addtime}</p>
				<div>{DATA.description}</div>
			</div>
		</div>
		<!-- END: data -->
	</div>
	<!-- END: show_detail -->
</div>
<script>
	function save_fullname( objectid, roundid ){
		var fullname = trim( $('input[name=fullname]').val());
		var id = $('input[name=id]').val();
		var md5id = $('input[name=md5id]').val();
		if( fullname == ''){
			$('#alert-msg').addClass('alert alert-danger').html('Vui lòng nhập họ tên của bạn');
			$('input[name=fullname]').focus();
		}else{
			$.ajax({
				type: 'POST',
				cache: !0,
				dataType: 'json',
				url: nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=main',
				data: 'savename=1&fullname=' + fullname + '&id=' + id + '&md5id=' + md5id,
				success: function(response) {
					if (response.status == "OK") {
						$('#alert-msg').removeClass('alert-danger').addClass('alert alert-success').html(response.mess);
						$('#alert-msg').delay(3000).slideUp();
						$('#in_fullname').hide();
					} else{
						$('#alert-msg').addClass('alert alert-danger').html(response.mess);
						$('#in_fullname').show();
					}
				}
			});
		}
	}
</script>
<!-- END: main -->