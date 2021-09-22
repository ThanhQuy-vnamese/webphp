<?php
class quanlydangnhap
{
	function connectdb()
	{
		$con=mysql_connect("localhost","root","");
		if(!$con)
		{
			echo 'Không kết nối được cơ sở dữ liệu.';
			exit();
		}
		else
		{
			mysql_select_db("mydb");
			mysql_query("set names utf8");
			return $con;
		}
	}
	function login($user, $pass){
		$pass=md5($pass);
		$sql="select id, username, password, phanquyen from users where username='$user' and password='$pass' limit 1";
		$con=$this->connectdb();
		$ketqua=mysql_query($sql, $con);
		
		$i=mysql_num_rows($ketqua);
		
		if($i==1){
			while($row=mysql_fetch_array($ketqua)){
				$id=$row['id'];
				$username=$row['username'];
				$password=$row['password'];
				$phanquyen=$row['phanquyen'];
				session_start();
				$_SESSION['id']= $id;
				$_SESSION['user']= $username;
				$_SESSION['pass']= $password;
				$_SESSION['phanquyen']= $phanquyen;
				header('location:themsp.php');
				
			}
		}
		else{
			header('location:login.php');
			}
	}
	function confirmlogin($id, $user, $pass, $phanquyen){
		$sql="select id from users where id=$id and username='$user' and password='$pass' and phanquyen=$phanquyen";
				$con=$this->connectdb();
		$ketqua=mysql_query($sql, $con);
		$i=mysql_num_rows($ketqua);
		if($i!=1){
		header('location:login.php');
		}
	}
}