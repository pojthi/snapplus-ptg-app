<?php
session_start();

$dateWithTime = isset($_SESSION['dateWithTime']) ? $_SESSION['dateWithTime'] : "";

echo $dateWithTime;
?>