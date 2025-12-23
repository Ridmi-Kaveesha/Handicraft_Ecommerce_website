<?php
include 'conn.php';

$id = "";
$name = "";
$price = "";
$category = "";
$quantity = "";
$PicLink = "";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM product_details WHERE ID=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully";
        $id = "";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fetch'])) {
    $id = $_POST['product_id'];
}

if (!empty($id)) {
    $sql = "SELECT * FROM book_details WHERE ID=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['Name'];
        $price = $row['Price'];
        $category = $row['Category'];
        $quantity = $row['Quantity'];
        $PicLink = $row['PicLink'];
    } else {
        echo "Product not found";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Book</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;
    padding: 20px;
}

header {
    background-color: #004d40;
    color: #fff;
    padding: 20px;
    text-align: center;
}

.logo {
    font-size: 24px;
    font-weight: bold;
}

main {
    padding: 20px;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-bottom: 10px;
}

form {
    margin-top: 10px;
}

input[type="text"],
input[type="number"],
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"],
.btn {
    background-color: #004d40;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 14px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover,
.btn:hover {
    background-color: #00332a;
}

    </style>
</head>
<body>
    <header>
        <div class="logo">Handy Crafts Admin Panel</div>
    </header>
    <main>
        <section class="container">
            <h2>Delete Products</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="product_id">Enter Product ID:</label><br>
                <input type="text" id="product_id" name="product_id" value="<?php echo $id; ?>"><br>
                <button type="submit" name="fetch">Fetch Product</button>
            </form>

            <?php if (!empty($id)) : ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label>Name:</label><br>
                <input type="text" name="name" value="<?php echo $name; ?>" disabled><br>
                <label>Price:</label><br>
                <input type="number" name="price" value="<?php echo $price; ?>" step="0.01" disabled><br>
                <label>Category:</label><br>
                <input type="text" name="category" value="<?php echo $category; ?>" disabled><br>
                <label>Quantity:</label><br>
                <input type="number" name="quantity" value="<?php echo $quantity; ?>" disabled><br>
                <label>Picture Link:</label><br>
                <input type="text" name="PicLink" value="<?php echo $PicLink; ?>" disabled><br><br>
                <input type="submit" name="delete" value="Delete Book">
            </form>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
