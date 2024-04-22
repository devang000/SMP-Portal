<?php
session_start();
include './conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $vname = $vphone = $vehicleNo = $residentName = $purpose = $entry = $exittime = $status = "";

    // Validate and sanitize input
    $vname = trim($_POST["vname"]);
    $vphone = trim($_POST["vphone"]);
    $vehicleNo = trim($_POST["vehicleNo"]);
    $residentName = trim($_POST["residentName"]);
    $purpose = trim($_POST["purpose"]);
    $entry = trim($_POST["entry"]);

    // Set default values
    $status = "Y"; // Default status is "Entered"

    // Check for the action type
    $action = $_POST["action"] ?? '';

    if ($action == 'insert') {
        // Prepare and execute SQL statement to insert data into the database
        $sql = "INSERT INTO visitor (vname, vcontact, vehicle, whomtovisit, purpose, entry, exittime, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssssss", $vname, $vphone, $vehicleNo, $residentName, $purpose, $entry, $exittime, $status);
            if ($stmt->execute()) {
                // New visitor successfully added
                echo "New visitor added successfully!";
            } else {
                // Error inserting visitor
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            // Error preparing SQL statement
            echo "Error: " . $conn->error;
        }
    }
}
?>
<?php
if (isset($_POST["vid"]) && isset($_POST["status"])) {
    $visitorId = $_POST["vid"];
    $status = $_POST["status"];

    // Prepare the SQL statement
    $sql = "UPDATE visitor SET status = ?, exittime = NOW() WHERE vid = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param("si", $status, $visitorId);
        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to the same page to refresh and show updated status
            echo '<script>window.location.href="./visitors.php"</script>';
            exit;
        } else {
            echo "Error updating status: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing SQL statement: " . $conn->error;
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Visitor Management</title>
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
<style>
    .cbadge {
        cursor: pointer;
    }

    .bungee-spice-regular {
        font-family: "Bungee Spice", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

    @import url('https://fonts.googleapis.com/css2?family=Bungee+Spice&display=swap');
</style>

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
                <a class="nav-link " href="./visitors.php">
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
            <h1>Visitors</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./Resident_dashboard.php">Home</a></li>
                    <li class="breadcrumb-item">Visitor Management</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->



        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Visitor Management</h5>
                        <button type="button" class="btn btn-success mt-4 rounded-0" data-toggle="modal" data-target="#newTicketModal"><i class="fa fa-plus"></i>&nbsp; Add New Visitor</button>
                    </div>
                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Visitor Name</th>
                                <th scope="col">Visitor Mobile No</th>
                                <th scope="col">Visitor Vehicle No</th>
                                <th scope="col">Whom to Visit?</th>
                                <th scope="col">Purpose of Visit</th>
                                <th scope="col">Entry Date Time</th>
                                <th scope="col">Exit Date Time</th>
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
                                        echo "<td>" . $row["vcontact"] . "</td>"; // Corrected array key
                                        echo "<td>" . $row["vehicle"] . "</td>"; // Corrected array key
                                        echo "<td>" . $row["whomtovisit"] . "</td>"; // Corrected array key
                                        echo '<td><textarea class="form-control" rows="3" readonly>' . $row["purpose"] . '</textarea></td>'; // Corrected array key
                                        echo "<td>" . $row["entry"] . "</td>"; // Corrected array key
                                        echo "<td>" . $row["exittime"] . "</td>"; // Corrected array key

                                        // Add a clickable element for the visitor status
                                        echo "<td class='status' data-visitor-id='" . $row["vid"] . "' data-status='" . $row["status"] . "'>";
                                        if ($row["status"] == "Y") {
                                            echo "<span class='badge badge-danger text-white cbadge'>Entered</span>";
                                        } elseif ($row["status"] == "N") {
                                            echo "<span class='cbadge badge badge-success'>Exit</span>";
                                        } else {
                                            echo "<span>" . $row["status"] . "</span>"; // For other status values
                                        }
                                        echo "</td>";

                                        // Add print gate pass button
                                        echo "<td>";
                                        echo "<button type='button' class='btn btn-outline-primary printBTN' data-visitor-id='" . $row['vid'] . "' data-bs-toggle='modal' data-bs-target='#myModal'><i class='bi bi-printer-fill'></i></button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>No visitors found</td></tr>";
                                }
                            } else {
                                echo "Error: " . $conn->error;
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable w-50">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title text-white fw-bolder" id="exampleModalLabel">Gate Pass</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="modalBodyContent">
                                    <table class="table table-striped ">
                                        <th class="text-center" colspan="2">
                                            <h3 class="fw-bolder"><?php echo $_SESSION['society_name']; ?></h3>
                                            <span style="font-weight: 100;">------------------------ GATE PASS ------------------------</span>
                                        </th>
                                        <tr>
                                            <th class="text-right">Visitor Name:</th>
                                            <td id="visitorName"></td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Visitor Contact No:</th>
                                            <td id="visitorContact"></td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Visitor Vehicle No:</th>
                                            <td id="visitorVehicle"></td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Whom to visit:</th>
                                            <td id="whomToVisit"></td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Purpose of Visit:</th>
                                            <td id="purposeOfVisit"></td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Entry Date & Time:</th>
                                            <td id="entryDateTime"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <!-- Here's your existing button for printing gate pass -->
                                    <button type="button" class="btn btn-primary" onclick="printModalContent()"><i class="bi bi-printer-fill"></i>&nbsp; Print Gate Pass</button>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <script>
            function printModalContent() {
                var modalContent = document.getElementById('modalBodyContent').innerHTML;
                var printWindow = window.open('');
                printWindow.document.write('<html><head><title>' + <?php echo json_encode($_SESSION['society_name']); ?> + '  GATE PASS COPY</title></head><body>');

                printWindow.document.write('<style>');
                printWindow.document.write('@media print {');
                printWindow.document.write('    body { width: 100%; margin: 0 auto; }'); // Center the content
                printWindow.document.write('    .table { width: 100%; border-collapse: collapse; }'); // Ensure table takes full width and borders are collapsed
                printWindow.document.write('    .table th, .table td { width: auto; border: 1px solid #000; padding: 8px; }'); // Add borders and padding to table cells
                printWindow.document.write('}');
                printWindow.document.write('</style>');
                printWindow.document.write(modalContent);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            }
        </script>



        <script>
            // JavaScript function to handle click event on printBTN
            document.querySelectorAll('.printBTN').forEach(button => {
                button.addEventListener('click', function() {
                    // Fetch visitor information from the clicked row
                    const visitorName = this.closest('tr').querySelector('td:nth-child(2)').textContent;
                    const visitorContact = this.closest('tr').querySelector('td:nth-child(3)').textContent;
                    const visitorVehicle = this.closest('tr').querySelector('td:nth-child(4)').textContent;
                    const whomToVisit = this.closest('tr').querySelector('td:nth-child(5)').textContent;
                    const purposeOfVisit = this.closest('tr').querySelector('td:nth-child(6) textarea').value;
                    const entryDateTime = this.closest('tr').querySelector('td:nth-child(7)').textContent;

                    // Populate modal with visitor information
                    document.getElementById('visitorName').textContent = visitorName;
                    document.getElementById('visitorContact').textContent = visitorContact;
                    document.getElementById('visitorVehicle').textContent = visitorVehicle;
                    document.getElementById('whomToVisit').textContent = whomToVisit;
                    document.getElementById('purposeOfVisit').textContent = purposeOfVisit;
                    document.getElementById('entryDateTime').textContent = entryDateTime;
                });
            });
        </script>


        <script>
            document.querySelectorAll('.status').forEach(item => {
                item.addEventListener('click', function() {
                    const visitorId = this.dataset.visitorId;
                    let status = this.dataset.status;

                    // Toggle status
                    status = status === 'Y' ? 'N' : 'Y';

                    // Update UI
                    if (status === 'Y') {
                        this.innerHTML = "<span class='badge badge-danger text-white'>Entered</span>";
                    } else {
                        this.innerHTML = "<span class='badge badge-success'>Exit</span>";
                    }

                    // Update the exit time in the UI
                    const exitTimeCell = this.closest('tr').querySelector('td:nth-child(9)');
                    if (status === 'N') {
                        exitTimeCell.textContent = new Date().toLocaleString(); // Update the exit time to the current time
                    } else {
                        exitTimeCell.textContent = ''; // Clear the exit time if the status is 'Entered'
                    }

                    // Create a form for updating the status and exit time in the database
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '<?php echo $_SERVER["PHP_SELF"]; ?>'; // Submit to the same page

                    // Add hidden inputs for visitorId, status, and action
                    const inputVisitorId = document.createElement('input');
                    inputVisitorId.type = 'hidden';
                    inputVisitorId.name = 'vid';
                    inputVisitorId.value = visitorId;
                    form.appendChild(inputVisitorId);

                    const inputStatus = document.createElement('input');
                    inputStatus.type = 'hidden';
                    inputStatus.name = 'status';
                    inputStatus.value = status;
                    form.appendChild(inputStatus);

                    const inputAction = document.createElement('input');
                    inputAction.type = 'hidden';
                    inputAction.name = 'action';
                    inputAction.value = 'update'; // Set the action to update
                    form.appendChild(inputAction);

                    // Append the form to the body and submit it
                    document.body.appendChild(form);
                    form.submit();
                });
            });
        </script>


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
                            <input type="hidden" name="action" value="insert">
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
                                <button type="submit" class="btn btn-primary rounded-0"><i class="fa fa-plus"></i>&nbsp; Add new Visitor</button>
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