<?php
include("../cls/clslogin.php");
$p=new quanlydangnhap();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post">
  <table width="354" border="1" align="center">
    <tbody>
      <tr>
        <td colspan="2" style="text-align: center">ĐĂNG NHẬP</td>
      </tr>
      <tr>
        <td width="115">Username</td>
        <td width="223"><input type="text" name="txtuser" id="txtuser"></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><input type="password" name="txtpass" id="txtpass"></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: center"><input name="submit" type="submit" id="submit" value="Đăng nhập"></td>
      </tr>
    </tbody>
  </table>
</form>
	<?php
	if(isset($_POST["submit"])){
		$user=$_REQUEST["txtuser"];
		$pass=$_REQUEST["txtpass"];
		if($user!='' && $pass!=''){
			$p->login($user, $pass);
		}
		else{
			echo'Vui long nhap day du thong tin';
		}
	}
	
	?>
</body>
</html>