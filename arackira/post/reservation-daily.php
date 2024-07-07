<?php

// Array ( [name] => asd [surname] => ada [phone] => asda [email] => asda@gmail.com [message] => asdad [pickupdate] => 2024-05-24 [returndate] => 2024-05-24 ) 

require_once '../config.php';
require_once '../database.php';
require_once '../comp/daily-dif.php';

$db = new Database;
$con = $db->getConnection();


if (!empty($_POST)) {

    $carId = $_POST['carId'];
    $carData = $con->prepare("SELECT * FROM `cars` WHERE car_id = ?");
    $carData->execute([$carId]);
    $carData = $carData->fetch(PDO::FETCH_ASSOC);



    $data = $con->prepare("INSERT INTO `appointment` (`carID`, `name`, `mail`, `phone`, `message`, `status`, `start_time`, `end_time`,`price` , `payment_type`, `payment_status`, `rent_type`) VALUES (:carID, :name, :mail, :phone, :message, '0', :start_time, :end_time,:price, :payment_type, 0, 1)");
    $data->execute([
        'carID' => $_POST['carId'],
        'name' => $_POST['name'],
        'mail' => $_POST['email'],
        'phone' => $_POST['phone'],
        'message' => $_POST['message'],
        'start_time' => $_POST['pickupdate'],
        'end_time' => $_POST['returndate'],
        'price' => differenceDays($_POST['pickupdate'], $_POST['returndate']) * $carData["car_price_daily"],
        'payment_type' => $_POST["payment_type"]
    ]);

    if ($_POST["payment_type"] == 0) {
        header("Location: ../payment.php?appointment=" . $con->lastInsertId());
    } else {
        header("Location: ../sucess.php?message=Registration Successful&carname=" . $_POST['carname'] . "&status=1");
    }
} else {
    header("Location: ../sucess.php?messageRegistration Unsuccessful&status=0");
}
