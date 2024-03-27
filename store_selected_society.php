<?php
session_start();
include './conn.php'; // Include your database connection file

// Check if selectedSociety is set in POST data
if (isset($_POST['selectedSociety'])) {
    // Store the selected society value in session variable
    $_SESSION['selectedSociety'] = $_POST['selectedSociety'];

    // Fetch the logo path for the selected society from the database
    $selectedSociety = $_POST['selectedSociety'];
    $stmt = $conn->prepare("SELECT society_logo FROM society WHERE society_Name = ?");
    $stmt->bind_param("s", $selectedSociety);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['society_logo']; // Echo the logo path as a response
    } else {
        echo ""; // Return empty string if logo path not found
    }
} else {
    // Handle error if selectedSociety is not set
    echo "Error: Selected society not provided.";
}
