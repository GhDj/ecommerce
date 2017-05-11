<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 11/05/2017
 * Time: 03:44
 */

ob_start();
session_start();
include_once "../db.php";
$id = $_SESSION['user'];
$v = mysqli_query($db,"SELECT email,role FROM users WHERE id=$id");
if ($v){
    $v = mysqli_fetch_array($v);
    //print_r($v);
    if ($v['role'] != 0)
        header("Location: ../index.php");
}
?>