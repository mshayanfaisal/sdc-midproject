<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="dashboard">
        <?php include 'sidebar.php'; ?>
   <div class="main">
    <h1>Add Product</h1>
    <form action="add_product.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="text" name="description" placeholder="Product Description" required>
        <input type="file" name="image" accept="image/*" required>
        <input type="number" name="price" placeholder="Product Price" required>
        <input type="number" name="stock" placeholder="Product Stock" required>
        <button type="submit">Add Product</button>
    </form>
     </div>
     </div>
</body>
</html>
