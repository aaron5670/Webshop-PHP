<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header"><a class="navbar-brand navbar-link" href="index.php">Slijterij Stuk in m'n Kraag</a>
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav">
                <li role="presentation"><a href="index.php">Home</a></li>
                <li role="presentation"><a href="#">Dranken</a></li>
                <li role="presentation"><a href="#">Aanbiedingen</a></li>
            </ul>
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
                    <a href="account.php"><button class="btn btn-primary navbar-btn navbar-right" type="button"><strong>Mijn account</strong></button></a>
                <?php }else{ ?>
                    <a href="account.php"><button class="btn btn-primary navbar-btn navbar-right" type="button"><strong>Inloggen</strong></button></a>
                <?php } ?>
            <a href="cart.php"><button class="btn btn-primary navbar-btn navbar-right navbar-cart-button" type="button"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button></a>
        </div>
    </div>
</nav>