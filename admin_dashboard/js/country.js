$(document).ready(function() {
    // Function to fetch countries from the database
    function fetchCountries() {
        $.ajax({
            url: 'country.php',  // URL to the PHP file that fetches country data
            method: 'POST',  // POST request
            contentType: 'application/json',
            data: JSON.stringify({ request_type: 'fetch' }),  // Send the request type as 'fetch'
            dataType: 'json',  // Expecting JSON response
            success: function(data) {
                // Clear the table body first
                $('#country_table_body').empty();

                // Check if the response has a success status
                if (data.status === 'success') {
                    let countryRows = '';

                    // Loop through the countries array and populate table rows
                    data.countries.forEach(function(country, index) {
                        countryRows += 
                            `<tr>
                                <td>${index + 1}</td>
                                <td>${country.country_title}</td>
                                <td>
                                    <button class="btn btn-secondary edit-btn" data-id="${country.country_id}" data-name="${country.country_title}" >Edit</button>

                                    <button class="btn btn-danger delete-btn" data-id="${country.country_id}">Delete</button>
                                    
                                </td>
                            </tr>`;
                    });
                    const primary_btn = document.querySelectorAll('.btn-primary');
                    primary_btn.forEach(button => {
                        button.style.width = "";
                    });
                    
                    // Insert the populated rows into the table body
                    $('#country_table_body').html(countryRows);
                } else {
                    alert('No countries found.');
                }
            },
            error: function(xhr, status, error) {
                // Log any errors to the console
                console.error('Error:', error);
                alert("An error occurred while fetching countries.");
            }
        });
    }

    // Call the fetchCountries function when the page loads
    fetchCountries();
});



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
        const formData = { 
            request_type: 'insert',  // Indicate the request type as 'insert'
            country_title 
        };

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
                    $('#country_form')[0].reset(); // Reset the form

                    // Create a new row dynamically
                    const newRow = 
                        `<tr>
                            <td>${$('#country_table_body tr').length + 1}</td>
                            <td>${data.country.country_title}</td>
                            <td>
                                <button class="btn btn-secondary fw-10 w-10 edit-btn" data-id="${data.country.country_id}">Edit</button>
                                <button class="btn btn-danger delete-btn" data-id="${data.country.country_id}">Delete</button>
                            </td>
                        </tr>`;

                    // Insert the new row into the table
                    $('#country_table_body').append(newRow);

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
$(document).ready(function() {
    // When the "Edit" button is clicked
    $(document).on('click', '.edit-btn', function() {
        var countryId = $(this).data('id');
        var countryName = $(this).data('name');
        var countryCode = $(this).data('code');
        
        // Show a modal or a form for editing
        $('#editModal').modal('show');
        
        // Pre-fill the modal with the current data
        $('#countryId').val(countryId);
        $('#countryName').val(countryName);
        $('#countryCode').val(countryCode);
    });

    // When the form is submitted
    $('#editForm').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var countryId = $('#countryId').val();
        var countryName = $('#countryName').val();
        

        $.ajax({
            url: 'edit_country.php', // PHP script to handle the edit
            method: 'POST',
            data: {
                country_id: countryId,
                country_title: countryName,
               
            },
            success: function(response) {
                // Assuming the response is the success message
                if (response.status == 'success') {
                    alert('Country updated successfully');
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
                alert('There was an error processing your request.');
            }
        });
    });
});
