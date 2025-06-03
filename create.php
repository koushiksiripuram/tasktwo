
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
$flag=false;
$conn = new mysqli('localhost', 'root', 'koushiksiripuram', 'blog');

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}
$username=$_SESSION['username'];
$res=$conn->query("select id from users where username='$username';");
$row=$res->fetch_assoc();
$id=$row['id'];

if(isset($_POST['submit'])){
    $title=$_POST['title'];
$content=$_POST['content'];
$time=date("Y-m-d H:i:s");

$query="insert into posts values('$id','$title','$content','$time')";
if($conn->query($query)){
    $flag=true;
}
else{
    $flag=false;
}
}
$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Interface</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Posts</h1>
    
    <form action="create.php" method="post">
        <label>Title:</label>
        <input type="text" name="title" ><br><br>
        <label>Content:</label>
        <input type="textarea" name="content"> <br> <br>
        <input type="submit" name="submit" value="Create">
    </form>
    <h3><?php if(!$flag&&isset($_POST['submit'])){
        echo "unable to create the post";
        }?></h3>
    <h3>click here once you <a href="crud.php">done</a></h3>
</body>
</html>