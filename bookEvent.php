<?php
include 'conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'conn.php';

    // Check if the form is submitted from the "Edit Event" modal
    if (isset($_POST['eventId'])) {
        // Retrieve form data
        $eventId = $_POST['eventId'];
        $eventName = $_POST['editEventName'];
        $eventDescription = $_POST['editEventDescription'];
        $eventVenue = $_POST['editEventVenue'];
        $eventStart = $_POST['editEventStartDate'];
        $eventEnd = $_POST['editEventEndDate'];

        // Prepare and execute the SQL statement to update the event in the database
        $stmt = $conn->prepare("UPDATE events SET eName = ?, eDescription = ?, eVenue = ?, eStartDate = ?, eEndDate = ? WHERE eID = ?");
        $stmt->bind_param("sssssi", $eventName, $eventDescription, $eventVenue, $eventStart, $eventEnd, $eventId);

        if ($stmt->execute()) {
            echo json_encode(array('status' => 'success', 'message' => 'Event updated successfully'));
        } else {
            // Check for errors
            echo json_encode(array('status' => 'error', 'message' => 'Error updating event: ' . $stmt->error));
        }

        $stmt->close();
    } else {
        // Retrieve form data for adding a new event
        $eventName = $_POST['eventName'];
        $eventDescription = $_POST['eventDescription'];
        $eventVenue = $_POST['eventVenue'];
        $eventStart = $_POST['eventStart'];
        $eventEnd = $_POST['eventEnd'];

        // Prepare and execute the SQL statement to insert a new event into the database
        $stmt = $conn->prepare("INSERT INTO events (eName, eDescription, eVenue, eStartDate, eEndDate, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $eventName, $eventDescription, $eventVenue, $eventStart, $eventEnd, $status);

        // Set the status to 'p' by default
        $status = 'p';

        if ($stmt->execute()) {
            // If insertion is successful
            echo json_encode(array('status' => 'success', 'message' => 'Event added successfully'));
        } else {
            // If insertion fails
            echo json_encode(array('status' => 'error', 'message' => 'Error adding event'));
        }

        // Close statement
        $stmt->close();
    }

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
                <a class="nav-link collapsed" href="./Resident_dashboard.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="./bookEvent.php">
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
                    <h5 class="card-title">Book your event by clicking on date :)</h5>
                    <div id="calendar"></div>

                    <!-- Add event Modal -->
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
                                        <div class="modal-footer bg-body-tertiary p-1">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event Details Modal -->
                    <div class="modal fade" id="eventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-warning text-dark">
                                    <h5 class="modal-title fw-bold" id="eventTitleModal"></h5>
                                    <button type="button btn" class="close text-dark modal-close-btn" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td><strong>Description:</strong></td>
                                                <td><span id="eventDescriptionModal"></span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Venue:</strong></td>
                                                <td><span id="eventVenueModal"></span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Start:</strong></td>
                                                <td><span id="eventStartModal"></span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>End:</strong></td>
                                                <td><span id="eventEndModal"></span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status:</strong></td>
                                                <td><span id="eventStatusModal"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" id="addAnotherEventBtn"><i class="fa fa-pencil"></i>&nbsp; Edit Event</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

            $sql = "SELECT eID, eName, eDescription, eVenue, eStartDate, eEndDate, status FROM events";
            $result = $conn->query($sql);

            $events = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $event = array(
                        'id' => $row['eID'],
                        'title' => $row['eName'],
                        'description' => $row['eDescription'],
                        'venue' => $row['eVenue'],
                        'start' => $row['eStartDate'],
                        'end' => $row['eEndDate'],
                        'status' => $row['status'], // Include the status field
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
                        // Check if there are any events on the clicked date
                        var clickedDate = info.dateStr;
                        var eventsOnClickedDate = calendar.getEvents().filter(function(event) {
                            return event.startStr <= clickedDate && event.endStr >= clickedDate;
                        });

                        if (eventsOnClickedDate.length > 0) {
                            // If there are events on the clicked date, show the event details modal
                            var eventData = eventsOnClickedDate[0].extendedProps;
                            $('#eventModalTitle').text(eventData.title);
                            $('#eventDescription').text(eventData.description);
                            $('#eventVenue').text(eventData.venue);
                            $('#eventStart').text(eventData.start);
                            $('#eventEnd').text(eventData.end);

                            $('#eventDetailsModal').modal('show');
                        } else {
                            // If there are no events on the clicked date, show the add event modal
                            $('#addEventModal').modal('show');
                            // Set the start and end date fields to the clicked date
                            document.getElementById('eventStart').value = clickedDate;
                            document.getElementById('eventEnd').value = clickedDate;
                        }
                    },

                    eventClick: function(info) {
                        var event = info.event;
                        var eventData = event.extendedProps;

                        $('#eventTitleModal').text(event.title);

                        $('#eventDescriptionModal').text(eventData.description);
                        $('#eventVenueModal').text(eventData.venue);
                        $('#eventStartModal').text(event.start.toLocaleString());
                        $('#eventEndModal').text(event.end.toLocaleString());
                        $('#eventStatusModal').text(eventData.status); // This should now work
                        $('#eventDetailsModal').modal('show');
                    },

                    events: <?php echo getEventsFromDatabase(); ?>
                });

                calendar.render();

                // Event listener for the modal close button
                $(document).on('click', '#eventDetailsModal .modal-close-btn, #eventDetailsModal .btn-danger', function() {
                    $('#eventDetailsModal').modal('hide');
                });

                // Add an event listener for the eventClick event to display event details
                calendar.on('eventClick', function(info) {
                    var event = info.event;
                    var eventData = event.extendedProps;

                    $('#eventTitleModal').text(event.title);
                    $('#eventDescriptionModal').text(eventData.description);
                    $('#eventVenueModal').text(eventData.venue);
                    $('#eventStartModal').text(event.start.toLocaleString());
                    $('#eventEndModal').text(event.end.toLocaleString());

                    // Set the status badge based on the status value
                    var statusBadgeClass;
                    var statusText;
                    if (eventData.status === 'p') {
                        statusBadgeClass = 'badge-warning';
                        statusText = 'Request Pending';
                    } else if (eventData.status === 'y') {
                        statusBadgeClass = 'badge-success';
                        statusText = 'Success';
                    } else if (eventData.status === 'n') {
                        statusBadgeClass = 'badge-danger';
                        statusText = 'Danger';
                    }

                    // Update the status badge
                    $('#eventStatusModal').html('<span class="badge ' + statusBadgeClass + '">' + statusText + '</span>');

                    // Show the event details modal
                    $('#eventDetailsModal').modal('show');
                });

                // Close modal when close buttons are clicked
                $('#addEventModal').on('click', '.modal-close-btn, .btn-secondary', function() {
                    $('#addEventModal').modal('hide');
                });

                // Submit form via AJAX
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
                            window.location.reload();
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

    <!-- Edit Event Modal -->
    <div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="editEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title fw-bold" id="editEventModalLabel"><i class="fa fa-edit"></i> &nbsp;Edit Event</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close" onclick="$('#editEventModal').modal('hide');">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editEventForm" method="post" action="./bookEvent.php">
                        <input type="hidden" id="eventId" name="eventId">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Event Name:</td>
                                    <td><input type="text" class="form-control" id="editEventName" name="editEventName"></td>
                                </tr>
                                <tr>
                                    <td>Event Description:</td>
                                    <td><textarea class="form-control" id="editEventDescription" name="editEventDescription"></textarea></td>
                                </tr>
                                <tr>
                                    <td>Event Venue:</td>
                                    <td><input type="text" class="form-control" id="editEventVenue" name="editEventVenue"></td>
                                </tr>
                                <tr>
                                    <td>Event Start Date:</td>
                                    <td><input type="text" class="form-control" id="editEventStartDate" name="editEventStartDate"></td>
                                </tr>
                                <tr>
                                    <td>Event End Date:</td>
                                    <td><input type="text" class="form-control" id="editEventEndDate" name="editEventEndDate"></td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-light ml-1" onclick="$('#editEventModal').modal('hide');">Close</button>
                            <button type="submit" class="btn btn-warning"><i class="fa fa-check"></i>&nbsp;Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!-- jQuery UI Timepicker Addon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#editEventStartDate').datetimepicker({
                dateFormat: 'yy-mm-dd',
                timeFormat: 'HH:mm:ss',
                controlType: 'select',
                oneLine: true
            });

            $('#editEventEndDate').datetimepicker({
                dateFormat: 'yy-mm-dd',
                timeFormat: 'HH:mm:ss',
                controlType: 'select',
                oneLine: true
            });
        });
    </script>

    <script>
        // Event listener for the Edit Event button
        $('#addAnotherEventBtn').click(function() {
            // Fetch the event details from the event details modal
            var eventId = $('#eventIdModal').val(); // Assuming you have an input field with id 'eventIdModal' to store the event ID
            var eventTitle = $('#eventTitleModal').text();
            var eventDescription = $('#eventDescriptionModal').text();
            var eventVenue = $('#eventVenueModal').text();
            var eventStart = $('#eventStartModal').text();
            var eventEnd = $('#eventEndModal').text();
            var eventStatus = $('#eventStatusModal').text();

            // Convert the eventStart and eventEnd to datetime-local format
            var formattedStart = eventStart.replace(" ", "T");
            var formattedEnd = eventEnd.replace(" ", "T");

            // Populate the form fields in the edit event modal
            $('#editEventName').val(eventTitle);
            $('#editEventDescription').val(eventDescription);
            $('#editEventVenue').val(eventVenue);
            $('#editEventStartDate').val(formattedStart); // Set the correct start date format
            $('#editEventEndDate').val(formattedEnd); // Set the correct end date format
            // Populate the event ID
            $('#eventId').val(eventId); // Set the event ID to the hidden input field in the edit modal

            // Show the edit event modal
            $('#eventDetailsModal').modal('hide');
            $('#editEventModal').modal('show');
        });
    </script>
    <script>
        $('#editEventForm').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'), // Ensure this points to your PHP script

                data: formData,
                success: function(response) {
                    console.log(response);
                    $('#editEventModal').modal('hide');
                    window.location.reload();
                    alert('Event updated successfully');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error updating event');
                }
            });
        });
    </script>


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