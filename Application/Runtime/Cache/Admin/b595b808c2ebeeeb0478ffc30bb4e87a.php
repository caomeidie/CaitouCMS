<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="renderer" content="webkit">
		<title>小馒头后台管理-管理员登录</title>
		<!--
        	作者：大火兔 1979788761@qq.com
        	时间：2015-11-17
        	描述：使用官网CSS/JS同步最新版
        -->
		<link rel="stylesheet" href="/Public/admin/css/pintuer.css">
		<link rel="stylesheet" href="/Public/admin/css/admin.css">
		<script src="/Public/admin/js/jquery.js"></script>
		<script src="/Public/admin/js/pintuer.js"></script>
		<script src="/Public/admin/js/admin.js"></script>
	</head>

	<body>
		<div class="container">
			<div class="line">
				<div class="xs6 xm4 xs3-move xm4-move">
					<br />
					<br />
					<div class="media media-y">
						<a href="http://www.pintuer.com" target="_blank"><img src="/Public/admin/images/logo.png" class="radius" alt="后台管理系统" /></a>
					</div>
					<br />
					<br />
					<form action="<?php echo U('Index/login');?>" method="post">
						<div class="panel">
							<div class="panel-head"><strong>登录小馒头后台管理系统</strong></div>
							<div class="panel-body" style="padding:30px;">
								<div class="form-group">
									<div class="field field-icon-right">
										<input type="text" class="input" name="admin" placeholder="登录账号" data-validate="required:请填写账号,length#>=5:账号长度不符合要求" />
										<span class="icon icon-user"></span>
									</div>
								</div>
								<div class="form-group">
									<div class="field field-icon-right">
										<input type="password" class="input" name="password" placeholder="登录密码" data-validate="required:请填写密码,length#>=6:密码长度不符合要求" />
										<span class="icon icon-key"></span>
									</div>
								</div>
								<div class="form-group">
									<div class="field">
										<input type="text" class="input" name="verify" placeholder="填写右侧的验证码" data-validate="required:请填写右侧的验证码" />
										<img src="<?php echo U('Index/verify');?>" width="80" height="32" class="passcode" id="captcha" />
									</div>
								</div>
							</div>
							<div class="panel-foot text-center">
								<input type="submit" value="立即登录后台" class="button button-block bg-main text-big" />
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
<SCRIPT type="text/javascript">
$(function(){
	var captcha_img = $('#captcha');
	var verifyimg = captcha_img.attr("src");
	captcha_img.click(function(){
	    if( verifyimg.indexOf('?')>0){
	        $(this).attr("src", verifyimg+'&random='+Math.random());
	    }else{
	        $(this).attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
	    }
	});
});
</SCRIPT>
</html>