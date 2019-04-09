<?php
// 开启SESSION
session_start();
if (!empty($_POST['id_num']) && isset($_POST['register'])) {
	// 引入func.php文件
	include_once './lib/fun.php';

	// 进行数据校验
	$id_num = trim($_POST['id_num']);
	$upassword = trim($_POST['password']);
	// 暂时不加密
	// 对密码进行加密处理
	// $upassword = createPassword($upassword);
	$repassword = trim($_POST['repassword']);
	$name = trim($_POST['name']);
	$cellphone_num = trim($_POST['cellphone_num']);
	$department = trim($_POST['department']);
	$school = trim($_POST['school']);
	// 连接数据库
	$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');

	// 验证用户名是否存在
	$sql = "SELECT COUNT(`identity_num`) AS total FROM `user` WHERE `identity_num` = '{$id_num}'";
	$obj = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($obj);
	// 结果集是否存在
	if (isset($result['total']) && $result['total'] > 0) {
		echo '<script>alert("用户已存在，点击确认进入登录界面");location.href="login.php"</script>';
	}
	// 释放连接
	unset($obj, $result, $sql);
	$sql = "INSERT INTO `user` (`identity_num`, `username`, `cellphone_num`,`department`, `school`, `upassword`) VALUES ('{$id_num}', '{$name}', '{$cellphone_num}', '{$department}', '{$school}', '{$upassword}')";
	$obj = mysqli_query($conn, $sql);
	if ($obj) {
		echo '<script>alert("注册成功，点击确认进入登录"); window.location.href="login.php";</script>';
	} else {
		echo '<script>alert("注册失败' . mysqli_error($conn) . '")</script>';
	}
	// 关闭数据库连接
	mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册</title>
	<title>登录</title>
	<link rel="stylesheet" type="text/css" href="./static/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="./static/css/common.css">
</head>
<body>
	<div class="wrap login_wrap">
			<div class="content">
				<div class="register_box">
					<div class="login_form">
						<div class="login_title">
							注册
						</div>
						<form action="register.php" method="post" autocomplete="off" id="register-form">
							<div class="form_input">
								<input name="id_num" type="text" placeholder="身份证号（长度为15或18位的身份证号）" id="id_num" maxlength=18>
							</div>
							<div class="form_input">
								<input name="password" type="text" placeholder="密码（长度不少于6位）" id="password">
							</div>
							<div class="form_input">
								<input name="repassword" type="text" placeholder="重复密码" id="repassword">
							</div>
							<div class="form_input">
								<input name="name" type="text" placeholder="姓名" id="name">
							</div>
							<div class="form_input">
								<input name="cellphone_num" type="text" placeholder="手机号码（选填）" id="phone_num">
							</div>
							<div class="form_input">
								<input name="department" type="text" placeholder="院系（选填）" id="department">
							</div>
							<div class="form_input">
								<input name="school" type="text" placeholder="学校（选填）" list="school" class="school">
								<datalist id="school">
								</datalist>
							</div>
							<div class="form_input">
								<input id="captcha_input" name="captcha" type="text" placeholder="请输入验证码">
								<div id="v_container"></div>
							</div>
							</div>
							<div class="form_btn">
								<input type="submit" name="register" value="注册" id="register">
						</div>
							<div class="form_reg_btn">
								<span>已有帐号？</span><a href="./login.php">马上登录</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="./static/script/jquery-1.10.2.min.js" ></script>
		<script type="text/javascript" src="./static/script/common.js" ></script>
		<script type="text/javascript"  src="./static/script/layer/layer.js" ></script>
		<script type="text/javascript" src="./lib/validate.js"></script>
		<script>
			/**
			 * 学校datalist获取列表
			 */
			var jData,
				strOptions = '',
				xhr = new XMLHttpRequest();		// 创建XHR对象
			xhr.onreadystatechange = function() {
			    if (xhr.readyState == 4 && xhr.status == 200) {
			        var response = xhr.responseText;
			        jData = JSON.parse(response);
			    } else {
			        return false;
			    }
			};
			xhr.open('get', '../school.json', false);
			// 设定响应头部为json
			xhr.setRequestHeader("Content-Type", 'application/json');
			xhr.send(null);
			// 将数据循环输出到html页面上
			for (var i = 0; i < jData.data.length; i++) {
			    strOptions = strOptions + '<option value="' + jData.data[i] + '">' + jData.data[i] + '</option>';
			}
			document.getElementById('school').innerHTML = strOptions;
		</script>
</body>
</html>