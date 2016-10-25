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
<script type="text/javascript" charset="utf-8" src="/Public/admin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/admin/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/Public/admin/ueditor/lang/zh-cn/zh-cn.js"></script>
<style>
.list_pic{
	width:50px;
	height:30px;
}
</style>
<div class="admin">
	<div class="tab">
		<div class="tab-head">
			<ul class="tab-nav">
				<li class="active"><a href="#tab-base">基本信息</a></li>
				<li><a href="#tab-ready">准备阶段</a></li>
				<li><a href="#tab-doing">制作阶段</a></li>
				<li><a href="#tab-store">存储阶段</a></li>
			</ul>
		</div>
		<form method="post" class="form-x" action="<?php echo U('Foods/editFoods',array('id'=>$info['id']));?>" enctype="multipart/form-data" >
			<div class="tab-body">
				<br />
				<div class="tab-panel active" id="tab-base">
					<div class="form-group">
						<div class="label">
							<label for="subtitle">标题</label>
						</div>
						<div class="field">
							<input type="text" value="<?php echo ($info["title"]); ?>" class="input" id="title" name="title" size="50" placeholder="请填写标题" data-validate="required:请填写标题" />
						</div>
					</div>
					<div class="form-group">
						<div class="label">
							<label for="foods_name">菜品名称</label>
						</div>
						<div class="field">
							<input type="text" value="<?php echo ($info["foods_name"]); ?>" class="input" id="foods_name" name="foods_name" size="50" placeholder="菜品名称" data-validate="required:请填写菜品的名称" />
						</div>
					</div>
					<div class="form-group">
						<div class="label">
							<label>所属菜系</label>
						</div>
						<div class="field">
							<div class="button-group button-group-small select">
								<select name="cuisines_id">
								<?php if(is_array($cuisines)): $i = 0; $__LIST__ = $cuisines;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo["id"] == $info.cuisines_id): ?>selected<?php endif; ?>><?php echo ($vo["cname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label">
							<label>状态</label>
						</div>
						<div class="field">
							<div class="button-group button-group-small radio">
								<label class="button active">
									<input name="status" value="1" <?php if($info["status"] == 1): ?>checked="checked"<?php endif; ?> type="radio"><span class="icon icon-check"></span>正常</label>
								<label class="button">
									<input name="status" value="0" <?php if($info["status"] == 0): ?>checked="checked"<?php endif; ?> type="radio"><span class="icon icon-times"></span> 关闭</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label">
							<label for="cover">主图</label>
						</div>
						<div class="field">
							<a class="button input-file" href="javascript:void(0);">+ 浏览文件<input size="100" type="file" name="cover" /></a>
							<?php if($info['cover']): ?><img src="/Upload/images/foods/cover/<?php echo ($info['cover']); ?>" class="list_pic"><?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<div class="label">
							<label for="content">菜品详情</label>
						</div>
						<div class="field">
							<script id="editor" name="content" type="text/plain" style="width:100%;height:300px;"></script>
						</div>
					</div>
				</div>
				<div class="tab-panel" id="tab-ready">
					<div class="form-group">
						<div class="label">
							<label for="tools">所需工具</label>
						</div>
						<div class="field" id="tools_list">
							<div><input type="text" class="input line70" name="tools[]" size="50" placeholder="工具名" data-validate="required:请填写工具名" /><span id="add_tools">+</span></div>
						</div>
					</div>
					<div class="form-group">
						<div class="label">
							<label for="ingredient">主材</label>
						</div>
						<div class="field" id="ingredient_list">
							<div><input type="text" class="input line70" name="ingredient[]" size="50" placeholder="主材" data-validate="required:请填写主材" /><span id="add_ingredient">+</span></div>
						</div>
					</div>
					<div class="form-group">
						<div class="label">
							<label for="accessory">辅材</label>
						</div>
						<div class="field" id="accessory_list">
							<div><input type="text" class="input line70" name="accessory[]" size="50" placeholder="辅材" data-validate="required:请填写辅材" /><span id="add_accessory">+</span></div>
						</div>
					</div>
					<div class="form-group">
						<div class="label">
							<label for="pretreatment">预处理</label>
						</div>
						<div class="field">
							<textarea class="input" id="pretreatment" name="pretreatment" rows="5" cols="50" placeholder="预处理"></textarea>
						</div>
					</div>
				</div>
				<div class="tab-panel" id="tab-doing">
					<div class="form-group">
						<div class="label">
							<label for="pretreatment">步骤</label>
						</div>
						<div class="field" id="steps_list">
							<div>
							<input type="text" class="input line50" name="steps_time[]" size="50" placeholder="所需时间(分)" data-validate="required:请填写所需时间" /><span id="add_steps">+</span>
							<textarea class="input line50" name="steps[]" rows="3" cols="50" placeholder="步骤"></textarea>
							<br>
							<a class="button input-file" href="javascript:void(0);">+ 浏览文件<input size="100" type="file" name="steps_cover[]" data-validate="required:请选择上传文件,regexp#.+.(jpg|jpeg|png|gif)$:只能上传jpg|gif|png格式文件" /></a>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-panel" id="tab-store">
					<div class="form-group">
						<div class="label">
							<label for="store_condition">存储条件</label>
						</div>
						<div class="field" id="steps_list">
							<input type="text" class="input" name="store_condition" size="50" placeholder="存储条件" />
						</div>
					</div>
					<div class="form-group">
						<div class="label">
							<label for="store_time">存储时间</label>
						</div>
						<div class="field">
							<input type="text" class="input" name="store_time" size="50" placeholder="存储时间(时)" />
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
	ue.ready(function() {
	    var html = '<?php echo ($info["content"]); ?>';
	    ue.setContent(html);
	});

	$("#add_tools").click(function(){
		$("#tools_list").append('<div><input type="text" class="input line70" name="tools[]" size="50" placeholder="工具名" data-validate="required:请填写工具名" /><span class="drop_tools">-</span></div>');
	});
	$(document).on("click",".drop_tools",function(){
		$(this).parent().remove();
	});
	$("#add_ingredient").click(function(){
		$("#ingredient_list").append('<div><input type="text" class="input line70" name="ingredient[]" size="50" placeholder="主材" data-validate="required:请填写主材" /><span class="drop_ingredient">-</span></div>');
	});
	$(document).on("click",".drop_ingredient",function(){
		$(this).parent().remove();
	});
	$("#add_accessory").click(function(){
		$("#accessory_list").append('<div><input type="text" class="input line70" name="accessory[]" size="50" placeholder="辅材" data-validate="required:请填写辅材" /><span class="drop_accessory">-</span></div>');
	});
	$(document).on("click",".drop_accessory",function(){
		$(this).parent().remove();
	});
	$("#add_steps").click(function(){
		$("#steps_list").append('<div>\
				<input type="text" class="input line50" name="steps_time[]" size="50" placeholder="所需时间(分)" data-validate="required:请填写所需时间" /><span class="drop_steps">-</span>\
				<textarea class="input line50" name="steps[]" rows="3" cols="50" placeholder="步骤"></textarea>\
				<br><a class="button input-file" href="javascript:void(0);">+ 浏览文件<input size="100" type="file" name="steps_cover[]" data-validate="required:请选择上传文件,regexp#.+.(jpg|jpeg|png|gif)$:只能上传jpg|gif|png格式文件" /></a></div>');
	});
	$(document).on("click",".drop_steps",function(){
		$(this).parent().remove();
	});
</script>
</body>

</html>