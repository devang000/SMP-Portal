<?php
include 'conn.php';
session_start();

// Assuming $username is already defined or fetched from somewhere
$username = $_SESSION['user_name'];


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which form was submitted
    if (isset($_POST['formType']) && $_POST['formType'] == 'changePassword') {
        // Retrieve form data
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];

        // Prepare the SQL statement to fetch the current password
        $sql = "SELECT password FROM residents WHERE firstname = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if query executed successfully and if there's at least one row
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the row
            $row = mysqli_fetch_assoc($result);

            if ($currentPassword === $row['password']) { // Compare passwords directly
                // Prepare the SQL statement to update the password
                $update_stmt = $conn->prepare("UPDATE residents SET password = ? WHERE firstname = ?");

                // Bind parameters
                $update_stmt->bind_param("ss", $newPassword, $username);

                // Execute the statement
                if ($update_stmt->execute()) {
                    // Password updated successfully
                    echo '<script>alert("Password updated successfully"); window.location.href="./users-profile.php"</script>';
                    exit();
                } else {
                    // Error updating password
                    //echo "Error updating password: " . $update_stmt->error;
                }
            } else {
                // Incorrect current password
                echo '<script>alert("Incorrect current password!"); window.location.href="./users-profile.php"</script>';
                exit();
            }
        }
    } else {
        // Error fetching resident data
        //echo "Error fetching resident data: " . mysqli_error($conn);
    }
}


// Fetch data from the database
$sql = "SELECT * FROM residents WHERE firstname = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if query executed successfully and if there's at least one row
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the row
    $row = mysqli_fetch_assoc($result);

    // Check if $row is not null before accessing its elements
    if ($row) {
        // Store fetched data into session variables
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['phone'] = $row['phone_number'];
        $_SESSION['city'] = $row['city'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['pincode'] = $row['pincode'];
    } else {
        // Handle the case where $row is null, e.g., by setting default values or redirecting
        echo "No resident found with the name: " . htmlspecialchars($username);
        // Optionally, redirect or set default values for session variables
    }
} else {
    // Handle the case where the query fails or no rows are returned
    //echo "Error fetching resident data: " . mysqli_error($conn);
    // Optionally, redirect or set default values for session variables
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == UPLOAD_ERR_OK) {
        // Define the upload directory
        $uploadDir = './uploaded_img/'; // Make sure this directory exists and is writable
        $uploadFile = $uploadDir . basename($_FILES['profileImage']['name']);

        // Move the uploaded file to the upload directory
        if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $uploadFile)) {
            // Update the database with the new file path
            $update_stmt = $conn->prepare("UPDATE residents SET photo = ? WHERE email = ?");
            $update_stmt->bind_param("ss", $uploadFile, $username);

            if ($update_stmt->execute()) {
                // Update session variable with the new image path
                $_SESSION['user_profile_picture'] = $uploadFile;
                echo '<script>alert("Profile image updated successfully"); window.location.href="./users-profile.php"</script>';
                exit();
            } else {
                echo "Error updating profile image: " . $update_stmt->error;
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "No image uploaded or upload error detected.";
    }

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $society = $_POST['society'];
    $flatNo = $_POST['flatNo'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $phone = $_POST['phone'];
    $twitter = $_POST['twitter'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $linkdin = $_POST['linkdin'];

    // Prepare the SQL statement
    $update_stmt = $conn->prepare("UPDATE residents SET firstname=?, lastname=?, dob=?, email=?, society=?, flatNo=?, address=?, city=?, pincode=?, phone_number=?, twitter=?, facebook=?, instagram=?, linkdin=? WHERE email=?");

    // Bind the parameters
    $update_stmt->bind_param("sssssssssssssss", $firstname, $lastname, $dob, $email, $society, $flatNo, $address, $city, $pincode, $phone, $twitter, $facebook, $instagram, $linkdin, $email);

    // Execute the statement
    if ($update_stmt->execute()) {
        // Update session variables
        $_SESSION['user_name'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['dob'] = $dob;
        $_SESSION['address'] = $address;
        $_SESSION['city'] = $city;
        $_SESSION['pincode'] = $pincode;
        $_SESSION['phone'] = $phone;
        $_SESSION['flatNo'] = $flatNo;

        // Redirect to the profile page or wherever you want
        echo '<script>alert("Records Updated successfully"); window.location.href="./users-profile.php"</script>';

        exit();
    } else {
        echo "Error updating record: " . $update_stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>User-Profile | SMP-Portal</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="./img/favicon.ico" rel="icon">


    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="#" class="logo d-flex align-items-center">
                <!-- <img src="" alt=""> -->
                <span class="d-none d-lg-block"><?php echo $_SESSION['society_name']; ?></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <!-- <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div>End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-danger badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" style="border-top: 5px solid #FFE600;">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Atque rerum nesciunt</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Dicta reprehenderit</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->



                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <div style="
                        width: 40px;
                        height: auto; 
                        border-radius: 50%;
                        overflow: hidden;">
                            <img src="<?php echo $_SESSION['user_profile_picture']; ?>" alt="Profile" class="rounded-circle" style="width: 100%; height:100% object-fit: cover;">
                        </div>
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['user_name'] . " " . $_SESSION["lastname"] ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="border-top: 4px solid #FFD700">

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="./users-profile.php">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="custom">
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="index.html">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="users-profile.html">
                    <i class="bi bi-calendar-week"></i>
                    <span>Book Amenities</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-faq.html">
                    <i class="bi bi-megaphone"></i>
                    <span>Announcements</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-contact.html">
                    <i class="bi bi-credit-card"></i>
                    <span>My bills</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-register.html">
                    <i class="bi bi-people"></i>
                    <span>Neighbours</span>
                </a>
            </li>

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./Resident_dashboard.php">Home</a></li>
                    <li class="breadcrumb-item">User-Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="text-center card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <div class="profile-picture-container">
                                <img src="<?php echo $_SESSION['user_profile_picture'] ?>" alt="Profile" class="rounded-circle">
                            </div>
                            <h2><?php echo $_SESSION['user_name'] . " " . $_SESSION["lastname"] ?></h2>
                            <br>
                            <h3><?php echo $_SESSION['flatNo']; ?><br><?php echo $_SESSION['society_name']; ?></h3>
                            <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $_SESSION['user_name'] . " " . $_SESSION["lastname"]; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $_SESSION['email']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone No:</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $_SESSION['phone']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">City</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $_SESSION['city']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $_SESSION['address']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Pincode</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $_SESSION['pincode']; ?></div>
                                    </div>
                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" id="editProfile">
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <!-- Add an ID to the image tag for easier selection -->
                                                <img id="profileImage" src="<?php echo $_SESSION['user_profile_picture']; ?>" alt="Profile">
                                                <div class="pt-2">
                                                    <!-- Add an ID to the anchor tag for easier selection -->
                                                    <a href="#" id="uploadProfileImage" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-pencil"></i>&nbsp; Chnage</a>
                                                    <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    // Create the file input element
                                                    var fileInput = document.createElement('input');
                                                    fileInput.type = 'file';
                                                    fileInput.name = 'profileImage'; // Make sure this matches the name attribute in your PHP code
                                                    fileInput.style.display = 'none'; // Hide the input

                                                    // Append the file input to the form
                                                    document.getElementById('editProfile').appendChild(fileInput);

                                                    // Get the upload button
                                                    var uploadButton = document.getElementById('uploadProfileImage');

                                                    // Get the image tag
                                                    var profileImage = document.getElementById('profileImage');

                                                    // Trigger file input click event when the upload button is clicked
                                                    uploadButton.addEventListener('click', function(e) {
                                                        e.preventDefault(); // Prevent default anchor behavior
                                                        fileInput.click(); // Click the file input
                                                    });

                                                    // When a file is selected, update the src attribute of the image tag
                                                    fileInput.addEventListener('change', function() {
                                                        // Check if any file is selected
                                                        if (fileInput.files && fileInput.files[0]) {
                                                            var reader = new FileReader();

                                                            reader.onload = function(e) {
                                                                // Update the src attribute of the image tag with the selected image URL
                                                                profileImage.src = e.target.result;
                                                            }

                                                            // Read the selected file as a data URL
                                                            reader.readAsDataURL(fileInput.files[0]);
                                                        }
                                                    });
                                                });
                                            </script>

                                        </div>
                                        <div class="row mb-3">
                                            <label for="firstname" class="col-md-4 col-lg-3 col-form-label">First Name:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="firstname" type="text" class="form-control" id="firstname" value="<?php echo $_SESSION['user_name']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Last Name:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="lastname" type="text" class="form-control" id="lastname" value="<?php echo $_SESSION['lastname']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="dob" class="col-md-4 col-lg-3 col-form-label">Date of Birth:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="dob" type="date" class="form-control" id="dob" value="<?php echo $_SESSION['dob']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="email" disabled value="<?php echo $_SESSION['email']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="society" class="col-md-4 col-lg-3 col-form-label">Society:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="society" type="text" class="form-control" id="society" value="<?php echo $_SESSION['society_name']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="flatNo" class="col-md-4 col-lg-3 col-form-label">Flat No:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="flatNo" type="text" class="form-control" id="flatNo" value="<?php echo $_SESSION['flatNo']; ?>">
                                            </div>
                                        </div>



                                        <div class="row mb-3">
                                            <label for="address" class="col-md-4 col-lg-3 col-form-label">Address:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="address" class="form-control" id="about" style="height: 100px"><?php echo $_SESSION['address']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="company" class="col-md-4 col-lg-3 col-form-label">City:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="city" type="text" class="form-control" id="city" value="<?php echo $_SESSION['city']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="pincode" class="col-md-4 col-lg-3 col-form-label">Pincode:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="pincode" type="text" class="form-control" id="pincode" value="<?php echo $_SESSION['pincode']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone No.</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="phone" value="<?php echo $_SESSION['phone']; ?>">
                                            </div>
                                        </div>



                                        <div class="row mb-3">
                                            <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Linkdin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile:</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="linkdin" type="text" class="form-control" id="Linkdin" value="https://linkedin.com/#">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-settings">

                                    <!-- Settings Form -->
                                    <form>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="changesMade" checked>
                                                    <label class="form-check-label" for="changesMade">
                                                        Changes made to your account
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="newProducts" checked>
                                                    <label class="form-check-label" for="newProducts">
                                                        Information on new products and services
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="proOffers">
                                                    <label class="form-check-label" for="proOffers">
                                                        Marketing and promo offers
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                                                    <label class="form-check-label" for="securityNotify">
                                                        Security alerts
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End settings Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form method="post" id="changePassword">
                                        <!-- Add a hidden input field to identify this form -->
                                        <input type="hidden" name="formType" value="changePassword">

                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="currentPassword" type="password" class="form-control" id="currentPassword">
                                                <span class="text-danger fw-bold" id="currentPasswordError"></span>
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newPassword" type="password" class="form-control" id="newPassword">
                                                <span class="text-danger fw-bold" id="newPasswordError"></span>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                                <span class="text-danger fw-bold" id="renewPasswordError"></span>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" id="change_password" class="btn btn-primary">Change Password</button>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                // Function to validate the password
                                                function validatePassword(password) {
                                                    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                                                    return regex.test(password);
                                                }

                                                // Function to validate the password confirmation
                                                function validatePasswordConfirmation(newPassword, renewPassword) {
                                                    return newPassword === renewPassword;
                                                }

                                                // Function to check for empty fields
                                                function checkForEmptyFields() {
                                                    var currentPassword = document.getElementById('currentPassword').value;
                                                    var newPassword = document.getElementById('newPassword').value;
                                                    var renewPassword = document.getElementById('renewPassword').value;
                                                    return currentPassword.trim() !== '' && newPassword.trim() !== '' && renewPassword.trim() !== '';
                                                }

                                                // Function to update error display and styling
                                                function updateErrorDisplay(inputId, errorMessage, isError) {
                                                    var inputElement = document.getElementById(inputId);
                                                    var errorSpan = document.getElementById(inputId + 'Error');
                                                    if (isError) {
                                                        inputElement.classList.add('input-error');
                                                        errorSpan.textContent = errorMessage;
                                                        inputElement.classList.add('border-danger'); // Add border color
                                                    } else {
                                                        inputElement.classList.remove('input-error');
                                                        errorSpan.textContent = '';
                                                        inputElement.classList.remove('border-danger'); // Remove border color
                                                    }
                                                }

                                                // Event listener for the currentPassword field
                                                document.getElementById('currentPassword').addEventListener('keyup', function() {
                                                    var currentPassword = this.value;
                                                    // Check if the currentPassword field is not empty
                                                    if (currentPassword.trim() !== '') {
                                                        // Remove the error message by calling updateErrorDisplay with the appropriate parameters
                                                        updateErrorDisplay('currentPassword', '', false);
                                                    }
                                                });

                                                // Event listeners for the password fields
                                                document.getElementById('newPassword').addEventListener('keyup', function() {
                                                    var newPassword = this.value;
                                                    var renewPassword = document.getElementById('renewPassword').value;
                                                    var isValid = validatePassword(newPassword) && validatePasswordConfirmation(newPassword, renewPassword);

                                                    // Update error display
                                                    updateErrorDisplay('newPassword', 'Password must be at least 8 characters long, contain one uppercase letter, one lowercase letter, and one special character.', !isValid);
                                                    updateErrorDisplay('renewPassword', 'Passwords do not match.', !isValid);
                                                });

                                                document.getElementById('renewPassword').addEventListener('keyup', function() {
                                                    var newPassword = document.getElementById('newPassword').value;
                                                    var renewPassword = this.value;
                                                    var isValid = validatePassword(newPassword) && validatePasswordConfirmation(newPassword, renewPassword);

                                                    // Update error display
                                                    updateErrorDisplay('newPassword', '*Password must be at least 8 characters long, \ncontain one uppercase letter, \none lowercase letter, \nand one special character.', !isValid);
                                                    updateErrorDisplay('renewPassword', '*Passwords do not match.', !isValid);
                                                });

                                                // Prevent form submission if validation fails or fields are empty
                                                document.getElementById('changePassword').addEventListener('submit', function(e) {
                                                    var currentPassword = document.getElementById('currentPassword').value;
                                                    var newPassword = document.getElementById('newPassword').value;
                                                    var renewPassword = document.getElementById('renewPassword').value;
                                                    if (!validatePassword(newPassword) || !validatePasswordConfirmation(newPassword, renewPassword) || !checkForEmptyFields()) {
                                                        e.preventDefault();
                                                        // Display error messages for empty fields
                                                        if (!checkForEmptyFields()) {
                                                            updateErrorDisplay('currentPassword', '*This field is required.', true);
                                                            updateErrorDisplay('newPassword', '*This field is required.', true);
                                                            updateErrorDisplay('renewPassword', '*This field is required.', true);
                                                        }
                                                    }
                                                });
                                            });
                                        </script>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>SMP - Society Management Portal</span></strong>. All Rights Reserved by Devang Gohil
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>