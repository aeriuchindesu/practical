<?php 
include 'db.php'; 

// Process Product Deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = mysqli_prepare($conn, "DELETE FROM products WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    header("Location: index.php");
    exit();
}

// Fetch all product entries from database
$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Inventory Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>📦 Product Inventory Dashboard</h1>
            <a href="add.php" class="btn btn-primary">+ Add New Product</a>
        </header>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>SKU / Barcode</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Stock Qty</th>
                        <th>Unit Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($row['sku']); ?></strong></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['category']); ?></td>
                                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                                <td>$<?php echo htmlspecialchars($row['price']); ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success" style="padding:5px 10px; font-size:14px;">Edit</a>
                                    <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger" style="padding:5px 10px; font-size:14px;" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align:center;">No stock items found. Click "+ Add New Product" to populate your inventory ledger.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
