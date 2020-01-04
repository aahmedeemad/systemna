<?php

class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbName = 'hr_system';

    private $dbh;
    private $stmt;
    private $error;


    public function __construct()
    {
        $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName; 
        $options = array(
            PDO::ATTR_PERSISTENT => true,// if there is a connection that is already open use it.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION//pdo will throw an pdo exception
        );

        try
        {
            $this->dbh = new PDO($dsn,$this->user,$this->pass,$options);
        }catch(PDOException $e)
        {
            //            $this->error = $e->getMessage();
            echo "<br><div style='text-align: center;'>ERROR! Please try again later</div>";
            $_SESSION['error'] = 'error in DB';
            error_log("error in DB page");
            //            echo $this->error;
            exit;
        }
    }
    public function query($sql)//prepare sql query
    {
        $this->stmt = $this->dbh->prepare($sql);
    }
    public function execute()//execute sql query
    {
        return $this->stmt->execute();
    }
    public function getdata()//get all data in form of objects
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function numRows()//get the number of row returned
    {
        return $this->stmt->rowCount();
    }
    public function lastInsertedId()//get number of rows changed or affected by query
    {
        return $this->dbh->lastInsertId();
    }

}
?>