<?php
include 'check_login.php';
?>
<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "dbbriskvrs");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted and if the reservation was updated successfully
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['updated'])) {
    $updated_reservation_id = $_POST['reservation_id'];
    $query = "SELECT car_id, destination, pickup_date, return_date FROM tblReservation WHERE reservation_id = $updated_reservation_id";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }
    $reservation = mysqli_fetch_assoc($result);
    $car_id = $reservation['car_id'];
    $destination = $reservation['destination'];
    $pickup_date = $reservation['pickup_date'];
    $return_date = $reservation['return_date'];
} else {
    $car_id = '';
    $destination = '';
    $pickup_date = '';
    $return_date = '';
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        // Get the reservation data from the form
        $car_id = $_POST['model'];
        $destination = $_POST['destination'];
        $pickup_date_string = $_POST['pickup_date'];
        $return_date_string = $_POST['return_date'];

        // Parse pickup date and return date strings to DateTime objects
        $pickup_date = DateTime::createFromFormat('Y-m-d\TH:i', $pickup_date_string);
        $return_date = DateTime::createFromFormat('Y-m-d\TH:i', $return_date_string);

        // Check if pickup date and return date are valid
        if (!$pickup_date || !$return_date) {
            die("Invalid date format: $pickup_date_string or $return_date_string");
        }

        // Calculate rental days and total cost
        $diff = $return_date->diff($pickup_date);
        $rental_days = $diff->days;

        if ($rental_days < 1) {
            // Set the total cost to zero or display an error message to the user
            $total_cost = 1500;
            // Or, you could display an error message to the user and redirect them back to the reservation form
            // header("Location: reservation_form.php?error=Invalid rental period");
            // exit();
        } else {
            $query = "SELECT daily_rate FROM tblCar WHERE car_id = $car_id";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $total_cost = $row['daily_rate'] * $rental_days;
        }

        // Get the reservation_id to be updated from the form
        $reservation_id = $_POST['reservation_id'];

        // Update the reservation data in the database
        $query = "UPDATE tblReservation SET car_id = $car_id, destination = '$destination', pickup_date = '$pickup_date_string', return_date = '$return_date_string', rental_days = $rental_days, total_cost = $total_cost WHERE reservation_id = $reservation_id";
        mysqli_query($conn, $query);

        // Redirect the user to the confirmation page
        header("Location: reservation_status.php");
        exit();
    }
}

// Get the car options from the database
$query = "SELECT car_id, brand, model, daily_rate FROM tblCar";
$result = mysqli_query($conn, $query);
$car_options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $car_options .= "<option value='" . $row['car_id'] . "'>" . $row['brand'] . " " . $row['model'] . " (Php" . $row['daily_rate'] . "/day)</option>";
}

// Get the reservation options for the logged in user from the database
$query = "SELECT reservation_id FROM tblReservation WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);
$reservation_options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $selected = "";
    if (isset($_POST['reservation_id']) && $_POST['reservation_id'] == $row['reservation_id']) {
        // Set the selected attribute if the reservation id matches the updated reservation id
        $selected = "selected";
    } else if (!isset($_POST['reservation_id']) && isset($_GET['reservation_id']) && $_GET['reservation_id'] == $row['reservation_id']) {
        // Set the selected attribute if the reservation id matches the reservation id passed through the URL
        $selected = "selected";
    }
    $reservation_options .= "<option value='" . $row['reservation_id'] . "' $selected>" . $row['reservation_id'] . "</option>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Brisk</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/styles5.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <link rel="icon" type="image/ico" href="images/logo2.png">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            font-size: 16px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        table th {
            font-weight: bold;
            text-align: center;
        }

        table tr:nth-child(even) {
            background-color: #fbf8f1;
        }

        table tr:hover {
            background-color: #ddd;
        }

        h1 {
            margin-top: 30px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 64px;
        }
    </style>
</head>
<!-- body -->

<body class="main-layout">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->
    <div id="mySidepanel" class="sidepanel">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="Home2.php">Home </a>
        <a href="#about">About</a>
        <a href="#rental">Vehicles </a>
        <a href="#luxury">Reservation</a>
        <a href="#testimonial">Testimonial</a>
        <a href="#contact">Contact</a>
    </div>
    <!-- header -->
    <header>
        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="logo">
                            <a href="Home2.php"><img class="logoimg" src="images/logo.png" alt="#" /></a>
                        </div>
                    </div>
                    <div class=" col-md-6 col-sm-6">
                        <ul class="conat_info d_none ">
                            <li><a href="#">(+63) 9191234567</a></li>
                            <li><a href="#">BriskVRS@gmail.com</a></li>
                            <?php if (isset($user)): ?>
                                <li><a href="#luxury">
                                        <?php echo $user['username']; ?>
                                    </a></li>
                                <li><a href="LogOut.php">Log Out</a></li>
                            <?php else: ?>
                                <li><a href="LogIn.php">Log In</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <div class="right_bottun">
                            <button class="openbtn" onclick="openNav()"><img src="images/menu_icon.png" alt="#" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="banner_main bottom_cross">
        <h1>Reservation Status</h1>
        <?php
        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "dbbriskvrs");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if the delete button is clicked
        if (isset($_POST['delete'])) {
            // Get the reservation ID from the form
            $reservation_id = $_POST['reservation_id'];

            // Delete the reservation from the database
            $query = "DELETE FROM tblReservation WHERE reservation_id = $reservation_id";
            mysqli_query($conn, $query);

            // Redirect the user to the reservation status page
            header("Location: reservation_status.php");
            exit();
        }

        // Get the user's reservations from the database
        $user_id = $_SESSION['user_id'];
        $query = "SELECT reservation_id, brand, model, destination, pickup_date, return_date, rental_days, total_cost, reservation_date
             FROM tblReservation
             JOIN tblCar ON tblReservation.car_id = tblCar.car_id
             WHERE user_id = $user_id
             ORDER BY reservation_date DESC";
        $result = mysqli_query($conn, $query);

        // Check if there are any reservations
        if (mysqli_num_rows($result) > 0) {
            // Output the reservations in a table
            echo "<div style='text-align: center;'><table border='1' style='margin: auto;'>
             <tr>
                <th>Reservation ID</th>
                <th>Car</th>
                <th>Destination</th>
                <th>Pickup Date</th>
                <th>Return Date</th>
                <th>Rental Days</th>
                <th>Total Cost</th>
                <th>Reservation Date</th>
                <th>Action</th>
             </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $reservation_id = $row['reservation_id'];
                $car = $row['brand'] . " " . $row['model'];
                $destination = $row['destination'];
                $pickup_date = date_format(date_create($row['pickup_date']), 'F j, Y, g:i A');
                $return_date = date_format(date_create($row['return_date']), 'F j, Y, g:i A');
                $rental_days = $row['rental_days'];
                $total_cost = $row['total_cost'];
                $reservation_date = date_format(date_create($row['reservation_date']), 'F j, Y, g:i A');
                echo "<tr>
                   <td>$reservation_id</td>
                   <td>$car</td>
                   <td>$destination</td>
                   <td>$pickup_date</td>
                   <td>$return_date</td>
                   <td>$rental_days</td>
                   <td>$total_cost</td>
                   <td>$reservation_date</td>
                   <td>
                       <form method='post'>
                           <input type='hidden' name='reservation_id' value='$reservation_id'>
                           <input type='submit' name='delete' value='Delete'>
                       </form>
                   </td>
                </tr>";
            }
            echo "</table></div>";
        } else {
            // Output a message if the user has no reservations
            echo "<h1 style='text-align:center;'>You have no reservations.</h1>";
        }
        // Close the database connection
        mysqli_close($conn);
        ?>
    </section>
    <div id="luxury" class="luxury bottom_cross6">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Update Reservation Status?</h2>
                    </div>
                </div>
            </div>
            <div class="row d_flex">
                <div class="col-lg-6 col-md-12">
                    <div class="form_date">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="select-box">
                                        <label for="select-box2" class="label select-box2"><span
                                                class="label-desc">Select Reservation ID</span></label>
                                        <select id="select-box2" class="select" name="reservation_id">
                                            <?php
                                            echo $reservation_options;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="select-box">
                                        <label for="select-box1" class="label select-box1"><span
                                                class="label-desc">Select your car type</span></label>
                                        <select id="select-box1" class="select" name="model">
                                            <?php
                                            echo $car_options;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pick_d">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <p>Destination</p>
                                    </div>
                                    <input class="form_luxury max_low" placeholder="Enter your destination" type="text"
                                        name="destination">
                                </div>
                                <div class="col-md-6">
                                    <label>Picking up date</label>
                                    <input class="form-control" id="datetimepicker1" placeholder="Pickup date"
                                        name="pickup_date" type="datetime-local" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Returning date</label>
                                    <input class="form-control" id="datetimepicker2" placeholder="Return date"
                                        name="return_date" type="datetime-local" required>
                                </div>
                                <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
                                <div class="col-md-12">
                                    <button type="submit" class="tinueCar" name="update">Update Reservation</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="ban_car">
                        <figure><img src="cars/Navara.png" alt="#" /></figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end luxury section -->
    <footer>
        <div class="footer bottom_cross1">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <a class="logo_bottom" href="Home2.php"><img src="images/logo.png" alt="#" /></a>
                        <p>Our dedication at Brisk Car Rental Services is to offer a dependable and hassle-free car
                            rental experience to our customers. We strive to ensure that every individual renting from
                            us feels appreciated and contented with the service provided, aligning with our mission.
                        </p>
                        <ul class="social_icon">
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <div class="fid_box">
                            <h3>Address </h3>
                            <ul class="location_icon">
                                <li>McArthur Highway, Angeles City Pampanga 2009 <br>
                                    <br>Contact Numbers
                                </li>
                                <li><a href="#">
                                        (+63) 9059876543<br> (+63) 9191234567</a>
                                </li>
                                <li><a href="#"> BriskVRS@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="fid_box">
                            <h3>Links </h3>
                            <ul class="link">
                                <li class="active"><a href="#">Home
                                    </a>
                                </li>
                                <li><a href="#">About
                                    </a>
                                </li>
                                <li><a href="#rental">
                                        Vehicle
                                    </a>
                                </li>
                                <li><a href="#luxury">
                                        Reservation
                                    </a>
                                </li>
                                <li><a href="#testimonial">
                                        Testimonial
                                    </a>
                                </li>
                                <li><a href="#Ccontact ">
                                        Contact </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="fid_box">
                            <h3>Newsletter</h3>
                            <form class="news_form">
                                <input class="letter_form" placeholder=" Your Name" type="text" name="Your Name">
                                <input class="letter_form" placeholder=" Email" type="text" name="Email">
                                <button class="sumbit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>© 2023 All Rights Reserved. Design by: SPRINTESC<a href="https://html.design/"></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script>
        function openNav() {
            document.getElementById("mySidepanel").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>
</body>

</html>