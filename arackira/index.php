<?php
require_once './database.php';

$cars = [];
$location = [];

$db = new Database;
$con = $db->getConnection();

$data = $con->prepare("SELECT * FROM `cars` WHERE status = 1 ");
$data->execute();
$cars = $data->fetchAll(PDO::FETCH_ASSOC);

$locationData = $con->prepare("SELECT DISTINCT car_location FROM cars;");
$locationData->execute();
$location = $locationData->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AEGIS-Rent a Car</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="./public/css/owl.carousel.min.css">

  <link rel="stylesheet" href="./public/css/animate.css">

  <!-- <link rel="stylesheet" href="./public/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="./public/css/style.css">

</head>

<body>

  <?php require_once './header.php'; ?>

  <!-- home -->
  <section class="home" id="home">
    <div class="text">
      <h1>
        <span> AEGIS</span> <br />
        Rent a Car
      </h1>
      <p>
        With Aegis, your car is everywhere
      </p>
    </div>

    <div class="form-container shadow-lg d-none d-lg-block" style="width: 600px;  bottom: -4rem; z-index:10;">


      <div class="d-flex carousel-nav">
        <a href="#" class="col active">Daily Rental</a>
        <a href="#" class="col">Monthly Rental</a>
      </div>


      <div class="owl-carousel owl-1 ">

        <div class="media-29101 d-md-flex ">

          <div class="">
            <form action="rent-car.php" id="reservationForm">
              <input type="hidden" name="type" value="0">
              <div class="row">
                <div class="col">
                  <label for="location">Location</label>
                  <select name="location" id="location" class="form-control">
                    <?php
                    foreach ($location as $loc) {
                    ?>
                      <option value="<?php echo $loc["car_location"] ?>"><?php echo $loc["car_location"] ?></option>
                    <?php
                    }
                    ?>
                  </select>


                </div>
                <div class="col">
                  <label for="pickupdate">Pick-Up Date</label>
                  <input type="date" name="pickupdate" id="pickupdate" class="form-control" required>
                </div>
                <div class="col">
                  <label for="returndate">Return Date</label>
                  <input type="date" name="returndate" id="returndate" class="form-control" required>
                </div>
              </div>

              <button type="submit" class="btn mt-5">Search</button>
            </form>
          </div>
        </div> <!-- .item -->

        <div class="media-29101 d-md-flex ">

          <form action="rent-car.php">
            <input type="hidden" name="type" value="1">
            <div class="row">
              <div class="col">
                <label for="location">Location </label>
                <select name="location" id="location" class="form-control">
                  <?php
                  foreach ($location as $loc) {
                  ?>
                    <option value="<?php echo $loc["car_location"] ?>"><?php echo $loc["car_location"] ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="col">
                <label for="pickupdate">Pick-Up Date</label>
                <input type="date" name="pickupdate" id="pickupdate" required class="form-control">
              </div>
              <div class="col">
                <label for="month">Month</label>
                <select name="month" id="month" class="form-control">
                  <option value="1">1 Month</option>
                  <option value="2">2 Month</option>
                  <option value="3">3 Month</option>
                  <option value="4">4 Month</option>
                  <option value="5">5 Month</option>
                  <option value="6">6 Month</option>
                  <option value="7">7 Month</option>
                  <option value="8">8 Month</option>
                  <option value="9">9 Month</option>
                  <option value="10">10 Month</option>
                  <option value="11">11 Month</option>
                  <option value="12">12 Month</option>
                  <option value="24">24 Month</option>
                  <option value="36">36 Month</option>
                  <option value="48">48 Month</option>
                </select>
              </div>
            </div>
            <button type="submit" class="btn mt-5">Search</button>
          </form>
        </div> 




      </div>


    </div>
  </section>

  <!-- ride -->










  <section class="ride" id="ride">

    <div class="form-container shadow-lg d-block d-lg-none">


      <div class="d-flex carousel-nav">
        <a href="#" class="col active">Daily Rental</a>
        <a href="#" class="col">Monthly Rental</a>
      </div>


      <div class="owl-carousel owl-1   ">

        <div class="media-29101 d-md-flex ">

          <div class="">
            <form action="rent-car.php" id="reservationForm">
              <input type="hidden" name="type" value="0">
              <div class="row">
                <div class="col-12 col-md-4">
                  <label for="location">Location</label>
                  <select name="location" id="location" class="form-control">
                    <?php foreach ($location as $loc) { ?>
                      <option value="<?php echo $loc["car_location"]; ?>"><?php echo $loc["car_location"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-12 col-md-4">
                  <label for="pickupdate">Pick-Up Date</label>
                  <input type="date" name="pickupdate" id="pickupdate" class="form-control" required>
                </div>
                <div class="col-12 col-md-4">
                  <label for="returndate">Return Date</label>
                  <input type="date" name="returndate" id="returndate" class="form-control" required>
                </div>
              </div>


              <button type="submit" class="btn mt-5">Search</button>
            </form>
          </div>
        </div> <!-- .item -->

        <div class="media-29101 d-md-flex ">

          <form action="rent-car.php">
            <input type="hidden" name="type" value="1">
            <div class="row">
              <div class="col-12 col-md-4">
                <label for="location">Location</label>
                <select name="location" id="location" class="form-control">
                  <?php foreach ($location as $loc) { ?>
                    <option value="<?php echo $loc["car_location"]; ?>"><?php echo $loc["car_location"]; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-12 col-md-4">
                <label for="pickupdate">Pick-Up Date</label>
                <input type="date" name="pickupdate" id="pickupdate" required class="form-control">
              </div>
              <div class="col-12 col-md-4">
                <label for="month">Month</label>
                <select name="month" id="month" class="form-control">
                  <option value="1">1 Month</option>
                  <option value="2">2 Month</option>
                  <option value="3">3 Month</option>
                  <option value="4">4 Month</option>
                  <option value="5">5 Month</option>
                  <option value="6">6 Month</option>
                  <option value="7">7 Month</option>
                  <option value="8">8 Month</option>
                  <option value="9">9 Month</option>
                  <option value="10">10 Month</option>
                  <option value="11">11 Month</option>
                  <option value="12">12 Month</option>
                  <option value="24">24 Month</option>
                  <option value="36">36 Month</option>
                  <option value="48">48 Month</option>
                </select>
              </div>
            </div>

            <button type="submit" class="btn mt-5">Search</button>
          </form>
        </div> <!-- .item -->




      </div>


    </div>

    <div class="heading">
      <span>How Its Work</span>
      <h1>Rent With 3 Easy Steps</h1>
    </div>
    <div class="ride-container">
      <div class="box">
        <i class="bx bxs-map"></i>
        <h2>Choose a Location</h2>
        <p>
          Select a Location to Begin Your Adventure
        </p>
      </div>

      <div class="box">
        <i class="bx bxs-calendar-check"></i>
        <h2>Pick-Up Date</h2>
        <p>
          Easily Choose Your Rental Date Range for the Selected Vehicle.
        </p>
      </div>

      <div class="box">
        <i class="bx bxs-calendar-star"></i>
        <h2>Book a Car</h2>
        <p>
          Let the Journey Begin with AEGIS after Completing Your Reservation.
        </p>
      </div>
    </div>
  </section>
  <!-- Services -->
  <section class="services" id="services">
    <div class="heading">
      <span>Our Rental Cars</span>
      <h1>
        Discover Our Best Cars
      </h1>
    </div>
    <div class="services-container">
      <?php
      foreach ($cars as $car) {
      ?>
        <div class="box">
          <div class="box-img">
            <img src="img/<?php echo $car["car_img"] ?>" alt="" />
          </div>
          <p><?php echo $car["car_year"] ?></p>
          <h3><?php echo $car["car_name"] ?></h3>
          <h2>$<?php echo $car["car_price"] ?> <span>/month</span></h2>
          <a href="./rent-reservation.php?carId=<?php echo $car["car_id"] ?>" class="btn">Rent Now</a>
        </div>
      <?php
      }
      ?>
    </div>
  </section>
  <!-- about -->
  <section class="about" id="about">
    <div class="heading">
      <span>About Us</span>
  
    </div>
    <div class="about-container">
      <div class="about-img">
        <img src="img/about.png" alt="" />
      </div>
      <div class="about-text">
        
        <p>
          AEGIS is a term that means security and protection, and as AEGIS Car Rental, we are here to ensure your travel experience. Our mission is to provide our customers with reliable, comfortable, and affordable car rental services, making their travels effortless and enjoyable.
        </p>
        <p>
          With a wide range of vehicles, affordable prices, customer-focused service, and easy reservation options, AEGIS Rent a Car ensures that your car is always by your side.
        </p>
        <a href="#" class="btn">Learn More</a>
      </div>
    </div>
  </section>
  <!-- Reviews -->
  <section class="reviews" id="reviews">
    <div class="heading">
      <span>Reviews</span>
      <h1>Whats Our Customers Say</h1>
    </div>
    <div class="reviews-container">
      <div class="box">
        <div class="rev-img">
          <img src="img/rev1.jpg" alt="" />
        </div>
        <h2>Ulaş Bahan</h2>
        <div class="stars">
          <i class="bx bxs-star"></i>
          <i class="bx bxs-star"></i>
          <i class="bx bxs-star"></i>
          <i class="bx bxs-star"></i>
          <i class="bx bxs-star-half"></i>
        </div>
        <p>
        I got a rental car from aegis last <br> weekend that was a great experience <br> for me and my family.
        </p>
      </div> 

      <div class="box">
        <div class="rev-img">
          <img src="img/rev2.jpg" alt="" />
        </div>
        <h2>Hazar Açar</h2>
        <div class="stars">
          <i class="bx bxs-star"></i>
          <i class="bx bxs-star"></i>
          <i class="bx bxs-star"></i>
          <i class="bx bxs-star"></i>
          <i class="bx bxs-star-half"></i>
        </div>
        <p>
        We felt safe and free!
        </p>
      </div>

      <div class="box">
        <div class="rev-img">
          <img src="img/rev3.jpg" alt="" />
        </div>
        <h2>Hazal Taş</h2>
        <div class="stars">
          <i class="bx bxs-star"></i>
          <i class="bx bxs-star"></i>
          <i class="bx bxs-star"></i>
          <i class="bx bxs-star"></i>
          <i class="bx bxs-star-half"></i>
        </div>
        <p>
        That was a most economic way to go!
        </p>
      </div>
    </div>
  </section>

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
  <script src="./public/js/bootstrap.min.js"></script>
  <script src="./public/js/jquery-3.3.1.min.js"></script>
  <script src="./public/js/owl.carousel.min.js"></script>
  <script src="./public/js/popper.min.js"></script>
  <script src="./public/js/main.js"></script>
  <!-- link to JS -->
  <script src="main.js"></script>
</body>

</html>

<script>
  // JavaScript for validating dates
  document.getElementById('reservationForm').addEventListener('submit', function(event) {
    var pickupDate = new Date(document.getElementById('pickupdate').value);
    var returnDate = new Date(document.getElementById('returndate').value);

    if (returnDate <= pickupDate) {
      alert("Start date must be before end date");
      event.preventDefault();
    }
  });

  // JavaScript for showing/hiding date or duration fields
  document.getElementById('longTermRental').addEventListener('change', function(event) {
    var returnDateBox = document.getElementById('returnDateBox');
    var monthSelectBox = document.getElementById('monthSelectBox');

    if (this.checked) {
      returnDateBox.style.display = 'none';
      monthSelectBox.style.display = 'block';
    } else {
      returnDateBox.style.display = 'block';
      monthSelectBox.style.display = 'none';
    }
  });
</script>