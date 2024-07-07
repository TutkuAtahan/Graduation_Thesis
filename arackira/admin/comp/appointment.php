<?php include '../../config.php' ?>
<?php include '.././comp/authControler.php' ?>
<?php
include '../../database.php';

$database = new Database();
$db = $database->getConnection();

if (!empty($_GET["id"]) && !empty($_GET["status"])) {
    if ($_GET["status"] == 1) {

        $success_query = $db->prepare("Update appointment SET status = 1 WHERE id = :id");
        $success_query->bindParam(':id', $_GET["id"]);
        $success_query->execute();
        header('Location: ../waiting-appointment.php?success=Confirmed Succesfully');
        exit;
    } else if ($_GET["status"] == 2) {
        $delete_query = $db->prepare("DELETE FROM appointment WHERE id = :id");
        $delete_query->bindParam(':id', $_GET["id"]);
        $delete_query->execute();
        header('Location: ../waiting-appointment.php?success=Deleted Succesfully');
        exit;
    }
}

?>