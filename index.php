<?php
include "config.php";
include 'assets/php/php_epm_genset.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>EPlan Mo</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/index.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.0.1/css/all.css">
</head>

<?php echo '<body class="page-top" style="background-image:url(data:image/jpeg;base64,'.base64_encode($gensetbackground).');background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">' ?>
<header id="header" class="d-flex align-items-center" style="background-color:maroon">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <span>
                <h1 class="logo" style="color:white;">EPLAN MO</h1>
            </span>
            <button class="navbar-toggler btn btn-light" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation" style="color: maroon !important">
                <span class="navbar-toggler-icon" style="color: white;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                </ul>
                <a class="nav-link" href="#hero" style="color:white">Home</a>
                <a class="nav-link" href="#featured-services" style="color:white">Services</a>
                <a class="nav-link" href="#" style="color:white">About</a>
                <a href="epm_login.php"><button class="btn btn-light my-2 my-sm-0">SIGN IN</button></a>
            </div>
        </nav>
    </div>
</header>

<section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
        <h1 style="margin-bottom:20px;">Welcome to <span style="color:maroon;">EPlan Mo</span></h1>
        <div class="d-flex">
            <a href="#about" class="btn-get-started scrollto">Get Started</a>
        </div>
    </div>
</section>

<main id="main">
    <section id="featured-services" class="featured-services">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon"><i class="fas fa-calendar"></i></div>
                        <h4 class="title"><a href="">SCHEDULING</a></h4>
                        <p class="description">Written from the ground up for schools, EPLAN Mo supports management of your time by sorting out whats need to be done earlier.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon"><i class="fas fa-tasks"></i></div>
                        <h4 class="title"><a href="">TASKS</a></h4>
                        <p class="description">Not just another todo list. Bespoke for schools, EPLAN MO knows you need to keep track of more than just homework.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon"><i class="fas fa-envelope"></i></div>
                        <h4 class="title"><a href="">Notifications</a></h4>
                        <p class="description">Get notified about incomplete tasks and upcoming classes and exams with sms notification.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon"><i class="fas fa-sync-alt"></i></div>
                        <h4 class="title"><a href="">SYNC</a></h4>
                        <p class="description">Cross platform awesomeness. Your data seamlessly syncs across all of your devices and is accessible anytime anywhere , just connect to any active wifi or data</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section id="about" class="about section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>About</h2>
                <h3>How it all started</h3>
                <p>E-Plan Mo started as a capstone project which is a requirement for the developer to finish their degree. They come up with this idea to help the students practice timely manner. They also experienced lack of time management and used it as one of the basis to develop this application.</p>
            </div>

            <div class="row">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                    <img src="assets/images/side.png" class="img-fluid" alt="" style="width:100%; height:100%">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <h3>Available on your devices</h3>
                    <p class="fst-italic">
                       Soon to be deployed on Google Play Store.
                    </p>
                    <ul>
                        <li>
                            <i class="fab fa-windows"></i>
                            <i class="fab fa-android"></i>
                            <i class="fab fa-chrome"></i>
                            <div>
                                <p></p>
                            </div>
                        </li>
                        <li>
                            <i class="fas fa-forward"></i>
                            <div>
                                <p> With our beautifully designed apps available on Mobile Devices, Windows 7,8,10 and 11, Windows Phone and the web, EPlan Mo works on all of your devices.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Contact</h2>
                <h3><span>Contact Us</span></h3>
                <p></p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-6">
                    <div class="info-box mb-4">
                        <i class="fas fa-map"></i>
                        <h3>Our Address</h3>
                        <p>Brgy. Bangyas Calauan Laguna</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box  mb-4">
                        <i class="fas fa-envelope"></i>
                        <h3>Email Us</h3>
                        <p>ginotoralba0031@gmail.com</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box  mb-4">
                        <i class="fas fa-phone"></i>
                        <h3>Call Us</h3>
                        <p>+63(9465354675)</p>
                    </div>
                </div>

            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">

                <div class="col-lg-6 ">
                    <iframe class="mb-4 mb-lg-0" src="https://maps.google.com/maps?q=14.178289738227248,%20121.31915135026692&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>s
                </div>

                <div class="col-lg-6">
                    <form action="" method="" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>