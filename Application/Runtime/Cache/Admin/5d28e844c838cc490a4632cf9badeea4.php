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
<script type="text/javascript" charset="utf-8" src="/Public/admin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/admin/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/Public/admin/ueditor/lang/zh-cn/zh-cn.js"></script>
<div class="admin">
    <div class="tab">
        <div class="tab-head">
            <ul class="tab-nav">
                <li class="active"><a href="#tab-base">添加公告</a></li>
            </ul>
        </div>
        <form method="post" class="form-x" action="<?php echo U('Article/editNotice',array('id'=>$info['notice_id']));?>" >
            <div class="tab-body">
                <br />
                <div class="tab-panel active" id="tab-base">
                    <div class="form-group">
                        <div class="label">
                            <label for="notice_title">标题</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" id="notice_title" name="notice_title" value="<?php echo ($info["notice_title"]); ?>" size="50" placeholder="请填写标题" data-validate="required:请填写标题" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>状态</label>
                        </div>
                        <div class="field">
                            <div class="button-group button-group-small radio">
                                <label class="button <?php if($info["status"] == 1): ?>active<?php endif; ?>">
                                <input name="status" value="1" <?php if($info["status"] == 1): ?>checked="checked"<?php endif; ?>type="radio"><span class="icon icon-check"></span> 开启</label>
                                <label class="button <?php if($info["status"] == 0): ?>active<?php endif; ?>">
                                <input name="status" value="0" <?php if($info["status"] == 0): ?>checked="checked"<?php endif; ?>type="radio"><span class="icon icon-times"></span> 关闭</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>排序</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" id="sort" name="sort" size="50" placeholder="<?php echo ($info["sort"]); ?>" value="<?php echo ($info["sort"]); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="content">内容</label>
                        </div>
                        <div class="field">
                            <script id="content" name="content" type="text/plain" style="width:100%;height:300px;"></script>
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
    var ue = UE.getEditor('content');
    ue.addListener("ready", function () {
        ue.setContent('<?php echo ($info["content"]); ?>');
    });
</script>
</body>

</html>