<?php 
    require_once('config.php');
    session_start();
    if(isset($_POST['login'])){
        $username  = $_POST['username'];
        $email = $_POST['username'];
        $password = md5($_POST['password']);
        
        $select = $db->prepare("SELECT * FROM `user` WHERE username = ? OR email = ? ");
        $select->execute([$username, $email]);
        $row = $select->fetch(PDO::FETCH_ASSOC);

        if(empty($username)){
            $error[] = 'please enter username or email';
        }else if(empty($password)){
            $error[] = 'please enter password';
        }else{
            if($select->rowCount() > 0){
                if($username == $row['username'] OR $email == $row['email']){
                    if($password == $row['password']){
                        $_SESSION['user'] = $row['id'];
                        $error[] = 'login success';
                        header('refresh:1;welcome.php');
                    }else{
                        $error[] = 'password is not valid';
                    }
                }else{
                    $error[] = 'username and email is not valid';
                }
        }else{
            $error[] = "Wrong username or email";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
        <div class="form">
            <h1>Login</h1>
            <?php if(isset($error)){
                foreach($error as $error){
            ?>
            <div class="alert">
                    <?php echo $error ?>
            </div>
            <?php 
                    }
                }
            ?>
            <form action="" method="post">
            <label  for="username">username</label>
            <input class="box" type="text" name="username" placeholder="please enter username or email">
            <br>
            <label for="password">password</label>
            <input class="box" type="password" name="password" placeholder="please enter password">
            <button class="button" name="login" type="submit">login now</button>
            </form>
           <p>you don't have account  <a href="register.php">register now</a></p>
        </div>
</body>
</html>