<div id="bootstrap-touch-slider" class="carousel bs-slider slide  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#webAlGusto-touch-slider" data-slide-to="0" class="active"></li>
        <li data-target="#webAlGusto-touch-slider" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper For Slides -->
    <div class="carousel-inner" role="listbox">

        <!-- Third Slide -->
        <div class="item active">

            <!-- Slide Background -->
            <img src="images/wallpaper3.png" alt="WebAlgusto.com"  class="slide-image"/>
            <div class="bs-slider-overlay"></div>

            <div class="container">
                <div class="row">
                    <!-- Slide Text Layer -->
                    <div class="slide-text slide_style_left">
                        <h1 data-animation="animated zoomInRight">Welkom bij slijterij Stuk in m'n Kraag</h1>
                        <p data-animation="animated fadeInLeft">De beste slijterij van het land!</p>
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
                            <a href="account.php" class="btn btn-default" data-animation="animated fadeInLeft">Mijn account</a>
                        <?php }else{ ?>
                            <a href="account.php" class="btn btn-primary" data-animation="animated fadeInRight">Registeren</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Slide -->

        <!-- Second Slide -->
        <div class="item">

            <!-- Slide Background -->
            <img src="images/wallpaper.png" alt="Webshop Slijterij"  class="slide-image"/>
            <div class="bs-slider-overlay"></div>
            <!-- Slide Text Layer -->


            <div class="slide-text slide_style_right">

                    <h1 style="margin: 5% -3% 0 0; font-size: 51px;" data-animation="animated flipInX">Laatst toegevoegde product!</h1>
                <?php
                $query=mysqli_query($conn,"SELECT * FROM products ORDER BY product_id DESC LIMIT 1");
                while($ft=mysqli_fetch_array($query)) {
                //dit is voor de link naar de productpagina!
                $id = $ft['product_id'];
                ?>
                    <div style="opacity: 0.9;" class="col-md-2 column productbox">
                        <img src="<?php if ($ft['image_name'] == NULL){ echo "http://placehold.it/295x190/333333/FFFFFF";} else { ?>images/product_images/<?php echo $ft['image_name'];}?>" class="img-responsive">
                        <div style="text-align: left;" class="producttitle"><?php echo $ft['product_name'];?></div>
                        <div style="text-align: left;" class="productprice"><div class="pull-right"><a href="product.php?product_id=<?php echo $id ?>" style="background-color: #eb6864;" class="btn btn-danger btn-sm" role="button">Bekijken</a></div><div class="pricetext">€ <?php echo $ft['product_price'];?></div></div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <!-- End of Slide -->

    </div><!-- End of Wrapper For Slides -->

</div> <!-- End  bootstrap-touch-slider Slider -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/Slider_Carousel_webalgustocom.js"></script>