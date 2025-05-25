<?php

require_once 'php/connect.php';
// require_once 'php/filter.php';
session_start();
print_r($_GET);
$authorityId = $_GET['authId'];


$result = $connect->query("SELECT * from `licensingauthorities` where `authority_id` = '$authorityId'");
$dataAuth = $result->fetch_assoc();


print_r($authorityId)

?>