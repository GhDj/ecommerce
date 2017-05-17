<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 15/05/2017
 * Time: 00:30
 */

?>


<div class="container-fluid">

    <div class="row first-bar">
        <div class="col-sm-6">
            <i class="fa fa-3x fa-facebook-official" aria-hidden="true"></i>
            <i class="fa fa-3x fa-linkedin-square" aria-hidden="true"></i>
            <i class="fa fa-3x fa-instagram" aria-hidden="true"></i>
            <i class="fa fa-3x fa-youtube-play" aria-hidden="true"></i>
        </div>
        <div class="col-sm-6">
            <div class="form-group center">
                <input type="text"  placeholder="S'inscrire au newsletter" class="inputT">
                <span class="Inscr">
           <span class="verticalLine"></span>
           <span class="spacing">S'INSCRIRE</span></div>
            </span>

        </div>
    </div>

    <div class="row second-bar">
        <div class="container">
        <div class="col-sm-3 center interline">
            <h4>PRODUITS</h4>
            <p class="minus-20"><a href="produits.php">TOUS LES PRODUITS</a></p>

            <?php
                $cate = mysqli_query($db,"SELECT * FROM categories");
                if (mysqli_num_rows($cate) > 0) {
                    while ($ca = mysqli_fetch_assoc($cate))
                    {
                        ?>
                        <p class="minus-20"><a href="produits.php?id=<?php echo $ca['id']; ?>"><?php echo $ca['nom'] ?></a></p>
            <?php
                    }
                }
            ?>

        </div>
        <div class="col-sm-3 center">
            <h4>PROMOTIONS</h4>
            <p class="minus-20"><a href="">Categorie</a></p>
        </div>
        <div class="col-sm-3 center">
            <h4>CATALOGUES</h4>
            <p class="minus-20"><a href="">Categorie</a></p>
        </div>
        <div class="col-sm-3 center">
            <h4>CONTACT</h4>
            <p class="minus-20"><a href="">Categorie</a></p>

        </div>
        </div>
        </div>

    <div class="row third-bar">
        <div class="col-sm-12 center">
            &copy; 2017 | Espace Maison
        </div>
    </div>
</div>
