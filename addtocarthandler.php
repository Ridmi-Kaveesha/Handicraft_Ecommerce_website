<?php
session_start();
include 'conn.php';

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    
    
    if (!isset($_SESSION['product_id'])) {
        $_SESSION['product_id'] = array();
    }

    
    $sql_check = "SELECT * FROM cart WHERE product_id = ? AND status = 'Pending'";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param('i', $product_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        
        $sql_update = "UPDATE cart SET quantity = quantity + 1 WHERE product_id = ? AND status = 'Pending'";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param('i', $product_id);
        if ($stmt_update->execute()) {
            echo "Product added to cart successfully!";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        
        $sql_insert = "INSERT INTO cart (product_id, quantity, status) VALUES (?, 1, 'Pending')";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param('i', $product_id);
        if ($stmt_insert->execute()) {
            echo "Product added to cart successfully!";
        } else {
            echo "Error inserting record: " . $conn->error;
        }
    }
} else {
    echo "Failed to add product to cart. Product ID not provided.";
}

$conn->close();
?>
