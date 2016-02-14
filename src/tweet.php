<?php


/*

CREATE TABLE Tweets(
    id INT AUTO_INCREMENT,
    user_id INT,
    tweet_text VARCHAR(140) NOT NULL,
    post_date DATE NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (user_id) REFERENCES Users(id)
    ON DELETE CASCADE
    );
 */


class Tweet {
    static private $connection = null;


    static function SetConnection(mysqli $newConnection) {
        Tweet::$connection = $newConnection;
    }
    static public function CreateTweet($tweetText) {
        $userId = $_SESSION["userId"];
        $tweetDate = date('Y-m-d H:i:s', time());
        $sql = "INSERT INTO Tweets(user_id, tweet_text, post_date) VALUES ($userId, '$tweetText', '$tweetDate')";
        $result = self::$connection->query($sql);
        if ($result === TRUE) {
            $newTweet = new Tweet(self::$connection->insert_id, $userId, $tweetText);
            return $newTweet;
        }
        echo("Nie udalo sie utworzyc tweeta :(");
        return false;
    }
    static public function LoadTweetById($id) {
        $sql = "SELECT * FROM Tweets where id = $id";
        $result = self::$connection->query($sql);
        if ($result !== FALSE) {
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $newTweet = new Tweet($row['id'], $row['user_id'], $row['tweet_text'], $row['post_date']);
                return $newTweet;
            }
        }
        return false;
    }
    static public function ShowAllTweets() {
        $ret = [];
        $sql = "SELECT * FROM Tweets ORDER BY post_date DESC";
        $result = self::$connection->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $newTweet = new Tweet($row['id'], $row['user_id'], $row['tweet_text'], $row['post_date']);
                $ret[] = $newTweet;
            }
        }
        return $ret;
    }
    private $id;
    private $userId;
    private $tweetText;
    private $tweetDate;

    public function __construct($id, $userId, $tweetText, $tweetDate) {
        $this->id = intval($id);
        $this->userId = intval($userId);
        $this->setTweetText($tweetText);
        $this->tweetDate = $tweetDate;
    }
    public function setTweetText($newTweetText) {
        if (strlen($newTweetText) > 0) {
            return($this->tweetText = $newTweetText);
        }
        return false;
    }
    public function getId() {
        return $this->id;
    }
    public function getUserId() {
        return intval($this->userId);
    }
    public function getTweetText() {
        return $this->tweetText;
    }
    public function getTweetDate() {
        return $this->tweetDate;
    }
    public function getAllComments() {
        $ret = [];
        $sql = "SELECT * FROM Comments WHERE tweet_id =$this->id ORDER BY comment_date DESC";
        $result = self::$connection->query($sql);
        if ($result !== FALSE) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $comment = new Comment($row['id'], $row['tweet_id'], $row['user_id'], $row['comment_text'], $row['comment_date']);
                    $ret[] = $comment;
                }
            }
        }
        return $ret;
    }
    public function getFirstThirtyChar(){
        if (strlen($this->tweetText)>30){
            return substr($this->tweetText, 0, 30) . "...";
        }else{
            return $this->tweetText;
        }
    }
    public function removeTweet(){
        $sql = "DELETE FROM Tweets WHERE id =$this->id";
        $result = self::$connection->query($sql);
        if($result == true){
            echo("Tweet zostal usuniety");
        }
        else{
            echo("Nie udalo sie usunac tweeta");
        }
    }
    public function updateTweet($tweetText) {
        $this->setTweetText($tweetText);
        $sql = "UPDATE Tweets SET tweet_text='$this->tweetText' WHERE id=$this->id";
        $result = self::$connection->query($sql);
        if($result == true){
            echo("Tweet zostal edytowany");
        }
        else{
            echo("Nie udalo sie zmienic tweeta");
        }
    }
}

