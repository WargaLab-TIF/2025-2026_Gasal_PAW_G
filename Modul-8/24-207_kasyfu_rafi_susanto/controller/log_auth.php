<?php
session_start();
session_unset();
session_destroy();
header("location:../tampilan/form_login.php");

?>