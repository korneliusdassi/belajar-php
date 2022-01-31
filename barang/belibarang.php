<?php

    include_once "koneksi.php"; 

    // update barang
    if(isset($_POST["beli"])){
        
        $tanggal=date('Y/m/d H:i:s');
        $pembeli=mysqli_real_escape_string($koneksi,$_POST["pembeli"]);
        $barang= mysqli_real_escape_string($koneksi, $_POST["barang"]);
        $jumlah=mysqli_real_escape_string($koneksi,$_POST["jumlahbeli"]);
        
        
        $cekstok=mysqli_query($koneksi,"SELECT * FROM barang WHERE id='$barang'");
        
        foreach($cekstok as $data){
          $jumlahbarang=$data['jumlah'];
          $harga=$data['harga'];
        }
        if($jumlahbarang >= $jumlah){
            
        $total=$harga*$jumlah;
        $updatestok=$jumlahbarang-$jumlah;

            $beli=mysqli_query($koneksi,"INSERT INTO beli VALUES ('','$tanggal','$pembeli','$barang','$jumlah','$total')");
            
            $updatedaftar=mysqli_query($koneksi,"UPDATE barang SET jumlah= '$updatestok' WHERE id='$barang' ");
            header("Location:beli.php"); 
        
    }else{
        echo "stok tidak cukup";
    }
}
    
    if(!isset($_SESSION['user'])){
        header('Location:login.php');
    }
?>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Beli
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../assets/img/illustrations/illustration-signup.jpg'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                <a href="index.php"><button  class="btn btn-lg bg-gradient-primary btn-lg  ">daftar barang</button></a>
                  <p class="mb-0">Beli Barang</p>
                </div>
                <div class="card-body">
                  <form action="" method="post" role="form">
                    <div class="input-group input-group-outline mb-3">
                      <select name="pembeli" class="form-control">
                        <?php 
                          $result =mysqli_query($koneksi,"SELECT * FROM user");
                            foreach($result as $data){
                              $id=$data['id'];
                              $nama=$data['namauser'];
                        ?>
                              <option value=<?php echo $id?>><?php echo $nama?></option>
                        <?php }?>
                      </select>
                    </div>


                    <div class="input-group input-group-outline mb-3">
                      <select name="barang"  class="form-control">
                      <?php 
                          $result =mysqli_query($koneksi,"SELECT * FROM barang");
                            foreach($result as $data){
                              $idbarang=$data['id'];
                              $namabarang=$data['nama'];
                        ?>
                              <option value=<?php echo $idbarang?>><?php echo $namabarang?></option>
                        <?php }?>
                      </select>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">jumlah Barang Dibeli :</label>
                      <input type="text" class="form-control" name="jumlahbeli" autocomplete="off" required>
                    </div>
                   
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" name="beli">Beli</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>