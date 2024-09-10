//toggle for signup and login
document.getElementById('toggleFormBtn').addEventListener('click', function () {
    const signUpForm = document.getElementById('signUpForm');
    const loginForm = document.getElementById('loginForm');
    const backToHome = document.getElementById('backToHome');
    if (signUpForm.classList.contains('hidden')) {
        signUpForm.classList.remove('hidden');
        loginForm.classList.add('hidden');
        backToHome.classList.add('hidden');
        this.textContent = 'Already have an account? Login';
    } else {
        signUpForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
        backToHome.classList.remove('hidden'); 
        this.textContent = "Don't have an account? Sign Up";
    }
});

//toggle for eye-icon
document.querySelectorAll('.toggle-password-icon').forEach(icon => {
    icon.addEventListener('click', function () {
        const input = this.previousElementSibling;
        if (input.type === 'password') {
            input.type = 'text';
            this.classList.remove('bi-eye-slash-fill');
            this.classList.add('bi-eye-fill');
        } else {
            input.type = 'password';
            this.classList.remove('bi-eye-fill');
            this.classList.add('bi-eye-slash-fill');
        }
    });
});

document.querySelectorAll('.toggle-confirm-password-icon').forEach(icon => {
    icon.addEventListener('click', function () {
        const input = this.previousElementSibling;
        if (input.type === 'password') {
            input.type = 'text';
            this.classList.remove('bi-eye-slash-fill');
            this.classList.add('bi-eye-fill');
        } else {
            input.type = 'password';
            this.classList.remove('bi-eye-fill');
            this.classList.add('bi-eye-slash-fill');
        }
    });
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

// Validate Name
function validateName(name) {
    const regex = /^[a-zA-Z\s\-]+$/;
    return regex.test(name);
}

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

// Add image validation
function validateImage() {
    const imageInput = document.getElementById('profileImage');
    const imageError = document.getElementById('imageError');
    const file = imageInput.files[0];
    let valid = true;

    if (!file) {
        imageError.textContent = "Please upload a profile image.";
        imageError.classList.remove('hidden');
        valid = false;
    } else {
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        
        // Check if the file type is one of the allowed types
        if (!validTypes.includes(file.type)) {
            imageError.textContent = "Invalid file type. Please upload an image (JPEG, JPG, PNG, or GIF).";
            imageError.classList.remove('hidden');
            valid = false;
        } else if (file.size > 2 * 1024 * 1024) { // 2MB max size
            imageError.textContent = "File size exceeds 2MB. Please upload a smaller image.";
            imageError.classList.remove('hidden');
            valid = false;
        } else {
            imageError.classList.add('hidden');
        }
    }

    return valid;
}

// Validation for sign up form
function validateSignUpForm() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const dob = document.getElementById('dob').value;

    const nameError = document.getElementById('nameError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');
    const dobError = document.getElementById('dobError');

    let valid = true;

    if (!validateName(name)) {
        nameError.classList.remove('hidden');
        valid = false;
    } else {
        nameError.classList.add('hidden');
    }

    if (!validateEmail(email)) {
        emailError.classList.remove('hidden');
        valid = false;
    } else {
        emailError.classList.add('hidden');
    }

    if (!validatePassword(password)) {
        passwordError.classList.remove('hidden');
        valid = false;
    } else {
        passwordError.classList.add('hidden');
    }

    if (password !== confirmPassword) {
        confirmPasswordError.classList.remove('hidden');
        valid = false;
    } else {
        confirmPasswordError.classList.add('hidden');
    }

    if (!validateImage()) {
        valid = false;
    }

    if (!isValidAge(dob)) {
        dobError.classList.remove('hidden');
        valid = false;
    } else {
        dobError.classList.add('hidden');
    }

    if (valid) {
        // alert('Form submitted successfully!');
        // Redirect after submission
        window.location.href = 'login.html';
    }

    return valid;
}

// Validation for age 18+
function isValidAge(dob) {
    var dobDate = new Date(dob);
    var today = new Date();
    var age = today.getFullYear() - dobDate.getFullYear();
    var monthDifference = today.getMonth() - dobDate.getMonth();

    // Adjust age if the birth month hasn't occurred yet this year
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dobDate.getDate())) {
        age--;
    }

    return age >= 18;
}

// Validation for login form
function validateLoginForm() {
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;

    const emailError = document.getElementById('loginEmailError');
    const passwordError = document.getElementById('loginPasswordError');

    let valid = true;

    if (!validateEmail(email)) {
        emailError.classList.remove('hidden');
        valid = false;
    } else {
        emailError.classList.add('hidden');
    }

    if (!validatePassword(password)) {
        passwordError.classList.remove('hidden');
        valid = false;
    } else {
        passwordError.classList.add('hidden');
    }

    if (valid) {
        // alert('Logged in successfully!');
        // Redirect after login
        window.location.href = 'dashboard.php';
    }

    return valid;
}
