<?php 
require_once('conn.php');

// Check if the form is submitted with the correct button
if (isset($_POST['submit']) && $_POST['submit'] == 'std') {
    // Collecting form data
    $stName = $_POST['studentName'];
    $stFathername = $_POST['fatheName'];
    $stCnic = $_POST['studentCnic'];
    $stFatherCnic = $_POST['fatheCnic'];
    $stContact = $_POST['studentContact'];
    $stFatherContact = $_POST['fatherContact'];
    $stCountryName = $_POST['country'];
    $stStateName = $_POST['state'];
    $stCityName = $_POST['city'];

    // Prepare the SQL query using a prepared statement
    $query = "INSERT INTO student_form (s_name, s_fathername, s_cnic, f_cnic, s_contact, st_fcontact, st_country) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        // Bind parameters to the prepared statement
        $stmt->bind_param('sssssss', $stName, $stFathername, $stCnic, $stFatherCnic, $stContact, $stFatherContact, $stCountryName);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // If successful, show success alert
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    title: "Success!",
                    text: "Student information has been successfully submitted.",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            </script>';
        } else {
            // If the query failed, show an error alert
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    title: "Error!",
                    text: "There was an issue submitting the information. Please try again.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            </script>';
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // If preparing the statement failed
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Error!",
                text: "There was an error preparing the query. Please try again.",
                icon: "error",
                confirmButtonText: "OK"
            });
        </script>';
    }
}

// Close the database connection
$conn->close();
?>
