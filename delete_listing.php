<?php
include 'db.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // $conn->query("DELETE FROM Retailers WHERE id=$id");
}

$result = $conn->query("SELECT * FROM products WHERE is_delete = 1");
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
      <h1>Deleted Products</h1>
    </div>

    <div class="container">
        <tbody>
        <div class="product-grid">
          <?php
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo "
                  <div class='product-card'>
                    <img src='{$row['image']}' alt='Product Image'>
                    <div class='product-info'>
                      <a href='product_detail.php?id={$row['id']}'><h3>{$row['name']}</h3></a>
                      <p class='description'>{$row['description']}</p>
                      <p class='price'>Price: <span>\${$row['price']}</span></p>
                      <p class='stock'>Stock: <span>{$row['stock']}</span></p>
                    </div>
                  </div>";
              }
          } else {
              echo "<p class='no-products'>No products found</p>";
          }
          ?>
        </div>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>

<?php $conn->close(); ?>
