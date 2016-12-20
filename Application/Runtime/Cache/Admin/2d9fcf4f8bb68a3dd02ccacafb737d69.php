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
						<li <?php if(0 == $menu): ?>class="active"<?php endif; ?>>
							<a href="<?php echo U('Home/index');?>" class="icon-home"> 开始</a>
							<ul>
								<li <?php if($menu_active == 'Home/index'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Home/index', array('menu'=>0));?>">平台首页</a></li>
								<?php if(!empty($start_menu_list)): if(is_array($start_menu_list)): foreach($start_menu_list as $key=>$vo): ?><li><a href="<?php echo U($vo['title'], array('menu'=>$vo['pid']));?>"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; endif; ?>
							</ul>
						</li>
						<?php if(is_array($menu_list)): foreach($menu_list as $key=>$vo): ?><li <?php if($vo['id'] == $menu): ?>class="active"<?php endif; ?>>
							<a href="<?php echo U($vo['title'], array('menu'=>$vo['id']));?>" class="icon-file-text"><?php echo ($vo["name"]); ?></a>
							<ul>
								<?php if(is_array($vo["_data"])): foreach($vo["_data"] as $key=>$val): ?><li <?php if($menu_active == $val['title']): ?>class="active"<?php endif; ?>><a href="<?php echo U($val['title'], array('menu'=>$val['pid']));?>"><?php echo ($val["name"]); ?></a></li><?php endforeach; endif; ?>
							</ul>
						</li><?php endforeach; endif; ?>
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
    <form method="post">
        <div class="panel admin-panel">
            <div class="panel-head"><strong>用户组列表</strong></div>
            <div class="padding border-bottom">
                <a href="<?php echo U('User/addGroup');?>" class="button button-small border-green">添加用户组</a>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>用户组名</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                        <td><?php echo ($vo['title']); ?></td>
                        <td>
                            <a class="button border-blue button-little" href="<?php echo U('User/editGroup',array('id'=>$vo['group_id']));?>">修改</a>
                            <a class="button border-blue button-little" href="javascript:if(confirm('确定删除？'))location='<?php echo U('User/dropGroup',array('id'=>$vo['group_id']));?>'">删除</a>
                            <a class="button border-blue button-little" href="<?php echo U('User/allocateRule',array('id'=>$vo['group_id']));?>">分配权限</a>
                            <a class="button border-blue button-little" href="<?php echo U('User/allocateUser',array('id'=>$vo['group_id']));?>">添加成员</a>
                        </td>
                    </tr><?php endforeach; endif; ?>
            </table>
        </div>
    </form>
</div>
</body>

</html>