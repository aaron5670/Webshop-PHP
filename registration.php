<?php
//include database connection
require_once 'include/connect.php';
//include session.php for login session!
include 'include/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Slijterij Stuk in m’n Kraag - Registreren</title>

    <!-- Carousel CSS -->
    <link rel="stylesheet" href="css/css-carousel/Slider_Carousel_webalgustocom.css">
    <link rel="stylesheet" href="css/css-carousel/Slider_Carousel_webalgustocom1.css">
    <link rel="stylesheet" href="css/css-carousel/Slider_Carousel_webalgustocom2.css">

    <!-- Product filter system CSS/JS-->
    <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/journal/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=News+Cycle:400,700">
    <link rel="stylesheet" href="css/Shop-item.css">

    <!-- Bootstrap CSS/JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>
<body>
<?php
//include menu
include "include/navbar.php";
?>
<!-- Page Content -->
<div class="container">

    <div class="row">


        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            <div class="row">
                <h2 class="my-4">Maak gratis uw klantaccount aan!</h2>
                <div class="container">
                    <form action="<?php if(isset($_GET['redr'])){echo "userAccount.php?redr=checkout";}else{ echo "userAccount.php";} ?>" method="post">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Voornaam</label>
                            <input type="text" name="first_name" class="form-control" placeholder="Voornaam">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Achternaam</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Achternaam">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">E-mail</label>
                            <input type="email" name="email" class="form-control" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Straatnaam + Huisnummer</label>
                            <input type="text" name="street" class="form-control" placeholder="Straatnaam 123">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Plaats</label>
                            <input type="text" name="place" class="form-control" placeholder="Plaatsnaam">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Postcode</label>
                            <input type="text" maxlength="7" name="zipcode" class="form-control" placeholder="Postcode">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Provincie</label>
                            <input type="text" name="province" class="form-control" placeholder="Provincie">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Land</label>
                            <input type="text" name="country" class="form-control" placeholder="Land">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Telefoonnummer</label>
                            <input type="text" name="phone" class="form-control" placeholder="Telefoonnummer">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Wachtwoord</label>
                            <input type="password" name="password" class="form-control" placeholder="Wachtwoord">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Herhaal wachtwoord</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Herhaal wachtwoord">
                        </div>
                        <button type="submit" name="signupSubmit" class="btn btn-primary">Aanmelden</button>
                    </form>

                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<?php
    include "include/footer.php";
?>
</body>
</html>