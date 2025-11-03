<?php 
include 'db.php';

$search = "";
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
    $sql = "SELECT * FROM Products WHERE name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM Products";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product List</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="dashboard">
    <?php include 'sidebar.php'; ?>

    <div class="main">
      <div class="product-page">
        <h1>All Products</h1>

        <form method="GET" class="product-search-form">
          <input 
            type="text" 
            name="search" 
            placeholder="Search product by name..." 
            value="<?php echo $search; ?>" 
          >
          <button 
            type="submit"
          >
            Search
          </button>
        </form>

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
      </div>
    </div>
  </div>
</body>
</html>

<?php $conn->close(); ?>
