// Toggle for signup and login
document.getElementById('toggleFormBtn').addEventListener('click', function () {
    const signUpForm = document.getElementById('signUpForm');
    const loginForm = document.getElementById('loginForm');
    
    if (signUpForm.classList.contains('hidden')) {
        signUpForm.classList.remove('hidden');
        loginForm.classList.add('hidden');
        this.textContent = 'Already have an account? Login';
    } else {
        signUpForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
        this.textContent = "Don't have an account? Sign Up";
    }
});

//toogle for eye-icon
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

// Validation for email & password
function validateSignUpForm() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');
    // const fileError = document.getElementById('fileError');

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

    if (password !== confirmPassword) {
        confirmPasswordError.classList.remove('hidden');
        valid = false;
    } else {
        confirmPasswordError.classList.add('hidden');
    }

    // if (filesData.length === 0) {
    //     fileError.classList.remove('hidden');
    //     valid = false;
    // } else {
    //     fileError.classList.add('hidden');
    // }

    if (valid) {
        alert('Form submitted succesfully!');
        // Here you can submit the form data using fetch or any other method
    }

    return valid;
}
// Validate Login Form
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
        const formData = new FormData();
        formData.append('loginEmail', email);
        formData.append('loginPassword', password);

        fetch('enter_form.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Logged in successfully!');
                window.location.href = 'dashboard.html';
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    return valid;
}

// Event listeners for form submissions
document.getElementById('signUpForm').addEventListener('submit', function (e) {
    e.preventDefault();
    validateSignUpForm();
});

document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();
    validateLoginForm();
});