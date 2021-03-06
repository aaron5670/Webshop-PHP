<?php
//include database connection
require_once 'include/connect.php';
//include session.php for login session!
include 'include/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Slijterij Stuk in m’n Kraag - Orders</title>

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
<?php
    if(!empty($sessData['userLoggedIn'])){
        //Haalt userID op van ingelogde gebruiker.
        $userID = $sessData['userID'];

        //haalt alle orders op van de ingelogde gebruiker
        $sql = "SELECT Orders.id, orders.user_id, order_items.product_id, order_items.quantity, orders.total_price, orders.created
    FROM Orders
    INNER JOIN order_items ON orders.id=order_items.order_id WHERE orders.user_id = $userID";
        $result = mysqli_query($conn, $sql);
    }
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
                    <a href="#" class="list-group-item">Mijn bestellingen</a>
                    <a href="userAccount.php?logoutSubmit=1" class="list-group-item">Uitloggen</a>
                </div>
                <?php
            }?>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            <?php
            if(!empty($sessData['userLoggedIn'])){
                include_once 'user.php';
                $user = new User();

                $conditions['where'] = array(
                    'id' => $sessData['userID'],
                );
                $conditions['return_type'] = 'single';
                $userData = $user->getRows($conditions);

                ?>
                <h2 class="my-4">Mijn bestellingen</h2>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Zoek bij Order ID" title="Zoeken bij voornaam">
                <table id="myTable" class="table table-striped">

                    <tr class="header">
                        <th><strong>Order ID</strong></th>
                        <th><strong>Product ID</strong></th>
                        <th><strong>Aantal</strong></th>
                        <th><strong>Totaalprijs</strong></th>
                        <th><strong>Order Datum</strong></th>
                    </tr>

                    <?php
                    while($row = mysqli_fetch_array($result))
                    {
                        ?>
                        <tr class="<?php echo $row['id'] ?>">
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['product_id']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['total_price']; ?></td>
                            <td><?php echo $row['created']; ?></td>
                        </tr>
                        <?php
                    }
                    mysqli_close($conn);
                    ?>

                </table>

                <script>
                    function myFunction() {
                        var input, filter, table, tr, td, i;
                        input = document.getElementById("myInput");
                        filter = input.value.toUpperCase();
                        table = document.getElementById("myTable");
                        tr = table.getElementsByTagName("tr");
                        for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[0];
                            if (td) {
                                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = "";
                                } else {
                                    tr[i].style.display = "none";
                                }
                            }
                        }
                    }
                </script>
            <?php }
            else{ ?>
                <h3 class="my-5">Je hebt geen toegant tot deze pagina!</h3>
            <?php }?>

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