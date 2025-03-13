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
                console.log(data);
                // Handle the server's response
                if (data.status === 'success') {
                    $('#country_title').val(''); // Reset the form

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
$(document).on('click', '.delete-btn', function() {
    var countryId = $(this).data('id'); // Get the country_id from data-id attribute
    var row = $(this).closest('tr'); // Capture the row that contains the delete button

    console.log('Country ID:', countryId); // Debugging: Log countryId

    // Confirm the delete action
    if (confirm('Are you sure you want to delete this country?')) {
        // Perform the AJAX request
        $.ajax({
            url: 'delete_country.php', // Your backend script to handle the delete action
            type: 'POST',
            data: { country_id: countryId }, // Send the country_id to the server
            dataType: 'json', // Ensure the response is treated as JSON
            success: function(response) {
                console.log('Response:', response); // Debugging: Log the response from PHP

                if (response.success) {
                   
                    // Remove the row from the table if the deletion was successful
                    row.remove(); // Use the captured row reference to remove it from the table
                } else {
                    alert('Error deleting country: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + error);
            }
        });
    }
});
$(document).ready(function () {
    // When the Edit button is clicked
    $(document).on('click', '.edit-btn', function () {
        var $row = $(this).closest('tr'); // Get the row that contains the Edit button
        var countryId = $(this).data('id'); // Get the country ID from the button's data-id attribute
        var countryName = $row.find('td:nth-child(2)').text(); // Get the country name from the row's first cell (assuming it's the country name)
          console.log(countryName);
        // Populate the form fields with the current country details
        $('#country_title').val(countryName); // Set the country name into the form's input field
        // $('#country_form').data('country-id', countryId); // Store the country ID in the form for later use
           
        // Show the form to the user
        $('#country_form').show();
    });

    // When the form is submitted
    $('#country_form').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        var countryId = $(this).data('country-id'); // Get the country ID from the form
        var updatedName = $('#country_title').val(); // Get the updated country name from the input field

        // Send the updated data to the server via Ajax
        $.ajax({
            url: 'country_edit.php', // Replace with your actual URL endpoint
            method: 'POST',
            data: {
                id: countryId,
                name: updatedName
            },
            success: function (response) {
                if (response.success) {
                    console.log(response.success);
                    // Update the country name in the correct table row
                    $('#row-' + countryId).find('td:nth-child(2)').text(updatedName);

                    // Hide the form after saving the changes
                    $('#country_form').hide();
                } else {
                    alert('Error updating country name.');
                }
            },
            error: function () {
                alert('Error occurred while saving the data.');
            }
        });
    });
});
