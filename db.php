<?php
/**
 * Created by PhpStorm.
 * User: ghdj
 * Date: 09/05/2017
 * Time: 02:17
 */

$host = "localhost";
$user = "root";
$pass = "";
$db_name = "ecommerce";

$db = mysqli_connect($host,$user,$pass,$db_name);

if (!$db) {
    echo "Erreur: Impossible de connecter à MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
