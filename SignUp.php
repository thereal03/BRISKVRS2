<?php
if (isset($_POST['submit'])) {

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'dbbriskvrs');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Check if all required fields are filled
    if (empty($username) || empty($password) || empty($email) || empty($first_name) || empty($last_name) || empty($phone) || empty($address)) {
        echo "<script>alert('Please fill in all required fields')</script>";
        echo "<script>history.back()</script>";
        exit();
    }

    // Insert values into the database
    $sql = "INSERT INTO tbluser (username, password, email, first_name, last_name, phone, address) VALUES ('$username', '$password', '$email', '$first_name', '$last_name', '$phone', '$address')";

    if (mysqli_query($conn, $sql)) {
        $user_id = mysqli_insert_id($conn); // Get the user_id of the newly inserted row

        // Insert a new row into tblLogin_credential
        $sql = "INSERT INTO tblLogin_credential (user_id, username, password, email) VALUES ('$user_id', '$username', '$password', '$email')";
        mysqli_query($conn, $sql);

        mysqli_close($conn);
        header('Location: LogIn.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brisk - Sign Up</title>
    <link rel="stylesheet" href="css/styles2.css">
    <link rel="icon" type="image/ico" href="images/logo2.png">
</head>

<body>
    <div class="session">
        <div class="left" style="background-image: url('./images/banner.jpg');">
            <svg enable-background="new 0 0 300 302.5" version="1.1" viewBox="0 0 300 302.5" xml:space="preserve"
                xmlns="http://www.w3.org/2000/svg">
                <style>
                    .st01 {
                        fill: #fff;
                    }
                </style>
                <path class="st01"
                    d="m126 302.2c-2.3 0.7-5.7 0.2-7.7-1.2l-105-71.6c-2-1.3-3.7-4.4-3.9-6.7l-9.4-126.7c-0.2-2.4 1.1-5.6 2.8-7.2l93.2-86.4c1.7-1.6 5.1-2.6 7.4-2.3l125.6 18.9c2.3 0.4 5.2 2.3 6.4 4.4l63.5 110.1c1.2 2 1.4 5.5 0.6 7.7l-46.4 118.3c-0.9 2.2-3.4 4.6-5.7 5.3l-121.4 37.4zm63.4-102.7c2.3-0.7 4.8-3.1 5.7-5.3l19.9-50.8c0.9-2.2 0.6-5.7-0.6-7.7l-27.3-47.3c-1.2-2-4.1-4-6.4-4.4l-53.9-8c-2.3-0.4-5.7 0.7-7.4 2.3l-40 37.1c-1.7 1.6-3 4.9-2.8 7.2l4.1 54.4c0.2 2.4 1.9 5.4 3.9 6.7l45.1 30.8c2 1.3 5.4 1.9 7.7 1.2l52-16.2z" />
            </svg>
        </div>
        <form action="SignUp.php" method="post" class="log-in" autocomplete="off">
            <h4>We are <span>BRISK</span></h4>
            <p>Welcome aboard! Sign up for an account to view our reservation for our vehicle rental service:</p>
            <div class="floating-label">
                <input placeholder="Username" type="text" name="username" id="username" autocomplete="off" required>
                <label for="username">Username: </label>
            </div>
            <div class="floating-label">
                <input placeholder="Password" type="text" name="password" id="password" autocomplete="off" required>
                <label for="password">Password: </label>
            </div>
            <div class="floating-label">
                <input placeholder="Email" type="text" name="email" id="email" autocomplete="off" required>
                <label for="Email">Email: </label>
            </div>
            <div class="floating-label">
                <input placeholder="First Name" type="text" name="first_name" id="first_name" autocomplete="off"
                    required>
                <label for="first_name">First Name:</label>
            </div>
            <div class="floating-label">
                <input placeholder="Last Name" type="text" name="last_name" id="last_name" autocomplete="off" required>
                <label for="last_name">Last Name:</label>
            </div>
            <div class="floating-label">
                <input placeholder="Phone Number" type="text" name="phone" id="phone" autocomplete="off" required>
                <label for="phone">Phone Number:</label>
            </div>
            <div class="floating-label">
                <input placeholder="Address" type="text" name="address" ChatGPT id="address" autocomplete="off"
                    required>
                <label for="address">Address:</label>
            </div>
            <button type="submit" name="submit" class="sign-up">Sign Up</button>
            <a onclick="window.history.back()" class="back-button">Back</a>
            <p>Note: All fields are required.</p>

        </form>
    </div>
    <script>
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.querySelector('.eye');

        eyeIcon.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>
</body>

</html>