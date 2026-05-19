<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}

include 'db.php';

if(isset($_POST['add_sale'])){

    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $sale_date = date("Y-m-d");

    mysqli_query($conn,
        "INSERT INTO sales(product_id, quantity, sale_date)
         VALUES('$product_id','$quantity','$sale_date')");

    mysqli_query($conn,
        "UPDATE products
         SET quantity = quantity - $quantity
         WHERE product_id=$product_id");
}

$total_sales = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM sales"));

?>

<!DOCTYPE html>
<html>

<head>

    <title>Sales</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="sidebar">

    <h2>Inventory</h2>

    <ul>

        <li><a href="products.php">Products</a></li>

        <li><a href="suppliers.php">Suppliers</a></li>

        <li><a href="sales.php">Sales</a></li>

        <li><a href="logout.php">Logout</a></li>

    </ul>

</div>

<div class="main-content">

    <h1>Sales Management</h1>

    <div class="cards">

        <div class="card orange">

            <h2><?php echo $total_sales; ?></h2>

            <p>Total Sales</p>

        </div>

    </div>

    <div class="form-section">

        <h2>Add Sale</h2>

        <form method="POST">

            <select name="product_id" required>

                <option value="">Select Product</option>

                <?php

                $products = mysqli_query($conn, "SELECT * FROM products");

                while($row = mysqli_fetch_assoc($products)){

                ?>

                <option value="<?php echo $row['product_id']; ?>">

                    <?php echo $row['product_name']; ?>

                </option>

                <?php } ?>

            </select>

            <input type="number"
                   name="quantity"
                   placeholder="Quantity Sold"
                   required>

            <button type="submit" name="add_sale">

                Add Sale

            </button>

        </form>

    </div>

    <div class="table-section">

        <h2>Sales History</h2>

        <table>

            <tr>

                <th>ID</th>

                <th>Product ID</th>

                <th>Quantity</th>

                <th>Date</th>

            </tr>

            <?php

            $sales = mysqli_query($conn, "SELECT * FROM sales");

            while($row = mysqli_fetch_assoc($sales)){

            ?>

            <tr>

                <td><?php echo $row['sale_id']; ?></td>

                <td><?php echo $row['product_id']; ?></td>

                <td><?php echo $row['quantity']; ?></td>

                <td><?php echo $row['sale_date']; ?></td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>

</html>