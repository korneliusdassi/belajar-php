<?php
require_once "koneksi.php";
unset($_SESSION['user']);
header('Location:login.php');
?>