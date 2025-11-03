<?php
$current = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar">
  <div class="logo">Inventory & Stock MS</div>
  <div class="nav">
    <a href="index.php" class="<?php echo ($current === 'index.php') ? 'active' : ''; ?>"><span class="icon" aria-hidden="true"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg></span>Dashboard</a>
    <a href="product.php" class="<?php echo ($current === 'product.php') ? 'active' : ''; ?>"><span class="icon" aria-hidden="true"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 5v14M5 12h14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Add Product</a>
    <a href="product_listing.php" class="<?php echo ($current === 'product_listing.php') ? 'active' : ''; ?>"><span class="icon" aria-hidden="true"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3 7h18M3 12h18M3 17h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>View Products</a>
    <a href="retailers.php" class="<?php echo ($current === 'retailers.php') ? 'active' : ''; ?>"><span class="icon" aria-hidden="true"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M16 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM8 11c1.657 0 3-1.343 3-3S9.657 5 8 5 5 6.343 5 8s1.343 3 3 3zM4 19c0-2.209 3.134-4 7-4s7 1.791 7 4v1H4v-1z" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>View Retailers</a>
    <a href="add_purchase.php" class="<?php echo ($current === 'add_purchase.php') ? 'active' : ''; ?>"><span class="icon" aria-hidden="true"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M6 2l1.6 4h8.8l1.6-4H6zM3 6h18l-2 12H5L3 6zM9 13v4M15 13v4" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Add Purchase</a>
    <a href="purchase_order_listing.php" class="<?php echo ($current === 'purchase_order_listing.php') ? 'active' : ''; ?>"><span class="icon" aria-hidden="true"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3 7h18M7 11h10M10 15h4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>View Purchase Orders</a>

  </div>
</div>
