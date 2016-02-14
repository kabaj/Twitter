<?php

require_once("./src/conection.php");

if (isset($_SESSION['userId']) !== TRUE) {
    header("Location: login.php");
}
if (isset($_GET["userId"])) {
    $userId = $_GET["userId"];
} else {
    $userId = $_SESSION['userId'];
}
echo("<a href='main.php'>Menu</a><br>");

if ($_SESSION['userId'] != $userId) {
    echo("<a href='sendwiadomosc.php?receive_id=$userId'>Prywatny tweet ;)</a>");
}


if($_SERVER["REQUEST_METHOD"]=== "GET") {
    $userId = $_GET["userId"];
    $userToShow = User::GetUserById($userId);


    if ($userToShow !== false) {
        echo("<h1>{$userToShow->getName()}</h1>");
        echo("O mnie: {$userToShow->getDescription()} <br />");
        if ($userToShow->getId() === $_SESSION['userId']) {
            echo("
                <h1>Nowy tweet :</h1>
                <form action='showUser.php' method='post'>
                <input type='text' name='tweet_text'>
                <input type='submit'>
                </form>
                ");
        }
    }


    foreach ($userToShow->loadAllTweets() as $tweet) {

        echo("<h2>{$userToShow->getName()}</h2>");
        echo("{$tweet->getTweetText()} <br>");
        echo("{$tweet->getTweetDate()}<br>");
        $tweetId = $tweet->getId();
        $coms = count($tweet->getAllComments());
        echo("Liczba komentarzy: $coms <br />");
        echo("<a href='showTweet.php?id={$tweetId}'>Pokaz tweeta </a>");
        if ($_SESSION['userId'] == $userId) {
            echo("  |  ");
            echo("<a href='editTweet.php?id={$tweetId}'> Edytuj</a>");
            echo("  |  ");
            echo("<a href='deleteTweet.php?id={$tweetId}'> Usun</a>");
        }
    }
} else {
    echo("Nie ma takiego");
}


if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    if (strlen(trim($_POST['tweet_text'])) > 0) {
        $tweetText = $_POST['tweet_text'];
        $tweet = Tweet::CreateTweet($tweetText);
        header("Location: showUser.php?userId=".$userId);
    } else {
        echo("Niestety nie utworzyl sie :(");
    }
}


?>

