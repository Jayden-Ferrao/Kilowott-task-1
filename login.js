$(document).ready(function () {
    // Toggle between Signup and Login forms
    $('#toggleFormBtn').on('click', function () {
        const signUpForm = $('#signUpForm');
        const loginForm = $('#loginForm');
        
        if (signUpForm.hasClass('hidden')) {
            signUpForm.removeClass('hidden');
            loginForm.addClass('hidden');
            $(this).text('Already have an account? Login');
        } else {
            signUpForm.addClass('hidden');
            loginForm.removeClass('hidden');
            $(this).text("Don't have an account? Sign Up");
        }
    });

    // Toggle for eye-icon
    $('.toggle-password-icon').on('click', function () {
        const input = $(this).prev('input');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            $(this).removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
        } else {
            input.attr('type', 'password');
            $(this).removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
        }
    });

    $('.toggle-confirm-password-icon').on('click', function () {
        const input = $(this).prev('input');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            $(this).removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
        } else {
            input.attr('type', 'password');
            $(this).removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
        }
    });

    // jQuery Validation for Signup Form
    $("#signUpForm").validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            confirmPassword: {
                required: true,
                equalTo: "#password"
            },
            dob: "required",
            gender: "required",
            age_confirmation: "required",
            terms: "required"
        },
        messages: {
            name: "Please enter your name",
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please enter a password",
                minlength: "Your password must be at least 8 characters long"
            },
            confirmPassword: {
                required: "Please confirm your password",
                equalTo: "Passwords do not match"
            },
            dob: "Please enter your date of birth",
            gender: "Please select your gender",
            age_confirmation: "Please confirm if you are 18+",
            terms: "You must agree to the terms and conditions"
        }
    });

    // jQuery Validation for Login Form with AJAX submission
    $("#loginForm").validate({
        rules: {
            loginEmail: {
                required: true,
                email: true
            },
            loginPassword: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            loginEmail: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            loginPassword: {
                required: "Please enter your password",
                minlength: "Your password must be at least 8 characters long"
            }
        },
        submitHandler: function (form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function (response) {
                    if (response.success) {
                        window.location.href = "dashboard.html";
                    } else {
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert("An error occurred: " + error);
                }
            });
        }
    });
});