<?php
// 引入lib文件
include_once './lib/fun.php';
// 开启SESSION
session_start();
// 连接数据库
$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');
// 获取数据
$ad_ticket = trim($_GET['admission_ticket']);
$id_num = trim($_GET['id_num']);
$ename = trim($_GET['name']);
$exam_id = trim($_GET['exam_id']);
$exam_type = trim($_GET['exam_type']);
// 点击查询按钮
if (isset($_GET['submit'])) {
	$sql = "SELECT * FROM `{$exam_type}` WHERE (`admission_ticket` = '$ad_ticket' OR `identity_num` = '{$id_num}') AND `exam_id` = '{$exam_id}'";
	$obj = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($obj);
	if ($result) {
		// 如果结果集存在，将数据循环设置到SESSION
		foreach ($result as $key => $value) {
			$_SESSION["{$key}"] = $result["{$key}"];
		}
		// 总分单独计算
		$_SESSION['total'] = $result['listening'] + $result['reading'] + $result['comprehensive'] + $result['writing'];
		// 关闭数据库
		mysqli_close($conn);
		echo '<script>window.location.href="./detail.php"</script>';
	} else {
		echo '<script>alert("用户成绩不存在，请检查后重新查询");window.location.href="./query.php"</script>';
	}
} else {
	echo mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>成绩查询</title>
	<link rel="stylesheet" type="text/css" href="./static/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="./static/css/common.css">
	<link rel="stylesheet" type="text/css" href="./static/css/query.css">
	<style>

	</style>
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
					<li class="selected"><a href="./query.php"  title="成绩查询">成绩查询</a></li>
					<!-- <li><a href="./rank.php" title="考试统计">考试统计</a></li> -->
					<li><a href="./detail.php" title="成绩详情">成绩详情</a></li>
					<li><a href="./feedback.php" title="feedback.php">反馈</a></li>
				</ul>
			</nav>
			<content id="content">
				<div class="signup_container">
					<div class="exam_change">
						<div class="exam_domestic e_selected e_btn">国内</div>
						<div class="separate"></div>
						<div class="exam_foreign e_btn">国外</div>
						<div class="clearfix"></div>
					</div>
					<div class="exam_content">
						<div class="domestic_content">
							<div class="et_left">
								<i class="et_title_icon"></i><span class="exam_type_title">考试类型</span>
								<table>
									<tbody>
										<tr>
											<td><i class="iconfont"></i><a href="http://cet.neea.edu.cn/" target="_blank" title="全国大学英语四级考试(CET4)">全国大学英语四级考试(CET4)</a></td>
											<td><i class="iconfont"></i><a href="http://wsk.neea.edu.cn/" target="_blank" title="全国大学英语六级考试(CET6)">全国大学英语六级考试(CET6)</a></td>
										</tr>
										<tr>
											<td><i class="iconfont"></i><a href="http://pets.neea.edu.cn/" target="_blank" title="全国英语等级考试(PETS)">全国英语等级考试(PETS)</a></td>
											<td><i class="iconfont"></i><a href="http://ccpt.neea.edu.cn/" target="_blank" title="全国外语水平考试(WSK)">全国外语水平考试(WSK)</a></td>
										</tr>
										<tr>
											<td><i class="iconfont"></i><a href="http://ntce.neea.edu.cn/" target="_blank" title="中小学教师资格考试(NTCE)">中小学教师资格考试(NTCE)</a></td>
											<td><i class="iconfont"></i><a href="http://mets.neea.edu.cn/" target="_blank" title="医护英语水平考试(METS)">医护英语水平考试(METS)</a></td>
										</tr>
										<tr>
											<td><i class="iconfont"></i><a href="http://mhk.neea.edu.cn/" target="_blank" title="中国少数民族汉语水平等级考试(MHK)">中国少数民族汉语水平等级考试(MHK)</a></td>
											<td><i class="iconfont"></i><a href="http://nit.neea.edu.cn/" target="_blank" title="全国计算机等级考试(NCRE)">全国计算机等级考试(NCRE)</a></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="query_form">
								<ul class="query_form_container">
									<li>
										<div>
											<form action="query.php" method="get" accept-charset="utf-8" id="cet4">
												全国大学英语四级考试(CET4)
											<!-- 	准考证：440691171203509
												身份证：411426200211225656 -->
												<table>
													<tbody>
														<tr>
															<td class="label">准考证号：</td>
															<td><input type="text" name="admission_ticket" placeholder="请输入您的准考证号" class="ad_ticket"></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td class="label">身份证号：</td>
															<td><input type="text" name="id_num" placeholder="请输入您的身份证号" class="id_num"></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td class="label">姓名：</td>
															<td><input type="text" name="name" placeholder="请输入您的名字" class="name"></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td><input type="hidden" name="exam_type" value="cet"><input type="hidden" name="exam_id" value="0101"></td>
															<td><input type="submit" class="submit" name="submit" value="查询"><input type="reset" class="reset" name="reset" value="重置"></td>
														</tr>
													</tbody>
												</table>
											</form>
										</div>
									</li>
									<li>
										<div>
											<form action="query.php" method="get" accept-charset="utf-8" id="cet6">
												全国大学英语六级考试(CET6)
											<!-- 	准考证：440692171203610
												身份证：51343319890709039X -->
												<table>
													<tbody>
														<tr>
															<td class="label">准考证号：</td>
															<td><input type="text" name="admission_ticket" placeholder="请输入您的准考证号" class="ad_ticket"></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td class="label">身份证号：</td>
															<td><input type="text" name="id_num" placeholder="请输入您的身份证号" class="id_num"></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td class="label">姓名：</td>
															<td><input type="text" name="name" placeholder="请输入您的名字" class="name"></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td><input type="hidden" name="exam_type" value="cet"><input type="hidden" name="exam_id" value="0102"></td>
															<td><input type="submit" class="submit" name="submit" value="查询"><input type="reset" class="reset" name="reset" value="重置"></td>
														</tr>
													</tbody>
												</table>
											</form>
										</div>
									</li>
									<li>
										<div>
											<form action="query.php" method="get" accept-charset="utf-8" id="pets">
												全国英语等级考试(PETS)
												<table>
													<tbody>
														<tr>
															<td class="label">考试时间：</td>
															<td><select name="exam_date">
																<option value="0OVqWNbHVfFa3JqxFdeA6V">2018年9月</option><option value="2tyDANQggtdKWsnbOkhibHX">2018年3月</option><option value="2Ba049ynilaf8I9J7JxJnIu">2017年9月</option><option value="2Lergjb2NbqVNvoPnlVJiZ">2017年3月</option><option value="4543">2016年9月</option><option value="4263">2016年3月</option><option value="3962">2015年9月</option><option value="3702">2015年3月</option><option value="3427">2014年9月</option><option value="3122">2014年3月</option><option value="2842">2013年9月</option><option value="2602">2013年3月</option><option value="2382">2012年9月</option><option value="2220">2012年3月</option><option value="2060">2011年9月</option><option value="1820">2011年3月</option><option value="1660">2010年9月</option><option value="1420">2010年3月</option><option value="1200">2009年9月</option><option value="640">2009年3月</option><option value="600">2008年9月</option><option value="583">2008年3月</option><option value="340">2007年9月</option><option value="582">2007年3月</option><option value="400">2006年9月</option><option value="581">2006年3月</option><option value="446">2005年9月</option><option value="580">2005年3月</option><option value="445">2004年9月</option><option value="444">2004年3月</option><option value="443">2003年9月</option><option value="442">2003年3月</option><option value="441">2002年9月</option><option value="440">2002年3月</option><option value="421">2001年9月</option><option value="420">2001年3月</option>
															</select></td>
														</tr>
														<tr>
															<td class="label">报考省份：</td>
															<td><select name="exam_province"><option value="11">11-北京</option><option value="12">12-天津</option><option value="13">13-河北</option><option value="14">14-山西</option><option value="15">15-内蒙古</option><option value="21">21-辽宁</option><option value="22">22-吉林</option><option value="23">23-黑龙江</option><option value="31">31-上海</option><option value="32">32-江苏</option><option value="33">33-浙江</option><option value="34">34-安徽</option><option value="35">35-福建</option><option value="36">36-江西</option><option value="37">37-山东</option><option value="41">41-河南</option><option value="42">42-湖北</option><option value="43">43-湖南</option><option value="44">44-广东</option><option value="45">45-广西</option><option value="46">46-海南</option><option value="50">50-重庆</option><option value="51">51-四川</option><option value="52">52-贵州</option><option value="53">53-云南</option><option value="54">54-西藏</option><option value="61">61-陕西</option><option value="62">62-甘肃</option><option value="63">63-青海</option><option value="64">64-宁夏</option><option value="65">65-新疆</option><option value="81">81-总参</option><option value="82">82-北京军区</option></select></td>
														</tr>
														<tr>
															<td class="label">报考级别：</td>
															<td><select name="exam_level"><option value="1">一级B</option><option value="2">一级</option><option value="3">二级</option><option value="4">三级</option><option value="5">四级</option></select></td>
														</tr>
														<tr>
															<td class="label">准考证号：</td>
															<td><input type="text" name="admission_ticket" placeholder="请输入您的准考证号" class="ad_ticket"></td>
														</tr>
														<tr>
															<td class="label">姓名：</td>
															<td><input type="text" name="name" placeholder="请输入您的名字" class="name"></td>
														</tr>
														<tr>
															<td class="label">证件号码：</td>
															<td><input type="text" name="zj" placeholder="请输入您的证件号码" class="zj"></td>
														</tr>
														<tr>
															<td></td>
															<td><input type="submit" class="submit" name="submit" value="查询"><input type="reset" class="reset" name="reset" value="重置"></td>
														</tr>
													</tbody>
												</table>
											</form>
										</div>
									</li>
									<li>
										<div>
											<form action="query.php" method="get" accept-charset="utf-8" id="wsk">
												全国外语水平考试(WSK)
												<table>
													<tbody>
														<tr>
															<td class="label">考试时间：</td>
															<td><select name="exam_date">
																<option value="2FaMpcPEF0XoPOGNsbeR6U">2018年11月</option><option value="3pGGxGQOB5fUCHMlwQEkY6">2018年05月</option><option value="3khtP9QCZfEGFGV9vt4zO23">2017年11月</option><option value="07KhaEVWx5fUYFH0RTpdJb">2017年05月</option><option value="4743">2016年11月</option><option value="4343">2016年05月</option><option value="4067">2015年11月</option><option value="3803">2015年05月</option><option value="3531">2014年11月</option><option value="3302">2014年05月</option><option value="2982">2013年12月</option><option value="2662">2013年06月</option><option value="2522">2012年12月</option><option value="2320">2012年06月</option><option value="2140">2011年12月</option><option value="1960">2011年06月</option><option value="1760">2010年12月</option><option value="1580">2010年06月</option><option value="1381">2009年12月</option><option value="1060">2009年06月</option><option value="840">2008年12月</option><option value="962">2008年06月</option><option value="960">2007年12月</option><option value="1000">2007年06月</option><option value="1001">2006年12月</option><option value="942">2006年06月</option><option value="941">2005年12月</option><option value="940">2005年06月</option><option value="920">2004年12月</option><option value="921">2004年06月</option><option value="922">2003年12月</option>
															</select></td>
														</tr>
														<tr>
															<td class="label">报考省份：</td>
															<td><select name="exam_province"><option value="01">全国</option></select></td>
														</tr>
														<tr>
															<td class="label">报考级别：</td>
															<td><select name="exam_level"><option value="法语">法语</option><option value="德语">德语</option><option value="日语">日语</option><option value="俄语">俄语</option><option value="英语">英语</option></select></td>
														</tr>
														<tr>
															<td class="label">准考证号：</td>
															<td><input type="text" name="admission_ticket" placeholder="请输入您的准考证号" class="ad_ticket"></td>
														</tr>
														<tr>
															<td class="label">姓名：</td>
															<td><input type="text" name="name" placeholder="请输入您的名字" class="name"></td>
														</tr>
														<tr>
															<td class="label">证件号码：</td>
															<td><input type="text" name="zj" placeholder="请输入您的证件号码" class="zj"></td>
														</tr>
														<tr>
															<td></td>
															<td><input type="submit" class="submit" name="submit" value="查询"><input type="reset" class="reset" name="reset" value="重置"></td>
														</tr>
													</tbody>
												</table>
											</form>
										</div>
									</li>
									<li>
										<div>
											<form action="query.php" method="get" accept-charset="utf-8" id="ntce">
												中小学教师资格考试(NTCE)
												<table>
													<tbody>
														<tr>
															<td class="label">准考证号：</td>
															<td><input type="text" name="admission_ticket" placeholder="请输入您的准考证号" class="ad_ticket"></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td class="label">身份证号：</td>
															<td><input type="text" name="id_num" placeholder="请输入您的身份证号" class="id_num"></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td class="label">姓名：</td>
															<td><input type="text" name="name" placeholder="请输入您的名字" class="name"></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td></td>
															<td><input type="submit" class="submit" name="submit" value="查询"><input type="reset" class="reset" name="reset" value="重置"></td>
														</tr>
													</tbody>
												</table>
											</form>
										</div>
									</li>
									<li>
										<div>
											<form action="query.php" method="get" accept-charset="utf-8" id="mets">
												医护英语水平考试(METS)
												<table>
													<tbody>
														<tr>
															<td class="label">考试时间：</td>
															<td><select name="exam_date">
																<option value="0pArKueB908qSdx7EkdlYXt">2018年12月</option><option value="3ScK1Bqqp7npYhtx47UEfK">2018年05月</option><option value="2nqutcixh9kaRf98sLgRIJx">2017年12月</option><option value="1cLALZM9pft8Fzdud0Nvlp4">2017年05月</option><option value="4763">2016年12月</option><option value="4344">2016年05月</option><option value="4130">2015年11月</option><option value="3849">2015年05月</option><option value="3622">2014年12月</option>
															</select></td>
														</tr>
														<tr>
															<td class="label">报考省份：</td>
															<td><select name="exam_province"><option value="01">全国</option></select></td>
														</tr>
														<tr>
															<td class="label">报考级别：</td>
															<td><select name="exam_level"><option value="1">一级</option><option value="2">二级</option><option value="3">三级</option><option value="4">四级</option></select></td>
														</tr>
														<tr>
															<td class="label">准考证号：</td>
															<td><input type="text" name="admission_ticket" placeholder="请输入您的准考证号" class="ad_ticket"></td>
														</tr>
														<tr>
															<td class="label">姓名：</td>
															<td><input type="text" name="name" placeholder="请输入您的名字" class="name"></td>
														</tr>
														<tr>
															<td class="label">证件号码：</td>
															<td><input type="text" name="zj" placeholder="请输入您的证件号码" class="zj"></td>
														</tr>
														<tr>
															<td></td>
															<td><input type="submit" class="submit" name="submit" value="查询"><input type="reset" class="reset" name="reset" value="重置"></td>
														</tr>
													</tbody>
												</table>
											</form>
										</div>
									</li>
									<li>
										<div>
											<form action="query.php" method="get" accept-charset="utf-8" id="mhk">
												中国少数民族汉语水平等级考试(MHK)
												<table>
													<tbody>
														<tr>
															<td class="label">考试时间：</td>
															<td><select name="exam_date">
																<option value="3TRcyPLI5ae9mKk1kA9bc7">2018年11月</option><option value="3ncWmAa0s9dXW2w0AaeyyBJQ">2018年05月</option><option value="17QjFrOcR6mbAA8FKdbIyKu">2017年11月</option><option value="0QkxQeajp6mGnsTuyfYfVT">2017年05月</option><option value="4709">2016年11月</option><option value="4463">2016年05月</option><option value="4708">2015年11月</option><option value="4707">2015年05月</option><option value="4706">2014年11月</option><option value="4705">2014年05月</option><option value="4704">2013年11月</option><option value="4703">2013年05月</option>
															</select></td>
														</tr>
														<tr>
															<td class="label">报考省份：</td>
															<td><select name="exam_province"><option value="11">11-北京</option><option value="12">12-天津</option><option value="13">13-河北</option><option value="14">14-山西</option><option value="15">15-内蒙古</option><option value="21">21-辽宁</option><option value="22">22-吉林</option><option value="23">23-黑龙江</option><option value="31">31-上海</option><option value="32">32-江苏</option><option value="33">33-浙江</option><option value="34">34-安徽</option><option value="35">35-福建</option><option value="36">36-江西</option><option value="37">37-山东</option><option value="41">41-河南</option><option value="42">42-湖北</option><option value="43">43-湖南</option><option value="44">44-广东</option><option value="45">45-广西</option><option value="46">46-海南</option><option value="50">50-重庆</option><option value="51">51-四川</option><option value="52">52-贵州</option><option value="53">53-云南</option><option value="54">54-西藏</option><option value="61">61-陕西</option><option value="62">62-甘肃</option><option value="63">63-青海</option><option value="64">64-宁夏</option><option value="65">65-新疆</option></select></td>
														</tr>
														<tr>
															<td class="label">报考级别：</td>
															<td><select name="exam_level"><option value="2">笔试</option><option value="3">口语</option><option value="1">口语笔试(新疆)</option></select></td>
														</tr>
														<tr>
															<td class="label">准考证号：</td>
															<td><input type="text" name="admission_ticket" placeholder="请输入您的准考证号" class="ad_ticket"></td>
														</tr>
														<tr>
															<td class="label">姓名：</td>
															<td><input type="text" name="name" placeholder="请输入您的名字" class="name"></td>
														</tr>
														<tr>
															<td class="label">证件号码：</td>
															<td><input type="text" name="zj" placeholder="请输入您的证件号码" class="zj"></td>
														</tr>
														<tr>
															<td></td>
															<td><input type="submit" class="submit" name="submit" value="查询"><input type="reset" class="reset" name="reset" value="重置"></td>
														</tr>
													</tbody>
												</table>
											</form>
										</div>
									</li>
									<li>
										<div>
											<form action="query.php" method="get" accept-charset="utf-8" id="ncre">
												全国计算机等级考试(NCRE)
												<table>
													<tbody>
														<tr>
															<td class="label">考试时间：</td>
															<td><select name="exam_date">
																<option value="3lQFwH6UJcp9ScWRacWNAK">2018年12月</option><option value="3a99zI7Nl9m9u0UwVo55uG">2018年09月</option><option value="23kozRaPlayV4oxufU78cP">2018年06月</option><option value="3S6F6bZfhddXBBt0D8K8qW">2018年03月</option>
															</select></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td class="label">考试科目：</td>
															<td><select name="exam_level"><option value="14">14一级计算机基础及WPS Office应用</option><option value="15">15一级计算机基础及MS Office应用</option><option value="16">16一级计算机基础及Photoshop应用</option><option value="24">24二级C语言程序设计</option><option value="26">26二级VB语言程序设计</option><option value="28">28二级JAVA语言程序设计</option><option value="29">29二级ACCESS数据库程序设计</option><option value="61">61二级C++语言程序设计</option><option value="63">63二级MySQL数据程序设计</option><option value="64">64二级Web程序设计</option><option value="65">65二级MS Office高级应用</option><option value="66">66二级Python语言程序设计</option></select></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td class="label">证件号码：</td>
															<td><input type="text" name="zj" placeholder="请输入您的证件号码" class="zj"></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td class="label">姓名：</td>
															<td><input type="text" name="name" placeholder="请输入您的名字" class="name"></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td><input type="hidden" name="exam_type" value="cet"><input type="hidden" name="exam_id" value="0102"></td>
															<td><input type="submit" class="submit" name="submit" value="查询"><input type="reset" class="reset" name="reset" value="重置"></td>
														</tr>
													</tbody>
												</table>
											</form>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="foreign_content e_hide">
							<div class="et_left">
								<i class="et_title_icon"></i><span class="exam_type_title">考试类型</span>
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
											<td><i class="iconfont"></i><a href="http://cyle.neea.cn/" target="_blank" title="剑桥少儿英语(CYLE)">剑桥少儿英语(CYLE)</a></td>
											<td><i class="iconfont"></i><a href="http://www.neea.edu.cn/html1/folder/1803/5753-1.htm" title="对外西班牙语水平证书考试(DELE)">对外西班牙语水平证书考试(DELE)
											</a></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="query_form">
								<ul class="query_form_container">
									<li>
										<div>
											<form action="query.php" method="get" accept-charset="utf-8" id="toefl">
												托福(TOEFL)
												<table>
													<tbody>
														<tr>
															<td class="label">准考证号：</td>
															<td><input type="text" name="admission_ticket" placeholder="请输入您的准考证号" class="ad_ticket"></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td class="label">身份证号：</td>
															<td><input type="text" name="id_num" placeholder="请输入您的身份证号" class="id_num"></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td class="label">姓名：</td>
															<td><input type="text" name="name" placeholder="请输入您的名字" class="name"></td>
														</tr>
														<tr class="table_placeholder"><td></td></tr>
														<tr>
															<td><input type="hidden" name="exam_type" value="cet"><input type="hidden" name="exam_id" value="0102"></td>
															<td><input type="submit" class="submit" name="submit" value="查询"><input type="reset" class="reset" name="reset" value="重置"></td>
														</tr>
													</tbody>
												</table>
											</form>
										</div>
									</li>
									<li>
										<div>
												德福(TestDaF)
										</div>
									</li>
									<li>
										<div>
												雅思(IELTS)
										</div>
									</li>
									<li>
										<div>
												美国研究生入学考试(GRE)
										</div>
									</li>
									<li>
										<div>
												韩国语能力考试(TOPIK)
										</div>
									</li>
									<li>
										<div>
												日本语能力测试(JLPT)
										</div>
									</li>
									<li>
										<div>
												美国管理学研究生入学考试(GMAT)
										</div>
									</li>
									<li>
										<div>
												剑桥商务英语(BEC)
										</div>
									</li>
									<li>
										<div>
												剑桥五级普通英语水平证书考试(MSE)
										</div>
									</li>
									<li>
										<div>
												法语(DELF-DALF)
										</div>
									</li>
									<li>
										<div>
												剑桥少儿英语(CYLE)
										</div>
									</li>
									<li>
										<div>
												对外西班牙语水平证书考试(DELE)
										</div>
									</li>
								</ul>
							</div>
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
	<script type="text/javascript" src="./static/script/layer/layer.js"></script>
	<!-- <script type="text/javascript" src="./lib/validate.js"></script> -->
	<script>
		//切换网页选项卡
		var $e_btns = $('.exam_change .e_btn');
		$e_btns.click(function() {
			$(this).addClass('e_selected').siblings('.e_btn').removeClass('e_selected');
			var index = $e_btns.index(this);
			var $et_content = $('.exam_content > div');
			$et_content.eq(index).show().siblings().hide();
		});

		// 考试类型表单选择
		var $et_link = $('.et_left a');
		$et_link.click(function() {
			var $et_index = $et_link.index(this);
			var $qf_table = $('.query_form_container li');
			$qf_table.eq($et_index).show().siblings().hide();
			return false;
		});

		$(function() {
			$('.et_left a').eq(0).triggerHandler('click');

			// 表单验证
			$('#cet4').submit(function() {
				// 获取表单数据
				var $ad_ticket = $('#cet4 input[name="admission_ticket"]').val(),
					$id_num = $('#cet4 input[name="id_num"]').val(),
					$name = $('#cet4 input[name="name"]').val(),
					reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
				// 准考证号和身份证号不能同时为空，身份证非空时格式验证
				if(($ad_ticket == '' || $ad_ticket.length <= 0) && ($id_num == '' || $id_num.length <=0)) {
					layer.tips('准考证和身份证至少填写一项', '#cet4 .ad_ticket', { time: 2000, tips: [2, '#CB5B5B'] });
			        $('#cet4 .ad_ticket').focus();
			        return false;
				} else if (!($id_num == '' || $id_num.length <=0) && reg.test($id_num) === false) {
			        layer.tips('身份证格式错误', '#cet4 .id_num', { time: 2000, tips: [2, '#CB5B5B'] });
			        $('#cet4 .id_num').focus();
			        return false;
			    }
			    // 姓名不能为空
				if($name == '' || $name.length <= 0) {
					layer.tips('姓名不能为空', '#cet4 .name', { time: 2000, tips: [2, '#CB5B5B'] });
			        $('#cet4 .name').focus();
			        return false;
				}
				return true;
			});

			$('#cet6').submit(function() {
				// 表单验证
				var $ad_ticket = $('#cet6 input[name="admission_ticket"]').val(),
					$id_num = $('#cet6 input[name="id_num"]').val(),
					$name = $('#cet6 input[name="name"]').val(),
					reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;

				if(($ad_ticket == '' || $ad_ticket.length <= 0) && ($id_num == '' || $id_num.length <=0)) {
					layer.tips('准考证和身份证至少填写一项', '#cet6 .ad_ticket', { time: 2000, tips: [2, '#CB5B5B'] });
		            $('#cet6 .ad_ticket').focus();
		            return false;
				} else if (!($id_num == '' || $id_num.length <=0) && reg.test($id_num) === false) {
		            layer.tips('身份证格式错误', '#cet6 .id_num', { time: 2000, tips: [2, '#CB5B5B'] });
		            $('#cet6 .id_num').focus();
		            return false;
		        }

				if($name == '' || $name.length <= 0) {
					layer.tips('姓名不能为空', '#cet6 .name', { time: 2000, tips: [2, '#CB5B5B'] });
		            $('#cet6 .name').focus();
		            return false;
				}
				return true;
			});
		});
	</script>
</body>
</html>