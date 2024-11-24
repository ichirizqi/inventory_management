<?php

header('Content-Type: application/json');
include '../database/koneksi.php';

$kategori = [];

$query = mysqli_query($koneksi, "SELECT * FROM kategori_produk");
while($row = $query->fetch_assoc()){
    $data['id'] = $row['id'];
    $data['nama'] = $row['nama'];

    $kategori[] = $data;
}

echo json_encode(['data' => $kategori])


?>