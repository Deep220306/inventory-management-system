<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}

include 'db.php';

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM products WHERE product_id=$id");
}

if(isset($_POST['add_product'])){

    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $query = "INSERT INTO products(product_name, category, quantity, price)
              VALUES('$product_name','$category','$quantity','$price')";

    mysqli_query($conn, $query);
}

$total_products = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));
$total_suppliers = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM suppliers"));
$total_sales = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM sales"));
?>

<!DOCTYPE html>
<html>

<head>
    <title>Inventory Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="sidebar">
    <h2>Inventory</h2>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="suppliers.php">Suppliers</a></li>
        <li><a href="sales.php">Sales</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div class="main-content">

    <h1>Inventory Management System</h1>

    <div class="cards">

        <div class="card blue">
            <h2><?php echo $total_products; ?></h2>
            <p>Total Products</p>
        </div>

        <div class="card green">
            <h2><?php echo $total_suppliers; ?></h2>
            <p>Suppliers</p>
        </div>

        <div class="card orange">
            <h2><?php echo $total_sales; ?></h2>
            <p>Sales</p>
        </div>

    </div>

    <div class="form-section">

        <h2>Add Product</h2>

        <form method="POST">

            <input type="text" name="product_name" placeholder="Product Name" required>

            <input type="text" name="category" placeholder="Category" required>

            <input type="number" name="quantity" placeholder="Quantity" required>

            <input type="number" name="price" placeholder="Price" required>

            <button type="submit" name="add_product">Add Product</button>

        </form>

    </div>
    <div class="table-section">
        <h2>Product List</h2>
        <input type="text" id="searchInput" placeholder="Search Product...">
        <table id="productTable">
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php
            $products = mysqli_query($conn, "SELECT * FROM products");
            while($row = mysqli_fetch_assoc($products)){
            ?>
            <tr>
                <td><?php echo $row['product_id']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td>
                    <a class="edit-btn"
                     href="edit.php?id=<?php echo $row['product_id']; ?>">
                     Edit
                    </a>
                    <a class="delete-btn"
                    onclick="return confirm('Are you sure you want to delete this product?')"
                    href="products.php?delete=<?php echo $row['product_id']; ?>">
                    Delete
                    </a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
<script src="js/script.js"></script>
</body>
</html>