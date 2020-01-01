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
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
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
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }
    public function execute()
    {
        return $this->stmt->execute();
    }
    public function getdata()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function numRows()
    {
        return $this->stmt->rowCount();
    }
    public function lastInsertedId()
    {
        return $this->dbh->lastInsertId();
    }

}
?>