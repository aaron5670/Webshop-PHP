<?php
//start session
session_start();
//load and initialize user class
include 'user.php';
$user = new User();
if(isset($_POST['signupSubmit'])){
    //check whether user details are empty
    if(!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['street']) && !empty($_POST['place']) && !empty($_POST['zipcode']) && !empty($_POST['province']) && !empty($_POST['country']) && !empty($_POST['phone']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
        //password and confirm password comparison
        if($_POST['password'] !== $_POST['confirm_password']){
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'De twee wachtwoorden komen niet met elkaar overeen!';
        }else{
            //check whether user exists in the database
            $prevCon['where'] = array('email'=>$_POST['email']);
            $prevCon['return_type'] = 'count';
            $prevUser = $user->getRows($prevCon);
            if($prevUser > 0){
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'Er is al een account met dit emailadres!';
            }else{
                //insert user data in the database
                $userData = array(
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'street' => $_POST['street'],
                    'place' => $_POST['place'],
                    'zipcode' => $_POST['zipcode'],
                    'province' => $_POST['province'],
                    'country' => $_POST['country'],
                    'password' => md5($_POST['password']),
                    'phone' => $_POST['phone']
                );
                $insert = $user->insert($userData);
                //set status based on data insert
                if($insert){
                    $sessData['status']['type'] = 'success';
                    $sessData['status']['msg'] = 'Uw account is succesvol geregistreerd, log hier in met uw gegevens.';
                }else{
                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Er is iets fout gegaan, probeer het nog is!';
                }
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'U moet alle velden invullen!.';
    }
    //store signup status into the session
    $_SESSION['sessData'] = $sessData;
    if(isset($_GET['redr'])) {
        $redirectURLcheckout = ($sessData['status']['type'] == 'success')?'checkout.php':'registration.php';
        //redirect to the checkout page
        header("Location:".$redirectURLcheckout);
    }else{
        $redirectURL = ($sessData['status']['type'] == 'success')?'account.php':'registration.php';
        //redirect to the account page
        header("Location:".$redirectURL);
    }
}elseif(isset($_POST['loginSubmit'])){
    //check whether login details are empty
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        //get user data from user class
        $conditions['where'] = array(
            'email' => $_POST['email'],
            'password' => md5($_POST['password']),
            'status' => '1'
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows($conditions);
        //set user data and status based on login credentials
        if($userData){
            $sessData['userLoggedIn'] = TRUE;
            $sessData['userID'] = $userData['id'];
            $sessData['admin'] = $userData['admin'];
            $sessData['status']['type'] = 'success';
            $sessData['status']['msg'] = 'Welkom '.$userData['first_name'].'!';
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Foute email of wachtwoord, probeer het nog eens!';
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Voer email en wachtwoord in!.';
    }if (isset($_GET['checkout'])){
        //store login status into the session
        $_SESSION['sessData'] = $sessData;
        //redirect to the checkout page
        header("Location:checkout.php");
    }else{
        //store login status into the session
        $_SESSION['sessData'] = $sessData;
        //redirect to the account page
        header("Location:account.php");
    }
}elseif(!empty($_REQUEST['logoutSubmit'])){
    //remove session data
    unset($_SESSION['sessData']);
    session_destroy();
    //store logout status into the session
    $sessData['status']['type'] = 'success';
    $sessData['status']['msg'] = 'U bent nu uitgelogd!';
    $_SESSION['sessData'] = $sessData;
    //redirect to the home page
    header("Location:index.php");
}else{
    //redirect to the home page
    header("Location:index.php");
}