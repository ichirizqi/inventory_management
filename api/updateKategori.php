<?php
header('Content-Type: application/json');
include '../database/koneksi.php';

if($_SERVER['REQUEST_METHOD'] == 'PUT'){
    $input = json_decode(file_get_contents("php://input"), true);

    if(isset ($input['id']) && isset($input['nama']) && !empty($input['nama'])){
        $id = $input['id'];
        $nama = $input ['nama'];
    
        $query = mysqli_query($koneksi, "UPDATE kategori_produk SET nama = '$nama' WHERE id = '$id'");
        if($query){
            $data = [
                'success' => true,
                'message' => "Data Updated"
            ];
        }else{
            $data = [
                'success' => false,
                'message' => "Data Failed Updated"
            ];
        }
        
    }else{
        $data = [
            'success' => false,
            'message' => "Nama is required"
        ];
    }
}else{
    $data = [
        'success' => false,
        'message' => "Invalid request method"
    ];
}



echo json_encode($data);

?>