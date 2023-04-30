<?php

include '../config/connect.php';
session_start();
session_destroy();
session_unset();
header("location: logn.php");
?>