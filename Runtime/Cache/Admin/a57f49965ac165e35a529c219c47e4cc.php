<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>后台管理</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="/web/Public/css/style.css">

</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo U('index');?>">
      后台管理
      </a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
           <li><a href="<?php echo U('category');?>">栏目管理</a></li>
          <li><a href="<?php echo U('task');?>">任务管理</a></li>
           <li><a href="<?php echo U('article');?>">文章管理</a></li>
           <li><a href="<?php echo U('member');?>">会员管理</a></li>
           <li><a href="<?php echo U('comment');?>">评论管理</a></li>
           <li><a href="<?php echo U('config');?>">网站设置</a></li>
           <li><a href="/web">网站首页</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo ($_SESSION['admin']['name']); ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo U('Login/logout');?>">退出</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="list-header">
        <span class="list-title">会员管理</span>
      </div>
      <div class="list-body">
        <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
         <tr>
            <th>昵称</th>
            <th>邮箱</th>
            <th>手机号</th>
            <th>班级</th>  
            <th>审核</th>
            <th>注册时间</th>
            <th>上次登录</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
        <?php if(is_array($mlist)): $i = 0; $__LIST__ = $mlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <th scope="row"><?php echo ($vo["name"]); ?></th>
            <td><?php echo ($vo["email"]); ?></td>
            <td><a href="tel:<?php echo ($vo["tel"]); ?>"><?php echo ($vo["tel"]); ?></a></td>
            <td><?php echo ($vo["class"]); ?></td>
            <td>
            <?php switch($vo["status"]): case "1": ?>已审核<?php break;?>
            <?php case "0": ?>未审核<?php break; endswitch;?>
            </td>
            <td><?php echo (date("y-m-d H:i",$vo["create_time"])); ?></td>
            <td><?php echo (date("y-m-d H:i",$vo["update_time"])); ?></td>
            <td>
            <?php switch($vo["status"]): case "0": ?><a href="javascript:void(0);" onclick="passMem(<?php echo ($vo["member_id"]); ?>)">通过</a><?php break;?>
            <?php case "1": ?><a href="javascript:void(0);" onclick="notPassMem(<?php echo ($vo["member_id"]); ?>);">取消</a><?php break; endswitch;?>
            &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="deleteMem(<?php echo ($vo["member_id"]); ?>);">删除</a></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
    </div>
      </div>
    </div>
  </div>

<div class="text-center">
  <?php echo ($mpage); ?>
</div>

  <hr class="drivers">
</div>

<script>
  function passMem (mid) {
    $.ajax({
      url:"<?php echo U('Index/passMem');?>",
      type:'get',
      data:{
        "mid":mid
      },
      success:function(data){
        if (data == 1) {
          alert('审核通过')
          location.href=location.href
        }else{
          alert('审核失败或者已经通过')
          location.href=location.href
        }
      }
    })
  }

  function notPassMem (mid) {
    $.ajax({
      url:"<?php echo U('Index/notPassMem');?>",
      type:'get',
      data:{
        "mid":mid
      },
      success:function(data){
        if (data == 1) {
          alert('修改成功')
          location.href=location.href
        }else{
          alert('审核失败或者已经不通过')
          location.href=location.href
        }
      }
    })
  }

  function deleteMem (mid) {
    $.ajax({
      url:"<?php echo U('Index/deleteMem');?>",
      type:'get',
      data:{
        "mid":mid
      },
      success:function(data){
         if (data == 1) {
          alert('删除成功')
          location.href=location.href
        }else{
          alert('删除失败')
          location.href=location.href
        }
      }
      
    })
  }

</script>

<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>