<?php 
include 'db.php'; 

if (!isset($_GET['id'])) { header("Location: index.php"); exit(); }
$id = intval($_GET['id']);

$stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$product = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);

    $update_stmt = mysqli_prepare($conn, "UPDATE products SET sku=?, name=?, category=?, quantity=?, price=? WHERE id=?");
    mysqli_stmt_bind_param($update_stmt, "sssidi", $sku, $name, $category, $quantity, $price, $id);
    mysqli_stmt_execute($update_stmt);
    
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modify Product Entry</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 600px;">
        <header>
            <h1>Edit Product Information</h1>
            <a href="index.php" class="btn">Cancel Changes</a>
        </header>
        <div class="card">
            <form method="POST">
                <div class="form-group">
                    <label>SKU / Barcode ID</label>
                    <input type="text" name="sku" class="form-control" value="<?php echo htmlspecialchars($product['sku']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Product Designation Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Category Allocation</label>
                    <input type="text" name="category" class="form-control" value="<?php echo htmlspecialchars($product['category']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Current Stock Inventory</label>
                    <input type="number" name="quantity" class="form-control" value="<?php echo htmlspecialchars($product['quantity']); ?>" min="0" required>
                </div>
                <div class="form-group">
                    <label>Unit Base Price</label>
                    <input type="number" name="price" step="0.01" class="form-control" value="<?php echo htmlspecialchars($product['price']); ?>" min="0" required>
                </div>
                <button type="submit" class="btn btn-success" style="width:100%;">Save Operational Changes</button>
            </form>
        </div>
    </div>
</body>
</html>
