document
  .getElementById("societyForm")
  .addEventListener("submit", function (event) {
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
      .addEventListener("click", function (event) {
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
