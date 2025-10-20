<?php
    function sqlAllCustomers()
    {
        return "SELECT * FROM customers ORDER BY last_name, first_name";
    }

    function sqlAvailableBikes()
    {
        return "
            SELECT 
                bikes.model,
                CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name,
                rentals.start_time,
                rentals.end_time
            FROM rentals
            JOIN bikes ON rentals.bike_id = bikes.id
            JOIN customers ON rentals.customer_id = customers.id;
        ";
    }

    function sqlBikeRentals()
    {
        return "
            SELECT * FROM rentals
            WHERE start_time < '12:00:00'
            ORDER BY start_time;
        ";
    }

    function sqlMorningRentals()
    {
        return "
            SELECT * FROM bikes
            ORDER BY hourly_rate DESC
            LIMIT 3;
        ";
    }

    function sqlTop3Bikes()
    {
        return "
            SELECT 
                rentals.id AS rental_id,
                bikes.model,
                CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name,
                rentals.start_time
            FROM rentals
            JOIN bikes ON rentals.bike_id = bikes.id
            JOIN customers ON rentals.customer_id = customers.id
            WHERE rentals.end_time IS NULL;
        ";
    }

    function sqlOpenRentals()
    {
        return "
            SELECT 
                rentals.id AS rental_id,
                bikes.model,
                CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name,
                rentals.start_time
            FROM rentals
            JOIN bikes ON rentals.bike_id = bikes.id
            JOIN customers ON rentals.customer_id = customers.id
            WHERE rentals.end_time IS NULL;
        ";
    }

    function sqlAllJoins()
    {
        return "
            SELECT 
                bikes.model,
                bikes.type,
                bikes.hourly_rate,
                CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name,
                rentals.start_time,
                rentals.end_time
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