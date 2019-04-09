	// 导航栏切换
	$('#nav li a').click(function() {
	    $(this).parent().addClass('selected').siblings().removeClass('selected');
	});

	//检查用户是否登录
	function checklogin() {
	    if (empty($_SESSION['user'])) { //检查一下session是不是为空
	        if (empty($_COOKIE['id_num']) || empty($_COOKIE['password'])) { //如果session为空，并且用户没有选择记录登录状
	            header("location:login.php"); //转到登录页面，记录请求的url，登录后跳转过去，用户体验好。
	        }
	    }
	}


  