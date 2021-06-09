<!-- BEGIN: main -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="box-main bmi-box">
	<div class="latest-heading text-center">
		TÍNH CHỈ SỐ BMI
	</div>
	<div class="content-block">
		<form id="form_bmi" style="display: grid" action="{BASE_URL_SITE}" method="get" class="pt-md-2 form_transparent">
			<div class="col-sm-12">
				<div id="alert-msg" class="text-center"></div>
			</div>
			<div class="form-group col-sm-24">
				<input placeholder="Nhập cân nặng (kg)" class="required form-control" name="weight" type="text" value="">
			</div>
			<div class="form-group col-sm-24">
				<input placeholder="Nhập chiều cao (cm)" class="required form-control" name="height" type="text" value="">
			</div>
			<!-- BEGIN: object -->
			<div class="form-group col-sm-24">
				<select class="required form-control" name="objectid">
					<option value="0">--Chọn độ tuổi--</option>
					<!-- BEGIN: loop -->
					<option value="{OBJECT.id}">{OBJECT.title}</option>
					<!-- END: loop -->
				</select>
			</div>
			<!-- END: object -->
			<div class="form-group col-sm-24" id="show_round"></div>
			<div class="col-md-24">
				<span id="status_loading" style="display:none"><img src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/images/load_bar.gif">&nbsp;Vui lòng chờ...</span>
				<input class="btn btn-success" name="reg_bmi_submit" type="button" value="Tính BMI">
			</div>
		</form>
		<div class="show_result_bmi" style="display: none">
			<h4 class="text-center">Chỉ số BMI: <span id="bmi-score" class="colorp">24.86</span></h4>
			<h5 class="text-center">Tình Trạng: <span id="tinhtrang" class="colorp">Cân nặng bình thường</span></h5>
			<div id="bmi_text"></div>
			<div class="bmi_suggest">
				<p class="head1">Bạn có muốn theo dõi chỉ số BMI định kỳ?</p>
				<p class="text-center">Nhập số điện thoại để tra cứu theo thời gian ngay bây giờ</p>
				<div class="form-group col-sm-12">
					<div id="alert-msg-2" class="text-center"></div>
					<div id="chart_data"></div>
					<div id="link_view"></div>
				</div>
				<div class="form-group col-sm-24 form_mobile">
					<input placeholder="SĐT thường sử dụng của bạn" class="required form-control" name="mobile" type="text" value="">
					<input name="roundid" id="roundid_save" type="hidden" value="">
					<input name="resultid" id="resultid_save" type="hidden" value="">
					<input name="score" id="score_save" type="hidden" value="">
				</div>
				<div class="form_mobile" style="display: contents">
					<span id="status_loading_2" style="display:none"><img src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/images/load_bar.gif">&nbsp;Vui lòng chờ...</span>
					<input class="btn btn-success" name="bmi_submit_follow" type="button" value="Theo dõi ngay">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- BEGIN: bodytext -->
<div class="bodytext">{bodytext}</div>
<!-- END: bodytext -->
<script type="text/javascript">
	$('select[name=objectid]').change(function (){
		show_round($(this).val(), 0);
	})
	function show_round( objectid, roundid ){
		$.ajax({
			type: 'POST',
			cache: !0,
			url: nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=main',
			data: 'showround=1&objectid=' + objectid + '&roundid=' + roundid,
			dataType: 'html',
			success: function(res) {
				$('#show_round').html(res);
			}
		});
	}
	$('input[name=bmi_submit_follow]').click(function() {
		var mobile = trim( $('input[name=mobile]').val());
		var roundid = trim( $('input[name=roundid]').val());
		var resultid = trim( $('input[name=resultid]').val());
		var score = trim( $('input[name=score]').val());
		var intRegexPhone = /^[0-9]+$/
		if( mobile == '' ){
			$('#alert-msg-2').addClass('alert alert-danger').html('Vui lòng nhập số điện thoại của bạn');
			$('input[name=mobile]').focus();
		}else if((mobile.length < 10 ) || (!intRegexPhone.test(mobile))){
			$('#alert-msg-2').addClass('alert alert-danger').html('Vui lòng nhập số điện thoại liên hệ của là số có 10 chữ số');
			$('input[name=mobile]').focus();
		}else {
			$('#status_loading_2').show();
			$.ajax({
				type : "POST",
				dataType: 'json',
				url : nv_base_siteurl + "index.php?" + nv_name_variable + "={MODULE_NAME}&" + nv_fc_variable + "=main&nocache=" + new Date().getTime(),
				data : "bmi_save=1&mobile=" + mobile + '&score=' + score + '&roundid=' + roundid + '&resultid=' + resultid,
				success : function(response) {
					if (response.status == "OK") {
						$('#alert-msg-2').removeClass('alert-danger').addClass('alert alert-success').html(response.mess);
						$('#chart_data').html(response.data);
						$('.form_mobile').hide();
						$('#link_view').html('<strong>Kết quả đầy đủ cho bạn: </strong><a href="' + response.link_view + '">'+ response.link_view + '</a>');
					} else{
						$('#alert-msg-2').addClass('alert alert-danger').html(response.mess);
					}
					$('#status_loading_2').hide();
				},
				error : function(x, e) {
					if (x.status == 0) {
						alert('You are offline!!\n Please Check Your Network.');
					} else if (x.status == 404) {
						alert('Requested URL not found.');
					} else if (x.status == 500) {
						alert('{LANG.read_error_memory_limit}');
					} else if (e == 'timeout') {
						alert('Request Time out.');
					} else {
						alert('Unknow Error.\n' + x.responseText);
					}
					$('input[name=reg_bmi_submit]').show();
					$('#status_loading').hide();
				}
			});
		}
	});
	$('input[name=reg_bmi_submit]').click(function() {
		var weight = trim( $('input[name=weight]').val());
		var height = trim( $('input[name=height]').val());
		var objectid = trim( $('select[name=objectid]').val());
		var roundid = trim( $('select[name=roundid]').val());

		if( weight == '' ){
			$('#alert-msg').addClass('alert alert-danger').html('Vui lòng nhập cân nặng đơn vị kg');
			$('input[name=weight]').focus();
		}else if(height == ''){
			$('#alert-msg').addClass('alert alert-danger').html('Vui lòng nhập chiều cao đã quy đổi ra cm');
			$('input[name=phone]').focus();
		}else if(objectid == 0){
			$('#alert-msg').addClass('alert alert-danger').html('Bạn chưa chọn đối tượng tính BMI');
			$('select[name=objectid]').focus();
		}else if(roundid == 0){
			$('#alert-msg').addClass('alert alert-danger').html('Bạn chưa chọn độ tuổi tính BMI');
			$('select[name=roundid]').focus();
		}
		else{
			$('input[name=reg_bmi_submit]').hide();
			$('#status_loading').show();
			$('#bmi-score, #tinhtrang, #bmi_text').html();//lam rong gia tri cu
			$('.show_result_bmi').hide();
			$.ajax({
				type : "POST",
				dataType: 'json',
				url : nv_base_siteurl + "index.php?" + nv_name_variable + "={MODULE_NAME}&" + nv_fc_variable + "=main&nocache=" + new Date().getTime(),
				data : "bmi=1&weight=" + weight + '&height=' + height + '&objectid=' + objectid + '&roundid=' + roundid,
				success : function(response) {
					if (response.status == "OK") {
						$('.show_result_bmi').show();
						$('#alert-msg').removeClass('alert alert-danger').html();
						$('#bmi-score').html(response.bmi);
						$('#score_save').val(response.bmi);
						$('#roundid_save').val(response.roundid);
						$('#resultid_save').val(response.resultid);
						$('#tinhtrang').html(response.title);
						$('#bmi_text').html(response.description);
						$('#form_bmi').hide();//an form tra cuu
					} else{
						$('#alert-msg').addClass('alert alert-danger').html(response.mess);
					}
					$('input[name=reg_bmi_submit]').show();
					$('#status_loading').hide();
				},
				error : function(x, e) {
					if (x.status == 0) {
						alert('You are offline!!\n Please Check Your Network.');
					} else if (x.status == 404) {
						alert('Requested URL not found.');
					} else if (x.status == 500) {
						alert('{LANG.read_error_memory_limit}');
					} else if (e == 'timeout') {
						alert('Request Time out.');
					} else {
						alert('Unknow Error.\n' + x.responseText);
					}
					$('input[name=reg_bmi_submit]').show();
					$('#status_loading').hide();
				}
			});
		}
	});
</script>
<!-- END: main -->