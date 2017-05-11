<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 11/05/2017
 * Time: 03:32
 */

ob_start();
session_start();

include_once "db.php";

$m= $_SESSION['user'];

$res=mysqli_query($db,"SELECT id, fname, password,role FROM users WHERE id=$m");
$row=mysqli_fetch_array($res);
$count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

if( $count == 1) {

    if ($row['role'] == 0)
    header("Location: admin/index.php");
    else
        header("Location: index.php");


}

?>


