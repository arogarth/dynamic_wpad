<?php

class Db {
	/**
	 * 
	 * @var mysqli
	 */
	private $db;
	
	public function __construct($host, $db, $user, $password) {
		$constr = "mysql:host={$host};dbname={$db}";
		$this->db = new PDO($constr, $user, $password);
	}
	
	public function insertRow($table, $data) {
		try {
			$data["modified"] = date("Y-m-d H:i:s");

			if(isset($data["id"])) { // UPDATE
				$query = "";
				foreach(array_keys($data) as $key) {
					if($key=="id") continue;
					if(!empty($query)) $query .= ", ";
					$query .= "{$key} = :{$key}";
				}
				$query = "UPDATE {$table} SET {$query} WHERE id = :id";
				
				$stmt = $this->db->prepare($query);
				
				foreach(array_keys($data) as $key) {
					$stmt->bindParam(":{$key}", $$key);
				}
				extract($data);
				
				$stmt->execute();
				
				return $data["id"];
				
			} else { // INSERT
				$query = "INSERT INTO ${table} (".implode(", ", array_keys($data)).") VALUES (";
				
				$i=0;
				foreach(array_keys($data) as $key) {
					if($i++>0) $query .= ", ";
					$query .= ":{$key}";
				}
				$query .= ")";
				
				$stmt = $this->db->prepare($query);
				
				foreach(array_keys($data) as $key) {
					$stmt->bindParam(":{$key}", $$key);
				}
				extract($data);
				
				$stmt->execute();
				
				return $this->db->lastInsertId();
			}
		} catch (Exception $e) {
			var_dump($e->getMessage());
		}
		
	}
	
	public function fetchRows($query) {
		$rows = $this->db->query($query, PDO::FETCH_ASSOC);
		return $rows->fetchAll();
	}
	
	public function fetchRow($table, $id) {
		$rows = $this->fetchRows("SELECT * FROM {$table} WHERE id = '{$id}'");
		return $rows[0];
	}
	
// 	public function deleteRows($query) {
// 		$this->db->query($query);
// 	}
	
	public function deleteRowById($table, $id) {
		$this->db->query("DELETE FROM {$table} WHERE id = '{$id}'");
	}
}

try {
	$db = new Db($config["db_host"], $config["db_name"], $config["db_user"], $config["db_pass"]);
} catch(Exception $e) {
	echo "Database configuration failure";
	die;
}
