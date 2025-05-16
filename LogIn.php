<?php
session_start();

if (isset($_POST['submit'])) {

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'dbbriskvrs');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username and password are correct
    $sql = "SELECT * FROM tblUser WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Login successful, retrieve user info
        $user = mysqli_fetch_assoc($result);

        // Store the user info to tblLogin_credential
        $user_id = $user['user_id'];
        $email = $user['email'];

        // Check if the user already has a row in tblLogin_credential
        $result = mysqli_query($conn, "SELECT * FROM tblLogin_credential WHERE username = '$username'");
        if (mysqli_num_rows($result) > 0) {
            // The user already has a row, update it
            $sql = "UPDATE tblLogin_credential SET password = '$password', email = '$email' WHERE username = '$username'";
        } else {
            // The user does not have a row, insert a new one
            $sql = "INSERT INTO tblLogin_credential (user_id, username, password, email) VALUES ('$user_id', '$username', '$password', '$email')";
        }
        mysqli_query($conn, $sql);

        $_SESSION['user_id'] = $user_id;

        // Retrieve user information from the database
        $result = mysqli_query($conn, "SELECT * FROM tbluser WHERE user_id = '$user_id'");
        $user = mysqli_fetch_assoc($result);
        mysqli_close($conn);

        // Redirect to Home2.php
        header('Location: Home2.php');
        exit;
    } else {
        // Login failed
        $error_message = "Invalid username or password";
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brisk - Log in</title>
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
        <form action="login.php" method="post" class="log-in" autocomplete="off">
            <h4>We are <span>BRISK</span></h4>
            <p>Welcome back! Log in to your account to view your reservation for our vehicle rental service:</p>
            <?php if (isset($error_message)) { ?>
                <p class="error">
                    <?php echo $error_message; ?>
                </p>
            <?php } ?>
            <div class="floating-label">
                <input placeholder="Username" type="text" name="username" id="username" autocomplete="off">
                <label for="username">Username: </label>
            </div>
            <div class="floating-label">
                <input placeholder="Password" type="password" name="password" id="password" autocomplete="off">
                <label for="password">Password: </label>
                <div class="icon">
                    <svg class="eye" viewBox="0 0 24 24">
                        <path fill="#000000"
                            d="M12,6c-3.1,0-5.9,1.8-7.2,4.5c-0.3,0.6-0.3,1.3,0,1.9C6.1,14.2,8.9,16,12,16s5.9-1.8,7.2-4.5c0.3-0.6,0.3-1.3,0-1.9C17.9,7.8,15.1,6,12,6z M12,13.5c-1.6,0-3-1.3-3-3s1.3-3,3-3s3,1.3,3,3S13.6,13.5,12,13.5z M12,7.5c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S13.1,7.5,12,7.5z">
                        </path>
                        <style>
                            .st0 {
                                fill: none;
                            }

                            .st1 {
                                fill: #010101;
                            }
                        </style>
                    </svg>
                </div>
            </div>
            <button type="submit" name="submit" class="log-in">Log in</button>
            <a href="signup.php" class="sign-up">Sign Up</a>
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