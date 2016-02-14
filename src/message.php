<?php
/*
CREATE TABLE Messages(
      id int AUTO_INCREMENT,
      send_id int NOT NULL,
      receive_id int NOT NULL,
      text varchar(500),
      datesend DATE,
      przeczytana int default 1,
      PRIMARY KEY(id),
      FOREIGN KEY(send_id) REFERENCES Users(id),
      FOREIGN KEY(receive_id) REFERENCES Users(id)
  ); *

 */




class Message {
    static private $connection = null;
    private $id;
    private $sendId;
    private $receiveId;
    private $text;
    private $dataWyslania;
    private $statusPrzeczytania;

    static public function SetConnection(mysqli $newConnection){
        Message::$connection = $newConnection;
    }

    static public function Create($idWysylajacego, $idOdbiorcy, $textWiadomosci){
        $messageDate = date('Y-m-d H:i:s', time());

        $sql = "INSERT INTO Messages(send_id, receive_id, text, datesend)
                VALUES ($idWysylajacego, $idOdbiorcy, '$textWiadomosci', '$messageDate')";
        $result = self::$connection->query($sql);
        if($result === TRUE){
            $message = new Message(self::$connection->insert_id, $idWysylajacego, $idOdbiorcy, $textWiadomosci, $messageDate);
            return $message;
        }
        return FALSE;
    }

    static public function loadAllSendMessages($id){
        $ret = [];
        $sql = "SELECT * FROM Messages, Users WHERE Messages.receive_id=Users.id AND send_id = $id ORDER BY datesend DESC";
        $result = self::$connection->query($sql);
        if($result !== false) {
            if($result->num_rows>0) {
                while($row = $result->fetch_assoc()){
                    $message = new Message($row['id'], $row['send_id'], $row['receive_id'], $row['text'], $row['datesend'], $row['przeczytana']);
                    $ret[] = $message;
                }
            }
        }
        return $ret;
    }
    static public function loadAllReceivedMessages($id){
        $ret = [];
        $sql = "SELECT * FROM Messages, Users WHERE Messages.send_id=Users.id AND receive_id = $id ORDER BY datesend DESC";
        $result = self::$connection->query($sql);
        if($result !== false) {
            if($result->num_rows>0) {
                while($row = $result->fetch_assoc()){
                    $message = new Message($row['id'], $row['nasend_idme'], $row['receive_id'], $row['text'], $row['datesend'], $row['przeczytana']);
                    $ret[] = $message;
                }
            }
        }
        return $ret;
    }
    static public function getMessageById($id){
        $sql = "SELECT Messages.id, Messages.send_id, Messages.receive_id, Messages.text, Messages.dataWyslania, Messages.przeczytana FROM Messages, Users WHERE Messages.send_id=Users.id AND Messages.id = $id ORDER BY dataWyslania DESC";        //tworze zapytanie do bazy danych
        $result = self::$connection->query($sql);
        if($result !== false) {
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $message = new Message($row['id'], $row['send_id'], $row['receive_id'], $row['text'], $row['dataWyslania'], $row['przeczytana']);
                return $message;
            }
        }
        return false;
    }
    public function __construct($newId, $newSendId, $newReceiveId, $newText, $newDataWyslania, $newStatusPrzeczytania){
        $this->id = $newId;
        $this->setSendId($newSendId);
        $this->setReceiveId($newReceiveId);
        $this->setText($newText);
        $this->setDataWyslania($newDataWyslania);
        $this->setStatusPrzeczytania($newStatusPrzeczytania);
    }
    public function setSendId($newSendId){
        $this->sendId = $newSendId;
    }
    public function setReceiveId($newReceiveId){
        $this->receiveId = $newReceiveId;
    }
    public function setText($newText){
        $this->text = $newText;
    }
    public function setDataWyslania($newDataWyslania){
        $this->dataWyslania = $newDataWyslania;
    }
    public function setStatusPrzeczytania($newStatusPrzeczytania){
        $this->statusPrzeczytania = $newStatusPrzeczytania;
    }
    public function getId(){
        return $this->id;
    }
    public function getSendId(){
        return $this->sendId;
    }
    public function getReceiveId(){
        return $this->receiveId;
    }
    public function getText(){
        return $this->text;
    }
    public function getDataWyslania(){
        return $this->dataWyslania;
    }
    public function getStatusPrzeczytania(){
        return $this->statusPrzeczytania;
    }
    public function getFirstThirtyChar()
    {
        if (strlen($this->text) > 30) {
            return substr($this->text, 0, 30) . "...";
        } else {
            return $this->text;
        }
    }
        public function changeStatus(){
           //TODO::
        }

    public function saveToDB(){
        $sql = "UPDATE Messages SET przeczytana=('$this->setStatusPrzeczytani()') WHERE id = $this->id";
        $result = self::$connection->query($sql);
        if ($result === True){
            return True;
        }
        return FALSE;
    }

}