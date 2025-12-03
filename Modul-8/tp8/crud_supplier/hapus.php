<?php
require_once "../session.php";
require_level(1);
require "../conn.php";

$id = $_GET['id'];
$conn->query("DELETE FROM supplier WHERE id=$id");
header("Location: data_supplier.php");
