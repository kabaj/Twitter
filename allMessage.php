<?php
require_once("./src/conection.php");

if (isset($_SESSION['userId']) !== TRUE) {
    header("Location: login.php");
}
echo("<a href='logOut.php'>Wyloguj</a><br>");
echo("<a href='main.php'>Menu</a><br>");

if (isset($_GET['id'])) {
    $tweetId = $_GET['id'];
}

$userId = $_SESSION['userId'];
echo("<h1>Wiadomosci</h1>");
$userToShow = User::GetUserById($userId);

foreach ($userToShow->loadAllReceivedMessages() as $message) {
    $sendingUser = User::GetUserById($message->getSendId());
    echo("<h3>Nadawca: {$sendingUser->getName()}</h3>");
    echo("{$message->getDataWyslania()} <br>");
    echo("{$message->getText()}<br>");
    if ($message->getStatusPrzeczytania() == 1) {
        echo("<a href='message.php?message_id='>Wiecej</a>");
        echo("  |  ");
        echo("<a href='sendwiadomosc.php?receive_id=$userId'>Odpowiedz</a>");
    }
}
    echo("<h2>Wyslane:</h2>");
    foreach ($userToShow->loadAllSentMessages() as $message) {

        $receivingUser = User::GetUserById($message->getReceiveId());
        echo("{$message->getDataWyslania()} <br>");
        echo("{$message->getText()}<br>");
        if ($message->getStatusPrzeczytania() == 1) {
            echo("<a href='message.php?receive_id=$userId'>Wiecej</a>");
            echo("<br>");
        }
    }

