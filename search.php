<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     Store form values in session for pre-filling
    $_SESSION["form_values"] = $_POST;

    // Extract search parameters
    $productName = $_POST["product_name"];
    $warehouseCity = $_POST["warehouse_city"];
    $minQuantity = $_POST["min_quantity"];
    $maxQuantity = $_POST["max_quantity"];
    $minPrice = $_POST["min_price"];
    $maxPrice = $_POST["max_price"];

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
    <title>Product Search</title>
</head>
<body>
    <h1>Product Search</h1>
    <form action="search_results.php" method="post" id="searchForm">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" value="<?php echo isset($_SESSION['form_values']['product_name']) ? $_SESSION['form_values']['product_name'] : ''; ?>" placeholder="Optional">

        <label for="warehouse_city">Warehouse City:</label>
        <input type="text" name="warehouse_city" id="warehouse_city" value="<?php echo isset($_SESSION['form_values']['warehouse_city']) ? $_SESSION['form_values']['warehouse_city'] : ''; ?>" placeholder="Optional">

        <label for="min_quantity">Min Quantity:</label>
        <input type="number" name="min_quantity" id="min_quantity" value="<?php echo isset($_SESSION['form_values']['min_quantity']) ? $_SESSION['form_values']['min_quantity'] : ''; ?>" placeholder="Optional">

        <label for="max_quantity">Max Quantity:</label>
        <input type="number" name="max_quantity" id="max_quantity" value="<?php echo isset($_SESSION['form_values']['max_quantity']) ? $_SESSION['form_values']['max_quantity'] : ''; ?>" placeholder="Optional">

        <label for="min_price">Min Price:</label>
        <input type="number" name="min_price" id="min_price" value="<?php echo isset($_SESSION['form_values']['min_price']) ? $_SESSION['form_values']['min_price'] : ''; ?>" placeholder="Optional">

        <label for="max_price">Max Price:</label>
        <input type="number" name="max_price" id="max_price" value="<?php echo isset($_SESSION['form_values']['max_price']) ? $_SESSION['form_values']['max_price'] : ''; ?>" placeholder="Optional">

        <button type="submit" name="search">Search Products</button>
        <button type="button" onclick="location.href='search.php'">Perform Another Search</button>
        <button type="button" onclick="clearForm()">Clear Form</button>
    </form>
    <script src="script.js"></script>
</body>
</html>
