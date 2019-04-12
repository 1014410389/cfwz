<?php
// 引入fun.php文件
include_once '../lib/fun.php';

// 从url获取参数
$table = $_GET['table'];
$pk = $_GET['pk'];
$value = $_GET['value'];

// 连接数据库
$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');
$sql = "DELETE FROM `{$table}` WHERE `{$pk}` = '{$value}'";
$obj = mysqli_query($conn, $sql);
if ($obj) {
	echo "<script>alert('删除成功');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
} else {
	echo "<script>alert('删除失败');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
}

?>