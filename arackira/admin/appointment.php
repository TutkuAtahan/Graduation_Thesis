<?php include '../config.php' ?>
<?php include './comp/authControler.php' ?>
<?php
include '../database.php';

$database = new Database();
$db = $database->getConnection();

if (!empty($_GET["id"]) && !empty($_GET["status"])) {
    if ($_GET["status"] == 1) {

        $success_query = $db->prepare("Update appointment SET status = 1 WHERE id = :id");
        $success_query->bindParam(':id', $_GET["id"]);
        $success_query->execute();
        header('Location: waiting-appointment.php?success=Successfully Confirmed');
        exit;
    } else if ($_GET["status"] == 2) {
        $delete_query = $db->prepare("DELETE FROM appointment WHERE id = :id");
        $delete_query->bindParam(':id', $_GET["id"]);
        $delete_query->execute();
        header('Location: waiting-appointment.php?success=
        Successfully Deleted');
        exit;
    }
}

$appointments = $db->prepare("SELECT * FROM appointment INNER JOIN  cars ON appointment.carID = cars.car_id WHERE appointment.status = 1");
$appointments->execute();
$appointments = $appointments->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>

<body>
    <?php include './comp/header.php' ?>

    <div class="container mt-5">
        <?php 
        if(!empty($_GET["success"])){
            echo "<div class='alert alert-success'>".$_GET["success"]."</div>";
        
        }
        ?>
        <div class="row">
            <div class="col-12">
                <h3>Appointments</h3>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Date</th>
                            <th scope="col">Message</th>
                            <th scope="col">Selected Car</th>
                            <th scope="col">Rental Type</th>
                            <th scope="col">Payment Type</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $appointment) : ?>
                            <tr>
                                <th scope="row"><?php echo $appointment['id'] ?></th>
                                <td><?php echo $appointment['name'] ?></td>
                                <td><?php echo $appointment['phone'] ?></td>
                                <td><?php echo date("d-m-Y", strtotime($appointment['start_time'])) . " - " . date("d-m-Y", strtotime($appointment['end_time'])) ?></td>
                                <td><?php echo $appointment['message'] ?></td>
                                <td><?php echo $appointment["car_name"] ?></td>
                                <td><?php echo $appointment["rent_type"] == 1 ? "Daily" : "Monthly" ?></td>
                                <td><?php echo $appointment["payment_type"] == 0 ? "Credit Card" : "Cash" ?> (<?php echo $appointment["payment_status"] == 1 ? "Payment received" : "Pending"?>)</td>

                                <td>
                                    <a href="comp/appointment.php?id=<?php echo $appointment['id'] ?>&status=2" class="btn btn-danger">Cancel</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>



</body>

</html>