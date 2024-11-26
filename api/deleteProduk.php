<?php
    
    header("Content-Type: application/json");
    include "../database/koneksi.php";

    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $query = mysqli_query($koneksi, "DELETE FROM produk WHERE id = '$id'");

        if($query){
            $result = [
                'success' => true,
                'message' => 'Success Delete Data'
            ];
        }else{
            $result = [
                'success' => false,
                'message' => 'Failed Delete Data'
            ];
        }
    }else{
        $result = [
            'success' => false,
            'message' => 'ID tidak ditemukan'
        ];
    }

    echo json_encode($result);


?>