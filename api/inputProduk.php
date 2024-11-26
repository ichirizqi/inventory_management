<?php

header("Content-Type: application/json");
include "../database/koneksi.php";

if(isset($_POST['nama_produk']) && !empty($_POST['nama_produk']) &&
    isset($_POST['id_kategori']) && !empty($_POST['id_kategori']) &&
    isset($_POST['stok']) && !empty($_POST['stok'])){

        $nama = $_POST['nama_produk'];
        $id_kategori = $_POST['id_kategori'];
        $stok = $_POST['stok'];

        $query = mysqli_query($koneksi, "INSERT INTO produk(nama, id_kategori, stok) VALUES ('$nama', '$id_kategori', '$stok')");


        if($query){
            $result = [
                'success' => true,
                'message' => "Berhasil Menambahkan Data"
            ];
        }else{
            $result = [
                'success' => false,
                'message' => "Gagal Menambahkan Data"
            ];
        }
    }else{
        $errors = [];

        if(empty($_POST['nama_produk'])){
            $errors[] = "Nama is required";
        }
        if(empty($_POST['id_kategori'])){
            $errors[] = "ID Kategori is required";
        }
        if(empty($_POST['stok'])){
            $errors = "Stok is required";
        }

        $result = [
            'success' => false,
            'message' => implode(' ', $errors)
        ];
    }

    echo json_encode($result);

?>