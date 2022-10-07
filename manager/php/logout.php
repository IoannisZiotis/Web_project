<?php

session_start();
// remove all session variables
session_unset($_SESSION['currentmanager']);

// destroy the session
session_destroy();
?>
