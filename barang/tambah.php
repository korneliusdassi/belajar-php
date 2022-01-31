<?php 
    require_once "koneksi.php";
    
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
    Material Dashboard 2 by Creative Tim
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
                <a href="index.php"><button name="daftar">daftar barang</button></a>
                  <h4 class="font-weight-bolder">Tambah Barang</h4>
                </div>
                <div class="card-body">

                  <form action="" method="post" enctype="multipart/form-data">
                    <div  class="input-group input-group-outline mb-3">
            <select name="jenis"  class="form-control" >
                      <option value=" "> Merk Barang</option>
                        <option value="Miyako"> Miyako</option>
                            <option value="LG">LG</option>
                                <option value="Kris">Kris</option>
                                  <option value="Panasonic">Panasonic</option>
                                    <option value="Cosmos">Cosmos</option>
                                      <option value="Polytron">Polytron</option>
                                        <option value="Sanken">Sanken</option>
            </select>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Nama Barang </label>
                      <input type="text" class="form-control" name="nama" autocomplete="off" required>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">jumlah Barang </label>
                      <input type="text" class="form-control" name="jumlah" autocomplete="off" required>
                    </div>
                    
                  
                    <div class="input-group input-group-outline mb-3">
                      <select name="kategori" class="form-control">
                        <?php 
                          $result =mysqli_query($koneksi,"SELECT * FROM kategori");
                            foreach($result as $data){
                              $id=$data['id'];
                              $nama=$data['kategori'];
                        ?>    
                              <option value=" "> Kategori</option>
                              <option value=<?php echo $id?>><?php echo $nama?></option>
                        <?php }?>
                      </select>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Harga barang </label>
                      <input type="text" class="form-control" name="harga" autocomplete="off" required>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label >gambar barang </label>
                      <input type="file" name="gambar" >
                    </div>
                   
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" name="submit">Tambah</button>
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
