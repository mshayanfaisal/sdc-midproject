<?php
include 'db.php';

$message = '';
$selected_retailer = '';
$selected_product = '';
$quantity = '';
$product = null;
$total = 0;
$disable_create = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $selected_retailer = isset($_POST['retailer_id']) ? (int)$_POST['retailer_id'] : 0;
    $selected_product = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;

    if ($selected_product) {
        $res = $conn->query("SELECT id, name, price, stock FROM Products WHERE id = $selected_product");
        if ($res && $res->num_rows) $product = $res->fetch_assoc();
    }

    if ($product) $total = $product['price'] * $quantity;

    if ($action === 'preview' && $product) {
        if ($quantity > $product['stock']) {
            $message = "Not enough stock. Available: {$product['stock']}.";
            $disable_create = true;
        }
    }

    if ($action === 'create' && $product) {
        if ($quantity <= 0) {
            $message = 'Enter a valid quantity.';
            $disable_create = true;
        } elseif ($quantity > $product['stock']) {
            $message = "Not enough stock. Available: {$product['stock']}.";
            $disable_create = true;
        } else {
            $unit_price = $product['price'];
            $total_amount = $unit_price * $quantity;
            $conn->query("INSERT INTO PurchaseOrders (retailer_id, product_id, quantity, unit_price, total_amount) VALUES ($selected_retailer, $selected_product, $quantity, $unit_price, $total_amount)");
            $conn->query("UPDATE Products SET stock = stock - $quantity WHERE id = $selected_product");
            $message = 'Order created successfully.';
            $quantity = '';
            $total = 0;
            $disable_create = false;
        }
    }
}

$retailers = $conn->query("SELECT id, name FROM Retailers");
$products = $conn->query("SELECT id, name FROM Products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Create Purchase Order</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="dashboard">
  <?php include 'sidebar.php'; ?>
  <div class="main">
    <div class="header"><h1>Create Purchase Order</h1></div>

    <?php if ($message): ?>
      <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" class="form-wide">
      <label>Retailer</label>
      <select name="retailer_id" required>
        <option value="">Select Retailer</option>
        <?php while($r = $retailers->fetch_assoc()): ?>
          <option value="<?php echo $r['id']; ?>" <?php echo ($r['id']==$selected_retailer)?'selected':''; ?>><?php echo $r['name']; ?></option>
        <?php endwhile; ?>
      </select>

      <label class="label-mt">Product</label>
      <select name="product_id" required>
        <option value="">Select Product</option>
        <?php while($p = $products->fetch_assoc()): ?>
          <option value="<?php echo $p['id']; ?>" <?php echo ($p['id']==$selected_product)?'selected':''; ?>><?php echo $p['name']; ?></option>
        <?php endwhile; ?>
      </select>

      <label class="label-mt">Quantity</label>
      <input type="number" name="quantity" min="1" value="<?php echo ($quantity !== '') ? $quantity : ''; ?>" required>

      <div class="form-actions">
        <button type="submit" name="action" value="preview" class="btn preview">Preview</button>
        <button type="submit" name="action" value="create" class="btn create" <?php echo $disable_create ? 'disabled' : ''; ?>>Create Order</button>
      </div>
    </form>

    <?php if ($product && $quantity): ?>
      <div class="panel">
        <div class="product-card">
          <h3><?php echo $product['name']; ?></h3>
          <p>Unit Price: $<?php echo number_format($product['price'],2); ?></p>
          <p>Available Stock: <?php echo $product['stock']; ?></p>
          <p class="bold">Total Amount: $<?php echo number_format($total,2); ?></p>
          <?php if ($disable_create): ?>
            <p class="error-text">Stock insufficient. Cannot create order.</p>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
