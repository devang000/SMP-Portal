<?php
session_start();
include './conn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if society details are submitted
    if (isset($_POST["societyName"]) && isset($_POST["societyAddress"]) && isset($_POST["city"]) && isset($_POST["pincode"])) {
        // Insert society data into the database
        $sql = "INSERT INTO society (society_Name, society_address, society_city, society_pincode, society_logo) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind parameters and execute the statement
            mysqli_stmt_bind_param($stmt, "sssis", $societyName, $societyAddress, $city, $pincode, $logoPath);
            // Set values for parameters
            $societyName = $_POST["societyName"];
            $societyAddress = $_POST["societyAddress"];
            $city = $_POST["city"];
            $pincode = $_POST["pincode"];
            $logoPath = ""; // Initialize logoPath

            // Check if logo is uploaded
            if (!empty($_FILES["logoInput"]["name"])) {
                $logoName = basename($_FILES["logoInput"]["name"]);
                $logoTargetPath = "./uploaded_img/" . $logoName;
                $logoType = strtolower(pathinfo($logoTargetPath, PATHINFO_EXTENSION));

                // Allow certain file formats
                $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
                if (in_array($logoType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES["logoInput"]["tmp_name"], $logoTargetPath)) {
                        $logoPath = $logoTargetPath;
                    } else {
                        echo "There was an error uploading your logo.";
                        exit;
                    }
                } else {
                    echo "Invalid logo file format.";
                    exit;
                }
            } else {
                echo "Logo is required.";
                exit;
            }

            if (mysqli_stmt_execute($stmt)) {
                // Set session variable indicating society details are successfully inserted
                $_SESSION["society_inserted"] = true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                exit;
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
            exit;
        }
    }

    // Check if secretary details are submitted
    if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["emailInput"]) && isset($_POST["phone"]) && isset($_POST["password"])) {
        // Insert secretary data into the database
        $sql = "INSERT INTO secretery (firstname, lastname, email, phone, password, profilepic) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind parameters and execute the statement
            mysqli_stmt_bind_param($stmt, "ssssss", $firstName, $lastName, $email, $phone, $password, $profilePicPath);
            // Set values for parameters
            $firstName = $_POST["firstname"];
            $lastName = $_POST["lastname"];
            $email = $_POST["emailInput"];
            $phone = $_POST["phone"];
            $password = $_POST["password"];
            $profilePicPath = ""; // Initialize profilePicPath

            // Check if profile picture is uploaded
            if (!empty($_FILES["profilepic"]["name"])) {
                $profilePicName = basename($_FILES["profilepic"]["name"]);
                $profilePicTargetPath = "./uploaded_img/" . $profilePicName;
                $profilePicType = strtolower(pathinfo($profilePicTargetPath, PATHINFO_EXTENSION));

                // Allow certain file formats
                $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
                if (in_array($profilePicType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES["profilepic"]["tmp_name"], $profilePicTargetPath)) {
                        $profilePicPath = $profilePicTargetPath;
                    } else {
                        echo "There was an error uploading your profile picture.";
                        exit;
                    }
                } else {
                    echo "Invalid profile picture file format.";
                    exit;
                }
            } else {
                echo "Profile picture is required.";
                exit;
            }

            if (mysqli_stmt_execute($stmt)) {
                // Check if society details were successfully inserted
                if (isset($_SESSION["society_inserted"]) && $_SESSION["society_inserted"] === true) {
                    // Display step 3
                    echo '<script>window.location.href = "./register_society.php"</script>';
                    exit; // Exit after displaying step 3 content
                } else {
                    echo "Secretary details inserted successfully.";
                    // Redirect to a success page or do other processing as needed
                }
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                exit;
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
            exit;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="./css/toasty.css" />
    <script src="./JS/toasty.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Society</title> <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- jQuery -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.x.x/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Custom CSS -->
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        .container {
            max-width: 100%;
            padding-top: 0px;

        }

        body {
            background-color: #fff;
            margin-top: 10px;
            font-family: poppins;
        }

        .stepwizard-step p {
            margin-top: 10px;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;

        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }

        /* Navigation Bar */
        .site-navbar {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            height: 90px !important;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 9999;
            background-color: black;
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

        #passwordError {
            white-space: pre-line;
            /* This will preserve the newline character */
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

        sup {
            font-size: medium;
        }

        /******************************************************************************
        Pricing
        *******************************************************************************/
        .pricing {
            background-color: #fff;
            margin: 0 auto 40px;
            max-width: 270px;
            position: relative;
            text-align: left;
        }

        .pricing * {
            position: relative;
        }

        .pricing:before {
            background: #f7f7f7;
            background: rgba(30, 30, 30, .06);
            bottom: 0;
            content: "";
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
        }

        .pricing .title {
            line-height: 32px;
            padding: 17px 20px 21px;
        }

        .pricing .title a {
            color: #1e1e1e;
            font-size: 24px;
            font-weight: bold;
            line-height: 32px;
            text-decoration: none;
        }

        .pricing .price-box {
            font-size: 12px;
            line-height: 1;
            overflow: hidden;
            padding: 0 20px 20px;
        }

        .pricing .price-box .icon {
            background: #fff;
            color: #505050;
            height: 60px;
            text-align: center;
            width: 60px;
            z-index: 1;
        }

        .pricing .price-box .icon i,
        .pricing .price-box .icon .livicon {
            background: none;
            font-size: 30px;
            height: auto;
            line-height: 52px;
            margin: 0;
            width: auto;
        }

        .pricing .price-box .icon .livicon {
            height: 60px !important;
        }

        .pricing .price-box .icon .livicon svg {
            top: 0 !important;
            vertical-align: middle;
        }

        .pricing .price-box .price {
            font-size: 36px;
            font-weight: bold;
            margin: 13px 0 0;
        }

        .pricing .price-box .price span {
            font-size: 12px;
        }

        .pricing .options {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .pricing .options li {
            border-top: 1px solid rgba(30, 30, 30, .1);
            color: #999;
            color: rgba(30, 30, 30, .4);
            line-height: 22px;
            padding: 13px 10px 13px 45px;
            position: relative;
        }

        .pricing .options li span {
            color: #1e1e1e;
            display: none;
            left: 25px;
            line-height: 1;
            position: absolute;
            top: 16px;
        }

        .pricing .options li.active {
            color: #1e1e1e;
        }

        .pricing .options li.active span {
            display: block;
        }

        .pricing .bottom-box {
            border-top: 1px solid rgba(30, 30, 30, .1);
            background: rgba(30, 30, 30, .05);
            overflow: hidden;
            padding: 19px 19px 20px;
        }

        .pricing .bottom-box .more {
            color: #7f7f7f;
            color: rgba(30, 30, 30, .7);
            display: block;
            float: left;
            font-size: 12px;
            line-height: 1;
            text-decoration: none;
            -webkit-transition: opacity .2s linear;
            transition: opacity .2s linear;
        }

        .pricing .bottom-box .more:hover {
            opacity: .65;
            filter: alpha(opacity=65);
            -webkit-transition: opacity .2s linear;
            transition: opacity .2s linear;
        }

        .pricing .bottom-box .more span {
            font-size: 17px;
            line-height: 12px;
            margin: 0 0 0 3px;
            vertical-align: top;
        }

        .pricing .bottom-box .rating-box {
            float: right;
        }

        .pricing .bottom-box .btn {
            font-weight: bold;
            margin: 19px 0 0;
            width: 100%;
        }

        .pricing.prising-info:before {
            background: rgba(1, 165, 219, .06);
        }

        .pricing.prising-info .title a {
            color: #01a5db;
        }

        .pricing.prising-info .price-box .icon {
            color: #35beeb;
            border-color: #35beeb;
        }

        .pricing.prising-info .options li,
        .pricing.prising-info .bottom-box {
            border-color: rgba(1, 165, 219, .1);
            color: rgba(1, 165, 219, .4);
        }

        .pricing.prising-info .bottom-box {
            border-top: 1px solid rgba(1, 165, 219, .1);
            background: rgba(1, 165, 219, .05);
        }

        .pricing.prising-info .options li span,
        .pricing.prising-info .bottom-box .more,
        .pricing.prising-info .options li.active {
            color: #01a5db;
        }

        .pricing.pricing-success:before {
            background: rgba(132, 162, 0, .06);
        }

        .pricing.pricing-success .title a {
            color: #84a200;
        }

        .pricing.pricing-success .price-box .icon {
            border-color: #9ab71a;
            color: #9ab71a;
        }

        .pricing.pricing-success .options li,
        .pricing.pricing-success .bottom-box {
            border-color: rgba(132, 162, 0, .1);
            color: rgba(132, 162, 0, .4);
        }

        .pricing.pricing-success .bottom-box {
            border-top: 1px solid rgba(132, 162, 0, .1);
            background: rgba(132, 162, 0, .05);
        }

        .pricing.pricing-success .bottom-box .more,
        .pricing.pricing-success .options li span,
        .pricing.pricing-success .options li.active {
            color: #84a200;
        }

        .pricing.pricing-error:before {
            background: rgba(212, 7, 70, .06);
        }

        .pricing.pricing-error .title a {
            color: #d40746;
        }

        .pricing.pricing-error .price-box .icon {
            border-color: #de2a61;
            color: #de2a61;
        }

        .pricing.pricing-error .options li,
        .pricing.pricing-error .bottom-box {
            border-color: rgba(212, 7, 70, .1);
            color: rgba(212, 7, 70, .4);
        }

        .pricing.pricing-error .bottom-box {
            border-top: 1px solid rgba(212, 7, 70, .1);
            background: rgba(212, 7, 70, .05);
        }

        .pricing.pricing-error .options li span,
        .pricing.pricing-error .bottom-box .more,
        .pricing.pricing-error .options li.active {
            color: #d40746;
        }

        .icon.border {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            border-width: 1px;
        }

        .icon.circle {
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }

        .icon.pull-right {
            float: right;
            margin-left: 10px;
        }

        .pricing-warning:before {
            background-color: rgba(248, 148, 6, .06) !important;
        }

        .pricing.pricing-info:before {
            background: rgba(1, 165, 219, .06);
        }

        .pricing-warning .title a,
        .pricing-warning .options li.active,
        .pricing-warning .options li span,
        .package .title a,
        .package .price-box .price {
            color: #f89406 !important;
        }

        .pricing.pricing-info .options li span,
        .pricing.pricing-info .bottom-box .more,
        .pricing.pricing-info .options li.active {
            color: #01a5db;
        }

        .pricing.pricing-info .options li,
        .pricing.pricing-info .bottom-box {
            border-color: rgba(1, 165, 219, .1);
            color: rgba(1, 165, 219, .4);
        }

        .pricing.pricing-warning .options li {
            color: rgba(248, 148, 6, .4);
        }

        .pricing.pricing-info .title a {
            color: #01a5db;
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
                            <img class="logo" src="./img/SMP-wf.png" alt="logo" height="60vh" width="vw">
                        </a>
                    </div>
                </div>
                <div class=" col-12 col-md-10 d-none d-xl-block">
                    <nav class="site-navigation position-relative text-right" role="navigation">
                        <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                            <li class="active"><a href="./index.php"><span>Home</span></a></li>
                            <li><a href="./index.php" onclick="scrollToTestimonials()"><span>About us</span></a></li>
                            <li><a href="./index.php" onclick="scrollToServices()"><span>Services</span></a></li>
                            <li><a href="./index.php" onclick="scrollToFooter()"><span>Contact us</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <br>
    <br>
    <br>
    <br>



    <div class="container">
        <div class="row justify-content-center">
            <div>
                <div class="stepwizard col-md-12" style="width: 500px;">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step">
                            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                            <p>Step 1</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                            <p>Step 2</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                            <p>Step 3</p>
                        </div>
                    </div>
                </div>

                <form role="form" action="./register_society.php" method="post" enctype="multipart/form-data" id="societyForm">
                    <div class="row setup-content" id="step-1">
                        <div class="col-md-12">
                            <br>
                            <div class="col-md-12">
                                <div class="container">
                                    <h4>Register your society</h4>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label"><sup class="text-danger fs-5">*</sup>Society Name: </label>
                                        <input name="societyName" maxlength="100" type="text" required="required" class="form-control" placeholder="Enter your society name" id="societyName">
                                        <span class="error-message" id="societyNameError" style="display: none; color: red;">*Society Name is required</span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label"><sup class="text-danger">*</sup>Address</label>
                                        <textarea name="societyAddress" required="required" class="form-control" placeholder="Enter your society address" id="societyAddress"></textarea>
                                        <span class="error-message" id="societyAddressError" style="display: none; color: red;">*Society Address is required</span>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label"><sup class="text-danger">*</sup>City: </label>
                                                <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter city" id="city" name="city">
                                                <span class="error-message" id="cityError" style="display: none; color: red;">*City is required</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label"><sup class="text-danger">*</sup>Pincode: </label>
                                                <input maxlength="100" name="pincode" type="text" required="required" class="form-control" placeholder="Enter pincode" id="pincode">
                                                <span class="error-message" id="pincodeError" style="display: none; color: red;">*Pincode is required</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Select Society Logo: </label>
                                                <br>
                                                <input type="file" id="logoInput" name="logoInput" required="required" onchange="previewLogo(event)" />

                                                <span class="error-message" id="logoError" style="display: none; color: red;">*Logo is required</span>
                                            </div>
                                        </div>
                                        <!-- Image preview container -->
                                        <img id="logoPreview" src="#" alt="Logo Preview" style="display: none; max-width: 100px; height: 100px; margin-left: 17px" />

                                        <!-- Image preview container -->
                                        <img id="logoPreview" src="#" alt="Logo Preview" style="display: none; max-width: 100px; height: 100px; margin-left: 17px" />
                                    </div>
                                    <button class="btn btn-primary nextBtn pull-right w-25 mt-3" type="submit">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row setup-content" id="step-2">
                        <div class="col-12">
                            <div class="col-md-12">
                                <br>
                                <h4>Society Secretary Details</h4>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">First Name: </label>
                                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter first name" id="firstName" name="firstname">
                                            <span class="error-message" id="firstNameError" style="display: none; color: red;">*First name is required</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Last Name: </label>
                                            <input maxlength="100" name="lastname" type="text" required="required" class="form-control" placeholder="Enter last name" id="lastName">
                                            <span class="error-message" id="lastNameError" style="display: none; color: red;">*Last name is required</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email Address: </label>
                                    <input maxlength="100" id="emailInput" name="emailInput" type="text" required="required" class="form-control" placeholder="Enter Email id">
                                    <span id="emailError" style="display: none; color: red;"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Phone No: </label>
                                    <input maxlength="100" name="phone" type="text" required="required" class="form-control" placeholder="Enter phone number" id="phoneNumber">
                                    <span class="error-message" id="phoneNumberError" style="display: none; color: red;">*Phone number is required</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Password: </label>
                                            <input maxlength="100" type="password" required="required" class="form-control" placeholder="Enter password" id="password" name="password">
                                            <span class="error-message" id="passwordError" style="display: none; color: red; width:20vw">*Password is required</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password: </label>
                                            <input maxlength="100" type="password" required="required" class="form-control" placeholder="Enter confirm password" id="confirmPassword">
                                            <span class="error-message" id="confirmPasswordError" style="display: none; color: red;">*Confirm password is required</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Select Profile Picture: </label><br>
                                    <input type="file" id="profilepicInput" name="profilepic" required="required" onchange="previewProfilePic(event)" />
                                    <span class="error-message" id="logoError" style="display: none; color: red;">*profile picture is required</span>
                                </div>
                                <!-- Image preview container -->
                                <img id="profilepicPreview" src="#" alt="Profile Picture Preview" style="display: none; max-width: 100px; height: 100px; margin-left: 17px" />

                                <script>
                                    function previewProfilePic(event) {
                                        var input = event.target;
                                        var reader = new FileReader();
                                        reader.onload = function() {
                                            var profilepicPreview = document.getElementById('profilepicPreview');
                                            profilepicPreview.src = reader.result;
                                            profilepicPreview.style.display = 'block';
                                        };
                                        reader.readAsDataURL(input.files[0]);
                                    }
                                </script>

                                <button class="mt-3 btn btn-outline-secondary prevBtn pull-left" type="button">Previous</button>

                                <button class="mt-3 btn btn-primary nextBtn pull-right" style="width: 100px; margin-left:10px;" type="submit">Next</button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row setup-content" id="step-3">
                <div class="col-md-12">
                    <div class="container">

                        <h3 class="text-center mt-3">Choose Best Plan For Your Society</h3>
                        <hr style="border: 1px dashed black; width: 297px; opacity: 30%;">

                        <div class="row" style="margin-top: 30px">
                            <div class="col-md-6 col-lg-3">
                                <div class="pricing pricing-warning shadow-lg border border-warning">
                                    <div class="title"><a href="/shop">Demo Free</a></div>
                                    <div class="price-box">
                                        <div class="icon pull-right border circle">
                                            <span class="livicon livicon-processed" data-n="shopping-cart" data-s="32" data-c="#1e1e1e" data-hc="0" id="livicon-1" style="width: 32px; height: 32px;"><svg height="32" version="1.1" width="32" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; top: -0.15625px;" id="canvas-for-livicon-1">
                                                    <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc>
                                                    <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                                    <path fill="#1e1e1e" stroke="none" d="M9.428,19C9.192,19,9,18.792,9,18.536V14.9H12.1V19H9.428ZM17,18.536V14.9H12.9V19H16.571C16.808,19,17,18.792,17,18.536ZM9.428,11C9.192,11,9,11.191,9,11.429V14.1H12.1V11H9.428ZM16.571,11H12.9V14.1H17V11.429C17,11.191,16.809,11,16.571,11Z" transform="matrix(1,0,0,1,-5,-20)" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                                    <path fill="#1e1e1e" stroke="none" d="M18.428,19C18.191,19,18,18.792,18,18.536V14.9H21.1V19H18.428ZM26,18.536V14.9H21.9V19H25.570999999999998C25.808,19,26,18.792,26,18.536ZM18.428,11C18.191,11,18,11.191,18,11.429V14.1H21.1V11H18.428ZM25.571,11H21.9V14.1H26V11.429C26,11.191,25.809,11,25.571,11Z" transform="matrix(1,0,0,1,5,-20)" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                                    <path fill="#1e1e1e" stroke="none" d="M11.156,11C10.921000000000001,11,10.729000000000001,10.792,10.729000000000001,10.537V6.369H14.651000000000002V11H11.156ZM19.287,10.537V6.369H15.364999999999998V11H18.857999999999997C19.095,11,19.287,10.792,19.287,10.537ZM13.406,1.145C13.081000000000001,0.998,12.421000000000001,0.929,11.979000000000001,1.145C11.508000000000001,1.3760000000000001,11.129000000000001,1.956,11.266000000000002,2.5709999999999997C11.482000000000001,3.545,12.868000000000002,3.872,12.868000000000002,3.872H10.443000000000001C10.207,3.872,10.016000000000002,4.063,10.016000000000002,4.2989999999999995V6.010999999999999H14.651000000000002V3.873H15.008000000000001C15.008,3.873,14.54,1.657,13.406,1.145ZM12.835,3.253C12.548,3.194,12.048,3.067,11.926,2.515C11.849,2.165,12.063,1.836,12.331,1.705C12.581999999999999,1.582,12.956999999999999,1.622,13.142,1.705C13.785,1.995,14.049999999999999,3.253,14.049999999999999,3.253S13.358,3.359,12.835,3.253ZM19.572,3.873H17.146C17.146,3.873,18.533,3.5460000000000003,18.75,2.572C18.886,1.956,18.507,1.377,18.036,1.1460000000000001C17.594,0.9300000000000002,16.934,0.9990000000000001,16.609,1.1460000000000001C15.475000000000001,1.6580000000000001,15.007000000000001,3.8740000000000006,15.007000000000001,3.8740000000000006H15.364V6.013H20V4.3C20,4.063,19.81,3.873,19.572,3.873ZM15.966,3.253C15.966,3.253,16.232,1.995,16.874,1.705C17.06,1.622,17.433999999999997,1.582,17.685,1.705C17.951999999999998,1.836,18.166,2.164,18.087999999999997,2.515C17.965999999999998,3.068,17.467,3.1950000000000003,17.179999999999996,3.253C16.657,3.359,15.966,3.253,15.966,3.253Z" transform="matrix(1,0,0,1,2,-20)" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                                    <path fill="#1e1e1e" stroke="none" d="M14,27C14,28.105,13.104,29,12,29S10,28.105,10,27S10.896,25,12,25S14,25.895,14,27ZM24,25C22.895,25,22,25.895,22,27S22.895,29,24,29S26,28.105,26,27S25.105,25,24,25ZM26.713,22.586L26.529,23.413999999999998C26.457,23.737,26.13,24,25.799,24H9.3C8.637,24,7.998000000000001,23.473,7.873000000000001,22.821L4.75,6.59C4.69,6.264,4.373,6,4.042,6H1.334C0.782,6,0.3340000000000001,5.552,0.3340000000000001,5S0.782,4,1.334,4H5.334C5.997,4,6.622,4.53,6.73,5.184L7.193,8H29.4C29.730999999999998,8,29.941,8.262,29.869999999999997,8.586L27.464,19.414C27.393,19.737,27.065,20,26.734,20H9.3L9.554,21.409C9.612,21.735,9.929,22,10.26,22H26.244C26.575,22,26.785,22.263,26.713,22.586ZM26.939,13H8.078L8.447,15H26.494L26.939,13ZM7.524,10L7.893,12H27.161L27.605,10H7.524ZM25.828,18L26.272,16H8.631L9,18H25.828Z" opacity="1" transform="matrix(1,0,0,1,0,0)" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1;"></path>
                                                </svg></span>
                                        </div>
                                        <div class="starting">30 days free trail</div>
                                        <div class="price">₹0<span>/month</span></div>
                                    </div>
                                    <ul class="options">
                                        <li><span><i class="fa fa-check"></i></span>Responsive Design
                                        </li>
                                        <li class="active"><span><i class="fa fa-check"></i></span>Styled elements
                                        </li>
                                        <li><span><i class="fa fa-check"></i></span>Easy Setup
                                        </li>
                                    </ul>
                                    <div class="bottom-box">
                                        <a href="/shop" class="more">Read More <span class="fa fa-angle-right"></span></a>
                                        <div class="rating-box">
                                            <div style="width: 60%" class="rating">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="73px" height="12px" viewBox="0 0 73 12" enable-fwb-bg="new 0 0 73 12" xml:space="preserve">
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="6.5,0 8,5 13,5 9,7.7 10,12 6.5,9.2 3,12 4,7.7 0,5 5,5"></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="66.5,0 68,5 73,5 69,7.7 70,12 66.5,9.2 63,12 64,7.7 60,5 65,5 "></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="21.5,0 23,5 28,5 24,7.7 25,12 21.5,9.2 18,12 19,7.7 15,5 20,5 "></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="51.5,0 53,5 58,5 54,7.7 55,12 51.5,9.2 48,12 49,7.7 45,5 50,5 "></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="36.5,0 38,5 43,5 39,7.7 40,12 36.5,9.2 33,12 34,7.7 30,5 35,5 "></polygon>
                                                </svg>
                                            </div>
                                        </div>
                                        <a href="./success.php?price=0" class="btn btn-lg btn-warning clearfix">Buy Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="pricing-info pricing shadow-lg border border-info">
                                    <div class="title"><a href="/shop">Silver Plan</a></div>
                                    <div class="price-box">
                                        <div class="icon pull-right border circle">
                                            <span class="livicon livicon-processed" data-n="wrench" data-s="32" data-c="#35beeb" data-hc="0" id="livicon-2" style="width: 32px; height: 32px;"><svg height="32" version="1.1" width="32" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; top: -0.15625px;" id="canvas-for-livicon-2">
                                                    <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc>
                                                    <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                                    <path fill="#35beeb" stroke="none" d="M11.954,7.18L10.026,4.882L7.071999999999999,5.401999999999999L6.046,8.221L7.974,10.519L10.928,9.999L11.954,7.18ZM7.851,8.665C7.318,8.03,7.401,7.084999999999999,8.036,6.552C8.671,6.02,9.616,6.101999999999999,10.149,6.736999999999999C10.681999999999999,7.371999999999999,10.597999999999999,8.318,9.963999999999999,8.85C9.329,9.382,8.384,9.299,7.851,8.665Z" opacity="0" stroke-width="0" transform="matrix(1,0,0,1,0,0)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path>
                                                    <path fill="#35beeb" stroke="none" d="M20.046,24.82L21.974999999999998,27.118000000000002L24.929,26.597L25.953999999999997,23.779L24.025999999999996,21.481L21.071999999999996,22.002000000000002L20.046,24.82ZM24.149,23.336C24.681,23.971,24.599,24.915999999999997,23.964000000000002,25.448999999999998C23.329,25.979999999999997,22.384,25.898,21.851000000000003,25.262999999999998S21.402,23.683,22.036,23.15C22.671,22.618,23.616,22.701,24.149,23.336Z" opacity="0" stroke-width="0" transform="matrix(1,0,0,1,0,0)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path>
                                                    <path fill="#35beeb" stroke="none" d="M15.03,13.384L3.969999999999999,23.028C2.791999999999999,24.055,2.669999999999999,25.843999999999998,3.6929999999999987,27.025C4.716999999999999,28.206,6.501999999999999,28.331999999999997,7.6789999999999985,27.304L18.75,17.649C21.246,18.847,24.320999999999998,18.531000000000002,26.543,16.593C28.65,14.757,29.419999999999998,11.957,28.781,9.416L24.483999999999998,13.11L20.979,11.9L20.271,8.249L24.579,4.546000000000001C22.151,3.542000000000001,19.265,3.9120000000000013,17.148,5.758000000000001C14.916,7.704,14.178,10.73,15.03,13.384Z" transform="matrix(1,0,0,1,0,0)" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                                </svg></span>
                                        </div>
                                        <div class="starting">Starting at</div>
                                        <div class="price">₹199<span>/month</span></div>
                                    </div>
                                    <ul class="options">
                                        <li><span><i class="fa fa-check"></i></span>Responsive Design
                                        </li>
                                        <li class="active"><span><i class="fa fa-check"></i></span>Styled elements
                                        </li>
                                        <li><span><i class="fa fa-check"></i></span>Easy Setup
                                        </li>
                                    </ul>
                                    <div class="bottom-box">
                                        <a href="/shop" class="more">Read More <span class="fa fa-angle-right"></span></a>
                                        <div class="rating-box">
                                            <div style="width: 80%" class="rating">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="73px" height="12px" viewBox="0 0 73 12" enable-fwb-bg="new 0 0 73 12" xml:space="preserve">
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="6.5,0 8,5 13,5 9,7.7 10,12 6.5,9.2 3,12 4,7.7 0,5 5,5"></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="66.5,0 68,5 73,5 69,7.7 70,12 66.5,9.2 63,12 64,7.7 60,5 65,5 "></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="21.5,0 23,5 28,5 24,7.7 25,12 21.5,9.2 18,12 19,7.7 15,5 20,5 "></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="51.5,0 53,5 58,5 54,7.7 55,12 51.5,9.2 48,12 49,7.7 45,5 50,5 "></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="36.5,0 38,5 43,5 39,7.7 40,12 36.5,9.2 33,12 34,7.7 30,5 35,5 "></polygon>
                                                </svg>
                                            </div>
                                        </div><a href="./payscript.php?price=199" class="btn btn-lg btn-info clearfix">Buy Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="pricing-success pricing shadow-lg border border-success ">
                                    <div class="title"><a href="/shop">Gold Plan</a></div>
                                    <div class="price-box">
                                        <div class="icon pull-right border circle">
                                            <span class="livicon livicon-processed" data-n="piggybank" data-s="32" data-c="#9ab71a" data-hc="0" id="livicon-3" style="width: 32px; height: 32px;"><svg height="32" version="1.1" width="32" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; top: -0.15625px;" id="canvas-for-livicon-3">
                                                    <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc>
                                                    <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                                    <path fill="#9ab71a" stroke="none" d="M13.745,18.354V19.419999999999998C13.315999999999999,19.319999999999997,13.101999999999999,19.151999999999997,13.101999999999999,18.913999999999998C13.103,18.732,13.2,18.4,13.745,18.354ZM14.251,20.514V21.662C14.899999999999999,21.599,14.947999999999999,21.275,14.947999999999999,21.073999999999998C14.948,20.865,14.715,20.678,14.251,20.514ZM18,20C18,22.209,16.209,24,14,24S10,22.209,10,20S11.791,16,14,16S18,17.791,18,20ZM15.937,20.951C15.950999999999999,20.705000000000002,15.700999999999999,20.099,15.376,19.912C15.117999999999999,19.764,14.6,19.599,14.296,19.543V18.381C14.6,18.4,14.7,18.6,14.788,18.75C14.870000000000001,18.941,15.017,19.037,15.226,19.037H15.773000000000001C15.755,18.572,15.501000000000001,17.698999999999998,14.297,17.573999999999998L14.3,17C14.3,17,13.941,16.987,13.804,16.987H13.790000000000001V17.573999999999998C12.499,17.598999999999997,12.247000000000002,18.503999999999998,12.231000000000002,18.968999999999998C12.2,19.9,12.6,20.1,13.746,20.4V21.6C13.591000000000001,21.573,13.146,21.5,13.094000000000001,20.911H12.164000000000001C12.201000000000002,21.423000000000002,12.646,22.501,13.746000000000002,22.501V23H14.246000000000002V22.5C15.5,22.5,15.9,21.6,15.937,20.951Z" transform="matrix(1,0,0,1,0,0)" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                                    <path fill="#9ab71a" stroke="none" d="M13.745,18.354V19.419999999999998C13.315999999999999,19.319999999999997,13.101999999999999,19.151999999999997,13.101999999999999,18.913999999999998C13.103,18.732,13.2,18.4,13.745,18.354ZM14.251,20.514V21.662C14.899999999999999,21.599,14.947999999999999,21.275,14.947999999999999,21.073999999999998C14.948,20.865,14.715,20.678,14.251,20.514ZM18,20C18,22.209,16.209,24,14,24S10,22.209,10,20S11.791,16,14,16S18,17.791,18,20ZM15.937,20.951C15.950999999999999,20.705000000000002,15.700999999999999,20.099,15.376,19.912C15.117999999999999,19.764,14.6,19.599,14.296,19.543V18.381C14.6,18.4,14.7,18.6,14.788,18.75C14.870000000000001,18.941,15.017,19.037,15.226,19.037H15.773000000000001C15.755,18.572,15.501000000000001,17.698999999999998,14.297,17.573999999999998L14.3,17C14.3,17,13.941,16.987,13.804,16.987H13.790000000000001V17.573999999999998C12.499,17.598999999999997,12.247000000000002,18.503999999999998,12.231000000000002,18.968999999999998C12.2,19.9,12.6,20.1,13.746,20.4V21.6C13.591000000000001,21.573,13.146,21.5,13.094000000000001,20.911H12.164000000000001C12.201000000000002,21.423000000000002,12.646,22.501,13.746000000000002,22.501V23H14.246000000000002V22.5C15.5,22.5,15.9,21.6,15.937,20.951Z" transform="matrix(1,0,0,1,10,0)" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                                    <path fill="#9ab71a" stroke="none" d="M13.745,18.354V19.419999999999998C13.315999999999999,19.319999999999997,13.101999999999999,19.151999999999997,13.101999999999999,18.913999999999998C13.103,18.732,13.2,18.4,13.745,18.354ZM14.251,20.514V21.662C14.899999999999999,21.599,14.947999999999999,21.275,14.947999999999999,21.073999999999998C14.948,20.865,14.715,20.678,14.251,20.514ZM18,20C18,22.209,16.209,24,14,24S10,22.209,10,20S11.791,16,14,16S18,17.791,18,20ZM15.937,20.951C15.950999999999999,20.705000000000002,15.700999999999999,20.099,15.376,19.912C15.117999999999999,19.764,14.6,19.599,14.296,19.543V18.381C14.6,18.4,14.7,18.6,14.788,18.75C14.870000000000001,18.941,15.017,19.037,15.226,19.037H15.773000000000001C15.755,18.572,15.501000000000001,17.698999999999998,14.297,17.573999999999998L14.3,17C14.3,17,13.941,16.987,13.804,16.987H13.790000000000001V17.573999999999998C12.499,17.598999999999997,12.247000000000002,18.503999999999998,12.231000000000002,18.968999999999998C12.2,19.9,12.6,20.1,13.746,20.4V21.6C13.591000000000001,21.573,13.146,21.5,13.094000000000001,20.911H12.164000000000001C12.201000000000002,21.423000000000002,12.646,22.501,13.746000000000002,22.501V23H14.246000000000002V22.5C15.5,22.5,15.9,21.6,15.937,20.951Z" transform="matrix(1,0,0,1,6,-5)" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                                    <path fill="#9ab71a" stroke="none" d="M26,23.999C25.303,24.328999999999997,26.033,26.904999999999998,25.199,27.61C24.705000000000002,28.214,22.385,27.852,22.136000000000003,27.967C21.419000000000004,27.807,22.439000000000004,25.487,21.597,25.619C20.247,26.006,16.628,26.029,16.085,25.978C15.937000000000001,25.962000000000003,16.085,27.806,15.571000000000002,27.966C14.634000000000002,27.997,13.727000000000002,28.025000000000002,13.353000000000002,27.950000000000003C12.164000000000001,27.983000000000004,12.915000000000001,25.688000000000002,12.612000000000002,25.454000000000004C12.430000000000001,25.395000000000003,11.276000000000002,25.120000000000005,11.100000000000001,25.052000000000003C10.802000000000001,25.130000000000003,10.835,26.652000000000005,10.399000000000001,27.009000000000004C9.670000000000002,27.333000000000006,7.687000000000001,26.999000000000002,7.408000000000001,26.427000000000003C6.963000000000001,24.906000000000002,8.218000000000002,23.243000000000002,7.965000000000002,22.989000000000004C6.980000000000001,22.290000000000003,6.710000000000002,22.737000000000005,6.001000000000001,21.837000000000003C4.574000000000002,20.267000000000003,3.6940000000000013,21.544000000000004,2.397000000000001,20.382000000000005C1.604,19.31,2.2,16.419,2.46,16.08C3.004,15.372999999999998,3.55,16.287999999999997,4,15.085999999999999C4.189,12.447999999999999,5.332,10.052,7.371,8.204999999999998C6.382,7.194,4.564,4.929,6.667,3.733C8.704,3.318,12.581,6.0600000000000005,12.581,6.0600000000000005S14.931,5.3340000000000005,17.519,5.3340000000000005C24.871,5.3340000000000005,29.999,10.178,29.999,16.151C30,19.741,29.211,21.938,26,23.999L26,23.999ZM7.719,10.968C7.719,11.464,8.318,12.187,8.813,12.187C9.309000000000001,12.187,10.369,11.818,10.188,10.843C10.186,10.83,7.719,10.473,7.719,10.968ZM23.25,8.869C21.795,8.372,20.041,7.88,16.924,8.024C16.445,8.024,16.055,8.540999999999999,16.055,9.020999999999999S16.445999999999998,9.889999999999999,16.924,9.889999999999999C16.924,9.889999999999999,20.35,9.573999999999998,23.25,10.735999999999999C23.73,10.735999999999999,24.049,10.338999999999999,24.119,9.863999999999999C24.213,9.243,23.25,8.869,23.25,8.869Z" opacity="1" stroke-width="0" transform="matrix(1,0,0,1,0,0)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1;"></path>
                                                </svg></span>
                                        </div>
                                        <div class="starting">Starting at</div>
                                        <div class="price">₹1198<span>/6 month</span></div>
                                    </div>
                                    <ul class="options">
                                        <li class="active"><span><i class="fa fa-check"></i></span>Responsive Design
                                        </li>
                                        <li class="active"><span><i class="fa fa-check"></i></span>Styled elements
                                        </li>
                                        <li><span><i class="fa fa-check"></i></span>Easy Setup
                                        </li>
                                    </ul>
                                    <div class="bottom-box">
                                        <a href="/shop" class="more">Read More <span class="fa fa-angle-right"></span></a>
                                        <div class="rating-box">
                                            <div style="width: 80%" class="rating">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="73px" height="12px" viewBox="0 0 73 12" enable-fwb-bg="new 0 0 73 12" xml:space="preserve">
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="6.5,0 8,5 13,5 9,7.7 10,12 6.5,9.2 3,12 4,7.7 0,5 5,5"></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="66.5,0 68,5 73,5 69,7.7 70,12 66.5,9.2 63,12 64,7.7 60,5 65,5 "></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="21.5,0 23,5 28,5 24,7.7 25,12 21.5,9.2 18,12 19,7.7 15,5 20,5 "></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="51.5,0 53,5 58,5 54,7.7 55,12 51.5,9.2 48,12 49,7.7 45,5 50,5 "></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="36.5,0 38,5 43,5 39,7.7 40,12 36.5,9.2 33,12 34,7.7 30,5 35,5 "></polygon>
                                                </svg>
                                            </div>
                                        </div><a href="./payscript.php?price=1198" class="btn btn-lg btn-success clearfix">Buy Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="pricing-error pricing shadow-lg rounded-3 border border-danger">
                                    <div class="title"><a href="/shop">Platinum Plan</a></div>
                                    <div class="price-box rounded-3 ">
                                        <div class="icon pull-right border circle">
                                            <span class="livicon livicon-processed" data-n="key" data-s="32" data-c="#de2a61" data-hc="0" id="livicon-4" style="width: 32px; height: 32px;"><svg height="32" version="1.1" width="32" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; top: -0.15625px;" id="canvas-for-livicon-4">
                                                    <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc>
                                                    <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                                    <path fill="#de2a61" stroke="none" d="M18.16,6.956C16.426000000000002,8.690000000000001,16.425,11.104,18.179,12.858C19.241999999999997,13.92,20.695,14.525,22.162999999999997,14.748000000000001L22.195999999999998,25.509C22.197999999999997,25.798000000000002,22.317999999999998,26.079,22.52,26.281C22.971,26.732,23.997,26.733999999999998,24.445,26.285999999999998C24.644000000000002,26.086999999999996,24.764,25.807,24.764,25.519L24.752,23.279999999999998L26.291,23.284999999999997C26.292,23.621999999999996,26.171,24.084999999999997,26.379,24.292999999999996C26.566000000000003,24.479999999999997,28.042,24.482999999999997,28.226000000000003,24.299999999999997C28.458000000000002,24.067999999999998,28.429000000000002,20.906,28.318,20.770999999999997C28.156000000000002,20.566,26.66,20.580999999999996,26.474,20.766C26.266000000000002,20.973,26.285,21.407999999999998,26.287,21.744999999999997L24.747,21.740999999999996L24.727,14.754999999999995C26.196,14.541999999999996,27.645,13.944999999999995,28.7,12.890999999999995C30.442,11.147999999999994,30.428,8.733999999999995,28.681,6.987999999999995C26.044,4.35,20.782,4.334,18.16,6.956ZM27.029,11.475C26.181,12.323,20.695,12.305,19.842,11.453C18.988,10.6,18.985,9.221,19.831999999999997,8.373999999999999C20.679999999999996,7.525999999999999,26.165999999999997,7.542999999999999,27.017999999999997,8.395C27.872,9.248,27.876,10.628,27.029,11.475Z" opacity="0" stroke-width="0" transform="matrix(1,0,0,1,0,0)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path>
                                                    <path fill="#de2a61" stroke="none" d="M24.472,5.294C22.275000000000002,3.0969999999999995,18.685000000000002,3.1239999999999997,16.454,5.353999999999999C16.201,5.606999999999999,15.976,5.876999999999999,15.780000000000001,6.161999999999999L6.028,6.235L3.604,8.659C3.1590000000000003,9.104000000000001,3.153,9.824000000000002,3.592,10.263000000000002L4.3870000000000005,11.058000000000002L5.195,10.250000000000002L6.86,11.130000000000003L8.402000000000001,10.225000000000003L9.993,11.816000000000003L11.608,10.201000000000002L13.315000000000001,11.677000000000003L15.280000000000001,11.778000000000004C15.547,12.356000000000003,15.918000000000001,12.896000000000004,16.394000000000002,13.372000000000003C18.589000000000002,15.567000000000004,22.179000000000002,15.540000000000003,24.410000000000004,13.309000000000003S26.666,7.489,24.472,5.294ZM7.081,8.124L7.091,6.99L14.312000000000001,6.917L14.304,8.05L7.081,8.124ZM21.62,10.524C20.962,9.866,20.972,8.789,21.64,8.120999999999999C22.310000000000002,7.450999999999999,23.386,7.442999999999999,24.044,8.099999999999998C24.703,8.759999999999998,24.696,9.836999999999998,24.026,10.506999999999998C23.357,11.176,22.28,11.184,21.62,10.524Z" opacity="0" stroke-width="0" transform="matrix(1,0,0,1,0,0)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path>
                                                    <path fill="#de2a61" stroke="none" d="M29.381,10.583L21.393,2.5949999999999998C20.715,1.9179999999999997,19.508,1.7979999999999996,18.711000000000002,2.3299999999999996L11.158000000000001,7.365C10.361,7.896,10.059000000000001,9.032,10.488000000000001,9.889C10.488000000000001,9.889,12.541,13.983,12.615000000000002,14.113999999999999L2.8740000000000023,23.854999999999997L2,29.976L7,30V28H10V25H14V21H17L17.738,19.287C17.912,19.391,22.087,21.487,22.087,21.487C22.943,21.915999999999997,24.079,21.613999999999997,24.61,20.816999999999997L29.646,13.263999999999996C30.178,12.467,30.058,11.26,29.381,10.583ZM6.115,25.348L4.8790000000000004,24.112L13.392,15.598999999999998L14.628,16.834999999999997L6.115,25.348ZM27.056,13.575L25.819000000000003,14.812C25.479000000000003,15.152,24.923000000000002,15.152,24.583000000000002,14.812L17.165000000000003,7.393C16.824,7.053,16.824,6.497,17.165000000000003,6.157L18.4,4.92C18.74,4.58,19.296,4.58,19.636,4.92L27.055,12.338000000000001C27.396,12.679,27.396,13.235,27.056,13.575Z" stroke-width="0" transform="matrix(1,0,0,1,0,0)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                                </svg></span>
                                        </div>
                                        <div class="starting">Starting at</div>
                                        <div class="price">₹2399<span>/year</span></div>
                                    </div>
                                    <ul class="options">
                                        <li class="active"><span><i class="fa fa-check"></i></span>Responsive Design
                                        </li>
                                        <li class="active"><span><i class="fa fa-check"></i></span>Styled elements
                                        </li>
                                        <li class="active"><span><i class="fa fa-check"></i></span>Easy Setup
                                        </li>
                                    </ul>
                                    <div class="bottom-box">
                                        <a href="/shop" class="more">Read More <span class="fa fa-angle-right"></span></a>
                                        <div class="rating-box">
                                            <div style="width: 100%" class="rating">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="73px" height="12px" viewBox="0 0 73 12" enable-fwb-bg="new 0 0 73 12" xml:space="preserve">
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="6.5,0 8,5 13,5 9,7.7 10,12 6.5,9.2 3,12 4,7.7 0,5 5,5"></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="66.5,0 68,5 73,5 69,7.7 70,12 66.5,9.2 63,12 64,7.7 60,5 65,5 "></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="21.5,0 23,5 28,5 24,7.7 25,12 21.5,9.2 18,12 19,7.7 15,5 20,5 "></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="51.5,0 53,5 58,5 54,7.7 55,12 51.5,9.2 48,12 49,7.7 45,5 50,5 "></polygon>
                                                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#1e1e1e" points="36.5,0 38,5 43,5 39,7.7 40,12 36.5,9.2 33,12 34,7.7 30,5 35,5 "></polygon>
                                                </svg>
                                            </div>
                                        </div><a href="./payscript.php?price=2399" class="btn btn-lg btn-danger clearfix">Buy Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to validate text inputs
            function validateTextInput(input, errorMessage) {
                if (input.value.trim() === '') {
                    errorMessage.style.display = 'block';
                    input.style.borderColor = 'red';
                    return false;
                } else {
                    errorMessage.style.display = 'none';
                    input.style.borderColor = '';
                    return true;
                }
            }

            // Function to validate email
            function validateEmail(emailInput, emailError) {
                var emailRegex = /^\S+@\S+\.\S+$/; // Basic email validation regex
                if (emailInput.value.trim() === "") {
                    emailError.textContent = "*Email is required";
                    emailError.style.display = 'block';
                    emailInput.classList.add("is-invalid");
                    return false;
                } else if (!emailRegex.test(emailInput.value)) {
                    emailError.textContent = "*Please enter a valid email address";
                    emailError.style.display = 'block';
                    emailInput.classList.add("is-invalid");
                    return false;
                } else {
                    emailError.textContent = "";
                    emailError.style.display = 'none';
                    emailInput.classList.remove("is-invalid");
                    return true;
                }
            }

            // Function to validate password
            function validatePassword(passwordInput, passwordError) {
                var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                if (passwordInput.value.trim() === "") {
                    passwordError.textContent = "*Password is required";
                    passwordError.style.display = 'block';
                    passwordInput.classList.add("is-invalid");
                    return false;
                } else if (!passwordRegex.test(passwordInput.value)) {
                    passwordError.textContent = "*Password must be at least 8 characters long, \n*contain one uppercase letter, \n*one lowercase letter, \n*one numeric digit, \n*one special character and \n*one alphabetical character";
                    passwordError.style.display = 'block';
                    passwordInput.classList.add("is-invalid");
                    return false;
                } else {
                    passwordError.textContent = "";
                    passwordError.style.display = 'none';
                    passwordInput.classList.remove("is-invalid");
                    return true;
                }
            }

            // Function to validate confirm password
            function validateConfirmPassword(passwordInput, confirmPasswordInput, confirmPasswordError) {
                if (confirmPasswordInput.value.trim() === "") {
                    confirmPasswordError.textContent = "*Confirm password is required";
                    confirmPasswordError.style.display = 'block';
                    confirmPasswordInput.classList.add("is-invalid");
                    return false;
                } else if (passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordError.textContent = "*Passwords do not match";
                    confirmPasswordError.style.display = 'block';
                    confirmPasswordInput.classList.add("is-invalid");
                    return false;
                } else {
                    confirmPasswordError.textContent = "";
                    confirmPasswordError.style.display = 'none';
                    confirmPasswordInput.classList.remove("is-invalid");
                    return true;
                }
            }

            // Function to validate phone number
            function validatePhoneNumber(phoneNumberInput, phoneNumberError) {
                var phoneNumberRegex = /^\d+$/; // Basic phone number validation regex
                if (phoneNumberInput.value.trim() === "") {
                    phoneNumberError.textContent = "*Phone number is required";
                    phoneNumberError.style.display = 'block';
                    phoneNumberInput.classList.add("is-invalid");
                    return false;
                } else if (!phoneNumberRegex.test(phoneNumberInput.value)) {
                    phoneNumberError.textContent = "*Please enter a valid phone number";
                    phoneNumberError.style.display = 'block';
                    phoneNumberInput.classList.add("is-invalid");
                    return false;
                } else {
                    phoneNumberError.textContent = "";
                    phoneNumberError.style.display = 'none';
                    phoneNumberInput.classList.remove("is-invalid");
                    return true;
                }
            }

            // Event listener for input fields to remove validation when user starts typing
            var formControls = document.querySelectorAll('.form-control');
            formControls.forEach(function(control) {
                control.addEventListener('input', function() {
                    var errorMessage = this.nextElementSibling;
                    validateTextInput(this, errorMessage);
                });
            });

            // Event listener for email input
            document.getElementById('emailInput').addEventListener('input', function() {
                var emailError = document.getElementById("emailError");
                validateEmail(this, emailError);
            });

            // Event listener for password input
            document.getElementById('password').addEventListener('input', function() {
                var passwordError = document.getElementById("passwordError");
                validatePassword(this, passwordError);
            });

            // Event listener for confirm password input
            document.getElementById('confirmPassword').addEventListener('input', function() {
                var passwordInput = document.getElementById('password');
                var confirmPasswordError = document.getElementById("confirmPasswordError");
                validateConfirmPassword(passwordInput, this, confirmPasswordError);
            });

            // Event listener for phone number input
            document.getElementById('phoneNumber').addEventListener('input', function() {
                var phoneNumberError = document.getElementById("phoneNumberError");
                validatePhoneNumber(this, phoneNumberError);
            });

            // Event listener for next button
            var nextButtons = document.querySelectorAll('.nextBtn');
            nextButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    var allValid = true;
                    formControls.forEach(function(control) {
                        var errorMessage = control.nextElementSibling;
                        allValid = validateTextInput(control, errorMessage) && allValid;
                    });

                    var emailError = document.getElementById("emailError");
                    allValid = validateEmail(document.getElementById('emailInput'), emailError) && allValid;

                    var passwordError = document.getElementById("passwordError");
                    allValid = validatePassword(document.getElementById('password'), passwordError) && allValid;

                    var confirmPasswordError = document.getElementById("confirmPasswordError");
                    allValid = validateConfirmPassword(document.getElementById('password'), document.getElementById('confirmPassword'), confirmPasswordError) && allValid;

                    var phoneNumberError = document.getElementById("phoneNumberError");
                    allValid = validatePhoneNumber(document.getElementById('phoneNumber'), phoneNumberError) && allValid;

                    if (allValid) {
                        // Proceed to the next step
                        var currentStep = this.closest('.setup-content');
                        var nextStep = currentStep.nextElementSibling;
                        if (nextStep) {
                            nextStep.style.display = 'block';
                            currentStep.style.display = 'none';
                        }
                    }
                });
            });

            // Event listener for previous button
            var prevButtons = document.querySelectorAll('.prevBtn');
            prevButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    var currentStep = this.closest('.setup-content');
                    var prevStep = currentStep.previousElementSibling;
                    if (prevStep) {
                        prevStep.style.display = 'block';
                        currentStep.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn'),
                allPrevBtn = $('.prevBtn');

            allWells.hide();

            navListItems.click(function(e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-primary').addClass('btn-default');
                    $item.addClass('btn-primary');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allPrevBtn.click(function() {
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

                prevStepWizard.removeAttr('disabled').trigger('click');
            });

            allNextBtn.click(function() {
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for (var i = 0; i < curInputs.length; i++) {
                    if (!curInputs[i].validity.valid) {
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

                if (isValid) {
                    if (curStepBtn === "step-2") {
                        // Submit the form when on step 2
                        $('#societyForm').submit();
                    } else {
                        nextStepWizard.removeAttr('disabled').trigger('click');
                    }
                }
            });

            $('div.setup-panel div a.btn-primary').trigger('click');
        });
    </script>



    <script>
        function previewLogo(event) {
            const logoPreview = document.getElementById('logoPreview');
            const logoInput = event.target;

            if (logoInput.files && logoInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    logoPreview.setAttribute('src', e.target.result);
                    logoPreview.style.display = 'block';
                }

                reader.readAsDataURL(logoInput.files[0]);
            }
        }
    </script>

    <hr style="margin-top: 5%">

    <?php include './footer.php'; ?>
</body>

</html>