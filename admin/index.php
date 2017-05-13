<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 11/05/2017
 * Time: 03:17
 */
include_once "admin_verif.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Adminstration</title>
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
                    <h1>Tableau de bord</h1>
                    <p>

                        <?php
                        $result=mysqli_query($db,"SELECT count(*) as total from produits");
                        $data=mysqli_fetch_assoc($result);

                        ?>
                        <h3>Nbr. Produit : <?php echo $data['total']; ?></h3>


                    <?php
                    $result=mysqli_query($db,"SELECT count(*) as total from users");
                    $data=mysqli_fetch_assoc($result);

                    ?>
                    <h3>Nbr. Utilisateurs : <?php echo $data['total']; ?></h3>

                    <?php
                    $result=mysqli_query($db,"SELECT count(*) as total from categories");
                    $data=mysqli_fetch_assoc($result);

                    ?>
                    <h3>Nbr. Catégories : <?php echo $data['total']; ?></h3>

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