<?php

include "koneksi.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Data Mahasiswa</title>
</head>
<body>
    <div class="container-fluid px-4 pt-4 pb-5 mb-5">
        <div class="row mx-auto text-center">
            <h2 class="mb-5 fw-bolder">DATA MAHASISWA STMIK IKMI CIREBON</h2>

            <!-- Kolom Pencarian -->
            <form action="pencarian.php" method="GET" class="row text-start mb-4">
                <div class="col-3 py-auto" style="display: flex;height: 30px;">
                    <input type="text" name="cari" class="form-control" placeholder="Cari data mahasiswa">
                    <button type="submit" value="Cari" class="btn btn-cari">Cari</button>
                </div>
                <div class="col-9"></div>
            </form>

            <!-- Form Tambah Data -->
            <div class="col-3">
                <div class="card shadow">
                    <div class="card-header text-white fs-5 fw-bold py-2 title-tambah">Tambah Data</div>
                    <div class="card-body">
                        <?php
                        if ($error) {
                        ?>
                            <div class="alert alert-danger text-start py-2" role="alert">
                                <?php echo $error ?>
                            </div>
                        <?php
                            header("refresh:100;url=index.php"); 
                        } ?>

                        <?php
                        if ($sukses) {
                        ?>
                            <div class="alert alert-success text-start py-2" role="alert">
                                <?php echo $sukses ?>
                            </div>

                        <?php
                            header("refresh:100;url=index.php");
                        } ?>

                        <form action="" method="POST">
                            <div class="cotainer mb-3 px-2 text-start">
                                <label for="nim" class="fw-bold mb-1">NIM</label>
                                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>" required>
                            </div>
                            <div class="cotainer mb-3 px-2 text-start">
                                <label for="nama" class="text-start fw-bold mb-1">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>" required>
                            </div>
                            <div class="cotainer mb-3 px-2 text-start">
                                <label for="prodi" class="fw-bold mb-1">Program Studi</label>
                                <select class="form-select" name="prodi" id="prodi" required>
                                    <option value="">-</option>
                                    <option value="TI" <?php if ($prodi == "TI") echo "selected" ?>>Teknik Informatika</option>
                                    <option value="RPL" <?php if ($prodi == "RPL") echo "selected" ?>>Rekayasa Perangkat Lunak</option>
                                    <option value="SI" <?php if ($prodi == "SI") echo "selected" ?>>Sistem Informasi</option>
                                    <option value="MI" <?php if ($prodi == "MI") echo "selected" ?>>Manajemen Informatika</option>
                                    <option value="KA" <?php if ($prodi == "KA") echo "selected" ?>>Komputerisasi Akuntansi</option>
                                </select>
                            </div>
                            <div class="cotainer mb-3 px-2 text-start">
                                <label for="email" class="fw-bold mb-1">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>" required>
                            </div>
                            <div class="mb-3 row ml-auto">
                                <div class="col-12">
                                    <input type="submit" name="simpan" value="Simpan" class="btn btn-primary rounded-3 mt-4 px-4 py-auto" style="font-size: 14px;">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Mahasiswa-->
            <div class="col-9">
                <div class="card shadow card-data">
                    <div class="card-header text-white fs-5 fw-bold py-2 title-data">DATA MAHASISWA</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr class="th-data">
                                    <th scope="col">NO.</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">PRODI</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql2   = "SELECT * FROM data_mahasiswa order by id desc";
                                $q2     = mysqli_query($koneksi, $sql2);
                                $urutan = 1;

                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $id     = $r2['id'];
                                    $nim    = $r2['nim'];
                                    $nama   = $r2['nama'];
                                    $prodi  = $r2['prodi'];
                                    $email  = $r2['email'];
                                ?>

                                    <tr>
                                        <th scope="row" style="font-size: 15px;"><?php echo $urutan++ ?></th>
                                        <td scope="row" style="font-size: 15px;"><?php echo $nim ?></td>
                                        <td scope="row" style="font-size: 15px;"><?php echo $nama ?></td>
                                        <td scope="row" style="font-size: 15px;"><?php echo $prodi ?></td>
                                        <td scope="row" style="font-size: 15px;"><?php echo $email ?></td>
                                        <td scope="row" >
                                            <a href="index.php?op=edit&id=<?php echo $id ?>">
                                                <button type="button" class="btn btn-info text-white btn-outline-secondary py-0 pb-1"><small>Edit</small></button>
                                            </a>
                                            <a href="index.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Anda yakin ingin menghapus data?')">
                                                <button type="button" class="btn btn-danger btn-outline-secondary text-white py-0 pb-1"><small>Hapus</small></button>
                                            </a>
                                        </td>
                                    </tr>
                                    
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>