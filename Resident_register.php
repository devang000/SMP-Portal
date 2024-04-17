<?php
include("./conn.php");
// Start the session
session_start();
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $dob = $_POST['dob'];
    $city = $_POST['city'];
    $society = $_POST['selectSociety'];
    $newSociety = isset($_POST['newSociety']) ? $_POST['newSociety'] : '';
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $password = $_POST['password'];
    $flatNo = $_POST['flatNo'];

    // Store form data in session variables
    $_SESSION["firstName"] = $firstName;
    $_SESSION["lastName"] = $lastName;
    $_SESSION["email"] = $email;
    $_SESSION["phoneNumber"] = $phoneNumber;
    $_SESSION["dob"] = $dob;
    $_SESSION["city"] = $city;
    $_SESSION["selectSociety"] = $society;
    $_SESSION["address"] = $address;
    $_SESSION["pincode"] = $pincode;
    $_SESSION["password"] = $password;
    $_SESSION["flatNo"] = $flatNo;

    // Check if 'profilePicture' is set in the $_FILES array
    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == UPLOAD_ERR_OK) {
        // Handle file upload here
        $uploadDir = './uploaded_img/';
        $uploadFile = $uploadDir . basename($_FILES['profilePicture']['name']);
        if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadFile)) {
            // File is uploaded successfully, store the file path in a variable
            $filePath = $uploadFile;
        } else {
            echo "Error uploading the file.";
        }
    }

    // Determine the society name to insert
    $societyNameToInsert = ($society == 'add') ? $newSociety : $society;



    // Insert data into database
    $sql = "INSERT INTO residents (firstname, lastname, email, phone_number, dob, city, society, flatNo, address, pincode, password, photo)
    VALUES ('$firstName', '$lastName', '$email', '$phoneNumber', '$dob', '$city', '$societyNameToInsert', '$flatNo', '$address', '$pincode', '$password', '$filePath')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✔ Registration successful!')
        window.location.href = './society_index.php';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Update the session variable for society
    $_SESSION["selectSociety"] = $societyNameToInsert;

    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Registration | SMP</title>
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/Resident/Resident_registration.css">
    <style></style>
</head>

<body>
    <div class="container mt-5 mb-5 p-4">
        <header>Resident Registration</header>
        <br>
        <form id="registrationForm" action="./Resident_register.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="firstName">First Name<sup style="color: red; font-weight:bolder;">*</sup></label>
                            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter your first name">
                            <span id="firstNameError" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lastName">Last Name<sup style="color: red; font-weight:bolder;">*</sup></label>
                            <input type="text" class="form-control" id="lastName" placeholder="Enter your last name" name="lastName">
                            <span id="lastNameError" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email<sup style="color: red; font-weight:bolder;">*</sup></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                            <span id="emailError" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number<sup style="color: red; font-weight:bolder;">*</sup></label>
                            <input type="tel" class="form-control" id="phoneNumber" placeholder="Enter your phone number" name="phoneNumber">
                            <span id="phoneError" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dob">Date of Birth<sup style="color: red; font-weight:bolder;">*</sup></label>
                            <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter your date of birth">
                            <span id="dobError" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="city">City<sup style="color: red; font-weight:bolder;">*</sup></label>
                            <input class="form-control" id="city" name="city" placeholder="Enter your city">
                            <span id="cityError" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="selectSociety">Select Your Society<sup style="color: red; font-weight:bolder;">*</sup></label>
                            <select class="form-control" id="selectSociety" name="selectSociety">
                                <option disabled selected>Select your society</option>
                                <option value="add">Add your society if not listed</option>
                                <?php
                                // Fetch all societies from the database
                                $sql = "SELECT society_name FROM society";
                                $result = $conn->query($sql);
                                // Output each society as an option
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['society_name'] . '">' . $row['society_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <br>
                            <div class="form-group" id="addSocietyInput" style="display: none;">
                                <input type="text" class="form-control" id="newSociety" name="newSociety" placeholder="Enter new society name" style="width: 265px;">
                                <span id="newSocietyError" class="text-danger"></span>
                            </div>
                            <span id="selectSocietyError" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="flatNo">Flat No: / House Name:</label>
                            <input type="text" class="form-control" id="flatNo" name="flatNo" placeholder="Enter your flat/house name or no." style="margin-top: 8px;">
                            <span id="flatNoError" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Address<sup style="color: red; font-weight:bolder;">*</sup></label>
                            <textarea rows="4" class="form-control" id="address" name="address" style="margin-top: 8px;" placeholder="Enter your address"></textarea>
                            <span id="addressError" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pincode">Pin Code<sup style="color: red; font-weight:bolder;">*</sup></label>
                            <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Enter Pincode">
                            <span id="pincodeError" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password">Password<sup style="color: red; font-weight:bolder;">*</sup></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                            <span id="passwordError" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password<sup style="color: red; font-weight:bolder;">*</sup></label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password">
                            <span id="confirmPasswordError" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profilePicture">Profile Picture</label>
                            <input type="file" class="form-control-file" name="profilePicture" id="profilePicture" accept="image/*">
                            <span id="photoError" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Image preview -->
                        <img id="imagePreview" src="#" alt="Preview" style="max-width: 200px; max-height: 150px; display: none; float: right;">
                    </div>
                    <script>
                        document.getElementById('profilePicture').addEventListener('change', function(e) {
                            var imagePreview = document.getElementById('imagePreview');
                            imagePreview.style.display = 'block';
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                imagePreview.src = e.target.result;
                            }
                            reader.readAsDataURL(e.target.files[0]);
                        });
                    </script>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="registerBtn" style="display: flex; float:left">
                            <i class="fa fa-check"></i> &nbsp;Register
                        </button>
                        <a href="./index.php" style="display:flex; float: right; margin-top: 35px"><b>Already have an account?</b></a>
                    </div>
                </div>
            </form>
    </div>

    <script src="./JS/Resident/Resident_register.js"></script>
</body>

</html>

<script>
    // Function to handle showing or hiding the input for adding a new society
    function showHideInput() {
        var selectSociety = document.getElementById("selectSociety");
        var addSocietyInput = document.getElementById("addSocietyInput");
        // Check if the selected value is "add"
        if (selectSociety.value === "add") {
            addSocietyInput.style.display = "table-row"; // Show the input
        } else {
            addSocietyInput.style.display = "none"; // Hide the input
        }
    }

    // Add an event listener to the selectSociety dropdown to call showHideInput on change
    document.getElementById('selectSociety').addEventListener('change', showHideInput);

    // Call showHideInput initially to set the correct display state based on the initial value
    showHideInput();
</script>


<script>
    document
        .getElementById("societyForm")
        .addEventListener("submit", function(event) {
            // Function to validate first name
            function validateFirstName() {
                var firstName = document.getElementById("firstName");
                var firstNameError = document.getElementById("firstNameError");
                if (firstName.value.trim() === "") {
                    firstNameError.textContent = "*First Name is required";
                    firstName.classList.add("is-invalid");
                    return false;
                } else {
                    firstNameError.textContent = "";
                    firstName.classList.remove("is-invalid");
                    return true;
                }
            }

            // Function to validate address
            function validateAddress() {
                var address = document.getElementById("address");
                var addressError = document.getElementById("addressError");
                if (address.value.trim() === "") {
                    addressError.textContent = "*Address is required";
                    address.classList.add("is-invalid");
                    return false;
                } else {
                    addressError.textContent = "";
                    address.classList.remove("is-invalid");
                    return true;
                }
            }

            // Function to validate last name
            function validateLastName() {
                var lastName = document.getElementById("lastName");
                var lastNameError = document.getElementById("lastNameError");
                if (lastName.value.trim() === "") {
                    lastNameError.textContent = "*Last Name is required";
                    lastName.classList.add("is-invalid");
                    return false;
                } else {
                    lastNameError.textContent = "";
                    lastName.classList.remove("is-invalid");
                    return true;
                }
            }

            // Function to validate email
            function validateEmail() {
                var email = document.getElementById("email");
                var emailError = document.getElementById("emailError");
                var emailRegex = /^\S+@\S+\.\S+$/; // Basic email validation regex
                if (email.value.trim() === "") {
                    emailError.textContent = "*Email is required";
                    email.classList.add("is-invalid");
                    return false;
                } else if (!emailRegex.test(email.value)) {
                    emailError.textContent = "*Please enter a valid email address";
                    email.classList.add("is-invalid");
                    return false;
                } else {
                    emailError.textContent = "";
                    email.classList.remove("is-invalid");
                    return true;
                }
            }

            // Function to validate phone number
            function validatePhoneNumber() {
                var phoneNumber = document.getElementById("phoneNumber");
                var phoneError = document.getElementById("phoneError");
                var phoneRegex = /^\d{10}$/; // Basic  10-digit phone number validation regex
                if (phoneNumber.value.trim() === "") {
                    phoneError.textContent = "*Phone Number is required";
                    phoneNumber.classList.add("is-invalid");
                    return false;
                } else if (!phoneRegex.test(phoneNumber.value)) {
                    phoneError.textContent = "*Please enter a valid phone number";
                    phoneNumber.classList.add("is-invalid");
                    return false;
                } else {
                    phoneError.textContent = "";
                    phoneNumber.classList.remove("is-invalid");
                    return true;
                }
            }

            // Function to validate pincode
            function validatePincode() {
                var pincode = document.getElementById("pincode");
                var pincodeError = document.getElementById("pincodeError");
                if (pincode.value.trim() === "") {
                    pincodeError.textContent = "*Pincode is required";
                    pincode.classList.add("is-invalid");
                    return false;
                } else {
                    pincodeError.textContent = "";
                    pincode.classList.remove("is-invalid");
                    return true;
                }
            }

            function validatePassword() {
                var password = document.getElementById("password");
                var passwordError = document.getElementById("passwordError");
                var passwordRegex =
                    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/; // Password validation regex

                if (password.value.trim() === "") {
                    passwordError.textContent = "*Password is required";
                    password.classList.add("is-invalid");
                    return false;
                } else if (!passwordRegex.test(password.value)) {
                    passwordError.textContent =
                        "*Password must be at least  8 characters long, contain one uppercase letter, one lowercase letter, one number, and one special character";
                    password.classList.add("is-invalid");
                    return false;
                } else {
                    passwordError.textContent = "";
                    password.classList.remove("is-invalid");
                    return true;
                }
            }

            // Function to validate confirm password
            function validateConfirmPassword() {
                var password = document.getElementById("password");
                var confirmPassword = document.getElementById("confirmPassword");
                var confirmPasswordError = document.getElementById(
                    "confirmPasswordError"
                );

                if (confirmPassword.value.trim() === "") {
                    confirmPasswordError.textContent = "*Confirm Password is required";
                    confirmPassword.classList.add("is-invalid");
                    return false;
                } else if (password.value !== confirmPassword.value) {
                    confirmPasswordError.textContent = "*Passwords do not match";
                    confirmPassword.classList.add("is-invalid");
                    return false;
                } else {
                    confirmPasswordError.textContent = "";
                    confirmPassword.classList.remove("is-invalid");
                    return true;
                }
            }

            // Function to validate date of birth
            function validateDateOfBirth() {
                var dob = document.getElementById("dob");
                var dobError = document.getElementById("dobError");
                if (dob.value.trim() === "") {
                    dobError.textContent = "*Date of Birth is required";
                    dob.classList.add("is-invalid");
                    return false;
                } else {
                    dobError.textContent = "";
                    dob.classList.remove("is-invalid");
                    return true;
                }
            }

            // Function to validate city
            function validateCity() {
                var city = document.getElementById("city");
                var cityError = document.getElementById("cityError");
                if (city.value.trim() === "") {
                    cityError.textContent = "*City is required";
                    city.classList.add("is-invalid");
                    return false;
                } else {
                    cityError.textContent = "";
                    city.classList.remove("is-invalid");
                    return true;
                }
            }

            // Function to validate select your society
            function validateSelectSociety() {
                var selectSociety = document.getElementById("selectSociety");
                var selectSocietyError = document.getElementById("selectSocietyError");
                if (selectSociety.value === "Select your society") {
                    selectSocietyError.textContent = "*Please select your society";
                    selectSociety.classList.add("is-invalid");
                    return false;
                } else {
                    selectSocietyError.textContent = "";
                    selectSociety.classList.remove("is-invalid");
                    return true;
                }
            }

            // Function to validate profile picture
            function validateProfilePicture() {
                var profilePicture = document.getElementById("profilePicture");
                var photoError = document.getElementById("photoError");
                if (profilePicture.files.length === 0) {
                    photoError.textContent = "*Please select the profile picture";
                    return false;
                } else {
                    photoError.textContent = "";
                    return true;
                }
            }
            // Add event listeners to trigger validation on input
            document
                .getElementById("firstName")
                .addEventListener("input", validateFirstName);
            document
                .getElementById("lastName")
                .addEventListener("input", validateLastName);
            document.getElementById("email").addEventListener("input", validateEmail);
            document
                .getElementById("phoneNumber")
                .addEventListener("input", validatePhoneNumber);
            document
                .getElementById("pincode")
                .addEventListener("input", validatePincode);
            document
                .getElementById("password")
                .addEventListener("input", validatePassword);
            document
                .getElementById("confirmPassword")
                .addEventListener("input", validateConfirmPassword);
            // Add event listeners to trigger validation on input3
            document
                .getElementById("address")
                .addEventListener("input", validateAddress);

            document
                .getElementById("dob")
                .addEventListener("input", validateDateOfBirth);
            document.getElementById("city").addEventListener("input", validateCity);
            document
                .getElementById("selectSociety")
                .addEventListener("change", validateSelectSociety);
            // Add event listener to trigger validation on profile picture selection
            document
                .getElementById("profilePicture")
                .addEventListener("change", validateProfilePicture);

            // Event listener for register button
            document
                .getElementById("registerBtn")
                .addEventListener("click", function(event) {
                    event.preventDefault(); // Prevent form submission
                    var isValid = true;
                    // Check all validations
                    isValid = validateFirstName() && isValid;
                    isValid = validateLastName() && isValid;
                    isValid = validateEmail() && isValid;
                    isValid = validatePhoneNumber() && isValid;
                    isValid = validatePincode() && isValid;
                    isValid = validatePassword() && isValid;
                    isValid = validateConfirmPassword() && isValid;
                    isValid = validateDateOfBirth() && isValid;
                    isValid = validateCity() && isValid;
                    isValid = validateSelectSociety() && isValid;
                    isValid = validateAddress() && isValid;
                    isValid = validateProfilePicture() && isValid; // Include the address validation

                    // Final Submission
                    if (isValid) {
                        document.getElementById("registrationForm").submit();
                    }
                });
        });
</script>