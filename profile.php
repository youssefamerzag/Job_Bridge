<?php

require 'header.php';
require 'db.php';

$select = $db->prepare('select * from offers where user_id = ?');
$select->execute([$_SESSION['user_id']]);
$offers = $select->fetchAll(PDO::FETCH_OBJ);


?>

<div>
    <div style="display: flex; justify-content: space-between;padding: 20px;">
        <p style="font-size: 30px;font-weight: 400;">Profile</p>
        <div>
            <button style="background-color: #4A90E2; padding: 10px 20px 10px 20px ; border: none; border-radius: 3px; color: white">Create Offer</button>
        </div>
    </div>
    <div>
        <div></div>
        <div style="display: flex ; flex-direction: column; gap : 10px">
            <div style="display: flex; gap: 5px">
                <p>Name :</p>
                <p><?php echo $_SESSION['user_name'] ?></p>
            </div>
            <div style="display: flex; gap: 5px">
                <p>Email :</p>
                <p><?php echo $_SESSION['user_email'] ?></p>
            </div>
            <div style="display: flex; gap: 5px">
                <p>Phone :</p>
                <p><?php echo $_SESSION['user_phone'] ?></p>
            </div>
        </div>
    </div>

    <div>
        <div>
            <p>Offers</p>
        </div>
        <?php foreach($offers as $offer) { ?>
            <div>
                <p><?php echo $offer->title ?></p>
                <p><?php echo $offer->description ?></p>
                <p><?php echo $offer->entreprise ?></p>
            </div>
        <?php } ?>
    </div>
</div>