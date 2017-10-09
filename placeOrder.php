<?php
//include database connection
require_once 'include/connect.php';
//include session.php for login session!
require_once 'include/session.php';
?>
<html>
<head>
    <title>Slijterij - Bestelling geplaatst</title>

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
        <?php

                if(!empty($_SESSION["shopping_cart"] && $_SESSION["shopping_cart"] > 0 ))
                {
                    $total = 0;
                    foreach($_SESSION["shopping_cart"] as $keys => $values)
                    {


                        $shippingprice = 5.50;

                        $total = $total + $shippingprice + ($values["item_quantity"] * $values["item_price"]);
                    }
                }

            $query = 'insert into orders (user_id, total_price) VALUES';
                // insert order details into database
                $insertOrder = "INSERT INTO orders (user_id, total_price) VALUES  ('".$userData['id']."', '".$total."')";

            if (mysqli_query($conn, $insertOrder)) {
                echo '<h2>Bedankt voor uw bestelling!</h2><h3>Uw order is succesvol geplaatst!<br />Uw ordernummer is: #';


            } else {
                echo "Error: " . $insertOrder . "<br>" . mysqli_error($conn);
            }
            if ($insertOrder) {
                $data = ($_SESSION["shopping_cart"]);
                //var_dump($data);

                $orderID = $conn->insert_id;
                echo $orderID.'</h3>';

                foreach ($data as $single_data) {
                    $query = mysqli_query($conn, "SELECT id FROM orders");
                    $ft = mysqli_fetch_array($query);
                    $insertstatement = mysqli_query($conn, "INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`) VALUES ('" . $orderID . "', '" . $single_data['item_id'] . "', '" . $single_data['item_quantity'] . "');");
                }
                //leeg winkelmandje
                unset($_SESSION["shopping_cart"]);
                mysqli_close($conn);
            }
        ?>
    </div>
</body>
</html>
