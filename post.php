<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
require "db.php";
require "header.php";

if (isset($_POST['show'])) {
    $sql = $db->prepare('select * from offers where id = ?');
    $sql->execute([$_POST['show']]);
    $offer = $sql->fetch(PDO::FETCH_OBJ);
}
?>

<body>
    <div>
        <a href="index.php"><button  style="background-color: #4A90E2; width: 100px;padding: 10px 10px;border: none; border-radius: 5px;color: white; margin:10px">Back</button></a>
    </div>
    <div style="width: 100%;display: flex;flex-direction: column;justify-content: center;gap: 30px;align-items: center;">
        <div style="background-color: white; padding: 30px;width: 80%;box-shadow: 0px 2px 3px -1px rgba(0,0,0,0.1), 0px 1px 0px 0px rgba(25,28,33,0.02), 0px 0px 0px 1px rgba(25,28,33,0.08);border-radius: 8px;">
            <div style="display: flex;justify-content: space-between;align-items: center;">
                <div style="display: flex;flex-direction: column;gap: 10px;">
                    <p style="font-size: 35px;"><?php echo $offer->title ?></p>
                    <div style="display: flex;flex-direction: column;gap: 10px;">
                        <div style="display: flex; align-items: center;gap: 10px;">
                            <img width="30" height="30" src="https://img.icons8.com/ios-filled/100/4a90e2/company.png" alt="company" />
                            <p style="font-size: 13px;"><?php echo $offer->entreprise ?></p>
                        </div>
                        <div style="display: flex; align-items: center;gap: 10px;">
                            <img width="30" height="30" src="https://img.icons8.com/glyph-neue/64/4a90e2/address.png" alt="address" />
                            <p style="font-size: 13px;"><?php echo $offer->entreprise ?></p>
                        </div>
                    </div>
                </div>
                <div>
                    <div style="background-color: #9bc4f4;display: flex;align-items: center;gap: 10px;padding: 10px;border-radius: 5px;">
                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/100/4a90e2/business.png" alt="business" />
                        <p style="font-size: 18px;color: white;"><?php echo $offer->type ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div style="background-color: white; padding: 30px;width: 80%;display: flex;flex-direction: column;gap: 20px;box-shadow: 0px 2px 3px -1px rgba(0,0,0,0.1), 0px 1px 0px 0px rgba(25,28,33,0.02), 0px 0px 0px 1px rgba(25,28,33,0.08);border-radius: 8px;">
            <div style="display: flex;flex-direction: column;gap: 30px;">
                <p style="font-size: 30px;">Description du poste</p>
                <p style="color:#6c757d;font-size: larger;"><?php echo $offer->description ?></p>
            </div>
            <div>
                <button style="background-color: #4A90E2; width: 100px;padding: 10px 10px;border: none; border-radius: 5px;color: white;display: flex;justify-content: space-evenly;align-items: center;">
                    <img width="24" height="24" src="https://img.icons8.com/material-rounded/24/FFFFFF/send.png" alt="send" />
                    <p>Send</p>
                </button>
            </div>
        </div>
    </div>
</body>

</html>