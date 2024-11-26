<?php 
    header("Content-Type: application/json");
    include "../database/koneksi.php";

    $produk = [];
    
    $query = mysqli_query($koneksi, "SELECT produk.id AS id_produk, kategori_produk.id AS id_kategori, kategori_produk.nama AS nama_kategori, produk.nama AS nama_produk, produk.stok AS stok FROM produk INNER JOIN kategori_produk ON produk.id_kategori = kategori_produk.id");
    while($row = $query->fetch_assoc()){
        $data['id_produk'] = $row['id_produk'];
        $data['id_kategori'] = $row['id_kategori'];
        $data['nama_kategori'] = $row['nama_kategori'];
        $data['nama_produk'] = $row['nama_produk'];
        $data['stok'] = $row['stok'];

        $produk[] = $data;
    }

    echo json_encode(['data' => $produk])

?>