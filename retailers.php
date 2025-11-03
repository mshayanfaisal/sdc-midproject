<?php
include 'db.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM Retailers WHERE id=$id");
}

$result = $conn->query("SELECT * FROM Retailers");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Retailers</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="dashboard">
  <?php include 'sidebar.php'; ?>

  <div class="main">
    <div class="page-header">
      <h1>Retailers</h1>
      <a href="add_retailer.php" class="add-retailer-btn">+ Add Retailer</a>
    </div>

    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th style="text-align:center;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $row['name']; ?></td>
              <td style="text-align:center;"><?php echo $row['phone']; ?></td>
              <td><?php echo $row['address']; ?></td>
              <td style="text-align:center;">
                <a href="edit_retailer.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this retailer?')" class="delete-link">Delete</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>

<?php $conn->close(); ?>
