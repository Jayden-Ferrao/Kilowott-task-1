// Toggle for signup and login
$('#toggleFormBtn').on('click', function () {
    const $signUpForm = $('#signUpForm');
    const $loginForm = $('#loginForm');
    if ($signUpForm.hasClass('hidden')) {
        $signUpForm.removeClass('hidden');
        $loginForm.addClass('hidden');
        $(this).text('Already have an account? Login');
    } else {
        $signUpForm.addClass('hidden');
        $loginForm.removeClass('hidden');
        $(this).text("Don't have an account? Sign Up");
    }
});

// Toggle for eye-icon
$('.toggle-password-icon').on('click', function () {
    const $input = $(this).prev();
    if ($input.attr('type') === 'password') {
        $input.attr('type', 'text');
        $(this).removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    } else {
        $input.attr('type', 'password');
        $(this).removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    }
});

$('.toggle-confirm-password-icon').on('click', function () {
    const $input = $(this).prev();
    if ($input.attr('type') === 'password') {
        $input.attr('type', 'text');
        $(this).removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    } else {
        $input.attr('type', 'password');
        $(this).removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    }
});

// for uploading files
// const fileInput = document.getElementById('files');
// const fileList = document.getElementById('fileList');
// let filesData = [];

// fileInput.addEventListener('change', function () {
//     fileList.innerHTML = '';
//     filesData = Array.from(this.files);
//     filesData.forEach(file => {
//         const fileItem = createFileItem(file);
//         fileList.appendChild(fileItem);
//     });
// });

// function createFileItem(file) {
//     const fileItem = document.createElement('div');
//     fileItem.className = 'file-item';
//     fileItem.innerHTML = `
//         <span class="file-name">${file.name}</span>
//         <i class="bi bi-x-circle-fill text-red-500 remove-file cursor-pointer"></i>
//     `;
//     fileItem.querySelector('.remove-file').addEventListener('click', function () {
//         filesData = filesData.filter(f => f.name !== file.name);
//         fileItem.remove();
//         if (filesData.length === 0) {
//             document.getElementById('files').value = '';
//         }
//     });
//     return fileItem;
// }

// Validation for email & password
function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

function validatePassword(password) {
    const regex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return regex.test(password);
}

// Validation for sign up form
function validateSignUpForm() {
    const name = $('#name').val();
    const email = $('#email').val();
    const password = $('#password').val();
    const confirmPassword = $('#confirmPassword').val();
    const dob = $('#dob').val();
    const gender = $('input[name="gender"]:checked').val();
    const age = $('input[name="age"]:checked').val();

    const $emailError = $('#emailError');
    const $passwordError = $('#passwordError');
    const $confirmPasswordError = $('#confirmPasswordError');

    let valid = true;

    if (!validateEmail(email)) {
        $emailError.removeClass('hidden');
        valid = false;
    } else {
        $emailError.addClass('hidden');
    }

    if (!validatePassword(password)) {
        $passwordError.removeClass('hidden');
        valid = false;
    } else {
        $passwordError.addClass('hidden');
    }

    if (password !== confirmPassword) {
        $confirmPasswordError.removeClass('hidden');
        valid = false;
    } else {
        $confirmPasswordError.addClass('hidden');
    }

    if (valid) {
        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('confirmPassword', confirmPassword);
        formData.append('dob', dob);
        formData.append('gender', gender);
        formData.append('age', age);

        $.ajax({
            url: 'process_form.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                data = JSON.parse(data);
                if (data.success) {
                    alert('User registered successfully');
                    $('#toggleFormBtn').click(); // Switch to login form
                } else {
                    alert(data.message);
                }
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    return valid;
}

// Validate Login Form
function validateLoginForm() {
    const email = $('#loginEmail').val();
    const password = $('#loginPassword').val();

    const $emailError = $('#loginEmailError');
    const $passwordError = $('#loginPasswordError');

    let valid = true;

    if (!validateEmail(email)) {
        $emailError.removeClass('hidden');
        valid = false;
    } else {
        $emailError.addClass('hidden');
    }

    if (!validatePassword(password)) {
        $passwordError.removeClass('hidden');
        valid = false;
    } else {
        $passwordError.addClass('hidden');
    }

    if (valid) {
        const formData = new FormData();
        formData.append('loginEmail', email);
        formData.append('loginPassword', password);

        $.ajax({
            url: 'enter_form.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                data = JSON.parse(data);
                if (data.success) {
                    alert('Logged in successfully!');
                    window.location.href = 'dashboard.html';
                } else {
                    alert(data.message);
                }
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    return valid;
}

$('#signUpForm').on('submit', function (e) {
    e.preventDefault();
    validateSignUpForm();
});

$('#loginForm').on('submit', function (e) {
    e.preventDefault();
    validateLoginForm();
});