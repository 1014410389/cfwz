<?php
// 引入fun.php
include_once '../lib/fun.php';

// 连接数据库
$conn = mysqliInit('localhost', 'root', 'a34991321', 'cfwz');

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max($page, 1);
$pageSize = 15;

$offset = ($page - 1) * $pageSize;

// 从url获取数据库信息
$table = $_GET['table'];
$pk = $_GET['pk'];

if (!empty($table) && !empty($pk)) {
	// 四六级考试代号区分
	$exam_id = isset($_GET['exam_id']) ? $_GET['exam_id'] : null;

	// 获取数据总数
	if (isset($exam_id)) {
		$sql = "SELECT COUNT(`{$pk}`) AS total FROM `{$table}` WHERE `exam_id` = '{$exam_id}'";
	} else {
		$sql = "SELECT COUNT(`{$pk}`) AS total FROM `{$table}`";
	}
	$obj = mysqli_query($conn, $sql);
	$result = mysqli_fetch_array($obj);
	$total = isset($result['total']) ? $result['total'] : 0;
	unset($sql, $obj, $result);

	if (isset($exam_id)) {
		$sql = "SELECT * FROM `{$table}` WHERE `exam_id` = '{$exam_id}' ORDER BY `{$pk}` ASC LIMIT {$offset}, {$pageSize}";
	} else {
		$sql = "SELECT * FROM `{$table}` ORDER BY `{$pk}` ASC LIMIT {$offset}, {$pageSize}";
	}

	$obj = mysqli_query($conn, $sql);
	$array = array();

	while ($result = mysqli_fetch_assoc($obj)) {
		$array[] = $result;
	}

	$pages = pages($total, $page, $pageSize, 15);
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
					<i class="flat">+</i>考试
					<ul>
						<li class="second-list">
							<i class="flat">+</i>CET4
							<ul>
								<li><a href="admin_index.php?table=cet&pk=admission_ticket&exam_id=0101">用户成绩列表</a></li>
								<li><a href="add.php?table=cet&exam_id=0101&option=添加用户成绩">添加用户成绩</a></li>
							</ul>
						</li>
						<li class="second-list">
							<i class="flat">+</i>CET6
							<ul>
								<li><a href="admin_index.php?table=cet&pk=admission_ticket&exam_id=0102">用户成绩列表</a></li>
								<li><a href="add.php?table=cet&exam_id=0102&option=添加用户成绩">添加用户成绩</a></li>
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
				<table>
					<thead>
						<tr>
							<th>管理员号</th>
							<th>管理员姓名</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
		            <?php foreach ($array as $s): ?>
		            	<tr>
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
				<table>
					<thead>
						<tr>
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
				<table>
					<thead>
						<tr>
							<th>考试代号</th>
							<th>考试名称</th>
							<th>考试类型</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
		            <?php foreach ($array as $s): ?>
		            	<tr>
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
				<table>
					<thead>
						<tr>
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
				<table>
					<thead>
						<tr>
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
							<td><?php echo $s['username'] ?></td>
							<td><?php echo $s['qq'] ?></td>
							<td><?php echo $s['tel'] ?></td>
							<td><?php echo $s['email'] ?></td>
							<td><?php echo $s['feedback'] ?></td>
							<td><?php echo $s['sub_time'] ?></td>
							<td>
								<div class="btn">
			                        <a href="edit.php?table=feedback&pk=ID&value=<?php echo $s['ID'] ?>" class="edit">编辑</a>
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
	</script>
</body>
</html>