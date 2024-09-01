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
    require "header.php";
    require "db.php";
    $select = $db->prepare('select * from users');
    $select->execute();
    $users = $select->fetchAll(PDO::FETCH_OBJ);
    $totalUsers = count($users);

    $err = '';

    if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['password'])) {
        if ($_POST['password'] === $_POST['confirmPassword']) {
            $newUserId = $totalUsers + 1;
            $sql = $db->prepare('insert into users values(? ,? , ?, ?, ?, ?)');
            $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(32)); 
            $sql->execute([$newUserId, $_POST['name'], $_POST['email'], $_POST['phone'], $hashed_password,$token]);
            header("location:login.php");
        } else {
            $err = 'Password is Not Match';
        };
    };

    ?>
    <div class="formDiv">
        <form action="signIn.php" method="post">
            <div>
                <p class="formTitle">Sign In</p>
            </div>
            <div class="inputsDiv">
                <p>Name</p>
                <input type="text" name="name">
            </div>
            <div class="inputsDiv">
                <p>Email</p>
                <input type="text" name="email">
            </div>
            <div class="inputsDiv">
                <p>Phone</p>
                <input type="text" name="phone">
            </div>
            <div class="inputsDiv">
                <p>Password</p>
                <input type="password" name="password">
            </div>
            <div class="inputsDiv">
                <p>Confirm Password</p>
                <input type="password" name="confirmPassword">
                <?php if (!empty($err)) { ?>
                    <div>
                        <p><?php echo $err ?></p>
                    </div>
                <?php } ?>
            </div>
            <div style="display: flex; flex-direction: column; gap: 10px;">
                <input class="signButton" type="submit" value="Sign In">
                <a href='login.php' style="text-decoration: underline;color: #00b4d8;font-size: 14px;">You Already Have an Account</a>
            </div>
        </form>
    </div>
    <?php require "footer.php" ?>
</body>

</html>