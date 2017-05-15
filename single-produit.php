<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 14/05/2017
 * Time: 16:59
 */


ob_start();
session_start();
require_once 'db.php';

$id = $_GET['id'];


/* if( !isset($_SESSION['user']) ) {
     header("Location: register.php");
     exit;
 }*/
if (isset($_SESSION['user']))
    $res = mysqli_query($db, "SELECT * FROM users WHERE id=" . $_SESSION['user']);
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
    $userRow = mysqli_fetch_array($res);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Espace Maison - Produits</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
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
                    <li><a href="#">TOUS LES PRODUITS</li>
                    </a>
                    <li><a href="#">FOOD STORAGE BOX</li>
                    </a>
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
                    <li><a href="#">NOUVEAUTES</li>
                    </a>
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
                    <li><a href="#">CATALOGUE 1</li>
                    </a>
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
                    <li><a href="#">QUI SOMME NOUS?</li>
                    </a>
                </ul>
            </li>

        </ul>
    </div>


    <div class="container cat-container-accueil">
        <div class="row">
            <?php
            $produits = mysqli_query($db, "SELECT * FROM produits WHERE id=$id");
            if (mysqli_num_rows($produits) > 0) {
                while ($p = mysqli_fetch_assoc($produits)) {
                    // echo $p['image'];
                    ?>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <img src="img/<?php echo $p['image']; ?>" alt="" class="img-responsive"></div>
                        <div class="col-sm-6">
                            <h2><?php echo $p['name']; ?></h2>
                            <h3><?php echo $p['description']; ?></h3>

                            Quantité :
                            <div class="input-group col-sm-3">
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus"
                      data-field="quant[1]">
                  <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
                                <input type="hidden" name="qty" value="<?php echo $p['id']; ?>" id="id">
                                <input type="hidden" name="ob" value='<?php echo json_encode($p); ?>' id="ob">

                                <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1"
                                       max="10" id="qty">
                                <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
                            </div>

                            <hr/>
                            <div class="col-sm-6"><h4 id="prix"><?php echo $p['prix']; ?></h4> </div>
                            <div class="col-sm-6"><button id="btn-ajout-panier">AJOUTER AU PANIER</button></div>
                            <div class="col-sm-12" id="ajout-succ">
                                <p class="bg-success"> <span class="glyphicon glyphicon-info-sign"></span>Ajout effectué </p>
                            </div>


                        </div>
                    </div>
                    <?php
                }
            } else {
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
    $("#top-menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper-page").toggleClass("toggledm");
    });

    //plugin bootstrap minus and plus
    //http://jsfiddle.net/laelitenetwork/puJ6G/
    $('.btn-number').click(function (e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function () {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function () {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    var localStorage = getLocalStorage();

    var cart = [];

    if (localStorage.getItem('cart') !== null) {
        var item = JSON.parse(localStorage.getItem('cart'));
        for (var i = 0; i < item.length; i++) {
            cart.push(item[i]);
        }
    }

    function getLocalStorage() {
        try {
            if (!!window.localStorage) return window.localStorage;
            else return undefined;
        } catch (e) {
            return undefined;
        }
    }

    function saveToLocalStorage(data) {
        localStorage.setItem('cart', JSON.stringify(data));
    }


    $("#btn-ajout-panier").click(function () {
        var id  = parseInt(document.getElementById('id').value);
        var qty = parseInt(document.getElementById('qty').value);
        var obj = JSON.parse(document.getElementById('ob').value);
        var myObj = {
            id: id,
            qty:qty,
            obj:obj
        };
        addToCart(myObj);

    });



    function addToCart(data) {

            for (i=0; i < cart.length; i++){

                if(parseInt(cart[i]['id']) == parseInt(data['id'])){
                    console.log(cart[i]['qty']+"---"+ data['qty']);

                    cart[i]['qty'] += data['qty'];
                    $('#ajout-succ').fadeIn().delay(1000).fadeOut();
                    saveToLocalStorage(cart);
                    return 0;
                }
            }
            cart.push(data);
            alert('dzgdsg');
            $('#ajout-succ').fadeIn().delay(1000).fadeOut();

        saveToLocalStorage(cart);
    }

    function DeleteLocalStorage(){
        localStorage.removeItem('cart');
    }


</script>
</body>
</html>
<?php ob_end_flush(); ?>

