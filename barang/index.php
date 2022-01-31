<?php
    require_once "koneksi.php";
    // tampil barang
   

// cari barang
    if(isset($_POST["cari"])){
        $cari=$_POST["key"];    
            $query="SELECT * FROM barang WHERE jenis LIKE '%$cari%' OR nama LIKE '%$cari%' OR jumlah LIKE '%$cari%'";
                $result=mysqli_query($koneksi,$query) or die (mysqli_error($koneksi));
                
    }

    if(isset($_POST['filter'])){
      $awal=$_POST['awal'];
      $akhir=$_POST['akhir'];
      
      $result=mysqli_query($koneksi,"SELECT * FROM barang WHERE tanggal BETWEEN '$awal' AND '$akhir'");
    }

    if(!isset($_SESSION['user'])){
        header('Location:login.php');
    }
    if($_SESSION['user']!="admin"){
        header('Location:index2.php');
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Daftar Barang
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
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" >
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
</head>

<body >
  
<div>
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="tambah.php">
                    <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                    Tambah Barang
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="belibarang.php">
                    <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                    Beli Barang
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="beli.php">
                    <i class="fa fa-user opacity-6 text-dark me-1"></i>
                    Tabel Transaksi
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="kategori.php">
                    <i class="fa fa-user opacity-6 text-dark me-1"></i>
                    Tabel Kategori
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="logout.php">
                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                    Log-Out
                  </a>
                </li>
                
              </ul>
            </div>
          </div>
        </nav>
        <br>
        <br>
        <br>
    <!-- Navbar -->

    <form action="" method="post">
      <div>
      Dari tanggal :
        <input type="date" name="awal" required autocomplete="off">
       Sampai tanggal :
        <input type="date" name="akhir" required autocomplete="off">
        <button type="submit" class=" btn-primary"  name="filter">filter</button>
      </div>
    </form>

    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
        </nav>

        <form action="" method="post">
            <div class="input-group input-group-outline">
              <input placeholder="Type here..." type="text" class="form-control" name="key">
              <button type="submit" name="cari" autocomplete="off" class=" btn-primary">search</button>
            </div>
        </form>

      </div>
    </nav>
      </div>      
          </ul>
        </div>
      </div>
    </nav>

    <?php 
    $ambildatabarang=mysqli_query($koneksi,"SELECT * FROM barang WHERE jumlah = 0");
    foreach($ambildatabarang as $data){
      $namabarang=$data['jenis'];
    
    ?>
    <div class="alert alert-danger alert-dismissible">
      <a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Danger!</strong> Stok <?php echo $namabarang; ?> Sudah Habis
    </div>
    <?php
    }
    ?>
    
    
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Daftar Barang</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">tanggal</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Merk Barang</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stok</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">harga Barang Satuan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">gambar barang</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>
                  <?php $n=1;
                   
                   $result=mysqli_query($koneksi," SELECT * FROM kategori JOIN barang ON (kategori.id = barang.idkategori) ");  
                    foreach($result as $row){ ?>
                  <tbody>
                    <tr>
                      <td class="align-middle text-center"><?php echo $n++;?></td>
                      <td class="align-middle text-center"><span class="text-secondary text-xs font-weight-bold"><?php echo strip_tags( $row["tanggal"]);?></span></td>
                      <td class="align-middle text-center"><span class="text-secondary text-xs font-weight-bold"><?php echo strip_tags( $row["merk"]);?></span></td>
                      <td class="align-middle text-center"><?php echo strip_tags( $row["nama"]);?></td>
                      <td class="align-middle text-center"><?php echo strip_tags( $row["kategori"]);?></td>
                      <td class="align-middle text-center"><?php echo strip_tags( $row["jumlah"]);?></td>
                      <td class="align-middle text-center"><?php echo strip_tags( $row["harga"]);?></td>
                      <td class="align-middle text-center"><img src="../barang/foto/<?php echo $row ['gambar'];?>" alt="" width="100px"></td>
                      <td class="align-middle text-center">
                        <a href="update.php?id=<?php echo $row ['id']; ?>"><button class="btn btn-primary" name="update">update</button></a>
                        <a href="hapus.php?id=<?php echo $row['id'] ;?>"><button class="btn btn-primary" name="delete">delete</button></a>
                      </td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
</html>
</body>
