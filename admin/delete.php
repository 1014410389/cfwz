<?php
include_once '../lib/fun.php';

$table = $_GET['table'];
$pk = $_GET['pk'];
$value = $_GET['value'];

$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');
$sql = "DELETE FROM `{$table}` WHERE `{$pk}` = '{$value}'";
$obj = mysqli_query($conn, $sql);
if ($obj) {
	echo "<script>alert('删除成功');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
} else {
	echo "<script>alert('删除失败');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
}

?>