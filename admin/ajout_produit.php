<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 11/05/2017
 * Time: 03:46
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

    $prix = trim($_POST['prix']);
    $prix = strip_tags($prix);
    $prix = htmlspecialchars($prix);

    $ref = trim($_POST['ref']);
    $ref = strip_tags($ref);
    $ref = htmlspecialchars($ref);

    $categorie = trim($_POST['categorie']);
    $categorie = strip_tags($categorie);
    $categorie = htmlspecialchars($categorie);
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
    /***** Image upload ***/

    $target_dir = "./img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    if(isset($_POST["btn-ajout'"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            echo "Le fichier n'est pas une image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
            die();
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        echo "Ce fichier existe déjà.";
        $uploadOk = 0;
        die();
    }
// Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        die();
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "GIF"  ) {
        echo "Le fichier doit etre JPG, JPEG, PNG & GIF.";
        $uploadOk = 0;
        die();

    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        $temp = explode(".", $_FILES["image"]["name"]);
        $image = $name. '.' . end($temp);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], "../img/".$image)) {
            echo "The file ". $image. " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
            die();
        }
    }

    /******** End image upload ***/
    if( !$error ) {

        $query = "INSERT INTO produits(name,ref,prix,description,image, categorie) VALUES('$name','$ref','$prix','$description','$image', $categorie)";
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
    <title>Ajouter produit</title>
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
                    <h1>Ajouter produit</h1>

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
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input type="text" name="ref" class="form-control" placeholder="Reférence " maxlength="50"/>
            </div>
            <?php if (isset($refError)){
                ?>
                <span class="text-danger"><?php echo $refError; ?></span>
            <?php } ?>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                <input type="prix" name="prix" class="form-control" placeholder="Prix" maxlength="40"/>
            </div>
            <?php if (isset($prixError)){
                ?>
                <span class="text-danger"><?php echo $prixError; ?></span>
            <?php } ?>
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
            <div class="input-group">
                <select name="categorie" id="categorie-select" class="form-control">
                    <option value="0">Non classé</option>
                    <?php
                    $cat = mysqli_query($db,"SELECT * FROM categories");
                    while ($c = mysqli_fetch_assoc($cat))
                    {
                        ?>
                        <option value="<?php echo $c['id'] ?>"><?php echo $c['nom']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                <input type="file" class="form-control" name="image">
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