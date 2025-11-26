<?php
require_once "../session.php";
deny_if_not_logged_in();
require_once "../conn.php";


$id = $_GET['id'];

$conn->query("DELETE FROM transaksi_detail WHERE transaksi_id=$id");
$conn->query("DELETE FROM transaksi WHERE id=$id");

header("Location: transaksi.php");
