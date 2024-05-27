document.cookie = "exampleCookie=value; SameSite=None; Secure";

// smooth scroll
$(document).ready(function(){
	$(".nav-link").on('click', function(event) {

    	if (this.hash !== "") {

			event.preventDefault();

			var hash = this.hash;

			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 700, function(){
				window.location.hash = hash;
			});
      	} 
    });
});

$(document).ready(function() {
    $('#contactForm').submit(function(event) {
        // Prevent default form submission
        event.preventDefault();

        // Serialize form data
        var formData = $(this).serialize();

        // Submit form data using AJAX
        $.ajax({
            type: 'POST',
            url: 'message.php',
            data: formData,
            success: function(response) {
                // Parse JSON response
                var data = JSON.parse(response);

                // Check if the message was sent successfully
                if (data.status === 'success') {
                    // Display success message using SweetAlert
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Message sent successfully!",
                        showConfirmButton: false,
                        timer: 2500
                    });

                    // Reset the form
                    $('#contactForm')[0].reset();
                } else {
                    // Display error message using SweetAlert
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Failed to send message. Please try again later.",
                        showConfirmButton: true
                    });
                }
            },
            error: function() {
                // Display error message using SweetAlert
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "Failed to send message. Please try again later.",
                    showConfirmButton: true
                });
            }
        });
    });
});


