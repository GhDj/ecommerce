<?php
/**
 * Created by PhpStorm.
 * User: ghdj9
 * Date: 16/05/2017
 * Time: 05:02
 */

ob_start();
session_start();
require_once 'db.php';

if (isset($_POST['btn-send']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];
    if (($name=="")||($email=="")||($message==""))
    {
        echo "All fields are required, please fill <a href=\"\">the form</a> again.";
    }
    else{
        $from="From: $name<$email>\r\nReturn-path: $email";
        $subject="Message sent using your contact form";
        // mail("youremail@yoursite.com", $subject, $message, $from);
        echo "Email sent!";
    }
}

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
        <?php
        include_once "menu.php";
        ?> </div>

    <div class="row container-fluid contact-title">
        <div class="container">
            <h1>CONTACT</h1>
        </div>

    </div>
    <div class="container cat-container-accueil">

        <div class="row">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" class="col-sm-6">
                <div class="form-group">
                    <label for="nom">*Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="email">*Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="message">*Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <input type="submit" name="btn-send" class="btn-connexion" value="Envoyer">
            </form>
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



</script>
</body>
</html>
<?php ob_end_flush(); ?>

