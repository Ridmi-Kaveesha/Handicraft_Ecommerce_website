<?php
session_start();
include 'conn.php';


if (!isset($_SESSION['product_id']) || empty($_SESSION['product_id'])) {
    echo '<p>Your cart is empty.</p>';
} else {
    echo '<h1>Shopping Cart</h1>';
    foreach ($_SESSION['product_id'] as $product_id => $quantity) {
        
        $sql_check = "SELECT 
        cart.product_id, 
        cart.quantity, 
        products.name, 
        products.price, 
        (products.price * cart.quantity) AS total_price 
    FROM cart 
    INNER JOIN products ON cart.product_id = products.id 
    WHERE cart.status = 'Pending'
";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param('i', $product_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

        if ($result_product->num_rows > 0) {
            $product = $result_product->fetch_assoc();
            $product_name = $product['Product_name'];
            $product_price = $product['Product_price'];

            echo '<div>';
            echo '<img src="products/' . $product['Product_image'] . '" alt="' . $product_name . '">';
            echo '<h3>' . $product_name . '</h3>';
            echo '<p>Price: LKR ' . $product_price . '</p>';
            echo '<p>Quantity: ' . $quantity . '</p>';
            echo '<a href="removefromcart.php?product_id=' . $product_id . '">Remove</a>';
            echo '</div>';
        }
    }

    echo '<a href="checkout.php">Proceed to Checkout</a>';
}

$conn->close();
?>
