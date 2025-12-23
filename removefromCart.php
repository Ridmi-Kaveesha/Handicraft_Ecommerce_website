<?php
session_start();
include 'conn.php';

if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];

    $sql_delete = "DELETE FROM cart WHERE ID = $cart_id";
    $conn->query($sql_delete);

    // Remove from session cart array as well
    if (($key = array_search($cart_id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }
}

header("Location: cart.php"); // Redirect back to cart page
?>
