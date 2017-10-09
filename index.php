<?php
    //include database connection
    require_once 'include/connect.php';
    //include session.php for login session!
    include 'include/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Slijterij Stuk in m’n Kraag</title>

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
    //include menu
    include "include/navbar.php";
    //include carousel
    include "include/carousel.php";
?>
<!-- Filterlist producten -->
<main class="cd-main-content">
    <div class="cd-tab-filter-wrapper">
        <div class="cd-tab-filter">
            <ul class="cd-filters">
                <li class="placeholder">
                    <a data-type="all" href="#0">Alles</a> <!-- selected option on mobile -->
                </li>
                <li class="filter"><a class="selected" href="#all" data-type="all">Alles</a></li>
                <?php
                $query = mysqli_query($conn,"SELECT * FROM `products` GROUP BY product_category;");
                    while($pc = mysqli_fetch_array($query)) {
                        ?>
                            <li class="filter" data-filter=".<?php echo $pc['product_category']; ?>"><a href="#<?php echo $pc['product_category']; ?>" data-type="<?php echo $pc['product_category']; ?>"><?php echo $pc['product_category']; ?></a></li>
                        <?php
                    }
                ?>
            </ul> <!-- cd-filters -->
        </div> <!-- cd-tab-filter -->
    </div> <!-- cd-tab-filter-wrapper -->

    <section class="cd-gallery">
        <ul>
            <!-- GRID VAN ALLE PRODUCTEN! -->
            <?php
            $query=mysqli_query($conn,"select * from products");
            while($ft=mysqli_fetch_array($query)) {
                //dit is voor de link naar de productpagina!
                $id = $ft['product_id'];
                ?>
                <li class="mix <?php echo $ft['product_category'];?> <?php echo $ft['product_name']; ?>">
                    <div class="block span3">
                        <div class="product">
                            <a href="product.php?product_id=<?php echo $id ?>">
                                <img src="<?php if ($ft['image_name'] == NULL){ echo "http://placehold.it/295x190/333333/FFFFFF";} else { ?>images/product_images/<?php echo $ft['image_name'];}?>">
                            </a>
                        </div>

                        <div class="info">
                            <h4><?php echo $ft['product_name']; ?></h4>
                            <span class="description">
                                <?php echo $ft['product_desc']; ?>
                            </span>
                            <span class="price">€ <?php echo $ft['product_price']; ?></span>
                            <a class="btn btn-info pull-right" href="product.php?product_id=<?php echo $id ?>"><i class="icon-shopping-cart"></i> Bekijken</a>
                        </div>

                        <div class="details">
                            <span class="time"><i class="icon-time"></i> <?php echo $ft['product_category']; ?></span>
                        </div>
                    </div>
                </li>
                <?php
            }
            ?>
            <li class="gap"></li>
            <li class="gap"></li>
            <li class="gap"></li>
        </ul>
        <div class="cd-fail-message">Geen resultaten gevonden</div>
    </section> <!-- cd-gallery -->

    <div class="cd-filter">
        <form>
            <div class="cd-filter-block">
                <h4>Zoeken</h4>

                <div class="cd-filter-content">
                    <input type="search" placeholder="Zoek op productnaam">
                </div> <!-- cd-filter-content -->
            </div> <!-- cd-filter-block -->

            <div class="cd-filter-block">
                <h4>Check boxes</h4>

                <ul class="cd-filter-content cd-filters list">
                    <?php
                    $query = mysqli_query($conn,"SELECT * FROM `products` GROUP BY product_category;");
                    while($pc = mysqli_fetch_array($query)) {
                        ?>
                        <li>
                            <input class="filter" data-filter=".<?php echo $pc['product_category']; ?>" type="checkbox" id="checkbox3">
                            <label class="checkbox-label" for="checkbox3"><?php echo $pc['product_category']; ?></label>
                        </li>
                        <?php
                    }
                    ?>
                </ul> <!-- cd-filter-content -->
            </div> <!-- cd-filter-block -->

        </form>

        <a href="#0" class="cd-close">Sluiten</a>
    </div> <!-- cd-filter -->

    <a href="#0" class="cd-filter-trigger">Filteren</a>
</main> <!-- cd-main-content -->

<!-- jQuery Scripts -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mixitup.min.js"></script>
<script src="js/main.js"></script>

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