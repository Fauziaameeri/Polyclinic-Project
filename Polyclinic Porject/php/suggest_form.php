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
    <title>Suggest an Edit</title>

</head>
<body>
<!--Header Create New Form Contact-->
<div id="main" class="container border rounded py-3 vh-100">
    <div class="jumbotron d-flex align-items-center">
        <img class = "logo" src ="../image/img.png" alt="logo" height="70px">
        <h1 class ="logo">nyDex</h1>
    </div>

    <form id="sugg-form" action="confirm_suggestion.php" method="post" class ="pb-5">

        <!-- Suggestion Form -->
        <h4 class="d-md-inline pt-2 col-sm-2">Please enter your suggestion: </h4>
        <div>
                <div class="form-group mt-4 mb-5">
                    <label for = "ename">Employee name</label>
                    <input type="text" id="ename" name="ename" class="form-control" placeholder="Please enter your full name">
                    <span class="err" id="err-ename">Please enter your name</span>
                </div>
                <div class="form-group mb-5">
                    <label for = "eemail">Employee email</label>
                    <input type="email" id="eemail" name="eemail" class="form-control" placeholder="Please enter your email address">
                    <span class="err" id="err-eemail">Please enter a valid email</span>
                </div>
                <div class="mb-5 form-group" id="noteBox">
                    <label for="sugEntry">Suggestion</label>
                    <textarea class="form-control" id="sugEntry" name = "sugEntry" rows="3"></textarea>
                    <span class = "err" id="err-sugEntry">Please enter your suggestion</span>
                </div>
        </div>
        <div class="form-group ml-2">
            <!-- Submit Button -->
            <button type="submit" class="btn btn-dark px-5 my-lg-n5 form-control" id = "sg_btn">Submit</button>
        </div>
    </form>
</div>

<!--JavaScript -->
<script src = "../scripts/sugg.js"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>