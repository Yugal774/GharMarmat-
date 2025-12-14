<?php

session_start();

$_SESSION['name']="yugal";

session_unset();
echo $_SESSION['name'];

?>