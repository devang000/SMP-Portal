<?php
session_start();
require_once './conn.php'; // Adjust the path as needed

// Function to validate the old password
function validateOldPassword($conn, $oldPassword)
{
    // Fetch the stored password hash from the database
    $username = $_SESSION['user_name'];
    $sql = "SELECT password FROM residents WHERE username='$username'"; // Adjusted table name
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $storedPasswordHash = $row['password'];
        // Verify the old password against the stored hash
        return password_verify($oldPassword, $storedPasswordHash);
    } else {
        // Error in fetching password from database
        return "Database error";
    }
}

// Check if the old password matches the one stored in the database
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['oldPassword'])) {
    $oldPassword = $_POST['oldPassword'];
    $validationResult = validateOldPassword($conn, $oldPassword);

    // Respond with JSON indicating the result
    if ($validationResult === true) {
        $response = ['status' => 'success'];
    } else {
        $response = ['status' => 'error', 'message' => $validationResult];
    }
    echo json_encode($response);
}
?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/dist/boxicons.js" integrity="sha512-Dm5UxqUSgNd93XG7eseoOrScyM1BVs65GrwmavP0D0DujOA8mjiBfyj71wmI2VQZKnnZQsSWWsxDKNiQIqk8sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/Resident/Resident_dashboard.css">
    <script src="./JS/Resident/Resident_dashboard.js"></script>
    <!-- Other head elements -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/atisawd/boxicons@2.1.2/css/boxicons.min.css">
    <link rel="stylesheet" href="boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>


</head>

<!-- Side Panel Menu -->
<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="./img/SMP-removebg-preview.png" alt="">
            </span>

            <div class="text logo-text">
                <span class="name">SMS</span>
                <span class="profession">Society Management Portal</span>
            </div>
        </div>

        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
        <div class="menu">

            <ul class="menu-links">
                <li class="nav-link">
                    <a href="#">
                        <i class="fa-solid fa-house fa-2xs icon"></i>
                        <span class="text nav-text">Dashboard</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class="fa-solid fa-2xs fa-calendar-day icon"></i>
                        <span class="text nav-text">Book Amenities</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class="fa-solid fa-bullhorn fa-2xs icon"></i>
                        <span class="text nav-text">Announcements</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class="fa-regular fa-credit-card fa-2xs icon"></i>
                        <span class="text nav-text">My bills</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class="fa-solid fa-users fa-2xs icon"></i>
                        <span class="text nav-text">My Neighbours</span>
                    </a>
                </li>

            </ul>
        </div>


    </div>
    </div>

</nav>

<section class="home">
    <div class="text" style="height: 80px;">
        Resident Dashboard
        <table>
            <tr>
                <td>
                    <div class="dropdown">
                        <a class="dropbtn" onclick="toggleDropdown()">
                            👋 Hey! &nbsp;
                            <?php echo $_SESSION["user_name"]; ?>
                            <i class="fas fa-chevron-down"></i>&emsp;
                        </a>
                        <div id="dropdown-content" class="dropdown-content">
                            <a href="my_profile.php"><i class="fas fa-user"></i>&nbsp; My Profile</a>
                            <a href="#" onclick="ChangePass()"><i class="fas fa-key"></i>&nbsp; Change Password</a>
                            <a href="#" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i>&nbsp; Logout</a>
                        </div>
                    </div>
                </td>

                <td>
                    <div class="profile-picture">
                        <img src="<?php echo $_SESSION["user_profile_picture"]; ?>" alt="User Profile Image" height="50px" width="50px">
                    </div>
                </td>
                <script>
                    function toggleDropdown() {
                        document.getElementById("dropdown-content").classList.toggle("show");
                    }

                    function confirmLogout() {
                        swal({
                                title: "Are you sure?",
                                text: "You will be logged out!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willLogout) => {
                                if (willLogout) {
                                    window.location.href = "logout.php";
                                }
                            });
                    }


                    function ChangePass() {
                        swal({
                            title: "Change Password",
                            text: "Please enter your old password",
                            icon: "warning",
                            content: "input",
                            dangerMode: "on",
                            inputAttributes: {
                                placeholder: "Old Password",
                                type: "password",
                                id: "oldPassword"
                            },
                            buttons: {
                                cancel: {
                                    text: "Cancel",
                                    value: null,
                                    visible: true,
                                    className: "",
                                    closeModal: true
                                },
                                confirm: {
                                    text: "Next",
                                    value: true,
                                    visible: true,
                                    className: "",
                                    closeModal: false
                                }
                            },
                            closeOnClickOutside: false,
                        }).then((willChangePassword) => {
                            if (willChangePassword) {
                                const oldPassword = document.getElementById('oldPassword').value;
                                // Send the old password to the server for verification
                                $.ajax({
                                    url: 'Resident_ds.php',
                                    type: 'POST',
                                    data: {
                                        oldPassword: oldPassword
                                    },
                                    success: function(response) {
                                        const result = JSON.parse(response);
                                        if (result.status === 'success') {
                                            // Old password is correct, proceed to enter new password
                                            swal({
                                                title: "Change Password",
                                                text: "Please enter your new password",
                                                icon: "warning",
                                                content: "input",
                                                inputAttributes: {
                                                    placeholder: "New Password",
                                                    type: "password",
                                                    id: "newPassword"
                                                },
                                                buttons: {
                                                    cancel: {
                                                        text: "Cancel",
                                                        value: null,
                                                        visible: true,
                                                        className: "",
                                                        closeModal: true
                                                    },
                                                    confirm: {
                                                        text: "Change Password",
                                                        value: true,
                                                        visible: true,
                                                        className: "",
                                                        closeModal: false
                                                    }
                                                },
                                                closeOnClickOutside: false,
                                            }).then((willConfirmChange) => {
                                                if (willConfirmChange) {
                                                    // Handle the logic to update the password in the database
                                                    console.log("Change password logic here");
                                                }
                                            });
                                        } else {
                                            // Display error message
                                            swal("Error", result.message, "error");
                                        }
                                    }
                                });
                            }
                        });
                    }
                </script>
            </tr>
        </table>
    </div>

    <!-- Main Content -->

    <div class="widgets">
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
    </div>



</section>

<script>
    const body = document.querySelector('body'),
        sidebar = body.querySelector('nav'),
        toggle = body.querySelector(".toggle"),
        searchBtn = body.querySelector(".search-box"),
        modeSwitch = body.querySelector(".toggle-switch"),
        modeText = body.querySelector(".mode-text");
    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    })
    searchBtn.addEventListener("click", () => {
        sidebar.classList.remove("close");
    })
    modeSwitch.addEventListener("click", () => {
        body.classList.toggle("dark");
        if (body.classList.contains("dark")) {
            modeText.innerText = "Light mode";
        } else {
            modeText.innerText = "Dark mode";
        }
    });
</script>


<script src="script.js">