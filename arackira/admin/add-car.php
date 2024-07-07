<?php include '../config.php' ?>
<?php include './comp/authControler.php' ?>

<?php
$cars = [];
include '../database.php';
$database = new Database();
$db = $database->getConnection();

$city = $db->prepare("SELECT * FROM city");
$city->execute();
$city = $city->fetchAll(PDO::FETCH_ASSOC);


if ($_POST) {
    $car_name = $_POST['car_name'];
    $car_year = $_POST['car_year'];
    $car_price = $_POST['car_price'];
    $car_price_daily = $_POST['car_price_daily'];
    
    $car_gear = $_POST['car_gear'];
    $car_fuel = $_POST['car_fuel'];
    $car_image = $_FILES['car_image'];
    $car_location = $_POST['car_location'];


    $image_name = $car_image['name'];
    $image_tmp_name = $car_image['tmp_name'];
    $image_size = $car_image['size'];
    $image_error = $car_image['error'];

    $image_exploded = explode('.', $image_name);
    $image_ext = strtolower(end($image_exploded));

    $allowed = ['jpg', 'jpeg', 'png'];

    if (in_array($image_ext, $allowed)) {
        if ($image_error === 0) {
            if ($image_size < 1000000) {
                $new_image_name = uniqid('', true) . '.' . $image_ext;
                $image_destination = '../img/' . $new_image_name;
                move_uploaded_file($image_tmp_name, $image_destination);

                $insert_query = $db->prepare("INSERT INTO cars (car_name,car_location, car_year, car_price, car_price_daily, car_gear, car_fuel, car_img) VALUES (:car_name,:car_location, :car_year, :car_price, :car_price_daily, :car_gear, :car_fuel, :car_image)");
                $insert_query->bindParam(':car_name', $car_name);
                $insert_query->bindParam(':car_location', $car_location);
                $insert_query->bindParam(':car_year', $car_year);
                $insert_query->bindParam(':car_price', $car_price);
                $insert_query->bindParam(':car_price_daily', $car_price_daily);
                $insert_query->bindParam(':car_gear', $car_gear);
                $insert_query->bindParam(':car_fuel', $car_fuel);
                $insert_query->bindParam(':car_image', $new_image_name);
                $insert_query->execute();

                header('Location: cars.php');
            }
        }
    }
}


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

    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="car_name">Model</label>
                <input type="text" class="form-control" id="car_name" name="car_name" require>
            </div>
            <div class="form-group">
                <label for="car_location">Location</label>
                <select class="form-control" id="car_location" name="car_location" require>

                    <?php foreach ($city as $city) : ?>
                        <option value="<?php echo $city['name'] ?>"><?php echo $city['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="form-group
        ">
                    <label for="car_year">Year</label>
                    <input type="text" class="form-control" id="car_year" name="car_year" require>
                </div>
                <div class="form-group">
                    <label for="car_price">Price (Monthly)</label>
                    <input type="text" class="form-control" id="car_price" name="car_price" require>
                </div>
                <div class="form-group">
                    <label for="car_price_daily">Price (Daily)</label>
                    <input type="text" class="form-control" id="car_price_daily" name="car_price_daily" require>
                
                </div>
                <div class="form-group">
                    <label for="car_gear">Gear</label>
                    <select class="form-control" id="car_gear" name="car_gear" require>
                        <option value="Manual">Manual</option>
                        <option value="Automatic">Automatic</option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="car_fuel">Fuel</label>
                    <select class="form-control" id="car_fuel" name="car_fuel" require>
                        <option value="Gasoline">Gasoline</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Electric">Electric</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="car_image">Car Image</label>
                    <input type="file" class="form-control" id="car_image" name="car_image" require>
                </div>
                <button type="submit" class="btn btn-primary mt-5">Save</button>
        </form>
    </div>





</body>

</html>