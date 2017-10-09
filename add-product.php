<?php
//include database connection
require_once 'include/connect.php';
//include session.php for login session!
include 'include/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Slijterij Stuk in m’n Kraag - Product toevoegen</title>

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
<script src="vendor/script.js"></script>
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
                    <a href="#" class="list-group-item">Menu 1</a>
                    <a href="#" class="list-group-item">Menu 2</a>
                    <a href="userAccount.php?logoutSubmit=1" class="list-group-item">Uitloggen</a>
                </div>
                <?php
            }?>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

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
                <form action="addProductAction.php" method="post">

                    <div class="row my-4">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="first_name">Product naam</label>
                                <input type="name" class="form-control" name="product_name" required="true" placeholder="Product naam">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="adress">Product beschrijving</label>
                                <textarea type="text" class="form-control" name="product_desc" required="true" rows="4" placeholder="Omschrijving van het product..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="city">Prijs</label>
                                <input type="text" class="form-control" name="product_price" required="true" placeholder="10">
                            </div>
                        </div>

<!--                        <div class="col-2">
                            <div class="form-group">
                                <label for="exampleSelect1">Product Categorie</label>
                                <select class="form-control" name="product_category">
                                    <option>bier</option>
                                    <option>wijn</option>
                                    <option>vodka</option>
                                </select>
                            </div>
                        </div>-->

                        <div class="col-2">
                            <div class="form-group">
                                <script type="text/javascript">
                                    function onSelectChange(){
                                        var sel = document.getElementById('select');
                                        var strUser = sel.options[sel.selectedIndex].text;  //getting the selected option's text

                                        if(strUser == 'Anders namelijk:'){
                                            document.getElementById('yourTextBox').disabled = false;  //enabling textbox
                                        }else {
                                            document.getElementById('yourTextBox').disabled = true;  //disable textbox
                                        }
                                    }
                                    $(document).ready(function(){
                                        $("#yourTextBox").keydown(function(event) {
                                            if (event.keyCode == 32) {
                                                event.preventDefault();
                                            }
                                        });
                                    });
                                </script>

                                <label for="exampleSelect1">Product Categorie</label>
                                <select name="product_category" class="form-control" id= "select" onchange="onSelectChange()">
                                    <?php
                                        $query = mysqli_query($conn,"SELECT * FROM `products` GROUP BY product_category;");
                                        while($pc = mysqli_fetch_array($query)) {
                                            ?>
                                                <option value=""><?php echo $pc['product_category']; ?></option>
                                            <?php
                                        }
                                    ?>
                                    <option value="">Anders namelijk:</option>
                                </select>
                                <input type="text" onpaste="return false;" name="product_category" class="form-control" id="yourTextBox" disabled="disabled"/>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="phone">Afbeelding</label>
                                <input type="file" class="form-control" maxlength="12" name="image_name" id="post" required="true" placeholder="image.png">
                                <small id="emailHelp" class="form-text text-muted">Afbeelding mag niet groter zijn dan 1MB! (Aanbevolen formaat 400x300)</small>

                            </div>
                        </div>
                        <!--
                        <div class="row">
                            <div class="column-small-12 padd0 align-center">
                                <div id="drop-box">
                                    <p>Selecteer afbeelding!</p>
                                </div>
                            </div>
                            <div class="column-small-12 padd0">
                                <input type="file" name="image_name" id="upl" />
                            </div>
                        </div>
                        -->
                    </div>

                    <button type="submit" class="btn btn-primary" action="test()" name="go">Product toevoegen</button>
                </form>
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