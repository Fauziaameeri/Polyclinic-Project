<?php
//Turn on error reporting -- this is critical!
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// If the user is not logged in
if (empty($_SESSION['username'])) {

    // Store the current page in the session
    $_SESSION['page'] = "form.php";

    // Redirect user to login page
    header('location: Main.php');
}

?>


<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="image/img.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!--Title-->
    <title>Create New Contact</title>

    <link rel="stylesheet" href="styles/form.css">

</head>
<body>

<!--Header Create New Form Contact-->
<div id="main" class="container border rounded py-3">
    <div class="jumbotron d-flex align-items-center">
        <img class = "logo" src ="image/img.png" alt="logo" height="70px">
        <h1 class ="logo">nyDex</h1>
    </div>

    <!--Nav Links -->
    <nav class="navbar navbar-expand-sm bg-dark mb-3">
        <ul id="myUL" class="navbar-nav">
            <li>
                <a href="Main.php?link2" class="btn btn-outline-primary btn-lg active mx-4" role="button" aria-pressed="true">Main Page</a>
            </li><!--Li-->
            <li class="nav-item"><?php
                if (isset($_SESSION['username'])
                ){
                    echo'<button type="button" onclick="document.location=\'logout.php\'" class="btn btn-outline-danger danger btn-lg active mx-4">Logout</button>';
                }
                ?></li>

        </ul><!--ul -->
    </nav><!--nav-->
    <!-- update: added onsubmit prop -->
    <form id="create-form" action="php/dataHolder.php" method="post">

        <!-- Contact Info Medical Records -->
        <h4 class="d-md-inline pt-2 col-sm-2">Medical Record: </h4>
        <div>
            <div class="form-group">

                <!--IMP: update: added labels and error spans for ALL input fields in this group-->
                <div class="form-group">
                    <label for="hname">Please enter Hospital Name</label>
                    <input type="text" id="hname" name="hname" class="form-control"
                           placeholder="Enter Hospital Name">
                    <span class="err" id="err-hname">A hospital name is required</span>
                </div>

                <!-- update: added separate field for city -->
                <div class="form-group">
                    <label for="city">Please enter Hospital City</label>
                    <input type="text" id="city" name="city" class="form-control" placeholder="Enter City">
                    <span class="err" id="err-city">A city name is required</span>
                </div>

                <!-- update: added separate field for state -->
                <div class="form-group">
                    <label for="state">Please enter Hospital State</label>
                    <input type="text" id="state" name="state" class="form-control" placeholder="Enter State">
                    <span class="err" id="err-state">A state is required</span>
                </div>

                <h4 class="d-md-inline pt-2 col-sm-2">Main Phone: </h4>
                <div class="form-group">
                    <span class="err" id="err-aphone">Please enter either a main phone number OR a film library number</span>
                    <label for="phone">Please enter Phone Number</label>

                    <input name="phone" type="tel" id="phone" class="form-control" placeholder="Enter phone">
                    <span class="err" id="err-phone">A main phone number is required</span>
                </div>
                <div class="form-group">
                    <label for="fax_num">Please enter Fax Number</label>

                    <input type="tel" id="fax_num" name="fax_num" class="form-control"
                           placeholder="Enter Fax Number">
                    <span class="err" id="err-fax">A main fax number is required</span>
                </div>
            </div>
        </div>

        <!--Contact Film Library-->
        <h4 class="d-md-inline pt-2 col-sm-2">Film Library: </h4>
        <div>
            <div class="row-8">

                <!--IMP: update: added labels and error spans for ALL input fields in this group-->
                <div class="form-group">
                    <label for="filmNum">Please enter Film Phone Number</label>
                    <input type="tel" id="filmNum" name="filmNum" class="form-control"
                           placeholder="Enter phone">
                    <span class="err" id="err-film-phone">A film library number is required</span>
                </div>
                <div class="form-group">
                    <label for="film_fax_num">Please enter Film Fax Number</label>
                    <input type="tel" id="film_fax_num" name="film_fax_num" class="form-control"
                           placeholder="Enter Fax Number">
                    <span class="err" id="err-film-fax">A film library fax number is required</span>
                </div>
            </div>
        </div>

        <!--Check boxes for procedures-->
        <h4 class="d-md-inline pt-2 col-sm-2">Please Select the Procedure: </h4>
        <div>
            <div class="row-8">
                <div class="form-group">

                    <!-- update: the names of the scans -->
                    <div class="form-check">
                        <input type="checkbox" name = "procedure[]" class="form-check-input" value = "xr" id="xr">
                        <label class="form-check-label" for="xr">XR</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name = "procedure[]" class="form-check-input" value = "us" id="us">
                        <label class="form-check-label" for="us">US</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name = "procedure[]" class="form-check-input" value = "mri" id="mri">
                        <label class="form-check-label" for="mri">MRI</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name = "procedure[]" class="form-check-input" value = "ct" id="ct">
                        <label class="form-check-label" for="ct">CT</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name = "procedure[]" class="form-check-input" value = "mg" id="mg">
                        <label class="form-check-label" for="mg">MG</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name = "procedure[]" class="form-check-input"  value = "path" id="path">
                        <label class="form-check-label" for="path">PATH</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox"name = "procedure[]"  class="form-check-input" value = "dexa" id="dexa">
                        <label class="form-check-label" for="dexa">Dexa</label>
                    </div>

                    <span class="err" id="err-images">Please select at least [1] image type</span>
                </div>
                <br>

                <!--Availability select yes, no, push-->
                <div class="form-group" id="avilForm">
                    <label for="push_option">Push Capability</label>
                    <select class="form-control" name = "push_option" id="push_option">

                        <option value = "none"> -- select an option -- </option>
                        <option value="Push">Yes</option>
                        <option value="no">No</option>
                        <option value="Swedish Only">Push only to Swedish</option>
                    </select>
                    <span class="err" id="err-push">Please select an option</span>
                </div>
                <br>

                <!--Notes or comments input-->
                <div class="mb-3 form-group" id="noteBox">
                    <label for="formControlTextarea1">Notes</label>
                    <textarea class="form-control" id="formControlTextarea1" name = "comments" rows="3"></textarea>
                </div>
            </div>
        </div>

        <div class="row justify-content-start mb-3">
            <div class="form-group ml-2">
                <!-- Submit Button -->
                <button type="submit" class="btn btn-dark px-5 my-lg-n5 form-control">Submit</button>
            </div>
        </div>
    </form>
</div>



<script src="scripts/form.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<!--<script type="text/javascript">(function(){window['__CF$cv$params']={r:'6db31180190d6816',m:'gy.sQBkldCazk5bYoS1wvKJPYkUXPLtZTszsc8dBFxY-1644472314-0-AXgS9WpY7ZY/xFQCVDGiEufZtf0jq3+KzBp953EiUhDc7P1VxSk4xcjjIjkctyidZNZCFCYna5+PviptiXCRylehnkrTN5gZA8p0OUU+HwroxzCap+TIFMx8u++8sTWz3uoN72Qst/hfTdHGnZ77IheoMR0Omnu8Yl8hhRP5hUpPrL6vb658MYor7Mtb60wnWA==',s:[0x00d9d91092,0x6039d35826],}})();</script>-->
</body>
</html>