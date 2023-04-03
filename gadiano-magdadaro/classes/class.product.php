<?php
class Product{
	private $DB_SERVER='localhost';
	private $DB_USERNAME='root';
	private $DB_PASSWORD='';
	private $DB_DATABASE='db_wbapp';
	private $conn;
	public function __construct(){
		$this->conn = new PDO("mysql:host=".$this->DB_SERVER.";dbname=".$this->DB_DATABASE,$this->DB_USERNAME,$this->DB_PASSWORD);
		
	}
	
public function new_product_type($tname){
		
	/* Setting Timezone for DB */
	$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
	$NOW = $NOW->format('Y-m-d H:i:s');

	$data = [
		[$tname,$NOW,$NOW,'1'],
	];
	$stmt = $this->conn->prepare("INSERT INTO tbl_type (type_name, type_date_added, type_time_added, type_status) VALUES (?,?,?,?)");
	try {
		$this->conn->beginTransaction();
		foreach ($data as $row)
		{
			$stmt->execute($row);
		}
		$id= $this->conn->lastInsertId();
		$this->conn->commit();
		
	}catch (Exception $e){
		$this->conn->rollback();
		throw $e;
	}

	return $id;

	}

	public function new_product($pname,$desc,$price,$type){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');
	
		$data = [
			[$pname,$desc,$price,$NOW,$NOW,'1',$type],
		];
		$stmt = $this->conn->prepare("INSERT INTO tbl_product(prod_name, prod_description, prod_price,prod_date_added, prod_time_added, prod_status, type_id) VALUES (?,?,?,?,?,?,?)");
		try {
			$this->conn->beginTransaction();
			foreach ($data as $row)
			{
				$stmt->execute($row);
			}
			$id= $this->conn->lastInsertId();
			$this->conn->commit();
			
		}catch (Exception $e){
			$this->conn->rollback();
			throw $e;
		}
	
		return $id;
	
		}


	public function list_product_type(){
		$sql="SELECT * FROM tbl_type";
		$q = $this->conn->query($sql) or die("failed!");
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]=$r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
	}
	public function list_product(){
		$sql="SELECT * FROM tbl_product";
		$q = $this->conn->query($sql) or die("failed!");
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]=$r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
	}

	public function list_types(){
		$sql="SELECT * FROM tbl_type";
		$q = $this->conn->query($sql) or die("failed!");
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]=$r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
	}
	public function update_product($pname,$desc, $ptype, $id){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');

		$sql = "UPDATE tbl_product SET prod_name=:prod_name,prod_description=:prod_description,prod_date_updated=:prod_date_updated,prod_time_updated=:prod_time_updated,type_id=:type_id WHERE prod_id=:prod_id";

		$q = $this->conn->prepare($sql);
		$q->execute(array(':prod_name'=>$pname, ':prod_description'=>$desc,':prod_date_updated'=>$NOW,':prod_time_updated'=>$NOW,':type_id'=>$ptype,':prod_id'=>$id));
		return true;
	}
	function get_prod_name($id){
		$sql="SELECT prod_name FROM tbl_product WHERE prod_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$prod_name = $q->fetchColumn();
		return $prod_name;
	}
	function get_prod_desc($id){
		$sql="SELECT prod_description FROM tbl_product WHERE prod_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$prod_description = $q->fetchColumn();
		return $prod_description;
	}
	function get_prod_type($id){
		$sql="SELECT type_id FROM tbl_product WHERE prod_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$type_id = $q->fetchColumn();
		return $type_id;
	}

	function get_prod_type_name($id){
		$sql="SELECT type_name FROM tbl_type WHERE type_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$type_name = $q->fetchColumn();
		return $type_name;
	}

	function get_prod_price($id){
		$sql="SELECT prod_price FROM tbl_product WHERE prod_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$prod_price = $q->fetchColumn();
		return $prod_price;
	}
	
	function get_prod_image($id){
		$sql="SELECT prod_image FROM tbl_product WHERE prod_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$prod_image = $q->fetchColumn();
		return $prod_image;
	}
}
