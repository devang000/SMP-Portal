<?php
include 'conn.php';
session_start();
?>
<?php


// Handle form submission and database insertion here
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    require_once 'conn.php';

    // Retrieve form data
    $eventName = $_POST['eventName'];
    $eventDescription = $_POST['eventDescription'];
    $eventVenue = $_POST['eventVenue'];
    $eventStart = $_POST['eventStart'];
    $eventEnd = $_POST['eventEnd'];

    // Prepare and execute the SQL statement to insert data into the events table
    $stmt = $conn->prepare("INSERT INTO events (eName, eDescription, eVenue, eStartDate, eEndDate) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $eventName, $eventDescription, $eventVenue, $eventStart, $eventEnd);

    if ($stmt->execute()) {
        // If insertion is successful
        echo json_encode(array('status' => 'success', 'message' => 'Event added successfully'));
    } else {
        // If insertion fails
        echo json_encode(array('status' => 'error', 'message' => 'Error adding event'));
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Book Ammeinities</title>
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

                        <li>
                        </li>
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
            <h1>Book Ammeinities</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./Resident_dashboard.php">Home</a></li>
                    <li class="breadcrumb-item">Book Ammenities</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Book your event by clicking on day:)</h5>
                    <div id="calendar"></div>

                    <!-- Bootstrap Modal -->
                    <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="addEventModalLabel">ADD EVENT</h5>
                                    <button type="button" class="close text-white modal-close-btn" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="addEventForm" action="./bookEvent.php" method="post">
                                        <div class="form-group">
                                            <label for="eventName">Event Name:</label>
                                            <input type="text" class="form-control" id="eventName" name="eventName">
                                        </div>
                                        <div class="form-group">
                                            <label for="eventDescription">Event Description:</label>
                                            <textarea class="form-control" id="eventDescription" name="eventDescription"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="eventVenue">Event Venue:</label>
                                            <input type="text" class="form-control" id="eventVenue" name="eventVenue">
                                        </div>
                                        <div class="form-group">
                                            <label for="eventStart">Event Start:</label>
                                            <input type="datetime-local" class="form-control" id="eventStart" name="eventStart">
                                        </div>
                                        <div class="form-group">
                                            <label for="eventEnd">Event End:</label>
                                            <input type="datetime-local" class="form-control" id="eventEnd" name="eventEnd">
                                        </div>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

        <?php
        // Include your database connection file
        require_once 'conn.php';

        // Function to fetch events from the database
        function getEventsFromDatabase()
        {
            global $conn;

            $sql = "SELECT * FROM events";
            $result = $conn->query($sql);

            $events = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $event = array(
                        'title' => $row['eName'],
                        'start' => $row['eStartDate'],
                        'end' => $row['eEndDate'],
                        'backgroundColor' => getRandomColor()
                    );
                    array_push($events, $event);
                }
            }

            return json_encode($events);
        }

        // Function to generate a random color
        function getRandomColor()
        {
            $r = mt_rand(0, 255);
            $g = mt_rand(0, 255);
            $b = mt_rand(0, 255);
            return sprintf("#%02x%02x%02x", $r, $g, $b);
        }
        ?>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'en-in',
                    eventDisplay: 'block',
                    firstDay: 1,
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    editable: false,
                    droppable: false,
                    dateClick: function(info) {
                        $('#addEventModal').modal('show');
                        document.getElementById('eventStart').value = info.dateStr;
                        document.getElementById('eventEnd').value = info.dateStr;
                    },
                    events: <?php echo getEventsFromDatabase(); ?>
                });

                calendar.render();

                $('#addEventModal').on('hidden.bs.modal', function(e) {
                    // Reset the form fields when the modal is closed
                    $('#addEventForm')[0].reset();
                });
                // Close modal when close buttons are clicked
                $('.modal-close-btn, .btn-secondary').click(function() {
                    $('#addEventModal').modal('hide');
                });
                $('#addEventForm').submit(function(event) {
                    event.preventDefault();

                    // Retrieve form data
                    var formData = $(this).serialize();

                    $.ajax({
                        type: 'POST',
                        url: '',
                        data: formData,
                        success: function(response) {
                            console.log(response);
                            $('#addEventModal').modal('hide');
                            window.location.reload;

                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            // Handle errors here
                        }
                    });
                });
            });
        </script>


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