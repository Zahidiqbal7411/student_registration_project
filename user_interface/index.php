<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <style>
        @keyframes zoomIn {
            0% {
                transform: scale(2.0);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        #imagePreview img {
            animation: zoomIn 2s ease-in-out;
            /* Optional: add some transition for smoothness */
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        /* Optionally add a hover effect */
        #imagePreview img:hover {
            transform: scale(1.1);
            /* Slight zoom on hover */
        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex justify-content-center">
        <div class="form-container" id="form-container" style="width:1000px;">
            <h1 style="font-weight:bold;">Student Registration Form</h1>

            <!-- Form Submission to the same page -->
            <form id="registrationForm" method="post" action="">
                <!-- Student Name Field -->
                <div class="row mt-4">
                    <div class="col-md-6 form-group">
                        <label for="studentName">Student Name</label>
                        <input type="text" id="studentName" name="studentName" placeholder="Enter student name" required>
                    </div>

                    <!-- Father's Name Field -->
                    <div class="col-md-6 form-group">
                        <label for="fatherName">Father Name</label>
                        <input type="text" id="fatherName" name="fatherName" placeholder="Enter father's name" required>
                    </div>
                </div>

                <!-- Student and Father's CNIC Fields -->
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="studentCnic">Student CNIC</label>
                        <input type="text" id="studentCnic" name="studentCnic" placeholder="Enter student CNIC" required>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="fatherCnic">Father CNIC</label>
                        <input type="text" id="fatherCnic" name="fatherCnic" placeholder="Enter father's CNIC" required>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="studentContact">Student Contact</label>
                        <input type="tel" id="studentContact" name="studentContact" placeholder="Enter student's contact number">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="guardianContact">Guardian Contact</label>
                        <input type="tel" id="guardianContact" name="guardianContact" placeholder="Enter guardian's contact number">
                    </div>
                </div>

                Country and State Dropdown
                <?php
                require_once('incs/conn.php');
                $sql = "SELECT * FROM location_country";
                $result = $conn->query($sql);
                ?>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="country">Country</label>
                        <select id="country" name="country" required>
                            <option value="" disabled selected>Select Country</option>

                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option>" . $row['country_title'] . "</option>";
                                }
                            } else {
                                echo "<option value='' disabled>No countries available</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="state">State</label>
                        <select id="state" name="state">
                            <option value="" disabled selected>Select State</option>
                        </select>
                    </div>
                </div>

                <?php
                $conn->close();
                ?>

                <!-- City Dropdown -->
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="city">City</label>
                        <select id="city" name="city">
                            <option value="" disabled selected>Select City</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-center">
                    <button type="submit" class="submit-btn btn btn-primary w-50" name="student" value="std">Register</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Bootstrap JS (for full Bootstrap functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
