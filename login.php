<?php
//引入fun.php文件
include_once './lib/fun.php';
// 开启SESSION
session_start();
// 判断用户是否登录，是则跳过登录页面，直接进入主页
if (checkLogin()) {
	echo "<script>alert('你已经登录，即将进入主页'); location.href='index.php';</script>";
}
// 连接数据库
$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');

// 点击登录按钮
if (!empty($_POST['id_num']) && isset($_POST['login'])) {
	// 进行数据校验
	$id_num = trim($_POST['id_num']);
	$id_num = check_input($id_num);
	$password = trim($_POST['password']);
	$password = check_input($password);
	// $autologin = $_POST['autologin'];
	$sql = "SELECT * FROM `user` WHERE `identity_num` = '{$id_num}' LIMIT 1";
	$obj = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($obj);
	// 判断结果集是否存在
	if (is_array($result) && !empty($result)) {
		// 暂时不验证加密密码
		// if (createPassword($password) === $result['upassword']) {
		if ($password === $result['upassword']) {
			// if (!empty($autologin)) {
			//如果用户选择了，记录登录状态就把用户名和加了密的密码放到cookie里面
			// 	setcookie("id_num", $id_num, time() + 60);
			// 	setcookie("password", $password, time() + 60);
			// }
			// $_SESSION['name'] = $result['username'];
			// $_SESSION['school'] = $result['school'];
			// $_SESSION['id_num'] = $result['identity_num'];

			// 将用户信息存入SESSION中
			$_SESSION['user'] = $result;
			echo "<script>alert('登录成功');window.location.href='index.php'</script>";
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
	<title>登录</title>
	<link rel="stylesheet" type="text/css" href="./static/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="./static/css/common.css">
</head>
<body>
	<div class="wrap login_wrap">
		<div class="content">
			<div class="login_box">
				<div class="login_form">
					<div class="login_title">
						登录
					</div>
					<form action="./login.php" method="post" id="login-form">
						<div class="form_input">
							<input name="id_num" id="id_num" type="text" placeholder="请输入身份证号">
						</div>
						<div class="form_input">
							<input name="password" id="password" type="password" placeholder="请输入密码">
						</div>
						<div class="form_input">
							<input id="captcha_input" name="captcha" type="text" placeholder="请输入验证码">
							<div id="v_container"></div>
						</div>
						<div class="form_checkbox">
							<!-- <div class="left check_left">
								`div> -->
						</div>
						<div class="form_btn">
							<input id="submit" type="submit" name="login" value="登录">
						</div>
						<div class="form_reg_btn">
							<span>还没有帐号？</span><a href="./register.php">马上注册</a><a href="./index.php" title="稍后登录" style="float: right;">稍后登录</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="./static/script/jquery-1.10.2.min.js" ></script>
	<script type="text/javascript"  src="./static/script/layer/layer.js" ></script>
	<script type="text/javascript" src="./static/script/layer.js"></script>
	<script type="text/javascript" src="./lib/validate.js"></script>
	</body>
</html>