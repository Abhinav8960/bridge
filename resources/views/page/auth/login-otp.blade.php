<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login OTP</title>
  <meta property="og:title" content="Skoodos Bridge Login OTP" />
  <meta property="og:url" content="http://206.189.137.82/skoodosbridge/webapp" />
  <meta content="Your Pathway To Finding The Best Competitive Exams Coaching" name="description">
  <meta content="Skoodos, Skoodos Bridge" name="keywords">
  <meta property="og:image"
    content="http://206.189.137.82/skoodosbridge/webapp/assets/img/homepage/homepage_banner_mobile.png" />


  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->


  <!-- Vendor CSS Files -->

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/responsive.css">

</head>
<body>

  <!-- ======= Top Navbar =========  -->
  <section class="top_navbar d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="top-social-link">
        <span>Follow us:</span>
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
        <a href=""><i class="bi bi-youtube"></i></a>
      </div>
      <div class="top_contact d-flex align-items-center">
        <a href="mailto:email1@skoodosbridge.com"><img src="/assets/skoodos/assets/img/homepage/mail.png" alt="">email1@skoodosbridge.com</a>
        <a href="tel:+91 999 999 9999"><img src="/assets/skoodos/assets/img/homepage/call.png" alt="">+91 999 999 9999</a>
      </div>
    </div>
  </section>

  <!-- ======= End Top Navbar =========  -->

   <!-- ======= Header ======= -->
   <header id="header" class="header fixed-top" style="background-color: rgb(255, 255, 255);">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="/assets/skoodos/assets/img/homepage/UpperBanner/Logo.png" alt="">
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.html">Home</a></li>
          <li><a class="nav-link scrollto" href="https://spherionsolutions.com/about-us.html" target="_blank">About</a></li>
          <li><a class="nav-link scrollto" href="explore_listing.html">Explore</a></li>
          <li><a class="nav-link scrollto" href="compare.html">Compare</a></li>
          <li class="dropdown"><a class="nav-link " href="#"><span>Exams</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a  href="entrance_exam.html">Entrance </a></li>
              <li><a href="government_exam.html">Government</a></li>
              <li><a href="foreign_language.html">Foreign</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#enroll">Enroll</a></li>
          <li><a class="nav-link scrollto" href="#blog">Blog</a></li>
          <li><a class="nav-link scrollto" href="faq.html">FAQ's</a></li>
          <li><a class="nav-link scrollto" href="contact.html">Contact</a></li>
          <!-- <a href="login.html"><img src="/assets/skoodos/assets/img/homepage/UpperBanner/login.png" alt=""></a> -->
          <li class="login-dd dropdown"><a  href="#"><img src="/assets/skoodos/assets/img/homepage/UpperBanner/Rounded Rectangle 1.png" alt=""></a>
            <ul>
              <li><a  href="login.html">Login </a></li>
              <li><a href="register.html">Register</a></li>
              <li><a href="profile.html">My Profile</a></li>
            </ul>
          </li>
        </ul>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->
    <!-- ======= Hero Section ======= -->
    <section class="hero categories-search">
      <div class="container">
        <div class="row justify-content-center">
          <div class="search_box d-flex align-items-center">
            <div  class="d-flex align-items-center form-select">
             <a href="explore_listing.html"> <img src="/assets/skoodos/assets/img/homepage/UpperBanner/location.png" alt="">
           <span>Near Me</span></a>
             </div>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search By Exam / Stream / Institute / Location">
              <a href="microsite.html" class="input-group-text py-2 px-4"> <i class="bi bi-search"></i> Find Institute</a>
            </div>
          </div>
        </div>
      </div>

    </section><!-- End Hero -->

  <main id="main">

    <!-- ------------------Login--------------------- -->

    <section class="login">
      <div class="container">
        <div class="login-page login-otp-contain mt-5 mb-5">
          <div class="login-left-box d-flex">
            <div class="login-left">
              <div class="inner_center">
                <h3>Welcome Back to <span>Skoodos Bridge!</span></h3>
                <p>A Connection Between Student & Institutes</p>
                <form method="get" class="login_form" data-group-name="digits" data-autosubmit="false"
                  autocomplete="off">
                  <div class="login_otp">
                    <h6>Login With OTP</h6>
                    <a href="javascript:void(0)" onclick="timer();">Send OTP</a>
                  </div>
                  <div class="login_input">
                    <input type="text" maxlength="10" class="form-control" id="mobile"
                      onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false"
                      placeholder="Mobile" required>
                  </div>
                  <div class="otp_input digit-group">
                    <input type="text" id="digit-1" name="digit-1" data-next="digit-2" />
                    <input type="text" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
                    <input type="text" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
                    <input type="text" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />
                    <input type="text" id="digit-5" name="digit-5" data-next="digit-6" data-previous="digit-4" />
                    <input type="text" id="digit-6" name="digit-6" data-previous="digit-5" />
                  </div>
                  <div class="login_forgot">
                    <p><a href="javascript:void(0)" onclick="timer();">Resend OTP</a><span id="countdowntimer">00:13
                      </span></p>
                    <a href="login.html">Login with Password</a>
                  </div>
                  <div class="login_buttons">
                    <a type="submit" class=" yellow-btn" href="index.html">Login</a>
                    <span class="text-muted">New User?</span> <a class="register_btn" href="register.html"> &nbsp;
                      Register</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="login-right-box ">
            <div class="login-right-bg text-center">
              <img src="/assets/skoodos/assets/img/login-banner.png" alt="">
              <h2>We are connect with <span>limitless Institutes</span> across India.</h2>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!--========= Footer ==========  -->

  <section id="footer">
    <div class="container">
      <div class="row pt-5">
        <div class="col-lg-3">
          <div class="footer_logo">
            <a href=""><img src="/assets/skoodos/assets/img/footer/Logo copy.png" alt=""></a>
          </div>
          <div class="footer_desc">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus similique
              quia exercitationem cumque placeat eaque temporibus numquam, dolorem quae earum nisi
              eveniet mollitia, quidem fuga laboriosam. Tempore, quo explicabo.</p>
          </div>
        </div>
        <div class="col-lg-3">
          <a href="">
            <h5>Entrance Exams</h5>
          </a>
          <ul>
            <li><a href="">Best Coaching Institutes for Managment</a></li>
            <li><a href="">Best Coaching Institutes for Engineering</a></li>
            <li><a href="">Best Coaching Institutes for Law</a></li>
            <li><a href="">Best Coaching Institutes for Pharmacy</a></li>
            <li><a href="">Best Coaching Institutes for Commerce</a></li>
            <li><a href="">Best Coaching Institutes for Science</a></li>
            <li><a href="">Best Coaching Institutes for Computers</a></li>
            <li><a href="">Best Coaching Institutes for Agriculture</a></li>
            <li><a href="">Best Coaching Institutes for Arts</a></li>
            <li><a href="">Best Coaching Institutes for Education</a></li>
            <li><a href="">Best Coaching Institutes for Medical</a></li>
            <li><a href="">Best Coaching Institutes for Hotel Managment</a></li>
            <li><a href="">Best Coaching Institutes for Architecture</a></li>
            <li><a href="">Best Coaching Institutes for Desgin</a></li>
          </ul>
        </div>
        <div class="col-lg-3">
          <a href="">
            <h5>Government Exams</h5>
          </a>
          <ul>
            <li><a href="">Best Coaching Institutes for Banking</a></li>
            <li><a href="">Best Coaching Institutes for Defence</a></li>
            <li><a href="">Best Coaching Institutes for Psu's</a></li>
            <li><a href="">Best Coaching Institutes for SSC</a></li>
            <li><a href="">Best Coaching Institutes for UPSC</a></li>
            <li><a href="">Best Coaching Institutes for State PSC</a></li>
            <li><a href="">Best Coaching Institutes for Teaching</a></li>
            <li><a href="">Best Coaching Institutes for Railways</a></li>
          </ul>
          <a href="">
            <h5>Foreign Languages</h5>
          </a>
          <ul>
            <li><a href="">Best Coaching Institutes for English</a></li>
            <li><a href="">Best Coaching Institutes for French</a></li>
            <li><a href="">Best Coaching Institutes for German</a></li>
            <li><a href="">Best Coaching Institutes for Russia</a></li>
            <li><a href="">Best Coaching Institutes for Chinese</a></li>
            <li><a href="">Best Coaching Institutes for Japanese</a></li>
          </ul>
        </div>
        <div class="col-lg-3">
          <div class=" mt-3">
            <a href="">
            <h5>Connect with Us</h5>
          </a>
            <ul>
              <li> <a href="mailto:email1@skoodosbridge.com"><img src="/assets/skoodos/assets/img/footer/mail.png" alt=""
                class="footer-contact-icon">
              <span>email1@skoodosbridge.com</span></a></li>
              <li><a href="mailto:email2@skoodosbridge.com"><img src="/assets/skoodos/assets/img/footer/mail.png" alt=""
                class="footer-contact-icon">
              <span>email2@skoodosbridge.com</span></a></li>
              <li> <a href="tel:+91 999 999 9999"> <img src="/assets/skoodos/assets/img/footer/call.png" alt="" class="footer-contact-icon">
                <span>+91 999 999 9999</span> </a></li>
                <li> <a href="tel:+91 888 888 8888"> <img src="/assets/skoodos/assets/img/footer/call.png" alt="" class="footer-contact-icon">
                  <span>+91 888 888 8888</span> </a></li>
            </ul>
            <div class="footer_follow">
              <p>Follow us:</p>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="facebook"><i class="bi bi-youtube"></i></a>
              <a href="#" class="facebook"><i class="bi bi-linkedin"></i></a>
            </div>
            <div class="app-store-links mt-4">
              <a href=""><img src="/assets/skoodos/assets/img/footer/appsstore.png" alt=""></a>
              <a href=""> <img src="/assets/skoodos/assets/img/footer/google_play.png" alt=""></a>
            </div>
            <div class="terms">
              <a href="">
                <p>Privacy Policy</p>
              </a>
              <p>|</p>
              <a href="">
                <p>Terms of Use</p>
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="footer_bottom text-center ">
      <p>&copy; Copyright Skoodos Bridge 2022, A Venture of Spherion Solutions Private Limited</p>
    </div>
  </section>
    <!-- End Footer -->

 <!-- --------Back To Top -->

 <a href="#" class="back-to-top d-flex align-items-center justify-content-center active"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <!-- ------------- OTP -------- -->

  <script>
    $('.digit-group').find('input').each(function () {
      $(this).attr('maxlength', 1);
      $(this).on('keyup', function (e) {
        var parent = $($(this).parent());

        if (e.keyCode === 8 || e.keyCode === 37) {
          var prev = parent.find('input#' + $(this).data('previous'));

          if (prev.length) {
            $(prev).select();
          }
        } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
          var next = parent.find('input#' + $(this).data('next'));

          if (next.length) {
            $(next).select();
          } else {
            if (parent.data('autosubmit')) {
              parent.submit();
            }
          }
        }
      });
    });
  </script>

  <!-- ------------- OTP Timer----------- -->

  <script>
    function timer() {
      var timeleft = 13;
      var downloadTimer = setInterval(function () {
        timeleft--;
        document.getElementById("countdowntimer").textContent = timeleft;
        if (timeleft <= 0)
          clearInterval(downloadTimer);
      }, 1000);
    }
  </script>

</body>

</html>
