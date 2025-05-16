<?php
include 'check_login.php';
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
      <a href="Home.php">Home </a>
      <a href="#about">About</a>
      <a href="#rental">Rental </a>
      <a href="#luxury">Luxury</a>
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
      <h1 class="abouthead">About Us</h1>
   </section>
   <section class="py-5 bg-light" id="scroll-target">
      <div class="container px-5 my-5">
         <div class="row gx-5 align-items-center">
            <div class="col-lg-6"><img src="images/LogoGen.png" alt="Trulli" width="500" height="333"></div>
            <div class="col-lg-6">
               <h2 class="fw-bolder">Our founding</h2>
               <p class="lead fw-normal text-muted mb-0">Brisk Car Rental was founded in 2022 by car enthusiast Kenji
                  Jaculbia with the mission to provide high-quality rental cars at affordable prices. Kenji recognized
                  that many car rental companies were overcharging customers and renting poorly maintained vehicles,
                  resulting in dissatisfied customers. In response to this, Brisk Car Rental was launched with a focus
                  on delivering reliable, well-maintained vehicles with exceptional customer service. Despite starting
                  with a small fleet of cars, the company has steadily grown over the years by expanding its fleet and
                  opening new rental locations nationwide. Today, Brisk Car Rental is a leading player in the industry
                  known for its reputation for quality, reliability, and affordability. The company plans to continue
                  expanding its operations and introducing new services and technologies to provide its customers with
                  an even better rental experience.</p>
            </div>
         </div>
      </div>
   </section>
   <!-- About section two-->
   <section class="py-5">
      <div class="container px-5 my-5">
         <div class="row gx-5 align-items-center">
            <div class="col-lg-6 order-first order-lg-last"><img src="images/LogoGen2.png" alt="Trulli" width="500"
                  height="333"></div>
            <div class="col-lg-6">
               <h2 class="fw-bolder">Mission &amp; Vision</h2>
               <p class="lead fw-normal text-muted mb-0">Our mission at Brisk Vehicle Rental Services is to help people
                  go places! We want to provide safe and comfortable cars for families, friends, and anyone who needs a
                  ride. Our goal is to make it easy and affordable for everyone to explore new places and create happy
                  memories together. <br><br>
                  Our vision for Brisk Vehicle Rental Services is to be the best car rental company ever! We want
                  to be known for our friendly service, clean cars, and fair prices. We dream of a world where everyone
                  has the freedom to travel and experience new things. With Brisk, you'll always be on the go!
               </p>
            </div>
         </div>
      </div>
   </section>
   <!-- Team members section-->
   <section class="py-5 bg-light">
      <div class="container px-5 my-5">
         <div class="text-center">
            <h2 class="fw-bolder">Our team</h2>
            <p class="lead fw-normal text-muted mb-5">Dedicated to providing quality reservation services to its customers.</p>
         </div>
         <div class="row gx-5 row-cols-1 row-cols-sm-2 row-cols-xl-4 justify-content-center">
            <div class="col mb-5 mb-5 mb-xl-0">
               <div class="text-center">
                  <img class="img-fluid rounded-circle mb-4 px-4" src="icon/P1.jpg"
                     alt="..." />
                  <h5 class="fw-bolder">Kenji Jaculbia</h5>
                  <div class="fst-italic text-muted">Project Manager</div>
               </div>
            </div>
            <div class="col mb-5 mb-5 mb-xl-0">
               <div class="text-center">
                  <img class="img-fluid rounded-circle mb-4 px-4" src="icon/P2.jpg"
                     alt="..." />
                  <h5 class="fw-bolder">Daryll Medina</h5>
                  <div class="fst-italic text-muted">Web Developer</div>
               </div>
            </div>
            <div class="col mb-5 mb-5 mb-sm-0">
               <div class="text-center">
                  <img class="img-fluid rounded-circle mb-4 px-4" src="icon/P4.jpg"
                     alt="..." />
                  <h5 class="fw-bolder">Charmagne Maniago</h5>
                  <div class="fst-italic text-muted">Web Designer</div>
               </div>
            </div>
            <div class="col mb-5">
               <div class="text-center">
                  <img class="img-fluid rounded-circle mb-4 px-4" src="icon/P3.jpg"
                     alt="..." />
                  <h5 class="fw-bolder">Miguel Enriquez</h5>
                  <div class="fst-italic text-muted">Content Manager</div>
               </div>
            </div>
         </div>
      </div>
   </section>
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
                              Rental
                           </a>
                        </li>
                        <li><a href="#luxury">
                              Luxury
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
                     <p>© 2023 All Rights Reserved. Design by<a href="https://html.design/"></a></p>
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