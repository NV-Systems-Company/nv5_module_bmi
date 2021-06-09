<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 08 Apr 2014 15:13:43 GMT
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$lang_translator['author'] = 'VINADES.,JSC (contact@vinades.vn)';
$lang_translator['createdate'] = '08/04/2014, 15:13';
$lang_translator['copyright'] = '@Copyright (C) 2014 VINADES.,JSC. All rights reserved';
$lang_translator['info'] = '';
$lang_translator['langtype'] = 'lang_module';

$lang_module['success'] = 'Gửi kết quả';
$lang_module['success_info'] = 'Thông tin trả lời của bạn đã được hệ thống ghi nhận.';
$lang_module['success_user_info'] = 'Bạn có thể xem lại thông tin trả lời tại <a href="%s">đây</a>';
$lang_module['form_close_info'] = 'Chương trình này được mở từ %s và đóng vào %s';
$lang_module['form_is_close_info'] = 'Chương trình này đã đóng vào %s';
$lang_module['reset'] = 'Làm lại';

$lang_module['error_form_not_found_detail'] = 'Hệ thống không tìm thấy biểu mẫu nào theo như yêu cầu của bạn.<br />Vui lòng liên hệ với quản trị để biết thêm thông tin.';
$lang_module['error_form_not_premission_detail'] = 'Bạn không được phép truy cập biểu mẫu này.<br />Vui lòng liên hệ quản trị để biết thêm chi tiết.';
$lang_module['error_form_not_status_detail'] = 'Biểu mẫu này chưa được kích hoạt.<br />Vui lòng liên hệ quản trị để biết thêm thông tin.';
$lang_module['error_form_not_start'] = 'Biểu mẫu này sẽ được mở sau thời gian: <strong>%s</strong>';
$lang_module['error_form_closed'] = 'Biểu mẫu này đóng vào lúc <strong>%s</strong>';

$lang_module['field_no_edit'] = '%s không được phép thay đổi';
$lang_module['field_match_type_error'] = '%s không đúng quy tắc';
$lang_module['field_min_max_value'] = '%1$s cần nhập từ %2$s đến %3$s';
$lang_module['field_min_max_error'] = '%1$s cần nhập từ %2$s đến %3$s ký tự';
$lang_module['field_match_type_required'] = '%s bắt buộc nhập';

$lang_module['fullname'] = 'Họ và tên';
$lang_module['email'] = 'Email liên hệ';
$lang_module['mobile'] = 'SĐT liên hệ (VD: 0912664xxx)';
$lang_module['namthu'] = 'Sinh viên năm thứ/lớp';
$lang_module['chuyennganh'] = 'Chuyên ngành';
$lang_module['khoa'] = 'Khoa';
$lang_module['school'] = 'Trường học';
$lang_module['error_birthday'] = 'Bạn chưa nhập ngày sinh hoặc ngày sinh không đúng định dạng';
$lang_module['error_fullname'] = 'Bạn chưa nhập họ tên trưởng nhóm cho dự án %s';
$lang_module['error_mobile'] = 'Bạn chưa nhập số điện thoại trưởng nhóm cho dự án %s';
$lang_module['error_fomart_mobile'] = 'Số điện thoại trưởng nhóm cho dự án %s nhập không đúng. SĐT gồm 10 chữ số bắt đầu bằng sô 0';
$lang_module['error_email'] = 'Bạn chưa nhập email trưởng nhóm cho dự án %s';
$lang_module['review_ok'] = 'Cảm ơn bạn đã tham gia khảo sát. Chúng tôi đã ghi nhận thông tin của bạn!';
$lang_module['error_review'] = 'Bạn chưa chọn đáp án các câu số:';
$lang_module['error_khoa'] = 'Bạn chưa nhập khoa trưởng nhóm cho dự án %s';
$lang_module['error_school'] = 'Bạn chưa nhập trường học trưởng nhóm cho dự án %s';
$lang_module['error_chuyennganh'] = 'Bạn chưa nhập chuyên ngành trưởng nhóm cho dự án %s';

$lang_module['chart_by_chuyennganh'] = 'Biểu đồ thống kê theo chuyên ngành';
$lang_module['chart_by_studentyear'] = 'Biểu đồ thống kê theo sinh viên năm thứ';
$lang_module['chart_by_khoa'] = 'Biểu đồ thống kê theo khoa đào tạo';
$lang_module['report_page_title'] = 'Thống kê phiếu khảo sát thuộc "%s"';

$lang_module['project_name'] = 'Tên dự án';
$lang_module['linhvuc'] = 'Lĩnh vực dự thi';
$lang_module['doituong'] = 'Đối tượng dự thi';
$lang_module['note_project'] = 'Ý tưởng dự án';
$lang_module['description'] = 'Mô tả dự án';
$lang_module['bodytext'] = 'Thông tin chi tiết về dự án';
$lang_module['submit'] = 'Đăng ký dự thi';
$lang_module['error_title_project'] = 'Bạn chưa nhập tên dự án dự thi cho dự án %s';
$lang_module['error_catid'] = 'Bạn chưa chọn lĩnh vực dự thi cho dự án %s';
$lang_module['error_objectid'] = 'Bạn chưa chọn đối tượng dự thi cho dự án %s';
$lang_module['project_list'] = 'Danh sách dự án';
$lang_module['edittime'] = 'Cập nhật';
$lang_module['function'] = 'Thao tác';
$lang_module['status'] = 'Trạng thái';
$lang_module['status_project_0'] = 'Đang chờ duyệt';
$lang_module['status_project_1'] = 'Đã đăng';
$lang_module['status_project_2'] = 'Từ chối';
$lang_module['document_file'] = 'Tài liệu';
$lang_module['title_catalog'] = 'Dự án khởi nghiệp';
$lang_module['title'] = 'Tên file';
$lang_module['status_file_0'] = 'Đang kiểm tra';
$lang_module['status_file_1'] = 'Chấp nhận';
$lang_module['status_file_2'] = 'Từ chối file';
$lang_module['image'] = 'Hình ảnh minh họa';

$lang_module['chucvu'] = 'Chức vụ';
$lang_module['donvicongtac'] = 'Đơn vị công tác';

$lang_module['error_fullname_canbo'] = 'Bạn chưa nhập tên của mình';
$lang_module['error_mobile_canbo'] = 'Bạn chưa nhập SĐT của mình';
$lang_module['error_mobile_canbo_format'] = 'SĐT của bạn nhập chưa chính xác! SĐT gồm 10 chữ số bắt đầu bằng sô 0';
$lang_module['error_email_canbo'] = 'Bạn chưa nhập email của mình';
$lang_module['error_mobile_fomart'] = 'Số điện thoại trưởng nhóm dự án %s bạn nhập chưa đúng';
$lang_module['error_note_project'] = 'Phần ý tưởng của dự án %s chưa nhập thông tin';
$lang_module['error_description_project'] = 'Phần mô tả của dự án %s chưa nhập thông tin';
$lang_module['error_file_document_project'] = 'File tài liệu của dự án %s chưa có. Vui lòng tải lên file mô tả dự án';

$lang_module['account_register'] = 'Tài khoản của bạn đã được tạo';
$lang_module['account_register_info'] = 'Xin chào %1$s,<br /><br />Tài khoản của bạn tại website %2$s đã được khởi tạo tự động. Dưới đây là thông tin đăng nhập:<br /><br />Tên tài khoản: %4$s<br /><br />Mật khẩu: %5$s<br /><br />Tài khoản này được tạo để quản lý các dự án dự thi cuộc thi SV Startup.<br /><br />Bạn hãy click vào đường dẫn dưới đây để đăng nhập và đổi mật khẩu:<br />URL: <a href="%3$s">%3$s</a><br /><br />Đây là thư tự động được gửi đến hòm thư điện tử của bạn từ website %2$s. Nếu bạn không hiểu gì về nội dung bức thư này, đơn giản hãy xóa nó đi.<br /><br />Quản trị site';

$lang_module['strength'] = 'Điểm mạnh';
$lang_module['weakness'] = 'Điểm yếu';
$lang_module['opportunity'] = 'Cơ hội';
$lang_module['challenge'] = 'Thách thức';
$lang_module['input_keyword'] = 'Nhập tên hoặc email BGK';
$lang_module['cart_set_ok'] = 'Thêm dự án thành công!';
$lang_module['cart_set_err'] = 'Hệ thống không tìm thấy dự án để thêm!';

$lang_module['title_mail_code'] = '%1$s là mã bình chọn của bạn tại website %2$s';
$lang_module['content_mail_code'] = 'Xin chào %1$s,<br /><br />Bạn nhận được thư này vì email của bạn được sử dụng để tham gia bình chọn dự án tại website %2$s. Dưới đây là mã bình chọn của bạn:<br /><br />Mã số: <strong>%3$s</strong><br /><br />Nếu bạn cho rằng có ai đó đã sử dụng email này mà không được sự cho phép! Bạn chỉ cẩn bỏ qua email này.<br /><br />Xin cảm ơn!';

$lang_module['view'] = 'Xem dự án';
$lang_module['edit'] = 'Cập nhật thông tin';