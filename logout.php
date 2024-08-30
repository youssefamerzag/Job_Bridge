<?php

require 'db.php';
session_start();

$sql = $db->prepare('update users set token = NULL where id = ?');
$sql->execute([$_SESSION['user_id']]);

$_SESSION = [];

// Destroy the session
session_destroy();

header('Location: login.php');
exit();
