<?php
include "koneksi.php";
session_start();
$user = '';
if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];
}else{
    $user = 'Guest';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Latihan Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" href="img/logo.png" />
    <meta name="robots" content="noindex, nofollow">
</head>
<body>
    <!--Navigation-->
    <nav class="navbar navbar-expand-lg w3-orange sticky-top">
            <div class="container">
                <a class="navbar-brand" href="#">Me Website</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#jadwal">Jadwal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#profile">Profile</a>
                        </li>
                        <li class="nav-item">
                            <div class="w3-container">
                                <div class="w3-dropdown-hover">
                                    <button class="w3-button w3-black w3-round-large" type="button">
                                        <?=$user?>
                                    </button>
                                    <div class="w3-dropdown-content w3-bar-block w3-border">
                                        <?php
                                        if ($user == 'Guest'){
                                        ?>
                                            <a href="login.php" class="w3-bar-item w3-button">Login</a>
                                        <?php
                                        }elseif($user == "admin"){
                                        ?>
                                            <a href="admin.php" class="w3-bar-item w3-button">Admin Panel</a>
                                            <a href="login.php" class="w3-bar-item w3-button">Change Account</a>
                                            <a href="logout.php" class="w3-bar-item w3-button">Logout</a>

                                        <?php
                                        }else{
                                            ?>
                                            <a href="login.php" class="w3-bar-item w3-button">Change Account</a>
                                            <a href="logout.php" class="w3-bar-item w3-button">Logout</a><?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>
    <!--Hero Section-->
    <section id="hero" class="text-center p-5 text-sm-start w3-deep-purple">
        <div class="container">
            <div class="d-sm-flex flex-sm-row-reverse border-4 border-white align-items-center">
                <img src="" alt="" class="img-fluid" width="300">
                <div>
                    <h1 class="fw-bold display-4">Daily Journal</h1>
                    <h4 class="lead display-6">Welcome to my Daily Journal website, Guest!</h4>
                </div>
            </div>
        </div>
    </section>
    <!--Article Section-->
    <section id="jadwal" class="text-center p-5">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">Jadwal</h1>
            <div class="row row-cols-1 row-cols-md-4 g-2 justify-content-center">
                <?php
                $jadwal = [
                ["Senin",[["Logika Informatika","09.30-12.00 H.4.11"],["Basis Data","12.30-14.10 H.4.3"]],"red"],
                ["Selasa",[["Sistem Informasi","09.30-12.00 H.4.2"],["Pemprograman Berbasis Web","12.30-14.10 D.2.J"],["Pendidikan Kewarganegaraan","18.30-20.10 Aula H7"]],"green"],
                ["Rabu",[["Probabilitas dan Statistika","09.30-12.00  H.4.8"],["Rekayasa Perangkat Lunak","12.30-15.00 H.4.4"]],"blue"],
                ["Kamis",[["Basis Data","10.20-12.00 D.3.M"],["Sistem Operasi","12.30-15.00 H.4.11"]],"yellow"],
                ["Jum'at",[],"gray"],
                ["Sabtu",[],"gray"]
                ];
                foreach ($jadwal as $hari){
                    $nama_hari = $hari[0];
                    $jadwalhari = $hari[1];
                    $color = $hari[2];

                    ?>
                    <div class="col">
                        <div class="card w3-<?=$color?>" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?=$hari[0]?></h5>
                                <p class="card-text">
                                    <?php
                                    foreach ($jadwalhari as $list) {
                                        echo $list[0]."<br>";
                                        echo $list[1]."<br>";
                                        echo "<br>";
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- article begin -->
    <section id="article" class="text-center p-5">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">Article</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                <?php
                $sql = "SELECT * FROM article ORDER BY tanggal DESC";
                $hasil = $conn->query($sql); 

                while($row = $hasil->fetch_assoc()){
                ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/<?= $row["gambar"]?>" class="card-img-top"/>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row["judul"]?></h5>
                                    <p class="card-text">
                                    <?= $row["isi"]?>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-body-secondary">
                                    <?= $row["tanggal"]?>
                                    </small>
                                </div>
                        </div>
                    </div>
                    <?php
                }
                ?> 
            </div>
        </div>
    </section>
    <!-- article end -->
    <!--Gallery Section-->
    <section id="gallery" class="text-center p-5">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">Gallery</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                <?php
                //going to use db instead
                $sql = "SELECT * from gallery ORDER BY tanggal_upload desc";
                $dir = "gallery";
                $result = $conn->query($sql);

                while($entry = $result->fetch_assoc()){
                ?>
                    <!--Repeated Echo-->
                    <div class="col">
                        <div class="card h-100">
                        <img src="<?=$dir.'/'.$entry['nama']?>" class="card-img-top"/>
                            <div class="card-body">
                                <img src="" alt="">
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">
                                    <b><?=$entry['tanggal_upload']?></b>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?> 
            </div>
        </div>
    </section>
    <!--Gallery end-->
    <section id="profile" class="text-center p-5">
        <h1 class="fw-bold display-4 pb-5">Profile</h1>
        <div class="container row-cols-2 row-cols-md-1 g-4">
            <div class="row">
                <div class="col">
                    <img class="rounded-circle" src="FOTO_UJIAN.jpg">
                </div>
                <div class="col">
                    <h3 class="text-center">Hernandanu Murya Mahiswara</h3>
                    <p class="text-center">Mahasiswa Teknik Komputer</p>
                    <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>A11.2023.15297</td>
                                </tr>
                                <tr>
                                    <td>Program Studi</td>
                                    <td>:</td>
                                    <td>Teknik Informatika</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>nando.madukoro@gmail.com</td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>:</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>Jl.Inspeksi</td>
                                </tr>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
    <footer class="h2 p-2 text-dark text-center">
        <div>
            <i class="bi bi-instagram"></i>
            <i class="bi bi-twitter-x"></i>
            <i class="bi bi-whatsapp"></i>
        </div>
        <div>
            Hernandanu Murya Mahiswara @ 2024
        </div>
    </footer>
</body>
</html>
