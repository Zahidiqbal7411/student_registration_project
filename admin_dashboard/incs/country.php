<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('conn.php'); // Ensure this file connects to the database

// Get the raw POST data from the request body
$data = json_decode(file_get_contents("php://input"), true);

// Check the request type (either 'insert' or 'fetch')
if (isset($data['request_type'])) {
    // Insert request
    if ($data['request_type'] == 'insert' && isset($data['country_title'])) {
        // Sanitize the country title input
        $country_title = mysqli_real_escape_string($conn, $data['country_title']);

        // Prepare the SQL query for insertion
        $query = "INSERT INTO `location_country` (country_title) VALUES (?)";

        // Initialize the prepared statement
        if ($stmt = mysqli_prepare($conn, $query)) {
            // Bind the parameter (country title)
            mysqli_stmt_bind_param($stmt, "s", $country_title);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // Return a success response with the newly inserted country
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data submitted successfully.',
                    'country' => [
                        'country_id' => mysqli_insert_id($conn),  // Get the ID of the newly inserted row
                        'country_title' => $country_title
                    ]
                ]);
            } else {
                // Return an error response in JSON format
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Error submitting data: ' . mysqli_stmt_error($stmt)
                ]);
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        } else {
            // Handle the error if the statement preparation failed
            echo json_encode([
                'status' => 'error',
                'message' => 'Error preparing statement: ' . mysqli_error($conn)
            ]);
        }
    }

    // Fetch request
    elseif ($data['request_type'] == 'fetch') {
        // SQL query to fetch country data
        $sql = "SELECT country_id, country_title FROM location_country";
        $result = $conn->query($sql);

        // Initialize an empty array to store the country data
        $countries = [];

        if ($result->num_rows > 0) {
            // Fetch each country and add to the array
            while ($row = $result->fetch_assoc()) {
                $countries[] = $row;
            }

            // Send the response as JSON
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'countries' => $countries]);
        } else {
            // No countries found
            echo json_encode(['status' => 'error', 'message' => 'No countries found.']);
        }

        // Close the connection
        $conn->close();
    }
} else {
    // Return an error response if the request type is not provided
    echo json_encode([
        'status' => 'error',
        'message' => 'Request type is missing.'
    ]);
}
?>
