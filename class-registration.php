<?php
	include("css/class-registration-style.php");
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
          <div class="col-6 text-left"><input type="text" name="lop-hoc"/></div>
        </div>
        <div class="row">
          <div class="col-4 text-right">Môn Học: </div>
          <div class="col-6 text-left"><input type="text" name="mon-hoc"/></div>
        </div>
        <div class="row">
          <div class="col-4 text-right">Phòng Học: </div>
          <div class="col-6 text-left"><input type="text" name="phong-hoc"/></div>
        </div>
        <div class="row">
          <div class="col-4 text-right">Ảnh Đại Diện: </div>
          <div class="col-6 text-left"><input type="file" name="anh-dai-dien" id="anh-dai-dien"/></div>
        </div>
        <div class="row">
          <div class="col-12 text-center">
              <input type="submit" class="btn btn-primary" name="tao-lop-hoc" value="Tạo Lớp Học">
          </div>
       </div>
        
    </div>
</div>

<?php
	if (isset($_POST['tao-lop-hoc'])) {
		$tenlop = $_POST['lop-hoc'];
		$monhoc = $_POST['mon-hoc'];
		$phonghoc = $_POST['phong-hoc'];
		$namepic = $_FILES["anh-dai-dien"]["name"];
		$tmp = $_FILES["anh-dai-dien"]["tmp_name"];
 		$anhdaidien = "storage/image/".$namepic;
 		move_uploaded_file($tmp,$anhdaidien);
		$maxid = 1;

		$getmaxid = "SELECT id FROM lophoc ORDER BY ID DESC LIMIT 1";
		$maxidresult = mysqli_query($connect, $getmaxid);
		if (mysqli_num_rows($maxidresult) > 0) {
			$row = mysqli_fetch_array($maxidresult);
			$maxid = $row[0] + 1;
		}

		$malophoc = "LH00$maxid";

		$add = "INSERT INTO lophoc VALUES('','$tenlop','$monhoc','$phonghoc','$anhdaidien','$malophoc')";
		$addqr = mysqli_query($connect, $add);
		if($addqr) {
			echo "<script type='text/javascript'>
  				alert('Tạo Lớp Học thành công!');
  				location.href='index.php?page=classlist';
  		 		</script>";
		}
	}
?>