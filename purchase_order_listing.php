<?php
include 'db.php';

$sql = "
  SELECT 
    p.id,
    r.name AS retailer_name,
    pr.name AS product_name,
    p.quantity,
    p.unit_price,
    p.total_amount,
    p.order_date
  FROM PurchaseOrders p
  JOIN Retailers r ON p.retailer_id = r.id
  JOIN Products pr ON p.product_id = pr.id
  ORDER BY p.order_date DESC
";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Purchase Orders</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="dashboard">
  <?php include 'sidebar.php'; ?>
  <div class="main">
    <div class="header"><h1>Purchase Orders</h1></div>

    <div class="container">
      <?php if ($result && $result->num_rows > 0): ?>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Retailer</th>
              <th>Product</th>
              <th>Qty</th>
              <th>Unit Price</th>
              <th>Total</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['retailer_name']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td>$<?php echo number_format($row['unit_price'], 2); ?></td>
                <td>$<?php echo number_format($row['total_amount'], 2); ?></td>
                <td><?php echo date('Y-m-d H:i', strtotime($row['order_date'])); ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="no-data">No purchase orders found</div>
      <?php endif; ?>
    </div>

  </div>
</div>
</body>
</html>
<?php $conn->close(); ?>
