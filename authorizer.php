<?php
session_start();
$host='localhost';
$user='root';
$password='koushiksiripuram';
$db='blog';

$conn=new mysqli($host,$user,$password,$db);

if($conn->connect_error){
    echo connect_error;
}
else{
    echo "successfully done";
    $password=$_POST['password'];
    $username=$_POST['username'];
    $query="select password from users where username='$username';";
    $res=$conn->query($query);
    if($res->num_rows>0){
        $row=$res->fetch_assoc();
        if($row['password']===$password){
            
            $_SESSION['username']=$username;
            header("Location:crud.php");
        }
        else{
            echo "invalid password";
        }

    }
    else{
        echo "invalid username or password";
    }
}


?>