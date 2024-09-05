<?php
require 'header.php';
require 'db.php';

if(empty($_SESSION['user_id'])){
    header('Location: login.php');
}

if(isset($_POST['title'] , $_POST['entreprise'], $_POST['description'], $_POST['type'],$_POST['address'])){

    $getMaxId = $db->prepare('select MAX(id) as max_id from offers');
    $getMaxId->execute();
    $result = $getMaxId->fetch(PDO::FETCH_OBJ);

    $nextId = ($result->max_id)? $result->max_id + 1 : 1; 

    $sql = $db->prepare('insert into offers values (?, ?, ?, ?, ?, ?, ?)');
    $sql->execute([$nextId, $_POST['title'] , $_POST['description'] ,$_POST['address'], $_POST['entreprise'] , $_POST['type'] , $_SESSION['user_id']]);
    header('Location: index.php');
}

?>

<div style="display: flex;justify-content: center;align-items: center;  height: 120vh;">
    <form action="createOffer.php" method="post" style="display: flex;flex-direction: column;gap: 20px; width: 100%; max-width: 600px;  padding: 20px;  background-color: #ffffff;  border-radius: 8px;  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
        <p class="formTitle">Post a job offer</p>
        <div style="display: flex;flex-direction: column;gap: 5px;">
            <p>Title</p>
            <input style="padding: 10px 5px 10px 5px;  width: 100%;  border: 1px solid #ddd;  border-radius: 4px;  font-size: 16px;" type="text" name="title" placeholder="Title...">
        </div>
        <div style="display: flex;flex-direction: column;gap: 5px;">
            <p>Entreprise</p>
            <input style="padding: 10px 5px 10px 5px;  width: 100%;  border: 1px solid #ddd;  border-radius: 4px;  font-size: 16px;" type="text" name="entreprise" placeholder="Entreprise...">
        </div>
        <div style="display: flex;flex-direction: column;gap: 5px;">
            <p>Adress</p>
            <input style="padding: 10px 5px 10px 5px;  width: 100%;  border: 1px solid #ddd;  border-radius: 4px;  font-size: 16px;" type="text" name="address" placeholder="Adress...">
        </div>
        <div style="display: flex;flex-direction: column;gap: 5px;">
            <p>Type</p>
            <select name="type" style="padding: 10px 5px 10px 5px;  width: 100%;  border: 1px solid #ddd;  border-radius: 4px;  font-size: 16px;">
                <option></option>
                <option>Stage</option>
                <option>Emploi</option>
            </select>
        </div>
        <div style="display: flex;flex-direction: column;gap: 5px;">
            <p>Description</p>
            <textarea style="padding: 10px 5px 10px 5px;  width: 100%;  border: 1px solid #ddd;  border-radius: 4px;  font-size: 16px; height: 100px;" name="description" placeholder="Description..."></textarea>
        </div>
        <input type="submit" value="Post a job offer" class="signButton">
    </form>
</div>