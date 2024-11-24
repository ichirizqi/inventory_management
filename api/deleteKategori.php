<?php
  header('Content-Type: application/json');
  include '../database/koneksi.php';
  
    if (isset($_POST['id'])){
        $id = $_POST['id'];

        $query = mysqli_query($koneksi, "DELETE FROM kategori_produk WHERE id = '$id'");

        if ($query){
            $result = [
                'success' => true,
                'message' => "Data Success Deleted"
            ];
        }else{
            $result = [
                'success' => false,
                'message' => "Data Failed Deleted"
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