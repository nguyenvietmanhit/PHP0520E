<?php
session_start();
//example_demo/show.php
echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : '';
