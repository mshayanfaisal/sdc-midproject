<?php
include 'db.php';
$message = "";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $result = $conn->query("SELECT * FROM Products WHERE id = $id");
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        $message = "Product not found.";
    }
} else {
    $message = "Invalid request.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $path = "uploads/" . basename($image_name);
        if (move_uploaded_file($tmp, $path)) {
            $image = $path;
        } else {
            $image = $product['image'];
        }
    } else {
        $image = $product['image'];
    }
    $conn->query("UPDATE Products SET name='$name', description='$description', price='$price', stock='$stock', image='$image' WHERE id=$id");
    $message = "Product updated successfully.";
    $result = $conn->query("SELECT * FROM Products WHERE id = $id");
    $product = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $conn->query("UPDATE Products SET is_delete=true");
    $message = "Product deleted successfully.";
    unset($product);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

 <div class="dashboard">
    <?php include 'sidebar.php'; ?>
    <div class="main">
        <div class="header">
            <h1>Product Details</h1>
        </div>

        <div class="product-page">
            <?php if (!empty($message)): ?>
                <p class="message">
                    <?php echo htmlspecialchars($message); ?>
                </p>
            <?php endif; ?>

            <?php if (isset($product)): ?>
                <div class="product-card centered">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p class="description"><?php echo htmlspecialchars($product['description']); ?></p>
                        <p class="price"><span>$<?php echo number_format($product['price'], 2); ?></span></p>
                        <p class="stock">Stock: <span><?php echo htmlspecialchars($product['stock']); ?></span></p>
                    </div>
                </div>

              <form method="POST" enctype="multipart/form-data" class="form-top-gap">
                <input type="text" name="name" value="<?php echo $product['name']; ?>" placeholder="Product Name" required>
                <input type="text" name="description" value="<?php echo $product['description']; ?>" placeholder="Description" required>
                <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" placeholder="Price" required>
                <input type="number" name="stock" value="<?php echo $product['stock']; ?>" placeholder="Stock" required>
                <input type="file" name="image">
                <div class="form-actions">
                    <button type="submit" name="update">Update Product</button>
                    <button type="submit" name="delete" class="delete">Delete Product</button>
                </div>
            </form>


            <?php else: ?>
                <p class="no-product-msg">No product to display.</p>
            <?php endif; ?>
        </div>
    </div>
            </div>
</div>

</body>
</html>
