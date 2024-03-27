<?php
$selectedSociety = ''; // Initialize $selectedSociety to avoid the warning
if (isset($_GET['society'])) {
    $selectedSociety = $_GET['society'];
    // Now you can use $selectedSociety in your PHP code
}
?>

<?php
include './conn.php';

// Query the database to fetch the logo based on the society name
$sql = "SELECT society_logo FROM society WHERE society_name = '$selectedSociety'";
$result = mysqli_query($conn, $sql);

// Check if the query returned any result
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $logo_url = $row['society_logo']; // Adjust column name here
} else {
    // If no logo found for the society, you can provide a default logo
    $logo_url = isset($_SESSION["logoPath"]) ? $_SESSION["logoPath"] : "./img/default_logo.png"; // Change this to your default 
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Society Management Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    <style>
        .logo {
            background-blend-mode: color-burn;
        }

        /* Navigation Bar */
        .site-navbar {

            position: fixed;
            top: 0;
            width: 100%;
            z-index: 9999;
        }

        .site-navbar .site-logo a {
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .site-navbar .site-menu {
            margin: 0;
            padding: 0;
            list-style: none;
            text-align: right;
        }

        .site-navbar .site-menu li {
            display: inline-block;
            margin-left: 30px;
        }

        .site-navbar .site-menu li a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .site-navbar .site-menu li a {
            position: relative;
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .site-navbar .site-menu li a::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background-color: #00a5fd;
            border-radius: 30px;
            z-index: -1;
            opacity: 0;
            transition: .3s all ease;
        }

        .site-navbar .site-menu li a:hover::before {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.4);
            /* Increase the scale to expand the background */
        }

        .logo-container {
            position: relative;
            display: inline-block;
        }

        .site-navbar.navbar-scrolled {
            background-color: black;
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <header class="site-navbar" role="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-11 col-xl-2">
                    <div class="logo-container" style="margin-top: 10px; padding-bottom:30px">
                        <a href="./index.php">
                            <img class="logo mt-2" src="<?php echo $logo_url; ?>" alt="logo" height="50px" width="auto">
                        </a>
                    </div>
                </div>
                <div class=" col-12 col-md-10 d-none d-xl-block">
                    <nav class="site-navigation position-relative text-right" role="navigation">
                        <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                            <li class="active"><a href="./index.php"><span>Home</span></a></li>
                            <li><a href="#" onclick="scrollToTestimonials()"><span>About us</span></a></li>
                            <li><a href="#" onclick="scrollToServices()"><span>Services</span></a></li>
                            <li><a href="#" onclick="scrollToFooter()"><span>Contact us</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section with Transparent Background -->
    <div class="hero" style="background-image: url('images/hero_1.jpg');">
        <!-- Add content for hero section if needed -->
    </div>

    <!-- jQuery -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            var nav = $('.site-navbar');
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    nav.addClass("navbar-scrolled");
                } else {
                    nav.removeClass("navbar-scrolled");
                }
            });
        });
    </script>
    <script>
        function scrollToServices() {
            // Get the offset position of the services-container section
            var servicesContainer = document.getElementById("services-container");
            var offsetTop = servicesContainer.offsetTop;

            // Scroll to the services-container section with smooth behavior
            window.scrollTo({
                top: offsetTop,
                behavior: "smooth"
            });
        }

        function scrollToTestimonials() {
            // Get the offset position of the services-container section
            var testimonials = document.getElementById("testimonials");
            var offsetTop = testimonials.offsetTop;

            // Scroll to the services-container section with smooth behavior
            window.scrollTo({
                top: offsetTop,
                behavior: "smooth"
            });
        }

        function scrollToFooter() {
            // Get the offset position of the services-container section
            var footer = document.getElementById("footer");
            var offsetTop = footer.offsetTop;

            // Scroll to the services-container section with smooth behavior
            window.scrollTo({
                top: offsetTop,
                behavior: "smooth"
            });
        }
    </script>
</body>

</html>