<?php
$conn = mysqli_connect('localhost', 'root', '', 'contact_form') or die('connection failed');
if (isset($_POST['send'])) {

   $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
   $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $phone_number = $_POST['phone_number'];
   $message = mysqli_real_escape_string($conn, $_POST['message']);

   $insert = mysqli_query($conn, "INSERT INTO `form_submissions`(first_name, last_name, email, phone_number, message) VALUES('$first_name','$last_name','$email','$phone_number','$message')") or die('query failed');

   if ($insert) {
      mysqli_close($conn);
      header("Location: Home2.php");
      exit();
   } else {
      mysqli_close($conn);
      header("Location: Error.php");
      exit();
   }

}
mysqli_close($conn);
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

      /* Modal Styles */
      .modal {
         display: block;
         position: fixed;
         z-index: 10000;
         left: 0;
         top: 0;
         width: 100%;
         height: 100%;
         overflow: auto;
         background-color: rgba(0, 0, 0, 0.8);
         animation: fadeIn 0.3s ease-in;
      }

      .modal-content {
         background-color: #ffffff;
         margin: 5% auto;
         padding: 25px;
         border: none;
         border-radius: 15px;
         width: 90%;
         max-width: 550px;
         max-height: 85vh;
         overflow-y: auto;
         box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
         animation: slideIn 0.3s ease-out;
         position: relative;
      }

      .close-modal {
         color: #999;
         float: right;
         font-size: 24px;
         font-weight: bold;
         position: absolute;
         right: 15px;
         top: 10px;
         cursor: pointer;
         transition: color 0.3s ease;
         z-index: 1;
      }

      .close-modal:hover,
      .close-modal:focus {
         color: #333;
      }

      .modal-header {
         text-align: center;
         margin-bottom: 15px;
         padding-right: 30px;
      }

      .modal-header h2 {
         color: #ffc834;
         font-size: 24px;
         margin-bottom: 10px;
         font-family: 'Source Code Pro', monospace;
      }

      .modal-body {
         text-align: center;
         line-height: 1.5;
      }

      .modal-body p {
         color: #333;
         font-size: 14px;
         margin-bottom: 12px;
      }

      .modal-body .highlight {
         background-color: #fff3cd;
         border: 1px solid #ffeaa7;
         border-radius: 5px;
         padding: 12px;
         margin: 15px 0;
         font-weight: bold;
         color: #856404;
         font-size: 13px;
      }

      .modal-footer {
         text-align: center;
         margin-top: 20px;
      }

      .btn-understand {
         background-color: #ffc834;
         color: #333;
         padding: 10px 25px;
         border: none;
         border-radius: 8px;
         font-size: 14px;
         font-weight: bold;
         cursor: pointer;
         transition: all 0.3s ease;
         font-family: 'Source Code Pro', monospace;
      }

      .btn-understand:hover {
         background-color: #e6b42e;
         transform: translateY(-2px);
         box-shadow: 0 5px 15px rgba(255, 200, 52, 0.4);
      }

      .project-badge {
         background: linear-gradient(45deg, #ffc834, #ffdd59);
         color: #333;
         padding: 4px 12px;
         border-radius: 15px;
         font-size: 11px;
         font-weight: bold;
         display: inline-block;
         margin-bottom: 10px;
         letter-spacing: 1px;
         text-transform: uppercase;
      }

      /* Mobile responsiveness */
      @media (max-height: 600px) {
         .modal-content {
            margin: 2% auto;
            max-height: 95vh;
            padding: 20px;
         }

         .modal-header h2 {
            font-size: 20px;
         }

         .modal-body p {
            font-size: 13px;
            margin-bottom: 10px;
         }
      }
   </style>

</head>
<!-- body -->

<body class="main-layout">

   <!-- Project Disclaimer Modal -->
   <div id="projectModal" class="modal">
      <div class="modal-content">
         <span class="close-modal" onclick="closeModal()">&times;</span>
         <div class="modal-header">
            <div class="project-badge">🎓 Academic Project</div>
            <h2>Student Portfolio Showcase</h2>
         </div>
         <div class="modal-body">
            <p><strong>Welcome to BRISK Car Rental System!</strong></p>
            <p>This is an <strong>educational project</strong> created as part of our academic coursework and is hosted
               exclusively for <strong>digital portfolio demonstration purposes</strong>.</p>

            <div class="highlight">
               ⚠️ Please note: This is an early-stage student project with limited functionality and may contain bugs or
               incomplete features.
            </div>

            <p>This system was developed to showcase our learning progress in web development and database management.
               It represents our foundational understanding of PHP, MySQL, and web technologies.</p>

            <p><strong>Purpose:</strong> Academic demonstration and portfolio showcase only</p>
            <p><strong>Status:</strong> Educational project - not for commercial use</p>
         </div>
         <div class="modal-footer">
            <button class="btn-understand" onclick="closeModal()">I Understand - Continue to Demo</button>
         </div>
      </div>
   </div>

   <!-- loader  -->
   <div class="loader_bg">
      <div class="loader"><img src="images/loading.gif" alt="#" /></div>
   </div>
   <!-- end loader -->
   <div id="mySidepanel" class="sidepanel">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
      <a href="Home.php">Home </a>
      <a href="#about">About</a>
      <a href="#rental">Vehicles </a>
      <a href="#luxury">Reservation</a>
      <a href="#testimonial">Testimonial</a>
      <a href="#contact">Contact</a>
   </div>
   <!-- header -->
   <header>
      <!-- header inner -->
      <div class="header">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-4 col-sm-4">
                  <div class="logo">
                     <a href="Home.php"><img class="logoimg" src="images/logo.png" alt="#" /></a>
                  </div>
               </div>
               <div class=" col-md-6 col-sm-6">
                  <ul class="conat_info d_none ">
                     <li><a href="#">(+63) 9191234567</a></li>
                     <li><a href="#">BriskVRS@gmail.com</a></li>
                     <li><a href="Login.php">Log In</a></li>
                  </ul>
               </div>
               <div class="col-md-2 col-sm-2">
                  <div class="right_bottun">
                     <button class="openbtn" onclick="openNav()"><img src="images/menu_icon.png" alt="#" /> </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </header>
   <!-- end header inner -->
   <!-- end header -->
   <!-- banner -->
   <section class="banner_main bottom_cross">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-7">
               <div class="ban_car">
                  <figure><img src="cars/Strada.png" alt="#" /></figure>
               </div>
            </div>
            <div class="col-md-5">
               <div class="text-bg">
                  <h1 class="h1head">Brisk</h1>
                  <h1>Vehicle Rental Services</h1>
                  <span>Ride with ease, rent with Brisk</span>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end banner -->
   <!-- about section -->
   <div id="about" class="about ">
      <div class="container-fluid">
         <div class="row ">
            <div class="col-md-5">
               <div class="titlepage">
                  <h2>About Brisk VRS</h2>
                  <p> At Brisk Car Rental Services, we are committed to providing our customers with a reliable and
                     convenient car rental experience. Our mission is to make sure that every customer who rents from us
                     feels valued and satisfied with the service they receive.
                  </p>
                  <a class="read_more" href="About.php">Read More</a>
               </div>
            </div>
            <div class="col-md-7">
               <div class="about_right">
                  <figure><img src="cars/Fortuner.png" alt="#" /></figure>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end about section -->
   <!-- Reservation section -->
   <section id="rental" class="rental bottom_cross5">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Great Rental Offers For You</h2>
                  <p>Presenting you our rental vehicles that are safe, comfortable, and roadworthy.</p>
               </div>
            </div>
         </div>
      </div>
      <div id="rental1" class="carousel slide" data-ride="carousel">
         <ol class="carousel-indicators">
            <?php
            // connect to the database
            $conn = mysqli_connect('localhost', 'root', '', 'dbbriskvrs');
            // check connection
            if (!$conn) {
               die("Connection failed: " . mysqli_connect_error());
            }

            // retrieve data from the tblCar table
            $sql = "SELECT * FROM tblCar";
            $result = mysqli_query($conn, $sql);
            $num_rows = mysqli_num_rows($result);

            // generate indicators for each data row
            for ($i = 0; $i < $num_rows; $i++) {
               echo '<li data-target="#rental1" data-slide-to="' . $i . '"';
               if ($i == 0) {
                  echo ' class="active"';
               }
               echo '></li>';
            }
            ?>
         </ol>
         <div class="carousel-inner">
            <?php
            // reset the result pointer
            mysqli_data_seek($result, 0);

            // display data in each carousel item
            while ($row = mysqli_fetch_assoc($result)) {
               echo '<div class="carousel-item';
               if ($row['car_id'] == 1) {
                  echo ' active';
               }
               echo '">';
               echo '<div class="container">';
               echo '<div class="carousel-caption">';
               echo '<div class="row">';
               echo '<div class="col-md-12">';
               echo '<div class="ban_car">';
               $imageName = $row['model'] . '.png';
               echo '<figure><img src="cars/' . $imageName . '" alt="#"/></figure>';
               echo '<h3>' . $row['brand'] . ' ' . $row['model'] . '</h3>';
               echo '<p>Year: ' . $row['year'] . '</p>';
               echo '<p>Car Type: ' . $row['car_type'] . '</p>';
               echo '<p>Transmission: ' . $row['transmission'] . '</p>';
               echo '<p>Engine: ' . $row['engine'] . '</p>';
               echo '<p>Seat: ' . $row['seat'] . '</p>';
               echo '<h3>Price: ' . $row['daily_rate'] . '</h3>';
               echo '</div>';
               echo '</div>';
               echo '</div>';
               echo '</div>';
               echo '</div>';
               echo '</div>';
            }

            // close the database connection
            mysqli_close($conn);
            ?>
         </div>
         <a class="carousel-control-prev" href="#rental1" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
         </a>
         <a class="carousel-control-next" href="#rental1" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
         </a>
      </div>
   </section>
   <!-- end Reservation section -->
   <!-- luxury section -->
   <div id="luxury" class="luxury bottom_cross6">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Rent with Us!</h2>
               </div>
            </div>
         </div>
         <div class="row d_flex">
            <div class="col-lg-6 col-md-12">
               <div class="form_date">
                  <form method="post">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="select-box">
                              <label for="select-box1" class="label select-box1"><span class="label-desc">Select your
                                    car type</span> </label>
                              <select id="select-box1" class="select" name="car_type">
                                 <?php echo $options; ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="pick_d">
                              <i class="fa fa-map-marker" aria-hidden="true"></i>
                              <p>Destination</p>
                           </div>
                           <input class="form_luxury max_low" placeholder="Enter your city airport" type="type"
                              name="Enter your city airport">
                        </div>
                        <div class="col-md-6">
                           <label>Picking up date</label>
                           <input class="form_luxury max_wi" placeholder="Enter your city airport" type="datetime-local"
                              name="pickup_date">
                           <div class="cale"><img src="images/calander.png" alt="#" /></div>
                        </div>
                        <div class="col-md-6">
                           <label>Dropping off date</label>
                           <input class="form_luxury max_wi" placeholder="Enter your city airport" type="datetime-local"
                              name="return_date">
                           <div class="cale"><img type="date" src="images/calander.png" alt="#" /></div>
                        </div>
                        <div class="col-md-12">
                           <input type="button" class="tinueCar" onclick="location.href='LogIn.php'" name="submit"
                              value="Continue Car Reservation">
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="col-lg-6 col-md-12">
               <div class="ban_car">
                  <figure><img src="cars/Terra.png" alt="#" /></figure>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end luxury section -->
   <!-- testimonial section -->
   <div id="testimonial" class="testimonial bottom_cross bottom_cross2">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Testimonials</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div id="myCarousel" class="carousel slide testimonial_Carousel " data-ride="carousel">
                  <ol class="carousel-indicators">
                     <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                     <li data-target="#myCarousel" data-slide-to="1"></li>
                     <li data-target="#myCarousel" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                     <div class="carousel-item active">
                        <div class="container">
                           <div class="carousel-caption ">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="testimonial_box">
                                       <figure><img class="testi_img"
                                             src="https://img.freepik.com/free-photo/cheerful-man-pointing-finger-left-advertise-product_176420-18862.jpg?w=1380&t=st=1682285962~exp=1682286562~hmac=7ba03b50b7e9b598dd328b2bda0a495390efd56283e28a09ed51f5b26342b57e"
                                             alt="#" /></figure>
                                       <h3>Sebastian Cruz <br><span class="kisu">Rental</span></h3>
                                       <p>I rented a car from Brisk Vehicle Rental Services for a weekend trip and I
                                          couldn't be happier with the experience. The staff was friendly and helpful,
                                          and the car was in excellent condition. I highly recommend Brisk for anyone in
                                          need of a reliable and convenient car rental service.</p>
                                       <i><img src="images/test.png" alt="#" /></i>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                        <div class="container">
                           <div class="carousel-caption">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="testimonial_box">
                                       <figure><img class="testi_img"
                                             src="https://img.freepik.com/free-photo/young-woman-yellow-warm-sweater-with-megaphone-speaker-screaming-left-pointing-index-finger_343596-7143.jpg?w=1380&t=st=1682285896~exp=1682286496~hmac=3dc7c9c8a4b34e21c57081acd17ed2855f9ea3d9d46a035e975ec0ba8933d5c4"
                                             alt="#" /></figure>
                                       <h3>Elise Bautista <br><span class="kisu">Rental</span></h3>
                                       <p>As a frequent traveler, I've rented cars from many different rental companies,
                                          but none compare to Brisk Vehicle Rental Services. Their prices are
                                          competitive and their service is top-notch. I appreciate their attention to
                                          detail and their commitment to making sure their customers are satisfied.</p>
                                       <i><img src="images/test.png" alt="#" /></i>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                        <div class="container">
                           <div class="carousel-caption">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="full cross_layout">
                                       <div class="testimonial_box">
                                          <figure><img src="images/our.png" alt="#" /></figure>
                                          <h3>John Paul Dela Cruz <br><span class="kisu">Rental</span></h3>
                                          <p>I recently rented a car from Brisk Vehicle Rental Services for a business
                                             trip, and I was impressed by the quality of their vehicles and the
                                             professionalism of their staff. They made the rental process easy and
                                             stress-free, and I will definitely be using their services again in the
                                             future.</p>
                                          <i><img src="images/test.png" alt="#" /></i>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                     <i class='fa fa-angle-left'></i>
                  </a>
                  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                     <i class='fa fa-angle-right'></i>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end testimonial section -->
   <!-- contact section -->
   <div id="contact" class="contact">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Contact Us !</h2>
               </div>
            </div>
         </div>
      </div>
      <div class="con_bg">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-8 offset-md-2">
                  <form id="request" class="main_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                     <div class="row">
                        <div class="col-md-6">
                           <input class="contactus" placeholder="First Name" type="text" name="first_name" required>
                        </div>
                        <div class="col-md-6">
                           <input class="contactus" placeholder="Last Name" type="text" name="last_name" required>
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Email" type="email" name="email" required>
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Phone Number" type="tel" name="phone_number" required>
                        </div>
                        <div class="col-md-12">
                           <input class="contactusmess" placeholder="Message" type="text" name="message">
                        </div>
                        <div class="col-md-12">
                           <button class="send_btn" type="submit" name="send">Send</button>
                        </div>
                     </div>
                  </form>
                  <?php
                  if (isset($message)) {
                     if (is_array($message) || is_object($message)) {
                        foreach ($message as $msg) {
                           echo '<p class="message">' . $msg . '</p>';
                        }
                     } else {
                        echo '<p class="message">' . $message . '</p>';
                     }
                  }
                  ?>
               </div>
               <div class="col-md-12 padding_right2">
                  <div class="map-responsive">
                     <!-- <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Eiffel+Tower+Paris+France" width="600" height="700" frameborder="0" style="border:0; width: 100%;" allowfullscreen></iframe> -->
                     <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1925.8216469485708!2d120.59702104845617!3d15.122975676288679!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396f1341679feed%3A0x9f9b1d5f7b0405ff!2sMacArthur%20Hwy%2C%20Angeles%2C%20Pampanga!5e0!3m2!1sen!2sph!4v1682234270061!5m2!1sen!2sph"
                        width="600" height="700" frameborder="0" style="border:0; width: 100%;"
                        allowfullscreen></iframe>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end contact section -->
   <!--  footer -->
   <footer>
      <div class="footer bottom_cross1">
         <div class="container">
            <div class="row">
               <div class="col-md-3">
                  <a class="logo_bottom" href="Home.php"><img src="images/logo.png" alt="#" /></a>
                  <p>Our dedication at Brisk Car Rental Services is to offer a dependable and hassle-free car rental
                     experience to our customers. We strive to ensure that every individual renting from us feels
                     appreciated and contented with the service provided, aligning with our mission. </p>
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
   <!-- sidebar -->zz
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>
   <script>
      function openNav() {
         document.getElementById("mySidepanel").style.width = "250px";
      }

      function closeNav() {
         document.getElementById("mySidepanel").style.width = "0";
      }

      function closeModal() {
         document.getElementById("projectModal").style.display = "none";
         // Store in localStorage so modal doesn't show again in the same session
         localStorage.setItem('modalShown', 'true');
      }

      // Check if modal was already shown in this session
      window.onload = function () {
         // Always show modal - comment out the storage check
         document.getElementById("projectModal").style.display = "block";
      }

      // Close modal when clicking outside of it
      window.onclick = function (event) {
         var modal = document.getElementById("projectModal");
         if (event.target == modal) {
            closeModal();
         }
      }
   </script>
   <script>
      function redirectToLogin() {
         window.location.href = "LogIn.php";
         return false;
      }
   </script>
</body>

</html>