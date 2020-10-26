<?php
session_start();
    unset($_SESSION["userid"]);
   unset($_SESSION["username"]);
   unset($_SESSION["email"]);
    header('Refresh: 0; URL = index.php');
    ?>