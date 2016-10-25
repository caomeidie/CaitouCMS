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
<style>
.list_pic{
	width:50px;
	height:30px;
}
</style>
<div class="admin">
<form method="post">
<div class="panel admin-panel">
	<div class="panel-head"><strong>菜品列表</strong></div>
	<div class="padding border-bottom">
		<input type="button" class="button button-small checkall" name="checkall" checkfor="id" value="全选" />
		<a href="<?php echo U('Foods/addFoods');?>" class="button button-small border-green">添加菜品</a>
		<a href="" class="button button-small border-yellow">批量删除</a>
		<a href="" class="button button-small border-blue">回收站</a>
	</div>
	<table class="table table-hover">
		<tr>
			<th width="45">选择</th>
			<th width="*">标题</th>
			<th width="*">菜品名称</th>
			<th width="120">所属菜系</th>
			<th width="120">主图</th>
			<th width="120">状态</th>
			<th width="200">添加时间</th>
			<th width="100">操作</th>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td>
				<input type="checkbox" name="id" value="<?php echo ($vo["id"]); ?>" />
			</td>
			<td><?php echo ($vo["title"]); ?></td>
			<td><?php echo ($vo["foods_name"]); ?></td>
			<td><?php echo ($vo["cname"]); ?></td>
			<td><?php if($vo['cover']): ?><img src="/Upload/images/foods/cover/<?php echo ($vo['cover']); ?>" class="list_pic"><?php endif; ?></td>
			<td>
				<?php switch($vo["status"]): case "1": ?>正常<?php break;?>
				<?php default: ?>关闭<?php endswitch;?>
			</td>
			<td><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></td>
			<td><a class="button border-blue button-little" href="<?php echo U('Foods/editFoods',array('id'=>$vo['id']));?>">修改</a> <a class="button border-yellow button-little" href="<?php echo U('Foods/dropFoods',array('id'=>$vo['id']));?>" onclick="{if(confirm('确认删除?')){return true;}return false;}">删除</a></td>
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