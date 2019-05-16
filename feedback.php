<?php
// 引入fun.php文件
include_once './lib/fun.php';
// 开启SESSION
session_start();
// 设置token值，防止用户刷新重复提交数据
$token = mt_rand(0, 1000000);
$_SESSION['token'] = $token;
if ($_SESSION["token"] != $token) {
	// 不让重复提交，在此处理
	header("location:" . $_SERVER['PHP_SELF']);
} else {
	// 正常的表单提交，在此处理
	if (!empty($_POST['feedback'])) {
		$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');
		$username = trim($_POST['username']);
		$qq = trim($_POST['qq']);
		$tel = trim($_POST['tel']);
		$email = trim($_POST['email']);
		$feedback = trim($_POST['feedback']);
		$time = date('Y:m:d h:i:s', $_SERVER['REQUEST_TIME']);
		$sql = "INSERT INTO `feedback` (`username`, `qq`, `tel`, `email`, `feedback`, `sub_time`) VALUES ('{$username}', '{$qq}', '{$tel}', '{$email}', '{$feedback}', '{$time}')";
		$obj = mysqli_query($conn, $sql);
		if ($obj) {
			echo "<script>alert('反馈成功');</script>";
			echo "<script>window.location.href='feedback.php'</script>";
		} else {
			echo "<script>alert('反馈失败');</script>";
		}
		mysqli_close($conn);
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>反馈</title>
	<link rel="stylesheet" type="text/css" href="./static/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="./static/css/common.css">
	<link rel="stylesheet" type="text/css" href="./static/css/feedback.css">
</head>
<body>
	<div class="login_wrap">
		<div id="container">
			<header id="header">
				<a href="./index.php" title="考试查分网站"><img src="./static/image/logo.png" alt=""><h1 id="logo">考试查分网站</h1></a>
			</header>
			<nav id="nav">
				<ul>
					<li><a href="./index.php" title="index.php">首页</a></li>
					<li><a href="./signup.php" title="考试报名">考试报名</a></li>
					<li><a href="./query.php" title="成绩查询">成绩查询</a></li>
					<!-- <li><a href="./rank.php" title="考试统计">考试统计</a></li> -->
					<li><a href="./detail.php" title="成绩详情">成绩详情</a></li>
					<li class="selected"><a href="./feedback.php" title="feedback.php">反馈</a></li>
				</ul>
			</nav>
			<content id="content">
				<div class="feedback_container">
					<form action="feedback.php" method="post" autocomplete="off" id="feedback-form">
						<table class="feedback_table">
							<tbody>
								<tr>
									<td class="first_line">姓名：</td>
									<td><input type="text" name="username" id="username" placeholder="请输入您的名字"></td>
								</tr>
								<tr>
									<td class="first_line">QQ：</td>
									<td><input type="text" name="qq" id="qq" placeholder="请输入您的QQ"></td>
								</tr>
								<tr>
									<td class="first_line">手机号码：</td>
									<td><input type="text" name="tel" id="tel" placeholder="请输入您的手机号码"></td>
								</tr>
								<tr>
									<td class="first_line">邮箱：</td>
									<td><input type="text" name="email" id="email" placeholder="请输入您的常用邮箱"></td>
								</tr>
								<tr>
									<td class="first_line">反馈信息：</td>
									<td><textarea name="feedback" id="feedback"></textarea><div id="msg"></div></td>
								</tr>
								<tr>
									<td><input type="hidden" name="token" value="<?php echo $token; ?>" /></td>
									<td><input type="submit" id="submit_btn" name="submit" value="提交反馈">
								</tr>
							</tbody>
						</table>
					</form>
				</div>
				<!-- 注意清除浮动的位置 -->
				<div class="clearfix"></div>
				<!-- 注意清除浮动的位置 -->
			</content>
		</div>
			<footer id="footer">
				<div class="footer_container">
					<div class="footer_left">
						<div class="footer_left_top">
							<span class="footer_title">参考网站</span>
							<ul>
								<li><a href="http://www.neea.edu.cn/" title="中国教育考试网" target="_blank"><img src="./static/image/jyks-final.png" alt="中国教育考试网"></a></li>
								<li><a href="https://www.csdn.net/" title="CSDN" target="_blank"><img src="./static/image/CSDN-final.png" alt="CSDN"></a></li>
								<li><a href="https://github.com/" title="Github" target="_blank"><img src="./static/image/github-final.png" alt="Github"></a></li>
								<li><a href="http://jquery.com/" title="jQuery" target="_blank"><img src="./static/image/jQuery-final.png" alt="jQuery"></a></li>
								<li><a href="http://php.net/" title="PHP" target="_blank"><img src="./static/image/php-final.png" alt="PHP"></a></li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="footer_left_bottom">
							<span class="footer_title">友情链接</span>
							<ul>
								<li><a href="https://www.imooc.com" title="慕课网" target="_blank">慕课网</a></li>
								<li><a href="https://www.aliyun.com/?utm_campaign=home&utm_medium=images&utm_source=muke&utm_content=m_6598" title="阿里云" target="_blank">阿里云</a></li>
								<li><a href="https://cloud.tencent.com/?utm_source=youlian&utm_medium=ylsq&utm_campaign=youlian" title="腾讯云" target="_blank">腾讯云</a></li>
								<li><a href="http://www.exam8.com/" title="考试吧" target="_blank">考试吧</a></li>
								<li><a href="https://mp.weixin.qq.com/cgi-bin/wx" title="微信小程序" target="_blank">微信小程序</a></li>
								<li><a href="https://www.php-z.com/" title="PHP站中文网" target="_blank">PHP站中文网</a></li>
								<li><a href="http://www.w3school.com.cn/" title="w3cschool" target="_blank">w3cschool</a></li>
								<li><a href="https://www.npmjs.com/" title="Node.js" target="_blank">Node.js</a></li>
								<li><a href="https://www.cnblogs.com/" title="npm.js" target="_blank">npm.js</a></li>
								<li><a href="http://www.bootcss.com/" title="Bootstrap" target="_blank">Bootstrap</a></li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="footer_right">
						<span class="footer_title qrcode_title">打开微信“扫一扫”，扫描右方二维码，进入查分网站小程序版</span>
						<img src="./static/image/qrcode.jpg" alt="">
					</div>
					<div class="clearfix"></div>
				</div>
			</footer>
	</div>
	<script type="text/javascript" src="./static/script/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="./static/script/common.js"></script>
	<script type="text/javascript"  src="./static/script/layer/layer.js" ></script>
	<script>
		// 反馈页面验证
		$(function() {
		    $('#feedback-form').submit(function() {
		        var $username = $('#username').val(),
		            $qq = $('#qq').val(),
		            $tel = $('#tel').val(),
		            $email = $('#email').val(),
		            $feedback = $('#feedback').val();
		        // 姓名非空验证
		        if ($username == '' || $username.length <= 0) {
		            layer.tips('姓名不能为空', '#username', { time: 2000, tips: [2, '#CB5B5B'] });
		            $('#username').focus();
		            return false;
		        }
		        // 反馈非空验证
		        if ($feedback == '' || $feedback.length <= 0) {
		            layer.tips('反馈不能为空', '#feedback', { time: 2000, tips: [2, '#CB5B5B'] });
		            $('#feedback').focus();
		            return false;
		        }
		        // 联系方式不能同时为空
		        if (($qq == '' || $qq.length <= 0) && ($tel == '' || $tel.length <= 0) && ($email == '' || $email.length <= 0)) {
		        	 layer.tips('QQ，手机号码，邮箱三项必须输入其中一项', '#qq', { time: 2000, tips: [2, '#CB5B5B'] });
		            $('#qq').focus();
		            return false;
		        }
		        // 如果QQ非空，进行格式验证
		        if(!($qq == '' || $qq.length <= 0) && (/^[1-9][0-9]{4,9}$/gim.test($qq) === false)) {
		             layer.tips('QQ格式错误', '#qq', { time: 2000, tips: [2, '#CB5B5B'] });
		            $('#qq').focus();
		            return false;
		        }
		        // 如果手机号码非空，进行格式验证
				if(!($tel == '' || $tel.length <= 0) && /^1[34578]\d{9}$/.test($tel) === false) {
		             layer.tips('手机号码格式错误', '#tel', { time: 2000, tips: [2, '#CB5B5B'] });
		            $('#tel').focus();
		            return false;
		        }
		        // 如果邮箱非空，进行格式验证
		        if(!($email == '' || $email.length <= 0) && /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test($email) === false) {
		             layer.tips('邮箱格式错误', '#email', { time: 2000, tips: [2, '#CB5B5B'] });
		            $('#email').focus();
		            return false;
		        }
		        return true;
		    });
		});

	</script>
</body>
</html>