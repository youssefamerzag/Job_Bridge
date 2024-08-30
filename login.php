<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php 
    require "header.php" ;
    require "db.php";

    if(isset($_POST['email'] , $_POST['password'])){
        $select = $db->prepare('SELECT * from users where email = ?');
        $select->execute([$_POST['email']]);
        $user = $select->fetch(PDO::FETCH_OBJ);
        if(password_verify($_POST['password'] , $user->password)){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_phone'] = $user->phone;
            header('Location: index.php');
        }
    }

    ?>
    <div class="formDiv">
        <form action="login.php" method="post">
            <div>
                <p class="formTitle">Sign In</p>
            </div>
            <div class="inputsDiv">
                <p>Email</p>
                <input type="text" name="email">
            </div>
            <div class="inputsDiv">
                <p>Password</p>
                <input type="password" name="password">
            </div>
            <input type="submit" class="signButton" value="Sign In">
        </form>
    </div>
    <?php require "footer.php" ?>
</body>

</html>
