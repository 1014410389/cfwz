<?php
// 导入fun.php
include_once './lib/fun.php';
// 开启SESSION
session_start();
// 获取考试成绩信息
$id_num = $_GET['id_num'];

if (empty($id_num)) {
	echo "<script>alert('没有成绩数据，请返回成绩查询');window.location.href='index.php'</script>";
}

$listening = $_GET['listening'];
$reading = $_GET['reading'];
$comprehensive = $_GET['comprehensive'];
$writing = $_GET['writing'];
$total = $_GET['total'];
$exam_id = $_GET['exam_id'];
$sum = '(`listening`+`reading`+`comprehensive`+`writing`)';
// 判断四六级类型
if ($exam_id == '0101' || $exam_id == '0102') {
	$exam_type = 'cet';
}
// 连接数据库
$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');

if ($id_num) {
	// 获取听力最高最低分数
	$maxListening = findMaxAndMin('Max', 'listening', $exam_type, $exam_id, $conn);
	$minListening = findMaxAndMin('Min', 'listening', $exam_type, $exam_id, $conn);
	// 获取听力分数大于用户的人数
	$ltListening = countReferenceNum('lt', $exam_type, 'listening', $listening, $exam_id, $conn);
	// 获取听力分数小于用户的人数
	$stListening = countReferenceNum('st', $exam_type, 'listening', $listening, $exam_id, $conn);

	// 获取阅读最高最低分数
	$maxReading = findMaxAndMin('Max', 'reading', $exam_type, $exam_id, $conn);
	$minReading = findMaxAndMin('Min', 'reading', $exam_type, $exam_id, $conn);
	// 获取阅读分数大于用户的人数
	$ltReading = countReferenceNum('lt', $exam_type, 'reading', $reading, $exam_id, $conn);
	// 获取阅读分数小于用户的人数
	$stReading = countReferenceNum('st', $exam_type, 'reading', $reading, $exam_id, $conn);

	// 获取综合最高最低分数
	$maxComprehensive = findMaxAndMin('Max', 'comprehensive', $exam_type, $exam_id, $conn);
	$minComprehensive = findMaxAndMin('Min', 'comprehensive', $exam_type, $exam_id, $conn);
	// 获取综合分数大于用户的人数
	$ltComprehensive = countReferenceNum('lt', $exam_type, 'comprehensive', $comprehensive, $exam_id, $conn);
	// 获取综合分数小于用户的人数
	$stComprehensive = countReferenceNum('st', $exam_type, 'comprehensive', $comprehensive, $exam_id, $conn);

	// 获取写作和翻译最高最低分数
	$maxWriting = findMaxAndMin('Max', 'writing', $exam_type, $exam_id, $conn);
	$minWriting = findMaxAndMin('Min', 'writing', $exam_type, $exam_id, $conn);
	// 获取写作和翻译分数大于用户的人数
	$ltWriting = countReferenceNum('lt', $exam_type, 'writing', $writing, $exam_id, $conn);
	// 获取写作和翻译分数小于用户的人数
	$stWriting = countReferenceNum('st', $exam_type, 'writing', $writing, $exam_id, $conn);

	// 获取分数段人数
	// 获取低于426分的人数
	$st60p = countScoreNum(0, 425, $sum, $exam_type, $exam_id, $conn);
	$among70p = countScoreNum(426, 497, $sum, $exam_type, $exam_id, $conn);
	$among80p = countScoreNum(498, 568, $sum, $exam_type, $exam_id, $conn);
	$among90p = countScoreNum(569, 639, $sum, $exam_type, $exam_id, $conn);
	$lt90p = countScoreNum(640, null, $sum, $exam_type, $exam_id, $conn);

	// 计算考试总人数
	$totalNum = countExamNum($exam_type, $exam_id, $conn);
} else {
	$hasId = 0;
}
// 关闭数据库
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>成绩排行</title>
	<link rel="stylesheet" type="text/css" href="./static/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="./static/css/common.css">
	<link rel="stylesheet" type="text/css" href="./static/css/rank.css">
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
					<li><a href="./query.php" title="成绩查询">成绩查询</a></li>
					<li><a href="./signup.php" title="考试报名">考试报名</a></li>
					<!-- <li class="selected"><a href="./rank.php" title="考试统计">考试统计</a></li> -->
					<li><a href="./detail.php" title="成绩详情">成绩详情</a></li>
					<li><a href="./feedback.php" title="feedback.php">反馈</a></li>
				</ul>
			</nav>
			<content id="content">
				<div class="echarts_container">
					<div class="exam_select" style="display: none">
						<form action="rank.php" method="get" accept-charset="utf-8">
							<div class="exam_select_title">
								考试信息
								<!-- <div><span class="hide_left"><<收起</span></div> -->
							</div>
							<table>
								<tbody>
									<tr class="table_placeholder"><td></td></tr>
									<tr>
										<td class="label">考试名称：</td>
										<td><select name="exam_id" >
											<option value="0101">全国大学英语四级考试(CET4)</option>
											<option value="0102">全国大学英语六级考试(CET6)</option>
											<option value="0103">中小学教师资格考试(NTCE)</option>
											<option value="0104">全国计算机应用水平考试(NIT)</option>
										</select></td>
									</tr>
									<tr class="table_placeholder"><td></td></tr>
									<tr>
										<td class="label">考试成绩：</td>
										<td><input type="text" name="score"></td>
									</tr>
									<tr class="table_placeholder"><td><input type="hidden" id="hasId" value="<?php echo $hasId ?>"></td></tr>
									<tr>
										<td></td>
										<td><input type="submit" class="submit" name="submit" value="查询"><input type="reset" class="reset" name="reset" value="重置"></td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
					<div class="echarts">
						<div class="exam_select_title">
								统计信息
						</div>
						<div class="show_left"><span>展开>></span></div>
						<div class="clearfix"></div>
						<table>
							<thead>
								<tr>
									<th>图表</th>
									<th>详细</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><div id="form"></div></td>
									<td>
										<div>听力成绩总分为 249 分，本次考试最高分为 <span class="max_score"><?php echo $maxListening ?></span> 分，最低分为 <span class="min_score"><?php echo $minListening ?></span> 分，您的分数是 <span class="my_score"><?php echo $listening ?></span> 分，分数高于您的同学有 <?php echo $ltListening ?> 人，分数低于您的同学有 <?php echo $stListening ?> 人。
										</div>
										<div>阅读成绩总分为 249 分，本次考试最高分为 <span class="max_score"><?php echo $maxReading ?></span> 分，最低分为 <span class="min_score"><?php echo $minReading ?></span> 分，您的分数是 <span class="my_score"><?php echo $reading ?></span> 分，分数高于您的同学有 <?php echo $ltReading ?> 人，分数低于您的同学有 <?php echo $stReading ?> 人。
										</div>
										<div>综合成绩总分为 70 分，本次考试最高分为 <span class="max_score"><?php echo $maxComprehensive ?></span> 分，最低分为 <span class="min_score"><?php echo $minComprehensive ?></span> 分，您的分数是 <span class="my_score"><?php echo $comprehensive ?></span> 分，分数高于您的同学有 <?php echo $ltComprehensive ?> 人，分数低于您的同学有 <?php echo $stComprehensive ?> 人。
										</div>
										<div>写作和翻译成绩总分为 142 分，本次考试最高分为 <span class="max_score"><?php echo $maxWriting ?></span> 分，最低分为 <span class="min_score"><?php echo $minWriting ?></span> 分，您的分数是 <span class="my_score"><?php echo $writing ?></span> 分，分数高于您的同学有 <?php echo $ltWriting ?> 人，分数低于您的同学有 <?php echo $stWriting ?> 人。
										</div>
									</td>
								</tr>
								<tr>
									<td><div id="form2"></div></td>
									<td>
										<div>本次考试中，</div>
										<div>分数<span class="range">低于426分</span>的人数有<span class="range_num"><?php echo $st60p ?></span>人，占总人数的<span class="range_per"><?php echo round($st60p / $totalNum * 100) . "％" ?></span>
									</div><div>分数在<span class="range">426~497分</span>区间的人数有<span class="range_num"><?php echo $among70p ?></span>人，占总人数的<span class="range_per"><?php echo round($among70p / $totalNum * 100) . "％" ?></span></div><div>分数在<span class="range">498~568分</span>区间的人数有<span class="range_num"><?php echo $among80p ?></span>人，占总人数的<span class="range_per"><?php echo round($among70p / $totalNum * 100) . "％" ?></span></div><div>分数在<span class="range">569~639分</span>区间的人数有<span class="range_num"><?php echo $among90p ?></span>人，占总人数的<span class="range_per"><?php echo round($among90p / $totalNum * 100) . "％" ?></span></div><div>分数在<span class="range">640~710分</span>区间的人数有<span class="range_num"><?php echo $lt90p ?></span>人，占总人数的<span class="range_per"><?php echo round($lt90p / $totalNum * 100) . "％" ?></span>。</div>
									<div>
									</div>
									</td>
								</tr>
							</tbody>
						</table>
					<div class="clearfix"></div>

					<div></div>
				</div>
			</content>
			<div class="clearfix"></div>
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
	<script type="text/javascript" src="./static/script/common.js"></script>
	<script type="text/javascript" src="./static/script/echarts.js"></script>
	<script type="text/javascript" src="./static/script/layer/layer.js"></script>
	<script>
		var myChart = echarts.init(document.getElementById('form'));
		// 设置柱状图参数
	    var option = {
	        tooltip: {},
	        legend: {
	            data: ['最高分数', '您的分数', '最低分数']
	        },
	        // 设置X轴参数
	        xAxis: {
	            data: ['听力', '阅读', '综合', '写作和翻译']
	        },
	        yAxis: {},
	        // 使用PHP的echo输入数据
	        series: [{
	            name: '最高分数',
	            type: 'bar',
	            data: ['<?php echo $maxListening ?>', '<?php echo $maxReading ?>', '<?php echo $maxComprehensive ?>', '<?php echo $maxWriting ?>']
	        }, {
	        	name: '您的分数',
	            type: 'bar',
	            data: ['<?php echo $listening ?>', '<?php echo $reading ?>', '<?php echo $comprehensive ?>', '<?php echo $writing ?>']
	        }, {
	        	name: '最低分数',
	            type: 'bar',
	            data: ['<?php echo $minListening ?>', '<?php echo $minReading ?>', '<?php echo $minComprehensive ?>', '<?php echo $minWriting ?>']
	        }]
	    };
		// 应用参数
		myChart.setOption(option);

	    echarts.init(document.getElementById('form2')).setOption({
	         title : {
		        text: '分数分布',
		        x:'center'
		    },
		    tooltip : {
		        trigger: 'item',
		        formatter: "{a} <br/>{b} : {c} ({d}%)"
		    },
		    legend: {
		        orient: 'vertical',
		        left: 'left',
		        data: ['低于426分','426~497分','498~568分','569~639分','640~710分']
		    },
		    series : [
		        {
		            name: '分数分布',
		            type: 'pie',
		            radius : '80%',
		            center: ['50%', '55%'],
		           	label: {
		                normal: {
		                    position: 'inner'
		                }
		            },
		            data:[
		                {value:<?php echo $st60p ?>, name:'低于426分<?php if ($total <= 425) {echo '，您的位置在这';}?>'<?php if ($total <= 425) {echo ',selected:true';}?>},
		                {value:<?php echo $among70p ?>, name:'426~497分<?php if ($total >= 426 && $total <= 497) {echo '，您的位置在这';}?>'<?php if ($total >= 426 && $total <= 497) {echo ',selected:true';}?>},
		                {value:<?php echo $among80p ?>, name:'498~568分<?php if ($total >= 498 && $total <= 568) {echo '，您的位置在这';}?>'<?php if ($total >= 498 && $total <= 568) {echo ',selected:true';}?>},
		                {value:<?php echo $among90p ?>, name:'569~639分<?php if ($total >= 569 && $total <= 639) {echo '，您的位置在这';}?>'<?php if ($total >= 569 && $total <= 639) {echo ',selected:true';}?>},
		                {value:<?php echo $lt90p ?>, name:'640~710分<?php if ($total > 640) {echo '，您的位置在这';}?>'<?php if ($total > 640) {echo ',selected:true';}?>}
		            ],
		            itemStyle: {
		                emphasis: {
		                    shadowBlur: 10,
		                    shadowOffsetX: 0,
		                    shadowColor: 'rgba(0, 0, 0, 0.5)'
		                }
		            }
		        }
		    ]
	    });


	    $('.show_left').toggle(function() {
	    	$('.echarts').animate({
	    		height: '827px'
	    	}, 1000);
	    	$(this).text('收起>>');
	    },function() {
	    	$('.echarts').animate({
	    		height: '487px'
	    	}, 1000);
	    	$(this).text('展开>>');
	    });

	    $(function() {
	    // 判断是否由成绩详情页跳转过来
			var $hasId = $('#hasId').val();
			console.log($hasId);
			if($hasId == 0) {
				// layer.alert('目前用户成绩为空，点击成绩查询以获取更详细的成绩统计');
			}
	    })

	</script>
</body>
</html>