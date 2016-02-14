<?php

require_once("./src/conection.php");
if(isset($_SESSION['userId']) !== TRUE){
    header("Location: login.php");
}
echo("<a href='main.php'>Menu</a><br>");
$allTweets = Tweet::ShowAllTweets();
echo("<h1>News Feed</h1>");
foreach($allTweets as $tweetToShow){
    $userId = $tweetToShow->getUserId();
    $tweetingUser = User::GetUserById($userId);
    echo("<h2>{$tweetingUser->getName()}</h2>");
    if($_SESSION['userId'] != $userId){
        echo("<a href='showUser.php?userId=$userId'>Profil</a> <br />");
    }
    echo("{$tweetToShow->getTweetText()} <br />");
    echo("{$tweetToShow->getTweetDate()}<br>");
    $tweetToShowId = $tweetToShow->getId();
    $coms = count($tweetToShow->getAllComments());
    echo("Liczba komentarzy: $coms <br />");
    echo("<a href='showTweet.php?id={$tweetToShow->getId()}'>Dodaj komentarz </a>");
    if($_SESSION['userId'] == $userId){
        echo("  |  ");
        echo("<a href='showTweet.php?id=$tweetToShowId'>Pokaz tweeta </a>");
        echo("  |  ");
        echo("<a href='editTweet.php?id=$tweetToShowId'> Edytuj</a>");
        echo("  |  ");
        echo("<a href='deleteTweet.php?id=$tweetToShowId'> Usun</a>");
    }
    echo("<hr />");
}
