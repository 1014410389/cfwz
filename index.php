<?php
include_once './lib/fun.php';

session_start();
$name = $_SESSION['user']['username'];
$school = $_SESSION['user']['school'];
$id_num = $_SESSION['user']['identity_num'];

// 完善个人信息
$tel = trim($_POST['tel']);
$sno = trim($_POST['sno']);
$department = trim($_POST['department']);
$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');
if (isset($_POST['change'])) {
	$sql = "UPDATE `user` SET `cellphone_num` = '{$tel}',`sno` = '{$sno}', `department` = '{$department}' WHERE `identity_num` = '{$id_num}'";
	mysqli_query($conn, $sql);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>首页</title>
	<link rel="stylesheet" type="text/css" href="./static/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="./static/css/common.css">
	<link rel="stylesheet" type="text/css" href="./static/css/index.css">
</head>
<body>
	<div class="login_wrap">
		<div id="container">
			<header id="header">
				<a href="./index.php" title="考试查分网站"><img src="./static/image/logo.png" alt=""><h1 id="logo">考试查分网站</h1></a>
			</header>
			<nav id="nav">
				<ul>
					<li class="selected"><a href="./index.php" title="首页">首页</a></li>
					<li><a href="./query.php" title="成绩查询">成绩查询</a></li>
					<li><a href="./signup.php" title="考试报名">考试报名</a></li>
					<!-- <li><a href="./rank.php" title="考试统计">考试统计</a></li> -->
					<li><a href="./detail.php" title="成绩详情">成绩详情</a></li>
					<li><a href="./feedback.php" title="反馈">反馈</a></li>
				</ul>
			</nav>
			<content id="content">
				<div id="content_left">
					<div class="slideshow">
						<ul>
							<li>
								<div class="box"><img src="./static/image/sspic_5.jpg" alt="sspic_5">
								</div>
								<div class="box_context">
									<p>2019年高考，你准备好了吗？
								</p>
									<a class="slideshow_detail" href="https://wannianli.tianqi.com/jishiqi/gaokaodaojishi.html" title="查看详情" target="_blank">查看详情</a>
								</div>
							</li>
							<li>
								<div class="box"><img src="./static/image/sspic_2.jpg" alt="sspic_2">
								</div>
								<div class="box_context">
									<p>CET6 口语考试内容及流程</p>
									<a class="slideshow_detail" href="http://www.sparke.cn/network/networkDetails?key=652681930600167040" title="查看详情" target="_blank">查看详情</a>
								</div>
							</li>
							<li>
								<div class="box"><img src="./static/image/sspic_3.jpg" alt="sspic_3">
								</div>
								<div class="box_context">
									<p>2019考试月历</p>
									<a class="slideshow_detail" href="http://www.exam8.com/kaoshishijian/" title="查看详情" target="_blank">查看详情</a>
								</div>
							</li>
						</ul>
						<div class="arrow_left"><img src="./static/image/icon/arrow-left.png"></div>
						<div class="arrow_right"><img src="./static/image/icon/arrow-right.png"></div>
					</div>
					<div class="exam_info">
						<div class="title_top">
							<span>考试资讯</span>
						</div>
						<div class="exam_info_container">
							<ul>
								<li><a href="#"><span class="exam_info_title">1.孙春兰在教育部考试中心检查2018年高考准备工作</span><p class="exam_info_description">高考前夕，中共中央政治局委员、国务院副总理孙春兰来到教育部考试中心检查2018年高考准备工作，通过国家教育考试考务指挥系统了解有关地方考场、试卷保管和分发场所等情况，看望高考值班工作人...</p></a></li>
								<li><a href="#"><span class="exam_info_title">2.语言测试与评价国际研讨会征文通知</span><p class="exam_info_description">教育部考试中心与北京外国语大学将于2018年12月1-2日在北京联合举办语言测试与评价国际研讨会，旨在为中国及其他国家和地区的语言教学、测评领域的研究人员、考试机构、教育政策制定者提供交流最新动态和研究成果的平台。现诚邀会议论文。</p></a></li>
								<li><a href="#"><span class="exam_info_title">3.雅思、普思考试与中国英语能力等级量表对接研究顺利完成</span><p class="exam_info_description">根据中英两国部长2016年12月6日签署的《中英教育合作伙伴框架行动计划》，教育部考试中心和英国文化教育协会合作开展雅思、普思考试与中国英语能力等级量表对接研究工作。中英联合研究团队借鉴国际经验，采用专家判断和实证数据相结合的方法，多渠道收集校验证据，注重结果的科学论证过程，历时两年顺利完成该项研究。</p></a></li>
								<li><a href="#"><span class="exam_info_title">4.教育部办公厅关于印发《中国英语能力等级量表》的通知</span><p class="exam_info_description">	各省、自治区、直辖市教育厅（教委）、语委，新疆生产建设兵团教育局、语委，部属各高等学校：教育部考试中心起草的《中国英语能力等级量表》由国家语言文字工作委员会规范标准审定委员会审定，已经教育部、国家语委同意发布。该项语言文字规范规定了中国英语学习者和使用者的英语能力等级，描述了各等级的能力表现特征...</p></a></li>
								<li><a href="#"><span class="exam_info_title">5.2019年普通高等学校招生全国统一考试大纲正式公布</span><p class="exam_info_description">	普通高等学校招生全国统一考试大纲是高考命题的规范性文件和标准。根据高考内容改革要求修订考试大纲，是保证考试科学公平、促进素质教育发展的一项重要工作。现将2019年普通高等学校招生全国统一考试大纲予以公布。</p></a></li>
								<li><a href="#"><span class="exam_info_title">6.网传考研数学辅导视频泄题不实</span><p class="exam_info_description">	今日，网传某教师考研辅导视频涉嫌泄露研究生招生考试数学试题。教育部考试中心组织有关专家，对视频等材料进行了研判，确认所举的例题均与实考试题不同。该教师及视频中所提及的老师均未参与2018年研究生招生考试数学科命题工作。教育部考试中心有关负责人表示，任何干扰破坏国家教育考试的行为，一经查实，将依法依规严肃处理，决不姑息。</p></a></li>
								<li><a href="#"><span class="exam_info_title">7.专访教育部考试中心主任姜钢——高考承载为国选人育人的重大使命</span><p class="exam_info_description">2017年高考刚刚结束，今年的高考试题如何发挥其固本、铸魂、打底色的作用，如何多渠道落实立德树人根本任务，全方位弘扬中华优秀传统文化？高考是如何承载为国选人育人的重大使命的？近日记者专访了教育部考试中心主任姜钢。</p></a></li>
								<li><a href="#"><span class="exam_info_title">8.关于建议错峰查询2017年下半年中小学教师资格考试（笔试）成绩的通知</span><p class="exam_info_description">2017年下半年中小学教师资格考试（笔试）成绩已于12月12日在网上对考生开放查询。由于此次考生人数较多，开放成绩查询首日会出现网络拥堵，网页无法打开的情况，建议考生错峰查询，成绩查询网站长期开放。</p></a></li>
							</ul>
						</div>
						<div class="more_info"><a href="#" title="查看更多">查看更多></a></div>
					</div>
				</div>
				<div id="content_right">
					<div class="user_info">
						<div class="title_top">
							<span>个人信息</span>
						</div>
						<div class="user_info_container">
						<?php if ($name !== null): ?>
							<table>
								<tbody>
									<tr>
										<td>姓名：</td>
										<td><?php echo $name ?></td>
									</tr>
									<tr>
										<td>学校：</td>
										<td><?php echo $school ?></td>
									</tr>
								</tbody>
							</table>
						<?php else: ?>
							<table>
								<tbody>
									<tr>
										<td>您还没有登录，进入<a href="./login.php" title="登录">登录</a></td>
									</tr>
								</tbody>
							</table>
						<?php endif;?>
							<div class="more_option">
								<div class="option_panel">
									<ul>
										<li><i></i><a href="#" title="完善个人信息">完善个人信息</a></li>
										<li><i></i><a href="./logout.php">退出当前账号</a></li>
									</ul>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="complete_user_info">
							<form action="./index.php" method="POST" autocomplete="off">
								<table>
									<tbody>
										<tr>
											<td class="first_column">手机：</td>
											<td><input type="text" name="tel"></td>
										</tr>
										<tr>
											<td class="first_column">院系：</td>
											<td><input type="text" name="department"></td>
										</tr>
										<tr>
											<td class="first_column">学号：</td>
											<td><input type="text" name="sno"></td>
										</tr>
										<tr>
											<td><input type="reset" name="" value="重置"></td>
											<td><input type="submit" name="change" value="提交"></td>
										</tr>
									</tbody>
								</table>
							</form>
						</div>
					</div>
					<div class="countdown">
						<div class="title_top">
							<span>最近考试</span>
						</div>
						<div class="countdown_container">
							<table>
								<tbody class="countdown_list">
									<tr>
										<td><span class="countdown_exam_type">距离高考还有：</span></td>
										<td><div id="countdown1">00</div></td>
										<td><span class="countdown_exam_type">天</span></td>
									</tr>
									<tr class="countdown_detail">
										<td><span>参考时间：2019年6月7日</span></td>
										<td><a href="http://www.gaokao.com/" target="_blank">查看详情></a></td>
									</tr>
									<tr class="table_placeholder"><td></td></tr>
									<tr>
										<td><span class="countdown_exam_type">距离四六级考试还有：</span></td>
										<td><div id="countdown2">00</div></td>
										<td><span class="countdown_exam_type">天</span></td>
									</tr>
									<tr class="countdown_detail">
										<td><span>参考时间：2019年6月15日</span></td>
										<td><a href="http://www.cet.edu.cn/" target="_blank">查看详情></a></td>
									</tr>
									<tr class="table_placeholder"><td></td></tr>
									<tr>
										<td><span class="countdown_exam_type">距离公务员考试还有：</span></td>
										<td><div id="countdown3">00</div></td>
										<td><span class="countdown_exam_type">天</span></td>
									</tr>
									<tr class="countdown_detail">
										<td><span>参考时间：2019年4月20日</span></td>
										<td><a href="http://www.chinagwy.org/" target="_blank">查看详情></a></td>
									</tr>
									<tr class="table_placeholder"><td></td></tr>
									<tr>
										<td><span class="countdown_exam_type">距教师资格考试还有：</span></td>
										<td><div id="countdown4">00</div></td>
										<td><span class="countdown_exam_type">天</span></td>
									</tr>
									<tr class="countdown_detail">
										<td><span>参考时间：2019年11月2日</span></td>
										<td><a href="http://www.jszg.edu.cn" target="_blank">查看详情></a></td>
									</tr>
									<tr class="table_placeholder"><td></td></tr>
									<tr>
										<td><span class="countdown_exam_type">距离研究生考试还有：</span></td>
										<td><div id="countdown5">00</div></td>
										<td><span class="countdown_exam_type">天</span></td>
									</tr>
									<tr class="countdown_detail">
										<td><span>参考时间：2019年6月7日</span></td>
										<td><a href="https://yz.chsi.com.cn/" target="_blank">查看详情></a></td>
									</tr>
									<div class="notification">*当前时间仅代表大概的考试时间，如需查看准确的考试时间，请参考当地的考试公示</div>
								</tbody>
							</table>
						</div>
					</div>
					<div class="other_info">
						<div class="title_top">
							<span>其他信息</span>
						</div>
						<div class="other_info_container">
					<!-- 		1.高考
							2.中考
							3.... -->
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
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
								<li><a href="https://www.zhihu.com/" title="知乎" target="_blank">知乎</a></li>
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
	<script type="text/javascript" src="./static/script/index.js"></script>
	<script type="text/javascript" src="./static/script/common.js"></script>
	<script>
		$('.more_option').hover(function() {
			if(!$('.option_panel').is(':animated')) {
				$('.option_panel').fadeIn(300);
			}
		}, function() {
			if(!$('.option_panel').is(':animated')) {
				$('.option_panel').fadeOut(300);
			}
		});

		// $('.option_panel a').eq(0).click(function() {
		// 	$('.user_info').animate({
		// 		height: '370px'
		// 	}, 1000);
		// 	$('.complete_user_info').fadeIn();
		// 	return false;
		// });

	</script>
</body>
</html>