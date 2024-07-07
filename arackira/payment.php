<?php
require_once './database.php';
require_once './comp/daily-dif.php';
require_once './config.php';
$cars = [];

$db = new Database;
$con = $db->getConnection();



if ($_POST) {
    $data = $con->prepare("UPDATE `appointment` SET `payment_status` = 1 WHERE id = ?");
    $data->execute([$_POST["appointment"]]);
    
    header("Location: ./sucess.php?message=Payment Successful&status=1  ");
    exit;
}

$appointmentId = $_GET["appointment"];

if (empty($appointmentId)) {
    header("Location: " . $indexURL);
}

$data = $con->prepare("SELECT * FROM `appointment` WHERE id = ?");
$data->execute([$appointmentId]);
$data = $data->fetch(PDO::FETCH_ASSOC);

if ($data["payment_status"] == 1) {
    header("Location: ./sucess.php?message=Payment Already Made&status=0");
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
    <div class="container  " style="margin-top: 100px;">
        <h1 class="text-center">Payment Process</h1>
        <form action="payment.php" method="post" id="payment-form">
            <input type="hidden" name="appointment" value="<?php echo $appointmentId ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="surname">Surname</label>
                <input type="text" class="form-control" id="surname" name="surname" required>
            </div>
            <div class="form-group">
                <label for="card_number">Card No</label>
                <input type="text" class="form-control" id="card_number" name="card_number" maxlength="16" required>
                <small id="card_number_help" class="form-text text-muted">Please enter your 16-digit card number</small>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="expire_month">Expiration Date (Month)</label>
                    <input type="text" class="form-control" id="expire_month" name="expire_month" maxlength="2" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="expire_year">Expiration Date (Year)</label>
                    <input type="text" class="form-control" id="expire_year" name="expire_year" maxlength="2" required>
                </div>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv" maxlength="3" required>
            </div>
            <div class="form-group">
                <label for="amount">Price</label>
                <input type="number" class="form-control" id="amount" name="amount" min="0.01" step="0.01" value="<?php echo $data["price"] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary my-3">Pay</button>
        </form>
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