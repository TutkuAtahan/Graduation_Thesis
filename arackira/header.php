<?php
include './config.php';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<header>
    <a href="#" class="logo"><img src="img/jeep.png" alt="" /></a>

    <div class="bx bx-menu" id="menu-icon"></div>
    <ul class="navbar-style">
      <li><a href="<?php echo $indexURL?>">Home</a></li>
      <li><a href="#ride">Ride</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#reviews">Reviews</a></li>
    </ul>

    <div class="header-btn">
    <a href="./admin/login.php" class="sign-in">Admin Login</a>
    </div>
  </header>