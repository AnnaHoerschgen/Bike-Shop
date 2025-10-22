<?php
    function sqlAllCustomers() {
        return "SELECT * FROM customers ORDER BY last_name, first_name";
    }

    function sqlAvailableBikes() {
        return "
                SELECT 
                    bikes.model,
                    bikes.type,
                    bikes.hourly_rate,
                    bikes.available
                FROM bikes
                WHERE bikes.available = 1;
            ";
    }

    function sqlBikeRentals() {
        return "
                SELECT 
                    id,
                    customer_id,
                    bike_id,
                    start_time,
                    end_time,
                    total_cost
                FROM rentals
                ORDER BY start_time;
            ";
    }

    function sqlMorningRentals() {
        return "
                SELECT 
                    rentals.id AS rental_id,
                    bikes.model,
                    bikes.available,
                    CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name,
                    rentals.start_time,
                    rentals.total_cost
                FROM rentals
                JOIN bikes ON rentals.bike_id = bikes.id
                JOIN customers ON rentals.customer_id = customers.id
                WHERE rentals.end_time IS NULL;
            ";
    }

    function sqlTop3Bikes() {
        return "
            SELECT 
                id,
                model,
                type,
                hourly_rate,
                available
            FROM bikes
            ORDER BY hourly_rate DESC
            LIMIT 3;
        ";
    }

    function sqlOpenRentals() {
        return "
            SELECT 
                rentals.id AS rental_id,
                bikes.model,
                bikes.available,
                CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name,
                rentals.start_time,
                rentals.total_cost
            FROM rentals
            JOIN bikes ON rentals.bike_id = bikes.id
            JOIN customers ON rentals.customer_id = customers.id
            WHERE rentals.end_time IS NULL;
        ";
    }

    function sqlAllJoins() {
        return "
                SELECT 
                    bikes.model,
                    bikes.type,
                    bikes.hourly_rate,
                    bikes.available,
                    CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name,
                    rentals.start_time,
                    rentals.end_time,
                    rentals.total_cost
                FROM rentals
                JOIN bikes ON rentals.bike_id = bikes.id
                JOIN customers ON rentals.customer_id = customers.id
                ORDER BY rentals.start_time;
            ";
    }

    function sqlUpdateEndTime($rentalID)
    {
        return "
                UPDATE rentals
                SET end_time = NOW()
                WHERE id = " . intval($rentalID) . ";
            ";
    }

    function sqlUpdateBikeStatus($bikeID)
    {
        return "
                UPDATE bikes
                SET available = 0
                WHERE id = " . intval($bikeID) . ";
            ";
    }
?>