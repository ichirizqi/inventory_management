<?php
header('Content-Type: application/json');
include '../database/koneksi.php';

if(isset($_POST['nama']) && !empty($_POST['nama'])){
    $nama = $_POST['nama'];

    $query = mysqli_query($koneksi, "INSERT INTO kategori_produk (nama) VALUES ('$nama')");
    if($query){
        $result = [
            'success' => true,
            'message' => 'Data successfully inserted.'
        ];
    }else {
        $result = [
            'success' => false,
            'message' => 'Failed to insert data'
        ];
    }
}else{
    $result = [
        'success' => false,
        'message' => "Nama is required"
    ];
}


echo json_encode($result)

?>