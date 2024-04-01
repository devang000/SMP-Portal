 <?php session_start(); ?>

 <?php
    include "society_header.php";
    include "conn.php";

    // Fetch society names and output them as <option> elements
    $sql = "SELECT society_Name FROM society";
    $result = $conn->query($sql);



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["password"])) {
            // Login functionality
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            // Assuming you have a name column
            // Define the SQL query
            $sql = "SELECT id, photo, firstname, society, lastname, phone_number, dob, flatNo, address, city,password FROM residents WHERE email = ?";

            // Prepare the statement
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    // Compare the entered password with the stored password
                    if ($password === $row['password']) {
                        // Password is correct, set session variables and redirect to dashboard
                        $_SESSION["user_id"] = $row["id"];
                        $_SESSION["user_email"] = $email;
                        $_SESSION["user_profile_picture"] = $row["photo"]; // Assuming you have a profile_picture column
                        $_SESSION["user_name"] = $row["firstname"];
                        $_SESSION["society_name"] = $row["society"];
                        $_SESSION["lastname"] = $row["lastname"];
                        $_SESSION["phone"] = $row["phone_number"];
                        $_SESSION["dob"] = $row["dob"];
                        $_SESSION["flatNo"] = $row["flatNo"];
                        $_SESSION["address"] = $row["address"];
                        $_SESSION["city"] = $row["city"];

                        echo '<script>
                                console.log("Password is correct. Redirecting...");
                                window.location = "./Resident_dashboard.php";
                                </script>';
                    } else {
                        // Invalid email or password
                        echo '<script>
                                        $(document).ready(function(){
                                            swal({
                                                icon: "error",
                                                title: "Invalid Credentials",
                                                dangerMode: true,
                                                text: "Email id or password is incorrect\nPlease enter a valid email and password!",
                                            });
                                        });
                                    </script>
                                ';
                    }
                } else {
                    // Email not found
                    echo '<script>
                                    $(document).ready(function(){
                                        swal({
                                            icon: "error",
                                            title: "Email Not Found",
                                            dangerMode: true,
                                            text: "The entered email does not exist in our records.",
                                        });
                                    });
                                </script>
                            ';
                }
            }
        } elseif (isset($_POST["forgetEmail"])) {
            // Password reset functionality
            $email = trim($_POST["forgetEmail"]);

            // Check if email exists in the database
            $sql = "SELECT id FROM residents WHERE email = ?";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Generate a new random password
                    $bytes = openssl_random_pseudo_bytes(4);
                    $newPassword = bin2hex($bytes); // This generates a 20-character long hexadecimal string

                    // Update the password in the database
                    $sql = "UPDATE residents SET password = ? WHERE email = ?";
                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        mysqli_stmt_bind_param($stmt, "ss", $newPassword, $email);
                        if (mysqli_stmt_execute($stmt)) {
                            // Send an email to the user with the new password
                            $mail = new PHPMailer(true);
                            //Enable SMTP debugging.
                            $mail->SMTPDebug = 0;
                            //Set PHPMailer to use SMTP.
                            $mail->isSMTP();
                            //Set SMTP host name                          
                            $mail->Host = "smtp.gmail.com";
                            //Set this to true if SMTP host requires authentication to send email
                            $mail->SMTPAuth = true;
                            //Provide username and password     
                            $mail->Username = "devanggohil61@gmail.com";
                            $mail->Password = "szxgytjkinjnnrti";

                            //If SMTP requires TLS encryption then set it
                            $mail->SMTPSecure = "tls";
                            //Set TCP port to connect to
                            $mail->Port = 587;

                            $mail->From = "coontact.sms@gmail.com";
                            $mail->FromName = "SMS-Society Management Portal | Admin";

                            $mail->addAddress($email, "Dear User");

                            $mail->isHTML(true);

                            //$mail->Subject = "Devang";
                            //$mail->Body = "<b>Your New Password is 👇</b><br>" . $pass;//rand(111111, 999999);
                            $mail->Subject = "Reset Password";
                            $mail->Body = "<p>Dear User,<br> Your new password has been <b>Resetted Successfully ✔</b><br>Now You can Login with new password.<br><b>🔑 Your New Password =  " . $newPassword . "</b><br><br><form action='http://localhost/project/index.php'><button class=btn btn-success type=submit>Click here to login</button></form>
                                        <br><br><br><i>This email is auto generated by SMP-Portal | Maintannace team no need to reply back*</i>";
                            $mail->AltBody = "";

                            $mail->send();
                            //echo "Message has been sent successfully";
                            //echo "<p style='color:green; font-family:verdana; font-size:20pt; background-color: lightgrey'>" . "<br><br><br>✔ Email has successfully sent check your mail-id" . "</p>";
                            echo '<script type="text/javascript">
                                $(document).ready(function(){
                                    swal({
                                        position: "top-end",
                                        icon: "success",
                                        title: "Email Sent",
                                        text: "New password is sent your entered email address\n please check you email-id",
                                        showConfirmButton: true,
                                        dangerMode: true,
                                    }).then(() => {
                                        $("#exampleModal").modal("show");
                                    });
                                });
                                </script>
                
                                <style>
                                    .swal-footer {
                                        text-align: center;
                                    }
                                </style>';
                        } else {
                            echo '
                                    <script type="text/javascript">
                                    $(document).ready(function(){
                                        swal({
                                            position: "top-end",
                                            icon: "warning",
                                            title: "Oops!",
                                            text: "oops something went wrong please try again later!",
                                            showConfirmButton: true,
                                            dangerMode: true,
                                        }).then(() => {
                                            $("#exampleModal").modal("show");
                                        });
                                    });
                                    </script>
                    
                                    <style>
                                        .swal-footer {
                                            text-align: center;
                                        }
                                    </style>
                                ';
                        }
                    }
                } else {
                    echo '
                            <script type="text/javascript">
                            $(document).ready(function(){
                                swal({
                                    position: "top-end",
                                    icon: "error",
                                    title: "Not Found",
                                    text: "Entered email-id is not exists!",
                                    showConfirmButton: true,
                                    dangerMode: true,
                                }).then(() => {
                                    $("#exampleModal").modal("show");
                                });
                            });
                            </script>

                            <style>
                                .swal-footer {
                                    text-align: center;
                                }
                            </style>
                        ';
                }
            }
        }
    }
    // Close connection
    mysqli_close($conn);
    ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Society Management Portal - Index</title>
     <link rel="icon" type="image/x-icon" href="./img/flat.ico">
     <!-- Bootstrap CSS -->
     <script src="jquery-3.3.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
     <link rel="stylesheet" href="./css/index.css">
     <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

 </head>

 <body>

     <!-- Image Slider -->
     <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
         <div class="carousel-inner">
             <div class="carousel-item active">
                 <img class="d-block w-100" src="./img/i2-new.png" alt="First slide">
                 <div class="overlay"></div> <!-- Black overlay -->
                 <div class="carousel-caption d-none d-md-block text-white">
                     <h1 class="text-white">Experience community living at its best!</h1>
                     <h5 class="text-white">Building secure, connected, thriving societies.</h5>
                 </div>
             </div>
             <div class="carousel-item">
                 <img class="d-block w-100" src="./img/i5.png" alt="Second slide">
                 <div class="overlay"></div> <!-- Black overlay -->
                 <div class="carousel-caption d-none d-md-block">
                     <h5>Second Slide Heading</h5>
                     <p>Description for the second slide.</p>
                 </div>
             </div>
             <div class="carousel-item">
                 <img class="d-block w-100" src="./img/i1.png" alt="Third slide">
                 <div class="overlay"></div> <!-- Black overlay -->
                 <div class="carousel-caption d-none d-md-block">
                     <h5>Third Slide Heading</h5>
                     <p>Description for the third slide.</p>
                 </div>
             </div>
         </div>
         <!-- Controls -->
         <a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev">
             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
             <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">
             <span class="carousel-control-next-icon" aria-hidden="true"></span>
             <span class="sr-only">Next</span>
         </a>
         <!-- Indicators -->
         <ol class="carousel-indicators">
             <li data-target="#carouselExampleSlidesOnly" data-slide-to="0" class="active"></li>
             <li data-target="#carouselExampleSlidesOnly" data-slide-to="1"></li>
             <li data-target="#carouselExampleSlidesOnly" data-slide-to="2"></li>
         </ol>
     </div>

     <br><br>
     <!-- Services Section -->
     <h2 class="text-center mt-0">Our Services<br>----------</h2>

     <section class="services-container" id="services-container">
         <div class="container">
             <div class="row">
                 <div class="col-lg-4">
                     <div class="service-item animated fadeInUp">
                         <div class="service-icon">
                             <img src="./img/teamwork.gif" alt="" height="70vh" width="70vw">
                         </div>
                         <h3 class="service-title">Community Management</h3>
                         <p class="service-description">Efficient management of community activities and resources.</p>
                     </div>
                 </div>
                 <div class="col-lg-4">
                     <div class="service-item animated fadeInUp" style="animation-delay: 0.2s;">
                         <div class="service-icon">
                             <img src="./img/promote.gif" alt="" height="70vh" width="70vw">
                         </div>
                         <h3 class="service-title">Announcements</h3>
                         <p class="service-description">Stay informed with important announcements and updates.</p>
                     </div>
                 </div>
                 <div class="col-lg-4">
                     <div class="service-item animated fadeInUp" style="animation-delay: 0.4s;">
                         <div class="service-icon">
                             <img src="./img/list.gif" alt="" height="70vh" width="70vw">
                         </div>
                         <h3 class="service-title">Task Management</h3>
                         <p class="service-description">Efficiently assign and manage tasks within the community.</p>
                     </div>
                 </div>
                 <div class="col-lg-4">
                     <div class="service-item animated fadeInUp">
                         <div class="service-icon">
                             <img src="./img/upcoming.gif" alt="" height="70vh" width="70vw">
                         </div>
                         <h3 class="service-title">Booking Amenities</h3>
                         <p class="service-description">SMS allows residents to book amenities such as clubhouse, gym, or
                             pool facilities.</p>
                     </div>
                 </div>
                 <div class="col-lg-4">
                     <div class="service-item animated fadeInUp" style="animation-delay: 0.2s;">
                         <div class="service-icon">
                             <img src="./img/complaint.gif" alt="" height="70vh" width="70vw">
                         </div>
                         <h3 class="service-title">Quick Solution</h3>
                         <p class="service-description">Facilitates efficient management and resolution of resident concerns and issues within the community.</p>
                     </div>
                 </div>
                 <div class="col-lg-4">
                     <div class="service-item animated fadeInUp" style="animation-delay: 0.4s;">
                         <div class="service-icon">
                             <img src="./img/payment-app.gif" alt="" height="70vh" width="70vw">
                         </div>
                         <h3 class="service-title">Bills & Payments</h3>
                         <p class="service-description">Efficiently handles online dues and bills, ensuring convenience and transparency for residents and management.</p>
                     </div>
                 </div>

             </div>
         </div>
     </section>
     <br> <br><br>
     <section id="Logins">
         <h1 style="text-align: center;">
             <a href="" class="typewrite fw-bold" data-period="2000" data-type='[ "Hi, You are a ?", "Resident or User.", "Secretary", "Gate keeper" ]'>
                 <span class="wrap"></span>
             </a>
             <!-- <a href="" class="typewrite fw-bold" data-period="2000" data-type='[ "Hi,", "Register your society.", "connect with us"]'>
                    <span class="wrap"></span>
                </a> -->
         </h1>
         <br>
         <div class="container mt-3">
             <div class="row justify-content-center">
                 <div class="col-md-4">
                     <button class="btn btn-warning btn-block btn-lg"><i class="fa-solid fa-user"></i>&nbsp; Secretary</button>
                 </div>
                 <div class="col-md-4">
                     <button class="btn btn-danger btn-block btn-lg" data-target="#exampleModal" data-toggle="modal"><i class="fa-solid fa-users"></i>&nbsp; Resident/User</button>
                 </div>
                 <div class="col-md-4">
                     <button class="btn btn-info btn-block btn-lg"><i class="fa-solid fa-person-military-pointing"></i>&nbsp; Gate Keeper</button>
                 </div>
             </div>
         </div>


     </section>


     <!-- Resident Login Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: poppins; border-radius: 15px;">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
             <div class="modal-content" style="margin-top: 50px;">
                 <div class="modal-header bg-primary text-white">
                     <h4 class="modal-title text-white" id="exampleModalLabel"><b>Resident Login</b></h4>
                     <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form id="loginForm" method="POST" action="">
                         <div class="form-group">
                             <label for="email"><b>Email address</b></label>
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text">
                                         <i class="fa fa-user"></i>
                                     </span>
                                 </div>
                                 <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                             </div>
                             <span class="text-danger" id="emailError"></span>
                         </div>
                         <div class="form-group">
                             <label for="password"><b>Password</b></label>
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text">
                                         <i class="fa fa-lock"></i>
                                     </span>
                                 </div>
                                 <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                             </div>
                             <span class="text-danger" id="passwordError"></span>
                         </div>
                         <div class="text-right mb-3">
                             <a href="#" id="forgetPasswordLink">Forgot password?</a>
                         </div>
                         <button type="button" class="btn btn-success btn-block m-0 rounded-0" onclick="validateForm()">Login</button>
                     </form>
                 </div>
                 <div class="modal-footer">
                     <p class="mr-auto">Don't have an account? <a href="./Resident_register.php">Sign up</a></p>
                 </div>
             </div>
         </div>
     </div>


     <!-- Forget Password Modal -->
     <div class="modal fade" id="forgetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgetPasswordModalLabel" aria-hidden="true" style="font-family: poppins; border-radius: 15px;">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <div class="modal-header bg-primary text-white">
                     <h4 class="modal-title text-white" id="forgetPasswordModalLabel"><b>Forgot Password</b></h4>
                     <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form id="forgetPasswordForm" method="POST" action="" onsubmit="return sendForgetPasswordEmail()">

                         <div class="form-group">
                             <label for="forgetEmail"><b>Email address</b></label>
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text">
                                         <i class="fa fa-envelope"></i>
                                     </span>
                                 </div>
                                 <input type="email" name="forgetEmail" class="form-control" id="forgetEmail" placeholder="Enter email">
                             </div>
                             <span class="text-danger" id="forgetEmailError"></span>
                         </div>
                         <button type="submit" class="btn btn-primary btn-block m-0 rounded-0">Reset Password</button>
                         <!-- Changed type to submit -->
                     </form>
                 </div>
                 <div class="modal-footer">
                     <p class="mr-auto">Back to Login? <a href="#" id="backToLogin">Sign In</a></p>
                 </div>
             </div>
         </div>
     </div>


     <script>
         // Function to show forget password modal
         $(document).ready(function() {
             $("#forgetPasswordLink").click(function(e) {
                 e.preventDefault(); // prevent default anchor behavior
                 $("#exampleModal").modal("hide");
                 $("#forgetPasswordModal").modal("show");
             });
         });

         // Function to show login modal when clicking "Back to Login"
         $("#backToLogin").click(function(e) {
             e.preventDefault(); // prevent default anchor behavior
             $("#forgetPasswordModal").modal("hide");
             $("#exampleModal").modal("show");
         });

         function sendForgetPasswordEmail() {
             var email = document.getElementById('forgetEmail').value.trim();
             var emailError = document.getElementById('forgetEmailError');

             // Reset previous error messages
             emailError.textContent = '';

             // Perform validation
             if (email === '') {
                 document.getElementById('forgetEmail').classList.add('is-invalid');
                 emailError.textContent = '*Email is required';
                 return false; // Prevent form submission
             } else {
                 document.getElementById('forgetEmail').classList.remove('is-invalid');
                 return true; // Allow form submission
             }
         }
     </script>


     <script>
         // Function to validate form
         function validateForm() {
             // Reset previous error messages
             document.getElementById('emailError').textContent = '';
             document.getElementById('passwordError').textContent = '';

             // Fetch input values
             var email = document.getElementById('email').value.trim();
             var password = document.getElementById('password').value.trim();

             // Check for empty fields
             if (email === '') {
                 document.getElementById('email').classList.add('is-invalid');
                 document.getElementById('emailError').textContent = '*Email is required';
             } else {
                 document.getElementById('email').classList.remove('is-invalid');
             }

             if (password === '') {
                 document.getElementById('password').classList.add('is-invalid');
                 document.getElementById('passwordError').textContent = '*Password is required';
             } else {
                 document.getElementById('password').classList.remove('is-invalid');
             }

             // Submit the form if no errors
             if (email !== '' && password !== '') {
                 document.getElementById('loginForm').submit();
             }
         }

         // Add event listeners to input fields for real-time validation
         document.getElementById('email').addEventListener('input', function() {
             if (this.value.trim() !== '') {
                 document.getElementById('emailError').textContent = '';
                 this.classList.remove('is-invalid');
             }
         });

         document.getElementById('password').addEventListener('input', function() {
             if (this.value.trim() !== '') {
                 document.getElementById('passwordError').textContent = '';
                 this.classList.remove('is-invalid');
             }
         });
     </script>

     <script src="./JS/Index.js"></script>


     <!-- Bootstrap JS -->
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


     <!-- Testimonials and User Feedback Section -->

     <section id="testimonials">

         <div class="gtco-testimonials" style="margin-top: 100px;">
             <h2 class="userReviews">User Reviews<br>----------</h2>
             <div class="owl-carousel owl-carousel1 owl-theme">
                 <div>
                     <div class="card text-center"><img class="card-img-top" src="https://www.mecgale.com/wp-content/uploads/2017/08/dummy-profile.png" alt="">
                         <div class="card-body">
                             <h5>Nimesh Patel<br />
                                 <span> From Shivam Residency </span>
                             </h5>
                             <p class="card-text">“ Since using the Society Management Portal, our community has become
                                 more
                                 connected. The message board feature has allowed us to share important information and
                                 engage in community discussions.” </p>
                         </div>
                     </div>
                 </div>
                 <div>
                     <div class="card text-center"><img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrJ2R9O5THIdzGHJl3RjnK2Bxzj20iYSsMQA&usqp=CAU" alt="">
                         <div class="card-body">
                             <h5>Mukesh Sharma<br />
                                 <span> From Silver Heights </span>
                             </h5>
                             <p class="card-text">“ The Society Management Portal has been a game-changer for our
                                 community.It's so easy to submit service requests and pay bills online. The portal's
                                 24/availability has made life a lot more convenient for me. ” </p>
                         </div>
                     </div>
                 </div>
                 <div>
                     <div class="card text-center"><img class="card-img-top" src="https://avatars.githubusercontent.com/u/36388074?v=4" alt="">
                         <div class="card-body">
                             <h5>Indra Patel<br />
                                 <span> From Arayan Eminent </span>
                             </h5>
                             <p class="card-text">“The Society Management Portal's resident portal has made my life as a
                                 resident much simpler. I can check my package status and make payments without leaving
                                 my
                                 home.” </p>
                         </div>
                     </div>
                 </div>
                 <div>
                     <div class="card text-center"><img class="card-img-top" src="https://images.unsplash.com/photo-1549836938-d278c5d46d20?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=303&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=50&w=303" alt="">
                         <div class="card-body">
                             <h5>Jennie Arora<br />
                                 <span> From Prahladnager </span>
                             </h5>
                             <p class="card-text">“ Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil
                                 impedit quo minus id quod maxime placeat ” </p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <?php include "footer.php"; ?>




 </body>

 </html>