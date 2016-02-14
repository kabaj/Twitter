<?php
require_once("./src/conection.php");
unset($_SESSION['userId']);
header("Location: login.php");

