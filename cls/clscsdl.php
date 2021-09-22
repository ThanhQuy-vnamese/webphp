<?php
class csdl
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
	function xuatcongty($tsql)
	{
		$link = $this->connectdb();
		$ketqua = mysql_query($tsql,$link);
		$i = mysql_num_rows($ketqua);
		if($i>0)
		{
			while($row= mysql_fetch_array($ketqua)){
				$id=$row['id'];
				$congty = $row['tencongty'];
				echo '<a href="index.php?id='.$id.'">'.$congty.'</a>';
				echo '<br>';
			}
		}
		else
		{
			echo'Không tìm thấy dữ liệu.';
		}
	}
	function xuatsanpham($tsql)
	{
		$link = $this->connectdb();
		$ketqua = mysql_query($tsql,$link);
		$i = mysql_num_rows($ketqua);
		if($i>0)
		{
			while($row=mysql_fetch_array($ketqua))
			{
				$id=$row['id'];
				$tensanpham=$row['tensanpham'];
				$gia=$row['gia'];
				$hinh=$row['hinh'];
				echo '<div id="sanpham">
						<div id="sanpham-hinh"><img src="hinh/'.$hinh.'" height="180" width="160"></div>
						<div id="sanpham-ten">'.$tensanpham.'</div>
						<div id="sanpham-gia">Giá:'.$gia.'$</div>
					</div>';
			}
		}
		else
		{
			echo'Không tìm thấy dữ liệu.';
		}
	}
	function xuatcomboboxcongty($sql,$myid)
	{
		$link = $this->connectdb();
		$ketqua = mysql_query($sql,$link);
		$i = mysql_num_rows($ketqua);
		if($i>0)
		{
			echo '<select name="select" id="select">';
            echo '<option value="0">Mời chọn công ty</option>';
			while($row= mysql_fetch_array($ketqua))
			{
				$id=$row['id'];
				$tencongty=$row['tencongty'];
				if($myid==$id)
				{
					echo '<option value="'.$id.'" selected>'.$tencongty.'</option>';
				}
				else
				{
					echo '<option value="'.$id.'">'.$tencongty.'</option>';
				}
			}
        	echo '</select>';
		}
		else
		{
			echo 'Không tìm thấy dữ liệu.';
		}
	}
	function uploadfile($local,$folder,$name)
	{
		if($local!='' && $folder!='' && $name!='')
		{
			$newname=$folder.'/'.$name;
			if(move_uploaded_file($local,$newname)==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	function xuatdssanpham($sql)
	{
		$link = $this->connectdb();
		$ketqua=mysql_query($sql,$link);
		$i = mysql_num_rows($ketqua);
		if($i>0)
		{
			echo'<table width="495" height="120" border="1" align="center">
				<tbody>
				<tr>
				<td width="52">STT</td>
				<td width="157">Tên Sản Phẩm</td>
				<td width="86">Ảnh</td>
				<td width="86">Giá</td>
				<td width="172">Mô tả</td>
				</tr>';
			$dem=1;
			while($row = mysql_fetch_array($ketqua))
			{
				$id=$row['id'];
				$tensp=$row['tensanpham'];
				$hinh=$row['hinh'];
				$gia=$row['gia'];
				$mota=$row['mota'];
				echo'      <tr>
					<td>'.$dem.'</td>
					<td><a href="themsp.php?id='.$id.'">'.$tensp.'</td>
					<td><img src="../hinh/'.$hinh.'" height= 50; width=50/></td>
					<td>'.$gia.'</td>
					<td>'.$mota.'</td>
					</tr>';
				
				$dem++;
			}

			echo' </tbody>
			</table>';
		}
		else
		{
			echo'chưa có dữ liệu.';
		}
	}
	function themxoasua($sql)
	{
		$link=$this->connectdb();
		if(mysql_query($sql,$link))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function laycot($sql)
	{
		$link=$this->connectdb();
		$ketqua=mysql_query($sql,$link);
		$i=mysql_num_rows($ketqua);
		$giatri='';
		if($i>0)
		{
			while($row=mysql_fetch_array($ketqua))
			{
				$gt=$row[0];
				$giatri=$gt;
			}
			return $giatri;
		}
		else
		{
			return $giatri;
		}
	}
}
?>