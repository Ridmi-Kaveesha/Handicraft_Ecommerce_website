<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo '<p>Your cart is empty. Please add some items to proceed to checkout.</p>';
} else {
    // Display cart items here for confirmation
    $cart_items = $_SESSION['cart'];

    echo '<h1>Checkout</h1>';

    foreach ($cart_items as $cart_item) {
        $sql = "SELECT * FROM cart WHERE ID = $cart_item";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];

            // Fetch product details from product_details table
            $sql_product = "SELECT * FROM product_details WHERE Product_ID = $product_id";
            $result_product = $conn->query($sql_product);

            if ($result_product->num_rows > 0) {
                $product = $result_product->fetch_assoc();
                $product_name = $product['Product_name'];
                $product_price = $product['Product_price'];

                echo '<div>';
                echo '<h3>' . $product_name . '</h3>';
                echo '<p>Price: LKR ' . $product_price . '</p>';
                echo '<p>Quantity: ' . $quantity . '</p>';
                echo '</div>';
            }
        }
    }

    // Add checkout form here for user details and payment
}

$conn->close();
?>
