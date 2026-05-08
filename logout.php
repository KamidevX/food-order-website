<?php

// constants
include('../config/constants.php');

// destroy session
session_destroy();

// redirect
header("Location: " . SITEURL . "admin/login.php");
exit();
?>