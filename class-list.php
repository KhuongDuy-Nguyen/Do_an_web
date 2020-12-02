<?php
	include("css/class-list-style.php");
?>
<div class="container">
    <div class="class-list-content">
       <div class="row">
          <div class="col-12 text-center">
              <h2>DANH SÁCH LỚP HỌC</h2>
          </div>
       </div>
       <div class="row">
          <div class="col-12 text-right">
              <a class="btn btn-primary them" href='index.php?page=classregistration'>Thêm</a>
          </div>
       </div>
        <div class="row class-list-header text-center">
          <div class="col-2">Mã Lớp Học</div>
          <div class="col-2">Tên Lớp Học</div>
          <div class="col-2">Môn Học</div>
          <div class="col-2">Phòng Học</div>
          <div class="col-2">Ảnh Đại Diện</div>
          <div class="col-2"></div>
        </div>

        <?php
			$selectlophoc = "SELECT * FROM lophoc";
			$qrlophoc = mysqli_query($connect, $selectlophoc);
			
			while ($danhsachlophoc = mysqli_fetch_array($qrlophoc)) {
				$tenlop = $danhsachlophoc[1];
				$monhoc = $danhsachlophoc[2];
				$phonghoc = $danhsachlophoc[3];
				$anhdaidien = $danhsachlophoc[4];
				$malophoc = $danhsachlophoc[5];
				$delete = 'del'.$malophoc;
				echo "
				<div class='row class-list-body'>
		          <div class='col-2'>$malophoc</div>
		          <div class='col-2'>$tenlop</div>
		          <div class='col-2'>$monhoc</div>
		          <div class='col-2'>$phonghoc </div>
		          <div class='col-2'><img src='' alt='' width='150'></div>
		          <div class='col-2 text-center'>
		          	<input class='btn btn-danger' id='del' type='submit' name='$delete' value='Xóa'>
		          	<a class='btn btn-primary' href='index.php?page=classupdate&malophoc=$malophoc'>Sửa</a>
		          </div>
		        </div>
				";

				if(isset($_POST[$delete]))
				{
					echo"$malophoc";
					$delete = "DELETE FROM lophoc WHERE malophoc='$malophoc'";
					$qr9 = mysqli_query($connect,$delete);
					if($qr9)
					{
						echo "<script type='text/javascript'>
	      				location.reload();
	      		 		</script>";
					}
				}
			}
		 ?>
    </div>
  </div>