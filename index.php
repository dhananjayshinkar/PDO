<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

$db= new Database();

class Database
{
    public $isConn;
    protected $datab;
    
    // connect to db
    public function __construct($username = "dps48", $password = "guYTqxyD1", $host = "sql1.njit.edu", $dbname = "dps48", $options = [])
    {
        $this->isConn = TRUE;
        try {
            	$this->datab = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
            	$this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            	$this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        	}
        	catch (PDOException $e) 
        	{
            	throw new Exception($e->getMessage());
        	}
        
    }
    
    // disconnect from db
    public function Disconnect(){
        $this->datab = NULL;
        $this->isConn = FALSE;
    }

    // get rows
    public function getRows()
    {
        try {
        	$sql = 'SELECT * FROM accounts';
            $stmt = $this->datab->prepare($sql);
            $stmt->execute();
            $resultset=$stmt->fetchAll();
            return $resultset;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    
}

$result=$db->getRows();
    print_r($result);

?>