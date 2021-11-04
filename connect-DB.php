<!-- Connecting -->
<?php
$databaseName = 'NSGIBSON_labs';
$dsn = 'mysql:host=webdb.uvm.edu;dbname=' . $databaseName;
$username = 'nsgibson_writer';
$password = 'pK7SEfTLG3sGW3Al';

$pdo = new PDO($dsn, $username, $password)
?>

<!-- Connection Complete -->