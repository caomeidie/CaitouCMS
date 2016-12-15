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
<style>
    .list_pic{
        width:50px;
        height:30px;
    }
</style>
<div class="admin">
    <form method="post" class="form-x" action="<?php echo U('User/allocateRule', array('id'=>$id));?>">
        <div class="panel admin-panel">
            <div class="panel-head"><strong>为[<?php echo ($group_data["title"]); ?>]分配权限</strong></div>
            <table class="table table-hover">
                <?php if(is_array($rule_data)): foreach($rule_data as $key=>$v): if(empty($v['_data'])): ?><tr class="b-group">
                            <th width="10%">
                                <label>
                                    <?php echo ($v['name']); ?>
                                    <input type="checkbox" name="rule_ids[]" value="<?php echo ($v['id']); ?>" <?php if(in_array($v['id'],$group_data['rules'])): ?>checked="checked"<?php endif; ?> class="checkAll" >
                                </label>
                            </th>
                            <td></td>
                        </tr>
                        <?php else: ?>
                        <tr class="b-group">
                            <th width="10%">
                                <label>
                                    <?php echo ($v['name']); ?> <input type="checkbox" name="rule_ids[]" value="<?php echo ($v['id']); ?>" <?php if(in_array($v['id'],$group_data['rules'])): ?>checked="checked"<?php endif; ?> class="checkAll">
                                </label>
                            </th>
                            <td class="b-child">
                                <?php if(is_array($v['_data'])): foreach($v['_data'] as $key=>$n): ?><table class="table table-striped table-bordered table-hover table-condensed">
                                        <tr class="b-group">
                                            <th width="12%">
                                                <label>
                                                    <?php echo ($n['name']); ?> <input type="checkbox" name="rule_ids[]" value="<?php echo ($n['id']); ?>" <?php if(in_array($n['id'],$group_data['rules'])): ?>checked="checked"<?php endif; ?> class="checkAll">
                                                </label>
                                            </th>
                                            <td>
                                                <?php if(!empty($n['_data'])): if(is_array($n['_data'])): $i = 0; $__LIST__ = $n['_data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><label>
                                                            &emsp;<?php echo ($c['name']); ?> <input type="checkbox" name="rule_ids[]" value="<?php echo ($c['id']); ?>" <?php if(in_array($c['id'],$group_data['rules'])): ?>checked="checked"<?php endif; ?> >
                                                        </label><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                            </td>
                                        </tr>
                                    </table><?php endforeach; endif; ?>
                            </td>
                        </tr><?php endif; endforeach; endif; ?>
            </table>
        </div>
        <div class="form-button">
            <button class="button bg-main" type="submit">提交</button>
        </div>
    </form>
</div>
<script>
    $('.checkAll').click(function(){
        if($(this).prop('checked')){
            $(this).parents('.b-group').first().find(':checkbox').each(function(){
                $(this).prop('checked', true);
            });
        }else{
            $(this).parents('.b-group').first().find(':checkbox').each(function(){
                $(this).prop('checked', false);
            });
        }

    });
</script>
</body>

</html>