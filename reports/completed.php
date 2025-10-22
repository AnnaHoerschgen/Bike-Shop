<?php
    include "../functions.php";

    error_reporting(0);

    $sql = sqlCompletedRentals();
    $stmt = $pdo->query($sql);

    if ($stmt->rowCount() > 0): ?>
        <h2>Completed Rentals</h2>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Bike Model</th>
                <th>Customer Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Duration (min)</th>
                <th>Total Cost</th>
            </tr>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                $start = new DateTime($row['start_time']);
                $end = new DateTime($row['end_time']);
                $intervasl = $start->diff($end);
                $minutes = ($interval->h * 60) + $interval->i;
                $rate = (float) $row['hourly_rate'];
                $cost = ($minutes / 60) * $rate;
            ?>
                <tr>
                    <td><?= htmlspecialchars($row['model']) ?></td>
                    <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                    <td><?= $start->format('H:i') ?></td>
                    <td><?= $end->format('H:i') ?></td>
                    <td><?= $minutes ?></td>
                    <td>$<?= number_format($cost, 2) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No completed rentals found.</p>
    <?php endif; ?>
