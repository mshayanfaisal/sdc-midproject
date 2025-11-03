<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "midprojectdb";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS $db");
$conn->select_db($db);

$conn->query("CREATE TABLE IF NOT EXISTS Products (
  id INT(8) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description VARCHAR(255) NOT NULL,
  image VARCHAR(255),
  price DECIMAL(10,2) NOT NULL,
  stock INT NOT NULL
)");

$conn->query("CREATE TABLE IF NOT EXISTS Retailers (
  id INT(8) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  phone VARCHAR(255) NOT NULL,
  address VARCHAR(255) NOT NULL
)");

$conn->query("CREATE TABLE IF NOT EXISTS PurchaseOrders (
    id INT(8) AUTO_INCREMENT PRIMARY KEY,
    retailer_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (retailer_id) REFERENCES Retailers(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES Products(id) ON DELETE CASCADE
)");
?>
