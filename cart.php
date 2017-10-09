<?php
//include database connection
require_once 'include/connect.php';
//include session.php for login session!
require_once 'include/session.php';
?>
<html>
<head>
    <title>Slijterij - Winkelmandje</title>

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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>
<body>
<?php
//Include navbar menu!
include 'include/navbar.php';
?>
<div class="container">
    <h3>Winkelmandje</h3>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th width="40%"><strong>Producten</strong></th>
                <th width="10%"><strong>Aantal</strong></th>
                <th width="20%"><strong>Prijs</strong></th>
                <th width="15%"><strong>Totaal</strong></th>
                <th width="5%"></th>
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
                        <td><a href="actions/add_to_cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                    </tr>

                    <?php

                    $shippingprice = 5.50;

                    $total = $total + $shippingprice + ($values["item_quantity"] * $values["item_price"]);
                }
                ?>
                <tr>
                    <td colspan="3" align="right"><strong>Verzendkosten:</strong></td>
                    <td align="right"><strong>€ <?php echo number_format($shippingprice, 2); ?></strong></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3" align="right"><strong>Totaal:</strong></td>
                    <td align="right"><strong>€ <?php echo number_format($total, 2); ?></strong></td>
                    <td></td>
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
    <?php
    if (!empty($_SESSION["shopping_cart"])){
        echo "<a href=\"checkout.php\" class=\"btn btn-success orderBtn\">Afrekenen <i class=\"glyphicon glyphicon-menu-right\"></i></a>";
    }
    ?>
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
