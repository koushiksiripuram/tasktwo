
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
$flag=true;
$conn = new mysqli('localhost', 'root', 'koushiksiripuram', 'blog');

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}
$old_title=$_GET['title'];
$result=$conn->query("select * from posts where title='$old_title';");
$row=$result->fetch_assoc();
$id=$row['id'];
if(isset($_POST['submit'])){
    $newt=$_POST['title'];
    $content=$_POST['content'];
    $time=date("Y-m-d H:i:s");

    if($conn->query("update posts set title='$newt',content='$content',created_at='$time',id='$id' where title='$old_title';")){
        $flag=true;
        $result=$conn->query("select * from posts where title='$old_title';");
    $row=$result->fetch_assoc();
    $id=$row['id'];
    }
    else{
        $flag=false;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Interface</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Posts</h1>
    
    <form action="update.php" method="post">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo $row['title']?>"><br><br>
        <label>Content:</label>
        <input type="textarea" name="content" value="<?php echo $row['content']?>"> <br> <br>
        <input type="submit" name="submit" value="update">
    </form>
    <h3><?php if(!$flag&&isset($_POST['submit'])){
        echo "unable to update the post";
        }?></h3>
    <h3>click here once you <a href="crud.php">done</a></h3>
</body>
</html>