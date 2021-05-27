<?php

include "../validate/Message.php";

class Database
{
    private $stmt;
    private $connect;

    public function __construct()
    {
        try {
            $this->connect = new mysqli("localhost","tamngau4321","mon3112@2002","QLBH");
        }catch(Exception $e){
            Message::showMessage($e->getMessage());
        }
    }

    public function closeConn()
    {
        $this->connect = null;
    }

    public function selectData($query){
        try {
          $this->stmt = $this->connect->prepare($query);
          $this->stmt->execute();
          return $this->stmt;
        }catch(Exception $e){
            Message::showMessage($e->getMessage());
        }
    }

    public function selectDataParam($query,$param){
        try {
            $this->stmt = $this->connect->prepare($query);
            $this->stmt->bind_param("s",$param);
            $this->stmt->execute();
            return $this->stmt;
        }catch(Exception $e){
            Message::showMessage($e->getMessage());
        }
    }


}
