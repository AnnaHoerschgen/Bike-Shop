<?php
    function sqlAllCustomers(): string {
        return "
            SELECT *
            FROM customers
            ORDER BY last_name, first_name;
        ";
    }

    function sqlAvailableBikes(): string {
        return "
            SELECT *
            FROM bikes
            WHERE available = 1;
        ";
    }

    function sqlAllBikesByPrice(): string {
        return "
            SELECT *
            FROM bikes
            ORDER BY hourly_rate DESC;
        ";
    }

    function sqlOpenRentals(): string {
        return "
            SELECT *
            FROM rentals
            WHERE end_time IS NULL;
        ";
    }

    function sqlJoinRentalsCustomers(): string {
        return "
            SELECT 
                rentals.id,
                CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name,
                rentals.start_time,
                rentals.end_time,
                rentals.total_cost
            FROM rentals
            JOIN customers ON rentals.customer_id = customers.id;
        ";
    }

    function sqlJoinRentalsBikes(): string {
        return "
            SELECT 
                rentals.id,
                bikes.model,
                bikes.type,
                bikes.hourly_rate,
                rentals.start_time,
                rentals.end_time,
                rentals.total_cost
            FROM rentals
            JOIN bikes ON rentals.bike_id = bikes.d;
        ";
    }

    function sqlTop3Bikes(): string {
        return "
            SELECT *
            FROM bikes
            ORDER BY hourly_rate DESC
            LIMIT 3;
        ";
    }

    function sqlMultiJoinRentals(): string {
        return "
            SELECT 
                rentals.id,
                CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name,
                bikes.model,
                bikes.type,
                bikes.hourly_rate,
                rentals.start_time,
                rentals.end_time,
                rentals.total_cost
            FROM rentals
            JOIN customers ON rentals.customer_id = customers.id
            JOIN bikes ON rentals.bike_id = bikes.id;
        ";
    }

    function sqlUpdateCloseRental(): string {
        return "
            UPDATE rentals
            SET end_time = NOW()
            WHERE id = 3;
        ";
    }

    function sqlUpdateBikeUnavailable(): string {
        return "
            UPDATE bikes
            SET available = 0
            WHERE id = 4;
        ";
    }

    function sqlCompletedRentals(): string {
        return "
            SELECT 
                bikes.model,
                bikes.hourly_rate,
                customers.first_name,
                customers.last_name,
                rentals.start_time,
                rentals.end_time
            FROM rentals
            JOIN bikes ON rentals.bike_id = bikes.id
            JOIN customers ON rentals.customer_id = customers.id
            WHERE rentals.end_time IS NOT NULL
            ORDER BY rentals.start_time;
        ";
    }
?>
