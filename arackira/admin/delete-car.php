<?php include '../config.php'?>
<?php include './comp/authControler.php'?>
<?php
if(!empty($_GET["id"])){
    include '../database.php';
    $database = new Database();
    $db = $database->getConnection();
    $delete_query = $db->prepare("DELETE FROM cars WHERE car_id = :car_id");
    $delete_query->bindParam(':car_id', $_GET["id"]);
    $delete_query->execute();
    header('Location: cars.php?success=Successfully Deleted');
}else{
    header('Location: cars.php?error=Please Select a Car');
}
?>