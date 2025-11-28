<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $username = $_GET['username'] ?? '';
    $email = $_GET['email'] ?? '';
    $password = $_GET['password'] ?? '';
    $alamat = $_GET['alamat'] ?? '';
    $semester = $_GET['semester'] ?? '';
    $country = $_GET['country'] ?? '';
    $gender = $_GET['gender'] ?? '';
    $hobi = $_GET['hobi'] ?? [];

    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr><th>Nama Field</th><th>Isi Data</th></tr>";
    echo "<tr><td>Username</td><td>" . htmlspecialchars($username) . "</td></tr>";
    echo "<tr><td>Email</td><td>" . htmlspecialchars($email) . "</td></tr>";
    echo "<tr><td>Password</td><td>" . htmlspecialchars($password) . "</td></tr>";
    echo "<tr><td>Alamat</td><td>" . htmlspecialchars($alamat) . "</td></tr>";
    echo "<tr><td>Semester</td><td>" . htmlspecialchars($semester) . "</td></tr>";
    echo "<tr><td>Country</td><td>" . htmlspecialchars($country) . "</td></tr>";
    echo "<tr><td>Jenis Kelamin</td><td>" . htmlspecialchars($gender) . "</td></tr>";
    echo "<tr><td>Hobi</td><td>" . htmlspecialchars(implode(", ", (array)$hobi)) . "</td></tr>";
    echo "</table>";
} else {
    echo "<p>Silakan isi form terlebih dahulu.</p>";
}
?>