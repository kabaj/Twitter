<?php
require_once("./src/conection.php");
if (isset($_SESSION['userId']) !== TRUE) {
    header("Location: login.php");
}
$id = $_GET['id'];
$tweetToEdit = Tweet::LoadTweetById($id);
if($_SESSION['userId'] == $tweetToEdit->getUserId()) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tweetToEdit->updateTweet($_POST['tweet_text']);
        header("Location: showUser.php?userId=".($_SESSION['userId']));
    }
    echo("
    <form method='POST'>
    <p>
        <textarea name='tweet_text' cols='40' rows='4'>{$tweetToEdit->getTweetText()}</textarea>
    </p>
    <input type='submit' value='Edytuj'>
    </form>");


}
?>