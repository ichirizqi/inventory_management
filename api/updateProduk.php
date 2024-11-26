<?php

    header("Content-Type: application/json");
    include "../database/koneksi.php";

    if($_SERVER['REQUEST_METHOD'] === "PATCH"){
        $input = json_decode(file_get_contents("php://input"), true);

        if (
            isset($input['id']) && !empty($input['id']) &&
            isset($input['nama']) && !empty($input['nama']) &&
            isset($input['id_kategori']) && !empty($input['id_kategori'])
        ){

            $id = $input['id'];
            $nama = $input['nama'];
            $id_kategori = $input['id_kategori'];

            $query = mysqli_query($koneksi, "UPDATE produk SET nama = '$nama', id_kategori = '$id_kategori' WHERE id = '$id'");

            if($query){
                $result = [
                    'success' => true,
                    'message' => "Berhasil Update Data"
                ];
            }else{
                $result = [
                    'success' => false,
                    'message' => "Gagal Update Data"
                ];
            }
        }else{
            $errors = [];

            if(empty($input['nama'])){
                $errors[] = "Nama is required";
            }
            if(empty($input['id_kategori'])){
                $errors[] = "ID Kategori is required";
            }

            $result = [
                'success' => false,
                'message' => implode(', ', $errors)
            ];
        }
    }

    echo json_encode($result);

?>