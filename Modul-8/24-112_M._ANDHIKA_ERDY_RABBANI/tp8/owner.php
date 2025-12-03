<?php
require_once "session.php";
deny_if_not_logged_in();
require_level(1);
require_once "conn.php";
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Dashboard Owner</title></head>
<body>
<?php include "navbar.php"; ?>
<h2>Dashboard Owner (Level 1)</h2>


</body>
</html>
