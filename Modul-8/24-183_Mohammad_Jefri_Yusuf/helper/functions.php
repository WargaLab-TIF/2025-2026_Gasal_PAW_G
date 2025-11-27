<?php 

// Fungsi Cek Login
function cekLogin() {
    if (!isset($_SESSION["login"])) {
        header("Location: /2025-2026_Gasal_PAW_G/Modul-8/24-183_Mohammad_Jefri_Yusuf/auth/login.php");
        exit;
    }
};

function cekOwner() {
    if ($_SESSION['level'] !== 1) {
        header("Location: /2025-2026_Gasal_PAW_G/Modul-8/24-183_Mohammad_Jefri_Yusuf/index.php");
        exit;
    }
}


// Fungsi Ambil Data dari Database
function getData($conn, $query) {
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
};


?>