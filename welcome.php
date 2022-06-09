<?php 
    require_once('config.php');
    session_start();
    
    if(!isset($_SESSION['user'])){
        header('location:index.php');
    }else{
        $id = $_SESSION['user'];
        $select = $db->prepare("SELECT * FROM `user` WHERE id = ?");
        $select->execute([$id]);
        $row = $select->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <h1>welcome <?php echo $row['username']?></h1>
        <a href="logout.php">logout</a>
</body>
</html>
<?php } ?>