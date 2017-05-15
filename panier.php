<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 14/05/2017
 * Time: 17:48
 */


ob_start();
session_start();
require_once 'db.php';

$id=2;


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
    <title>Espace Maison - Produits</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <script>
        function createCookie(name,value,days) {
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days*24*60*60*1000));
                var expires = "; expires=" + date.toUTCString();
            }
            else var expires = "";
            document.cookie = name + "=" + value + expires + "; path=/";
        }

        function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }

        function eraseCookie(name) {
            createCookie(name,"",-1);
        }



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
                        <div class="col-sm-3 step active-step"><a href="panier.php">01 PANIER</a> </div>
                        <div class="col-sm-3 step "><a href="register.php">02 IDENTIFICATION</a></div>
                        <div class="col-sm-3 step "><a href="livraison.php">03 LIVRAISON</a></div>
                        <div class="col-sm-3 step "><a href="paiement.php">04 PAIEMENT</a></div>
                    </div>
                    <div class="row">

                        <p>
                            <span class="glyphicon glyphicon-chevron-left"></span> <a href="produits.php"> Continuer votre shopping</a>
                        </p>
                        <table class=" table table-responsive">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>PRODUITS</td>
                                    <td>QUANTITE</td>
                                    <td>PRIX UNITAIRE</td>
                                    <td>TOTAL</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody id="panier-items">

                            </tbody>
                        </table>

                        <p>
                            Nous acceptons les méthodes de paiements suivants : <img src="img/edinar.jpg" alt="">

                        </p>
                        <p>
                           <span class="glyphicon glyphicon-chevron-left"></span> <a href="produits.php"> Continuer votre shopping</a>
                            <a id="commander" class="pull-right btn-connexion" role="link" href="livraison.php">Commander</a>
                        </p>
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

    var cart = [];
    function saveToLocalStorage(data) {
        localStorage.setItem('cart', JSON.stringify(data));
    }
    if (localStorage.getItem('cart') !== null) {
        var item = JSON.parse(localStorage.getItem('cart'));
        for (var i = 0; i < item.length; i++) {
            cart.push(item[i]);
            console.log(item[i])
            var output = '<tr>'+
                '<td>'+
               ' <img src="img/'+item[i]["obj"]["image"]+'" alt="" class="img-responsive">'+
               ' </td>'+
               ' <td>'+
              ' '+item[i]["obj"]["name"]+''+
           ' </td>'+
            'td>'+
           ' <select name="qty" id="qty">'+
              '  <option value="1">1</option>'+
               ' <option value="2">2</option>'+
               ' <option value="3">3</option>'+
               ' <option value="4">4</option>'+
               ' <option value="5">5</option>'+
               ' <option value="6">6</option>'+
               ' <option value="7">7</option>'+
               ' <option value="8">8</option>'+
               ' <option value="9">9</option>'+
               ' <option value="10">10</option>'+
               ' </select>'+
               ' </td>'+
               ' <td>'+item[i]["qty"]+'</td>'+
           ' <td>'+item[i]["obj"]["prix"]+'</td>'+
           '<td>'+parseInt(item[i]["obj"]["prix"])*parseInt(+item[i]["qty"])+'</td>'+
                ' <td>'+
            '<button class="btn-remove" id="'+item[i]["id"]+'">X</button>'+
               '</td>'+
               '</tr>';
            $('#panier-items').append(output);
        }
    }
    createCookie("cart",JSON.stringify(cart),1);
    $("#panier-items").on("click",".btn-remove",function () {
        $(this).parent().parent().remove();
        var id = parseInt($(this).attr("id"));

        for (i=0;i < cart.length; i++)
        {
            console.log(cart);
            if (cart[i]["id"] == id)
            {
                cart.splice(i,1);
            }
        }
        saveToLocalStorage(cart);
        createCookie("cart",cart,1);
    });

</script>

</body>
</html>
<?php ob_end_flush(); ?>

