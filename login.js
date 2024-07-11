$(document).ready(function () {
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

    // jQuery Validation for Login Form
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
        }
    });
});