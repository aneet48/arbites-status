<?php 
session_start();
unset($_SESSION['email']);
$url = "http://" . $_SERVER['SERVER_NAME'].'/arbites-status/admin' ; 
header('Location: '.$url);