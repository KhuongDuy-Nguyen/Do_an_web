<?php
	include("css/class-registration-style.php");
?>
<?php
	if(isset($_REQUEST['malophoc']))
	{
		$malophoc = $_REQUEST['malophoc'];
		$select1 = "SELECT * FROM lophoc WHERE malophoc='$malophoc'";
		$qr1 = mysqli_query($connect, $select1);

		$row1=mysqli_fetch_array($qr1);
		
		$tenlophoc= $row1[1];
	 	$monhoc = $row1[2];
	 	$phonghoc = $row1[3];
	 	$anhdaidien = ($row1[4]);
		
	}

 ?>
<div class="container">
    <div class="class-registration-content">
       <div class="row">
          <div class="col-12 text-center">
              <h2>ĐĂNG KÝ LỚP HỌC</h2>
          </div>
       </div>
        <div class="row">
          <div class="col-4 text-right">Tên Lớp Học: </div>
          <div class="col-6 text-left"><input type="text" name="lop-hoc" value="<?php echo $tenlophoc; ?>"/></div>
        </div>
        <div class="row">
          <div class="col-4 text-right">Môn Học: </div>
          <div class="col-6 text-left"><input type="text" name="mon-hoc" value="<?php echo $monhoc; ?>"/></div>
        </div>
        <div class="row">
          <div class="col-4 text-right">Phòng Học: </div>
          <div class="col-6 text-left"><input type="text" name="phong-hoc" value="<?php echo $phonghoc; ?>"/></div>
        </div>
        <div class="row">
          <div class="col-4 text-right">Ảnh Đại Diện: </div>
          <div class="col-6 text-left"><input type="file" name="anh-dai-dien" id="anh-dai-dien"/></div>
        </div>
        <div class="row">
          <div class="col-12 text-center">
              <input type="submit" class="btn btn-primary" name="sua-lop-hoc" value="Sửa Lớp Học">
          </div>
       </div>
        
    </div>
</div>

<?php
	if (isset($_POST['sua-lop-hoc'])) {
		$tenlop = $_POST['lop-hoc'];
		$monhoc = $_POST['mon-hoc'];
		$phonghoc = $_POST['phong-hoc'];
		$namepic = $_FILES["anh-dai-dien"]["name"];
		$tmp = $_FILES["anh-dai-dien"]["tmp_name"];
 		$anhdaidien = "storage/image/".$namepic;
 		move_uploaded_file($tmp,$anhdaidien);

		$update = "UPDATE lophoc SET TenLop='$tenlop', MonHoc='$monhoc', PhongHoc='$phonghoc', AnhDaiDien='$anhdaidien' WHERE malophoc='$malophoc'";
		echo "<script type='text/javascript'>
  				alert('$update');
  		 		</script>";
		$updateqr = mysqli_query($connect, $update);
		if($updateqr) {
			echo "<script type='text/javascript'>
  				alert('Sửa Lớp Học thành công!');
  				location.href='index.php?page=classlist';
  		 		</script>";
		}
	}
?>