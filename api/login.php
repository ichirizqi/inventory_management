<?php

header('Content-Type: application/json');
include "../database/koneksi.php";

if(isset($_POST['username']) && !empty($_POST['username']) &&
    isset($_POST['username']) && !empty($_POST['username'])
){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
    $user = $query->fetch_assoc();
    $cek = mysqli_num_rows($query);

    if($query){
        $result = [
            'success' => true,
            'message' => "Berhasil Login",
            'data' => [
                'id' => $user['id']
            ]
        ];
    }else{
        $result = [
            'success' => false,
            'message' => "Gagal Login"
        ];
    }

}else{
    $errors = [];

    if(empty($_POST['username'])){
        $errors = "Username is required";
    }
    if(empty($_POST['password'])){
        $errors = "Password is required";
    }

    $result = [
        'success' => false,
        'message' => implode(', ', $errors)
    ];

}

echo json_encode($result);
?>