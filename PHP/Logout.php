<?php
session_start();
// logput
    unset($_SESSION['user_id']);
    Header("Location:../index.php");
?>