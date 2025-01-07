<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Gallery
    </button>
    <div class="row">
        <!-- Untuk dynamic web user_data-->
        <div class="table-responsive" id="gallery_data">
            
        </div>
        <!-- Awal Modal Tambah-->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Gallery</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Form Tambah User-->
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Gambar Gallery</label>
                                <input type="file" class="form-control" name="gallery" value="" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Akhir Modal Tambah-->
    </div>
</div>
<script>
$(document).ready(function(){
		load_data();
		function load_data(hlm){
				$.ajax({
						url : "gallery_data.php",
						method : "POST",
						data : {hlm:hlm},
						success : function(data){
						$('#gallery_data').html(data);
						}
				})
		}
		$(document).on('click', '.halaman', function(){
				var hlm = $(this).attr("id");
				load_data(hlm);
		});
});
</script>
<?php
include "upload_foto_gallery.php";

//jika tombol simpan diklik
if (isset($_POST['simpan'])) {
    var_dump($_P);
    $nama_foto = $_FILES['gallery']['name'];
    $foto = '';

    //upload gambar
    if ($nama_foto != '') {
        $cek_upload = upload_foto_gallery($_FILES["gallery"]);

        if ($cek_upload['status']) {
            $foto = $cek_upload['message'];
        } else {
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=gallery';
            </script>";
            die;
        }
    }else{
        $foto = 'default.png';
    }

    //penyimpanan data ke user
    $stmt = $conn->prepare("INSERT INTO gallery (nama,oleh)
                            VALUES (?,?)");
    $stmt->bind_param("ss", $foto, $_SESSION['username']);
    $simpan = $stmt->execute();

    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=gallery';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=gallery';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

//edit
if (isset($_POST['edit'])) {
    $gantiUsername = $_POST['username'];
    $gantiPassword = $_POST['password'];
    $nama_foto = $_FILES['fotoprofil']['name'];
    $foto = '';

    if($username !== ''){

    }
    //upload gambar
    if ($nama_foto != '') {
        unlink("user_photo_profile/".$_POST['foto_lama']);
        $cek_upload = upload_foto_profil($_FILES["fotoprofil"]);

        if ($cek_upload['status']) {
            $foto = $cek_upload['message'];
        } else {
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=gallery';
            </script>";
            die;
        }
    }else{
        $foto = 'default.png';
    }

    //penyimpanan data ke user
    $stmt = $conn->prepare("INSERT INTO user (username,password,foto)
                            VALUES (?,?,?)");
    $stmt->bind_param("sss", $gantiUsername, md5($gantiPassword), $foto);
    $simpan = $stmt->execute();

    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=gallery';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=gallery';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

//jika tombol hapus diklik
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['nama'];

    if ($gambar != '') {
        //hapus file gambar
        unlink("user_photo_profile/" . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id =?");

    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>
            alert('Hapus data user sukses');
            document.location='admin.php?page=gallery';
        </script>";
    } else {
        echo "<script>
            alert('Hapus data user gagal');
            document.location='admin.php?page=gallery';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>