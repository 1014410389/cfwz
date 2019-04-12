<?php
//引入fun.php文件
include_once '../lib/fun.php';
// 开启SESSION
session_start();
// 点击登录按钮
if (!empty($_POST['admin_id']) && isset($_POST['login'])) {
	// 进行数据校验
	$admin_id = trim($_POST['admin_id']);
	$password = trim($_POST['password']);
	// 连接数据库
	$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');
	$sql = "SELECT * FROM `administrator` WHERE `admin_id` = '{$admin_id}' LIMIT 1";
	$obj = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($obj);
	// 判断结果集是否存在
	if (is_array($result) && !empty($result)) {
		if ($password === $result['password']) {
			$_SESSION['admin'] = $result;
			echo "<script>alert('登录成功');window.location.href='admin_index.php'</script>";
		} else {
			echo "<script>alert('密码错误');history.go(-1);</script>";
		}
	} else {
		echo "<script>alert('用户不存在')</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理员登录</title>
	<link rel="stylesheet" type="text/css" href="../static/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="../static/css/common.css">
</head>
<body>
	<div class="wrap login_wrap">
		<div class="content">
			<div class="login_box"  style="height: 350px">
				<div class="login_form">
					<div class="login_title">
						管理员登录
					</div>
					<form action="./admin_login.php" method="post" id="admin-login-form">
						<div class="form_input">
							<input name="admin_id" id="admin_id" type="text" placeholder="请输入管理员号">
						</div>
						<div class="form_input">
							<input name="password" id="password" type="password" placeholder="请输入密码">
						</div>
						<div class="form_input">
							<input id="captcha_input" name="captcha" type="text" placeholder="请输入验证码">
							<div id="v_container"></div>
						</div>
						<div class="form_btn">
							<input id="submit" type="submit" name="login" value="登录">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../static/script/jquery-1.10.2.min.js" ></script>
	<script type="text/javascript"  src="../static/script/layer/layer.js"></script>
	<script type="text/javascript" src="../lib/validate.js"></script>
	</body>
</html>