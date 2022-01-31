<?php 
    require_once "koneksi.php";
    
    if(isset($_GET["id"])){
    $id=htmlspecialchars( $_GET["id"]);
    $hapus=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM barang WHERE id='$id'"));
    
    $filename=$hapus['gambar'];
    unlink('foto/'.$filename);
    $query="DELETE FROM barang WHERE id='$id'";
    $result=mysqli_query($koneksi,$query) or die (mysqli_error($koneksi)) ;
    
        header('Location:index.php');
    }
    else if(isset($_GET["id"])){
        $idbeli=htmlspecialchars($_GET["id"]);
        $hapus=mysqli_query($koneksi,"DELETE FROM beli WHERE kode_beli='$idbeli'");
        header('Location:beli.php');
    }
    
?>