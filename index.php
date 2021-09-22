<!doctype html>
<?php
include("cls/clscsdl.php");
$p = new csdl;
$p->connectdb();
?>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="css/style.css" rel="stylesheet">
</head>
<body>
	<div id="container">
		<div id="banner">
			
				<h1>XYZ BANNER</h1>
		
		</div>
		<div id="menu">
			<a>Trang chủ</a>
			<a>Trang admin</a>
			
		</div>
		<div id="main">
			<div id="main-left">
			<?php
				$p->xuatcongty("select * from congty");	
			?>
			</div>
			<div id="main-right">
			<?php
				$congty = $_REQUEST['id'];
				if($congty!=''){
					$p->xuatsanpham("select * from sanpham where id_congty='$congty'");
				}
				else
				{
					$p->xuatsanpham("select * from sanpham");
				}
			?>
			</div>
		</div>
		<div id="footer"></div>
	</div>
</body>
</html>