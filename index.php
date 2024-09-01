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

$select = $db->prepare('select * from offers order by id desc');
$select->execute();
$offers = $select->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['search'])) {
    $searchTerm = '%' . $_POST['search'] . '%';
    $searchSql = $db->prepare("select * from offers where title like ? order by id desc");
    $searchSql->execute([$searchTerm]);
    $offersBySearch = $searchSql->fetchAll(PDO::FETCH_OBJ);
    $offers = $offersBySearch;
}


if (isset($_GET['type'])) {
    $types = $_GET['type'];
    $filter = $db->prepare('SELECT * FROM offers WHERE type IN (' . implode(',', array_fill(0, count($types), '?')) . ')');
    $filter->execute($types);
    $results = $filter->fetchAll(PDO::FETCH_OBJ);
    $offers = $results;
}

if (empty($offers)) {
    $searchErr = 'The Jobs search returns no results.';
}

?>

<div class="indexBody">
    <header class="indexheader">
        <form action="index.php" method="post" style="display: flex; gap: 5px; background-color: aliceblue; padding: 10px 10px 10px 10px; border-radius: 100px;">
            <input name="search" class="indexSearchInput" type="text" value="<?php if (!empty($_POST['search'])) {
                                                                                    echo $_POST['search'];
                                                                                } else {
                                                                                    '';
                                                                                } ?>">
            <button type="submit" class="indexSearchButton">Search</button>
        </form>
        <p style="color: white;font-size: 25px;font-weight: 600;">For Job Seekers: Discover Your Next Opportunity</p>
    </header>

    <div style="display: flex; flex-direction:column;gap: 20px; margin: 30px 0px;justify-content: center;">
        <div style="display: flex;flex-direction: column;gap: 20px; justify-content: start; width: 50%; margin: 0px 30px">
            <p style="font-size: 35px;">Recommended Jobs</p>
        </div>
        <div style="display: flex; justify-content: space-between; width: 100%;padding: 20px;width: 100%;">
            <form action="index.php" method="GET" style="width: 20%; height: 600px; background-color: white;border: 1px #ddd solid;border-radius: 8px; padding: 20px">
                <p style="font-size: 30px;color :#4A90E2; font-weight :600">Filter</p>
                <div style="margin-top: 20px;display: flex;flex-direction: column;gap: 10px;padding: 5px;">
                    <div>
                        <p style="font-size: 20px;">Type</p>
                        <div style="padding: 15px; display: flex;flex-direction: column;gap: 10px;">
                            <div style="display: flex;gap: 10px">
                                <input type="checkbox" name="type[]" value="stage">
                                <p>Offers de stage</p>
                            </div>
                            <div style="display: flex;gap: 10px">
                                <input type="checkbox" name="type[]" value="emploi">
                                <p>Offer de emploi</p>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Search" style="width: 100%; background-color:#4A90E2 ;border : none; color:white ; padding:10px ; border-radius: 4px;">
            </form>
            <div style="width: 75%;">
                <p><?php if (empty($offers)) {
                        echo $searchErr;
                    } ?></p>
                <div style="width: 100%; display: flex; flex-wrap: wrap; gap: 30px;justify-content: start;">
                    <?php foreach ($offers as $offer) { ?>
                        <div style="width: 300px;height: 200px; display: flex; flex-direction: column;  justify-content: space-between;  border: 1px #ddd solid;border-radius: 8px;padding: 20px;background-color: white;">
                            <div style="display: flex; flex-direction:column ;gap: 10px;">
                                <p class="userOfferTtitle"><?php echo $offer->title ?></p>
                                <p style="font-size: 13px;">Type <?php echo $offer->type ?></p>
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
</div>

</html>