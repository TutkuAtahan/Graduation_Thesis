<?php
require_once './database.php';
require_once './comp/daily-dif.php';
$cars = [];

$db = new Database;
$con = $db->getConnection();


if (!empty($_GET["location"]) && !empty($_GET["pickupdate"])) {

    if (!empty($_GET["returndate"])) {
        $data = $con->prepare("SELECT 
    a.* 
FROM 
    cars a
LEFT JOIN 
appointment r 
ON 
    a.car_id = r.carID 
    AND r.status = 1
    AND (
        (r.start_time <= '" . $_GET["pickupdate"] . "' AND r.end_time >= '" . $_GET["returndate"] . "')
    )
    WHERE
    a.car_location = '" . $_GET["location"] . "'

    ");
        $data->execute();
        $cars = $data->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $month = $_GET["month"];
        $returndate = date('Y-m-d', strtotime($_GET["pickupdate"] . ' + ' . $month . ' month'));
        $data = $con->prepare("SELECT 
                a.* 
            FROM 
                cars a
            LEFT JOIN 
            appointment r 
            ON 
                a.car_id = r.carID
                AND r.status = 1
                AND (
                    (r.start_time <= '" . $_GET["pickupdate"] . "' AND r.end_time >= '" . $returndate . "')
                )
                WHERE
                a.car_location = '" . $_GET["location"] . "'
    ");
        $data->execute();
        $cars = $data->fetchAll(PDO::FETCH_ASSOC);
    }
} else {
    $data = $con->prepare("SELECT * FROM `cars` WHERE status = 1 ");
    $data->execute();
    $cars = $data->fetchAll(PDO::FETCH_ASSOC);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AEGIS-Rent a Car</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
</head>

<body>

    <?php require_once './header.php'; ?>


    <!-- rent-car -->

    <div class="services-container" style="padding-left: 50px; padding-right: 50px; padding-top:100px; ">
        <?php
        foreach ($cars as $car) {
        ?>
            <div class="box">
                <div class="box-img">
                    <img src="img/<?php echo $car["car_img"] ?>" alt="" />
                </div>
                <p><?php echo $car["car_year"] ?></p>
                <h3><?php echo $car["car_name"] ?></h3>

                <?php
                if (($_GET["type"] !== null)) {
                    if ($_GET["type"] == 1) {
                ?>
                        <h2>$<?php echo $car["car_price"] ?> <span>/month</span> (<?php echo  "Calculated Price" . " $" . $car["car_price"] * $_GET["month"] ?> )</h2>
                        <div>
                            <a href="./rent-reservation.php?carId=<?php echo $car["car_id"] ?>&pickupdate=<?php echo $_GET["pickupdate"] ?>&month=<?php echo $_GET["month"] ?>" class="btn">Rent Monthly</a>
                        </div>
                    <?php
                    } else {
                    ?>
                        <h2>$<?php echo $car["car_price_daily"] ?> <span>/daily </span> (<?php echo "Calculated Price" . " $" . (int)differenceDays($_GET["pickupdate"], $_GET["returndate"]) * $car["car_price_daily"] ?>)</h2>
                        <div class="col">
                            <a href="./rent-reservation-daily.php?carId=<?php echo $car["car_id"] ?>&pickupdate=<?php echo $_GET["pickupdate"] ?>&returndate=<?php echo $_GET["returndate"] ?>" class="btn">Rent</a>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <h2>$<?php echo $car["car_price_daily"] ?> <span>/daily </span> </h2>
                    <div class="col">
                        <a href="./rent-reservation-daily.php" class="btn">Rent Now!</a>
                    </div>
                <?php
                }
                ?>

            </div>
        <?php
        }
        ?>

    </div>


     <!-- Contact Us -->
  <section class="contact">
    <h2>Contact Us</h2>
    <p style="width: 500px; color: white;">As AEGIS Car Rental, we're here to elevate your travel experience to the highest level. Don't hesitate to contact us for any inquiries, booking requests, or assistance. We're eager to serve you!</p>
    <div >
      <a href="mailto:tutkuatahan136@gmail.com" class="btn btn-primary" >Click Here to Send an e-mail</a>
      
    </div>
  </section>
    <div class="copyright">
        <p>&#169 AEGISCAR All Rights Reserved</p>
        <div class="social">
            <a href="">
                <i class='bx bxl-facebook'></i>
                <i class='bx bxl-twitter'></i>
                <i class='bx bxl-instagram'></i>
            </a>
        </div>
    </div>

    <!-- scrollReveal -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!-- link to JS -->
    <script src="main.js"></script>
</body>

</html>