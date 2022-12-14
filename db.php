<?php
$serverName="localhost";
$userName="root";
$password="Vicdub2910."
$dbName = 'chirongroup'

$con = mysqli_connect($serverName, $userName, $password, $dbName);

if(mysqli_connect_errno()) {
    echo "failed to connect!"
    exit();
}

echo "connexion success"
?>   