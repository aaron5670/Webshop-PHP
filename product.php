<!DOCTYPE html>
<html>
<?php
//include session.php for login session!
require_once ("include/connect.php");
//include session.php for login session!
include 'include/session.php';

//ophalen productgegevens!
if(isset($_GET['product_id'])) {
    $id = $_GET['product_id'];
}else{
    header('Location: index.php'); //word weer doorgestruurd na index.php als er geen product is geselecteerd
}

//Haalt de gegevens van het product op uit de Database!
$query=mysqli_query($conn,"select * from products WHERE product_id = $id");
while($ft=mysqli_fetch_array($query)) {
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slijterij - <?php echo $ft['product_name'];?></title>
    <link rel="stylesheet" href="css/style.css"> <!-- Custom style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/journal/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=News+Cycle:400,700">
    <link rel="stylesheet" href="css/product_page.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>

<body>
<?php
//Include navbar menu!
include 'include/navbar.php';
?>
    <ol class="breadcrumb">
        <li><a href="index.php"><span>Home</span></a></li>
        <li><a href="#"><span><?php echo $ft['product_category'];?></span></a></li>
        <li class="active"><span><?php echo $ft['product_name'];?> </span></li>
    </ol>
    <div class="container">
        <div class="row product">
            <div class="col-md-5 col-md-offset-0"><img class="img-responsive" src="images/product_images/<?php echo $ft['image_name'];?>"></div>
            <div class="col-md-7">
                <h2><?php echo $ft['product_name'];?></h2>
                <p><?php echo $ft['product_desc'];?></p>
                    <form method="post" action="actions/add_to_cart.php?action=add&id=<?php echo $ft["product_id"]; ?>">
                        <h3>€<?php echo $ft['product_price'];?></h3>
                        <div class="col-xs-2">
                            <input type="number" min="1" name="quantity" class="form-control" value="1" />
                        </div>
                        <div style="display:inline;">
                            <input type="hidden" name="hidden_name" value="<?php echo $ft["product_name"]; ?>" />
                            <input type="hidden" name="hidden_price" value="<?php echo $ft["product_price"]; ?>" />
                            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-primary" value="In winkelmandje" />
                        </div>
                    </form>
            </div>
        </div>
        <div class="page-header">
            <h3>Product beschrijving</h3></div>
        <p><?php echo $ft['product_desc'];?></p>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr></tr>
                </thead>
                <tbody>
                    <tr></tr>
                </tbody>
            </table>
        </div>
    </div>
<?php
    include "include/footer.php";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
<?php
}
?>