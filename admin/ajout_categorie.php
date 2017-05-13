<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 13/05/2017
 * Time: 04:42
 */


include_once "admin_verif.php";

$error = false;

if ( isset($_POST['btn-ajout']) ) {

    // clean user inputs to prevent sql injections
    $name= trim($_POST['name']);
    $name= strip_tags($name);
    $name= htmlspecialchars($name);

    $description= trim($_POST['description']);
    $description= strip_tags($description);
    $description= htmlspecialchars($description);


    // basic name validation
    if (empty($name)) {
        $error = true;
        $nameError = "Entrez le nom du produit!.";
    } else if (strlen($name) < 3) {
        $error = true;
        $nameError = "Le nom du produit doit contenir au moins 3 caractéres.";
    } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $nameError = "Le nom du produit doit être composé des caractéres alphabétiques.";
    }

    if (empty($description)) {
        $error = true;
        $descriptionError = "Entrez la discription du produit!.";
    } else if (strlen($description) < 3) {
        $error = true;
        $descriptionError = "La discription doit contenir au moins 3 caractéres.";
    } else if (!preg_match("/^[a-zA-Z ]+$/",$description)) {
        $error = true;
        $descriptionError = "Le description doit être composé des caractéres alphabétiques.";
    }

    if( !$error ) {

        $query = "INSERT INTO categories(nom,description) VALUES('$name','$description')";
        $res = mysqli_query($db,$query);

        if ($res) {
            $errTyp = "Succées";
            $errMSG = "Ajouté avec succès";
            unset($name);
            unset($ref);
            unset($prix);
            unset($description);
        } else {
            $errTyp = "danger";
            $errMSG = "Quelque chose a mal tourné, réessayez plus tard ...".mysqli_error($db);
        }

    }


}

?>




<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ajouter categories</title>
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
                        <h1>Ajouter catégorie</h1>
                        <hr />
                        <p>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">

        <div class="col-md-12">



            <?php
            if ( isset($errMSG) ) {

                ?>
                <div class="form-group">
                    <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
                        <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <input type="text" name="name" class="form-control" placeholder="Nom produit" maxlength="50"  />
                </div>
                <?php if (isset($nameError)){
                    ?>

                    <span class="text-danger"><?php echo $nameError; ?></span>
                    <?php
                }?>

            </div>



            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>

                </div>
                <?php if (isset($descriptionError)){
                    ?>
                    <span class="text-danger"><?php echo $descriptionError; ?></span>

                <?php } ?>
            </div>




            <div class="form-group">
                <hr />
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary" name="btn-ajout">Ajouter</button>
            </div>





        </div>

    </form>
                        </p>

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
</div>
</body>
</html>