<?php
include_once '../lib/fun.php';
$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');

if (isset($_POST['submit']) && !empty($_POST['id_num'])) {
	if ($table == 'cet') {
		$id_num = trim($_POST['id_num']);
		$username = trim($_POST['username']);
		$tel = trim($_POST['tel']);
		$department = trim($_POST['department']);
		$school = trim($_POST['school']);

		$sql = "UPDATE `cet` SET `username` = '{$username}',`cellphone_num` = '{$tel}',`department` = '{$department}',`school` = '{$school}' WHERE `identity_num` = '{$id_num}'";

		$obj = mysqli_query($conn, $sql);
		if ($obj) {
			echo "<script>alert('修改成功');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
		} else {
			echo "<script>alert('修改失败');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
		}
	} else {
		echo "<script>alert('没有表名');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
	}
} else {
	echo "<script>alert('啥玩意啊');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
}

echo '123';
?>
