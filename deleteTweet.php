<?php

require_once("./src/conection.php");
if (isset($_SESSION['userId']) !== TRUE) {
    header("Location: login.php");
}
    $id = $_GET['id'];
$tweetToRemove = Tweet::LoadTweetById($id);
$userId = User::GetUserById($id);
if ($_SESSION['userId'] == $tweetToRemove->getUserId()) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tweetToRemove->removeTweet();
        header("Location: showUser.php?userId=".$userId->getId());
    }
    echo("
    <form method='POST'>
    <p>
    Napewno chcesz usunac tweeta?
    </p>
    <input type='submit' value='Usun'>
    </form>");
}
else{
    echo("Nie da rady");
}
