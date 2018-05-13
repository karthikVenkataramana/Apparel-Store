<?php
session_start();
$_SESSION["type"] = $_POST["type"];
echo 'true';
?>