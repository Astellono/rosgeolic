<?php
    $connect = new mysqli('localhost', 'root', 'root', 'volley_bd');
    if (!$connect) {
        die('Error');
    } 
