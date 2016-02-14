<?php



require_once ("./src/conection.php");
if(!isset($_SESSION['userID'])){
    echo("<a href='logOut.php'>Wyloguj</a><br>");
    echo("<a href='main.php'>Menu</a><br>");

    $allUsers = User::GetAllUser();
    foreach ($allUsers as $userToShow) {
        echo '<div id="usershow" ><h2>' . $userToShow->getName() . '</h2>';
        echo "<a href='showUser.php?userId={$userToShow->getId()}'>Odwiedz profil</a></div>";
    }
}