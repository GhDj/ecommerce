<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 15/05/2017
 * Time: 06:33
 */

ob_start();
session_start();
if( isset($_SESSION['user'])!="" ){
    header("Location: index.php");
}
else {
    $res = false;
}

if (!$res) {
    $userRow = [
        'fname' => '',
        'lname' => '',
        'email' => ''
    ];
}
include_once 'db.php';

$error = false;

if ( isset($_POST['btn-signup']) ) {

    // clean user inputs to prevent sql injections
    $lname= trim($_POST['lname']);
    $lname= strip_tags($lname);
    $lname= htmlspecialchars($lname);

    $fname= trim($_POST['fname']);
    $fname= strip_tags($fname);
    $fname= htmlspecialchars($fname);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    // basic name validation
    if (empty($lname)) {
        $error = true;
        $lnameError = "Entrez votre nom SVP!.";
    } else if (strlen($lname) < 3) {
        $error = true;
        $lnameError = "Le nom doit contenir au moins 3 caractéres.";
    } else if (!preg_match("/^[a-zA-Z ]+$/",$lname)) {
        $error = true;
        $lnameError = "Le nom doit être composé des caractéres alphabétiques.";
    }

    if (empty($fname)) {
        $error = true;
        $fnameError = "Entrez votre prenom SVP!.";
    } else if (strlen($fname) < 3) {
        $error = true;
        $fnameError = "Le prenom doit contenir au moins 3 caractéres.";
    } else if (!preg_match("/^[a-zA-Z ]+$/",$fname)) {
        $error = true;
        $fnameError = "Le prenom doit être composé des caractéres alphabétiques.";
    }

    //basic email validation
    if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Adresse mail invalide.";
    } else {
        // check email exist or not
        $query = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($db,$query);
        $count = mysqli_num_rows($result);
        if($count!=0){
            $error = true;
            $emailError = "Ce mail existe déjà.";
        }
    }
    // password validation
    if (empty($pass)){
        $error = true;
        $passError = "Entrer le mot de passe svp.";
    } else if(strlen($pass) < 6) {
        $error = true;
        $passError = "Le mot de passe doit contenir au moins 6 caractéres";
    }

    // password encrypt using SHA256();
    $password = hash('sha256', $pass);

    // if there's no error, continue to signup
    if( !$error ) {

        $query = "INSERT INTO users(fname,lname,email,password,role) VALUES('$lname','$fname','$email','$password',1)";
        $res = mysqli_query($db,$query);

        if ($res) {
            $errTyp = "Succées";
            $errMSG = "Enregistré avec succès, vous pouvez vous connecter maintenant";
            unset($lname);
            unset($fname);
            unset($email);
            unset($pass);
        } else {
            $errTyp = "danger";
            $errMSG = "Quelque chose a mal tourné, réessayez plus tard ...".mysqli_error($db);
        }

    }


}

if( isset($_POST['btn-login']) ) {

    // prevent sql injections/ clear user invalid inputs
    $emaillogin = trim($_POST['emaillogin']);
    $emaillogin = strip_tags($emaillogin);
    $emaillogin = htmlspecialchars($emaillogin);

    $passlogin = trim($_POST['passlogin']);
    $passlogin = strip_tags($passlogin);
    $passlogin = htmlspecialchars($passlogin);

    // prevent sql injections / clear user invalid inputs

    if(empty($emaillogin)){
        $error = true;
        $emailErrorlogin = "Entrez votre adresse e-mail.";
    } else if ( !filter_var($emaillogin,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailErrorlogin = "Entrez une adresse email valide.";
    }

    if(empty($passlogin)){
        $error = true;
        $passErrorlogin = "S'il vous plait entrez votre mot de passe
.";
    }

    if (!$error) {

        $passlogin = hash('sha256', $passlogin); // password hashing using SHA256

        $res=mysqli_query($db,"SELECT id, fname, password,role FROM users WHERE email='$emaillogin'");
        $row=mysqli_fetch_array($res);
        $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

        if( $count == 1 && $row['password']==$passlogin ) {
            $_SESSION['user'] = $row['id'];
            header("Location: verif_role.php");


        } else {
            $errMSGlogin = "Coordonnées incorrectes, essayez à nouveau...";
        }

    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IDENTIFIER</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body class="page">

<?php
include_once "navbar.php";
?>
<div class="container">

    <div class="container cat-container-accueil">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-12">

                    <div class="row" >
                        <div id="login-form" class="col-sm-6">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                                <div class="col-md-12" style="border-right: 2px solid #000;">

                                    <div class="form-group">
                                        <h2 class="">IDENTIFIER.</h2>
                                    </div>

                                    <div class="form-group">
                                        <hr />
                                    </div>

                                    <?php
                                    if ( isset($errMSGlogin) ) {

                                        ?>
                                        <div class="form-group">
                                            <div class="alert alert-danger">
                                                <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSGlogin; ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="emaillogin">*Adresse Email</label>
                                            <input type="email" name="emaillogin" class="form-control" placeholder="Email"/>
                                        </div>
                                        <?php if (isset($emailErrorlogin)) { ?>
                                            <span class="text-danger"><?php echo $emailErrorlogin; ?></span>
                                        <?php } ?>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="passlogin">*Mot de passe</label>
                                            <input type="password" name="passlogin" class="form-control" placeholder="Mot de passe" />
                                        </div>
                                        <?php if (isset($passErrorlogin)) {?>
                                            <span class="text-danger"><?php echo $passErrorlogin; ?></span>
                                        <?php } ?>
                                    </div>

                                    <div class="form-group">
                                        <hr />
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-connexion" name="btn-login">Connexion</button>
                                    </div>





                                </div>

                            </form>
                        </div>

                        <div class="col-sm-6">

                            <div class="form-group">
                                <h2>CREER UN COMPTE </h2>
                            </div>


                            <div class="form-group">
                                <hr />
                            </div>
                            <p>En créant un compte auprès de notre magasin, vous pourrez passer rapidement le processus de caisse, stocker plusieurs adresses d'expédition, afficher et suivre vos commandes dans votre compte et plus encore.</p>
                            <br>
                            <a href="inscription.php" class="btn-connexion">Créer Compte</a>
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
</body>
</html>
<?php ob_end_flush(); ?>
