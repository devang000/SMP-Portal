<?php
include 'conn.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>My Complaints</title>
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
                <a class="nav-link  " href="./gateKeeperDashboard.php">
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
                <a class="nav-link " href="./mycomplaints2.php">
                    <i class="bi bi-ticket-perforated"></i>
                    <span>Raise Ticket</span>
                </a>
            </li>

        </ul>

    </aside><!-- End Sidebar-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Raise Ticket</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./Resident_dashboard.php">Home</a></li>
                    <li class="breadcrumb-item">Raise Ticket</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">My Complaints Tickets</h5>
                        <button type="button" class="btn btn-success mt-4" data-toggle="modal" data-target="#newTicketModal"><i class="fa fa-plus"></i>&nbsp; Raise New Ticket</button>
                    </div>
                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>Email <br> Address </th>
                                <th scope="col">Complaint <br> Type</th>
                                <th scope="col">Complaint <br> Description</th>
                                <th scope="col">Comlaints <br> Occured Date</th>
                                <th scope="col">Complaint <br> Status</th>
                                <th scope="col">Comlaints <br> Resolved Date</th>
                                <th scope="col">Comlaints <br> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch complaints data from the database
                            $sql = "SELECT * FROM complaints";
                            $result = $conn->query($sql);

                            if ($result) {
                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["cid"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td>" . $row["complaint_type"] . "</td>";
                                        echo '<td><textarea class="form-control" rows="3" readonly>' . $row["complaint_description"] . '</textarea></td>';

                                        echo "<td>" . $row["complaint_occured_date"] . "</td>";
                                        // Add badge based on complaint status
                                        if ($row["complaint_status"] == "P") {
                                            echo "<td><span class='badge badge-warning text-black'>Pending</span></td>";
                                        } elseif ($row["complaint_status"] == "Y") {
                                            echo "<td><span class='badge badge-success'>Resolved</span></td>";
                                        } else {
                                            echo "<td>" . $row["complaint_status"] . "</td>"; // For other status values
                                        }
                                        echo "<td>" . $row["complaint_resolved_date"] . "</td>";
                                        // Add edit and remove buttons
                                        echo "<td>";
                                        echo "<button type='button' class='btn btn-outline-warning btn-sm'><i class='fa fa-pencil' data-toggle='modal' data-target='#editTicketModal'></i></button>&emsp;";
                                        echo "<button type='button' class='btn btn-outline-danger btn-sm delete-btn' data-toggle='modal' data-target='#confirmDeleteModal' data-complaint-id='" . $row["cid"] . "'><i class='fa fa-trash-can'></i></button>";

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No complaints found</td></tr>";
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
        </section>

        <!-- New Ticket Modal -->
        <div class="modal fade" id="newTicketModal" tabindex="-1" role="dialog" aria-labelledby="newTicketModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title fw-bold" id="newTicketModalLabel"><i class="bi bi-ticket-perforated"></i>&nbsp; Raise New Ticket</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for ticket details -->
                        <form method="post" action="./mycomplaints.php">
                            <div class="table-responsive">
                                <table class="table table-striped p-0">
                                    <tbody>
                                        <tr>
                                            <td>Email:</td>
                                            <td><input required type="email" class="form-control" id="ticketEmail" name="ticketEmail" placeholder="Email address"></td>
                                        </tr>

                                        <tr>
                                            <td>Complaint Type:</td>
                                            <td>
                                                <select required class="form-control form-select" id="ticketType" name="ticketType" onchange="showOtherInput()">
                                                    <option value="">Select Complaint Type</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Security">Security</option>
                                                    <option value="Cleanliness">Cleanliness</option>
                                                    <option value="Other">Other</option>
                                                    <!-- Add more options as needed -->
                                                </select>
                                            </td>
                                        </tr>
                                        <tr id="otherTypeInputRow" style="display: none;">
                                            <td>New Complaint Type:</td>
                                            <td><input type="text" class="form-control" id="newComplaintType" name="newComplaintType" placeholder="Enter new complaint type"></td>
                                        </tr>

                                        <tr>
                                            <td>Complaint Description:</td>
                                            <td><textarea required class="form-control" id="ticketDescription" name="ticketDescription" rows="3" placeholder="Enter complaint description"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Date and Time of Occurrence:</td>
                                            <td><input type="datetime-local" class="form-control" id="ticketDateTime" name="ticketDateTime" value=""></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Add new ticket</button>
                            </div>
                        </form>
                        <script>
                            function showOtherInput() {
                                var ticketType = document.getElementById("ticketType").value;
                                var otherTypeInputRow = document.getElementById("otherTypeInputRow");
                                if (ticketType === "Other") {
                                    otherTypeInputRow.style.display = "table-row";
                                } else {
                                    otherTypeInputRow.style.display = "none";
                                }
                            }
                        </script>

                        <script>
                            // Get current date and time in ISO 8601 format
                            var now = new Date().toISOString().slice(0, 16);
                            document.getElementById("ticketDateTime").value = now;
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

        <!-- Delete Modal -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white fw-bold">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this complaint?
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <!-- Change button type to 'button' and remove data-record-id attribute -->
                        <button type="button" class="btn btn-danger deleteBtn"><i class="fa fa-trash-can"></i>&nbsp; Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Include your database connection file
        include './conn.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['complaintId'])) {
            $complaintId = $_POST['complaintId'];

            // Prepare and execute SQL statement to delete the record from the database
            $sql = "DELETE FROM complaints WHERE cid = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $complaintId); // Assuming cid is an integer
                if ($stmt->execute()) {
                    // Deletion successful
                    echo "Complaint deleted successfully!";
                } else {
                    // Error deleting complaint
                    echo "Error deleting complaint: " . $stmt->error;
                }
                $stmt->close();
            } else {
                // Error preparing SQL statement
                echo "Error preparing statement: " . $conn->error;
            }
            $conn->close();
        }
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Pass the PHP_SELF value to JavaScript -->
        <script>
            var phpSelf = '<?php echo $_SERVER['PHP_SELF']; ?>';
        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                // When the delete button in the table row is clicked
                $('.delete-btn').click(function() {
                    var complaintId = $(this).data('complaint-id'); // Get the complaint ID from the button attribute
                    // Set the complaint ID to the delete button inside the modal
                    $('.deleteBtn').attr('data-record-id', complaintId);
                    // Manually trigger the modal to show
                    $('#confirmDeleteModal').modal('show');
                });

                // When the delete button in the modal is clicked
                $('.deleteBtn').click(function() {
                    var complaintId = $(this).data('record-id'); // Get the complaint ID from the button attribute
                    $.ajax({
                        url: '', // Use the JavaScript variable for the current script's path
                        type: 'POST',
                        data: {
                            complaintId: complaintId
                        }, // Send complaint ID to the server
                        success: function(response) {
                            // If deletion is successful, hide the modal
                            $('#confirmDeleteModal').modal('hide');
                            // You can also update the table using JavaScript without reloading the page
                        },
                        error: function(xhr, status, error) {
                            // Handle errors
                            console.error("AJAX error:", xhr.responseText);
                        }
                    });
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