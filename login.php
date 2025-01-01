<?php
  //memulai session atau melanjutkan session yang sudah ada
  session_start();
  //menyertakan code dari file koneksi
  include "koneksi.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
  
    //menggunakan fungsi enkripsi md5 supaya sama dengan password  yang tersimpan di database
    $password = md5($_POST['password']);
  
  	//prepared statement
    $stmt = $conn->prepare("SELECT username FROM user WHERE username=? AND password=?");
  	//parameter binding 
    $stmt->bind_param("ss", $username, $password);//username string dan password string
  
    //database executes the statement
    $stmt->execute();
  
    //menampung hasil eksekusi
    $hasil = $stmt->get_result();
  
    //mengambil baris dari hasil sebagai array asosiatif
    $row = $hasil->fetch_array(MYSQLI_ASSOC);
  
    //check apakah ada baris hasil data user yang cocok
    if (!empty($row)) {
      //jika ada, simpan variable username pada session
      $_SESSION['username'] = $row['username'];
  
      //mengalihkan ke halaman admin
      header("location:admin.php");
    } else {
  	  //jika tidak ada (gagal), alihkan kembali ke halaman login
      header("location:login.php");
    }

  	//menutup koneksi database
    $stmt->close();
    $conn->close();
  } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to my diary website admin!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="container-fluid bg-secondary">
    <div class="container col-4">
        <div class="row text-start p-2 mt-4 border rounded-4 bg-light">
            <form action="login.php" method="post">
                <div class="mb-3">
                    <label for="Username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <div id="emailHelp" class="form-text">We'll never share your password with anyone else.</div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
  }
?>