<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 13/05/2017
 * Time: 02:56
 */

include_once "admin_verif.php";

$res = mysqli_query($db,"SELECT * FROM produits");

?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Utilisateurs</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css"  />
    <link rel="stylesheet" href="../css/style.css" type="text/css" />
</head>
<body>

<div id="wrapper">

    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                    Espace Maison
                </a>
            </li>
            <li>
                <a href="index.php">Tableau de bord</a>
            </li>
            <li>
                <a href="list_produit.php">Produits</a>
            </li>
            <li>
                <a href="list_categorie.php">Catégories</a>
            </li>
            <li>
                <a href="list_user.php">Utilisateurs</a>
            </li>

        </ul>
    </div>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <a href="#menu-toggle" class="" id="menu-toggle"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></a>

                    <p>
    <div class="form-group col-sm-6">
        <h2 class="">Produits</h2>

    </div>
    <div class="col-sm-6 text-right">

        <a role="button" class="btn btn-sm btn-success" href="ajout_produit.php">Ajouter produit</a>
    </div>

    <div class="form-group">
        <hr />
    </div>
    <div class="row clearfix"></div>

    <div class="row">
        <div class="col-sm-12 table-responsive">

            <table class="table table-condensed">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Nom</td>
                    <td>Ref</td>
                    <td>Prix</td>
                </tr>
                <tbody>
                <?php
                if (mysqli_num_rows($res) > 0)
                {
                    //$res = mysqli_fetch_assoc($res);
                    while ($prod = mysqli_fetch_assoc($res))
                    {
                        ?>
                        <tr>
                            <td><?php
                                echo $prod['id'];
                                ?></td>
                            <td><?php
                                echo $prod['name'];
                                ?></td>
                            <td><?php
                                echo $prod['ref'];
                                ?></td>
                            <td><?php
                                echo $prod['prix'];
                                ?></td>
                            <?php
                            echo '<td><a role="button" class="btn btn-sm btn-danger" href="supp_produit.php?id=' . $prod['id'] . '">Supprimer</a></td>';
                            ?>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    echo '<tr><td colspan="5">Rien à affichier</td></tr>';
                }
                ?>
                </tbody>
                </thead>
            </table>
        </div>
    </div>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="../js/jquery-1.11.3-jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
</body>
</html>