<?php
session_set_cookie_params(0, '/', '', false, true);
session_start();
session_unset();
session_destroy();
echo "<script>
        alert('You have logged out.');
        window.location.href = 'login.html'; // Redirect to the login page
      </script>";
exit();
?>