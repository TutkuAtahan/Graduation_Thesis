<?php
require_once './database.php';

$car = [];

$db = new Database;
$con = $db->getConnection();

if (!empty($_GET["carId"])) {
    $data = $con->prepare("SELECT * FROM `cars` WHERE car_id = ?");
    $data->execute([$_GET["carId"]]);
    $car = $data->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: ./");
    exit();
}

$month = [
    1 => "1 Month",
    2 => "2 Month",
    3 => "3 Month",
    4 => "4 Month",
    5 => "5 Month",
    6 => "6 Month",
    7 => "7 Month",
    8 => "8 Month",
    9 => "9 Month",
    10 => "10 Month",
    11 => "11 Month",
    12 => "12 Month",
    24 => "24 Month",
    36 => "36 Month",
    48 => "48 Month",
];
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
                <img src="img/<?php echo $car["car_img"]; ?>" alt="" />
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

                <form id="reservationForm" action="./post/reservation.php" method="post">
                    <input type="hidden" name="carId" value="<?php echo $car["car_id"]; ?>">
                    <input type="hidden" name="carname" value="<?php echo $car["car_name"]; ?>">
                    <div>
                        <span>Name</span>
                        <input type="text" name="name" placeholder="Name" class="form-control" required />
                    </div>
                    <div>
                        <span>Surname</span>
                        <input type="text" name="surname" placeholder="Surname" class="form-control" required />
                    </div>
                    <div>
                        <span>Phone</span>
                        <input type="text" name="phone" placeholder="Phone Number" class="form-control" required />
                    </div>
                    <div>
                        <span>E-mail</span>
                        <input type="email" name="email" placeholder="e-mail" class="form-control" required />
                    </div>
                    <div>
                        <span>Message</span>
                        <textarea name="message" cols="30" rows="10" class="form-control" required></textarea>
                    </div>

                    <div>
                        <span>Pick Up Date</span>
                        <input type="date" name="pickupdate" id="pickupdate" class="form-control" required min="<?php echo date("Y-m-d"); ?>" value="<?php echo $_GET["pickupdate"] ?? ''; ?>" />
                    </div>
                    <div>
                        <span>Return Date</span>
                        <select name="month" id="month" class="form-control" required onchange="calculatePrice()">
                            <option value="">Month</option>
                            <?php
                            foreach ($month as $key => $value) {
                                $selected = isset($_GET["month"]) && $_GET["month"] == $key ? "selected" : "";
                            ?>
                                <option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $value ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col">
                            <span>Price</span>
                            <input type="text" name="price" id="price" class="form-control" value="" readonly />
                        </div>
                        <div class="col">
                            <span>Payment Type</span>
                            <select name="payment_type" class="form-control" required>
                                <option value="0">Credit Card</option>
                                <option value="1">Cash</option>
                            </select>
                        </div>
                    </div>

                    <div class="box-btn">
                        <button id="submitBtn" class="btn" type="submit">Rent</button>
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
        function calculatePrice() {
            var month = document.getElementById('month').value;
            var pricePerMonth = <?php echo $car["car_price"]; ?>;
            var totalPrice = month * pricePerMonth;
            document.getElementById('price').value = totalPrice;
        }

        // JavaScript for validating dates
        document.getElementById('reservationForm').addEventListener('submit', function(event) {
            var pickupDate = new Date(document.getElementById('pickupdate').value);
            var currentDate = new Date();

            if (pickupDate < currentDate) {
                alert("The start date cannot be earlier than today.");
                event.preventDefault();
            }
        });

        // Initial price calculation if month is already set
        window.onload = function() {
            calculatePrice();
        }
    </script>
    <!-- link to JS -->
    <script src="main.js"></script>
</body>

</html>
