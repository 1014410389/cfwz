<?php
include_once '../lib/fun.php';

$option = $_GET['option'];
$table = $_GET['table'];
if ($table == 'cet') {
	$exam_id = $_GET['exam_id'];
}
$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');

if (isset($_POST['submit'])) {
	if ($_GET['table'] == 'user') {
		$id_num = trim($_POST['id_num']);
		$username = trim($_POST['username']);
		$tel = trim($_POST['tel']);
		$department = trim($_POST['department']);
		$school = trim($_POST['school']);
		$upassword = trim($_POST['upassword']);

		$sql = "INSERT INTO `user`(`identity_num`, `username`, `cellphone_num`, `department`, `school`, `upassword`) VALUES ('{$id_num}','{$username}','{$tel}','{$department}','{$school}','{$upassword}')";
		$obj = mysqli_query($conn, $sql);
		if ($obj) {
			unset($conn, $sql, $obj);
			echo "<script>alert('添加成功');location.href='admin_index.php?table=user&pk=identity_num';</script>";
		} else {
			echo "<script>alert('添加失败');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
		}
	} elseif ($_GET['table'] == 'cet') {
		$exam_id = trim($_POST['exam_id']);
		$transcript_id = trim($_POST['transcript_id']);
		$listening = trim($_POST['listening']);
		$reading = trim($_POST['reading']);
		$comprehensive = trim($_POST['comprehensive']);
		$writing = trim($_POST['writing']);
		$admission_ticket = trim($_POST['admission_ticket']);
		$identity_num = trim($_POST['identity_num']);
		$exam_date = trim($_POST['exam_date']);

		$sql = "INSERT INTO `cet`(`exam_id`, `transcript_id`, `listening`, `reading`, `comprehensive`, `writing`, `admission_ticket`, `identity_num`, `exam_date`) VALUES ('{$exam_id}','{$transcript_id}','{$listening}','{$reading}','{$comprehensive}','{$writing}','{$admission_ticket}','{$identity_num}','{$exam_date}')";
		$obj = mysqli_query($conn, $sql);
		if ($obj) {
			unset($conn, $sql, $obj);
			echo "<script>alert('添加成功');location.href='admin_index.php?table=cet&pk=admission_ticket&exam_id=0101';</script>";
		} else {
			echo "<script>alert('添加失败');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
		}
	} elseif ($_GET['table'] == 'examination') {
		$exam_id = trim($_POST['exam_id']);
		$exam_name = trim($_POST['exam_name']);
		$exam_type = trim($_POST['exam_type']);

		$sql = "INSERT INTO `examination`(`exam_id`, `exam_name`, `exam_type`) VALUES ('{$exam_id}','{$exam_name}','{$exam_type}')";

		$obj = mysqli_query($conn, $sql);
		if ($obj) {
			unset($conn, $sql, $obj);
			echo "<script>alert('添加成功');location.href='admin_index.php?table=examination&pk=exam_id';</script>";
		} else {
			echo "<script>alert('添加失败');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
		}
	} elseif ($_GET['table'] == 'administrator') {
		$admin_id = trim($_POST['admin_id']);
		$admin_name = trim($_POST['admin_name']);
		$password = trim($_POST['password']);

		$sql = "INSERT INTO `administrator`(`admin_id`, `admin_name`, `password`) VALUES ('{$admin_id}','{$admin_name}','{$password}')";

		$obj = mysqli_query($conn, $sql);
		if ($obj) {
			unset($conn, $sql, $obj);
			echo "<script>alert('添加成功');location.href='admin_index.php?table=administrator&pk=admin_id';</script>";
		} else {
			echo "<script>alert('添加失败');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
		}
	}
	mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $option ?></title>
	<link rel="stylesheet" type="text/css" href="../static/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="./static/css/admin_index.css">
	<link rel="stylesheet" type="text/css" href="./static/css/edit.css">
</head>
<body>
	<header id="header">
		<img src="../static/image/logo.png"><h1>管理员页</h1>
	</header>
	<nav id="nav">
<!-- 		<ul>
			<li>当前位置：</li>
			<li><a href="#" title="">首页></a></li>
			<li><a href="#" title="">CET表></a></li>
			<li><a href="#" title="">个人成绩></a></li>
		</ul> -->
	</nav>
	<content id="content">
		<div id="main_edit">
			<?php if ($table == 'user'): ?>
			<form action="add.php?table=user" method="post" autocomplete="off" id="feedback-form">
				<table class="feedback_table">
					<tbody>
						<tr>
							<td class="first_line">身份证号</td>
							<td><input type="text" name="id_num" id="id_num"></td>
						</tr>
						<tr>
							<td class="first_line">姓名</td>
							<td><input type="text" name="username" id="username"></td>
						</tr>
						<tr>
							<td class="first_line">手机号码</td>
							<td><input type="text" name="tel" id="tel"></td>
						</tr>
						<tr>
							<td class="first_line">院系</td>
							<td><input type="text" name="department" id="department"></td>
						</tr>
						<tr>
							<td class="first_line">学校</td>
							<td><input type="text" name="school" id="school"></td>
						</tr>
						<tr>
							<td class="first_line">密码</td>
							<td><input type="text" name="upassword" id="upassword"></td>
						</tr>
						<tr>
							<td><input type="hidden" name="token" value="<?php echo $token; ?>" /></td>
							<td><input type="submit" id="submit_btn" name="submit" value="提交">
						</tr>
					</tbody>
				</table>
			</form>
			<?php elseif ($table == 'cet'): ?>
			<form action="add.php?table=cet" method="post" autocomplete="off" id="feedback-form">
				<table class="feedback_table">
					<tbody>
						<tr>
							<td class="first_line">考试代号</td>
							<td><input type="text" name="exam_id" id="exam_id"></td>
						</tr>
						<tr>
							<td class="first_line">成绩单号</td>
							<td><input type="text" name="transcript_id" id="transcript_id"></td>
						</tr>
						<tr>
							<td class="first_line">听力成绩</td>
							<td><input type="text" name="listening" id="listening"></td>
						</tr>
						<tr>
							<td class="first_line">阅读成绩</td>
							<td><input type="text" name="reading" id="reading"></td>
						</tr>
						<tr>
							<td class="first_line">综合成绩</td>
							<td><input type="text" name="comprehensive" id="comprehensive"></td>
						</tr>
						<tr>
							<td class="first_line">写作和阅读</td>
							<td><input type="text" name="writing" id="writing"></td>
						</tr>
						<tr>
							<td class="first_line">准考证号</td>
							<td><input type="text" name="admission_ticket" id="admission_ticket"></td>
						</tr>
						<tr>
							<td class="first_line">身份证号</td>
							<td><input type="text" name="identity_num" id="identity_num"></td>
						</tr>
						<tr>
							<td class="first_line">考试日期</td>
							<td><input type="text" name="exam_date" id="exam_date"></td>
						</tr>
						<tr>
							<td><input type="hidden" name="token" value="<?php echo $token; ?>" /></td>
							<td><input type="submit" id="submit_btn" name="submit" value="提交">
						</tr>
					</tbody>
				</table>
			</form>
			<?php elseif ($table == 'examination'): ?>
			<form action="add.php?table=examination" method="post" autocomplete="off" id="feedback-form">
				<table class="feedback_table">
					<tbody>
						<tr>
							<td class="first_line">考试代号</td>
							<td><input type="text" name="exam_id" id="exam_id"></td>
						</tr>
						<tr>
							<td class="first_line">考试名称</td>
							<td><input type="text" name="exam_name" id="exam_name"></td>
						</tr>
						<tr>
							<td class="first_line">考试类型</td>
							<td><input type="text" name="exam_type" id="exam_type"></td>
						</tr>
						<tr>
							<td><input type="hidden" name="token" value="<?php echo $token; ?>" /></td>
							<td><input type="submit" id="submit_btn" name="submit" value="提交">
						</tr>
					</tbody>
				</table>
			</form>
			<?php elseif ($table == 'administrator'): ?>
			<form action="add.php?table=administrator" method="post" autocomplete="off" id="feedback-form">
				<table class="feedback_table">
					<tbody>
						<tr>
							<td class="first_line">管理员号</td>
							<td><input type="text" name="admin_id" id="admin_id"></td>
						</tr>
						<tr>
							<td class="first_line">管理员姓名</td>
							<td><input type="text" name="admin_name" id="admin_name"></td>
						</tr>
						<tr>
							<td class="first_line">密码</td>
							<td><input type="text" name="password" id="password"></td>
						</tr>
						<tr>
							<td><input type="hidden" name="token" value="<?php echo $token; ?>" /></td>
							<td><input type="submit" id="submit_btn" name="submit" value="提交">
						</tr>
					</tbody>
				</table>
			</form>
			<?php endif;?>
		</div>
	</content>
</body>
</html>