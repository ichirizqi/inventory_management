<?php

header("Content-Type: application/json");
include "../database/koneksi.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "SELECT produk.id AS id_produk, kategori_produk.id AS id_kategori, kategori_produk.nama AS nama_kategori, produk.nama AS nama_produk, produk.stok AS stok FROM produk INNER JOIN kategori_produk ON produk.id_kategori = kategori_produk.id WHERE produk.id = '$id'");

    $cek = mysqli_num_rows($query);

    if($cek>0 && $query){
        $data = mysqli_fetch_assoc($query);

        $result = [
            'success' => true,
            'message' => "Berhasil Menampilkan Data by ID",
            'data' => $data
        ];
    }else{
        $result = [
            'success' => false,
            'message' => "Gagal Load Data by ID"
        ];
    }

}else{
    $result = [
        'success' => false,
        'message' => "ID Not Found"
    ];
}

echo json_encode($result);

?>