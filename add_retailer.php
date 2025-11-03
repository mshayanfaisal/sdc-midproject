<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $conn->query("INSERT INTO Retailers (name, phone, address) VALUES ('$name', '$phone', '$address')");
    header('Location: retailers.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Retailer</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="dashboard">
  <?php include 'sidebar.php'; ?>

  <div class="main">
    <h1>Add Retailer</h1>
    <form method="POST">
      <input type="text" name="name" placeholder="Retailer Name" required>
      <input type="text" name="phone" placeholder="Phone Number">
      <input type="text" name="address" placeholder="Address">
      <button type="submit">Add Retailer</button>
    </form>
  </div>
</div>
</body>
</html>
