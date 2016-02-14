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

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $userToShow = User::GetUserById($userId);

    echo("<a  href='showUser.php?userId={$userId}'>Profil</a>");
    echo("<br>");
    echo("<a  href='allUsers.php'>Uzytkownicy</a>");
    echo("<br>");
    echo("<a  href='showAllTweet.php'>Tweety</a>");
    echo("<br>");
    echo("<a href='allMessage.php'>Wiadomosci</a>");
    echo("<br>");
    echo("<a  href='logOut.php'>Wyloguj</a>");

}
