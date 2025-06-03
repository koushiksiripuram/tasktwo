
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$conn = new mysqli('localhost', 'root', 'koushiksiripuram', 'blog');

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}
$username=$_SESSION['username'];
$res=$conn->query("select id from users where username='$username';");
$row=$res->fetch_assoc();
$id=$row['id'];

$query = "select * from posts where id='$id';";
$result = $conn->query( $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Interface</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Posts</h1>
    <a href="create.php">Create New Post</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['content']; ?></td>
            <td>
                <?php $_SESSION['title']=$row['title'] ?>
                <a href="update.php?title=<?php echo $row['title'];?>">Edit</a>
                <a href="delete.php?title=<?php echo $row['title'];?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <a href="logout.php">logout</a>
</body>
</html>