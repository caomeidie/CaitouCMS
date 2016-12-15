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
		<link rel="stylesheet" href="/Public/admin/css/henry.css">
		<script src="/Public/admin/js/jquery.js"></script>
		<script src="/Public/admin/js/pintuer.js"></script>
		<script src="/Public/admin/js/admin.js"></script>
		<link rel="stylesheet" href="/Public/admin/sweetalert/sweetalert.css">
		<script src="/Public/admin/sweetalert/sweetalert.min.js"></script>
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
								<li><a href="<?php echo U('Article/index');?>">文章管理</a></li>
								<li><a href="<?php echo U('User/index');?>">管理员管理</a></li>
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
							<a href="<?php echo U('User/index');?>" class="icon-user">管理员</a>
							<ul>
								<li <?php if($action == 'index'): ?>class="active"<?php endif; ?>><a href="<?php echo U('User/index');?>">管理员列表</a></li>
								<li <?php if($action == 'addUser'): ?>class="active"<?php endif; ?>><a href="<?php echo U('User/addUser');?>">添加管理员</a></li>
								<li <?php if($action == 'listGroup'): ?>class="active"<?php endif; ?>><a href="<?php echo U('User/listGroup');?>">用户组管理</a></li>
								<li <?php if($action == 'addGroup'): ?>class="active"<?php endif; ?>><a href="<?php echo U('User/addGroup');?>">添加用户组</a></li>
								<li <?php if($action == 'listRule'): ?>class="active"<?php endif; ?>><a href="<?php echo U('User/listRule');?>">权限管理</a></li>
								<li <?php if($action == 'addRule'): ?>class="active"<?php endif; ?>><a href="<?php echo U('User/addRule');?>">添加权限</a></li>
								<li <?php if($action == 'listMenu'): ?>class="active"<?php endif; ?>><a href="<?php echo U('User/listMenu');?>">菜单管理</a></li>
								<li <?php if($action == 'addMenu'): ?>class="active"<?php endif; ?>><a href="<?php echo U('User/addMenu');?>">添加菜单</a></li>
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
<script type="text/javascript" charset="utf-8" src="/Public/admin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/admin/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/Public/admin/ueditor/lang/zh-cn/zh-cn.js"></script>
<div class="admin">
    <div class="tab">
        <div class="tab-head">
            <ul class="tab-nav">
                <li class="active"><a href="#tab-base">添加文章</a></li>
            </ul>
        </div>
        <form method="post" class="form-x" action="<?php echo U('Article/addArticle');?>" enctype="multipart/form-data" >
            <div class="tab-body">
                <br />
                <div class="tab-panel active" id="tab-base">
                    <div class="form-group">
                        <div class="label">
                            <label for="subtitle">标题</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" id="title" name="title" size="50" placeholder="请填写标题" data-validate="required:请填写标题" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="foods_name">概述</label>
                        </div>
                        <div class="field">
                            <textarea class="input" id="profile" name="profile" rows="5" cols="50" placeholder="概述"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>所属板块</label>
                        </div>
                        <div class="field">
                            <div class="button-group button-group-small radio">
                                <select name="type">
                                    <option value="1" selected>文章</option>
                                    <option value="2">公告</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="content">内容</label>
                        </div>
                        <div class="field">
                            <script id="editor" name="content" type="text/plain" style="width:100%;height:300px;"></script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-button">
                <button class="button bg-main" type="submit">提交</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var ue = UE.getEditor('editor');
</script>
</body>

</html>