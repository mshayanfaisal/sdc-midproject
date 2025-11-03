<?php
include 'db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM Retailers WHERE id=$id");
$retailer = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $conn->query("UPDATE Retailers SET name='$name', phone='$phone', address='$address' WHERE id=$id");
    header('Location: retailers.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Retailer</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="dashboard">
  <?php include 'sidebar.php'; ?>

  <div class="main">
    <h1>Edit Retailer</h1>
    <form method="POST">
      <input type="text" name="name" value="<?php echo $retailer['name']; ?>" required>
      <input type="text" name="phone" value="<?php echo $retailer['phone']; ?>">
      <input type="text" name="address" value="<?php echo $retailer['address']; ?>">
      <button type="submit">Update Retailer</button>
    </form>
  </div>
</div>
</body>
</html>
