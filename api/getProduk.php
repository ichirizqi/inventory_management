<?php
header('Content-Type: application/json');
include '../database/koneksi.php'; // Pastikan file koneksi benar

$query = "
SELECT 
    produk.id AS id_produk,
    kategori_produk.id AS id_kategori,
    kategori_produk.nama AS nama_kategori,
    produk.nama AS nama_produk,
    produk.stok AS stok
FROM 
    produk
INNER JOIN 
    kategori_produk ON produk.id_kategori = kategori_produk.id
";

$result = mysqli_query($koneksi, $query);

// Jika data ditemukan
if (mysqli_num_rows($result) > 0) {
$produk = [];
while ($row = mysqli_fetch_assoc($result)) {
    $produk[] = [
        'id_produk' => $row['id_produk'],
        'nama_produk' => $row['nama_produk'],
        'id_kategori' => $row['id_kategori'],
        'nama_kategori' => $row['nama_kategori'],
        'stok' => $row['stok']
    ];
}
}

echo json_encode([
    'success' => true,
    'message' => 'Data produk ditemukan',
    'data' => $produk
]);
?>
