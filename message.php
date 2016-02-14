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

