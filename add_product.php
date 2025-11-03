<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($image_tmp, "uploads/" . $image_name);

    $sql = "INSERT INTO Products (name, description, image, price, stock)
            VALUES ('$name', '$description', 'uploads/$image_name', '$price', '$stock')";

    $conn->query($sql);
    $conn->close();
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Added</title>
</head>
<body>
    <h1>Product Added Successfully</h1>
    <button><a href="product_listing.php">View Products</a></button>
</body>
</html>
