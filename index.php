<?php
include "koneksi.php"; 
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
    <link rel="icon" href="img/logo.png" />
    <meta name="robots" content="noindex, nofollow">
</head>
<body>
    <!--Navigation-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
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
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>
    <!--Hero Section-->
    <section id="hero" class="text-center p-5 text-sm-start bg-secondary">
        <div class="container">
            <div class="d-sm-flex flex-sm-row-reverse border-4 border-white align-items-center">
                <img src="" alt="" class="img-fluid" width="300">
                <div>
                    <h1 class="fw-bold display-4">Daily Journal</h1>
                    <h4 class="lead display-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore dolore eius officiis. Obcaecati optio corporis ducimus non doloremque voluptatum inventore vitae tenetur! Quod quis, vero laboriosam nobis porro rem iusto?</h4>
                </div>
            </div>
        </div>
    </section>
    <!--Article Section-->
    <!-- article begin -->
    <section id="article" class="text-center p-5">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">article</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                <?php
                $sql = "SELECT * FROM article ORDER BY tanggal DESC";
                $hasil = $conn->query($sql); 

                while($row = $hasil->fetch_assoc()){
                ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
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
                                    <td>+62 815 7550 0051</td>
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
