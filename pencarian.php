<?php

include "koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Hasil Pencarian</title>
</head>
<body style="height: 100vh;">
    <div class="container px-4 pt-4 pb-5 mb-5">
        <?php
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
        } else {
            echo "Data tidak ditemukan";
        }

        ?>
        <div class="card shadow card-data mt-3" style="height: 50vh;">
            <div class="card-header text-white fs-5 fw-bold py-2 title-data text-center">DATA MAHASISWA</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr class="th-data">
                            <th scope="col" class="text-center">NO.</th>
                            <th scope="col" class="text-center">NIM</th>
                            <th scope="col" class="text-center">NAMA</th>
                            <th scope="col" class="text-center">PRODI</th>
                            <th scope="col" class="text-center">EMAIL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($_GET['cari'])){
                                $cari = $_GET['cari'];
                                $data = mysqli_query($koneksi,"SELECT * FROM data_mahasiswa WHERE nama LIKE '%".$cari."%'");	
                            }else{
                                echo "Data tidak ditemukan"."!";		
                            }
                            $no = 1;
                            while($d = mysqli_fetch_array($data)){
                        ?>

                        <tr>
                            <th scope="row" class="text-center"><?php echo $no ?></th>
                            <td scope="row" class="text-center"><?php echo $d['nim'] ?></td>
                            <td scope="row" class="text-center"><?php echo $d['nama'] ?></td>
                            <td scope="row" class="text-center"><?php echo $d['prodi'] ?></td>
                            <td scope="row" class="text-center"><?php echo $d['email'] ?></td>
                        </tr>
                        
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>