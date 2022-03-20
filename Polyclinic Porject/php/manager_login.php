<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

//start the session
session_start();

//Initialize variables
$un = "";
$validLogin = true;

//If the user is already logged in
if (isset($_SESSION['username'])) {
    //Redirect to home page
    header("location: ../Main.php");
}
//if the form has been submitted
if (!empty($_POST)) {
    //Get the form data
    $un = $_POST['username'];
    $pw = $_POST['password'];

    //Require the credentials file, which defines a $logins array
    require('../creds.php');

    //If the username is in the array and the passwords match
    if (array_key_exists($un, $logins) && $pw == $logins[$un]) {

        //Record the username in the session array
        $_SESSION['username'] = $un;

        //Go to the page that the user came from, or else the home page name)
        $page = isset($_SESSION['p`age']) ? $_SESSION['page'] : "../Main.php";
        header('location: ' . $page);
    } else {
        $validLogin = false;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../image/img.png">
    <title>Admin Log-in</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Stylesheet CSS -->
    <link rel="stylesheet" href="../styles/admin_styles.css">
    <style>
        .error {
            color: firebrick;
        }
    </style>
</head>
<!--Head-->

<body>
    <!--Body-->

    <!--Header Login to add/update facility-->
    <div id="main" class="container col-12 vh-100 .mobile_login">
        <div class="jumbotron d-flex align-items-center">

            <img class="logo" src="../image/img.png" alt="logo" height="70px">
            <h1 class="logo">nyDex</h1>
        </div>
        <!--div-->
        <div class="row justify-content-end">
            <div class="col-2">

                <button onclick="document.location = '../Main.php'" id="exit" class="btn btn-dark">Back to Main
                    Page</button>
            </div>
            <!--div-->
        </div>
        <!--div-->

        <div class="row justify-content-center">
            <form class="form-group" id="login" method="post" action="">
                <!-- Login -->
                <fieldset class="form-group">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-8">
                            <h4 class="text-center ml-2">Admin Log-in</h4>
                        </div>
                        <!--div-->
                    </div>
                    <!--div-->
                    <br>
                    <div class="row d-flex justify-content-center mobile_login">
                        <div class="col-12">
                            <div class="form-group form-inline">
                                <label class="mr-sm-5 mr-0" for="username">User:</label>
                                <input type="text" class="form-control" id="username" name="username" />
                            </div>
                            <!--div-->
                            <!-- added the next 5 lines -->
                            <?php
                            if (!$validLogin) {
                                print("<span class='error' id='err-username'>Please enter a valid username</span>");
                            }
                            ?>
                        </div>
                        <!--div-->
                    </div>
                    <!--div-->


                    <div class="row justify-content-center mobile_login">
                        <div>
                            <div class="form-group form-inline">
                                <label class="mr-sm-4 form-inline" for="pass">Password:</label>
                                <input type="password" class="form-control form-inline ml-sm-1" id="pass" name="password" />
                            </div>
                            <!--div-->
                            <!-- added the next 5 lines -->
                            <?php
                            if (!$validLogin) {
                                print('<span class="error" id="err-pass">Password not accepted</span>');
                            }
                            ?>
                        </div>
                        <!--div-->
                    </div>
                    <!--div-->
                </fieldset>
                <!--fieldset-->

                <div class="row justify-content-center">
                    <div class="ml-4">
                        <button type="submit" class="btn btn-dark">Login</button>
                        <br>
                        <br>
                    </div>
                    <!--div-->
                </div>
                <!--div-->

                <div class="row justify-content-center">
                    <div id="pass_reset">
                        <a href="http://www.greenriver.edu">Forgot username and/or password?</a>
                    </div>
                    <!--div-->
                </div>
                <!--div-->

            </form>
            <!--form-->
        </div>
        <!--div-->
    </div>
    <!--div-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>
<!--Body-->

</html>
<!--HTML-->