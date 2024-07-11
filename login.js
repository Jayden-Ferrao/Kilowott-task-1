$(document).ready(function() {
    // Toggle for signup and login
    $('#toggleFormBtn').click(function() {
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

    // Toggle for eye-icon (assuming you have .toggle-password-icon and .toggle-confirm-password-icon classes)
    $('.toggle-password-icon, .toggle-confirm-password-icon').click(function() {
        const input = $(this).prev();
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            $(this).removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
        } else {
            input.attr('type', 'password');
            $(this).removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
        }
    });

    // Validate Email
    function validateEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    // Validate Password
    function validatePassword(password) {
        const regex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        return regex.test(password);
    }

    // Validation for sign up form
    function validateSignUpForm() {
        const email = $('#email').val();
        const password = $('#password').val();
        const confirmPassword = $('#confirmPassword').val();
        const age = $('input[name="age"]:checked').val();

        const emailError = $('#emailError');
        const passwordError = $('#passwordError');
        const confirmPasswordError = $('#confirmPasswordError');
        const ageError = $('#ageError');

        let valid = true;

        if (!validateEmail(email)) {
            emailError.removeClass('hidden');
            valid = false;
        } else {
            emailError.addClass('hidden');
        }

        if (!validatePassword(password)) {
            passwordError.removeClass('hidden');
            valid = false;
        } else {
            passwordError.addClass('hidden');
        }

        if (password !== confirmPassword) {
            confirmPasswordError.removeClass('hidden');
            valid = false;
        } else {
            confirmPasswordError.addClass('hidden');
        }

        if (age !== 'yes') {
            ageError.removeClass('hidden');
            valid = false;
        } else {
            ageError.addClass('hidden');
        }

        if (valid) {
            // Simulate form submission (replace with actual form submission code)
            alert('Form submitted successfully!');
            // Redirect after submission
            window.location.href = 'login.html';
        }

        return valid;
    }

    // Validation for login form
    function validateLoginForm() {
        const email = $('#loginEmail').val();
        const password = $('#loginPassword').val();

        const emailError = $('#loginEmailError');
        const passwordError = $('#loginPasswordError');

        let valid = true;

        if (!validateEmail(email)) {
            emailError.removeClass('hidden');
            valid = false;
        } else {
            emailError.addClass('hidden');
        }

        if (!validatePassword(password)) {
            passwordError.removeClass('hidden');
            valid = false;
        } else {
            passwordError.addClass('hidden');
        }

        if (valid) {
            // Simulate login (replace with actual login code)
            alert('Logged in successfully!');
            // Redirect after login
            // window.location.href = 'dashboard.html';
        }

        return valid;
    }

    // Event listeners for form submission
    $('#signUpForm').submit(function(event) {
        event.preventDefault();
        validateSignUpForm();
    });

    $('#loginForm').submit(function(event) {
        event.preventDefault();
        validateLoginForm();
    });
});