<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}

include 'db.php';

if(isset($_POST['add_supplier'])){

    $supplier_name = $_POST['supplier_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $query = "INSERT INTO suppliers(supplier_name, phone, address)
              VALUES('$supplier_name','$phone','$address')";

    mysqli_query($conn, $query);
}

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM suppliers WHERE supplier_id=$id");
}

$total_suppliers = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM suppliers"));
?>

<!DOCTYPE html>
<html>

<head>
    <title>Suppliers</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="sidebar">

    <h2>Inventory</h2>

    <ul>
        <li><a href="products.php">Products</a></li>
        <li><a href="suppliers.php">Suppliers</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

</div>

<div class="main-content">

    <h1>Supplier Management</h1>

    <div class="cards">

        <div class="card green">
            <h2><?php echo $total_suppliers; ?></h2>
            <p>Total Suppliers</p>
        </div>

    </div>

    <div class="form-section">

        <h2>Add Supplier</h2>

        <form method="POST">

            <input type="text"
                   name="supplier_name"
                   placeholder="Supplier Name"
                   required>

            <input type="text"
                   name="phone"
                   placeholder="Phone"
                   required>

            <input type="text"
                   name="address"
                   placeholder="Address"
                   required>

            <button type="submit" name="add_supplier">
                Add Supplier
            </button>

        </form>

    </div>

    <div class="table-section">

        <h2>Supplier List</h2>

        <table>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>

            <?php

            $suppliers = mysqli_query($conn, "SELECT * FROM suppliers");

            while($row = mysqli_fetch_assoc($suppliers)){

            ?>

            <tr>

                <td><?php echo $row['supplier_id']; ?></td>

                <td><?php echo $row['supplier_name']; ?></td>

                <td><?php echo $row['phone']; ?></td>

                <td><?php echo $row['address']; ?></td>

                <td>

                    <a class="delete-btn"
                       onclick="return confirm('Delete this supplier?')"
                       href="suppliers.php?delete=<?php echo $row['supplier_id']; ?>">
                       Delete
                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>