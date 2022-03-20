<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
//start the session
session_start();

//Initialize variables
$un = "";
$validLogin = true;

//if the form has been submitted
if (!empty($_POST)) {
    //Get the form data
    $un = $_POST['username'];
    $pw = $_POST['password'];

    //Require the credentials file, which defines a $logins array
    require('creds.php');

    //If the username is in the array and the passwords match
    if (array_key_exists($un, $logins) && $pw == $logins[$un]) {

        //Record the username in the session array
        $_SESSION['username'] = $un;

        //Go to the page that the user came from, or else the home page
        $page = isset($_SESSION['page']) ? $_SESSION['page'] : "form.php";
        header('location: ' . $page);
    }

    //Invalid login -- set flag variable
    $validLogin = false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="image/img.png">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="styles/main.css">
    <link rel="stylesheet" media="print" href="styles/print.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <title>Home Page</title>
</head>


<!--Body, JumboTron, H1  -->
<body class="container-fluid border-rounded" style="background-color: #34495e">
<div class="jumbotron d-flex">
    <img class = "logo" src ="image/img.png" alt="logo" height="70px">
    <h1 class ="logo">nyDex</h1>
</div><!--div -->
<!--Nav toggle /collapse nav-->
<nav class="navbar navbar-expand-sm bg-dark sticky-top">
    <button class="navbar-toggler visible-lg navbar-light" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <!--Nav Links -->
    <ul id="myUL" class="navbar-nav">
        <li class="nav-item">
            <a type="button" class="nav-link btn btn-outline-primary btn-md active mx-2" data-toggle="modal" data-target="#exampleModal1">Suggestions</a>
        </li><!--li -->
        <li class ="nav-item">
            <a type="button" class="nav-link btn btn-outline-danger btn-md active mx-2" data-toggle="modal" data-target="#exampleModal">Admin Login</a>
        </li>
        <li class ="nav-item">
            <a type="button" onclick="document.location='form.php'" class="nav-link btn btn-outline-primary btn-md active mx-2">Form</a>
        </li>
        <li class="nav-item"><?php
            if (isset($_SESSION['username'])
            ){
                echo'<a type="button" onclick="document.location=\'logout.php\'" id="logout"  class="btn btn-outline-danger danger btn-md active py-2 mx-2">Logout</a>';
            }
            ?></li><!--li -->
        <li class = "nav-item">
            <a href="table.php" class="nav-link btn btn-outline-primary btn-md active mx-2" role="button" aria-pressed="true">Switch Table View</a>
        </li><!--li -->
        <li>
            <a type="button" class="nav-link btn btn-outline-primary btn-md active mx-2" onclick="window.print();return false;">Print</a>
        </li><!--li -->

    </ul><!--ul -->
    <!--Search bar-->
    <div class="form-inline ml-auto">
        <input class="py-2" type="text" placeholder="Search Facility..." id="search-bar" class="form-control" onkeyup="searchHospital()" />
    </div><!--div-->
</nav><!--nav-->

<!--Back-to-Top button-->
<button type="button" class="btn btn-danger btn-floating btn-lg" id="btnBack-Top">
    <i>Back To Top</i>
</button><!--button-->
<!--Modal login -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Admin login</h5>
            </div><!--div-->
            <div class="modal-body">
                <form class = "form-group" id = "login" method = "post" action="#">
                    <div class="form-group">
                        <label for="username" class="col-form-label">User:</label>
                        <input type="text" class="form-control" id="username" value="<?php echo $un; ?>" name="username">
                    </div><!--div-->
                    <div class = "form-group">
                        <?php
                        if (!$validLogin) {
                            echo("<span id='err-username'>Please enter a valid username</span>");
                        }
                        ?>
                    </div><!--div-->
                    <div class="form-group">
                        <label for="pass">Password:</label>
                        <input type="password" class="form-control" id="pass" name="password"/>
                    </div>
                    <?php
                    if (!$validLogin) {
                        echo('<span id="err-pass">Password not accepted</span>');
                    }
                    ?>
            </div><!--div-->
            <div class="modal-footer">
                <button onclick="document.location = 'Main.php'" id="exit" type="button" class="btn btn-secondary" data-dismiss="modal">Back to Main Page</button>
                <?php
                if (!$validLogin) {
                    echo '<button class="btn btn-primary">Login</button>';
                } else {
                    echo '<button type="submit" class="btn btn-primary">Login</button>';
                }
                ?>
            </div><!--div-->
        </div><!--div-->
        </form><!--form-->
    </div><!--div-->
</div><!--div-->
<!--Modal Suggestion-->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Please enter your suggestion: </h5>
            </div><!--div-->
            <div class="modal-body">
                <form class="form-group">
                    <div class="form-group">
                        <label for = "ename">Employee name</label>
                        <input type="text" id="ename" name="ename" class="form-control" placeholder="Please enter your full name">
                        <span class="err" id="err-ename">Please enter your name</span>
                    </div><!--div-->
                    <div class="form-group">
                        <label for = "eemail">Employee email</label>
                        <input type="email" id="eemail" name="eemail" class="form-control" placeholder="Please enter your email address">
                        <span class="err" id="err-eemail">Please enter a valid email</span>
                    </div><!--div-->
                    <div class="mb-5 form-group" id="noteBox">
                        <label for="sugEntry">Suggestion</label>
                        <textarea class="form-control" id="sugEntry" name = "sugEntry" rows="3"></textarea>
                    </div><!--div-->
                </form><!--form-->
                <div class="modal-footer">
                    <button onclick="document.location = 'Main.php'" id="exit" type="button" class="btn btn-secondary" data-dismiss="modal">Back to Main Page</button>
                    <button type="submit" class="btn btn-dark px-5 my-lg-n5 form-control" id = "sg_btn">Submit</button>
                </div><!--div-->
            </div><!--div-->
        </div><!--div-->
    </div><!--div-->
</div><!--div-->

<!--Card Hospital Info/ More button -->
<div id="hospital-cards">
    <span id="hospital-cards-loading" class="sr-only">Loading...</span>
    <!-- This is where we will create the cards using javascript after the data loads -->
</div><!--div -->

<!--Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="scripts/main.js"></script>


</body><!--Body-->
</html><!--HTML-->