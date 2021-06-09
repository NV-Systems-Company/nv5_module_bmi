<!-- BEGIN: main -->
<div class="container">
	<div class="row">
		<section>
			<h1 class="text-center">Nộp các dự án vòng thi cơ sở (SV Startup 2020)</h1>
			<div class="wizard">
				<form enctype="multipart/form-data" action="{FORM_LEFT}" method="post" id="question">
					<!-- BEGIN: error -->
					<div style="width: 100%" class="alert alert-danger">{ERROR}</div>
					<!-- END: error -->
						<div class="tab-pane active" role="tabpanel" id="step1">
							<div class="step1">
								<h2 class="text-center pb-25"><strong>Thông tin cán bộ nộp bài</strong></h2>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<em class="fa fa-user fa-lg fa-horizon">
													</em>
												</span>
												<input type="text" maxlength="100" value="{CANBO.fullname}"{CONTENT.disabled} name="fullname_canbo" class="form-control required" placeholder="{LANG.fullname}" data-pattern="/^(.){3,}$/" onkeypress="nv_validErrorHidden(this);" />
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<em class="fa fa-info fa-fix fa-lg fa-horizon"></em>
												</span>
												<input type="text" maxlength="60" value="{CANBO.chucvu}"{CONTENT.disabled} name="chucvu_canbo" class="form-control required" placeholder="{LANG.chucvu}" onkeypress="nv_validErrorHidden(this);" />
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<em class="fa fa-bank fa-fix fa-lg fa-horizon"></em>
												</span>
												<input type="text" maxlength="60" value="{CANBO.donvicongtac}"{CONTENT.disabled} name="donvicongtac_canbo" class="form-control required" placeholder="{LANG.donvicongtac}" onkeypress="nv_validErrorHidden(this);" />
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<em class="fa fa-phone-square fa-fix fa-lg fa-horizon"></em>
												</span>
												<input type="text" maxlength="60" value="{CANBO.mobile}"{CONTENT.disabled} name="mobile_canbo" class="form-control required" placeholder="{LANG.mobile}" onkeypress="nv_validErrorHidden(this);" />
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<em class="fa fa-envelope fa-fix fa-lg fa-horizon"></em>
												</span>
												<input type="email" maxlength="60" value="{CANBO.email}"{CONTENT.disabled} name="email_canbo" class="form-control required" placeholder="{LANG.email}" onkeypress="nv_validErrorHidden(this);" />
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="step2 rs-courses-details">
								<h2 class="text-center pb-25"><strong>Thông tin dự án</strong></h2>
								<div class="row break-item">
									<div class="col-md-24">
										<p><strong>Thông tin trưởng nhóm dự thi</strong></p>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<em class="fa fa-user fa-lg fa-horizon">
													</em>
												</span>
												<input type="text" maxlength="100" value="{MUSER.fullname}"{CONTENT.disabled} name="fullname" class="form-control required" placeholder="{LANG.fullname}" data-pattern="/^(.){3,}$/" onkeypress="nv_validErrorHidden(this);" />
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<em class="fa fa-bank fa-fix fa-lg fa-horizon"></em>
												</span>
												<input type="text" maxlength="60" value="{MUSER.school_name}"{CONTENT.disabled} name="school_name" class="form-control required" placeholder="{LANG.school}" onkeypress="nv_validErrorHidden(this);" />
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<em class="fa fa-phone-square fa-fix fa-lg fa-horizon"></em>
												</span>
												<input type="text" maxlength="60" value="{MUSER.mobile}" name="mobile" class="form-control required" placeholder="{LANG.mobile}" onkeypress="nv_validErrorHidden(this);" />
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<em class="fa fa-envelope fa-fix fa-lg fa-horizon"></em>
												</span>
												<input type="text" maxlength="60" value="{MUSER.email}" name="email" class="form-control required" placeholder="{LANG.email}" onkeypress="nv_validErrorHidden(this);" />
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<em class="fa fa-meh-o fa-fix fa-lg fa-horizon"></em>
												</span>
												<input type="text" maxlength="60" value="{MUSER.yearstudy}"{CONTENT.disabled} name="yearstudy" class="form-control" placeholder="{LANG.namthu}" onkeypress="nv_validErrorHidden(this);" />
											</div>
										</div>
									</div>
								</div>
								<div class="row break-item">
									<div class="col-md-24">
										<p><strong>Thông tin các thành viên trong nhóm</strong></p>
									</div>
									<div class="col-md-24">Danh sách thành viên trong nhóm (tên, trường, chuyên ngành đang học nếu là sinh viên, không quá 05 người)</div>
									<div class="col-md-24">
										<table class="table table-bordered table-hover grid-edit fifth-row">
											<thead>
											<tr>
												<th style="width:10px">STT</th>
												<th>Họ và tên</th>
												<th>SĐT</th>
												<th>Email</th>
												<th>Năm thứ/lớp</th>
											</tr>
											</thead>
											<tbody id="item_user">
											<!-- BEGIN: user_other -->
											<tr>
												<td>{stt}</td>
												<td>
													<input placeholder="..............." value="{PUSER.fullname}" type="text" name="full_name_other[]" class="form-control">
												</td>
												<td>
													<input placeholder="..............." value="{PUSER.mobile}" type="text" name="mobile_other[]" class="form-control">
												</td>
												<td>
													<input placeholder="..............." value="{PUSER.email}" type="text" name="email_other[]" class="form-control">
												</td>
												<td>
													<input placeholder="..............." value="{PUSER.yearstudy}" type="text" name="yearstudy_other[]" class="form-control">
												</td>
											</tr>
											<!-- END: user_other -->
											</tbody>
											<tfoot>
											<tr>
												<td colspan="5"><button type="button" class="btn btn-primary" onclick="add_more_user()">Thêm thành viên</button></td>
											</tr>
											</tfoot>
										</table>
										<div class="col-md-24" id="userlist1">
											<label>
												<strong>Hình ảnh đội thi</strong>
												<i class="textnote">(Số lượng ảnh từ 3 -5 ảnh. Kích thước ảnh tối đa 2Mb, Có thể chọn nhiều hình ảnh cùng lúc)</i>
											</label>
											<div class="form-group">
												<div id="imgusers">
													<!-- BEGIN: imgusers -->
													<div class="form-group">
														<div class="input-group">
															<input value="{IMGUSER}" name="imgusers[]" id="imgusers_{key}" class="form-control" maxlength="255">
															<span class="input-group-btn">
																<button class="btn btn-default" type="button" onclick="nv_open_browse( '{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}=upload&popup=1&area=imgusers_{key}&path={UPLOADS_DIR_USER}&currentpath={UPLOADS_DIR_USER}&type=file', 'NVImg', 850, 500, 'resizable=no,scrollbars=no,toolbar=no,location=no,status=no' ); return false; ">
																	<em class="fa fa-folder-open-o fa-fix">&nbsp;</em>
																</button>
															</span>
														</div>
													</div>
													<!-- END: imgusers -->
												</div>
												<input type="button" class="btn btn-info" onclick="nv_add_otherimageuser();" value="Thêm hình ảnh">
											</div>
										</div>
										<div class="col-md-24">
											<label>
												<strong>Hình ảnh sản phẩm</strong>
												<i class="textnote">(Số lượng ảnh từ 3 -5 ảnh.)</i>
											</label>
											<div class="form-group">
												<div id="imgproduct">
													<!-- BEGIN: imgproduct -->
													<div class="form-group">
														<div class="input-group">
															<input value="{IMGUSER}" name="imgproduct[]" id="imgproduct_{key}" class="form-control" maxlength="255">
															<span class="input-group-btn">
																<button class="btn btn-default" type="button" onclick="nv_open_browse( '{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}=upload&popup=1&area=imgproduct_{key}&path={UPLOADS_DIR_USER}&currentpath={UPLOADS_DIR_USER}&type=file', 'NVImg', 850, 500, 'resizable=no,scrollbars=no,toolbar=no,location=no,status=no' ); return false; ">
																	<em class="fa fa-folder-open-o fa-fix">&nbsp;</em>
																</button>
															</span>
														</div>
													</div>
													<!-- END: imgproduct -->
												</div>
												<input type="button" class="btn btn-info" onclick="nv_add_otherimageproduct();" value="Thêm hình ảnh">
											</div>
										</div>
									</div>
								</div>
								<div class="row pt-25">
									<div class="col-md-24">
										<p><strong>Thông tin về dự án</strong></p>
									</div>
									<div class="col-md-24">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<em class="fa fa-user fa-lg fa-horizon">
													</em>
												</span>
												<input type="text" maxlength="100" value="{CONTENT.title}"{CONTENT.disabled} name="title" class="form-control required" placeholder="{LANG.project_name}" data-pattern="/^(.){3,}$/" onkeypress="nv_validErrorHidden(this);" />
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<em class="fa fa-bank fa-fix fa-lg fa-horizon"></em>
												</span>
												<select name="catid" class="form-control required">
													<option value="">-- {LANG.linhvuc} --</option>
													<!-- BEGIN: catalog -->
													<option value="{CATALOG.id}"{CATALOG.sl}>{CATALOG.title}</option>
													<!-- END: catalog -->
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<em class="fa fa-user-plus fa-fix fa-lg fa-horizon"></em>
												</span>
												<select name="objectid" class="form-control required">
													<option value="">-- {LANG.doituong} --</option>
													<!-- BEGIN: object -->
													<option value="{OBJECT.id}"{OBJECT.sl}>{OBJECT.title}</option>
													<!-- END: object -->
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-24">
										<div class="form-group">
											<label><strong>Hình minh họa dự án</strong></label>
											<div class="input-group">
												<input value="{CONTENT.image}" name="image" id="image" class="form-control" maxlength="255">
												<span class="input-group-btn">
													<button class="btn btn-default" type="button" onclick="nv_open_browse( '{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}=upload&popup=1&area=image&path={UPLOADS_DIR_USER}&currentpath={UPLOADS_DIR_USER}&type=file', 'NVImg', 850, 500, 'resizable=no,scrollbars=no,toolbar=no,location=no,status=no' ); return false; ">
														<em class="fa fa-folder-open-o fa-fix">&nbsp;</em>
													</button>
												</span>
											</div>
										</div>
									</div>
									<div class="col-md-24">
										<div class="form-group">
											<label><strong>1. {LANG.note_project}</strong></label>
											<textarea placeholder="Tóm tắt từ 01 - 02 dòng" name="note" class="form-control required">{CONTENT.note}</textarea>
										</div>
									</div>
									<div class="col-md-24">
										<div class="form-group">
											<label><strong>2. {LANG.description}</strong></label>
											<textarea placeholder="Tóm tắt từ 03 - 05 dòng" name="description" class="form-control required">{CONTENT.description}</textarea>
										</div>
									</div>
									<div class="col-md-24">
										<div class="form-group">
											<label><strong>3. {LANG.strength}</strong></label>
											<textarea placeholder="Mô tả về điểm mạnh của dự án" name="strength" class="form-control">{CONTENT.strength}</textarea>
										</div>
									</div>
									<div class="col-md-24">
										<div class="form-group">
											<label><strong>4. {LANG.weakness}</strong></label>
											<textarea placeholder="Mô tả về điểm yếu của dự án" name="weakness" class="form-control">{CONTENT.weakness}</textarea>
										</div>
									</div>
									<div class="col-md-24">
										<div class="form-group">
											<label><strong>5. {LANG.opportunity}</strong></label>
											<textarea placeholder="{LANG.opportunity}" name="opportunity" class="form-control">{CONTENT.opportunity}</textarea>
										</div>
									</div>
									<div class="col-md-24">
										<div class="form-group">
											<label><strong>6. {LANG.challenge}</strong></label>
											<textarea placeholder="{LANG.challenge}" name="challenge" class="form-control">{CONTENT.challenge}</textarea>
										</div>
									</div>
									<div class="col-md-24" id="document_list">
										<div class="form-group">
											<label><strong>3. Giá trị giải pháp của dự án</strong></label>
											<textarea rows="2" name="giatrigiaiphap" class="form-control required">{CONTENT.giatrigiaiphap}</textarea>
										</div>
										<div class="form-group">
											<label><strong>1. Tính ứng dụng thực tế của sản phẩm/dịch vụ</strong></label>
											<textarea rows="2" name="tinhungdung" class="form-control required">{CONTENT.tinhungdung}</textarea>
										</div>
										<div class="form-group">
											<label><strong>2. Tính độc đáo, sáng tạo, giá trị khác biệt của sản phẩm dự án</strong></label>
											<textarea rows="2" name="tinhdocdao" class="form-control required">{CONTENT.tinhdocdao}</textarea>
										</div>
										<div class="form-group">
											<label><strong>3. Tính khả thi của dự án</strong></label>
											<textarea rows="2" name="tinhkhathi" class="form-control required">{CONTENT.tinhkhathi}</textarea>
										</div>
									</div>
									<div class="col-md-24" id="document_list">
										<label><strong>7. File tài liệu</strong></label>
										<div id="projectfile">
											<!-- BEGIN: project_file -->
											<div class="form-group">
												<div class="input-group">
													<input value="{PFILE.filename}" name="documentfile[]" id="documentfile_{PFILE.key}" class="form-control" maxlength="255">
													<span class="input-group-btn">
														<button class="btn btn-default" type="button" onclick="nv_open_browse( '{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}=upload&popup=1&area=documentfile_{PFILE.key}&path={UPLOADS_DIR_USER}&currentpath={UPLOADS_DIR_USER}&type=file', 'NVImg', 850, 500, 'resizable=no,scrollbars=no,toolbar=no,location=no,status=no' ); return false; ">
															<em class="fa fa-folder-open-o fa-fix">&nbsp;</em>
														</button>
													</span>
												</div>
											</div>
											<!-- END: project_file -->
										</div>
										<input type="button" class="btn btn-info" onclick="nv_add_otherimage();" value="{LANG.add_more_file}">
									</div>
								</div>
								<div class="clearfix">&nbsp;</div>
							</div>
							<div class="text-center">
								<input type="hidden" value="{CANBO.userid}" name="userid" />
								<input type="hidden" value="1" name="submit" />
								<input type="hidden" value="{CONTENT.id}" name="id" />
								<button type="submit" class="btn btn-success">{LANG.submit}</button>
							</div>
						</div>
						<div class="clearfix"></div>
				</form>
			</div>
		</section>
	</div>
</div>
<script>
	var num_form_project = {num_form_project} + 1;
	var file_items = '{FILE_ITEMS}';
	var file_items_user = '{FILE_ITEMS_USER}';
	var file_items_product = '{FILE_ITEMS_PRODUCT}';
	var file_dir = '{UPLOADS_DIR_USER}';
	var currentpath = "{UPLOADS_DIR_USER}";

	function add_more_user() {
		if( num_form_project < 6 ){
			var html_add = '<tr>\n' +
					'                        <td>' + num_form_project + '</td>\n' +
					'                        <td>\n' +
					'                           <input placeholder="..............." type="text" name="full_name_other[]" class="form-control">\n' +
					'                        </td>\n' +
					'                        <td>\n' +
					'                            <input placeholder="..............." type="text" name="mobile_other[]" class="form-control">\n' +
					'                        </td>\n' +
					'                        <td>\n' +
					'                            <input placeholder="..............." type="text" name="email_other[]" class="form-control">\n' +
					'                        </td>\n' +
					'                        <td>\n' +
					'                            <input placeholder="..............." type="text" name="yearstudy_other[]" class="form-control">\n' +
					'                        </td>\n' +
					'                    </tr>';
			$('#item_user').append( html_add );
			num_form_project++;
		}
	}
</script>
<!-- END: main -->