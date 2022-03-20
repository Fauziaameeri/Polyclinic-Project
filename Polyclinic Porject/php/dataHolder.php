<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" href="../image/img.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/admin_styles.css">
    <!--Title-->
    <title>Summary Page</title>
</head>
<body>
<div id = "main" class ="container-fluid pb-5">
    <div class = "jumbotron">
        <img class = "logo d-inline" src ="../image/img.png" alt="logo" height="60px">
        <h1 class ="logo d-inline">nyDex</h1>
    </div>
    <div class = "row justify-content-center">
        <div class = " text-center col-sm-12 mb-5" id="summary-bar">
            <h3>Summary Report</h3>
        </div>
    </div>

    <div  id = "summary-holder" class = "row mt-2">
        <div class = "col-12">
<?php

// Move form data into variables
        $name = $_POST['hname'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $main_phone = $_POST['phone'];
        $main_fax = $_POST['fax_num'];
        $filmNum = $_POST['filmNum'];
        $film_lib_fax = $_POST['film_fax_num'];
        $scans = implode(", ", $_POST['procedure']);
        $push = $_POST['push_option'];
        $comments = $_POST['comments'];


        echo "<h5><b>Facility name:</b> $name </h5>";
        echo "<h5><b>City:</b> $city </h5>";
        echo "<h5><b>State:</b> $state </h5>";
        echo "<h5><b>Main Phone:</b> $main_phone </h5>";
        echo "<h5><b>Main Fax:</b> $main_fax </h5>";
        echo "<h5><b>Film Library Phone:</b> $filmNum </h5>";
        echo "<h5><b>Film Library Fax:</b> $film_lib_fax </h5>";
        echo "<h5><b>Procedures:</b> $scans </h5>";
        echo "<h5><b>Push status:</b> $push </h5>";
        echo "<h5><b>Comments:</b> $comments </h5>";

        include("connect.php");

        $sql = "SELECT `facility_name`, `city`, `state`, `main_phone`, `main_fax`, 
       `film_phone`, `film_fax`, `procedures`, `push_capability`, `notes`, `entry_date`, 
       `facility_id`
        FROM onydex
        ORDER BY facility_name DESC";


        $result = @mysqli_query($cnxn, $sql);
        //var_dump($result);

        foreach ($result as $row){
            $name = $row['hname'];
            $city = $row['city'];
            $state = $row['state'];
            $main_phone = $row['phone'];
            $main_fax = $row['fax_num'];
        }

        $sql_add = "INSERT INTO onydex (`facility_name`, `city`, `state`, `main_phone`, `main_fax`, `film_phone`, `film_fax`, `procedures`, `push_capability`, `notes`) 
       VALUES ('$name' ,'$city', '$state' , '$main_phone', '$main_fax', '$filmNum', '$film_lib_fax', '$scans', '$push', '$comments')";

        if ($cnxn->query($sql_add) === TRUE){
            echo "New record created successfully";
        } else {
            echo "Something happened! Please go back and resubmit your form.";
        }

        ?>
        </div>
        </div>
        <div class = "row justify-content-end">
            <div class = "col-2">
                <button onclick = "document.location = '../Main.html'" id = "exit" class = "btn btn-dark d-inline">Back to Main Page</button>
            </div>
        </div>
    </div>
</body>
</html>