<?php
//include database connection
require_once 'include/connect.php';
//include session.php for login session!
include 'include/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Slijterij Stuk in m’n Kraag - Account</title>

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

        <div class="col-lg-3">
            <?php
            if(!empty($sessData['userLoggedIn']) && !empty($sessData['admin'] == '1')){
            include_once 'user.php';
            $user = new User();

            $conditions['where'] = array(
            'id' => $sessData['userID'],
            );
            $conditions['return_type'] = 'single';
            $userData = $user->getRows($conditions);

            ?>
                <h1 class="my-4">Admin paneel</h1>
                <div class="list-group">
                    <a href="productlist.php" class="list-group-item">Producten</a>
                    <a href="add-product.php" class="list-group-item">Product toevoegen</a>
                    <a href="orders.php" class="list-group-item">Orders</a>
                    <a href="userlist.php" class="list-group-item">Gebruikers / Klanten</a>
                    <a href="userAccount.php?logoutSubmit=1" class="list-group-item">Uitloggen</a>
                </div>
            <?php }
            elseif(!empty($sessData['userLoggedIn']) && !empty($sessData['admin'] == '0')){
                ?>
                    <h1 class="my-4">Shop Name</h1>
                <div class="list-group">
                    <a href="my-orders.php" class="list-group-item">Mijn bestellingen</a>
                    <a href="userAccount.php?logoutSubmit=1" class="list-group-item">Uitloggen</a>
                </div>
                <?php
            }?>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            <?php
            if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
                include_once 'user.php';
                $user = new User();

                $conditions['where'] = array(
                    'id' => $sessData['userID'],
                );
                $conditions['return_type'] = 'single';
                $userData = $user->getRows($conditions);

                ?>
                <h2 class="my-4">Welkom <?php echo $userData['first_name']; ?>!</h2>
                <div class="regisFrm">
                    <p><i class="fa fa-user" aria-hidden="true"></i> <?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
                    <p><i class="fa fa-home" aria-hidden="true"></i> <?php echo $userData['street']; ?>, <?php echo $userData['place']; ?> (<?php echo $userData['province']; ?>)</p>
                    <p style="padding-left: 17px"><?php echo $userData['zipcode']; ?>, <?php echo $userData['country']; ?></p><br />
                    <p><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $userData['email']; ?></p>
                    <p><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $userData['phone']; ?></p>
                </div>
            <?php }
            else{ ?>
                <div class="regisFrm">
                    <form action="userAccount.php" method="post">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-6">
                                <h2 class="my-4">Inloggen</h2>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-6">
                                <div class="form-group has-danger">
                                    <label class="sr-only" for="email">E-Mailadres</label>
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                                        <input type="text" name="email" class="form-control" id="email"
                                               placeholder="Email" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-control-feedback">
                                    <span class="text-danger align-middle">
                                         <?php echo !empty($statusMsg)?'<i class="fa fa-close"></i><p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sr-only" for="password">Wachtwoord</label>
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                                        <input type="password" name="password" class="form-control" id="password"
                                               placeholder="Wachtwoord" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding-top: 1rem">
                            <div class="col-md-1"></div>
                            <div class="col-md-6">
                                <input type="submit" name="loginSubmit" value="Inloggen">
                                <p>Nog geen account? <a href="registration.php">Aanmelden</a></p>
                            </div>
                        </div>
                        <!--
                        <input type="email" name="email" placeholder="EMAIL" required="">
                        <input type="password" name="password" placeholder="PASSWORD" required="">
                        <div class="send-button">
                            <input type="submit" name="loginSubmit" value="LOGIN">
                        </div>
                        -->
                    </form>
                </div>
            <?php }?>

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<?php
    include "include/footer.php";
?>
</body>
</html>