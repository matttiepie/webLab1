<?php
// Check if the "cs4413" cookie is already set
if (isset($_COOKIE['cs4413'])) {
    // Cookie is already set
    echo "The 'cs4413' cookie is already set with the value: " . $_COOKIE['cs4413'];
} else {
    // Cookie is not set, so let's set it
    $cookieValue = "example_value";
    $expirationTime = time() + 3600; // 1 hour from now

    setcookie('cs4413', $cookieValue, $expirationTime, '/');

    echo "The 'cs4413' cookie has been set with the value: " . $cookieValue;
}
?>
