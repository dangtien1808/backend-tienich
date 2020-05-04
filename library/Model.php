<?php
// Mẫu cho các lớp model
// Dùng để định nghĩa bảng, kết nối DB và hỗ trợ xây dựng câu truy vấn
abstract class Model
{
	// tên bảng, kiểu string
	protected $tableName;

	// khóa chính, kiểu string
	protected $primaryKey;

	// Những trường được phép thao tác
	protected $allowedFields = [];

	// Đối tượng kết nối DB
	protected $connection;

  	// Cài đặt database, kiểu string
	protected $serveName;
	protected $name;
	protected $userName;
	protected $password;

	function __construct()
	{
		// Kiểm tra định nghĩa bảng ở lớp con
		if( empty($this->tableName) || empty($this->primaryKey) )
		{
			echo 'tên bảng không được để trống';
		}
		
		// Tạo đối tượng kết nối tới csdl mặc định
		if ( !(isset($this->serveName) && isset($this->name) && isset($this->userName) && isset($this->password)) )
		{

			$this->serveName = DB_SERVERNAME;
			$this->name 	 = DB_NAME;
			$this->userName  = DB_USERNAME;
			$this->password  = DB_PASSWORD;
		}
		
		$this->connection = new DataBase($this->serveName,$this->name,$this->userName,$this->password);
	}

	// Mẫu cho các câu truy vấn
	function insert($data)
	{
		// 
	    $key = '`'.implode(array_keys($data),'`,`').'`';
	    $place_holders = implode(',', array_fill(0, count($data), '?'));
	    $values = array_values($data);

		//
		$this->connection->appendSQL("INSERT INTO `".$this->tableName."` ($key) VALUES ($place_holders)");

	    //
	    return $this->connection->execute($values);

	}

	function update($primaryValue, $data)
	{	

		// 
    	$place_holders = implode(array_map(function($a, $b) { return '`'. $a .'`' . ' = ' . $b; }, array_keys($data), 
    					array_fill(0, count($data), '?')),',');

    	$values 	= array_values($data); 
    	$values[ count($values) ] 	= $primaryValue;

		//
		$this->connection->appendSQL("UPDATE `".$this->tableName."` SET $place_holders WHERE `"
									 .$this->primaryKey."` = ?");

	    //
	    return $this->connection->execute( $values );

	}

	function select($condition = array())
	{
		//

		//
		$where = 1;
		if ( !empty($condition) )
    	$where = implode(array_map(function($a, $b) { return '`'. $a .'`' . ' = ' . $b; }, array_keys($condition), 
    			array_fill(0, count($condition), '?')),' and ');

    	$values = array_values($condition);

		//
		$this->connection->appendSQL("select * from `".$this->tableName."` WHERE ".$where);

		//
		echo $this->connection->sql;

	    //
	    $result = $this->connection->fetchAll( $values );

	    //
	    return $result;
	}

	function first($condition = array())
	{

	    //
	    $result = $this->select( $condition );

	    //
	    if($result) return $result[0];
	}

	function lastInsertID()
	{
		return $this->connection->conn->lastInsertId();
	}
}