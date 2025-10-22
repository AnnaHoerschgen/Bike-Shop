<?php
    require "functions.php";

    error_reporting(E_ALL ^ E_WARNING);

    $dbSuccess = false;

    $DB_HOST = "localhost";
    $DB_NAME = "bikeshop";
    $DB_USER = "root";
    $DB_PASS = "";

    $dsn = "mysql:host=$DB_HOST; dbname=$DB_NAME";

    try {
        $pdo = new PDO($dsn, $DB_USER, $DB_PASS);
        // echo ("Connected\n");

        $reportWhitelist = [
            'available',
            'top3',
            'open',
            'multi',
            'customers',
            'completed'
        ];
        $report = $_GET['report'] ?? 'available';

        $dbSuccess = true;
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
    <?php
        if($dbSuccess) {
            include "includes/header.php";
            
            include "reports/{$report}.php";

            include "includes/footer.php";
        }
    ?>
</body>

</html>