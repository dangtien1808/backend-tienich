<?php
// Sử dụng thư viện PDO kết nối đến database và thực hiện truy vấn
class DataBase
{
  // Cài đặt database, kiểu string
  private $serveName;
  private $name;
  private $userName;
  private $password;

  // đối tượng PDO
  public $conn;

  // câu truy vấn SQL, kiểu string
  public $sql = ""; // câu truy vấn sẽ được xóa sau thực thi truy vấn

  // Đối tượng statement PDO sau khi thực thi câu truy vấn gần nhất
  public $stm;

  function __construct($serveName,$name,$userName,$password)
  {
    $this->serveName  = $serveName;
    $this->name       = $name;
    $this->userName   = $userName;
    $this->password   = $password;   
  }

  // tạo kết nối
  public function connect() 
  {
    try {
      $this->conn = new PDO('mysql:host='.$this->serveName.';dbname='
      .$this->name, $this->userName, $this->password);
      $this->conn->exec("SET NAMES 'utf8'");
     
    } catch (PDOException $ex) {
      die($ex->getMessage());
    }

    return $this->conn;
  }
  
  // nối từng phần câu truy vấn
  function appendSQL(string $sql)
  {
    $this->sql = $sql . $this->sql; 
  }

  // thực thi truy vấn và lưu lại statement gần nhât
  function execute($parameter=array())
  {
    //
    $this->stm  = $this->connect()->prepare( $this->sql );
    $this->stm->execute($parameter);

    //
    $this->sql = "";

    //
    return $this->stm;

  }
  
  // thực thi truy vấn và trả về kết quả là mảng 2 chiều
  function fetchAll($parameter=array())
  {
    //
    $this->execute($parameter);

    //
    return $this->stm->fetchAll(PDO::FETCH_ASSOC);
  }

}