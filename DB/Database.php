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
    //prepare sql query
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    //execute sql query
    public function execute()
    {
        return $this->stmt->execute();
    }

    //get all data in form of objects
    public function getdata()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //get the number of row returned
    public function numRows()
    {
        return $this->stmt->rowCount();
    }

    //get number of rows changed or affected by query
    public function lastInsertedId()
    {
        return $this->dbh->lastInsertId();
    }

}
?>