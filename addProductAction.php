<?php
require_once 'include/connect.php';

// Controleert database connectie
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Haalt de gegevens op en zet rare tekens om.
$product_name = mysqli_real_escape_string($conn, $_REQUEST['product_name']);
$product_desc = mysqli_real_escape_string($conn, $_REQUEST['product_desc']);
$product_price = mysqli_real_escape_string($conn, $_REQUEST['product_price']);
$product_category = mysqli_real_escape_string($conn, $_REQUEST['product_category']);
$image_name = mysqli_real_escape_string($conn, $_REQUEST['image_name']);

// Voegt de gegevens toe aan de database
$sql = "INSERT INTO products (product_name, product_desc, product_price, product_category, image_name)
VALUES ('$product_name', '$product_desc', '$product_price', '$product_category',  '$image_name')";
if(mysqli_query($conn, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
// sluit de mysql connectie
mysqli_close($conn);

//word doorgestuurd naar index.php
header('Location: index.php'); //word weer doorgestruurd na index.php
?>
