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
<style>
    .list_pic{
        width:50px;
        height:30px;
    }
</style>
<div class="admin">
    <form method="post">
        <div class="panel admin-panel">
            <div class="panel-head"><strong>权限列表</strong></div>
            <div class="padding border-bottom">
                <a href="<?php echo U('Rule/addRule');?>" class="button button-small border-green">添加权限</a>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>权限名</th>
                    <th>权限</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                        <td><?php echo ($vo['_name']); ?></td>
                        <td><?php echo ($vo['title']); ?></td>
                        <td>
                            <a class="button border-blue button-little" href="<?php echo U('User/addRule',array('pid'=>$vo['id']));?>">添加子权限</a>
                            <a class="button border-blue button-little" href="<?php echo U('User/editRule',array('id'=>$vo['id']));?>">修改</a>
                            <a class="button border-blue button-little" href="javascript:if(confirm('确定删除？'))location='<?php echo U('User/dropRule',array('id'=>$vo['id']));?>'">删除</a>
                        </td>
                    </tr><?php endforeach; endif; ?>
            </table>
        </div>
    </form>
</div>
</body>

</html>