<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... (your existing code)

    // Sample SQL query (replace with your actual query)
    $sql = "SELECT * FROM products WHERE 
            (product_name LIKE '%$productName%') AND
            (warehouse_city LIKE '%$warehouseCity%') AND
            (quantity BETWEEN $minQuantity AND $maxQuantity) AND
            (price BETWEEN $minPrice AND $maxPrice)";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $searchResults = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $searchResults = [];
    }
} else {
    // Redirect to the search page if accessed directly without a POST request
    header("Location: search.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Search Results</title>
</head>
<body>
    <h1>Search Results</h1>

    <?php
    // Display search results here using PHP and SQL
    // Implement your search logic and SQL queries
    // For example:
    /*
    $productName = $_POST["product_name"];
    $warehouseCity = $_POST["warehouse_city"];
    $minQuantity = $_POST["min_quantity"];
    $maxQuantity = $_POST["max_quantity"];
    $minPrice = $_POST["min_price"];
    $maxPrice = $_POST["max_price"];

    $sql = "SELECT * FROM products WHERE 
            (product_name LIKE '%$productName%') AND
            (warehouse_city LIKE '%$warehouseCity%') AND
            (quantity BETWEEN $minQuantity AND $maxQuantity) AND
            (price BETWEEN $minPrice AND $maxPrice)";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>" . $row["product_name"] . " - " . $row["warehouse_city"] . " - " . $row["quantity"] . " - $" . $row["price"] . "</p>";
        }
    } else {
        echo "<p>No results found.</p>";
    }
    */
    ?>

    <button onclick="location.href='search.php'">Perform Another Search</button>
</body>
</html>
