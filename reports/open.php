<?php
    include "../functions.php";
    
    $sql = sqlOpenRentals();
    $stmt = $pdo->query($sql);

    echo "<h2>Open Rentals (No End Time)</h2>";
    if ($stmt->rowCount() > 0) {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr>";
        foreach (array_keys($stmt->fetch(PDO::FETCH_ASSOC)) as $col) {
            echo "<th>" . htmlspecialchars($col) . "</th>";
        }
        echo "</tr>";
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No open rentals at the moment.</p>";
    }
?>