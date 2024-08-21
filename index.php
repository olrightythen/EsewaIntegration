<?php
include 'dbconfig.php';

// Fetching data from the product table
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Pasal</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Header -->
    <header class="header">
        <h1 class="header-title">E-Pasal</h1>
        <nav class="header-nav">
            <a href="#">Home</a>
            <a href="#">Products</a>
            <a href="#">Cart</a>
            <a href="#">Contact</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <h2 class="section-title">Products</h2>
        <section class="product-list">
            <?php
            if ($result->num_rows > 0) {
                // Output data for each row
                while ($row = $result->fetch_assoc()) {
                    echo '<article class="product-card">';
                    echo '<img alt="product-image" src="' . $row["image"] . '" class="product-image" />';
                    echo '<h2 class="product-title">' . htmlspecialchars($row["title"]) . '</h2>';
                    echo '<p class="product-description">' . htmlspecialchars($row["description"]) . '</p>';
                    echo '<p class="product-price">Rs.' . htmlspecialchars($row["price"]) . '</p>';
                    echo '<div class="product-buttons">';
                    echo '<button class="product-button add-to-cart">Add to Cart</button>';
                    echo "<form action='checkout.php' method='POST'>";
                    echo "<input type='hidden' name='product_id' value='" . $row["id"] . "'>";
                    echo "<input type='submit' class='product-button buy-now' value='Buy Now'>";
                    echo "</form>";
                    echo '</div>';
                    echo '</article>';
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 E-Pasal. All rights reserved.</p>
    </footer>

</body>

</html>

<?php
$conn->close();
?>