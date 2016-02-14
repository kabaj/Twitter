<<?php
require_once ("./src/conection.php");
if(!isset($_SESSION['userId'])){
    header("Location:login.php");
}
echo("<a href='logOut.php'>Wyloguj</a><br>");
echo("<a href='main.php'>Menu</a><br>");





$msgId = $_GET['message_id'];
$msgToShow = Message::getMessageById($id);

echo("{$msgToShow->getDataWyslania()}");
echo("<p>{$msgToShow->getText()}</p>");


/*
$messageToShow = Message::getMessageById($messageId);
if($messageToShow->getSendId() == $_SESSION['userId'] || $messageToShow->getReceiveId() == $_SESSION['userId']) {
    $sendingUser = User::GetUserById($messageToShow->getSendId());
    $receiveingUser = User::GetUserById($messageToShow->getReceiveId());
//var_dump($receiveingUser);
    if ($_SESSION['userId'] == $messageToShow->getReceiveId()) {
        $messageToShow->changeStatus();
    }
    echo("<strong> Odbiorca:</strong> {$receiveingUser->getName()} <br />
    <strong>Nadawca:</strong> {$sendingUser->getName()} <br />
    <strong>Tresc: </strong> {$messageToShow->getMessageText()} <br />
    {$messageToShow->getMessageDate()} <br />");
    if ($_SESSION['userId'] != $messageToShow->getReceiveId()) {  //wysłanie kolejnej wiadomości do tego samego użytkownika
        echo("<a href='sendwiadomosc.php?id={$receiveingUser->getId()}'>Wyślij kolejną wiadomość do {$receiveingUser->getName()}</a> <br />");
    }
    if ($_SESSION['userId'] != $messageToShow->getSendId()) {  //wysłanie odpowiedzi na wiadomość użytkownika
        echo("<a href='sendwiadomosc.php?id={$sendingUser->getId()}'>Odpowiedz użytkownikowi {$sendingUser->getName()}</a> <br />");
    }
    echo("<a href='allMessage.php.php'>Wróć do wszystkich wiadomości</a>
    ");


*/