<?php 
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);

    // Prepared statement injection prevention
    $stmt = mysqli_prepare($conn, "INSERT INTO products (sku, name, category, quantity, price) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssid", $sku, $name, $category, $quantity, $price);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Error logging product. Make sure the SKU identifier code is completely unique.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product - Inventory System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 600px;">
        <header>
            <h1>Add New Inventory Item</h1>
            <a href="index.php" class="btn">Back to Dashboard</a>
        </header>
        <div class="card">
            <form method="POST">
                <div class="form-group">
                    <label>SKU / Barcode ID</label>
                    <input type="text" name="sku" class="form-control" required placeholder="e.g. SKU-AUTO-901">
                </div>
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. Wireless Ergonomic Mouse">
                </div>
                <div class="form-group">
                    <label>Category Group</label>
                    <input type="text" name="category" class="form-control" required placeholder="e.g. Electronics, Office Accessories">
                </div>
                <div class="form-group">
                    <label>Initial Stock Volume</label>
                    <input type="number" name="quantity" class="form-control" min="0" required placeholder="0">
                </div>
                <div class="form-group">
                    <label>Unit Valuation Price</label>
                    <input type="number" name="price" step="0.01" class="form-control" min="0" required placeholder="0.00">
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;">Commit Product to Inventory</button>
            </form>
        </div>
    </div>
</body>
</html>
