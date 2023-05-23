
<?php
/* $server = 'sql201.epizy.com';
$username = 'epiz_30047651';
$password = '5Bl6sy0gRNbr';
$database = 'epiz_30047651_yoreceto';
try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}
 */
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'yoreceto2.0';
try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>