<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}

include 'db.php';

$id = $_GET['id'];

$product = mysqli_query($conn, "SELECT * FROM products WHERE product_id=$id");

$row = mysqli_fetch_assoc($product);

if(isset($_POST['update_product'])){

    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $query = "UPDATE products 
              SET 
              product_name='$product_name',
              category='$category',
              quantity='$quantity',
              price='$price'
              WHERE product_id=$id";

    mysqli_query($conn, $query);

    header("Location: products.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="main-content">

    <div class="form-section">

        <h2>Edit Product</h2>

        <form method="POST">

            <input type="text"
                   name="product_name"
                   value="<?php echo $row['product_name']; ?>"
                   required>

            <input type="text"
                   name="category"
                   value="<?php echo $row['category']; ?>"
                   required>

            <input type="number"
                   name="quantity"
                   value="<?php echo $row['quantity']; ?>"
                   required>

            <input type="number"
                   name="price"
                   value="<?php echo $row['price']; ?>"
                   required>

            <button type="submit" name="update_product">
                Update Product
            </button>

        </form>

        <br>

        <a class="back-btn" href="products.php">
            Back
        </a>

    </div>

</div>

</body>
</html>