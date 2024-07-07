<?php include '../config.php'?>
<?php include './comp/authControler.php'?>

<?php
$cars = [];
include '../database.php';
$database = new Database();
$db = $database->getConnection();

$cars_query = $db->prepare("SELECT * FROM cars");
$cars_query->execute();
$cars = $cars_query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <?php include './comp/header.php'?>

    <div class="container mt-5">
    <?php
        
        if(!empty($_GET['success'])):
            echo "<div class='alert alert-success m-5'>".$_GET['success']."</div>";
        endif;
        if(!empty($_GET['error'])):
            echo "<div class='alert alert-danger m-5'>".$_GET['error']."</div>";
        endif;
        
        ?>
        <div class="row">
            <div class="col-12">
                <a href="add-car.php" class="btn btn-primary">Add Car</a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Model</th>
                            <th scope="col">Year</th>
                            <th scope="col">Price (Monthly)</th>
                            <th scope="col">Price (Daily)</th>
                            <th scope="col">Gear</th>
                            <th scope="col">Fuel</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cars as $car): ?>
                            <tr>
                                <th scope="row"><?php echo $car['car_id']?></th>
                                <td><?php echo $car['car_name']?></td>
                                <td><?php echo $car['car_year']?></td>
                                <td><?php echo $car['car_price']?></td>
                                <td><?php echo $car['car_price_daily']?></td>
                                <td><?php echo $car['car_gear']?></td>
                                <td><?php echo $car['car_fuel']?></td>
                                <td>
                                    <a href="delete-car.php?id=<?php echo $car['car_id']?>" class="btn btn-danger">Delete</a>
                                    <a href="edit-car.php?id=<?php echo $car['car_id']?>" class="btn btn-warning">Edit</a>
                                
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    
</body>
</html>