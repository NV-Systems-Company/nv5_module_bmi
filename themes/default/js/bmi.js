/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 08 Apr 2014 15:13:43 GMT
 */

function nv_del_project(id) {
    if (confirm(nv_is_del_confirm[0])) {
        $.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=project&nocache=' + new Date().getTime(), 'del=1&id=' + id, function(res) {
            if (res == 'OK') {
                window.location.href = window.location.href;
            } else {
                alert(res);
            }
        });
    }
    return false;
}

function modalShowHtml(id, projectid ) {
    $.ajax({
        type: 'POST',
        cache: !0,
        url: nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=document',
        data: 'getfile=1&id=' + id + '&projectid=' + projectid,
        dataType: 'html',
        success: function(res) {
            modalShow('', res);
        }
    });
}
function modalShowFile(obj) {
    var filetype = $(obj).attr('data-filetype');
    var filename = $(obj).attr('data-file');
    var html = '';
    if( filetype == 'pdf' || filetype == 'mp4' || filetype == 'avi' || filetype == 'flv' || filetype == 'mp3' ){
        html = '<iframe align="middle" frameborder="0" height="500" scrolling="yes" src="' + filename + '" width="100%"></iframe>';
    }else if( filetype == 'jpg' || filetype == 'jpeg' || filetype == 'png' || filetype == 'gif'){
        html = '<img class="img-thumbnail" src="' + filename + '" />';
    }else{
        window.location.href = filename;
    }
    modalShow('', html)
}

function call_set_file(e, obj){
    var fileName = e.target.files[0].name;
    $('#' + $(obj).attr('data-ref')).html( fileName );
}


$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();

    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);

        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}


//according menu

$(document).ready(function()
{
    //Add Inactive Class To All Accordion Headers
    $('.accordion-header').toggleClass('inactive-header');

    //Set The Accordion Content Width
    var contentwidth = $('.accordion-header').width();
    $('.accordion-content').css({});

    //Open The First Accordion Section When Page Loads
    $('.accordion-header').first().toggleClass('active-header').toggleClass('inactive-header');
    $('.accordion-content').first().slideDown().toggleClass('open-content');

    // The Accordion Effect
    $('.accordion-header').click(function () {
        if($(this).is('.inactive-header')) {
            $('.active-header').toggleClass('active-header').toggleClass('inactive-header').next().slideToggle().toggleClass('open-content');
            $(this).toggleClass('active-header').toggleClass('inactive-header');
            $(this).next().slideToggle().toggleClass('open-content');
        }

        else {
            $(this).toggleClass('active-header').toggleClass('inactive-header');
            $(this).next().slideToggle().toggleClass('open-content');
        }
    });

    return false;
});

function nv_add_element( idElment, key, value, roundid, projectid ){
    var html = "<span title=\"" + value + "\" id=\"item_" + key + "_" + projectid + "\" class=\"uiToken removable\" ondblclick=\"remove_item('" + key + "', '" + roundid + "', '" + projectid + "');\">" + value + "<input type=\"hidden\" value=\"" + key + "\" name=\"" + idElment + "[]\" autocomplete=\"off\"><a onclick=\"remove_item('" + key + "', '" + roundid + "', '" + projectid + "');\" href=\"javascript:void(0);\" class=\"remove uiCloseButton uiCloseButtonSmall\"></a></span>";
    $("#" + idElment).append( html );
    return false;
}

function remove_item(userid, roundid, projectid ){
    $.ajax({
        type: 'POST',
        cache: !0,
        url: nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=list',
        data: 'deluser=1&projectid=' + projectid + '&roundid=' + roundid + '&userid=' + userid,
        dataType: 'html',
        success: function(res) {
            $('#item_' + userid + '_' + projectid).remove();
        }
    });
}

$(document).on('keydown', '.search-user', function() {
    // Your code
    var roundid = $(this).attr('data-roundid');
    var projectid = $(this).attr('data-projectid');
    $(this).autocomplete({
        source : function(request, response) {
            $.getJSON(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + "=searchajax", {
                term : extractLast(request.term),
                objectid : roundid
            }, response);
        },
        search : function() {
            // custom minLength
            var term = extractLast(this.value);
            if (term.length < 2) {
                return false;
            }
        },
        focus : function() {
            //no action
        },
        select : function(event, ui) {
            // add placeholder to get the comma-and-space at the end
            nv_add_element( 'users_' + projectid, ui.item.key, ui.item.fullname, roundid, projectid );
            nv_update_user( roundid, projectid, ui.item.key );
            $(this).val('');

            return false;
        }
    })
});

function nv_update_user( roundid, projectid, userid ) {
    $.ajax({
        type: 'POST',
        cache: !0,
        url: nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=list',
        data: 'saveu=1&projectid=' + projectid + '&roundid=' + roundid + '&userid=' + userid,
        dataType: 'html',
        success: function(res) {
            //
        }
    });
}
function review_submit(a){
    $.ajax({
        type: $(a).prop("method"),
        cache: !1,
        url: $(a).prop("action"),
        data: $(a).serialize() + '&save=1',
        dataType: 'json',
        success: function(res) {
            if(res.status==1){
                alert(res.mess);
                window.location.href = nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=list';
            }else{
                alert(res.mess);
            }
        }
    });
    return false;
}

function review_submit_guest(a, total_review){
    var html_p_o = html_p_n = '';
    var stt_o = stt_n = 0;
    $('.check_score').each(function(){
        var score = $(this).html();

       if( score > 0 ){
           stt_o++;
           html_p_o += '<br>' + stt_o + '. ' + $(this).attr('data-title');
       }else{
           stt_n++;
           html_p_n +=  '<br>' + stt_n + '. ' + $(this).attr('data-title');
       }

    });
    $('#show_result_ok,#show_result').html('').removeClass('alert alert-success');
    if( html_p_o != '' ){
        $('#show_result_ok').addClass('alert alert-success').html('Dự án đã cho điểm: <strong>' + html_p_o + '</strong>');
    }
    if( html_p_n != '' ){
        $('#show_result').addClass('alert alert-danger').html('Dự án chưa cho điểm: <strong>' + html_p_n + '</strong>');
        return false;
    }
    $fullname = $('input[name=fullname]').val();
    $email = $('input[name=email]').val();
    $phone = $('input[name=phone]').val();
    if($fullname == ''){
        $('input[name=fullname]').focus();
        return false;
    }else if($email == ''){
        $('input[name=email]').focus();
        return false;
    }else if($phone == ''){
        $('input[name=phone]').focus();
        return false;
    }

    $('input[name=submitreview]').hide();
    $('#result_request').html('<img src="' + nv_base_siteurl + 'assets/images/load_bar.gif"> Vui lòng chờ...');
    $.ajax({
        type: $(a).prop("method"),
        cache: !1,
        url: $(a).prop("action"),
        data: $(a).serialize() + '&save=1',
        dataType: 'json',
        success: function(res) {
            if(res.status==1){
                $('#result_request').html(res.mess).removeClass('alert alert-danger').addClass('alert alert-success');
                $('#step1').hide();
                $('#step2').show();
                $('#get_code').hide();
                nv_svs_countdown_mail( 30 );//dem nguoc giay de yeu cau nhan mail tiep theo
                $('input[name=submitreview]').attr('name', 'Gửi đánh giá').show();
            }else if(res.status=='ok'){
                $('#result_request').html(res.mess).removeClass('alert alert-danger').addClass('alert alert-success');
                //load lai trang sau 3s
                setTimeout(function(){
                    window.location.href = nv_base_siteurl;
                }, 3000);

            }else if(res.status=='error'){
                $('#result_request').html(res.mess).removeClass('alert alert-success').addClass('alert alert-danger');
                $('input[name=submitreview]').attr('name', 'Gửi đánh giá').show();
            }else{
                $('#step2').hide();
                $('#step1').show();
                $('input[name=submitreview]').attr('name', 'Đánh giá').show();
                $('#result_request').html(res.mess).removeClass('alert alert-success').addClass('alert alert-danger');
            }
        }
    });
    return false;
}
function nv_get_code() {
    $('#step2').hide();
    $('#step1').show();
    $('#result_request').html('');
}
function cartorder(a_ob) {
    var id = $(a_ob).attr("id");
    $.ajax({
        type: "GET",
        url: nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=setcart' + '&id=' + id + "&nocache=" + new Date().getTime(),
        data: '',
        success: function (data) {
            var s = data.split('_');
            var strText = s[1];
            if (strText != null) {
                var intIndexOfMatch = strText.indexOf('#@#');
                while (intIndexOfMatch != -1) {
                    strText = strText.replace('#@#', '_');
                    intIndexOfMatch = strText.indexOf('#@#');
                }
                alert_msg(strText);
                linkloadcart = nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=loadcart';
                $("#cart_" + nv_module_name).load(linkloadcart);
                setTimeout(function(){
                    window.location.href = nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=cart';
                }, 3000);
            }
        }
    });

}

function remove_cart( href ) {
    var urload = nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=loadcart';
    $.ajax({
        type : "GET",
        url : href,
        data : '',
        success : function(data) {
            if (data != '') {
                $("#" + data).html('');
                $("#cart_" + nv_module_name).load(urload);
                $("#total").load(urload + '&t=2');
            }
        }
    });
    return false;
}

function alert_msg(msg) {
    $('#msgshow').html(msg);
    $('#msgshow').show('slide').delay(3000).hide('slow');
}

function change_score_guest(idobj) {
    $total_score = 0;
    $( ".score_value" + idobj ).each(function( index ) {
        $total_score = $total_score + parseInt( $("option:selected", this).val() );
    });
    $('#total_score' + idobj).html($total_score);
}


function review_submit_hoitruong(a, total_review){

    $fullname = $('input[name=fullname]').val();
    $email = $('input[name=email]').val();
    $phone = $('input[name=phone]').val();
    $code = $('input[name=code]').val();
    if($fullname == ''){
        $('input[name=fullname]').focus();
        return false;
    }else if($code == ''){
        $('input[name=code]').focus();
        return false;
    }

    $('input[name=submitreview]').hide();
    $('#result_request').html('<img src="' + nv_base_siteurl + 'assets/images/load_bar.gif"> Vui lòng chờ...');
    $.ajax({
        type: $(a).prop("method"),
        cache: !1,
        url: $(a).prop("action"),
        data: $(a).serialize() + '&save=1',
        dataType: 'json',
        success: function(res) {
            if(res.status==1){
                $('#result_request').html(res.mess).removeClass('alert alert-danger').addClass('alert alert-success');
                setTimeout(function(){
                    window.location.href = window.location.href;
                }, 3000);
            }else if(res.status=='error'){
                $('input[name=submitreview]').attr('name', 'Tham gia đánh giá').show();
                $('#result_request').html(res.mess).removeClass('alert alert-success').addClass('alert alert-danger');
            }else{
                $('input[name=submitreview]').attr('name', 'Tham gia đánh giá').show();
                $('#result_request').html(res.mess).removeClass('alert alert-success').addClass('alert alert-danger');
            }
        }
    });
    return false;
}
function load_project() {
    $.ajax({
        type: 'POST',
        cache: !1,
        url: nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=vck',
        data: 'loadproject=1',
        dataType: 'json',
        success: function(res) {
            if(res.status==1){
                //Co du an binh chon thi
                $('#show_data').html(res.html);
                $('#waitting_review').hide();
                //load lai sau 30s de dam bao khong bi luu trang
                setTimeout(function(){
                    load_project()
                }, 30000);
            }else if(res.status == 0){
                $('#show_data').html('');
                $('#waitting_review').show();
                setTimeout(function(){
                    load_project()
                }, 5000);
            }
        }
    });
}

function send_reivew_data(score, projectid) {
    if(confirm('Bạn có chắc muốn cho ' + score + ' điểm?' )){
        $.ajax({
            type: 'POST',
            cache: !1,
            url: nv_base_siteurl + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=vck&nocache=' + new Date().getTime(),
            data: 'score=1&score=' + score + '&projectid=' + projectid,
            dataType: 'json',
            success: function(res) {
                if(res.status=='ok'){
                    $('#result_show').removeClass('alert alert-danger').addClass('alert alert-success').html(res.mess);
                    setTimeout(function(){
                        load_project()
                    }, 10000);//load lai project sau 10 giay
                }else{
                    $('#result_show').removeClass('alert alert-success').addClass('alert alert-danger').html(res.mess);
                    setTimeout(function(){
                        load_project()
                    }, 5000);
                }
            }
        });
        return;
    }
}

function nv_load_score(projectid) {
    $.ajax({
        type: 'POST',
        cache: !1,
        url: nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=vck',
        data: 'getscore=1&projectid=' + projectid,
        dataType: 'json',
        success: function(res) {
            if(res.status==1){
                $("#pageLoad").animateNumbers(res.score, true, 2000);
                $('#timer').html(' điểm');
            }else{
                setTimeout(function(){
                    nv_load_score(projectid);
                }, 3000);
            }
        }
    });
}

function nv_svs_countdown_mail( counter ) {
    $('#box_get_mail').show();
    var interval = setInterval(function() {
        counter--;
        if (counter <= 0) {
            clearInterval(interval);
            $('#get_code').show();
            $('#box_get_mail').hide();
            return;
        }else{
            $('#time').text(counter);
        }
    }, 1000);
}