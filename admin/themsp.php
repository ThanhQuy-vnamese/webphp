<?php
 session_start();
//echo $_SESSION['id'].$_SESSION['user'].$_SESSION['pass'].$_SESSION['phanquyen'];
 if(isset($_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['pass']) && isset($_SESSION['phanquyen'])){
	 include("../cls/clslogin.php");
	 $q = new quanlydangnhap();
	 $q->confirmlogin($_SESSION['id'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['phanquyen']);
 }
else{
	header("location: login.php");
}
?>
<?php
include("../cls/clscsdl.php");
$p = new csdl();
?>
<?php
	$layid=0;
if(isset($_REQUEST['id']))
{
	$layid=$_REQUEST['id'];	
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="595" height="479" border="1" align="center">
    <tbody>
      <tr align="center">
        <td colspan="2">Quản Lý Sản Phẩm (<a href="logout.php">Logout</a>)</td>
      </tr>
      <tr>
        <td width="191">Chọn Công Ty</td>
        <td width="388">
		 	<?php
				$id_congty=$p->laycot("select id_congty from sanpham where id='$layid' limit 1");
				$p->xuatcomboboxcongty("select * from congty order by tencongty asc",$id_congty);
			?>
		 	<input type="hidden" name="txtid" id="txtid" value="<?php echo $layid ?>"></td>
      </tr>
      <tr>
        <td>Tên Sản Phẩm</td>
        <td>  <input type="text" name="txttensp" id="txttensp" value="<?php
			echo $p->laycot("select tensanpham from sanpham where id='$layid' limit 1");
			?>"></td>
      </tr>
      <tr>
        <td>Giá</td>
        <td><input type="text" name="txtgia" id="txtgia" value="<?php
			echo $p->laycot("select gia from sanpham where id='$layid' limit 1");
			?>"></td>
      </tr>
      <tr>
        <td height="147">Mô tả</td>
        <td><textarea name="txtmota" id="txtmota"><?php
			echo $p->laycot("select mota from sanpham where id='$layid' limit 1")
			?></textarea></td>
      </tr>
      <tr>
        <td>Hình đại diện</td>
        <td><input type="file" name="myfile" id="myfile"></td>
      </tr>
      <tr align="center">
        <td height="35" colspan="2"><input type="submit" name="nut" id="submit" value="Thêm sản phẩm">
        <input type="submit" name="nut" id="nut" value="Sửa sản phẩm">
        <input type="submit" name="nut" id="nut" value="Xóa sản phẩm"></td>
      </tr>
    </tbody>
  </table>
  <hr>
	<div align="center">
	<?php
		switch($_POST['nut'])
		{
			case 'Thêm sản phẩm':
				{
					$name=$_FILES['myfile']['name'];
					$local=$_FILES['myfile']['tmp_name'];
					$tensp=$_REQUEST['txttensp'];
					$gia=$_REQUEST['txtgia'];
					$mota=$_REQUEST['txtmota'];
					$idcty=$_REQUEST['select'];
					if($name!='')
					{
						if($p->uploadfile($local,'../hinh',$name)==1)
						{
							if($p->themxoasua("insert into sanpham(id_congty,tensanpham,gia,hinh,mota) values
				('$idcty','$tensp','$gia','$name','$mota')")==1)
							{
								echo 'Thêm sản phẩm thành công';
							}
							else
							{
								echo 'Upload lỗi 03.';
							}
						}
						else
						{
							echo'Upload lỗi 02';
						}
					}
					else
					{
						echo'Upload lỗi 01';
					}
					break;
				}
			case 'Xóa sản phẩm':
				{
					$idxoa=$_REQUEST['txtid'];
					if($idxoa>0)
					{
						$hinh=$p->laycot("select hinh from sanpham where id='$idxoa' limit 1");
						if(unlink("../hinh/".$hinh))
						{
							if($p->themxoasua("delete from sanpham where id='$idxoa' limit 1")==1)
							{
								header('location:themsp.php');
							}
							else
							{
								echo 'xóa sản phẩm không thành công.';
							}
						}
						else
						{
							echo 'Xóa hình không thành công.';
						}
					}
					else
					{
						echo'Vui lòng chọn sản phẩm cần xóa.';
					}
					break;
				}
			case 'Sửa sản phẩm':
			{
				$idsua=$_REQUEST['txtid'];
				if($idsua>0)
				{
					$tensp=$_REQUEST['txttensp'];
					$gia=$_REQUEST['txtgia'];
					$mota=$_REQUEST['txtmota'];
					$idcty=$_REQUEST['select'];
					if($p->themxoasua("Update sanpham set tensanpham='$tensp', gia='$gia', mota='$mota', id_congty='$idcty' where id='$idsua' limit 1")==1)
					{
						header('location:themsp.php');
					}
					else
					{
						echo 'Update failed :((';
					}
				}
				else
				{
					echo 'Chọn sản phẩm cần sửa.';
				}
			}
		}
	?>
	<?php
		$p->xuatdssanpham("select * from sanpham");	
	?>	
	</div>
</form>
</body>
</html>