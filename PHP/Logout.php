<?php
session_start();
// logout

    unset($_SESSION['user_id']);
    Header("Location:../index.php");
   
?>