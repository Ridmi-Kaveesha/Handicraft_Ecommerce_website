<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wooden Products</title>
    <link rel="stylesheet" href="styleproduct.css">
    <script>
        function addToCart(productId) {
            fetch(`../addtocarthandler.php?id=${productId}`)
                .then(response => response.text())
                .then(data => {
                    console.log('Response from server:', data);
                    if (data.includes('Product added to cart successfully!')) {
                        alert('Product added to cart successfully!');
                    } else {
                        alert('Failed to add product to cart: ' + data);
                    }
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    alert('Failed to add product to cart.');
                });
        }
    </script>
</head>
<body>
    <!-- Product Container -->
    <div class="product-container">
        <div class="box">
            <img src="products/wood_1.jpg" alt="wood_1">
            <h3>Wooden couple light</h3>
            <div class="content">
                <span>LKR.1500/=</span>
                <a href="#" onclick="addToCart(1)">Add To Cart</a>
            </div>
        </div>

        <div class="box">
            <img src="products/wood_2.jpg" alt="wood_2">
            <h3>Coconut shell light</h3>
            <div class="content">
                <span>LKR.900/=</span>
                <a href="#" onclick="addToCart(2)">Add To Cart</a>
            </div>
        </div>

        <div class="box">
            <img src="products/wood_3.jpg" alt="wood_3">
            <h3>Table lamp</h3>
            <div class="content">
                <span>LKR.1700/=</span>
                <a href="#" onclick="addToCart(3)">Add To Cart</a>
            </div>
        </div>

        <div class="box">
            <img src="products/wood_4.jpg" alt="wood_4">
            <h3>Swing couple</h3>
            <div class="content">
                <span>LKR.2500/=</span>
                <a href="#" onclick="addToCart(4)">Add To Cart</a>
            </div>
        </div>
    </div>
</body>
</html>
