<?php
include_once './lib/fun.php';
session_start();
//释放user
unset($_SESSION['user']);
echo "<script>alert('登出成功');window.location.href='index.php'</script>";