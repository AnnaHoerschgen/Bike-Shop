<?php
require "functions.php";

$DB_HOST = "localhost";
$DB_NAME = "bike_shop";
$DB_USER = "root";
$DB_PASS = "";

$dsn = "mysql:host=$DB_HOST; dbname=$DB_NAME";

try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS);
    echo ("Connected\n");
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

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
</head>

<body>
    <h1>Bike Shop Activity</h1>
    <div>
        <?php
        displayQueryResults($pdo, sqlAllCustomers(), "All Customers");
        ?>
    </div>
    <br>

    <div>
        <?php
        displayQueryResults($pdo, sqlAvailableBikes(), "Available Bikes");
        ?>
    </div>
    <br>

    <div>
        <?php
        displayQueryResults($pdo, sqlBikeRentals(), "Bike Rentals");
        ?>
    </div>
    <br>


    <div>
        <?php
        displayQueryResults($pdo, sqlMorningRentals(), "Morning Rentals");
        ?>
    </div>
    <br>

    <div>
        <?php
        displayQueryResults($pdo, sqlTop3Bikes(), "Top 3 Bikes");
        ?>
    </div>
    <br>

    <div>
        <?php
        displayQueryResults($pdo, sqlAllJoins(), "All Joins");
        ?>
    </div>
    <br>

    <div>
        <?php
        displayQueryResults($pdo, sqlUpdateEndTime(4), "Update End Time");
        ?>
    </div>
    <br>

    <div>
        <?php
        displayQueryResults($pdo, sqlUpdateBikeStatus(4), "Update Bike Status");
        ?>
    </div>
    <br>
</body>

</html>