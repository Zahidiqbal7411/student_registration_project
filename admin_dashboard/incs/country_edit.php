<?php
// Include database connection file
require_once('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the POSTed data
    $countryId = $_POST['id'];
    $countryName = $_POST['country_title'];
   

    // Sanitize input (for security)
    $countryId = intval($countryId);
    $countryName = htmlspecialchars($countryName);
  

    // Prepare and execute SQL update query
    $sql = "UPDATE countries SET name = ? WHERE country_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('si', $countryName,  $countryId);

        if ($stmt->execute()) {
            $response = ['status' => 'success', 'message' => 'Country updated successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Failed to update country'];
        }
        $stmt->close();
    } else {
        $response = ['status' => 'error', 'message' => 'Database error'];
    }

    // Close the database connection
    $conn->close();

    // Return the response as JSON
    echo json_encode($response);
}
?>




