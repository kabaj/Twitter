<?php
require_once ("./src/conection.php");
if(!isset($_SESSION['userId'])){
    header("Location:login.php");
}
echo("<a href='logOut.php'>Wyloguj</a><br>");
echo("<a href='main.php'>Menu</a><br>");

if(isset($_GET['id'])){
    $tweetId = $_GET['id'];
}

$tweetToShow = Tweet::LoadTweetById($tweetId);
$userId = $tweetToShow->getUserId(); // 3
$user = User::GetUserById($userId); // 3


echo('<h1>'.$user->getName().'</h1>');
echo($tweetToShow->getTweetText() . "<br>");
echo($tweetToShow->getTweetDate() . "<br />");
$coms = count($tweetToShow->getAllComments());

if($_SESSION['userId'] == $userId){


    echo("<a href='editTweet.php?tweetId='.$tweetId> Edycja</a>");
    echo("  |  ");
    echo("<a href='deleteTweet.php?id='.$tweetId> Usun</a>");
}
echo("<br>Liczba komentarzy: $coms ");
echo("<hr />");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (strlen($_POST['comment']) > 0) {
        $commentText = $_POST['comment'];
        $comment = Comment::CreateComment(($_GET['id']), $commentText);
        header("Location: showTweet.php?id=".$tweetId);
        return $comment;
    }
    return false;
}


 echo ("<form  method='post'>
    <label>
        Dodaj Komentarz:
        <br>
        <input type='text' name='comment'>
    </label>
    <input type='submit'>
    </form>");


foreach ($tweetToShow->getAllComments() as $comment) {
    $commenter = $comment->getUserId();
    $commenter = User::GetUserById($commenter);
    echo("<h1>{$commenter->getName()}</h1>");
    echo($comment->getCommentText() . "<br>");
    echo($comment->getCommentDate() . "<br>");
}
