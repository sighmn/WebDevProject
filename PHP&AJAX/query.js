$(document).ready(function() {
    // On form submission
    $('#myForm').on('submit', function(event) {
        event.preventDefault();  // Prevent traditional form submission

        var formData = $(this).serialize();  // Serialize form data

        // AJAX request to submit form data
        $.ajax({
            url: 'insert.php',  // PHP script to handle form submission
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#response').html(response); // Show response from PHP (success or error message)
                $('#myForm')[0].reset(); // Optionally reset the form after successful submission
            },
            error: function() {
                $('#response').html('There was an error processing the form.');
            }
        });
    });
});