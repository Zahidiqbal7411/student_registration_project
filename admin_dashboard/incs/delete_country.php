<?php
require_once('conn.php');

// Check if country_id is provided in the POST request
if (isset($_POST['country_id'])) {
    $countryId = $_POST['country_id'];

    // Check if country_id is a valid integer to prevent SQL injection
    if (!filter_var($countryId, FILTER_VALIDATE_INT)) {
        echo json_encode(['success' => false, 'error' => 'Invalid country ID']);
        exit;
    }

    // Prepare the SQL query to delete the country
    $query = "DELETE FROM location_country WHERE country_id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($query)) {
        // Bind the parameters (country_id should be an integer)
        $stmt->bind_param("i", $countryId);

        // Execute the statement
        if ($stmt->execute()) {
            // Check if any row was affected (deleted)
            if ($stmt->affected_rows > 0) {
                // Success response
                echo json_encode(['success' => true]);
            } else {
                // If no rows were affected, the country_id might not exist
                echo json_encode(['success' => false, 'error' => 'Country not found']);
            }
        } else {
            // Error response if the deletion fails
            echo json_encode(['success' => false, 'error' => 'Error deleting the country']);
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Error response if the preparation fails
        echo json_encode(['success' => false, 'error' => 'Error preparing the query']);
    }

    // Close the connection
    $conn->close();
} else {
    // If country_id is not set in the POST data
    echo json_encode(['success' => false, 'error' => 'Country ID is missing']);
}
?>
