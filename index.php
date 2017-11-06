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
        	$sql = 'SELECT * FROM accounts where id < 6';
            $stmt = $this->datab->prepare($sql);
            $stmt->execute();
            $resultset=$stmt->fetchAll();
            return $resultset;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    
    public function getCount()
	{
		try {
        	$sql = 'SELECT count(*) FROM accounts where id < 6';
            $stmt = $this->datab->prepare($sql);
            $stmt->execute();
            $resultset=$stmt->fetch();
            return $resultset;
        	} 
        	catch (PDOException $e) 
        	{
            throw new Exception($e->getMessage());
        	}
    			
	}

/*public function displayTable()
{
     
      echo "<table border=2>";
      echo "<tr><th>id</th><th>email</th><th>fname</th><th>lname</th><th>phone</th><th>birthday</th><th>gender</th><th>password</th></tr>";
 
    foreach( $resultset as $row) {
      echo "<tr>";
      echo "<td>".$row['id']."</td>";
      echo "<td>".$row['email']."</td>";
      echo "<td>".$row['fname']."</td>";
      echo "<td>".$row['lname']."</td>";
      echo "<td>".$row['phone']."</td>";
      echo "<td>".$row['birthday']."</td>";
      echo "<td>".$row['gender']."</td>";
      echo "<td>".$row['password']."</td>";
      echo "</tr>";
  }
  
  print_r($resultset);
 
echo "</table>";
    
    }
*/
}

$count=$db->getCount();
print_r($count);
$result=$db->getRows();
//$db->displayTable();

    //print_r($result);


echo "<table border=1>";
echo "<tr><th>ID</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Phone</th><th>Birth Date</th><th>Gender</th><th>Password</th></tr>";


foreach( $result as $row) 
{
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['fname']."</td>";
    echo "<td>".$row['lname']."</td>";
    echo "<td>".$row['phone']."</td>";
    echo "<td>".$row['birthday']."</td>";
    echo "<td>".$row['gender']."</td>";
    echo "<td>".$row['password']."</td>";
    echo "</tr>";
}

echo "</table>";

?>