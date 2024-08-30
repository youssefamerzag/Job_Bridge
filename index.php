<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<?php
    require "header.php";
    require "db.php";

    $select = $db->prepare('select * from offers');
    $select->execute();
    $offers = $select->fetchAll(PDO::FETCH_OBJ);
?>

<div class="indexBody">
    <header class="indexheader">
        <div style="display: flex; gap: 5px; background-color: aliceblue; padding: 10px 10px 10px 10px; border-radius: 100px;">
            <input class="indexSearchInput" type="text">
            <button class="indexSearchButton">Search</button>
        </div>
        <p style="color: white;font-size: 25px;font-weight: 600;">For Job Seekers: Discover Your Next Opportunity</p>
    </header>

    <div style="display: flex; flex-direction:column;gap: 20px; margin: 30px 0px;justify-content: center;">
        <div style="display: flex; justify-content: start; width: 50%; margin: 0px 30px">
            <p style="font-size: 35px;">Recommended Jobs</p>
        </div>
        <div style="display: flex; justify-content: center; width: 100%;">
            <div class="offers">
                <?php foreach ($offers as $offer) { ?>
                    <div class="offer">
                        <div style="display: flex; flex-direction:column ;gap: 10px;">
                            <p class="userOfferTtitle"><?php echo $offer->title ?></p>
                            <p class="userOfferDescription"><?php echo $offer->description ?></p>
                        </div>
                        <div style="display: flex; align-items: center;gap: 10px;">
                            <img width="20" height="20" src="https://img.icons8.com/ios-filled/100/4a90e2/company.png" alt="company" />
                            <p><?php echo $offer->entreprise ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

</html>