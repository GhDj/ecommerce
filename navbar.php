<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 11/05/2017
 * Time: 03:13
 */

?>


<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#menu-toggle" class="" id="top-menu-toggle"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></a>

        </div>
        <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><img src="img/user.png" alt=""></a></li>
                <li id="panier-link"><a href="#"><img src="img/panier.png" alt=""></a></li>
                <?php
                /*if ($userRow['lname'] != "") {

*/
                    ?>


                <!--    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php //echo $userRow['lname']; ?>
                            &nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="deconnexion.php?deconnexion"><span
                                        class="glyphicon glyphicon-log-out"></span>&nbsp;Déconnexion</a></li>
                        </ul>
                    </li>

                    <?php
             //   } else {
                    ?>
                    <li><a href="register.php">Connexion/S'inscrire</a></li>
                    <?php
              //  }-->
                ?>

            </ul>

        </div><!--/.nav-collapse -->
    </div>
</nav>

