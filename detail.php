<?php
// 引进fun.php
include_once './lib/fun.php';
// 开启SESSION
session_start();
$listening = $_SESSION['listening'];
$reading = $_SESSION['reading'];
$comprehensive = $_SESSION['comprehensive'];
$writing = $_SESSION['writing'];
$total = $_SESSION['total'];
$exam_id = $_SESSION['exam_id'];
$transcript_id = $_SESSION['transcript_id'];
$ad_ticket = $_SESSION['admission_ticket'];
$exam_date = $_SESSION['exam_date'];
$id_num = $_SESSION['identity_num'];
// 开启数据库
$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');
// 判断身份证号是否为空
if (!empty($id_num)) {
	$sql = "SELECT * FROM `user` WHERE `identity_num` = '{$id_num}'";
	$obj = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($obj);
	$department = $result['department'];
	$school = $result['school'];
	$name = $result['username'];
	// 关闭数据库连接
	mysqli_close($conn);
}
// 判断任意项是否为空，不为空时设置url参数为用户成绩数据，并且跳转到rank.php页面
if (!empty($listening)) {
	$url = './rank.php?id_num=' . $id_num . '&listening=' . $listening . '&reading=' . $reading .
		'&comprehensive=' . $comprehensive . '&writing=' . $writing . '&total=' . $total . '&exam_id=' . $exam_id;
} else {
	$url = './rank.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>成绩详情</title>
	<link rel="stylesheet" type="text/css" href="./static/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="./static/css/common.css">
	<link rel="stylesheet" type="text/css" href="./static/css/detail.css">
</head>
<body>
	<div class="login_wrap">
		<div id="container">
			<header id="header" class="noprint">
				<a href="./index.php" title="考试查分网站"><img src="./static/image/logo.png" alt=""><h1 id="logo">考试查分网站</h1></a>
			</header>
			<nav id="nav" class="noprint">
				<ul>
					<li><a href="./index.php" title="index.php">首页</a></li>
					<li><a href="./signup.php" title="考试报名">考试报名</a></li>
					<li><a href="./query.php" title="成绩查询">成绩查询</a></li>
					<!-- <li><a href="./rank.php" title="考试统计">考试统计</a></li> -->
					<li class="selected"><a href="./detail.php" title="成绩详情">成绩详情</a></li>
					<li><a href="./feedback.php" title="反馈">反馈</a></li>
				</ul>
			</nav>
			<content id="content">
				<div class="detail_container">
					<div class="score_detail noprint">
						<span>成绩详情</span>
						<ul class="detail_ul">
							<li>姓名： <?php echo $name ?></li>
							<li>学校： <?php echo $school ?></li>
							<li>听力成绩： <?php echo $listening ?></li>
							<li>阅读成绩： <?php echo $reading ?></li>
							<li>综合成绩： <?php echo $comprehensive ?></li>
							<li>写作和翻译： <?php echo $writing ?></li>
							<li>总分： <?php echo $total ?></li>
							<li class="hidden_msg">成绩单编号： <?php echo $transcript_id ?></li>
							<li class="hidden_msg">准考证号： <?php echo $ad_ticket ?></li>
							<li class="hidden_msg">身份证号： <?php echo $id_num ?></li>
							<li class="hidden_msg">考试时间： <?php echo $exam_date ?></li>
							<li class="hidden_msg">院系： <?php echo $department ?></li>
							<li class="hidden_msg exam_id"><?php echo $exam_id ?></li>
						</ul>
					</div>
					<div class="transcript">
						<div>成绩单示例</div>
						<canvas id="transcript_pic" class="print" width="500px" height="741px"></canvas>
						 <img class="pic_placeholder" src="./static/image/placeholder.png">
						<div>
							<button id="inputCanvas" onclick="drawImage()">输入数据</button>
							<button id="clearCanvas">清除数据</button>
							<button class="hide_transcript">展开</button>
						</div>
						<div class="mask"></div>
					</div>
					<div class="score_option noprint">
						<span>更多操作</span>
						<ul class="option_ul">
							<li><a href="#" title="成绩单打印" class="transcript_print">成绩单打印</a></li>
							<li><a href="#" title="成绩单保存" class="saveAsImg">成绩单保存</a></li>
							<li><a href="<?php echo $url ?>" title="成绩统计" class="rank">查看成绩统计</a></li>
							<li><a href="./signup.php" title="考试报名">考试报名</a></li>
							<li><a href="./query.php" title="返回查询">返回查询</a></li>
						</ul>
					</div>
				</div>
				<div class="clearfix"></div>
			</content>
		</div>
			<footer id="footer" class="noprint">
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
	<script type="text/javascript" src="./static/script/print.min.js"></script>
	<script>

/**
 * 绘制成绩单
 * @param  String canvasid canvas画布id
 * @param  String imgurl   成绩单图片路径
 * @return
 */
function drawTranscript(canvasid, imgurl) {
    var img = new Image;
    img.src = imgurl;
    img.onload = function() {
    	// 新建画布
        var canvas = document.getElementById(canvasid),
        	ctx = canvas.getContext("2d"),
        	$detail_li = $('.detail_ul li');
        // 设置画布格式
        ctx.drawImage(img, 0, 0, 500, 741);
        ctx.font = 'normal bold 16px 微软雅黑';
        ctx.fillStyle = "rgba(0,0,0,1)";
        // 分别获取各项成绩的数据
        var $name = $detail_li.eq(0).text().substring(4),
        	$school = $detail_li.eq(1).text().substring(4),
        	$listening = $detail_li.eq(2).text().substring(6),
			$reading = $detail_li.eq(3).text().substring(6),
			$comprehensive = $detail_li.eq(4).text().substring(6),
			$writing = $detail_li.eq(5).text().substring(7),
			$total = $detail_li.eq(6).text().substring(4),
			$transcript_id = $detail_li.eq(7).text().substring(7),
			$ad_ticket = $detail_li.eq(8).text().substring(6),
			$id_num = $detail_li.eq(9).text().substring(6),
			$exam_date_year = $detail_li.eq(10).text().substring(6,10),
			$exam_date_month = $detail_li.eq(10).text().substring(12,13),
			$department = $detail_li.eq(11).text().substring(4);
		// 选择位置
        ctx.fillText($name, 140, 260);
        ctx.fillText($school, 140, 294);
        ctx.fillText($department, 140, 328);
        ctx.fillText($ad_ticket, 140, 365);
        ctx.fillText($id_num, 140, 400);
        ctx.fillText($exam_date_year, 155, 434);
        ctx.fillText($exam_date_month, 245, 434);
        ctx.fillText($total, 100, 495);
        ctx.fillText($listening, 62, 564);
        ctx.fillText($reading, 130, 564);
        ctx.fillText($comprehensive, 205, 564);
        ctx.fillText($writing, 273, 564);
        ctx.fillText($transcript_id, 155, 612);
        // 清除画布
        var btn = document.getElementById('clearCanvas');
        btn.addEventListener('click', function() {
            ctx.clearRect(0, 0, 500, 741);
            ctx.drawImage(img, 0, 0, 500, 741);
        });
    };
}

	    var $exam_id = $('.exam_id').text();
	    function drawImage() {
		    if(!($exam_id == '' || $exam_id.length <= 0)) {
		    	$('.pic_placeholder').hide();
		    	$('#transcript_pic').show();
		    	if($exam_id == '0101') {
		    		drawTranscript('transcript_pic', './static/image/exam/cet4.jpg');
		    	} else if ($exam_id == '0102') {
		    		drawTranscript('transcript_pic', './static/image/exam/cet6.jpg');
		    	}
		    }
	    }

	    $('.transcript .hide_transcript').toggle(function() {
	    	$('.detail_container').animate({
	    		height: '950px'
	    	}, 1000);
	    	$('.transcript .hide_transcript').html('收起');
	    }, function() {
	    	$('.detail_container').animate({
	    		height: '587px'
	    	}, 1000);
	    	$('.transcript .hide_transcript').html('展开');
	    });

	    $(function() {
	    	drawImage();
	    	// 提醒用户进行成绩查询
	    	var arr = [$('#inputCanvas'), $('#clearCanvas'), $('.transcript_print'), $('.saveAsImg'), $('.rank')],
	    		$exam_id = $('.exam_id').text();
    		for(var i = 0; i < arr.length; i++) {
    			let item = arr[i];
    			item.click(function() {
    				if($exam_id == '' || $exam_id.length <= 0) {
			    		layer.alert('请点击“成绩查询”以获取成绩详情');
			    		return false;
			    	} else {
			    		switch(item.selector) {
						case '.transcript_print':
							// $('#transcript_pic').siblings().hide();
							// $('.transcript').siblings().hide();
							// $('content').siblings().hide();
							// $('footer').hide();
							// window.print();
							printJS({printable: 'static/image/test.png', type: 'image'});
							// myPrint(document.getElementById('transcript_pic'));
						  	break;
						case '.saveAsImg':
				 			exportCanvasAsPNG('transcript_pic','transcript');
						  	break;
						}
					}
    			});
    		}
	    });

	   	/**
	   	 * 将canvas保存为图片
	   	 * @param  String id       canvas元素的id
	   	 * @param  String fileName 保存的文件名
	   	 * @return
	   	 */
	    function exportCanvasAsPNG(id, fileName) {
		    var canvasElement = document.getElementById(id),
		    	imgURL = canvasElement.toDataURL("image/png"),
		    	link = document.createElement('a');
		    // 新建链接并将download属性设置为canvas的路径
		    link.download = fileName;
		    link.href = imgURL;
		    link.dataset.downloadurl = ["image/png", link.download, link.href].join(':');
		    document.body.appendChild(link);
		    link.click();
		    document.body.removeChild(link);
		}

	</script>
</body>
</html>