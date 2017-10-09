<?php
//include database connection
require_once 'include/connect.php';
//include session.php for login session!
require_once 'include/session.php';

// set customer ID in session
$_SESSION['sessCustomerID'] = 1;
?>
<html>
<head>
    <title>Slijterij - Checkout</title>

    <!-- Carousel CSS -->
    <link rel="stylesheet" href="css/css-carousel/Slider_Carousel_webalgustocom.css">
    <link rel="stylesheet" href="css/css-carousel/Slider_Carousel_webalgustocom1.css">
    <link rel="stylesheet" href="css/css-carousel/Slider_Carousel_webalgustocom2.css">

    <!-- Product filter system CSS/JS-->
    <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="css/style.css"> <!-- Custom style -->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/journal/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=News+Cycle:400,700">
    <link rel="stylesheet" href="css/Shop-item.css">

    <!-- Bootstrap CSS/JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>
<body>
<?php
    //Include navbar menu!
    include 'include/navbar.php';
?>
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h3>Overzicht van uw besteling</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="40%"><strong>Producten</strong></th>
                        <th width="10%"><strong>Aantal</strong></th>
                        <th width="20%"><strong>Prijs</strong></th>
                        <th width="15%"><strong>Totaal</strong></th>
                    </tr>
                    <?php
                    if(!empty($_SESSION["shopping_cart"]))
                    {
                        $total = 0;
                        foreach($_SESSION["shopping_cart"] as $keys => $values)
                        {
                            ?>
                            <tr>
                                <td><?php echo $values["item_name"]; ?></td>
                                <td><?php echo $values["item_quantity"]; ?></td>
                                <td>€ <?php echo $values["item_price"]; ?></td>
                                <td>€ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                            </tr>

                            <?php

                            $shippingprice = 5.50;

                            $total = $total + $shippingprice + ($values["item_quantity"] * $values["item_price"]);
                        }
                        ?>
                        <tr>
                            <td colspan="3" align="right"><strong>Verzendkosten:</strong></td>
                            <td align="right"><strong>€ <?php echo number_format($shippingprice, 2); ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><strong>Totaal:</strong></td>
                            <td align="right"><strong>€ <?php echo number_format($total, 2); ?></strong></td>
                        </tr>
                        <tr>
                            <td>
                                <small>* De totaalprijs is inclusief BTW!</small>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="col-sm-4"><br />
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
                <div class="regisFrm">
                    <h4>Uw klantgegevens</h4>
                    <p><?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
                    <p><?php echo $userData['street']; ?>, <?php echo $userData['place']; ?> (<?php echo $userData['province']; ?>)</p>
                    <p><?php echo $userData['zipcode']; ?>, <?php echo $userData['country']; ?></p>
                    <p><?php echo $userData['email']; ?></p>
                    <p><?php echo $userData['phone']; ?></p>
                </div>
            <?php }
            else{ ?>
                <div class="regisFrm">
                    <form action="userAccount.php?checkout=loginSuccess" method="post">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-11">
                                <h4 class="my-4">Inloggen / Registreren</h4>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-11">
                                <div class="form-group has-danger">
                                    <label class="sr-only" for="email">E-Mailadres</label>
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                                        <input type="text" name="email" class="form-control" id="email"
                                               placeholder="Email" required autofocus>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-11">
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
                            <div class="col-md-11">
                                <input type="submit" name="loginSubmit" value="Inloggen">
                                <p style="margin-top: 10px;">U heeft een account nodig om te kunnen afrekenen, nog geen account? Meld u <a href="registration.php?redr=checkout">hier</a> aan!</p>
                            </div>
                        </div>
                    </form>
                </div>
            <?php }?>
        </div>
        <div class="footBtn" style="">
            <a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Verder winkelen</a>
            <?php
                if (!empty($_SESSION["shopping_cart"] && !empty($sessData['userLoggedIn']) && !empty($sessData['userID']))){
                    include_once 'user.php';
                    $user = new User();
                    $conditions['where'] = array(
                        'id' => $sessData['userID'],
                    );
                    $conditions['return_type'] = 'single';
                    $userData = $user->getRows($conditions);
                    ?>
                        <a href="placeOrder.php" class="btn btn-success orderBtn">Bestelling plaatsen <i class="glyphicon glyphicon-menu-right"></i></a>
                    <?php
                }
            ?>
        </div>
    </div>
</div>

<!-- Footer -->
<?php
    include "include/footer.php";
?>

<!-- Leeftijdscheck popup! -->
<div id="my-welcome-message">
    <h2>Welkom bij Slijterij Stuk in m'n Kraag</h2>
    <p>Als u door gaat naar de website geeft u aan dat u 18 jaar of ouder bent en gaat u akkoord met de algemene voorwaarden.</p>
</div>

<script src="js/jquery.firstVisitPopup.js"></script>

<script>
    $(function () {
        $('#my-welcome-message').firstVisitPopup({
            cookieName : 'AgeCheckCookie',
            showAgainSelector: '#show-message'
        });
    });
</script>
</body>
</html>
