<?php
header("Content-Type: application/json");
include "../database/koneksi.php";

if($_SERVER['REQUEST_METHOD'] === "PATCH"){
    $input = json_decode(file_get_contents("php://input"), true);
    
    if(isset($input['id']) && !empty($input['id']) &&
        isset($input['stok']) && !empty($input['stok']) &&
        isset($input['tipe']) && !empty($input['tipe'])
    ){
        $id = $input['id'];
        $stok = $input['stok'];
        $tipe = $input['tipe'];

        $query = mysqli_query($koneksi, "SELECT * FROM PRODUK WHERE id = '$id'");
        $cek = mysqli_num_rows($query);

        if($cek > 0){
            $data = mysqli_fetch_assoc($query);
            $stok_sekarang = $data['stok'];

            if($tipe == "masuk"){
                $stok_baru = $stok_sekarang + $stok;
            }else{
                if($stok_sekarang < $stok){
                    echo json_encode([
                        'success' => false,
                        'message' => "Stok tidak mencukupi"
                    ]);
                    exit;
                }else{
                    $stok_baru = $stok_sekarang - $stok;
                }
            }

            $query_update = mysqli_query($koneksi, "UPDATE produk SET stok = '$stok_baru' WHERE id = '$id'");
            if($query_update){
                $result = [
                    'success' => true,
                    'message' => "Stok berhasil diupdate"
                ];
            }else{
                $result = [
                    'success' => false,
                    'message' => "Gagal update stok"
                ];
            }
        }
    }else{
        $errors = [];

        if(empty($input['id'])){
            $errors = "ID is required";
        }
        if(empty($input['Stok'])){
            $errors = "Stok is required";
        }
        if(empty($input['tipe'])){
            $errors = "Tipe is required";
        }

        $result = [
            'success' => false,
            'message' => implode(', ', $errors)
        ];
    }
}

echo json_encode($result);

?>