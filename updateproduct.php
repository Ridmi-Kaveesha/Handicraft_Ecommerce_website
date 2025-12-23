<?php

include 'conn.php';


$id = "";
$name = "";
$category = "";
$price = "";
$quantity = "";
$PicLink = "";
$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $PicLink = $_POST['PicLink'];

    
    $sql = "UPDATE product_details SET 
            Name='$name', Price=$price, Category='$category', Quantity=$quantity, 
            PicLink='$PicLink' 
            WHERE ID=$id";

    
    if ($conn->query($sql) === TRUE) {
        $message = "Product updated successfully";
    } else {
        $message = "Error updating product: " . $conn->error;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fetch'])) {
    $id = $_POST['product_id'];
}


if (!empty($id)) {
    $sql = "SELECT * FROM product_details WHERE ID=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['Name'];
        $price = $row['Price'];
        $category = $row['Category'];
        $quantity = $row['Quantity'];
        $PicLink = $row['PicLink'];
    } else {
        $message = "Product not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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

        .message {
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

    </style>
</head>
<body>
    <header>
        <div class="logo">Handy Crafts Admin Panel</div>
    </header>
    <main>
        <section class="container">
            <h2>Edit Product</h2>
            
            
            <?php if (!empty($message)) : ?>
                <div class="message <?php echo strpos($message, 'successfully') !== false ? 'success' : 'error'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            
            
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="product_id">Enter Product ID:</label><br>
                <input type="text" id="product_id" name="product_id" value="<?php echo $id; ?>"><br>
                <button type="submit" name="fetch">Fetch Product</button>
            </form>

            
            <?php if (!empty($id) && empty($message)) : ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <label>Name:</label><br>
                    <input type="text" name="name" value="<?php echo $name; ?>" required><br>
                    <label>Price:</label><br>
                    <input type="number" name="price" value="<?php echo $price; ?>" step="0.01" required><br>
                    <label>Category:</label><br>
                    <input type="text" name="category" value="<?php echo $category; ?>" required><br>
                    <label>Quantity:</label><br>
                    <input type="number" name="quantity" value="<?php echo $quantity; ?>" required><br>
                    <label>Picture Link:</label><br>
                    <input type="text" name="PicLink" value="<?php echo $PicLink; ?>" required><br><br>
                    <input type="submit" name="submit" value="Update Product">
                </form>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>

