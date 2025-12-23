<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        header {
            background-color: rgb(22, 2, 90);
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
            background-color: rgb(22, 2, 90);
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
            background-color: #62729e;
        }

    </style>
</head>
<body>
    <header>
        <div class="logo">Handy Crafts Admin Panel</div>
    </header>
    <main>
        <section class="container">
            <h2>Add New Product</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label>Name:</label><br>
                <input type="text" name="name" required><br>
                <label>Price:</label><br>
                <input type="text" name="price" required><br>
                <label>Category ID:</label><br>
                <input type="number" name="category" required><br>
                <label>Quantity:</label><br>
                <input type="number" name="quantity" required><br>
                <label>Picture Link:</label><br>
                <input type="text" name="PicLink" required><br><br>
                <input type="submit" value="Add Product">
            </form>
            <?php
            // PHP code to handle form submission and insert data into database

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                include 'conn.php';

                // Escape user inputs for security to prevent SQL injection
                $name = $conn->real_escape_string($_POST['name']);
                $category = intval($_POST['category']); // Convert to integer
                $price = $conn->real_escape_string($_POST['price']);
                $quantity = intval($_POST['quantity']); // Convert to integer
                $picLink = $conn->real_escape_string($_POST['PicLink']);

                // Prepare SQL query
                $sql = "INSERT INTO product_details (Product_name, Category_ID, Product_price, Product_quantity, Product_image) 
                        VALUES ('$name', $category, '$price', $quantity, '$picLink')";

                if ($conn->query($sql) === TRUE) {
                    echo "<p>New product added successfully</p>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                // Close connection
                $conn->close();
            }
            ?>
        </section>
    </main>
</body>
</html>
