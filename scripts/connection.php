<?php
$server='localhost';
$user='fserv';
$password='Kuku0317_';
$conn= new mysqli($server,$user,$password);
if(mysqli_connect_error()){
die ('Could not connect to server '.$server.', error: '.mysqli_connect_errno().' - '.mysqli_connect_error());
}
