<?php

require 'header.php';
require 'db.php';


if (isset($_SESSION['user_id'], $_SESSION['token'])) {
    $select = $db->prepare('SELECT * FROM users WHERE id = ? AND token = ?');
    $select->execute([$_SESSION['user_id'], $_SESSION['token']]);
    $authenticatedUser = $select->fetch(PDO::FETCH_OBJ);

    if (!$authenticatedUser) {
        header('Location: login.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}


$select = $db->prepare('select * from offers where user_id = ?');
$select->execute([$_SESSION['user_id']]);
$offers = $select->fetchAll(PDO::FETCH_OBJ);


?>

<head>
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <div style="display: flex; justify-content: space-between;padding: 20px;">
        <p style="font-size: 35px;">Profile</p>
        <div>
            <button onclick="location.href='createOffer.php'" style="background-color: #4A90E2; padding: 10px 20px 10px 20px ; border: none; border-radius: 3px; color: white">Create Offer</button>
        </div>
    </div>
    <div class="userBox">
        <div class="userProfileBox">
            <div>
                <img width="100" height="100" src="https://img.icons8.com/ios/100/4a90e2/user--v1.png" alt="user--v1" />
            </div>
            <div style="display: flex ; flex-direction: column; gap : 20px">
                <div style="display: flex; gap: 5px">
                    <p style="font-size: 35px;"><?php echo $_SESSION['user_name'] ?></p>
                </div>
                <div style="display: flex;flex-direction: column;gap: 10px;">
                    <div style="display: flex; gap: 10px;align-items: center;">
                        <img width="20" height="20" src="https://img.icons8.com/ios-filled/50/4a90e2/new-post.png" alt="new-post" />
                        <p><?php echo $_SESSION['user_email'] ?></p>
                    </div>
                    <div style="display: flex; gap: 10px;align-items: center;">
                        <img width="20" height="20" src="https://img.icons8.com/ios-filled/50/4a90e2/phone.png" alt="phone" />
                        <p><?php echo $_SESSION['user_phone'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display: flex; flex-direction:column;gap: 20px; margin: 30px 0px;justify-content: center;">
        <div style="display: flex; justify-content: start; width: 50%; margin: 0px 30px">
            <p style="font-size: 35px;">My Offers</p>
        </div>
        <div style="display: flex; justify-content: center; width: 100%;">
            <div style="width: 100%; display: flex; flex-wrap: wrap; gap: 30px;justify-content: center;">
                <?php foreach ($offers as $offer) { ?>
                    <div style="width: 300px;height: 220px; display: flex; flex-direction: column;  justify-content: space-between;  border: 1px #ddd solid;border-radius: 8px;padding: 20px;background-color: white;">
                        <div style="display: flex; flex-direction:column ;gap: 10px;">
                            <p class="userOfferTtitle"><?php echo $offer->title ?></p>
                            <p class="userOfferDescription"><?php echo $offer->description ?></p>
                        </div>
                        <form action="index.php" method="post" style="width: 100%;display: flex; flex-direction: column;gap: 10px;">
                            <div style="display: flex; align-items: center;gap: 10px;">
                                <img width="20" height="20" src="https://img.icons8.com/ios-filled/100/4a90e2/company.png" alt="company" />
                                <p style="font-size: 13px;"><?php echo $offer->entreprise ?></p>
                            </div>
                            <button type="submit" style="width: 100%;background-color: #4A90E2; color:white;padding: 10px 10px ;border: none;border-radius: 5px;" formaction="post.php" name="show" value="<?php echo $offer->id ?>">show</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>