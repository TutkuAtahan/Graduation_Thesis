<?php

$id = $_GET["id"];

if(!empty($id)){
    require_once '../../config.php';
require_once '../../database.php';

$db = new Database;
$con = $db->getConnection();

$delete = $con->prepare("UPDATE appointment SET payment_status = 1 WHERE id = ?");
$delete->execute([$id]);

if ($_GET["status"] == 1) {
    header("Location: ../waiting-appointment.php?success=Payment Confirmed");
} else {
    header("Location: ../appointment.php?success=Payment Confirmed");
}

}else {
    if($_GET["status"] == !null){

        if($_GET["status"] == 1){
            header("Location: ../waiting-appointment.php?success=Payment Rejected");
        }else{
            header("Location: ../appointment.php?success=Payment Rejected");
        }
    }else{
        header("Location: ../waiting-appointment.php?success=Payment Rejected");
    }
}