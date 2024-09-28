<?php
$serverName = 'localhost';
$serverUserName = 'root';
$serverPassword = '';
$databaseName = 'mec-users';
$conn = mysqli_connect($serverName,$serverUserName,$serverPassword,$databaseName);
if(!$conn){
    die('ERROR').mysqli_connect_error();
}
$errors = [];
session_start();