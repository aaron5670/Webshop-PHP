<?php
require_once 'include/connect.php';

$sql = "DELETE FROM products WHERE product_id = ?";
if (!$result = $conn->prepare($sql)){
    die('Query failed: (' . $conn->errno . ') ' . $conn->error);
}

if (!$result->bind_param('i', $_GET['id'])){
    die('Binding parameters failed: (' . $result->errno . ') ' . $result->error);
}

if (!$result->execute()){
    die('Execute failed: (' . $result->errno . ') ' . $result->error);
}

if ($result->affected_rows > 0){
    echo "Product verwijderd bij ID.";
    header('Location: productlist.php');
}else{
    echo "Kan het product niet verwijderen.";
}
$result->close();
$conn->close();