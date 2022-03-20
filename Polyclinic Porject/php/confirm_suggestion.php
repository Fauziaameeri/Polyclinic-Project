<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" href="../image/img.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/form.css">
    <!--Title-->
    <title>Thanks!</title>
</head>
<body>
<!--Header Create New Form Contact-->
    <div id="main" class="container border rounded py-3 vh-100">
        <div class="jumbotron d-flex align-items-center">
            <img class = "logo" src ="../image/img.png" alt="logo" height="70px">
            <h1 class ="logo">nyDex</h1>
        </div>

        <div class = "row justify-content-end">
            <div class = "col-2">
                <button onclick = "document.location = '../Main.html'" id = "exit" class = "btn btn-dark">Back to Main Page</button>
            </div>
        </div>

        <div class = "text-center mt-5">
            <h2 class = "mb-5">Thank you for submitting a suggestion!</h2>
        </div>


        <?php

        $name = $_POST['ename'];
        $email = $_POST['eemail'];
        $sugg = $_POST['sugEntry'];
        ?>

        <?php
        include("includes/sendEmail.php");
        ?>

        </div>
    </body>
</html>