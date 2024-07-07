<?php include '../config.php' ?>
<?php include './comp/authControler.php' ?>

<?php
$cars = [];
include '../database.php';
$database = new Database();
$db = $database->getConnection();


if ($_POST) {
    $car_id = $_POST['id'];
    $car_name = $_POST['car_name'];
    $car_year = $_POST['car_year'];
    $car_price = $_POST['car_price'];
    $car_price_daily = $_POST['car_price_daily'];
    $car_gear = $_POST['car_gear'];
    $car_fuel = $_POST['car_fuel'];
    $car_image = $_FILES['car_image'];
    $car_location = $_POST['car_location'];

    if(!empty($car_image)){
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
    
                    $update_query = $db->prepare("UPDATE cars SET car_name = :car_name, car_location = :car_location, car_year = :car_year, car_price = :car_price, car_gear = :car_gear, car_fuel = :car_fuel, car_img = :car_image , car_price_daily = :car_price_daily WHERE car_id = :car_id");
                    $update_query->bindParam(':car_name', $car_name);
                    $update_query->bindParam(':car_location', $car_location);
                    $update_query->bindParam(':car_year', $car_year);
                    $update_query->bindParam(':car_price', $car_price);
                    $update_query->bindParam(':car_price_daily', $car_price_daily);
                    $update_query->bindParam(':car_gear', $car_gear);
                    $update_query->bindParam(':car_fuel', $car_fuel);
                    $update_query->bindParam(':car_image', $new_image_name);
                    $update_query->bindParam(':car_id', $car_id);
                    $update_query->execute();
    
                    header('Location: cars.php?success=Updated Succesfully');
                }
            }
        }
    }else{
        $update_query = $db->prepare("UPDATE cars SET car_name = :car_name, car_location = :car_location, car_year = :car_year, car_price = :car_price, car_gear = :car_gear, car_fuel = :car_fuel, car_price_daily = :car_price_daily WHERE car_id = :car_id");
        $update_query->bindParam(':car_name', $car_name);
        $update_query->bindParam(':car_location', $car_location);
        $update_query->bindParam(':car_year', $car_year);
        $update_query->bindParam(':car_price', $car_price);
        $update_query->bindParam(':car_price_daily', $car_price_daily);
        $update_query->bindParam(':car_gear', $car_gear);
        $update_query->bindParam(':car_fuel', $car_fuel);
        $update_query->bindParam(':car_id', $car_id);
        $update_query->execute();

        header('Location: cars.php?success=Successfully Confirmed');
    
    }




    
}


$car_id = $_GET['id'];
$cars = $db->prepare("SELECT * FROM cars WHERE car_id = :car_id");
$cars->bindParam(':car_id', $car_id);
$cars->execute();
$cars = $cars->fetch(PDO::FETCH_ASSOC);


$city = $db->prepare("SELECT * FROM city");
$city->execute();
$city = $city->fetchAll(PDO::FETCH_ASSOC);



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

    <form method="post">
        <input type="hidden" name="id" value="<?php echo $_GET["id"]?>">

        <div class="form-group">
            <label for="car_name">Model</label>
            <input type="text" class="form-control" id="car_name" name="car_name" value="<?php echo $cars['car_name'] ?>">
        </div>
        <div class="form-group">
            <label for="car_year">Year</label>
            <input type="text" class="form-control" id="car_year" name="car_year" value="<?php echo $cars['car_year'] ?>">
        </div>
        <div class="form-group">
            <label for="car_price">Price(Monthly)</label>
            <input type="text" class="form-control" id="car_price" name="car_price" value="<?php echo $cars['car_price'] ?>">
        </div>
        <div class="form-group">
            <label for="car_price_daily">Price (Daily)</label>
            <input type="text" class="form-control" id="car_price_daily" name="car_price_daily" value="<?php echo $cars['car_price_daily'] ?>">
        </div>

        <div class="form-group">
            <label for="car_gear">Gear</label>
            <input type="text" class="form-control" id="car_gear" name="car_gear" value="<?php echo $cars['car_gear'] ?>">
        </div>
        <div class="form-group">
            <label for="car_fuel">Fuel</label>
            <input type="text" class="form-control" id="car_fuel" name="car_fuel" value="<?php echo $cars['car_fuel'] ?>">
        </div>

        <div class="form-group">
            <label for="car_location">Location</label>
            <select class="form-control" id="car_location" name="car_location">
                <?php foreach ($city as $city): ?>
                    <option value="<?php echo $city['name'] ?>" <?php echo (($city['name'] == $cars["car_location"]) ? "selected" : null)?> ><?php echo $city['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="car_image">Car Image</label>
            <input type="file" class="form-control" id="car_image" name="car_image">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    

    </form>

    </div>





</body>

</html>