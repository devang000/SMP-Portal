<?php
session_start();
include './conn.php';

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Announcements</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- FullCalendar CSS -->
    <link href="https://fullcalendar.io/releases/main/core/main.min.css" rel="stylesheet" />
    <!-- FullCalendar JS -->
    <script src="https://fullcalendar.io/releases/main/core/main.min.js"></script>
    <!-- FullCalendar CSS -->
    <link href="path/to/fullcalendar/main.css" rel="stylesheet" />
    <!-- FullCalendar JS -->
    <script src="path/to/fullcalendar/main.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include FullCalendar CSS -->
    <link href="https://fullcalendar.io/releases/main/core/main.min.css" rel="stylesheet" />
    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include FullCalendar JS -->
    <script src="https://fullcalendar.io/releases/main/core/main.min.js"></script>
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

    <style>
        label {
            font-weight: bold;
        }
    </style>

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
                <a class="nav-link collapsed" href="./gateKeeperDashboard.php">
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
                <a class="nav-link " href="./announcement2.php">
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
            <h1>Announcements</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./gateKeeperDashboard.php">Home</a></li>
                    <li class="breadcrumb-item">Announcements</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Announcements</h5>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><img src="assets/img/news-1.jpg" height="auto" width="150px" alt=""></td>
                                <td><a href="#">Annual General Meeting (AGM) Notice</a></td>
                                <td>Our society's AGM is scheduled for next Saturday at 10:00 AM in the community hall. Join us to discuss important matters and elect new committee members.</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><img src="assets/img/news-2.jpg" height="auto" width="150px" alt=""></td>
                                <td><a href="#">Community Cleanup Drive</a></td>
                                <td>Let's come together for a community cleanup drive on Sunday morning at 8:00 AM. Help us maintain the cleanliness of our neighborhood and make it a better place to live.</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><img src="assets/img/news-3.jpg" height="auto" width="150px" alt=""></td>
                                <td><a href="#">Summer Picnic Day</a></td>
                                <td>Get ready for a fun-filled summer picnic day on the upcoming Friday. Enjoy games, music, and delicious food with your fellow society members. Don't miss out on the excitement!</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><img src="assets/img/news-4.jpg" height="auto" width="150px" alt=""></td>
                                <td><a href="#">Book Donation Drive</a></td>
                                <td>We're organizing a book donation drive starting from next Monday. Contribute your old books to support education and literacy initiatives in underprivileged communities.</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><img src="assets/img/news-5.jpg" height="auto" width="150px" alt=""></td>
                                <td><a href="#">Fitness Workshop</a></td>
                                <td>Join us for a fitness workshop on Thursday evening at 6:00 PM. Learn about staying healthy and fit through various exercises and nutrition tips. Let's prioritize our well-being together!</td>
                            </tr>
                            <tr>
                                <td>6 </td>
                                <td><img src="assets/img/news-5.jpg" height="auto" width="150px" alt=""></td>
                                <td><a href="#">Green Initiative: Tree Plantation Drive</a></td>
                                <td>Join us for our upcoming tree plantation drive on Saturday morning at 9:00 AM. Let's contribute to a greener environment by planting trees in our community. Together, we can make a positive impact on our planet for future generations.</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </section>

        <!-- New Ticket Modal -->
        <div class="modal fade" id="newTicketModal" tabindex="-1" role="dialog" aria-labelledby="newTicketModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title fw-bold" id="newTicketModalLabel"><i class="bi bi-people"></i>&nbsp; New Visitor</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for ticket details -->
                        <form method="post" action="./visitors.php">
                            <div class="table-responsive">
                                <table class="table table-striped p-0">
                                    <tbody>
                                        <tr>
                                            <th>Visitor Name:</th>
                                            <td><input required type="text" class="form-control" id="vname" name="vname" placeholder="Enter Full Name"></td>
                                        </tr>

                                        <tr>
                                            <th>Visitor Mobile No:</th>
                                            <td>
                                                <input required type="text" class="form-control" id="vphone" name="vphone" placeholder="Enter Visitor Contact No">
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Visitor Vehicle No:</th>
                                            <td><input required class="form-control" id="vehicleNo" name="vehicleNo" rows="3" placeholder="Enter Visitor Vehicle No" value="N/A"></td>
                                        </tr>
                                        <tr>
                                            <th>Whom to visit:</th>
                                            <td><input required class="form-control" id="residentName" name="residentName" rows="3" placeholder="Enter resident full name"></td>
                                        </tr>
                                        <tr>
                                            <th>Purpose of visit:</th>
                                            <td><textarea required class="form-control" id="purpose" name="purpose" rows="3" placeholder="Enter purpose of visit"></textarea></td>
                                        </tr>
                                        <tr>
                                            <th>Entry Date and Time:</th>
                                            <td><input type="datetime-local" class="form-control" id="entry" name="entry" value=""></td>
                                        </tr>
                                        <!-- <tr>
                                            <th>Exit Date and Time:</th>
                                            <td><input type="datetime-local" class="form-control" id="exit" name="exit" value=""></td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Add new Visitor</button>
                            </div>
                        </form>


                        <script>
                            // Get current date and time in ISO 8601 format
                            var now = new Date().toISOString().slice(0, 16);
                            document.getElementById("entry").value = now;
                        </script>

                    </div>

                </div>
            </div>
        </div>

        <!-- Edit Ticket Modal -->
        <div class="modal fade" id="editTicketModal" tabindex="-1" role="dialog" aria-labelledby="editTicketModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark fw-bold">
                        <h5 class="modal-title fw-bold" id="editTicketModalLabel"><i class="bi bi-pencil"></i>&nbsp; Edit Ticket</h5>
                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for editing ticket details -->
                        <form method="post" action="./editcomplaint.php">
                            <div class="table-responsive">
                                <table class="table table-striped p-0">
                                    <tbody>
                                        <tr>
                                            <td>Email:</td>
                                            <td><input required type="email" class="form-control" id="editTicketEmail" name="editTicketEmail" placeholder="Email address"></td>
                                        </tr>
                                        <tr>
                                            <td>Complaint Type:</td>
                                            <td>
                                                <select required class="form-control form-select" id="editTicketType" name="editTicketType">
                                                    <option value="">Select Complaint Type</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Security">Security</option>
                                                    <option value="Cleanliness">Cleanliness</option>
                                                    <option value="Other">Other</option>
                                                    <!-- Add more options as needed -->
                                                </select>
                                            </td>
                                        </tr>
                                        <tr id="editOtherTypeInputRow" style="display: none;">
                                            <td>New Complaint Type:</td>
                                            <td><input type="text" class="form-control" id="editNewComplaintType" name="editNewComplaintType" placeholder="Enter new complaint type"></td>
                                        </tr>
                                        <tr>
                                            <td>Complaint Description:</td>
                                            <td><textarea required class="form-control" id="editTicketDescription" name="editTicketDescription" rows="3" placeholder="Enter complaint description"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Date and Time of Occurrence:</td>
                                            <td><input type="datetime-local" class="form-control" id="editTicketDateTime" name="editTicketDateTime" value=""></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i>&nbsp; Save Changes</button>
                            </div>
                        </form>
                        <script>
                            function showEditOtherInput() {
                                var editTicketType = document.getElementById("editTicketType").value;
                                var editOtherTypeInputRow = document.getElementById("editOtherTypeInputRow");
                                if (editTicketType === "Other") {
                                    editOtherTypeInputRow.style.display = "table-row";
                                } else {
                                    editOtherTypeInputRow.style.display = "none";
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Pass the PHP_SELF value to JavaScript -->


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>








        <!-- ======= Footer ======= -->
        <footer id="footer" class="footer justify-content-center">
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