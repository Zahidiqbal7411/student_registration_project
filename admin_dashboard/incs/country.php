
<?php
require_once('conn.php'); // Ensure this file connects to the database

// Get the raw POST data from the request body
$data = json_decode(file_get_contents("php://input"), true); 

// Check if country_title is provided in the request
if (isset($data['country_title'])) {
    // Sanitize the country title input
    $country_title = mysqli_real_escape_string($conn, $data['country_title']);
   
    // Prepare the SQL query using a prepared statement
    $query = "INSERT INTO `location_country` (country_title) VALUES (?)";

    // Initialize the prepared statement
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind the parameter (country title)
        mysqli_stmt_bind_param($stmt, "s", $country_title);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Return a success response in JSON format
            echo json_encode([
                'status' => 'success',
                'message' => 'Data submitted successfully.'
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
        // Return an error response if the query preparation fails
        echo json_encode([
            'status' => 'error',
            'message' => 'Error preparing statement: ' . mysqli_error($conn)
        ]);
    }
} else {
    // Return an error response if country_title is not provided
    echo json_encode([
        'status' => 'error',
        'message' => 'Country title is missing.'
    ]);
}
?>


