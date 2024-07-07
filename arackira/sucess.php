<?php
require_once './database.php';

$cars = [];

$db = new Database;
$con = $db->getConnection();


if (!empty($_GET["location"]) && !empty($_GET["pickupdate"]) && !empty($_GET["returndate"])) {

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

    ");
    $data->execute();
    $cars = $data->fetchAll(PDO::FETCH_ASSOC);
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

    <div class="container py-5 my-5">
        <?php
        if ($_GET["status"] == 1) {
            echo '<div class="alert alert-success" role="alert">
            ' . $_GET["message"] . '!
            <br />
          
          </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
            ' . $_GET["message"] . '
            <br />
          
          
          </div>';
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