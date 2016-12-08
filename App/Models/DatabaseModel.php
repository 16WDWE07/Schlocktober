<?php

namespace App\Models;

use PDO;

abstract Class DatabaseModel
{
	public $data = [];

	private $dbc;

	public function __construct($input = null){

		if(static::$columns){
			foreach (static::$columns as $column) {
				$this->$column = null;
			}
		}

		if(is_numeric($input)){
			$this->data = $this->find($input);
		}

		if(is_array($input)){
			$this->processArray($input);
		}
	}

	public function processArray($input){
		foreach (static::$columns as $column) {
			if(isset($input[$column])){
				$this->$column = $input[$column];
			}
		}

	}

	protected static function getDatabaseConnection(){

		$dsn = 'mysql:host=localhost;dbname=Schlocktober;charset=utf8';
		$dbc = new PDO($dsn, 'root', '');

		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbc->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		return $dbc;

	}

	public function showAll(){

		$db = $this->getDatabaseConnection();

		$sql = "SELECT " . implode(',', static::$columns). " FROM " . static::$tablename;

		$statement = $db->prepare($sql);

		$result = $statement->execute();

		$moviesArray = [];

		while ($record = $statement->fetch(PDO::FETCH_ASSOC)){
			array_push($moviesArray, $record);
		}
		return $moviesArray;

	}

	public function find($id){

		// $id = isset($_GET['id']) ? $_GET['id'] : null;

		$db = $this->getDatabaseConnection();

		$sql = "SELECT ". implode(',', static::$columns). " FROM ". static::$tablename ." WHERE id=:id";

		$statement = $db->prepare($sql);

		$statement->bindValue(':id', $id);

		$result = $statement->execute();

		$record = $statement->fetch(PDO::FETCH_ASSOC);

		return $record;

	}
	public function save(){

		$db = $this->getDatabaseConnection();

		$columns = static::$columns;

		// Destroy any ID columns that might be in the list
		unset($columns[array_search('id', $columns)]);

		$sql = "INSERT INTO " . static::$tablename ." (" 
				. implode(',', $columns) . ") VALUES (";

		$insertcols = [];

		foreach ($columns as $column) {
			array_push($insertcols, ":".$column);
		}
		
		$sql .= implode(',', $insertcols) .	")";

		$statement = $db->prepare($sql);

		foreach ($columns as $column) {
			$statement->bindValue(":". $column, $this->$column);
		}
		
		$statement->execute();

		$this->id = $db->lastInsertId();

	}
	public function update(){

		// get database connection
		$db = $this->getDatabaseConnection();

		// unset id field
		$columns = static::$columns;
		unset($columns[array_search('id', $columns)]);

		// write query UPDATE
		$sql= "UPDATE " . static::$tablename . " SET ";

		$updatecols = [];

		foreach ($columns as $column) {
			array_push($updatecols, $column . "=:" .$column);
		}

		$sql .= implode(',', $updatecols) . " WHERE id=:id";

		// prepare statement
		$statement = $db->prepare($sql);

		// bind value for place holders
		foreach (static::$columns as $column) {
			$statement->bindValue(":".$column, $this->$column);
		}

		// execute
		$statement->execute();

	}

	public static function destroy($id){
		$db = self::getDatabaseConnection();
		$sql = "DELETE FROM " . static::$tablename . " WHERE id=:id";
		$statement = $db->prepare($sql);
		$statement->bindValue(":id", $id);
		$statement->execute();
	}

	public function __get($name){
		if(in_array($name, static::$columns)){
			return $this->data[$name];
		} else {
			echo "Property $name is not found in the data variable.";
		}

	}
	public function __set($name, $value){
		if(in_array($name, static::$columns)){
			return $this->data[$name]= $value;
		} else {
			echo "Property $name is not found in the data variable.";
		}
	}
 
}
















