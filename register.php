<?php 
    require_once('config.php');
    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $cpassword = md5($_POST['cpassword']);

        $select = $db->prepare("SELECT username, email FROM `user` WHERE username = ? OR email = ?");
        $select->execute([$username, $email]);
        $row = $select->fetch(PDO::FETCH_ASSOC);

        if(empty($username)){
            $error[] = 'please enter username';
        }else if(empty($email)){
            $error[] = 'please enter email';
        }else if(empty($password)){
            $error[] = 'please enter password';
        }else if(empty($cpassword)){
            $error[] = 'please enter confirm password';
        }else{
            if($username != $row['username'] ){
                if($email != $row['email']){
                    if($password == $cpassword){
                        if($password > 6 OR $cpassword > 6){
                            $insert = $db->prepare("INSERT INTO `user` (username,email,password) VALUES(?,?,?)");
                            $insert->execute([$username, $email, $cpassword]);
                            $error[] = 'register success';
                            header('refresh:1;index.php');
                        }else{
                            $error[] = 'password must be 6 character';
                        }
                    }else{
                        $error[] = 'please check password and confirm password';
                    }
                }else{
                    $error[] = 'email is already exit';
                }
            }else{
                $error[] = 'username is already exit';
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
    <title>Register</title>
</head>
<body>
       
        <div class="form">
            <h1>Register</h1>
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
                <input class="box" type="text" name="username" placeholder="please enter username">
                <br>
                <label for="email">email</label>
                <input class="box" type="email" name="email" placeholder="please enter email">
                <br>
                <label for="password">password</label>
                <input class="box" type="password" name="password" placeholder="please enter password">
                <br>
                <label for="password">confirm password</label>
                <input class="box" type="password" name="cpassword" placeholder="confirm your password">
                <button class="button" name="register" type="submit">register now</button>
            </form>
           <p>you have account  <a href="index.php">login now</a></p>
        </div>
</body>
</html>