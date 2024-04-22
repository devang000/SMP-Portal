<?php
include 'conn.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Resident Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Favicons -->
    <link href="./img/favicon.ico" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
                            <a href="./announcement.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Annual General Meeting (AGM) Notice</h4>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Community Cleanup Drive</h4>

                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Summer Picnic Day</h4>

                                <p>2 hrs. ago</p>
                            </div>

                        <li>
                        </li>
                        <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                    <i class="bi bi-info-circle text-primary"></i>
                    <div>
                        <h4>Book Donation Drive</h4>
                        <p>4 hrs. ago</p>
                    </div>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>
                <li class="dropdown-footer">
                    <a href="./announcement.php">Show all notifications</a>
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
                        <a class="dropdown-item d-flex align-items-center" href="#" onclick="showSignOutConfirmation()">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>
                    <script>
                        function showSignOutConfirmation() {
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't to loggedout after that won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, sign out!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect to the logout script or perform the sign-out logic here
                                    window.location.href = './logout.php'; // Example logout script
                                }
                            })
                        }
                    </script>

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
                <a class="nav-link collapsed" href="./bookEvent.php">
                    <i class="bi bi-calendar-week"></i>
                    <span>Book Amenities</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="./announcement.php">
                    <i class="bi bi-megaphone"></i>
                    <span>Announcements</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="./mybills.php">
                    <i class="bi bi-credit-card"></i>
                    <span>My bills</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="./neighbours.php">
                    <i class="bi bi-people"></i>
                    <span>Neighbours</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="./mycomplaints.php">
                    <i class="bi bi-ticket-perforated"></i>
                    <span>Raise Ticket</span>
                </a>
            </li>

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./society_index.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- home Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card" style="border-top: 5px solid blue;">
                                <div class="card-body">
                                    <h5 class="card-title">My Home</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-house-door-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 style="font-size: 20px;"><?php echo $_SESSION['flatNo']; ?></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- bill Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card" style="border-top: 5px solid #00eb00;">
                                <div class="card-body">
                                    <h5 class="card-title">Total Bill Ammount</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-rupee"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>₹7,264</h6>
                                            <span class="text-success fw-bold" style="font-size: 13px;      ">incl.</span><span class="text-muted small ps-1" style="font-size: 13px;">Maint. + Electricity + Gas</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End bill Card -->

                        <!-- My Event -->


                        <!-- My Event -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body" style="border-top: 5px solid #FF8800;">
                                    <h5 class="card-title">My Booked Events</h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Event Name</th>
                                                <th scope="col">Event Description</th>
                                                <th scope="col">Start Date/Time</th>
                                                <th scope="col">End Date/Time</th>
                                                <th scope="col">Booking Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Include your database connection file
                                            require_once 'conn.php';

                                            // Fetch events from the database
                                            $sql = "SELECT * FROM events";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                // Output data of each row
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<th scope='row'><a href='#'>" . $row['eID'] . "</a></th>";
                                                    echo "<td>" . $row['eName'] . "</td>";
                                                    echo "<td><a href='#' class='text-primary'>" . $row['eDescription'] . "</a></td>";
                                                    echo "<td>" . $row['eStartDate'] . "</td>";
                                                    echo "<td>" . $row['eEndDate'] . "</td>";
                                                    $badge = '';
                                                    switch ($row['status']) {
                                                        case 'p':
                                                            $badge = '<span class="badge bg-warning">Pending</span>';
                                                            break;
                                                        case 'y':
                                                            $badge = '<span class="badge bg-success">Booked</span>';
                                                            break;
                                                        case 'n':
                                                            $badge = '<span class="badge bg-danger">Rejected</span>';
                                                            break;
                                                        default:
                                                            $badge = '<span class="badge bg-secondary">Unknown</span>';
                                                    }

                                                    echo "<td>" . $badge . "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='6'>No events found</td></tr>";
                                            }

                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div><!-- End Event-->


                        <!-- My Complaints -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body" style="border-top: 5px solid #AE00FF;">
                                    <h5 class="card-title">My Complaints Tickets</h5>
                                    <div class="table-responsive"> <!-- Added to make the table scrollable -->
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Complaint <br> Type</th>
                                                    <th scope="col">Complaint <br> Description</th>
                                                    <th scope="col">Email <br> Address</th>
                                                    <th scope="col">Complaint <br> issue date</th>
                                                    <th scope="col">Complaint <br> solve date</th>
                                                    <th scope="col">Complaint <br> Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Assuming you have already established a database connection

                                                // Perform SQL query to fetch records from the complaints table
                                                $sql = "SELECT * FROM complaints";
                                                $result = mysqli_query($conn, $sql);

                                                // Check if any records were returned
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Loop through each row of data
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        // Output the data in the table format
                                                        echo "<tr>";
                                                        echo "<td>" . $row['cid'] . "</td>";
                                                        echo "<td>" . $row['complaint_type'] . "</td>";
                                                        echo "<td>" . $row['complaint_description'] . "</td>";

                                                        // Check if email_id exists in the row
                                                        if (isset($row['email'])) {
                                                            echo "<td>" . $row['email'] . "</td>";
                                                        } else {
                                                            echo "<td>N/A</td>";
                                                        }

                                                        // Check if complaint_issue_date exists in the row
                                                        if (isset($row['complaint_occured_date'])) {
                                                            echo "<td>" . $row['complaint_occured_date'] . "</td>";
                                                        } else {
                                                            echo "<td>N/A</td>";
                                                        }

                                                        // Check if complaint_resolve_date exists in the row
                                                        if (isset($row['complaint_resolved_date'])) {
                                                            echo "<td>" . $row['complaint_resolved_date'] . "</td>";
                                                        } else {
                                                            echo "<td>N/A</td>";
                                                        }

                                                        $badge = '';
                                                        switch ($row['complaint_status']) {
                                                            case 'P':
                                                                $badge = '<span class="badge bg-warning">Pending</span>';
                                                                break;
                                                            case 'y':
                                                                $badge = '<span class="badge bg-success">Booked</span>';
                                                                break;
                                                            case 'n':
                                                                $badge = '<span class="badge bg-danger">Rejected</span>';
                                                                break;
                                                            default:
                                                                $badge = '<span class="badge bg-secondary">Unknown</span>';
                                                        }

                                                        echo "<td>" . $badge . "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    // If no records found, display a message
                                                    echo "<tr><td colspan='7'>No complaints found.</td></tr>";
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div> <!-- End table-responsive -->
                                </div>
                            </div>
                        </div><!-- End complaints-->


                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- Recent Activity -->
                    <div class="card">
                        <div class="card-body" style="border-top: 5px solid yellow;">
                            <h5 class="card-title">Upcomming Events</h5>

                            <div class="activity">
                                <div class="activity-item d-flex">
                                    <div class="activite-label">31st Mar</div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        Aman's Birthday Party
                                        <a href="#" class="fw-bold text-dark">venue: club house</a>
                                        <br>
                                        8:00 pm
                                    </div>
                                </div><!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label">3rd Apr</div>
                                    <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                    <div class="activity-content">
                                        Sonawala's Anniversary Party
                                        <br>
                                        <a href="#" class="fw-bold text-dark">venue: society garden</a>
                                        <br>
                                        7:00 pm
                                    </div>
                                </div><!-- End activity item-->


                                <div class="activity-item d-flex">
                                    <div class="activite-label">9th Apr</div>
                                    <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                                    <div class="activity-content">
                                        Society Meeting
                                        <br>
                                        <a href="#" class="fw-bold text-dark">venue: society office</a>
                                        <br>
                                        7:00 pm
                                    </div>
                                </div><!-- End activity item-->


                                <div class="activity-item d-flex">
                                    <div class="activite-label">10th Apr</div>
                                    <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                                    <div class="activity-content">
                                        Vian's Engagement Ceremony
                                        <br>
                                        <a href="#" class="fw-bold text-dark">venue: common hall</a>
                                        <br>
                                        8:00 am
                                    </div>
                                </div><!-- End activity item-->


                                <div class="activity-item d-flex">
                                    <div class="activite-label">11th Apr</div>
                                    <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                    <div class="activity-content">
                                        Ramadan Eid celebration
                                        <a href="#" class="fw-bold text-dark">venue: society garden</a>
                                        <br>
                                        6:00 pm
                                    </div>
                                </div><!-- End activity item-->
                            </div>

                        </div>
                    </div><!-- End Recent Activity -->

                    <!-- Announcements -->
                    <div class="card">

                        <div class="card-body pb-0" style="border-top: 5px solid #464646;">
                            <h5 class="card-title">News &amp; Announcements</h5>

                            <div class="news">
                                <div class="post-item clearfix">
                                    <img src="assets/img/news-1.jpg" alt="">
                                    <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
                                    <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="assets/img/news-2.jpg" alt="">
                                    <h4><a href="#">Quidem autem et impedit</a></h4>
                                    <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="assets/img/news-3.jpg" alt="">
                                    <h4><a href="#">Id quia et et ut maxime similique occaecati ut</a></h4>
                                    <p>Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="assets/img/news-4.jpg" alt="">
                                    <h4><a href="#">Laborum corporis quo dara net para</a></h4>
                                    <p>Qui enim quia optio. Eligendi aut asperiores enim repellendusvel rerum cuder...</p>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="assets/img/news-5.jpg" alt="">
                                    <h4><a href="#">Et dolores corrupti quae illo quod dolor</a></h4>
                                    <p>Odit ut eveniet modi reiciendis. Atque cupiditate libero beatae dignissimos eius...</p>
                                </div>

                            </div><!-- End sidebar recent posts-->

                        </div>
                    </div><!-- End News & Updates -->

                </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->

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