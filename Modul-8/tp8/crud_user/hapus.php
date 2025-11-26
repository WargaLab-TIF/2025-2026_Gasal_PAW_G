<?php
require_once "../session.php";
require_level(1);
require "../conn.php";

$id = $_GET['id'];
$conn->query("DELETE FROM user WHERE id_user=$id");
header("Location: data_user.php");
