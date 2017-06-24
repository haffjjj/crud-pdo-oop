<?php
class dbConfig
{
	private $dbDriver = "mysql"; 	//databaseOpo?
	private $host = "localhost"; 	//namaHost
	private $username = "root"; 	//username
	private $password = ""; 		//password
	private $database = "test";		//namaDatabaseNya

	protected $connection;

	public function __construct(){
		try{
		$this->connection = new PDO($this->dbDriver.':host='.$this->host.';dbname='.$this->database,$this->username,$this->password);
		$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e){
        	die("Koneksi error: " . $e->getMessage());
    	}
	}
}

class crud extends dbConfig{
	public function __construct(){
		parent::__construct();
	}

	public function create($data,$table){
		$query = "INSERT INTO $table VALUES(:id,:name,:age,:email)"; //query
		$result = $this->connection->prepare($query);
		try{
			$result->execute($data);
		}
		catch (PDOException $e){
        	die("Koneksi error: " . $e->getMessage());
    	}
	}

	public function read($table){
		$query = "SELECT * FROM $table"; //query
		try{
			$result = $this->connection->query($query);
		}
		catch (PDOException $e){
        	die("Koneksi error: " . $e->getMessage());
    	}

		$rows = array();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows;
	}

	public function update($data,$table,$id){
		$query = "UPDATE $table set name = :name, age = :age, email = :email where id = $id"; //query
		$result = $this->connection->prepare($query);
		try{
			$result->execute($data);
		}
		catch (PDOException $e){
        	die("Koneksi error: " . $e->getMessage());
    	}
	}

	public function delete($table,$id){
		$query = "DELETE FROM $table WHERE id = $id"; //query
		$result = $this->connection->prepare($query);
		try{
			$result->execute();
		}
		catch (PDOException $e){
        	die("Koneksi error: " . $e->getMessage());
    	}
	}
}

$crud = new crud();

// CREATE
// $table = "users";
// $data = array(
// 	':id' => 925,
// 	':name' => 'Anika',
// 	':age' => 24,
// 	':email' => 'anika@gmail.com'
// 	);
// $crud->create($data,$table);

// READ
// $table = "users";
// $result = $crud->read($table);
// foreach ($result as $key => $value) {
// 	echo $value['id'].$value['name'].$value['age'].$value['email'];
// }

// UPDATE
// $table = "users";
// $id = 100; //where id = $id
// $data = array(
// 	':name' => 'Anika',
// 	':age' => 24,
// 	':email' => 'anika@gmail.com'
// 	);
// $crud->update($data,$table,$id);

// DELETE
// $table = "users";
// $id = 11; //where id = $id
// $crud->delete($table,$id);

//jondes2017 1.0
?>