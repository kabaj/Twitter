
<?php
require_once("./src/conection.php");
if (!isset($_SESSION['userId'])) {
    header("Location:login.php");
}
echo("<a href='logOut.php'>Wyloguj</a><br>");
echo("<a href='main.php'>Menu</a><br>");

if (isset($_GET['receive_id'])) {
    $userId = $_GET['receive_id'];
} else {
    echo ("error");
}

// GET
if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    $userToShow = User::getUserById($userId);
    if ($userToShow !== false) {
        echo("<p>{$userToShow->getName()}</p>");
        if ($userToShow->getId()) {
            echo("
        <form  method='post'>
        <label>
            <textarea type='text' name='text' cols='50' rows='10'></textarea></label>
            <input type='hidden' name='receive_id' value='{$userToShow->getId()}'>
            <input type='submit' value='Wyslij'>
        </form>
        ");
        }
    } else {
        echo("Nie znaleziono takiego uzytkownika");
    }
}

// POST
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    if (strlen(trim($_POST['text'])) > 0) {
        $messageText = $_POST['text'];
        $receiveId = $_POST['receive_id'];
        $message = Message::Create(($_SESSION['userId']), $receiveId, $messageText);
        header("Location: allMessage.php?userId=".$receiveId);
    } else {
        echo("Niestety nie utworzyl sie :(");
    }
}
