<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 15/05/2017
 * Time: 08:08
 */

ob_start();
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: connexion.php");
} else if(isset($_SESSION['user'])=="") {
    header("Location: connexion.php");
}

include_once "db.php";

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
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Espace Maison - Livraison</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <?php
    $a = json_decode($_COOKIE['cart']);
    ?>

    <script>

        tot = 0;
        x = JSON.parse(localStorage.getItem("cart"));
        for (i = 0 ; i < x.length ; i++)
        {
            tot+= x[i]["qty"] * x[i]["obj"]["prix"];
        }

        //localStorage.removeItem("cart");
    </script>
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




    <div class="container cat-container-accueil">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-3 step"><a href="panier.php">01 PANIER</a> </div>
                        <div class="col-sm-3 step "><a href="register.php">02 IDENTIFICATION</a></div>
                        <div class="col-sm-3 step"><a href="livraison.php">03 LIVRAISON</a></div>
                        <div class="col-sm-3 step  active-step"><a href="panier.php">04 PAIEMENT</a></div>
                    </div>
                    <div class="row">

                        <h3 class="liv-title">
                            MON MODE DE PAIEMENT SECURISE :
                        </h3>
                        <hr />
                        Montant de la transaction : <span id="totale"></span> DT
                        <img src="img/edinar.jpg" alt="" class="img-responsive">
                        <h3 class="liv-title">
                            Numéro de carte :
                        </h3>
                        <hr />
                        <input type="text" name="codepostale" class="form-control" style="max-width: 350px; ">

                        <button class="btn-connexion">Je termine ma commande</button>

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="row info">
                        <div class="col-sm-2">
                            <img src="img/phone.png" alt="">

                        </div>
                        <div class="col-sm-10">
                            71 378 678 </br>

                            <span>Contactez notre service client*.</span>
                        </div>
                    </div>
                    <div class="row info">
                        <div class="col-sm-2">
                            <img src="img/bag.png" alt="">
                        </div>
                        <div class="col-sm-10">
                            <p>
                                Paiement 100% sécurisé.
                            </p>
                        </div>
                    </div>
                    <div class="row info">
                        <div class="col-sm-2"><img src="img/truc.png" alt=""></div>
                        <div class="col-sm-10">
                            <p>
                                Frais de livraison offerts
                                à partir de 50 DT  d'achat.
                            </p>
                        </div>
                    </div>
                    <div class="row info">
                        <div class="col-sm-2"><img src="img/24.png" alt=""></div>
                        <div class="col-sm-10">
                            <p>Livraison en 24 H
                                suite à la prise en charge
                                du transporteur.</p>
                        </div>
                    </div>
                </div>
            </div>



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
    document.getElementById("totale").innerHTML = tot;

</script>

</body>
</html>
<?php ob_end_flush(); ?>

