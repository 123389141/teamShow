<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>o(∩_∩)o </title>
	

	<style>.file-input-wrapper { overflow: hidden; position: relative; cursor: pointer; z-index: 1; }
	.file-input-wrapper input[type=file], .file-input-wrapper input[type=file]:focus, 
	.file-input-wrapper input[type=file]:hover { position: absolute; top: 0; left: 0; cursor: pointer; opacity: 0; filter: alpha(opacity=0); z-index: 99; outline: 0; }
	.file-input-name { margin-left: 8px; }
	
	</style>
	<link rel="stylesheet" href="js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css" id="style-resource-1">
	<link rel="stylesheet" href="css/font-icons/entypo/css/entypo.css" id="style-resource-2">
	<link rel="stylesheet" href="css/bootstrap-min.css" id="style-resource-4">
	<link rel="stylesheet" href="css/neon-core-min.css" id="style-resource-5">
	<link rel="stylesheet" href="css/neon-theme-min.css" id="style-resource-6">
	<link rel="stylesheet" href="css/neon-forms-min.css" id="style-resource-7">
	<link rel="stylesheet" href="css/erhuo.css" >
	
	<script type=text/javascript src="js/jquery-1.8.3.min.js"></script>
 	<script src="js/bootstrap.js"></script>
 	<script src="js/jquery.dataTables.js"></script>
 	
</head>
<?php require_once "class.db.Channel.php";
$db=new ChannelDB();
?>
<body class="page-body loaded" >
<div class="page-container123">
	<div class="row">
		<div class="col-sm-6">
			<a href="add.php" id="add_channel">添加个人信息</a>
		</div>
		<div class="col-sm-6" align="right">
				<input type="button"  id="select_but" onclick=document.getElementById("select_form").action='#' value="查询" style="display:none"/>
				<input type="reset" id="reset_but" value="刷新"/>
		</div>
	</div>
	<div class="row">
	<table class='table table-bordered linetable' id='channel_table'>
	<thead>
		<tr>
			<th width="10%">尊姓大名</th>
			<th width="10%">所属小组</th>
			<th width="20%">工作职责</th>
			<th width="30%">个人特长</th>
			<th width="10%">联系方式</th>
			<th width="10%">创建时间</th>
			<th width="10%">操作</th>
		</tr>
	</thead>			
	<tbody>	
	</tbody>
	</table>
	</div>
</div>
<script>
function setaction(n){
    document.getElementById("select_form").action=n;
    document.getElementById("select_form").submit();
}

function exec(){
	$('#select_but').trigger("click");
}
	
(function($){	
	$("#select_but").click(function(e){
		e.preventDefault();
		$.post("man.php?action=select",$("#select_form").serialize(),function(data){
			$("#channel_table").dataTable().fnClearTable(); 
			if(data!="[]"){
				$("#channel_table").dataTable().fnAddData(jQuery.parseJSON(data));
			};
		});
	});
	$("#reset_but").click(function(e){
		location.reload();
	});

	$("#channel_table").dataTable({
		"bPaginate": true, //开关，是否显示分页器
		"bFilter": false, //开关，是否显示表格的一些信息
		"bLengthChange": true, //开关，是否显示每页大小的下拉框	
		"aLengthMenu":[[-1, 10, 25, 50], [ "All",10, 25, 50]],
		"bSort": true, //开关，是否启用各列具有按列排序的功能
		"bAutoWidth": true, //自适应宽度
		"aaSorting": [5, "desc"],
		"sPaginationType": "full_numbers", //用于指定分页器风格
		"oLanguage": {
			"sProcessing": "正在加载中......",
			"sLengthMenu": "每页显示 _MENU_ 条记录",
			"sEmptyTable": "无查询结果数据！",
			"sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条数据",
			"sInfoEmpty": "共 _TOTAL_ 条数据",
			"oPaginate": {
				"sFirst": " 首页 ",
				"sPrevious": " 上一页 ",
				"sNext": " 下一页 ",
				"sLast": " 末页 "
				}
			} //多语言配置
		});
		//补充datatables样式
		$('#channel_table_info').addClass('col-xs-6');
		$('#channel_table_paginate').addClass('col-xs-6');
		//初始化页面数据
		$('#select_but').trigger("click");
		
})(jQuery);


</script>

</body>

