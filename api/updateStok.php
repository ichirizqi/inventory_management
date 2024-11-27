<?php

header("Content-Type: application/json");
include "../database/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === "PATCH") {
    $input = json_decode(file_get_contents("php://input"), true);

    if (
        isset($input['id']) && !empty($input['id']) &&
        isset($input['stok']) && !empty($input['stok']) &&
        isset($input['tipe']) && in_array($input['tipe'], ['masuk', 'keluar'])
    ) {

        $id = $input['id'];
        $stok = (int)$input['stok'];
        $tipe = $input['tipe'];

        // Fetch current stock
        $query_get_stok = mysqli_query($koneksi, "SELECT stok FROM produk WHERE id = '$id'");
        if (mysqli_num_rows($query_get_stok) > 0) {
            $data = mysqli_fetch_assoc($query_get_stok);
            $stok_sekarang = (int)$data['stok'];

            // Process stock update
            if ($tipe === 'masuk') {
                $stok_baru = $stok_sekarang + $stok;
            } elseif ($tipe === 'keluar') {
                if ($stok_sekarang < $stok) {
                    echo json_encode([
                        'success' => false,
                        'message' => "Stok tidak mencukupi untuk operasi keluar"
                    ]);
                    exit;
                }
                $stok_baru = $stok_sekarang - $stok;
            }

            // Update stock in database
            $query_update_stok = mysqli_query($koneksi, "UPDATE produk SET stok = '$stok_baru' WHERE id = '$id'");

            if ($query_update_stok) {
                echo json_encode([
                    'success' => true,
                    'message' => "Stok berhasil diperbarui",
                    'stok_terbaru' => $stok_baru
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => "Gagal memperbarui stok"
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Produk dengan ID tersebut tidak ditemukan"
            ]);
        }
    } else {
        $errors = [];
        if (empty($input['id'])) $errors[] = "ID Produk is required";
        if (empty($input['stok'])) $errors[] = "stok is required";
        if (empty($input['tipe'])) $errors[] = "Tipe (masuk/keluar) is required";

        echo json_encode([
            'success' => false,
            'message' => implode(', ', $errors)
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => "Metode tidak diizinkan"
    ]);
}

?>
