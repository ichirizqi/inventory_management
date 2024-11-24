<?php 
header('Content-Type: application/json');
include '../database/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "SELECT * FROM kategori_produk WHERE id = '$id'");    
    $cek = mysqli_num_rows($query);

    if($cek > 0 && $query){
        $data = mysqli_fetch_assoc($query);

        $result = [
            'success' => true,
            'message' => "Data Found",
            'data' => $data
        ];
    }else{
        $result = [
            'success' => false,
            'message' => "Data Not Found"
        ];
    }
}else{
    $result = [
        'success' => false,
        'message' => "ID is required"
    ];
}

echo json_encode($result);


?>