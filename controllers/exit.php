<?php

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to a different page or display a message
view('index.view.php');
exit;
?>
