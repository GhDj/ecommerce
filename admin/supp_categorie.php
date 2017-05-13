<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 13/05/2017
 * Time: 05:05
 */

include_once "admin_verif.php";

if (isset($_REQUEST['id'])) {
    $id = (int)$_REQUEST['id'];
    $sql = "DELETE FROM `categories` WHERE `id` = $id LIMIT 1;";
    $result = mysqli_query($db,$sql);
    if ($result) {
        echo '<h1>Supprimé!</h1>';
        echo '<a role="button" class="btn btn-primary" href="list_categorie.php">Retour</a>';
    } else {
        echo '<h1>Error!</h1>';
        echo '<pre>';
        var_dump($result);
        var_dump($sql);
        echo '</pre>';
        echo '<a role="button" class="btn btn-primary" href="list_categorie.php">Retour</a>';
    }
}

?>