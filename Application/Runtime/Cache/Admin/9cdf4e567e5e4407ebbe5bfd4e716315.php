<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="renderer" content="webkit">
		<title>拼图后台管理-后台管理</title>
		<link rel="stylesheet" href="/Public/admin/css/pintuer.css">
		<link rel="stylesheet" href="/Public/admin/css/admin.css">
		<script src="/Public/admin/js/jquery.js"></script>
		<script src="/Public/admin/js/pintuer.js"></script>
		<script src="/Public/admin/js/admin.js"></script>
	</head>

	<body>
		<div class="lefter">
			<div class="logo">
				<a href="http://www.pintuer.com" target="_blank"><img src="/Public/admin/images/logo.png" alt="后台管理系统" /></a>
			</div>
		</div>
		<div class="righter nav-navicon" id="admin-nav">
			<div class="mainer">
				<div class="admin-navbar">
					<span class="float-right">
                    <a class="button button-little bg-main" href="" target="_blank">前台首页</a>
                    <a class="button button-little bg-yellow" href="<?php echo U('Index/logout');?>">注销登录</a>
                </span>
					<ul class="nav nav-inline admin-nav">
						<li <?php if(empty($controller)): ?>class="active"<?php endif; ?>>
							<a href="index.html" class="icon-home"> 开始</a>
							<ul>
								<li><a href="<?php echo U('Foods/listCuisine');?>">菜系管理</a></li>
								<li><a href="<?php echo U('Foods/index');?>">菜品管理</a></li>
								<li><a href="<?php echo U('Article/index');?>">文章管理</a></li>
								<li><a href="<?php echo U('User/index');?>">会员管理</a></li>
							</ul>
						</li>
						<li <?php if($controller == 'Foods'): ?>class="active"<?php endif; ?>>
							<a href="<?php echo U('Foods/index');?>" class="icon-cog">菜品</a>
							<ul>
								<li <?php if($action == 'index'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Foods/index');?>">菜品管理</a></li>
								<li <?php if($action == 'addFoods'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Foods/addFoods');?>">添加菜品</a></li>
								<li <?php if($action == 'addCuisine'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Foods/addCuisine');?>">添加菜系</a></li>
								<li <?php if($action == 'listCuisine'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Foods/listCuisine');?>">菜系管理</a></li>
							</ul>
						</li>
						<li <?php if($controller == 'Article'): ?>class="active"<?php endif; ?>>
							<a href="<?php echo U('Article/index');?>" class="icon-file-text">文章</a>
							<ul>
								<li <?php if($action == 'index'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Article/index');?>">文章管理</a></li>
								<li <?php if($action == 'addArticle'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Article/addArticle');?>">添加文章</a></li>
								<li <?php if($action == 'addNotice'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Article/addNotice');?>">添加公告</a></li>
								<li <?php if($action == 'listNotice'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Article/listNotice');?>">公告管理</a></li>
							</ul>
						</li>
						<li <?php if($controller == 'User'): ?>class="active"<?php endif; ?>>
							<a href="<?php echo U('User/index');?>" class="icon-user">会员</a>
							<ul>
								<li <?php if($action == 'index'): ?>class="active"<?php endif; ?>><a href="<?php echo U('User/index');?>">添加文章</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="admin-bread">
					<span>您好，admin，欢迎您的光临。</span>
					<ul class="bread">
						<li><a href="index.html" class="icon-home"> 开始</a></li>
						<li>后台首页</li>
					</ul>
				</div>
			</div>
		</div>
<div class="admin">
	<div class="tab">
		<div class="tab-head">
			<ul class="tab-nav">
				<li class="active"><a href="#tab-set">添加菜系</a></li>
			</ul>
		</div>
		<div class="tab-body">
			<br />
			<div class="tab-panel active" id="tab-set">
				<form method="post" class="form-x" action="<?php echo U('Foods/addCuisine');?>">
					<div class="form-group">
						<div class="label">
							<label>所属三大菜系</label>
						</div>
						<div class="field">
							<div class="button-group button-group-small radio">
								<label class="button active">
									<input name="cstyle" value="1" checked="checked" type="radio"><span class="icon icon-check"></span> 中国菜系</label>
								<label class="button">
									<input name="cstyle" value="2" type="radio"><span class="icon icon-check"></span> 法国菜系</label>
								<label class="button">
									<input name="cstyle" value="3" type="radio"><span class="icon icon-check"></span> 土耳其菜</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label">
							<label for="cname">菜系名称</label>
						</div>
						<div class="field">
							<input type="text" class="input" id="cname" name="cname" size="50" placeholder="菜系名称" data-validate="required:请填写菜系名称" />
						</div>
					</div>
					<div class="form-button">
						<button class="button bg-main" type="submit">提交</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>

</html>