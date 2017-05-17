<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 11/05/2017
 * Time: 02:27
 */

 ob_start();
 session_start();
 require_once 'db.php';


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
    <title>Bienvenue - <?php echo $userRow['fname']; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>

<?php
include_once "navbar.php";
?>

<div id="wrapper-page">


    <div id="menubar-wrapper">
        <?php
        include_once "menu.php";
        ?>
    </div>



            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="img/slide1.jpg" alt="...">

                    </div>
                    <div class="item">
                        <img src="img/slide2.jpg" alt="...">

                    </div>
                    <div class="item">
                        <img src="img/slide3.jpeg" alt="...">

                    </div>

                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

    <div class="container-fluid cat-container-accueil">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-sm-5 cat-accueil">
                    <img src="img/cat1.png" alt="" class="image">
                    <p class="text">FOOD STORAGE BOXES</p>
                </div>
                <div class="col-sm-2" style="width: 5%;"></div>
                <div class="col-sm-5 cat-accueil">
                    <img src="img/cat2.jpg" alt="" class="image">
                    <p class="text">TABLEWARE & TERRACE</p>
                </div>
                <div class="col-sm-5 cat-accueil">
                    <img src="img/cat3.png" alt="" class="image img-responsive">
                    <p class="text">
                        KITCHENWARE
                    </p>
                </div>
                <div class="col-sm-2" style="width: 5%;"></div>
                <div class="col-sm-5 cat-accueil">
                    <img src="img/cat4.jpg" alt="" class="image">
                    <p class="text">ORGANIZING ARTICLES</p>
                </div>

            </div>
        </div>
        <div id="categorie5" class="">
            <img src="img/nouveaute.png" alt="">
            <p class="text">NOUVEAUTES</p>
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

