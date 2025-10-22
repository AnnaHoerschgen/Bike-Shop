<?php
require "functions.php";

$DB_HOST = "localhost";
$DB_NAME = "bikeshop";
$DB_USER = "root";
$DB_PASS = "";

$dsn = "mysql:host=$DB_HOST; dbname=$DB_NAME";

try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS);
    echo ("Connected\n");
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// helper to display queries
function displayQueryResults($pdo, $sql, $title)
{
    echo "<h2>$title</h2>";
    $stmt = $pdo->query($sql);
    if ($stmt && $stmt->rowCount() > 0) {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr>";
        
        for ($i = 0; $i < $stmt->columnCount(); $i++) {
            $col = $stmt->getColumnMeta($i);
            echo "<th>" . htmlspecialchars($col['name']) . "</th>";
        }
        echo "</tr>";
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No results found.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h1>Bike Shop Activity</h1>

    <div id="all-customers">
        <?php displayQueryResults($pdo, sqlAllCustomers(), "All Customers"); ?>
    </div>
    <br>

    <div id="available-bikes">
        <?php displayQueryResults($pdo, sqlAvailableBikes(), "Available Bikes"); ?>
    </div>
    <br>

    <div id="all-bikes-by-price">
        <?php displayQueryResults($pdo, sqlAllCustomers(), "All Bikes by Price"); ?>
    </div>
    <br>

    <div id="open-rentals">
        <?php displayQueryResults($pdo, sqlOpenRentals(), "Open Rentals"); ?>
    </div>
    <br>

    <div id="join-rentals-customers">
        <?php displayQueryResults($pdo, sqlJoinRentalsCustomers(), "Join Rentals and Customers"); ?>
    </div>
    <br>

    <div id="join-rentals-bikes">
        <?php displayQueryResults($pdo, sqlAllCustomers(), "Join Rentals and Bikes"); ?>
    </div>
    <br>

    <div id="top-3-bikes">
        <?php displayQueryResults($pdo, sqlTop3Bikes(), "Top 3 Bikes"); ?>
    </div>
    <br>

    <div id="multi-join-rentals">
        <?php displayQueryResults($pdo, sqlMultiJoinRentals(), "Multi-Join Rentals"); ?>
    </div>
    <br>

    <div id="update-close-rental">
        <?php displayQueryResults($pdo, sqlUpdateCloseRental(4), "Update Closed Rental"); ?>
    </div>
    <br>

    <div id="update-bike-unavailable">
        <?php displayQueryResults($pdo, sqlUpdateBikeUnavailable(4), "Update Unavailable Bike"); ?>
    </div>
    <br>
</body>

</html>