<?php
// Password yang akan di-hash
$password = 'admin123';

// Menghasilkan hash dengan algoritma bcrypt
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Menampilkan hasil hash
echo $hashedPassword;
?>
