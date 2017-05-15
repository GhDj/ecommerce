<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 15/05/2017
 * Time: 07:07
 */


session_start();
if (!isset($_SESSION['user'])) {
    header("Location: connexion.php");
} else if(isset($_SESSION['user'])!="") {
    header("Location: connexion.php");
} else {
    header("Location: livraison.php");
}