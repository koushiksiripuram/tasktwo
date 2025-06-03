<?php
session_start();
$title=$_SESSION['title'];


$conn=new mysqli('localhost','root','koushiksiripuram','blog');
$conn->query("delete from posts where title='$title'");
header("Location:crud.php");
?>