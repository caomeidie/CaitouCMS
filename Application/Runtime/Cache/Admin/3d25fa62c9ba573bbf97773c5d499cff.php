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
<div class="admin">
    <div class="tab">
        <div class="tab-head">
            <ul class="tab-nav">
                <li class="active"><a href="#tab-base">添加用户</a></li>
            </ul>
        </div>
        <form method="post" class="form-x" action="<?php echo U('User/addUser');?>">
            <div class="tab-body">
                <br />
                <div class="tab-panel active" id="tab-base">
                    <div class="form-group">
                        <div class="label">
                            <label for="admin_name">用户名</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" id="admin_name" name="admin_name" size="50" placeholder="请填写用户名" data-validate="required:请填写用户名" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="group">所属用户组</label>
                        </div>
                        <div class="field">
                            <select name="group" id="group">
                                <option value="0">请选择</option>
                                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["group_id"]); ?>"><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="password">初始密码</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" id="password" name="password" placeholder="请填写初始密码" data-validate="required:请填写初始密码" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="repeat_password">确认初始密码</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" id="repeat_password" name="repeat_password" placeholder="请填写确认初始密码" data-validate="required:请填写确认初始密码" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="mobile">手机号</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" id="mobile" name="mobile" placeholder="请填写手机号" data-validate="mobile:手机格式有误" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>状态</label>
                        </div>
                        <div class="field">
                            <div class="button-group button-group-small radio">
                                <label class="button active">
                                    <input name="status" value="1" checked="checked" type="radio"><span class="icon icon-check"></span> 开启</label>
                                <label class="button">
                                    <input name="status" value="0" type="radio"><span class="icon icon-times"></span> 关闭</label>
                            </div>
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
    $('.form-x').submit(function(){
        if($("#password").val() != $("#repeat_password").val()){
            alert('确认初始密码有误！');
            return false;
        }
    });
</script>
</body>

</html>