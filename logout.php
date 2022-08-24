<?php
 session_start();
 //error_reporting(0);
 session_destroy();
 $_SESSION = null;
 header("Location: index.php");
?>