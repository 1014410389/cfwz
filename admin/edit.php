<?php
include_once '../lib/fun.php';

$isEdited = $_GET['isEdited'] ? $_GET['isEdited'] : null;
$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');

if (empty($isEdited)) {
	$table = $_GET['table'];
	$pk = $_GET['pk'];
	$value = $_GET['value'];

	$sql = "SELECT * FROM `{$table}` WHERE `{$pk}` = '{$value}'";
	$obj = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($obj);
	$array = $result;
	unset($sql, $obj, $result);
}

if (isset($_POST['submit']) && $isEdited == 1) {
	if ($_GET['table'] == 'user') {
		$id_num = trim($_POST['id_num']);
		$username = trim($_POST['username']);
		$tel = trim($_POST['tel']);
		$department = trim($_POST['department']);
		$school = trim($_POST['school']);

		$sql = "UPDATE `user` SET `username` = '{$username}',`cellphone_num` = '{$tel}',`department` = '{$department}',`school` = '{$school}' WHERE `identity_num` = '{$id_num}'";

		echo $sql;
		$obj = mysqli_query($conn, $sql);
		if ($obj) {
			unset($conn, $sql, $obj);
			echo "<script>alert('修改成功');location.href='admin_index.php?table=user&pk=identity_num';</script>";
		} else {
			echo "<script>alert('修改失败');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
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

		$sql = "UPDATE `cet` SET `exam_id` = '{$exam_id}',`transcript_id` = '{$transcript_id}',`listening` = '{$listening}',`reading` = '{$reading}',`comprehensive` = '{$comprehensive}',`writing` = '{$writing}',`identity_num` = '{$identity_num}',`exam_date` = '{$exam_date}' WHERE `admission_ticket` = '{$admission_ticket}'";

		$obj = mysqli_query($conn, $sql);
		if ($obj) {
			unset($conn, $sql, $obj);
			echo "<script>alert('修改成功');location.href='admin_index.php?table=cet&pk=admission_ticket&exam_id=0101';</script>";
		} else {
			echo "<script>alert('修改失败');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
		}
	} elseif ($_GET['table'] == 'examination') {
		$exam_id = trim($_POST['exam_id']);
		$exam_name = trim($_POST['exam_name']);
		$exam_type = trim($_POST['exam_type']);

		$sql = "UPDATE `examination` SET `exam_name` = '{$exam_name}',`exam_type` = '{$exam_type}' WHERE `exam_id` = '{$exam_id}'";

		$obj = mysqli_query($conn, $sql);
		if ($obj) {
			unset($conn, $sql, $obj);
			echo "<script>alert('修改成功');location.href='admin_index.php?table=examination&pk=exam_id';</script>";
		} else {
			echo "<script>alert('修改失败');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
		}
	} elseif ($_GET['table'] == 'administrator') {
		$admin_id = trim($_POST['admin_id']);
		$admin_name = trim($_POST['admin_name']);

		$sql = "UPDATE `administrator` SET `admin_name` = '{$admin_name}' WHERE `admin_id` = '{$admin_id}'";

		$obj = mysqli_query($conn, $sql);
		if ($obj) {
			unset($conn, $sql, $obj);
			echo "<script>alert('修改成功');location.href='admin_index.php?table=administrator&pk=admin_id';</script>";
		} else {
			echo "<script>alert('修改失败');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
		}
	}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑</title>
	<link rel="stylesheet" type="text/css" href="../static/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="./static/css/admin_index.css">
	<link rel="stylesheet" type="text/css" href="./static/css/edit.css">
</head>
<body>
	<header id="header">
		<img src="../static/image/logo.png"><h1>管理员页</h1>
	</header>
	<nav id="nav">
		<!-- <ul>
			<li>当前位置：</li>
			<li><a href="#" title="">首页></a></li>
			<li><a href="#" title="">CET表></a></li>
			<li><a href="#" title="">个人成绩></a></li>
		</ul> -->
	</nav>
	<content id="content">
		<div id="main_edit">
			<?php if ($table == 'user'): ?>
			<form action="edit.php?isEdited=1&table=user" method="post" autocomplete="off" id="feedback-form">
				<table class="feedback_table">
					<tbody>
						<tr>
							<td class="first_line">身份证号</td>
							<td><input type="text" name="id_num" id="id_num" value='<?php echo $array['identity_num'] ?>' readonly="readonly"></td>
						</tr>
						<tr>
							<td class="first_line">姓名</td>
							<td><input type="text" name="username" id="username"  value='<?php echo $array['username'] ?>'></td>
						</tr>
						<tr>
							<td class="first_line">手机号码</td>
							<td><input type="text" name="tel" id="tel" value='<?php echo $array['cellphone_num'] ?>'></td>
						</tr>
						<tr>
							<td class="first_line">院系</td>
							<td><input type="text" name="department" id="department" value='<?php echo $array['department'] ?>'></td>
						</tr>
						<tr>
							<td class="first_line">学校</td>
							<td><input type="text" name="school" id="school" value='<?php echo $array['school'] ?>'></td>
						</tr>
						<tr>
							<td><input type="hidden" name="token" value="<?php echo $token; ?>" /></td>
							<td><input type="submit" id="submit_btn" name="submit" value="提交">
						</tr>
					</tbody>
				</table>
			</form>
			<?php elseif ($table == 'cet'): ?>
			<form action="edit.php?isEdited=1&table=cet" method="post" autocomplete="off" id="feedback-form">
				<table class="feedback_table">
					<tbody>
						<tr>
							<td class="first_line">考试代号</td>
							<td><input type="text" name="exam_id" id="exam_id" value='<?php echo $array['exam_id'] ?>'></td>
						</tr>
						<tr>
							<td class="first_line">成绩单号</td>
							<td><input type="text" name="transcript_id" id="transcript_id"  value='<?php echo $array['transcript_id'] ?>'></td>
						</tr>
						<tr>
							<td class="first_line">听力成绩</td>
							<td><input type="text" name="listening" id="listening" value='<?php echo $array['listening'] ?>'></td>
						</tr>
						<tr>
							<td class="first_line">阅读成绩</td>
							<td><input type="text" name="reading" id="reading" value='<?php echo $array['reading'] ?>'></td>
						</tr>
						<tr>
							<td class="first_line">综合成绩</td>
							<td><input type="text" name="comprehensive" id="comprehensive" value='<?php echo $array['comprehensive'] ?>'></td>
						</tr>
						<tr>
							<td class="first_line">写作和阅读</td>
							<td><input type="text" name="writing" id="writing" value='<?php echo $array['writing'] ?>'></td>
						</tr>
						<tr>
							<td class="first_line">准考证号</td>
							<td><input type="text" name="admission_ticket" id="admission_ticket" value='<?php echo $array['admission_ticket'] ?>'></td>
						</tr>
						<tr>
							<td class="first_line">身份证号</td>
							<td><input type="text" name="identity_num" id="identity_num" value='<?php echo $array['identity_num'] ?>'></td>
						</tr>
						<tr>
							<td class="first_line">考试日期</td>
							<td><input type="text" name="exam_date" id="exam_date" value='<?php echo $array['exam_date'] ?>'></td>
						</tr>
						<tr>
							<td><input type="hidden" name="token" value="<?php echo $token; ?>" /></td>
							<td><input type="submit" id="submit_btn" name="submit" value="提交">
						</tr>
					</tbody>
				</table>
			</form>
			<?php elseif ($table == 'examination'): ?>
			<form action="edit.php?isEdited=1&table=examination" method="post" autocomplete="off" id="feedback-form">
				<table class="feedback_table">
					<tbody>
						<tr>
							<td class="first_line">考试代号</td>
							<td><input type="text" name="exam_id" id="exam_id" value='<?php echo $array['exam_id'] ?>'></td>
						</tr>
						<tr>
							<td class="first_line">考试名称</td>
							<td><input type="text" name="exam_name" id="exam_name"  value='<?php echo $array['exam_name'] ?>'></td>
						</tr>
						<tr>
							<td class="first_line">考试类型</td>
							<td><input type="text" name="exam_type" id="exam_type" value='<?php echo $array['exam_type'] ?>'></td>
						</tr>
						<tr>
							<td><input type="hidden" name="token" value="<?php echo $token; ?>" /></td>
							<td><input type="submit" id="submit_btn" name="submit" value="提交">
						</tr>
					</tbody>
				</table>
			</form>
			<?php elseif ($table == 'administrator'): ?>
			<form action="edit.php?isEdited=1&table=administrator" method="post" autocomplete="off" id="feedback-form">
				<table class="feedback_table">
					<tbody>
						<tr>
							<td class="first_line">管理员号</td>
							<td><input type="text" name="admin_id" id="admin_id" value='<?php echo $array['admin_id'] ?>'></td>
						</tr>
						<tr>
							<td class="first_line">管理员姓名</td>
							<td><input type="text" name="admin_name" id="admin_name"  value='<?php echo $array['admin_name'] ?>'></td>
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