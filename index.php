<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dashboard">
    <?php include 'sidebar.php'; ?>
    <main class="main">
        <header class="header">
            <h1>Dashboard</h1>
        </header>
        <section class="cards">
            <div class="card">
                <div class="kpi"><span class="icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="3" width="7" height="7" rx="1" stroke="#27ae60" stroke-width="1.5"/><rect x="14" y="3" width="7" height="7" rx="1" stroke="#27ae60" stroke-width="1.5"/><rect x="3" y="14" width="7" height="7" rx="1" stroke="#27ae60" stroke-width="1.5"/><rect x="14" y="14" width="7" height="7" rx="1" stroke="#27ae60" stroke-width="1.5"/></svg></span></div>
                <h3>Total Products</h3>
                <?php
                $sql = "SELECT COUNT(*) as total FROM Products";
                $result = $conn->query($sql);
                $data = $result->fetch_assoc();
                ?>
                <p><?php echo $data['total']; ?></p>
            </div>
            <div class="card">
                <div class="kpi"><span class="icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 9v4" stroke="#e67e22" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 17h.01" stroke="#e67e22" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="#e67e22" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg></span></div>
                <h3>Low Stock</h3>
                <?php
                $sql = "SELECT COUNT(*) as low_stock FROM Products WHERE stock < 5";
                $result = $conn->query($sql);
                $data = $result->fetch_assoc();
                ?>
                <p><?php echo $data['low_stock']; ?></p>
            </div>
            <div class="card">
                <div class="kpi"><span class="icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 1v22" stroke="#004d40" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path d="M17 5H9a3 3 0 100 6h6a3 3 0 110 6H7" stroke="#004d40" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg></span></div>
                <h3>Total Inventory Value</h3>
                <?php
                $sql = "SELECT SUM(price * stock) as total_value FROM Products";
                $result = $conn->query($sql);
                $data = $result->fetch_assoc();
                ?>
                <p>$<?php echo number_format($data['total_value']); ?></p>
            </div>
        </section>

        <section class="overview">
            <h2>Quick Access</h2>
            <div class="overview-grid">
                <a href="product.php" class="overview-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/992/992651.png" alt="Add Product">
                    <p>Add New Product</p>
                </a>
                <a href="add_retailer.php" class="overview-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png" alt="Add Retailer">
                    <p>Add Retailer</p>
                </a>
                <a href="add_purchase.php" class="overview-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/1828/1828817.png" alt="Add Purchase">
                    <p>Add Purchase Order</p>
                </a>
            </div>
        </section>
    </main>
</div>

</body>
</html>
