$(function() {
    // 登录按钮事件
    $('#add_form').submit(function() {
        var $table_name = $('#add_form').attr('name');
        if ($table_name == 'user') {
            var $id_num = $('#id_num').val(),
                $username = $('#username').val(),
                $upassword = $('#upassword').val(),
                reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
            // 身份证非空验证和格式验证
            if ($id_num == null || $id_num == '') {
                layer.tips('身份证号不能为空', '#id_num', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#id_num').focus();
                return false;
            } else if (reg.test($id_num) === false) {
                layer.tips('身份证格式错误', '#id_num', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#id_num').focus();
                return false;
            }
            // 用户名非空验证
            if ($username == '' || $username.length <= 0) {
                layer.tips('用户名不能为空', '#username', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#username').focus();
                return false;
            }
            // 密码非空验证
            if ($upassword == '' || $upassword.length <= 0) {
                layer.tips('密码不能为空', '#upassword', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#upassword').focus();
                return false;
            }
            return true;
        } else if ($table_name == 'cet') {
            var $exam_id = $('#exam_id').val(),
                $transcript_id = $('#transcript_id').val(),
                $listening = $('#listening').val(),
                $reading = $('#reading').val(),
                $comprehensive = $('#comprehensive').val(),
                $writing = $('#writing').val(),
                $admission_ticket = $('#admission_ticket').val(),
                $identity_num = $('#identity_num').val(),
                $exam_date = $('#exam_date').val(),
                reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
            if ($exam_id == '' || $exam_id.length <= 0) {
                layer.tips('考试代号不能为空', '#exam_id', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#exam_id').focus();
                return false;
            }
            if ($transcript_id == '' || $transcript_id.length <= 0) {
                layer.tips('成绩单号不能为空', '#transcript_id', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#transcript_id').focus();
                return false;
            }
            if ($listening == '' || $listening.length <= 0) {
                layer.tips('听力成绩不能为空', '#listening', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#listening').focus();
                return false;
            }
            if ($reading == '' || $reading.length <= 0) {
                layer.tips('阅读成绩不能为空', '#reading', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#reading').focus();
                return false;
            }
            if ($comprehensive == '' || $comprehensive.length <= 0) {
                layer.tips('综合成绩不能为空', '#comprehensive', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#comprehensive').focus();
                return false;
            }
            if ($writing == '' || $writing.length <= 0) {
                layer.tips('写作和翻译不能为空', '#writing', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#writing').focus();
                return false;
            }
            if ($admission_ticket == '' || $admission_ticket.length <= 0) {
                layer.tips('准考证号不能为空', '#admission_ticket', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#admission_ticket').focus();
                return false;
            }
            if ($identity_num == '' || $identity_num.length <= 0) {
                layer.tips('身份证号不能为空', '#identity_num', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#identity_num').focus();
                return false;
            } else if (reg.test($identity_num) === false) {
                layer.tips('身份证格式错误', '#identity_num', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#identity_num').focus();
                return false;
            }
            if ($exam_date == '' || $exam_date.length <= 0) {
                layer.tips('考试日期不能为空', '#exam_date', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#exam_date').focus();
                return false;
            }
            return true;
        } else if ($table_name == 'administrator') {
            var $admin_id = $('#admin_id').val(),
                $password = $('#password').val();
            if ($admin_id == '' || $admin_id.length <= 0) {
                layer.tips('管理员号不能为空', '#admin_id', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#admin_id').focus();
                return false;
            }
            if ($password == '' || $password.length <= 0) {
                layer.tips('密码不能为空', '#password', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#password').focus();
                return false;
            }
            return true;
        } else if ($table_name == 'examination') {
            var $exam_id = $('#exam_id').val(),
                $exam_name = $('#exam_name').val();
            if ($exam_id == '' || $exam_id.length <= 0) {
                layer.tips('考试代号不能为空', '#exam_id', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#exam_id').focus();
                return false;
            }
            if ($exam_name == '' || $exam_name.length <= 0) {
                layer.tips('考试名称不能为空', '#exam_name', { time: 2000, tips: [2, '#CB5B5B'] });
                $('#exam_name').focus();
                return false;
            }
            return true;
        }
    });
});