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
<style>
    .list_pic{
        width:50px;
        height:30px;
    }
</style>
<div class="admin">
    <form method="post" action="<?php echo U('System/index');?>" id="info_form" enctype="multipart/form-data" >
        <div class="panel admin-panel">
            <div class="panel-head"><strong>系统设置</strong></div>
            <table class="table table-hover">
                <tr>
                    <td><?php echo ($list["domain"]["name"]); ?></td>
                    <td><input type="text" class="input" id="<?php echo ($list["domain"]["key"]); ?>" name="<?php echo ($list["domain"]["key"]); ?>" size="50" value="<?php echo ($list["domain"]["value"]); ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo ($list["title"]["name"]); ?></td>
                    <td><input type="text" class="input" id="<?php echo ($list["title"]["key"]); ?>" name="<?php echo ($list["title"]["key"]); ?>" size="50" value="<?php echo ($list["title"]["value"]); ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo ($list["keyword"]["name"]); ?></td>
                    <td><input type="text" class="input" id="<?php echo ($list["keyword"]["key"]); ?>" name="<?php echo ($list["keyword"]["key"]); ?>" size="50" value="<?php echo ($list["keyword"]["value"]); ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo ($list["description"]["name"]); ?></td>
                    <td><input type="text" class="input" id="<?php echo ($list["description"]["key"]); ?>" name="<?php echo ($list["description"]["key"]); ?>" size="50" value="<?php echo ($list["description"]["value"]); ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo ($list["logo"]["name"]); ?></td>
                    <td>
                        <a class="button input-file" href="javascript:void(0);">+ 浏览文件<input size="100" type="file" id="logo" name="logo" data-validate="regexp#.+.(jpg|jpeg|png|gif)$:只能上传jpg|gif|png格式文件" /></a>
                        <?php if(!empty($list["logo"]["value"])): ?><img src="/Upload/images/common/<?php echo ($list["logo"]["value"]); ?>" width="100px" height="80px" /><?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo ($list["watermark"]["name"]); ?></td>
                    <td>
                        <a class="button input-file" href="javascript:void(0);">+ 浏览文件<input size="100" type="file" id="watermark" name="watermark" data-validate="regexp#.+.(jpg|jpeg|png|gif)$:只能上传jpg|gif|png格式文件" /></a>
                        <?php if(!empty($list["watermark"]["value"])): ?><img src="/Upload/images/common/<?php echo ($list["watermark"]["value"]); ?>" width="100px" height="80px" /><?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="form-button">
            <button class="button bg-main" type="submit">提交</button>
        </div>
    </form>
</div>
</body>

</html>