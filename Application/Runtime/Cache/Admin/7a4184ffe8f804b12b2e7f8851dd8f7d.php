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
								<li><a href="<?php echo U('Article/index');?>">文章管理</a></li>
								<li><a href="<?php echo U('User/index');?>">管理员管理</a></li>
							</ul>
						</li>
						<?php if(is_array($menu_list)): foreach($menu_list as $key=>$vo): ?><li <?php if($vo['title'] == $menu_active): ?>class="active"<?php endif; ?>>
							<a href="<?php echo U($vo['title']);?>" class="icon-file-text"><?php echo ($vo["name"]); ?></a>
							<ul>
								<li <?php if($action == 'index'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Article/index');?>">文章管理</a></li>
								<li <?php if($action == 'addArticle'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Article/addArticle');?>">添加文章</a></li>
								<li <?php if($action == 'addNotice'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Article/addNotice');?>">添加公告</a></li>
								<li <?php if($action == 'listNotice'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Article/listNotice');?>">公告管理</a></li>
							</ul>
						</li><?php endforeach; endif; ?>

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
<style>
    .list_pic{
        width:50px;
        height:30px;
    }
</style>
<div class="admin">
    <form method="post">
        <div class="panel admin-panel">
            <div class="panel-head"><strong>文章列表</strong></div>
            <div class="padding border-bottom">
                <input type="button" class="button button-small checkall" name="checkall" checkfor="id" value="全选" />
                <a href="<?php echo U('Article/addArticle');?>" class="button button-small border-green">添加文章</a>
                <a href="" class="button button-small border-yellow">批量删除</a>
                <a href="" class="button button-small border-blue">回收站</a>
            </div>
            <table class="table table-hover">
                <tr>
                    <th width="45">选择</th>
                    <th width="*">标题</th>
                    <th width="120">所属板块</th>
                    <th width="120">状态</th>
                    <th width="200">添加时间</th>
                    <th width="100">操作</th>
                </tr>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td>
                            <input type="checkbox" name="id" value="<?php echo ($vo["id"]); ?>" />
                        </td>
                        <td><?php echo ($vo["article_title"]); ?></td>
                        <td><?php if($vo['article_type'] == 1): ?>文章<?php else: ?>公告<?php endif; ?></td>
                        <td>
                            <?php switch($vo["article_status"]): case "1": ?>正常<?php break;?>
                                <?php default: ?>关闭<?php endswitch;?>
                        </td>
                        <td><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></td>
                        <td><a class="button border-blue button-little" href="<?php echo U('Article/editArticle',array('id'=>$vo['id']));?>">修改</a> <a class="button border-yellow button-little" href="<?php echo U('Article/dropArticle',array('id'=>$vo['id']));?>" onclick="{if(confirm('确认删除?')){return true;}return false;}">删除</a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <div class="panel-foot text-center">
                <ul class="pagination">
                    <li><a href="#">上一页</a></li>
                </ul>
                <ul class="pagination pagination-group">
                    <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                </ul>
                <ul class="pagination">
                    <li><a href="#">下一页</a></li>
                </ul>
            </div>
        </div>
    </form>
</div>
</body>

</html>