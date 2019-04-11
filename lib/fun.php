<?php

/**
 * 数据库连接初始化
 * @param  [type] $host     主机名或IP地址
 * @param  [type] $username 用户名
 * @param  [type] $password 密码
 * @param  [type] $db_name  数据库名
 * @return [type]           $conn
 */
function mysqliInit(string $host, string $username, string $password, string $db_name) {
	// 设置主机名、服务器用户名、密码和要连接的数据库名
	$conn = mysqli_connect($host, $username, $password, $db_name);
	if (!$conn) {
		// 如果数据库不存在，返回false
		return false;
	}
	// 设置客户端字符集
	mysqli_set_charset($conn, 'utf8');
	return $conn;
}

/**
 * 加密密码
 * @param  [type] $password 密码
 * @return [type]           加密后的密码
 */
function createPassword($password) {
	if (is_null($password)) {
		return false;
	}
	return md5(md5($password . 'CFWZ'));
}

/**
 * 检查用户是否登陆
 * @return boolean true/false
 */
function checkLogin() {
	session_start();
	if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
		return false;
	}
	return true;
}

/**
 * 计算某个分数段的人数
 * @param  Number $min       分数段最小值
 * @param  Number $max       分数段最大值
 * @param  String $sum       总分
 * @param  String $exam_type 考试类型
 * @param  String $exam_id   考试代号
 * @param  Object $conn      数据库链接
 * @return String            人数
 */
function countScoreNum($min, $max, $sum, $exam_type, $exam_id, $conn) {
	if ($min == null || $min == 0) {
		$sql = "SELECT COUNT(`admission_ticket`) AS total FROM `{$exam_type}` WHERE {$sum} < 426 AND `exam_id` = '{$exam_id}'";
	} else if ($max == null) {
		$sql = "SELECT COUNT(`admission_ticket`) AS total FROM `{$exam_type}` WHERE {$sum} > 639 AND `exam_id` = '{$exam_id}'";
	} else {
		$sql = "SELECT COUNT(`admission_ticket`) AS total FROM `{$exam_type}` WHERE {$sum} >= '{$min}' AND {$sum} <= '{$max}' AND `exam_id` = '{$exam_id}'";
	}
	$obj = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($obj);
	$count = $result['total'];
	unset($sql, $obj, $result);
	return $count;
}

function countExamNum($exam_type, $exam_id, $conn) {
	$sql = "SELECT COUNT(`admission_ticket`) AS total FROM `{$exam_type}` WHERE `exam_id` = '{$exam_id}'";
	echo $sql;
	$obj = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($obj);
	$count = $result['total'];
	unset($sql, $obj, $result);
	return $count;
}

/**
 * 计算某项分数大于或小于用户的人数
 * @param  String $compare_type 选择大于'lt'或小于'st'
 * @param  String $exam_type    考试简称
 * @param  String $exam_part    考试项目
 * @param  String $score        用户个人分数
 * @param  String $exam_id      考试代号
 * @param  Object $conn         数据库链接
 * @return String               人数
 */
function countReferenceNum($compare_type, $exam_type, $exam_part, $score, $exam_id, $conn) {
	if ($compare_type == 'lt') {
		// 查找比$score分数更高的学生人数
		$sql = "SELECT COUNT(`admission_ticket`) AS total FROM `{$exam_type}` WHERE `{$exam_part}` > '{$score}' AND `exam_id` = '{$exam_id}'";
	} else if ($compare_type == 'st') {
		// 查找比$score分数更低的学生人数
		$sql = "SELECT COUNT(`admission_ticket`) AS total FROM `{$exam_type}` WHERE `{$exam_part}` < '{$score}' AND `exam_id` = '{$exam_id}'";
	}

	$obj = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($obj);
	$count = $result['total'];
	// 清除数据
	unset($sql, $obj, $result);
	return $count;
}

/**
 * 获取某项分数的最高和最低成绩
 * @param  String $type      选择最大'Max'或最小'Min'
 * @param  String $exam_part 考试项目名称
 * @param  String $exam_type 考试简称
 * @param  String $exam_id   考试代号
 * @param  Object $conn      数据库链接
 * @return String            最高和最低成绩
 */
function findMaxAndMin($type, $exam_part, $exam_type, $exam_id, $conn) {
	if ($type == 'Max') {
		// 获取某项内容最高分数
		$sql = "SELECT Max(`{$exam_part}`) FROM `{$exam_type}` WHERE `exam_id` = '{$exam_id}'";
	} else if ($type == 'Min') {
		// 获取某项内容最低分数
		$sql = "SELECT Min(`{$exam_part}`) FROM `{$exam_type}` WHERE `exam_id` = '{$exam_id}'";
	}
	// echo $sql;
	$obj = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($obj);
	$score = $type == 'Max' ? $result["Max(`{$exam_part}`)"] : $result["Min(`{$exam_part}`)"];
	// 清除数据
	unset($sql, $obj, $result);
	return $score;
}

function unsetSession($s1, $s2) {
	unset($_SESSION[$s1]);
	unset($_SESSION[$s2]);
	sleep(1);
	header('../login.php');
}

/**
 * 获取当前url
 * @return [type] [description]
 */
function getUrl() {
	$url = '';
	$url .= $_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://';
	$url .= $_SERVER['HTTP_HOST'];
	$url .= $_SERVER['REQUEST_URI'];
	return $url;
}

/**
 * 根据page生成url
 * @param  [type] $page [description]
 * @param  string $url  [description]
 * @return [type]       [description]
 */
function pageUrl($page, $url = '') {
	$url = empty($url) ? getUrl() : $url;
	// 查询url是否存在?
	$pos = strpos($url, '?');
	if ($pos === false) {
		$url .= '?page=' . $page;
	} else {
		$queryString = substr($url, $pos + 1);
		// 解析queryString为数组
		parse_str($queryString, $queryArray);
		if (isset($queryArray['page'])) {
			unset($queryArray['page']);
		}

		$queryArray['page'] = $page;
		// 将queryArray重新拼接成queryString
		$str = http_build_query($queryArray);
		$url = substr($url, 0, $pos) . '?' . $str;
	}
	return $url;
}

/**
 * 分页显示
 * @param  int $total 数据总数
 * @param  int $currentPage 当前页
 * @param  int $pageSize 每页显示条数
 * @param  int $show 显示按钮数
 * @return string
 */
function pages($total, $currentPage, $pageSize, $show = 6) {
	$pageStr = '';
	//仅当总数大于每页显示条数 才进行分页处理
	if ($total > $pageSize) {
		//总页数
		$totalPage = ceil($total / $pageSize); //向上取整 获取总页数
		//对当前页进行处理
		$currentPage = $currentPage > $totalPage ? $totalPage : $currentPage;
		//分页起始页
		$from = max(1, ($currentPage - intval($show / 2)));
		//分页结束页
		$to = $from + $show - 1;
		$pageStr .= '<div class="page-nav">';
		$pageStr .= '<ul>';
		//仅当 当前页大于1的时候 存在 首页和上一页按钮
		if ($currentPage > 1) {
			$pageStr .= "<li><a href='" . pageUrl(1) . "'>首页</a></li>";
			$pageStr .= "<li><a href='" . pageUrl($currentPage - 1) . "'>上一页</a></li>";
		}
		//当结束页大于总页
		if ($to > $totalPage) {
			$to = $totalPage;
			$from = max(1, $to - $show + 1);
		}
		if ($from > 1) {
			$pageStr .= '<li>...</li>';
		}
		for ($i = $from; $i <= $to; $i++) {
			if ($i != $currentPage) {
				$pageStr .= "<li><a href='" . pageUrl($i) . "'>{$i}</a></li>";
			} else {
				$pageStr .= "<li><span class='curr-page'>{$i}</span></li>";
			}
		}
		if ($to < $totalPage) {
			$pageStr .= '<li>...</li>';
		}
		if ($currentPage < $totalPage) {
			$pageStr .= "<li><a href='" . pageUrl($currentPage + 1) . "'>下一页</a></li>";
			$pageStr .= "<li><a href='" . pageUrl($totalPage) . "'>尾页</a></li>";
		}
		$pageStr .= '</ul>';
		$pageStr .= '</div>';

	}
	return $pageStr;
}
