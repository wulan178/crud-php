<?php

    $host   = "localhost";
    $user   = "root";
    $pass   = "";
    $db     = "php_crud";

    $koneksi = mysqli_connect($host,$user,$pass,$db);
    if(!$koneksi) {
        die("Koneksi gagal!");
    }

    $nim      = "";
    $nama     = "";
    $prodi    = "";
    $email    = "";
    $sukses   = "";
    $error    = "";

    if(isset($_GET['op'])){
        $op  = $_GET['op'];
    } else {
        $op  = "";
    }

    if($op == 'delete'){
        $id     = $_GET['id'];
        $sql1   = "DELETE FROM data_mahasiswa WHERE id = '$id'";
        $q1     = mysqli_query($koneksi,$sql1);
        if($q1){
            $sukses = "<small>Berhasil menghapus data!</small>";
        } else{
            $error  = "<small>Gagal menghapus data!</small>";
        }
    }

    if($op == 'edit'){
        $id     = $_GET['id'];
        $sql1   = "SELECT * FROM data_mahasiswa WHERE id = '$id'";
        $q1     = mysqli_query($koneksi,$sql1);
        $r1     = mysqli_fetch_array($q1);
        $nim    = $r1['nim']; 
        $nama   = $r1['nama']; 
        $prodi  = $r1['prodi']; 
        $email  = $r1['email']; 

        if($nim == ''){
            $error  = "<small>Data tidak ditemukan!</small>";
        } 
    }

    if(isset($_POST['simpan'])){
        $nim    = $_POST['nim'];
        $nama   = $_POST['nama'];
        $prodi  = $_POST['prodi'];
        $email  = $_POST['email'];
    }

    if($nim && $nama && $prodi && $email){
        if($op == 'edit'){
            $sql1   = "UPDATE data_mahasiswa SET nim = '$nim', nama = '$nama', prodi = '$prodi', email = '$email' WHERE id = '$id'";
            $q1     = mysqli_query($koneksi, $sql1);
            if($q1){
                $sukses = "<small>Update data berhasil!</small>";
            } else {
                $error = "<small>Update data gagal!</small>";
            }
        } else {
            $sql1   = "INSERT INTO data_mahasiswa(nim,nama,prodi,email) VALUES ('$nim','$nama','$prodi','$email')";
            $q1     = mysqli_query($koneksi,$sql1);
    
            if($q1){
                $sukses = "<small>Berhasil menambahkan data</small>";
            } else {
                $error  = "<small>Gagal menambahkan data</small>";
            }
        }
       
    }

?>