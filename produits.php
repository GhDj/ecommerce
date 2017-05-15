<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 14/05/2017
 * Time: 13:48
 */

 ob_start();
 session_start();
 require_once 'db.php';


if (isset($_GET['id']))
{
    $id = $_GET['id'];
    $produits = mysqli_query($db,"SELECT * FROM produits WHERE categorie=$id");
} else {
    $produits = mysqli_query($db,"SELECT * FROM produits");
}


/* if( !isset($_SESSION['user']) ) {
     header("Location: register.php");
     exit;
 }*/
if (isset($_SESSION['user']))
    $res=mysqli_query($db,"SELECT * FROM users WHERE id=".$_SESSION['user']);
else {
    $res = false;
}

if (!$res) {
    $userRow = [
        'fname' => '',
        'lname' => '',
        'email' => ''
    ];
} else {
    $userRow=mysqli_fetch_array($res);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Espace Maison - Produits</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>

<?php
include_once "navbar.php";
?>

<div id="wrapper-page">


    <div id="menubar-wrapper">
        <ul class="menubar-nav">

            <li>
                <a href="index.php">
                    <img src="img/produits.png" alt="">
                </a>
                <a href="index.php">
                    <span class="menu-item">PRODUITS</span>
                </a>
                <ul class="sous-menu">
                    <li><a href="#">TOUS LES PRODUITS</li></a>
                    <li><a href="#">FOOD STORAGE BOX</li></a>
                </ul>
            </li>
            <li>
                <a href="list_produit.php">
                    <img src="img/promotions.png" alt="">
                </a>
                <a href="index.php">
                    <span class="menu-item">PROMOTIONS</span>
                </a>
                <ul class="sous-menu">
                    <li><a href="#">NOUVEAUTES</li></a>
                </ul>
            </li>
            <li>
                <a href="list_categorie.php">
                    <img src="img/catalogues.png" alt="">
                </a>
                <a href="index.php">
                    <span class="menu-item">CATALOGUES</span>
                </a>
                <ul class="sous-menu">
                    <li><a href="#">CATALOGUE 1</li></a>
                </ul>
            </li>
            <li>
                <a href="list_user.php">
                    <img src="img/contact.png" alt="">
                </a>
                <a href="index.php">
                    <span class="menu-item">CONTACT</span>
                </a>
                <ul class="sous-menu">
                    <li><a href="#">QUI SOMME NOUS?</li></a>
                </ul>
            </li>

        </ul>
    </div>


<div id="header-cat-container">
    <?php


    if (isset($_GET['id'])) {

        $cat = mysqli_query($db, "SELECT * FROM categories WHERE id=$id");
        $cat = mysqli_fetch_array($cat);
        ?>
        <img src="img/<?php echo $cat['image']; ?>" alt="" class="img-responsive">
        <h2 id="cat-title">
            <?php echo $cat['nom']; ?>
        </h2>
        <?php
    }
    ?>
</div>

    <div class="container cat-container-accueil">
        <div class="row">
            <?php

            if (mysqli_num_rows($produits) > 0)
            {
                while ($p = mysqli_fetch_assoc($produits)){
                   // echo $p['image'];
                    ?>
                    <div class="col-sm-3">
                        <div class="produit-container">
                            <img src="img/<?php echo $p['image']; ?>" alt="" class="img-responsive">
                            <h4><?php echo $p['name']; ?></h4>
                            <h4><?php echo $p['prix']; ?></h4>
                        </div>
                    </div>
            <?php
                }
            }
            else {
                echo "Aucun produits";
            }
            ?>
        </div>


    </div>

</div>

<?php
include_once "footer.php";
?>

<script src="js/jquery-1.11.3-jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $("#top-menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper-page").toggleClass("toggledm");
    });
</script>
</body>
</html>
<?php ob_end_flush(); ?>

