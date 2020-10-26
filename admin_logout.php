<?php
session_start();
 unset($_SESSION['adminid']);
 unset($_SESSION['admin_name']);
    header('Refresh: 0; URL = index.php');
    ?>