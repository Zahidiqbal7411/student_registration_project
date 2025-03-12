<link href="../css/country.css" rel="stylesheet">

<div class="container mt-5">
    <!-- Form Container -->
    <div class="form-container">
        <form action="javascript::void()" method="post" class="country_form" id="country_form">
            <!-- Form Heading -->
            <div class="form-heading text-center mb-4">Add Country</div>

            <!-- Country Name Input -->
            <label class="country-label" for="country_name">Country Name</label>
            <input type="text" class="country_name form-control" id="country_title" name="country_title" required placeholder="Enter country name">

            <!-- Submit Button -->
            <button type="button" class="btn-submit mt-3" id="countryBtn" name="submit" value="sub">Submit</button>
        </form>
    </div>

    <!-- Table Container -->
    <div class="table-container mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S no</th>
                    <th>Country Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="country_table_body">
                <!-- Example Row (This will be dynamically populated) -->
                <tr>
                    <td>1</td>
                    <td>Example Country</td>
                    <td><button class="btn btn-primary fw-10 w-10">Edit</button>
                    <button class="btn btn-danger">Delete</button>
                </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
