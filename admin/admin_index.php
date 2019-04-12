<?php
// 引入fun.php
include_once '../lib/fun.php';
// 开启SESSION
session_start();
if ($_SESSION['admin'] == null) {
	echo "<script>alert('管理员还未登录，请登录');window.location.href='admin_login.php'</script>";
} else {
	$name = $_SESSION['admin']['admin_name'];
}

// 连接数据库
$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max($page, 1);
$pageSize = 14;

$offset = ($page - 1) * $pageSize;

// 从url获取数据库信息
$table = $_GET['table'];
$pk = $_GET['pk'];
// $searchText = $_GET['searchText'];
$keyword = $_GET['keyword'] ? $_GET['keyword'] : null;
if ($table == 'examination') {
	$where = $keyword ? "WHERE `exam_id` LIKE '%{$keyword}%' OR `exam_name` LIKE '%{$keyword}%' OR `exam_type` LIKE '%{$keyword}%'" : null;
} else if ($table == 'user') {
	$where = $keyword ? "WHERE `identity_num` LIKE '%{$keyword}%' OR `username` LIKE '%{$keyword}%' OR `cellphone_num` LIKE '%{$keyword}%' OR `department` LIKE '%{$keyword}%' OR `school` LIKE '%{$keyword}%'" : null;
} else if ($table == 'cet') {
	$where = $keyword ? "AND (`transcript_id` LIKE '%{$keyword}%' OR `listening` LIKE '%{$keyword}%' OR `reading` LIKE '%{$keyword}%' OR `comprehensive` LIKE '%{$keyword}%' OR `writing` LIKE '%{$keyword}%' OR `admission_ticket` LIKE '%{$keyword}%' OR `identity_num` LIKE '%{$keyword}%' OR `exam_date` LIKE '%{$keyword}%')" : null;
} else if ($table == 'administrator') {
	$where = $keyword ? "WHERE `admin_id` LIKE '%{$keyword}%' OR `admin_name` LIKE '%{$keyword}%'" : null;
} else if ($table == 'feedback') {
	$where = $keyword ? "WHERE `username` LIKE '%{$keyword}%' OR `qq` LIKE '%{$keyword}%' OR `tel` LIKE '%{$keyword}%' OR `email` LIKE '%{$keyword}%' OR `feedback` LIKE '%{$keyword}%' OR `sub_time` LIKE '%{$keyword}%'" : null;
}

$order = $_GET['order'] ? $_GET['order'] : null;
$orderBy = $order ? "ORDER BY " . $order : null;

if (!empty($table) && !empty($pk)) {
	// 四六级考试代号区分
	$exam_id = isset($_GET['exam_id']) ? $_GET['exam_id'] : null;

	// 获取数据总数
	if (isset($exam_id)) {
		$sql = "SELECT COUNT(`{$pk}`) AS total FROM `{$table}` WHERE `exam_id` = '{$exam_id}' {$where} {$orderBy}";
	} else {
		$sql = "SELECT COUNT(`{$pk}`) AS total FROM `{$table}` {$where} {$orderBy}";
	}
	$obj = mysqli_query($conn, $sql);
	$result = mysqli_fetch_array($obj);
	$total = isset($result['total']) ? $result['total'] : 0;
	unset($sql, $obj, $result);

	if (isset($exam_id)) {
		$sql = "SELECT * FROM `{$table}` WHERE `exam_id` = '{$exam_id}' {$where} {$orderBy} LIMIT {$offset}, {$pageSize}";
	} else {
		$sql = "SELECT * FROM `{$table}` {$where} {$orderBy} LIMIT {$offset}, {$pageSize}";
	}

	$obj = mysqli_query($conn, $sql);
	$array = array();

	while ($result = mysqli_fetch_assoc($obj)) {
		$array[] = $result;
	}

	$pages = pages($total, $page, $pageSize, 15);

	$obj = mysqli_query($conn, $sql);
	$array = array();

	while ($result = mysqli_fetch_assoc($obj)) {
		$array[] = $result;
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理员页</title>
	<link rel="stylesheet" type="text/css" href="../static/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="./static/css/admin_index.css">
</head>
<body>
	<header id="header">
		<img src="../static/image/logo.png"><h1>管理员页</h1>
	</header>
	<nav id="nav">
<!-- 		<ul>
			<li>当前位置：</li>
			<li><a href="#" title="">首页></a></li>
			<li><a href="#" title="">CET表></a></li>
			<li><a href="#" title="">个人成绩></a></li>
		</ul> -->
		<div class="admin_info" style="float: left; margin-left: 10px;font-weight: bold;">欢迎你，<?php echo $name; ?><a href="./admin_logout.php" style="margin-left: 10px;">登出</a></div>
		<div class="clearfix"></div>
	</nav>
	<content id="content">
		<div id="sidebar">
			<ul>
				<li class="first-list">
					<i class="flat">+</i>管理员
					<ul>
						<li><a href="admin_index.php?table=administrator&pk=admin_id">管理员列表</a></li>
						<li><a href="add.php?table=administrator&option=添加管理员">添加管理员</a></li>
					</ul>
				</li>
				<li class="first-list">
					<i class="flat">+</i>考试成绩
					<ul>
						<li class="second-list">
							<i class="flat">+</i>全国大学英语四级考试(CET4)
							<ul>
								<li><a href="admin_index.php?table=cet&pk=admission_ticket&exam_id=0101">用户成绩列表</a></li>
								<li><a href="add.php?table=cet&exam_id=0101&option=添加用户成绩">添加用户成绩</a></li>
							</ul>
						</li>
						<li class="second-list">
							<i class="flat">+</i>全国大学英语六级考试(CET6)
							<ul>
								<li><a href="admin_index.php?table=cet&pk=admission_ticket&exam_id=0102">用户成绩列表</a></li>
								<li><a href="add.php?table=cet&exam_id=0102&option=添加用户成绩">添加用户成绩</a></li>
							</ul>
						</li>
						<li class="second-list">
							<i class="flat">+</i>全国英语等级考试(PETS)
							<ul>
								<li><a href="#">用户成绩列表</a></li>
								<li><a href="#">添加用户成绩</a></li>
							</ul>
						</li>
						<li class="second-list">
							<i class="flat">+</i>全国外语水平考试(WSK)
							<ul>
								<li><a href="#">用户成绩列表</a></li>
								<li><a href="#">添加用户成绩</a></li>
							</ul>
						</li>
						<li class="second-list">
							<i class="flat">+</i>中小学教师资格考试(NTCE)
							<ul>
								<li><a href="#">用户成绩列表</a></li>
								<li><a href="#">添加用户成绩</a></li>
							</ul>
						</li>
						<li class="second-list">
							<i class="flat">+</i>医护英语水平考试(METS)
							<ul>
								<li><a href="#">用户成绩列表</a></li>
								<li><a href="#">添加用户成绩</a></li>
							</ul>
						</li>
						<li class="second-list">
							<i class="flat">+</i>全国计算机等级考试(NCRE)
							<ul>
								<li><a href="#">用户成绩列表</a></li>
								<li><a href="#">添加用户成绩</a></li>
							</ul>
						</li>
						<!-- 国外考试 -->
						<li class="second-list">
							<i class="flat">+</i>托福(TOEFL)
							<ul>
								<li><a href="#">用户成绩列表</a></li>
								<li><a href="#">添加用户成绩</a></li>
							</ul>
						</li>
						<li class="second-list">
							<i class="flat">+</i>德福(TestDaF)
							<ul>
								<li><a href="#">用户成绩列表</a></li>
								<li><a href="#">添加用户成绩</a></li>
							</ul>
						</li>
						<li class="second-list">
							<i class="flat">+</i>雅思(IELTS)
							<ul>
								<li><a href="#">用户成绩列表</a></li>
								<li><a href="#">添加用户成绩</a></li>
							</ul>
						</li>
						<li class="second-list">
							<i class="flat">+</i>美国研究生入学考试(GRE)
							<ul>
								<li><a href="#">用户成绩列表</a></li>
								<li><a href="#">添加用户成绩</a></li>
							</ul>
						</li>
						<li class="second-list">
							<i class="flat">+</i>韩国语能力考试(TOPIK)
							<ul>
								<li><a href="#">用户成绩列表</a></li>
								<li><a href="#">添加用户成绩</a></li>
							</ul>
						</li>
						<li class="second-list">
							<i class="flat">+</i>日本语能力测试(JLPT)
							<ul>
								<li><a href="#">用户成绩列表</a></li>
								<li><a href="#">添加用户成绩</a></li>
							</ul>
						</li>
						<li class="second-list">
							<i class="flat">+</i>剑桥商务英语(BEC)
							<ul>
								<li><a href="#">用户成绩列表</a></li>
								<li><a href="#">添加用户成绩</a></li>
							</ul>
						</li>
						<li class="second-list">
							<i class="flat">+</i>法语(DELF-DALF)
							<ul>
								<li><a href="#">用户成绩列表</a></li>
								<li><a href="#">添加用户成绩</a></li>
							</ul>
						</li>
						<li class="second-list">
							<i class="flat">+</i>剑桥少儿英语(CYLE)
							<ul>
								<li><a href="#">用户成绩列表</a></li>
								<li><a href="#">添加用户成绩</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li class="first-list">
					<i class="flat">+</i>考试类型
					<ul>
						<li><a href="admin_index.php?table=examination&pk=exam_id">考试类型列表</a></li>
						<li><a href="add.php?table=examination&option=添加考试类型">添加考试类型</a></li>
					</ul>
				</li>
				<li class="first-list">
					<i class="flat">+</i>用户
					<ul>
						<li><a href="admin_index.php?table=user&pk=identity_num">用户列表</a></li>
						<li><a href="add.php?table=user&option=添加用户">添加用户</a></li>
					</ul>
				</li>
				<li class="first-list">
					<i class="flat">+</i>反馈
					<ul>
						<li><a href="admin_index.php?table=feedback&pk=ID">反馈列表</a></li>
						<li></li>
					</ul>
				</li>
			</ul>
		</div>
		<div id="main">
			<div class="detail_content">
				<?php if ($table == 'administrator'): ?>
				<div class="option">
					<div class="option_left">
						<a href="add.php?table=administrator&option=添加管理员" class="add_data">添加</a>
					</div>
					<div class="option_right">
						<label>管理员号：</label>
						<select class="select_data" onchange="change(this.value)">
							<?php if ($_GET['order'] == 'admin_id ASC'): ?>
								<option value="">升序</option>
							<?php elseif ($_GET['order'] == 'admin_id DESC'): ?>
								<option value="">降序</option>
							<?php else: ?>
								<option value="">请选择</option>
							<?php endif;?>
							<option value="admin_id ASC">升序</option>
							<option value="admin_id DESC">降序</option>
						</select>
						<label>搜索：</label>
						<input id="searchText" type="text" name="administrator" onkeypress="search()">
					</div>
					<div class="clearfix"></div>
				</div>
				<table>
					<thead>
						<tr>
							<th></th>
							<th>管理员号</th>
							<th>管理员姓名</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
		            <?php foreach ($array as $s): ?>
		            	<tr>
		            		<td><input type="checkbox"></td>
							<td><?php echo $s['admin_id'] ?></td>
							<td><?php echo $s['admin_name'] ?></td>
							<td>
								<div class="btn">
			                        <a href="edit.php?table=administrator&pk=admin_id&value=<?php echo $s['admin_id'] ?>" class="edit">编辑</a>
			                        <a href="delete.php?table=administrator&pk=admin_id&value=<?php echo $s['admin_id'] ?>" class="del">删除</a>
		                    	</div>
		                    </td>
						</tr>
		            <li>
		            <?php endforeach;?>
		        	</tbody>
				</table>
				<?php elseif ($table == 'cet'): ?>
				<div class="option">
					<div class="option_left">
						<?php if ($exam_id == '0101'): ?>
							<a href="add.php?table=cet&exam_id=0101&option=添加用户成绩" class="add_data">添加</a>
						<?php elseif ($exam_id == '0102'): ?>
							<a href="add.php?table=cet&exam_id=0102&option=添加用户成绩" class="add_data">添加</a>
						<?php endif;?>
					</div>
					<div class="option_right">
						<label for="">听力：</label>
						<select class="select_data" onchange="change(this.value)">
							<?php if ($_GET['order'] == 'listening ASC'): ?>
								<option value="">升序</option>
							<?php elseif ($_GET['order'] == 'listening DESC'): ?>
								<option value="">降序</option>
							<?php else: ?>
								<option value="">请选择</option>
							<?php endif;?>
							<option value="listening ASC">升序</option>
							<option value="listening DESC">降序</option>
						</select>
						<label for="">阅读：</label>
						<select class="select_data" onchange="change(this.value)">
							<?php if ($_GET['order'] == 'reading ASC'): ?>
								<option value="">升序</option>
							<?php elseif ($_GET['order'] == 'reading DESC'): ?>
								<option value="">降序</option>
							<?php else: ?>
								<option value="">请选择</option>
							<?php endif;?>
							<option value="reading ASC">升序</option>
							<option value="reading DESC">降序</option>
						</select>
						<label for="">综合：</label>
						<select class="select_data" onchange="change(this.value)">
							<?php if ($_GET['order'] == 'comprehensive ASC'): ?>
								<option value="">升序</option>
							<?php elseif ($_GET['order'] == 'comprehensive DESC'): ?>
								<option value="">降序</option>
							<?php else: ?>
								<option value="">请选择</option>
							<?php endif;?>
							<option value="comprehensive ASC">升序</option>
							<option value="comprehensive DESC">降序</option>
						</select>
						<label for="">写作和阅读：</label>
						<select class="select_data" onchange="change(this.value)">
							<?php if ($_GET['order'] == 'writing ASC'): ?>
								<option value="">升序</option>
							<?php elseif ($_GET['order'] == 'writing DESC'): ?>
								<option value="">降序</option>
							<?php else: ?>
								<option value="">请选择</option>
							<?php endif;?>
							<option value="writing ASC">升序</option>
							<option value="writing DESC">降序</option>
						</select>
						<label for="">考试日期</label>
						<select class="select_data" onchange="change(this.value)">
							<?php if ($_GET['order'] == 'exam_date ASC'): ?>
								<option value="">升序</option>
							<?php elseif ($_GET['order'] == 'exam_date DESC'): ?>
								<option value="">降序</option>
							<?php else: ?>
								<option value="">请选择</option>
							<?php endif;?>
							<option value="exam_date ASC">升序</option>
							<option value="exam_date DESC">降序</option>
						</select>
						<label for="">搜索：</label>
						<?php if ($exam_id == '0101'): ?>
							<input id="searchText" type="text" name="cet4" onkeypress="search()">
						<?php elseif ($exam_id == '0102'): ?>
							<input id="searchText" type="text" name="cet6" onkeypress="search()">
						<?php endif;?>
					</div>
					<div class="clearfix"></div>
				</div>
				<table>
					<thead>
						<tr>
							<th></th>
							<th>考试代号</th>
							<th>成绩单号</th>
							<th>听力成绩</th>
							<th>阅读成绩</th>
							<th>综合成绩</th>
							<th>写作和翻译</th>
							<th>准考证号</th>
							<th>身份证号</th>
							<th>考试日期</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
		            <?php foreach ($array as $s): ?>
		            	<tr>
		            		<td><input type="checkbox"></td>
							<td><?php echo $s['exam_id'] ?></td>
							<td><?php echo $s['transcript_id'] ?></td>
							<td><?php echo $s['listening'] ?></td>
							<td><?php echo $s['reading'] ?></td>
							<td><?php echo $s['comprehensive'] ?></td>
							<td><?php echo $s['writing'] ?></td>
							<td><?php echo $s['admission_ticket'] ?></td>
							<td><?php echo $s['identity_num'] ?></td>
							<td><?php echo $s['exam_date'] ?></td>
							<td>
								<div class="btn">
			                        <a href="edit.php?table=cet&pk=admission_ticket&value=<?php echo $s['admission_ticket'] ?>" class="edit">编辑</a>
			                        <a href="delete.php?table=cet&pk=admission_ticket&value=<?php echo $s['admission_ticket'] ?>" class="del">删除</a>
		                    	</div>
		                    </td>
						</tr>
		            <li>
		            <?php endforeach;?>
		        	</tbody>
				</table>
				<?php elseif ($table == 'examination'): ?>
				<div class="option">
					<div class="option_left">
						<a href="add.php?table=examination&option=添加考试类型" class="add_data">添加</a>
					</div>
					<div class="option_right">
						<label for="">考试代号：</label>
						<select class="select_data" onchange="change(this.value)">
							<?php if ($_GET['order'] == 'exam_id ASC'): ?>
								<option value="">升序</option>
							<?php elseif ($_GET['order'] == 'exam_id DESC'): ?>
								<option value="">降序</option>
							<?php else: ?>
								<option value="">请选择</option>
							<?php endif;?>
							<option value="exam_id ASC">升序</option>
							<option value="exam_id DESC">降序</option>
						</select>
						<label for="">考试类型：</label>
						<select class="select_data" onchange="change(this.value)">
							<?php if ($_GET['order'] == 'exam_type ASC'): ?>
								<option value="">升序</option>
							<?php elseif ($_GET['order'] == 'exam_type DESC'): ?>
								<option value="">降序</option>
							<?php else: ?>
								<option value="">请选择</option>
							<?php endif;?>
							<option value="exam_type ASC">升序</option>
							<option value="exam_type DESC">降序</option>
						</select>
						<label for="">搜索：</label>
						<input id="searchText" type="text" name="examination" onkeypress="search()">
					</div>
					<div class="clearfix"></div>
				</div>
				<table>
					<thead>
						<tr>
							<th></th>
							<th>考试代号</th>
							<th>考试名称</th>
							<th>考试类型</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
		            <?php foreach ($array as $s): ?>
		            	<tr>
		            		<td><input type="checkbox"></td>
							<td><?php echo $s['exam_id'] ?></td>
							<td><?php echo $s['exam_name'] ?></td>
							<td><?php echo $s['exam_type'] ?></td>
							<td>
								<div class="btn">
			                        <a href="edit.php?table=examination&pk=exam_id&value=<?php echo $s['exam_id'] ?>" class="edit">编辑</a>
			                        <a href="delete.php?table=examination&pk=exam_id&value=<?php echo $s['exam_id'] ?>" class="del">删除</a>
		                    	</div>
		                    </td>
						</tr>
		            <li>
		            <?php endforeach;?>
		        	</tbody>
				</table>
				<?php elseif ($table == 'user'): ?>
				<div class="option">
					<div class="option_left">
						<a href="add.php?table=user&option=添加用户" class="add_data">添加</a>
					</div>
					<div class="option_right">
						<label for="">身份证号：</label>
						<select class="select_data" onchange="change(this.value)">
							<?php if ($_GET['order'] == 'identity_num ASC'): ?>
								<option value="">升序</option>
							<?php elseif ($_GET['order'] == 'identity_num DESC'): ?>
								<option value="">降序</option>
							<?php else: ?>
								<option value="">请选择</option>
							<?php endif;?>
							<option value="identity_num ASC">升序</option>
							<option value="identity_num DESC">降序</option>
						</select>
						<label for="">手机号码：</label>
						<select class="select_data" onchange="change(this.value)">
							<?php if ($_GET['order'] == 'cellphone_num ASC'): ?>
								<option value="">升序</option>
							<?php elseif ($_GET['order'] == 'cellphone_num DESC'): ?>
								<option value="">降序</option>
							<?php else: ?>
								<option value="">请选择</option>
							<?php endif;?>
							<option value="cellphone_num ASC">升序</option>
							<option value="cellphone_num DESC">降序</option>
						</select>
						<label for="">搜索：</label>
						<input id="searchText" type="text" name="user" onkeypress="search()">
					</div>
					<div class="clearfix"></div>
				</div>
				<table>
					<thead>
						<tr>
							<th></th>
							<th>身份证号</th>
							<th>姓名</th>
							<th>手机号码</th>
							<th>院系</th>
							<th>学校</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
		            <?php foreach ($array as $s): ?>
		            	<tr>
		            		<td><input type="checkbox"></td>
							<td><?php echo $s['identity_num'] ?></td>
							<td><?php echo $s['username'] ?></td>
							<td><?php echo $s['cellphone_num'] ?></td>
							<td><?php echo $s['department'] ?></td>
							<td><?php echo $s['school'] ?></td>
							<td>
								<div class="btn">
			                        <a href="edit.php?table=user&pk=identity_num&value=<?php echo $s['identity_num'] ?>" class="edit">编辑</a>
			                        <a href="delete.php?table=user&pk=identity_num&value=<?php echo $s['identity_num'] ?>" class="del">删除</a>
		                    	</div>
		                    </td>
						</tr>
		            <li>
		            <?php endforeach;?>
		        	</tbody>
				</table>
				<?php elseif ($table == 'feedback'): ?>
				<div class="option">
					<div class="option_left">
					</div>
					<div class="option_right">
						<label for="">QQ:</label>
						<select class="select_data" onchange="change(this.value)">
							<?php if ($_GET['order'] == 'qq ASC'): ?>
								<option value="">升序</option>
							<?php elseif ($_GET['order'] == 'qq DESC'): ?>
								<option value="">降序</option>
							<?php else: ?>
								<option value="">请选择</option>
							<?php endif;?>
							<option value="qq ASC">升序</option>
							<option value="qq DESC">降序</option>
						</select>
						<label for="">手机号码：</label>
						<select class="select_data" onchange="change(this.value)">
							<?php if ($_GET['order'] == 'tel ASC'): ?>
								<option value="">升序</option>
							<?php elseif ($_GET['order'] == 'tel DESC'): ?>
								<option value="">降序</option>
							<?php else: ?>
								<option value="">请选择</option>
							<?php endif;?>
							<option value="tel ASC">升序</option>
							<option value="tel DESC">降序</option>
						</select>
						<label for="">反馈时间：</label>
						<select class="select_data" onchange="change(this.value)">
							<?php if ($_GET['order'] == 'sub_time ASC'): ?>
								<option value="">升序</option>
							<?php elseif ($_GET['order'] == 'sub_time DESC'): ?>
								<option value="">降序</option>
							<?php else: ?>
								<option value="">请选择</option>
							<?php endif;?>
							<option value="sub_time ASC">升序</option>
							<option value="sub_time DESC">降序</option>
						</select>
						<label for="">搜索：</label>
						<input id="searchText" type="text" name="feedback" onkeypress="search()">
					</div>
					<div class="clearfix"></div>
				</div>
				<table>
					<thead>
						<tr>
							<th></th>
							<th>用户名</th>
							<th>QQ</th>
							<th>手机号码</th>
							<th>邮箱</th>
							<th>反馈内容</th>
							<th>反馈时间</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
		            <?php foreach ($array as $s): ?>
		            	<tr>
		            		<td><input type="checkbox"></td>
							<td><?php echo $s['username'] ?></td>
							<td><?php echo $s['qq'] ?></td>
							<td><?php echo $s['tel'] ?></td>
							<td><?php echo $s['email'] ?></td>
							<td><?php echo $s['feedback'] ?></td>
							<td><?php echo $s['sub_time'] ?></td>
							<td>
								<div class="btn">
			                        <a href="delete.php?table=feedback&pk=ID&value=<?php echo $s['ID'] ?>" class="del">删除</a>
		                    	</div>
		                    </td>
						</tr>
		            <li>
		            <?php endforeach;?>
		        	</tbody>
				</table>
			<?php endif;?>
	    	</div>
	    	<div class="pages">
				<?php echo $pages; ?>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
	</content>
<!-- 	<footer id="footer">
		footer
	</footer> -->
	<script type="text/javascript" src="../static/script/jquery-1.10.2.min.js"></script>

	<script>
		<!-- 边栏效果 -->
		$('.flat').toggle(function() {
			$(this).siblings().children().show();
			$(this).text('-');
		},function() {
			$(this).siblings().children().hide();
			$(this).text('+');
		});

		$('.del').click(function() {
			var isDel = confirm('确定要删除这条记录吗？');
			if(isDel == true) {
				return true;
			} else {
				return false;
			}
		})

		function search() {
			if(event.keyCode == 13) {
				const searchText = document.getElementById('searchText');
				var val = searchText.value,
					table = searchText.name;
				if(table == 'examination') {
					window.location = 'admin_index.php?table=examination&pk=exam_id&keyword=' + val;
				} else if(table == 'user') {
					window.location = 'admin_index.php?table=user&pk=identity_num&keyword=' + val;
				} else if(table == 'cet4') {
					window.location = 'admin_index.php?table=cet&pk=admission_ticket&exam_id=0101&keyword=' + val;
				} else if(table == 'cet6') {
					window.location = 'admin_index.php?table=cet&pk=admission_ticket&exam_id=0102&keyword=' + val;
				} else if(table == 'administrator') {
					window.location = 'admin_index.php?table=administrator&pk=admin_id&keyword=' + val;
				} else if(table == 'feedback') {
					window.location = 'admin_index.php?table=feedback&pk=ID&keyword=' + val;
				}
			}
		}

		function change(val) {
			const searchText = document.getElementById('searchText');
			var table = searchText.name;
			if(table == 'examination') {
					window.location = 'admin_index.php?table=examination&pk=exam_id&order=' + val;
				} else if(table == 'user') {
					window.location = 'admin_index.php?table=user&pk=identity_num&order=' + val;
				} else if(table == 'cet4') {
					window.location = 'admin_index.php?table=cet&pk=admission_ticket&exam_id=0101&order=' + val;
				} else if(table == 'cet6') {
					window.location = 'admin_index.php?table=cet&pk=admission_ticket&exam_id=0102&order=' + val;
				} else if(table == 'administrator') {
					window.location = 'admin_index.php?table=administrator&pk=admin_id&order=' + val;
				} else if(table == 'feedback') {
					window.location = 'admin_index.php?table=feedback&pk=ID&order=' + val;
				}
		}
	</script>
</body>
</html>