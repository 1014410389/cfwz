<?php
header('Content-Type:application/json; charset=utf-8');
include_once '../lib/fun.php';
$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');

$id_num = $_GET['id_num'];
$ad_num = $_GET['ad_num'];
$name = $_GET['name'];
$table = $_GET['table'];
$exam_id = $_GET['exam_id'];
if ($exam_id == '0101') {
	$sql = "SELECT * FROM `{$table}` a JOIN `user` b ON a.`identity_num` = b.`identity_num` WHERE (a.`identity_num` = '{$id_num}' OR a.`admission_ticket` = '{$ad_num}') AND `exam_id` = '0101'";
} else if ($exam_id == '0102') {
	$sql = "SELECT * FROM `{$table}` a JOIN `user` b ON a.`identity_num` = b.`identity_num` WHERE (a.`identity_num` = '{$id_num}' OR a.`admission_ticket` = '{$ad_num}') AND `exam_id` = '0102'";
}
$obj = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($obj);
if ($result) {
	exit(json_encode($result));
} else {
	exit();
}
?>