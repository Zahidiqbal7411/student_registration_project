$(document).ready(function() {
    $('#countryBtn').on('click', function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        // Get the country title value
        const country_title = $('#country_title').val().trim();

        // Check if the country title is not empty
        if (!country_title) {
            alert("Country name cannot be empty!");
            return;
        }

        // Log for debugging
        console.log(country_title);

        // Prepare the data to send as JSON
        const formData = { country_title };

        // Send data using jQuery's ajax
        $.ajax({
            url: 'country.php',  // URL of the PHP script
            method: 'POST',  // POST request
            contentType: 'application/json',  // Set content type to JSON
            data: JSON.stringify(formData),  // Send the form data as JSON
            dataType: 'json',  // Expect JSON response from the server
            success: function(data) {
                // Handle the server's response
                if (data.status === 'success') {
                    // Display success message
                    $('#country_form')[0].reset(); // Reset the form
                } else {
                    alert("Error: " + data.message); // Display error message
                }
            },
            error: function(xhr, status, error) {
                // Log errors if any occur
                console.error('Error:', error);
                alert("An error occurred. Please try again.");
            }
        });
    });
});
