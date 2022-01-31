<?php

    include_once "koneksi.php"; 

    $id=htmlspecialchars( $_GET["id"]);
    $query="SELECT * FROM barang WHERE id='$id'";
    $result=mysqli_query($koneksi,$query) or die (mysqli_error($koneksi));
    

    foreach($result as $row){
        $namabarang= $row["merk"];
        $jumlahbarang=$row["jumlah"];
        $hargabarang=$row["harga"];
        $gambarbarang=$row["gambar"];
        
    }  
 
    
    // update barang
    if(isset($_POST["update"])){

        $id=$_POST["id"];
        $merk= mysqli_real_escape_string($koneksi, $_POST["merk"]);
        $nama= mysqli_real_escape_string($koneksi, $_POST["nama"]);
        $kategori=mysqli_real_escape_string($koneksi,$_POST["kategori"]);
        $jumlah=mysqli_real_escape_string($koneksi,$_POST["jumlah"]);
        $harga=mysqli_real_escape_string($koneksi,$_POST["harga"]);

        $file_name=$_FILES['gambar']['name'];
        $file_type=$_FILES['gambar']['type'];
        $file_size=$_FILES['gambar']['size'];
        $file_tmp_name=$_FILES['gambar']['tmp_name'];
        $file_error=$_FILES['gambar']['error'];

        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
        $file_new=uniqid().'.' . $ext;

        if($file_type == "image/jpg" || $file_type == "image/png"){
            
            unlink('foto/'.$gambar);
            move_uploaded_file($file_tmp_name,__DIR__.'/foto/'.$file_new);
            $query="UPDATE barang SET merk='$merk', nama='$nama',idkategori='$kategori',jumlah='$jumlah',harga='$harga', gambar='$file_new' WHERE id=$id";
            $result=mysqli_query($koneksi,$query) or die (mysqli_error($koneksi));
            header("Location:index.php"); 
        }
        
    }
    
    if(!isset($_SESSION['user'])){
        header('Location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php"><button>daftar barang</button></a>

    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            Merk barang 
            <select name="merk" id="" >
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
        <div>
            Nama Barang : 
                <input type="text" name="nama" value="<?php echo $namabarang; ?>" autocomplete="off">
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
        <div>
            jumlah : 
                <input type="text" name="jumlah" value="<?php echo $jumlahbarang; ?>" autocomplete="off">
        </div>
        <div>
            harga : 
                <input type="text" name="harga" value="<?php echo $hargabarang; ?>" autocomplete="off">
        </div>
        <div> 
            <img src="../barang/foto/<?php echo $row ['gambar'];?>" alt="" width="100px"><br>
                <input type="file" name="gambar" value="pilih foto">
        </div>
        <div>
            <input type="hidden" name="id" value=<?php  echo htmlspecialchars( $_GET["id"])?>>
            <button type="submit" name="update">update</button>
        </div>
    </form>
</body>
</html>
