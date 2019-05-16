<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>考试报名</title>
	<link rel="stylesheet" type="text/css" href="./static/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="./static/css/common.css">
	<link rel="stylesheet" type="text/css" href="./static/css/signup.css">
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
					<li class="selected"><a href="./signup.php" title="考试报名">考试报名</a></li>
					<li><a href="./query.php" title="成绩查询">成绩查询</a></li>
					<!-- <li><a href="./rank.php" title="考试统计">考试统计</a></li> -->
					<li><a href="./detail.php" title="成绩详情">成绩详情</a></li>
					<li><a href="./feedback.php" title="feedback.php">反馈</a></li>
				</ul>
			</nav>
			<content id="content">
				<div class="exam_type_container">
					<div class="et_left">
						<i class="et_title_icon"></i><span class="exam_type_title">国内</span>
						<hr class="separate_line" />
						<table>
							<tbody>
								<tr>
									<td><i class="iconfont"></i><a href="http://ntce.neea.edu.cn/" target="_blank" title="中小学教师资格考试(NTCE)">中小学教师资格考试(NTCE)</a></td>
									<td><i class="iconfont"></i><a href="http://wsk.neea.edu.cn/" target="_blank" title="全国外语水平考试(WSK)">全国外语水平考试(WSK)</a></td>
								</tr>
								<tr>
									<td><i class="iconfont"></i><a href="http://pets.neea.edu.cn/" target="_blank" title="全国英语等级考试（PETS）">全国英语等级考试（PETS）</a></td>
									<td><i class="iconfont"></i><a href="http://ccpt.neea.edu.cn/" target="_blank" title="书画等级考试(CCPT)">书画等级考试(CCPT)</a></td>
								</tr>
								<tr>
									<td><i class="iconfont"></i><a href="http://cet.neea.edu.cn/" target="_blank" title="全国大学英语四、六级考试(CET)">全国大学英语四、六级考试(CET)</a></td>
									<td><i class="iconfont"></i><a href="http://mets.neea.edu.cn/" target="_blank" title="医护英语水平考试(METS)">医护英语水平考试(METS)</a></td>
								</tr>
								<tr>
									<td><i class="iconfont"></i><a href="http://mhk.neea.edu.cn/" target="_blank" title="中国少数民族汉语水平等级考试(MHK)">中国少数民族汉语水平等级考试(MHK)</a></td>
									<td><i class="iconfont"></i><a href="http://nit.neea.edu.cn/" target="_blank" title="全国计算机应用水平考试(NIT)">全国计算机应用水平考试(NIT)</a></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="et_right">
						<i class="et_title_icon"></i><span class="exam_type_title">国外</span>
						<hr class="separate_line" />
						<table>
							<tbody>
								<tr>
									<td><i class="iconfont"></i><a href="http://toefl-main.neea.cn/" target="_blank" title="托福(TOEFL)">托福(TOEFL)</a></td>
									<td><i class="iconfont"></i><a href="http://testdaf-main.neea.cn/" target="_blank" title="德福(TestDaF)">德福(TestDaF)</a></td>
								</tr>
								<tr>
									<td><i class="iconfont"></i><a href="http://ielts-main.neea.cn/" target="_blank" title="雅思(IELTS)">雅思(IELTS)</a></td>
									<td><i class="iconfont"></i><a href="http://gre-main.neea.cn/" target="_blank" title="美国研究生入学考试(GRE)">美国研究生入学考试(GRE)</a></td>
								</tr>
								<tr>
									<td><i class="iconfont"></i><a href="http://topik-main.neea.cn/" target="_blank" title="韩国语能力考试(TOPIK)">韩国语能力考试(TOPIK)</a></td>
									<td><i class="iconfont"></i><a href="http://jlpt-main.neea.cn/" target="_blank" title="">日本语能力测试(JLPT)</a></td>
								</tr>
								<tr>
									<td><i class="iconfont"></i><a href="http://gmat-main.neea.cn/" target="_blank" title="美国管理学研究生入学考试(GMAT)">美国管理学研究生入学考试(GMAT)</a></td>
									<td><i class="iconfont"></i><a href="http://bec.neea.cn/" target="_blank" title="剑桥商务英语(BEC)">剑桥商务英语(BEC)</a></td>
								</tr>
								<tr>
									<td><i class="iconfont"></i><a href="http://mse.neea.cn/" target="_blank" title="剑桥五级普通英语水平证书考试(MSE)">剑桥五级普通英语水平证书考试(MSE)</a></td>
									<td><i class="iconfont"></i><a href="http://delf-dalf.neea.cn/" target="_blank" title="法语(DELF-DALF)">法语(DELF-DALF)</a></td>
								</tr>
								<tr>
									<td><i class="iconfont"></i><a href="http://cyle.neea.cn/" target="_blank" title="剑桥少儿英语（CYLE）">剑桥少儿英语（CYLE）</a></td>
									<td><i class="iconfont"></i><a href="http://www.neea.edu.cn/html1/folder/1803/5753-1.htm" title="对外西班牙语水平证书考试（DELE）">对外西班牙语水平证书考试（DELE）
									</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="clearfix"></div>
			</content>
			<!-- <div class="clearfix"></div> -->
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
</body>
</html>