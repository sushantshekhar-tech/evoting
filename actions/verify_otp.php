<?php
session_start();
include('connect.php');
include('email.php');

// Define actions
$action = $_POST['action']; // "login" or "verify"

if ($action === 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $std = $_POST['std'];

    // Debugging: Log the input values
    error_log("Attempting login with Email: $email");

    // Query to check if the user exists with the provided email and password
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        // Debugging: Log any SQL errors
        error_log("SQL Error: " . mysqli_error($con));
        die("Database error. Please try again later.");
    }

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        // Fetch user data
        $data = mysqli_fetch_assoc($result);

        // Debugging: Log fetched data
        error_log("Fetched User Data: " . json_encode($data));

        // Store session data
        $_SESSION['id'] = $data['id'];
        $_SESSION['status'] = $data['status'];
        $_SESSION['data'] = $data;

        // Generate and send OTP
        $otp = rand(11111, 99999);
        send_otp($email, "PHP OTP LOGIN", $otp);

        // Update the user's OTP in the database
        $sql = "UPDATE users SET user_otp = '$otp' WHERE email = '$email'";
        $update_result = mysqli_query($con, $sql);

        if (!$update_result) {
            // Debugging: Log any SQL errors
            error_log("SQL Error on update: " . mysqli_error($con));
            die("Database error. Please try again later.");
        }

        // Redirect to OTP verification page
        echo '<script>
        alert("Please check your email for OTP and verify");
        window.location="../partials/validate_otp.php";
        </script>';
    } else {
        // Debugging: Log invalid credentials attempt
        error_log("Invalid credentials for Email: $email and Password: $password");

        echo '<script>
        alert("Invalid Credentials");
        window.location="../";
        </script>';
    }
} elseif ($action === 'verify') {
    $email = $_POST['email'];
    $otp = $_POST['otp'];

    // Debugging: Log the OTP verification attempt
    error_log("Verifying OTP for Email: $email");

    // Query to check if the OTP is correct
    $sql = "SELECT user_otp FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        // Debugging: Log any SQL errors
        error_log("SQL Error: " . mysqli_error($con));
        die("Database error. Please try again later.");
    }

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $stored_otp = $data['user_otp'];

        // Check if the provided OTP matches the stored OTP
        if ($otp == $stored_otp) {
            // OTP is correct
            // You can now proceed with logging in the user or redirecting them to the dashboard
            echo '<script>
            alert("OTP Verified Successfully");
            window.location="../partials/dashboard.php";
            </script>';
        } else {
            // OTP is incorrect
            echo '<script>
            alert("Invalid OTP. Please try again.");
            window.location="../partials/validate_otp.php";
            </script>';
        }
    } else {
        // No record found for the given email
        echo '<script>
        alert("Email not found.");
        window.location="../";
        </script>';
    }
} else {
    // Invalid action
    echo '<script>
    alert("Invalid action.");
    window.location="../";
    </script>';
}
?>
