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
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>

<?php
include_once "navbar.php";
?>

<div id="wrapper">

    <div class="container">

        <div class="page-header">
            <h3>slider</h3>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h1>promotions</h1>
            </div>
        </div>

    </div>

</div>

<script src="js/jquery-1.11.3-jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
<?php ob_end_flush(); ?>

