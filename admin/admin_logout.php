<?php
include_once '../lib/fun.php';
session_start();
//释放admin
unset($_SESSION['admin']);
echo "<script>alert('登出成功');window.location.href='admin_login.php'</script>";