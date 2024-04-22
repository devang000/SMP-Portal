<?php
include 'conn.php';
session_start();
?>
<?php


$selectedSociety = ''; // Initialize $selectedSociety to avoid the warning
if (isset($_GET['society'])) {
    $selectedSociety = $_GET['society'];
    $_SESSION["selectedSociety"] = $selectedSociety; // Store the selected society in session
}
//echo $_SESSION["selectedSociety"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>GateKeeper Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <a class="btn btn-outline-danger d-flex align-items-center" href="#" onclick="showSignOutConfirmation()">
                <i class="bi bi-box-arrow-right"></i>&nbsp;
                <span>Sign Out</span>
            </a>

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

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="./gateKeeperDashboard.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="./visitors.php">
                    <i class="bi bi-people"></i>
                    <span>Visitors</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="./announcement2.php">
                    <i class="bi bi-megaphone"></i>
                    <span>Announcements</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="./mycomplaints2.php">
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
                                    <h5 class="card-title">My Identitiy</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person-badge-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 style="font-size: 20px;">GUDT052</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Total  Visiot Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card" style="border-top: 5px solid #00eb00;">
                                <div class="card-body">
                                    <h5 class="card-title">Total Visitors</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <?php
                                            // Query to fetch the total number of records
                                            $sql = "SELECT COUNT(*) AS total_records FROM visitor";
                                            $result = $conn->query($sql);
                                            if ($result && $result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                $total_records = $row['total_records'];
                                            } else {
                                                $total_records = 0;
                                            }
                                            ?>
                                            <h6>
                                                <td><?php echo $total_records; ?></td>
                                            </h6>
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
                                    <h5 class="card-title">Today's Visitor(s)</h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Visitor Name</th>
                                                <th scope="col">Whom to Visit</th>
                                                <th scope="col">Visitor Status</th>
                                                <th scope="col">Gate Pass</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Fetch visitors data from the database
                                            $sql = "SELECT * FROM visitor";
                                            $result = $conn->query($sql);

                                            if ($result) {
                                                if ($result->num_rows > 0) {
                                                    // Output data of each row
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $row["vid"] . "</td>";
                                                        echo "<td>" . $row["vname"] . "</td>";
                                                        echo "<td>" . $row["whomtovisit"] . "</td>";

                                                        // Display status badge based on status value
                                                        echo "<td>";
                                                        if ($row["status"] == "Y") {
                                                            echo "<span class='btn btn-outline-danger btn-sm'><i class='bi bi-box-arrow-in-left'></i>&nbsp; Entered</span>";
                                                        } elseif ($row["status"] == "N") {
                                                            echo "<span class='btn btn-outline-success btn-sm'><i class='fa-solid fa-right-to-bracket'></i>&nbsp; Exited &nbsp;</span>";
                                                        } else {
                                                            echo $row["status"]; // Display status text for other values
                                                        }
                                                        echo "</td>";

                                                        // Add print gate pass button
                                                        echo "<td>";
                                                        echo "<button type='button' class='btn btn-outline-primary'><i class='bi bi-printer-fill'></i></button>";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='5'>No visitors found</td></tr>";
                                                }

                                                // Free result set
                                                $result->close();
                                            } else {
                                                echo "Error: " . $conn->error;
                                            }

                                            // Close the database connection
                                            $conn->close();
                                            ?>
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div><!-- End Event-->

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