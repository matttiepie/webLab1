<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the first and last names from the form
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];

    // Create a data string to write to the file
    $data = $firstName . ' ' . $lastName . "\n";

    // Specify the path to the non-public folder where the data will be stored
    $filePath = 'data/data.txt';

    // Open the file for appending
    $file = fopen($filePath, 'a');

    if ($file) {
        // Write the data to the file
        fwrite($file, $data);

        // Close the file
        fclose($file);

        echo 'Data saved successfully.';
        include('show_contents.php');
    } else {
        echo 'Failed to open the file for writing.';
    }
} else {
    echo 'Invalid request.';
}
?>
