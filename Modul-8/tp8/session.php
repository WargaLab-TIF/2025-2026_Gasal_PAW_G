<?php
session_start();

function deny_if_not_logged_in() {
    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }
}

function require_level($levels = []) {
    // $levels 
    $lvl = $_SESSION['level'] ?? null;
    if ($lvl === null) {
        header("Location: login.php");
        exit;
    }
    if (!is_array($levels)) $levels = [$levels];
    if (!in_array((int)$lvl, $levels, true)) {
        // akses ditolak
        http_response_code(403);
        echo "Akses ditolak. Anda tidak memiliki hak untuk membuka halaman ini.";
        exit;
    }
}
?>
