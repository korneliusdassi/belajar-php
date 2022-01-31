<?php
date_default_timezone_set("Asia/makassar");
global $koneksi;
$koneksi=mysqli_connect("localhost","root","","penjualan");
session_start();

if(isset($_POST["submit"])){
    
    $jenis=mysqli_real_escape_string($koneksi,$_POST["jenis"]);
    $nama=mysqli_real_escape_string($koneksi,$_POST["nama"]);
    $kategori=mysqli_real_escape_string($koneksi,$_POST["kategori"]);
    $jumlah=mysqli_real_escape_string($koneksi,$_POST["jumlah"]);
    $harga=mysqli_real_escape_string($koneksi,$_POST["harga"]);
    
    $file_name=$_FILES['gambar']['name'];
    $file_type=$_FILES['gambar']['type'];
    $file_size=$_FILES['gambar']['size'];
    $file_tmp_name=$_FILES['gambar']['tmp_name'];
    $file_error=$_FILES['gambar']['error'];
    
    $ext=pathinfo($file_name,PATHINFO_EXTENSION);
    $file_new=uniqid().'.'. $ext;
    
    if($nama=="" || $jumlah=="" || $harga=="" ){
        echo "tidak boleh kosong";
    }
    if($file_type == "image/jpg" || $file_type == "image/png" || $file_type == "image/jpeg"){
        move_uploaded_file($file_tmp_name,__DIR__.'/foto/'.$file_new ); 
            $query="INSERT INTO barang (merk,nama,idkategori,jumlah,harga,gambar) VALUES ('$jenis','$nama','$kategori','$jumlah','$harga','$file_new')";
                $result=mysqli_query($koneksi,$query) or die (mysqli_error($koneksi));
                    header("Location:index.php");
    }else{
        echo "harus foto";
    }


}


?>