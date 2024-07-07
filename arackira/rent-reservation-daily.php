<?php
require_once './database.php';
require_once './comp/daily-dif.php';


$car = [];

$db = new Database;
$con = $db->getConnection();


if (!empty($_GET["carId"])) {

    $data = $con->prepare("SELECT * FROM `cars` WHERE car_id = ?");
    $data->execute([$_GET["carId"]]);
    $car = $data->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: ./");
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

    <div class="services-container" style="padding-left: 50px; padding-right: 50px; padding-top:100px;">
        <div class="box">
            <div class="box-img">
                <img src="img/<?php echo $car["car_img"]; ?>" alt=""  />
            </div>
            <div class="box-content">
                <h3><?php echo $car["car_name"]; ?></h3>
                <p><?php echo $car["car_year"]; ?></p>
                <div class="">
                    <div>
                        Fuel: <?php echo $car["car_fuel"]; ?>
                    </div>
                    <div>
                        Gear: <?php echo $car["car_gear"]; ?>
                    </div>
                </div>

                <form id="reservationForm" action="./post/reservation-daily.php" method="post"  >
                    <input type="hidden" name="carId" value="<?php echo $car["car_id"]; ?>">
                    <input type="hidden" name="carname" value="<?php echo $car["car_name"]; ?>">
                    <div>
                        <span>Name</span>
                        <input type="text" name="name" id="" placeholder="Name" class="form-control" required />
                    </div>
                    <div>
                        <span>Surname</span>
                        <input type="text" name="surname" id="" placeholder="Surname" class="form-control" required />
                    </div>
                    <div>
                        <span>Phone</span>
                        <input type="text" name="phone" id="" placeholder="Phone Number" class="form-control" required />
                    </div>
                    <div>
                        <span>E-mail</span>
                        <input type="email" name="email" id="" placeholder="e-mail" class="form-control" required />
                    </div>
                    <div>
                        <span>Message</span>
                        <textarea name="message" id="" cols="30" rows="3" class="form-control" required></textarea>
                    </div>

                    <div>
                        <span>Pick Up Date</span>
                        <input type="date" name="pickupdate" id="pickupdate" class="form-control" required min="<?php echo date("Y-m-d"); ?>" value="<?php echo $_GET["pickupdate"] ?>" />
                    </div>
                    <div>
                        <span>Return Date</span>
                        <input type="date" name="returndate" id="returndate" class="form-control" required min="<?php echo date("Y-m-d"); ?>" value="<?php echo $_GET["returndate"] ?>" />
                    </div>
                    <div class="row">
                        <div class="col">
                            <span>Price</span>
                            <input type="text" name="price" id="price" 
                            class="form-control" value="<?php echo (int)differenceDays($_GET["pickupdate"],
                             $_GET["returndate"]) * $car["car_price_daily"]; ?>" readonly />
                        
                        </div>
                        <div class="col">
                            <span> Payment Type</span>
                            <select name="payment_type" id="payment_type" class="form-control" required>
                                <option value="0">Credit  Card</option>
                                <option value="1">Cash</option>
                            </select>
                        </div>
                    </div>


                    <div class="box-btn mt-3">
                        <button id="submitBtn" class="btn" type="submit">Rent Now!</button>
                    </div>
                </form>

            </div>
        </div>
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
    <script>
        // JavaScript for validating dates
        document.getElementById('reservationForm').addEventListener('submit', function(event) {
            var pickupDate = new Date(document.getElementById('pickupdate').value);
            var returnDate = new Date(document.getElementById('returndate').value);

            if (returnDate <= pickupDate) {
                alert("Start Date Must Be Before End Date");
                event.preventDefault();
            }
        });
    </script>
    <!-- link to JS -->
    <script src="main.js"></script>
</body>

</html>