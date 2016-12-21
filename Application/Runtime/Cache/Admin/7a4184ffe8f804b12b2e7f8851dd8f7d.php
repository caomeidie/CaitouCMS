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
    <form method="post" action="<?php echo U('Article/dropArticleBatch');?>" id="info_form">
        <div class="panel admin-panel">
            <div class="panel-head"><strong>文章列表</strong></div>
            <div class="padding border-bottom">
                <input type="button" class="button button-small checkall" name="checkall" checkfor="id[]" value="全选" />
                <a href="<?php echo U('Article/addArticle');?>" class="button button-small border-green">添加文章</a>
                <a class="button button-small border-yellow" id="dropBatch">批量删除</a>
            </div>
            <table class="table table-hover">
                <tr>
                    <th width="45">选择</th>
                    <th width="*">标题</th>
                    <th width="80">缩略图</th>
                    <th width="120">所属板块</th>
                    <th width="80">排序</th>
                    <th width="120">状态</th>
                    <th width="200">添加时间</th>
                    <th width="100">操作</th>
                </tr>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td>
                            <input type="checkbox" name="id[]" value="<?php echo ($vo["article_id"]); ?>" />
                        </td>
                        <td><?php echo ($vo["article_title"]); ?></td>
                        <td><img <?php if(!empty($vo["thumb"])): ?>src="/Upload/article/<?php echo ($vo["thumb"]); ?>"<?php else: ?>src="/Public/statics/images/default.jpg"<?php endif; ?> width="40px" height="30px" /></td>
                        <td><?php echo ($vo["column_name"]); ?></td>
                        <td><?php echo ($vo["sort"]); ?></td>
                        <td>
                            <?php switch($vo["status"]): case "1": ?>正常<?php break;?>
                                <?php default: ?>关闭<?php endswitch;?>
                        </td>
                        <td><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></td>
                        <td><a class="button border-blue button-little" href="<?php echo U('Article/editArticle',array('id'=>$vo['article_id']));?>">修改</a> <a class="button border-yellow button-little" href="<?php echo U('Article/dropArticle',array('id'=>$vo['article_id']));?>" onclick="{if(confirm('确认删除?')){return true;}return false;}">删除</a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <div class="panel-foot text-center page">
                <?php echo ($page); ?>
            </div>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#dropBatch').click(function(){
            if($("#info_form").find(':checkbox:checked').length <= 0){
                swal("", "请选择用户!", "error");
                return false;
            }else{
                swal({
                    title: "",
                    text: "您确定要删除吗？",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: true,
                    confirmButtonText: "确定",
                    confirmButtonColor: "#ec6c62"
                }, function() {
                    $("#info_form").submit();
                });
            }
        });
    })
</script>
</body>

</html>